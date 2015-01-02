<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Adminhtml_FileuploaderController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('catalog/items')
                ->_addBreadcrumb(Mage::helper('fileuploader')->__('Items Manager'), Mage::helper('fileuploader')->__('Item Manager'));
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('fileuploader/fileuploader')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
        }
        Mage::register('fileuploader_data', $model);
        return $this;
    }

    public function indexAction() {
        Mage::helper('unicommon')->c($this->getRequest()->getModuleName());
        $this->_initAction()
                ->renderLayout();
    }

    public function productgridAction() {
        $this->_initAction();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tab_products')->toHtml()
        );
    }

    public function filegridAction() {
        $this->_initAction();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tab_productfile')->toHtml()
        );
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('fileuploader/fileuploader')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('fileuploader_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('catalog/items');

            $this->_addBreadcrumb(Mage::helper('fileuploader')->__('Item Manager'), Mage::helper('fileuploader')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('fileuploader')->__('Item Fileuploader'), Mage::helper('fileuploader')->__('Item Fileuploader'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit'))
                    ->_addLeft($this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tabs'));
            
            if ((Mage::helper('fileuploader')->getVersionLow()) && Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('fileuploader')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        $filedata = array();
        $uploadedFile = 'uploaded_file';
        $_helper = Mage::helper('fileuploader');
        if (!empty($_FILES[$uploadedFile]['name'])) {
            try {
                $ext = $_helper->getFileExtension($_FILES[$uploadedFile]['name']);
                $fname = 'File-' . time() . $ext;
                $uploader = new Varien_File_Uploader($uploadedFile);
                #$uploader->setAllowedExtensions(array("txt", "csv", "htm", "html", "xml", "css", "doc", "docx", "xls", "xlsx", "rtf", "ppt", "pdf", "swf", "flv", "avi", "wmv", "mov", "wav", "mp3", "jpg", "jpeg", "gif", "png","zip"));

                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media') . DS . 'custom' . DS . 'upload' . DS;

                $uploader->save($path, $fname);

                $filedata[$uploadedFile] = 'custom/upload/' . $fname;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        if ($data = $this->getRequest()->getPost()) {
            $products = array();
            $availProductIds = Mage::getModel('fileuploader/fileuploader')->getAllAvailProductIds();
            parse_str($data['fileuploader_products'], $products);
            foreach ($products as $k => $v) {
                if (preg_match('/[^0-9]+/', $k) || preg_match('/[^0-9]+/', $v)) {
                    unset($products[$k]);
                }
            }
            
            $productIds = array_intersect($availProductIds, $products);
            $data['product_ids'] = implode(',', $productIds);
            if (!empty($filedata[$uploadedFile])) {
                $data[$uploadedFile] = $filedata[$uploadedFile];
            } else {
                if (isset($data[$uploadedFile]['delete']) && $data[$uploadedFile]['delete'] == 1) {
                    if ($data[$uploadedFile]['value'] != '')
                        $this->removeFile($data[$uploadedFile]['value']);
                    $data[$uploadedFile] = '';
                }else {
                    unset($data[$uploadedFile]);
                }
            }
            $model = Mage::getModel('fileuploader/fileuploader');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('fileuploader')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }


        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('fileuploader')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $id = $this->getRequest()->getParam('id');
                $fileupload = Mage::getModel('fileuploader/fileuploader')->load($id);
                if ($fileupload['uploaded_file'] != '')
                    $this->removeFile($fileupload['uploaded_file']);
                $fileupload->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('fileuploader')->__('File was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $fileuploadIds = $this->getRequest()->getParam('fileuploader');
        if (!is_array($fileuploadIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('fileuploader')->__('Please select item(s)'));
        } else {
            try {
                foreach ($fileuploadIds as $fileuploadId) {
                    $fileupload = Mage::getModel('fileuploader/fileuploader')->load($fileuploadId);
                    if ($fileupload['uploaded_file'] != '')
                        $this->removeFile($fileupload['uploaded_file']);
                    $fileupload->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('fileuploader')->__(
                                'Total of %d record(s) were successfully deleted', count($fileuploadIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $fileuploadIds = $this->getRequest()->getParam('fileuploader');
        if (!is_array($fileuploadIds)) {
            Mage::getModel('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($fileuploadIds as $fileuploadId) {
                    $fileupload = Mage::getSingleton('fileuploader/fileuploader')
                                    ->load($fileuploadId)
                                    ->setFileStatus($this->getRequest()->getParam('file_status'))
                                    ->setIsMassupdate(true)
                                    ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($fileuploadIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function removeFile($file) {
        $_helper = Mage::helper('fileuploader');
        $file = $_helper->updateDirSepereator($file);
        $directory = Mage::getBaseDir('media') . DS . $file;
        $io = new Varien_Io_File();
        $result = $io->rmdir($directory, true);
    }

}