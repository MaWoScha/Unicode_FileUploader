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
            return('n/a');
        } else {
            return (round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
        }
    }

    public function getFilesHtml($url, $title, $id = null, $showTitle = false, $disposition = 0, $size = false) {
        $html = '';
        $fileSize = '';
        $mediaUrl = Mage::getBaseUrl('media');
        $ext = $this->getFileExtension($url, 1); //"jpg","jpeg","gif","png","txt","csv","htm","html","xml","css","doc","docx","xls","rtf","ppt","pdf","swf","flv","avi","wmv","mov","wav","mp3","zip"
        $mediaIcon = Mage::getBaseUrl('media') . '/custom/upload/icons/' . $ext . '.png';
        $playerPath = Mage::getBaseUrl('media') . '/custom/upload/player/';
        $mediaIconImage = '<span class="attach-img"><img src="' . $mediaIcon . '" alt="View File" style="margin-right: 5px;"/></span>' . (($showTitle) ? '<span class="attach-title">' . $title . '</span>' : '');
        $wh = ($showTitle) ? '16' : '22';
        if ($size) {
            $file = $this->updateDirSepereator($url);
            $mediaDir = Mage::getBaseDir('media');
            $filePath = $mediaDir . DS . $file;
            if (file_exists($filePath))
                $fileSize = '&nbsp; &nbsp;Size: (' . $this->getFileSize($filePath) . ')';
        }
        if ($disposition) {
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp') {
                $image = $mediaUrl . $url;
                $onclick = "return fileUploaderPopup.open({url:this.rel, title: '" . str_replace(' ', '_', $title) . "'});";
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" title="' . $title . '" rel="' . $url . '" href="javascript:;" onclick="' . $onclick . '"><span class="attach-img"><img src="' . $image . '" id="' . $id . '_image" title="' . $title . '" alt="' . $title . '" height="' . $wh . '" width="' . $wh . '" class="small-image-preview v-middle" style="margin-right: 5px; width: ' . $wh . 'px; height: ' . $wh . 'px"/></span>' . (($showTitle) ? '<span class="attach-title">' . $title . '</span>' : '') . '</a>';
            } else if ($ext == 'txt' || $ext == 'rtf' || $ext == 'csv' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xml' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pdf' || $ext == 'swf' || $ext == 'zip') {
                $url = $this->getDownloadFileUrl($url, $disposition);
                $onclick = "return fileUploaderPopup.open({url:this.rel, title: '" . str_replace(' ', '_', $title) . "'});";
                $html = '<a class="prod-attach" title="' . $title . '" rel="' . $url . '" href="javascript:;" onclick="' . $onclick . '">' . $mediaIconImage . '</a> ';
            } else if ($ext == 'avi') {
                $url = $mediaUrl . $url;
                $onclick = "javascript:playerAviOpen('" . $title . "',this.rel); return false;";
                $onmouseover = "window.status=''; return true;";
                $html = '<a class="prod-attach" title="' . $title . '" onmouseover="' . $onmouseover . '" onclick="' . $onclick . '" target="_blank" rel="' . $url . '" href="javascript:;"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else if ($ext == 'flv') {
                $url = $mediaUrl . $url;
                $onclick = "javascript:playerFlvOpen('" . $title . "',this.rel,'" . $playerPath . "'); return false;";
                $onmouseover = "window.status=''; return true;";
                $html = '<a class="prod-attach" title="' . $title . '" onmouseover="' . $onmouseover . '" onclick="' . $onclick . '" target="_blank" rel="' . $url . '" href="javascript:;"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else if ($ext == 'mov') {
                $url = $mediaUrl . $url;
                $onclick = "javascript:playerMovOpen('" . $title . "',this.rel); return false;";
                $onmouseover = "window.status=''; return true;";
                $html = '<a class="prod-attach" title="' . $title . '" onmouseover="' . $onmouseover . '" onclick="' . $onclick . '" target="_blank" rel="' . $url . '" href="javascript:;"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else if ($ext == 'wmv' || $ext == 'wav' || $ext == 'mp3') {
                $url = $mediaUrl . $url;
                $onclick = "javascript:playerOpen('" . $title . "',this.rel); return false;";
                $onmouseover = "window.status=''; return true;";
                $html = '<a class="prod-attach" title="' . $title . '" onmouseover="' . $onmouseover . '" onclick="' . $onclick . '" target="_blank" rel="' . $url . '" href="javascript:;"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else {
                $mediaIcon = Mage::getBaseUrl('media') . '/custom/upload/icons/plain.png';
                $mediaIconImage = '<span class="attach-img"><img src="' . $mediaIcon . '" alt="View File" style="margin-right: 5px;"/></span>' . (($showTitle) ? '<span class="attach-title">' . $title . '</span>' : '');
                $url = $this->getDownloadFileUrl($url, $disposition);
                $onclick = "return fileUploaderPopup.open({url:this.rel, title: '" . str_replace(' ', '_', $title) . "'});";
                $html = '<a class="prod-attach" title="' . $title . '" rel="' . $url . '" href="javascript:;" onclick="' . $onclick . '">' . $mediaIconImage . '</a> ';
            }
        } else {
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp') {
                $image = $mediaUrl . $url;
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '" href="' . $url . '"><span class="attach-img"><img src="' . $image . '" id="' . $id . '_image" title="' . $title . '" alt="' . $title . '" height="' . $wh . '" width="' . $wh . '" class="small-image-preview v-middle" style="margin-right: 5px; width: ' . $wh . 'px; height: ' . $wh . 'px"/></span>' . (($showTitle) ? '<span class="attach-title">' . $title . '</span>' : '') . '</a>';
            } else if ($ext == 'txt' || $ext == 'rtf' || $ext == 'csv' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xml' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pdf' || $ext == 'swf' || $ext == 'flv' || $ext == 'zip') {
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '" href="' . $url . '">' . $mediaIconImage . '</a> ';
            } else if ($ext == 'avi') {
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '" href="' . $url . '"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else if ($ext == 'mov') {
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '"href="' . $url . '"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else if ($ext == 'wmv' || $ext == 'wav' || $ext == 'mp3') {
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '" href="' . $url . '"><span style="font-weight:bold">' . $mediaIconImage . '</span></a>';
            } else {
                $mediaIcon = Mage::getBaseUrl('media') . '/custom/upload/icons/plain.png';
                $mediaIconImage = '<span class="attach-img"><img src="' . $mediaIcon . '" alt="View File" style="margin-right: 5px;"/></span>' . (($showTitle) ? '<span class="attach-title">' . $title . '</span>' : '');
                $url = $this->getDownloadFileUrl($url, $disposition);
                $html = '<a class="prod-attach" target="_blank" title="' . $title . '" href="' . $url . '">' . $mediaIconImage . '</a> ';
            }
        }
        return $html . $fileSize;
    }

    public function getVersionLow() {
        return (version_compare(Mage::getVersion(), '1.4.0', '>='));
    }
}
