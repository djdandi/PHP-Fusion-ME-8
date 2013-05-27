<?php

/*------------------------------------------------
| 	Themes: Gitme
|	Developer: Phpfusion.me
|------------------------------------------------- */

if (!defined("IN_FUSION")) { die("Access Denied"); }


add_to_head("<link rel='stylesheet' href='".THEMES."Gitme/styles2.css' type='text/css' media='screen' />");


define("THEME_BULLET", "<span class='bullet'>&middot;</span>");

require_once INCLUDES."theme_functions_include.php";
require_once THEMES."templates/atomcore.php";

load_bootstrap();

function render_page($license = false) {
	
	global $settings, $main_style, $locale, $mysql_queries_time;

	// API MISSING	
	//echo "<td class='sub-header'>".showsublinks(" ".THEME_BULLET." ", "white")." ".showsubdate()."</td>\n";
	
	echo "<div class='row-fluid' style='padding-bottom:20px;'>\n";
	echo "<div class='span1'>\n</div>\n";
	echo "<div class='span10'>\n";

	$title = "<img src='".IMAGES."phpfusion-small.png'>";
	echo showmenu(1,0,1,$title);

	echo "</div>\n";
	echo "<div class='span1'>\n</div>\n";
	
	echo "</div>\n";
	
	

	echo "<div class='row-fluid' style='margin-top:0px;'>\n";
	echo "<div class='span1'>\n</div>\n";
	echo "<div class='span10'>\n";
	
	// ".showbanners()." // Need to code API for Page Title
	//echo "<div class='row' id='banner'></div>\n";
	
	
	
	
	echo "<div class='row' id='menu'>\n";
	echo showmenu(0,0,0,"");
	echo "</div>\n";
		
	echo "<div class='row' id='content'>\n";
	if (LEFT) { echo "<div class='span2'>".LEFT."</div>"; }
	echo "<div class='span8'>".U_CENTER.CONTENT.L_CENTER."</div>\n";
	if (RIGHT) { echo "<div class='span2'>".RIGHT."</div>\n"; }
	echo "</div>\n";	

	echo "<div class='row' id='footer'>\n";
	echo "<div class='span8 offset2' style='text-align:center;'>".stripslashes($settings['footer'])."<br/>";
	if (!$license) { echo showcopyright(); }
	echo "</div>\n";
	echo "<div class='span2'>".showcounter()."<br/>\n";
	echo showrendertime();
	echo "</div>\n";
	echo "</div>\n";
	

	
	
	
	echo "</div>\n";
	
	
	echo "</div>\n";
	echo "<div class='span1'>\n</div>\n";
	echo "</div></div>\n";
	
	

	
	/*foreach ($mysql_queries_time as $query) {
		echo $query[0]." QUERY: ".$query[1]."<br />";
	}*/

}


































/* New in v7.02 - render comments */
function render_comments($c_data, $c_info){
	global $locale, $settings;
	opentable($locale['c100']);
	if (!empty($c_data)){
		echo "<div class='comments floatfix'>\n";
			$c_makepagenav = '';
			if ($c_info['c_makepagenav'] !== FALSE) { 
			echo $c_makepagenav = "<div style='text-align:center;margin-bottom:5px;'>".$c_info['c_makepagenav']."</div>\n"; 
		}
			foreach($c_data as $data) {
	        $comm_count = "<a href='".FUSION_REQUEST."#c".$data['comment_id']."' id='c".$data['comment_id']."' name='c".$data['comment_id']."'>#".$data['i']."</a>";
			echo "<div class='tbl2 clearfix floatfix'>\n";
			if ($settings['comments_avatar'] == "1") { echo "<span class='comment-avatar'>".$data['user_avatar']."</span>\n"; }
	        echo "<span style='float:right' class='comment_actions'>".$comm_count."\n</span>\n";
			echo "<span class='comment-name'>".$data['comment_name']."</span>\n<br />\n";
			echo "<span class='small'>".$data['comment_datestamp']."</span>\n";
	if ($data['edit_dell'] !== false) { echo "<br />\n<span class='comment_actions'>".$data['edit_dell']."\n</span>\n"; }
			echo "</div>\n<div class='tbl1 comment_message'>".$data['comment_message']."</div>\n";
		}
		echo $c_makepagenav;
		if ($c_info['admin_link'] !== FALSE) {
			echo "<div style='float:right' class='comment_admin'>".$c_info['admin_link']."</div>\n";
		}
		echo "</div>\n";
	} else {
		echo $locale['c101']."\n";
	}
	closetable();   
}

function render_news($subject, $news, $info) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
	echo "<td class='main-body middle-border'>".$info['cat_image'].$news."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer middle-border'>\n";
	echo newsposter($info," &middot;").newscat($info," &middot;").newsopts($info,"&middot;").itemoptions("N",$info['news_id']);
	echo "</td>\n";
	echo "</tr><tr>\n";
	echo "<td style='height:5px;background-color:#f6a504;'></td>\n";
	echo "</tr>\n</table>\n";

}

function render_article($subject, $article, $info) {
	
	echo "<table width='100%' cellpadding='0' cellspacing='0'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
	echo "<td class='main-body middle-border'>".($info['article_breaks'] == "y" ? nl2br($article) : $article)."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo articleposter($info," &middot;").articlecat($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</td>\n</tr>\n</table>\n";

}

function opentable($title) {	
	echo "<div class='row-fluid'><h3 class='title'>\n";
	echo $title;
	echo "</h3></div>\n";
	echo "<div class='row-fluid'>\n";
}

function closetable() {
	echo "</div>\n";
}

function openside($title, $collapse = true, $state = "on") {
	echo "<div class='accordion-group'>\n";
	echo "<div class='accordion-heading side-header'>\n";
	echo "<h4 class='side-title'>$title</h4>";
	
//	data-toggle='collapse' data-target='".$title."-tbl'
	
	echo "</div>\n";
	echo "<div id='".$title."-tbl' class='accordion-body collapse in'>\n";
	echo "<div class='accordion-inner'>\n";
}

function closeside() {
	echo "</div></div></div>";

}
?>
