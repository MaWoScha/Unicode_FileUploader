<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Model_Mysql4_Fileuploader extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('fileuploader/fileuploader', 'fileuploader_id');
    }
}