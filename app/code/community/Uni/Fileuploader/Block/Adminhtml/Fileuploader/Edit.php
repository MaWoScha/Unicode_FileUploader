<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'fileuploader';
        $this->_controller = 'adminhtml_fileuploader';

        $this->_updateButton('save', 'label', Mage::helper('fileuploader')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('fileuploader')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('fileuploader')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
           function toggleEditor() {
                if (tinyMCE.getInstanceById('file_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'file_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'file_content');
                }
            }
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {

        if (Mage::registry('fileuploader_data') && Mage::registry('fileuploader_data')->getId()) {
            return Mage::helper('fileuploader')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('fileuploader_data')->getTitle()));
        } else {
            return Mage::helper('fileuploader')->__('Add Item');
        }
    }

}