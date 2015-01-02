<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
//require_once 'Mage/Adminhtml/Block/Widget/Grid/Column/Renderer/Action.php';

class Uni_Fileuploader_Block_Adminhtml_Widget_Grid_Column_Renderer_File extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        return $this->_getValue($row);
    }

    protected function _getValue(Varien_Object $row) {
        $dored = false;
        $out = '';
        if ($getter = $this->getColumn()->getGetter()) {
            $val = $row->$getter();
        }        
        $rowarr = $row->toArray();
        $disp = ((array_key_exists('content_disp', $rowarr)) ? $row->getContentDisp() : 0);
        $val = $row->getData($this->getColumn()->getIndex());
        if (preg_match("/^http\:\/\/|https\:\/\//", $val)) {
            $url = $val;
        }else{
            $url = Mage::helper('fileuploader')->getDownloadFileUrl($val, $disp);
        }
        if ($disp) {
            $popLink = "popWin('$url','image','width=800,height=600,resizable=yes,scrollbars=yes')";
            $out = '<a href="javascript:;" onclick="' . $popLink . '">' . $val . '</a>';
        } else {
            $out = '<a href="' . $url . '">' . $val . '</a>';
        }
        return $out;
    }

}