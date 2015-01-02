<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Grid_Gridproduct extends Mage_Adminhtml_Block_Widget_Container {

    /**
     * Set template
     */
    public function __construct() {
        parent::__construct();        
        $this->setTemplate('fileuploader/products.phtml');
    }

    public function getTabsHtml() {
        return $this->getChildHtml('tabs');
    }

    protected function _prepareLayout() {
        $this->setChild('tabs', $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tab_products', 'fileuploader.grid.products'));
//        $this->setChild('store_switcher',
//            $this->getLayout()->createBlock('adminhtml/store_switcher')
//                ->setUseConfirm(false)
//                ->setSwitchUrl($this->getUrl('*/*/edit', array('id'=>$this->getRequest()->getParam('id'),'_confirm'=>false,'store'=>null)))
//                ->setTemplate('store/switcher.phtml'));
        return parent::_prepareLayout();
    }

    protected function getFileuploaderData() {
        return Mage::registry('fileuploader_data');
    }

    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    public function isSingleStoreMode() {
        if (!Mage::app()->isSingleStoreMode()) {
            return false;
        }
        return true;
    }

    public function getProductsJson() {
        $products = explode(',', $this->getFileuploaderData()->getProductIds());
        if (!empty($products) && isset($products[0]) && $products[0] != '') {
            $data = array();
            foreach ($products as $element) {
                $data[$element] = $element;
            }
            return Zend_Json::encode($data);
        }
        return '{}';
    }

}
