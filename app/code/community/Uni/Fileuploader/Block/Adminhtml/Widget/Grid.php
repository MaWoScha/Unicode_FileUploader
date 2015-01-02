<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
//require_once 'Mage/Adminhtml/Block/Widget/Grid.php';
class Uni_Fileuploader_Block_Adminhtml_Widget_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function addColumn($columnId, $column) {
        if (is_array($column)) {
            $this->_columns[$columnId] = $this->getLayout()->createBlock('fileuploader/adminhtml_widget_grid_column')
                            ->setData($column)
                            ->setGrid($this);
        }
        /* elseif ($column instanceof Varien_Object) {
          $this->_columns[$columnId] = $column;
          } */ else {
            throw new Exception(Mage::helper('adminhtml')->__('Wrong column format'));
        }

        $this->_columns[$columnId]->setId($columnId);
        $this->_lastColumnId = $columnId;
        return $this;
    }

}
