<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Helper_Download extends Mage_Downloadable_Helper_Download {
    protected function _prepareFileForPath($file) {
        return str_replace('/', DS, $file);
    }

    public function getFilePath($path, $file) {
        $file = $this->_prepareFileForPath($file);

        if (substr($file, 0, 1) == DS) {
            return $path . DS . substr($file, 1);
        }

        return $path . DS . $file;
    }
}
