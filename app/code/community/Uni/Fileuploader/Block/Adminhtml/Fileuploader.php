<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Adminhtml_Fileuploader extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_fileuploader';
    $this->_blockGroup = 'fileuploader';
    $this->_headerText = Mage::helper('fileuploader')->__('File Manager');
    $this->_addButtonLabel = Mage::helper('fileuploader')->__('Add Item');
	parent::__construct();
  }
}