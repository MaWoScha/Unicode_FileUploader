<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('uni_fileuploader')};

CREATE TABLE {$this->getTable('uni_fileuploader')} (
  `fileuploader_id` bigint(20) NOT NULL primary key auto_increment,
  `title` VARCHAR( 255 ) NOT NULL,
  `uploaded_file` varchar(255) default NULL,
  `file_content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_ids` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_status` tinyint(4) NOT NULL default '2',
  `content_disp` tinyint(4) NOT NULL default '0',
  `sort_order` int(11) NOT NULL default '0',
  `update_time` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 