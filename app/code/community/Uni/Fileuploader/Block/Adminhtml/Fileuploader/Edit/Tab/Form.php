<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('fileuploader_form', array('legend' => Mage::helper('fileuploader')->__('Item information')));
              


        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('fileuploader')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('uploaded_file', 'fileuploader', array(
            'label' => Mage::helper('fileuploader')->__('File'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'uploaded_file',
        ));

        $fieldset->addField('file_status', 'select', array(
            'label' => Mage::helper('fileuploader')->__('Status'),
            'name' => 'file_status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('fileuploader')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('fileuploader')->__('Disabled'),
                ),
            ),
        ));

        $fieldset->addField('content_disp', 'select', array(
            'label' => Mage::helper('fileuploader')->__('Content-Disposition'),
            'name' => 'content_disp',
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('fileuploader')->__('Attachment'),
                ),
                array(
                    'value' => 1,
                    'label' => Mage::helper('fileuploader')->__('Inline'),
                ),
            ),
        ));

        if (Mage::helper('fileuploader')->getVersionLow()) {
            $fieldset->addField('file_content', 'editor', array(
                'name' => 'file_content',
                'label' => Mage::helper('fileuploader')->__('Content'),
                'title' => Mage::helper('fileuploader')->__('Content'),
                'style' => 'width:600px; height:300px;',
                'config' => Mage::getSingleton('fileuploader/wysiwyg_config')->getConfig(),
                'wysiwyg' => true,
                'required' => false,
            ));
        } else {
            $fieldset->addField('file_content', 'editor', array(
                'name' => 'file_content',
                'label' => Mage::helper('fileuploader')->__('Content'),
                'title' => Mage::helper('fileuploader')->__('Content'),
                'style' => 'width:600px; height:300px;',
                'wysiwyg' => false,
                'required' => false,
            ));
        }

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('fileuploader')->__('Sort Order'),
            'name' => 'sort_order',
        ));

        if (Mage::getSingleton('adminhtml/session')->getFileUploaderData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getFileUploaderData());
            Mage::getSingleton('adminhtml/session')->setFileUploaderData(null);
        } elseif (Mage::registry('fileuploader_data')) {
            $form->setValues(Mage::registry('fileuploader_data')->getData());
        }

        return parent::_prepareForm();
    }

}