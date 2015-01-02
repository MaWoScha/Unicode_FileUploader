<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Block_Fileuploader extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getProductAttachments($productId=0) {
        $attach = array();
        $_helper = Mage::helper('fileuploader');
        $data = Mage::getModel('fileuploader/fileuploader')->getFilesByProductId($productId);
        $totalFiles = $data['totalRecords'];
        if ($totalFiles > 0) {
            $record = $data['items'];
            $i=0;
            foreach ($record as $rec) {
                $i++;
                $file = $_helper->getFilesHtml($rec['uploaded_file'], $rec['title'],$i,true,$rec['content_disp'],true);
                $attach[] = array('title' => $rec['title'], 'file' => $file, 'content' => $rec['file_content']);
            }
        }
        return $attach;
    }

}