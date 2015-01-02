<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
//require_once 'Mage/Cms/Model/Wysiwyg/Config.php';

class Uni_Fileuploader_Model_Wysiwyg_Config extends Mage_Cms_Model_Wysiwyg_Config {

    public function getConfig($data = array()) {
        $config = new Varien_Object();

        $config->setData(array(
            'enabled' => $this->isEnabled(),
            'hidden' => $this->isHidden(),
            'use_container' => false,
            'add_variables' => false,
            'add_widgets' => false,
            'no_display' => false,
            'translator' => Mage::helper('fileuploader'),
            'files_browser_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
            'files_browser_window_width' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width'),
            'files_browser_window_height' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height'),
            'encode_directives' => true,
            'directives_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive'),
            'popup_css' => Mage::getBaseUrl('js') . 'mage/adminhtml/wysiwyg/tiny_mce/themes/advanced/skins/default/dialog.css',
            'content_css' => Mage::getBaseUrl('js') . 'mage/adminhtml/wysiwyg/tiny_mce/themes/advanced/skins/default/content.css',
            'width' => '100%',
            'plugins' => array()
        ));

        $config->setData('directives_url_quoted', preg_quote($config->getData('directives_url')));

        if (is_array($data)) {
            $config->addData($data);
        }

        Mage::dispatchEvent('cms_wysiwyg_config_prepare', array('config' => $config));

        return $config;
    }

}