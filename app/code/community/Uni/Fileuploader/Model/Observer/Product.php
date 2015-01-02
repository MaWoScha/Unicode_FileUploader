<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Model_Observer_Product {

    public function injectTabs(Varien_Event_Observer $observer) {
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs) {
            if (($this->_getRequest()->getActionName() == 'edit' || $this->_getRequest()->getParam('type')) && $this->_getRequest()->getParam('id')) {
                $block->addTab('attachment_section', array(
                    'label' => Mage::helper('fileuploader')->__('Product Attachments'),
                    'alt' => Mage::helper('fileuploader')->__('Product Attachments'),
                    'content' => $block->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_grid_gridfile')->toHtml(),
                ));
            }
        }
    }

    protected function _getRequest() {
        return Mage::app()->getRequest();
    }

}