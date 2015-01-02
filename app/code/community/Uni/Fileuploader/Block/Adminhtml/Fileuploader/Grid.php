<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader_Grid extends Uni_Fileuploader_Block_Adminhtml_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('fileuploadGrid');
        $this->setDefaultSort('fileuploader_id');
        $this->setDefaultDir('ASC');        
        $this->setSaveParametersInSession(true);
    }    

    protected function _prepareCollection() {
        $collection = Mage::getModel('fileuploader/fileuploader')->getCollection();        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('fileuploader_id', array(
            'header' => Mage::helper('fileuploader')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'fileuploader_id',
        ));
        $this->addColumn('title', array(
            'header' => Mage::helper('fileuploader')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('product_ids', array(
            'header' => Mage::helper('fileuploader')->__('Products'),
            'align' => 'left',
            'index' => 'product_ids',
        ));

        $this->addColumn('uploaded_file', array(
            'header' => Mage::helper('fileuploader')->__('File'),
            'align' => 'left',
            'type' => 'file',
            'escape' => true,
            'sortable' => false,
            'index' => 'uploaded_file',
        ));

        $this->addColumn('content_disp', array(
            'header' => Mage::helper('fileuploader')->__('Content-Disposiotion'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'content_disp',
            'type' => 'options',
            'options' => array(
                0 => 'Attachment',
                1 => 'Inline',
            ),
        ));

        $this->addColumn('sort_order', array(
            'header' => Mage::helper('fileuploader')->__('Sort Order'),
            'width' => '80px',
            'index' => 'sort_order',
            'align' => 'center',
        ));

        $this->addColumn('file_status', array(
            'header' => Mage::helper('fileuploader')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'file_status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));
        $this->addColumn('action',
                array(
                    'header' => Mage::helper('fileuploader')->__('Action'),
                    'width' => '80',
                    'type' => 'action',
                    'getter' => 'getId',
                    'actions' => array(
                        array(
                            'caption' => Mage::helper('fileuploader')->__('Edit'),
                            'url' => array('base' => '*/*/edit'),
                            'field' => 'id'
                        )
                    ),
                    'filter' => false,
                    'sortable' => false,
                    'index' => 'stores',
                    'is_system' => true,
        ));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {

        $this->setMassactionIdField('fileuploader_id');
        $this->getMassactionBlock()->setFormFieldName('fileuploader');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('fileuploader')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('fileuploader')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('fileuploader/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('file_status', array(
            'label' => Mage::helper('fileuploader')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'file_status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('fileuploader')->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}