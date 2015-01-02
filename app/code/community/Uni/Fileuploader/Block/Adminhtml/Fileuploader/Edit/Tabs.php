<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('fileuploader_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('fileuploader')->__('Item Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('fileuploader')->__('File Information'),
            'title' => Mage::helper('fileuploader')->__('File Information'),
            'content' => $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tab_form')->toHtml(),
        ));

        $this->addTab('grid_section', array(
            'label' => Mage::helper('fileuploader')->__('Product Information'),
            'alt' => Mage::helper('fileuploader')->__('Product Information'),
            'content' => $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_grid_gridproduct')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}