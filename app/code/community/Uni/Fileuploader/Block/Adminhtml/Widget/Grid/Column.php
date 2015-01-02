<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
//require_once 'Mage/Adminhtml/Block/Widget/Grid/Column.php';

class Uni_Fileuploader_Block_Adminhtml_Widget_Grid_Column extends Mage_Adminhtml_Block_Widget_Grid_Column {

    protected function _getRendererByType() {
        switch (strtolower($this->getType())) {
            case 'file':
                $rendererClass = 'fileuploader/adminhtml_widget_grid_column_renderer_file';
                break;
            default:
                $rendererClass = parent::_getRendererByType();
                break;
        }
        return $rendererClass;
    }

    protected function _getFilterByType() {
        switch (strtolower($this->getType())) {
            case 'file':
                $filterClass = 'fileuploader/adminhtml_widget_grid_column_filter_file';
                break;
            default:
                $filterClass = parent::_getFilterByType();
                break;
        }
        return $filterClass;
    }

}