<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Grid_Gridfile extends Mage_Adminhtml_Block_Widget_Container {

    /**
     * Set template
     */
    public function __construct() {
        parent::__construct();        
        $this->setTemplate('fileuploader/tabs.phtml');
    }

    public function getTabsHtml() {
        return $this->getChildHtml('tabs');
    }

    protected function _prepareLayout() {
        $this->setChild('tabs', $this->getLayout()->createBlock('fileuploader/adminhtml_fileuploader_edit_tab_productfile', 'product.grid.fileuploader'));
        return parent::_prepareLayout();
    }

}
