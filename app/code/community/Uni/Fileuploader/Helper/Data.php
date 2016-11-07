<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Uni_Fileuploader_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getFileExtension($filename, $pos = 0) {
        return strtolower(substr($filename, strrpos($filename, '.') + $pos));
    }

    public function updateDirSepereator($path) {
        return str_replace('\\', DS, $path);
    }

    public function getDownloadFileUrl($url, $disposition) {
        return Mage::getUrl('fileuploader/download/download', array('_query' => array('d' => $disposition, 'file' => $url)));
    }

    protected function getFileSize($file) {
        $size = filesize($file);
        $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        if ($size == 0) {
            return ('n/a');
        } else {
            return (round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
        }
    }

    public function getFilesHtml($url, $title, $id = null, $showTitle = false, $disposition = 0, $size = false) {
        $url = $this->getDownloadFileUrl($url, $disposition);
        $html = '<a class="button" title="' . $title . '" target="_blank" href="' . $url . '">'.$this->__('Download').'</a>';

        return $html;
    }

    public function getFilesSize($url) {
        $file = $this->updateDirSepereator($url);
        $mediaDir = Mage::getBaseDir('media');
        $filePath = $mediaDir . DS . $file;
        if (file_exists($filePath))
            $fileSize = $this->getFileSize($filePath);

        return $fileSize;
    }

    public function getFilesTyp($url) {

        $mediaUrl = Mage::getBaseUrl('media');
        $ext = $this->getFileExtension($url, 1); //"jpg","jpeg","gif","png","txt","csv","htm","html","xml","css","doc","docx","xls","rtf","ppt","pdf","swf","flv","avi","wmv","mov","wav","mp3","zip"
        $mediaIcon = Mage::getBaseUrl('media') . 'custom/upload/icons/' . $ext . '.png';
        $mediaIconImage = '<img src="' . $mediaIcon . '" alt="' . $ext . '" /></span>';
        $wh = ($showTitle) ? '16' : '22';
        if ($disposition) {
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp') {
                $image = $mediaUrl . $url;
                $fileTyp = '<img src="' . $image . '" id="' . $id . '_image" title="' . $title . '" alt="' . $title . '" height="' . $wh . '" width="' . $wh . '" class="small-image-preview v-middle" style="width: ' . $wh . 'px; height: ' . $wh . 'px"/>';
            } else if ($ext == 'txt' || $ext == 'rtf' || $ext == 'csv' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xml' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pdf' || $ext == 'swf' || $ext == 'zip') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'avi') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'flv') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'mov') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'wmv' || $ext == 'wav' || $ext == 'mp3') {
                $fileTyp = $mediaIconImage;
            } else {
                $mediaIcon = Mage::getBaseUrl('media') . 'custom/upload/icons/plain.png';
                $mediaIconImage = '<img src="' . $mediaIcon . '" alt="View File">';
                $fileTyp = $mediaIconImage;
            }
        } else {
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp') {
                $fileTyp = '<img src="' . $image . '" id="' . $id . '_image" title="' . $title . '" alt="' . $title . '" height="' . $wh . '" width="' . $wh . '" class="small-image-preview v-middle" style="width: ' . $wh . 'px; height: ' . $wh . 'px"/>';
            } else if ($ext == 'txt' || $ext == 'rtf' || $ext == 'csv' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xml' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pdf' || $ext == 'swf' || $ext == 'flv' || $ext == 'zip') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'avi') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'mov') {
                $fileTyp = $mediaIconImage;
            } else if ($ext == 'wmv' || $ext == 'wav' || $ext == 'mp3') {
                $fileTyp = $mediaIconImage;
            } else {
                $mediaIcon = Mage::getBaseUrl('media') . 'custom/upload/icons/plain.png';
                $mediaIconImage = '<img src="' . $mediaIcon . '" alt="View File">';
                $fileTyp = $mediaIconImage;
            }
        }
        return $fileTyp;
    }

    public function getVersionLow() {
        return (version_compare(Mage::getVersion(), '1.4.0', '>='));
    }
}
