<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2013 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Infusion: News
| Filename: infusion.php
| Version: 1.0
| Author: PHP-Fusion Web Team Dev 8
| Web: 8.php-fusion.net
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

include INFUSIONS."news_infusion/infusion_db.php";

if (file_exists(INFUSIONS."news_infusion/locale/".$settings['locale'].".php")) {
    include INFUSIONS."news_infusion/locale/".$settings['locale'].".php";
} else {
    include INFUSIONS."news_infusion/locale/English.php";
}

$inf_title = $locale['news_100'];
$inf_description = $locale['news_101'];
$inf_version = "1.00";
$inf_developer = "PHP-Fusion 8 Development Team";
$inf_email = "";
$inf_weburl = "http://www.php-fusion.co.uk";
$inf_folder = "news_infusion";


// Infuse Create Table if Not Exist
$inf_newtable[1] = DB_NEWS_SET." (
	news_set_id mediumint(8) NOT NULL AUTO_INCREMENT, 
	news_set_news_per_page tinyint(3) NOT NULL DEFAULT '16', 
	news_set_news_showcase tinyint(1) NOT NULL DEFAULT '1', 
	news_set_news_column tinyint(1) NOT NULL DEFAULT '2', 
	news_set_template varchar(200) NOT NULL DEFAULT 'default', 
	news_set_user_log mediumint(8) NOT NULL, 
	news_set_log text NOT NULL,
	news_set_datestamp int(10) NOT NULL, 
	news_set_news_custom_right text NOT NULL, 
	PRIMARY KEY (news_set_id)
) ENGINE=MyISAM ;";


$inf_newtable[2] = DB_NEWS." (
	news_id mediumint(8) NOT NULL AUTO_INCREMENT, 
	news_enable tinyint(3) NOT NULL, 
	news_subject varchar(200) NOT NULL, 
	news_tags text NOT NULL, 
	news_image varchar(100) NOT NULL, 
	news_cat mediumint(8) NOT NULL,
  	news_teaser text NOT NULL, 
  	news_body text NOT NULL, 
  	news_datestamp int(10) NOT NULL, 
  	news_start_date int(10) NOT NULL, 
  	news_end_date int(10) NOT NULL, 
  	news_degrade_date int(10) NOT NULL, 
  	news_meta text NOT NULL, 
  	news_keywords text NOT NULL, 
  	news_author varchar(100) NOT NULL, 
  	news_rights tinyint(10) NOT NULL, 
  	news_source text NOT NULL, 
  	news_reads tinyint(10) NOT NULL, 
  	news_access text NOT NULL, 
  	news_visibility tinyint(3) NOT NULL, 
  	news_priority tinyint(3) NOT NULL, 
  	news_allow_comments tinyint(3) NOT NULL, 
  	news_allow_ratings tinyint(3) NOT NULL, 
  	news_allow_poll tinyint(3) NOT NULL, 
  	news_poll_name varchar(200) NOT NULL, 
  	news_poll_start_date tinyint(10) NOT NULL, 
  	news_poll_end_date tinyint(10) NOT NULL, 
  	news_poll_options text NOT NULL, 
  	PRIMARY KEY (news_id)
) ENGINE=MyISAM ;";


$inf_newtable[3] = DB_NEWS_CATS." (
  news_cat_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  news_cat_name varchar(100) NOT NULL DEFAULT '',
  news_cat_image varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (news_cat_id)
) ENGINE=MyISAM ;";


$inf_newtable[4] = DB_NEWS_COMMENTS." (
	news_comment_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  	news_comment_item_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  	news_comment_name varchar(50) NOT NULL DEFAULT '',
  	news_comment_message text NOT NULL,
  	news_comment_datestamp int(10) unsigned NOT NULL DEFAULT '0',
  	news_comment_ip varchar(45) NOT NULL DEFAULT '',
  	news_comment_ip_type tinyint(1) unsigned NOT NULL DEFAULT '4',
  	news_comment_hidden tinyint(1) unsigned NOT NULL DEFAULT '0',
  	PRIMARY KEY (news_comment_id)
) ENGINE=MyISAM ;";

$inf_newtable[5] = DB_NEWS_POLL." (
  news_poll_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  news_poll_item_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  news_poll_user tinyint(8) NOT NULL,
  news_poll_answer tinyint(3) NOT NULL,
  news_poll_datestamp text NOT NULL,
  news_poll_ip varchar(45) NOT NULL DEFAULT '',
  news_poll_ip_type tinyint(1) unsigned NOT NULL DEFAULT '4',
  PRIMARY KEY (news_poll_id)
) ENGINE=MyISAM ;";

## Administration Panel 

$inf_adminpanel[1] = array(
	"title" => $locale['news_100'],
	"image" => "news.png",
	"panel" => "admin/news.php", 
	"rights" => "N"
);

## Insert Site Links
$inf_sitelink[1] = array(
	"title" => $locale['news_100'],
	"url" => "news.php",
	"visibility" => "0"
);

$inf_sitelink[2] = array(
	"title" => $locale['news_101'],
	"url" => "news_cats.php",
	"visibility" => "0"
);




## Defusing Information
// Note: The rights to go for .N and .NC assign to users are done automatically by PHP-Fusion. Not related to this SDK.
$inf_deldbrow[1] = DB_ADMIN." WHERE admin_rights = 'N'";
$inf_deldbrow[2] = DB_ADMIN." WHERE admin_rights = 'NC'";
$inf_deldbrow[3] = DB_SITE_LINKS." WHERE link_url = '".INFUSIONS."news_infusion/news.php'";
$inf_deldbrow[4] = DB_SITE_LINKS." WHERE link_url = '".INFUSIONS."news_infusion/news_cats.php'";
$inf_deldbrow[5] = DB_SETTINGS_INF." WHERE settings_inf='".$inf_folder."'";

// DROP TABLES
$inf_droptable[1] = DB_NEWS_SET;
$inf_droptable[2] = DB_NEWS;
$inf_droptable[3] = DB_NEWS_CATS;
$inf_droptable[4] = DB_NEWS_COMMENTS;
$inf_droptable[5] = DB_NEWS_POLL;

?>