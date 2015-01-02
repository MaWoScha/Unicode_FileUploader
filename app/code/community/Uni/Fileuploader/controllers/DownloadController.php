<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_DownloadController extends Mage_Core_Controller_Front_Action {

    protected function _getSession() {
        return Mage::getSingleton('core/session');
    }

    protected function _processDownload($file,$disposition=0) {
        $_helper = Mage::helper('fileuploader/download');
        $resource = $_helper->getFilePath(Mage::getBaseDir('media'), $file);
        $resourceType = Uni_Fileuploader_Helper_Download::LINK_TYPE_FILE;
        $_helper->setResource($resource, $resourceType);

        $fileName = $_helper->getFilename();
        $contentType = $_helper->getContentType();

        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Pragma', 'public', true)
                ->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true)
                ->setHeader('Content-type', $contentType, true);

        if ($fileSize = $_helper->getFilesize()) {
            $this->getResponse()
                    ->setHeader('Content-Length', $fileSize);
        }
        $contentDisposition = (($disposition)?'inline':'attachment');
        if ($contentDisposition) {
            $this->getResponse()
                    ->setHeader('Content-Disposition', $contentDisposition . '; filename=' . $fileName);
        }

        $this->getResponse()
                ->clearBody();
        $this->getResponse()
                ->sendHeaders();

        $_helper->output();
    }

    public function downloadAction() {
        $fileName = $this->getRequest()->getParam('file',null);
        $disp = $this->getRequest()->getParam('d',null);
        if ($fileName) {
            try {
                $this->_processDownload($fileName,$disp);
                exit(0);
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError(Mage::helper('fileuploader')->__('Sorry, there was an error getting requested content.'));
            }
        }
        return $this->_redirectReferer();
    }

}
