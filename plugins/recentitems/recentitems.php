<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/recentitems/recentitems.php
Version=179
Updated=2013-jul-08
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=recentitems
Part=main
File=recentitems
Hooks=index.tags,list.tags,page.tags
Tags=index.tpl:{PLUGIN_LATESTPAGES},{PLUGIN_LATESTTOPICS},{PLUGIN_LATESTPOLL},{PLUGIN_LATESTCOMMENTS}
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

/* ============ MASKS FOR THE HTML OUTPUTS =========== */

include_once("plugins/recentitems/inc/recentitems.inc.php");

$cfg['plu_mask_pages'] = empty($cfg['plu_mask_pages']) ? "%3\$s"." "."%1\$s"." ".$cfg['separator']." "."%2\$s"."<br />" : $cfg['plu_mask_pages'];
// %1\$s = Link to the category
// %2\$s = Link to the page
// %3\$s = Date

$cfg['plu_mask_pages_date'] = "<span class=\"sdate\">{d-m} {H:i}</span>";

$cfg['plu_mask_comments'] = empty($cfg['plu_mask_comments']) ? "%3\$s"." "."%1\$s"." ".$cfg['separator']." "."%5\$s"." ".$cfg['separator']." %2\$s<br />" : $cfg['plu_mask_comments'];
// %1\$s = Link to the comment
// %2\$s = Author
// %3\$s = Date
// %4\$s = User Avatar
// %5\$s = Comments Text

$cfg['plu_mask_comments_date'] = "<span class=\"sdate\">{d-m} {H:i}</span>";

$cfg['plu_mask_polls'] =  empty($cfg['plu_mask_polls']) ? "<div>%1\$s</div>" : $cfg['plu_mask_polls'];

$plu_empty = $L['None']."<br />";

if ($cfg['plugin']['recentitems']['maxpages']>0 && !$cfg['disable_page'])
	{ $latestpages = sed_get_latestpages($cfg['plugin']['recentitems']['maxpages'], $cfg['plu_mask_pages']); }

if ($cfg['plugin']['recentitems']['maxpolls']>0 && !$cfg['disable_polls'])
	{ $latestpoll = sed_get_latestpolls($cfg['plugin']['recentitems']['maxpolls'], $cfg['plu_mask_polls']); }
  
if ($cfg['plugin']['recentitems']['maxcomments']>0 && !$cfg['disable_comments'])
	{ $latestcomments = sed_get_latestcomments($cfg['plugin']['recentitems']['maxcomments'], $cfg['plu_mask_comments']); }  

$t-> assign(array(
	"PLUGIN_LATESTPAGES" => $latestpages,
	"PLUGIN_LATESTPOLL" => $latestpoll,
	"PLUGIN_LATESTCOMMENTS" => $latestcomments  
	));

?>
