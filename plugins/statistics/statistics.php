<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plugins/statistics/statistics.php
Version=179
Updated=2022-aug-03
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=statistics
Part=main
File=statistics
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE') || !defined('SED_PLUG')) { die('Wrong URL.'); }

$s = sed_import('s','G','TXT');
$m = sed_import('m','G','TXT');

if ($m == 'share')
	{
	$output = "Seditio - Website engine<br />Copyright Neocrome & Seditio Team<br />";
	$output .= "<a href=\"https://seditiocms.com\">https://seditiocms.com</a><br />";
	$output .= "&nbsp;<br />[BEGIN_SED]<br />Title=".$cfg['maintitle']."<br />";
	$output .= "Subtitle=".$cfg['subtitle']."<br />Version=".$cfg['version']."<br />";
	$output .= "Pages=".sed_sql_rowcount($db_pages)."<br />Users=".sed_sql_rowcount($db_users)."<br />";
	$output .= "Pms=".sed_stat_get('totalpms')."<br />Forum_views=".$totaldbviews."<br />";
	$output .= "[END_SED]<br />&nbsp;";
	die($output);
	}

$plugin_title = $L['plu_title'];

$totaldbpages = sed_sql_rowcount($db_pages);
$totaldbcomments = sed_sql_rowcount($db_com);
$totaldbratings = sed_sql_rowcount($db_ratings);
$totaldbratingsvotes = sed_sql_rowcount($db_rated);
$totaldbpolls = sed_sql_rowcount($db_polls);
$totaldbpollsvotes = sed_sql_rowcount($db_polls_voters);
$totaldbfiles = sed_sql_rowcount($db_pfs);
$totaldbusers = sed_sql_rowcount($db_users);

$totalpages = sed_stat_get('totalpages');
$totalmailsent = sed_stat_get('totalmailsent');
$totalpmsent = sed_stat_get('totalpms');

$totaldbfilesize = sed_sql_query("SELECT SUM(pfs_size) FROM $db_pfs");
$totaldbfilesize = sed_sql_result($totaldbfilesize, 0, "SUM(pfs_size)");

$totalpmactive = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state<2");
$totalpmactive = sed_sql_result($totalpmactive, 0, "COUNT(*)");

$totalpmarchived = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state=2");
$totalpmarchived = sed_sql_result($totalpmarchived, 0, "COUNT(*)");

$totalpmold = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state=3");
$totalpmold = sed_sql_result($totalpmold, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT stat_name FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_name ASC LIMIT 1");
$row = sed_sql_fetchassoc($sql);
$since = $row['stat_name'];

$sql = sed_sql_query("SELECT * FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_value DESC LIMIT 1");
$row = sed_sql_fetchassoc($sql);
$max_date = $row['stat_name'];
$max_hits = $row['stat_value'];


if ($s == 'usercount')
	{
	$sql1 = sed_sql_query("DROP TEMPORARY TABLE IF EXISTS tmp1");
	$sql = sed_sql_query("CREATE TEMPORARY TABLE tmp1 SELECT user_country, COUNT(*) as usercount FROM $db_users GROUP BY user_country");
	$sql = sed_sql_query("SELECT * FROM tmp1 WHERE 1 ORDER by usercount DESC");
	$sql1 = sed_sql_query("DROP TEMPORARY TABLE IF EXISTS tmp1");
	}
else
	{
	$sql = sed_sql_query("SELECT user_country, COUNT(*) as usercount FROM $db_users GROUP BY user_country ASC");
	}

$sqltotal = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE 1");
$totalusers = sed_sql_result($sqltotal, 0, "COUNT(*)");

$ii = 0;

while ($row = sed_sql_fetchassoc($sql))
	{
	$country_code = $row['user_country'];

	if (!empty($country_code) && $country_code != '00')
		{
		$ii = $ii + $row['usercount'];
		$t->assign(array(
			"PLUGIN_STATISTICS_COUNTRY_FLAG" => sed_build_flag($country_code),
			"PLUGIN_STATISTICS_COUNTRY_COUNT" => $row['usercount'],
			"PLUGIN_STATISTICS_COUNTRY_NAME" => sed_build_country($country_code)
		));
		$t->parse('MAIN.PLUGIN_STATISTICS_ROW_COUNTRY');
		}
	}

// ---------- Breadcrumbs
$urlpaths = array();
$urlpaths[sed_url("plug", "e=statistics")] = $L['plu_title'];	

$t->assign(array(
	"PLUGIN_STATISTICS_TITLE" => $L['plu_title'],
	"PLUGIN_STATISTICS_BREADCRUMBS" => sed_breadcrumbs($urlpaths),
	"PLUGIN_STATISTICS_PLU_URL" => sed_url('plug', 'e=statistics'),
	"PLUGIN_STATISTICS_SORT_BY_USERCOUNT" => sed_url('plug', 'e=statistics&s=usercount'),
	"PLUGIN_STATISTICS_MAX_DATE" => $max_date,
	"PLUGIN_STATISTICS_MAX_HITS" => $max_hits,
	"PLUGIN_STATISTICS_SINCE" => $since,
	"PLUGIN_STATISTICS_TOTALPAGES" => $totalpages,
	"PLUGIN_STATISTICS_TOTALDBUSERS" => $totaldbusers,
	"PLUGIN_STATISTICS_TOTALDBPAGES" => $totaldbpages,
	"PLUGIN_STATISTICS_TOTALDBCOMMENTS" => $totaldbcomments,
	"PLUGIN_STATISTICS_TOTALMAILSENT" => $totalmailsent,
	"PLUGIN_STATISTICS_TOTALPMSENT" => $totalpmsent,
	"PLUGIN_STATISTICS_TOTALPMACTIVE" => $totalpmactive,
	"PLUGIN_STATISTICS_TOTALPMARCHIVED" => $totalpmarchived,
	"PLUGIN_STATISTICS_TOTALDBVIEWS" => $totaldbviews,
	"PLUGIN_STATISTICS_TOTALDBRATINGS" => $totaldbratings,
	"PLUGIN_STATISTICS_TOTALDBRATINGSVOTES" => $totaldbratingsvotes,
	"PLUGIN_STATISTICS_TOTALDBPOLLS" => $totaldbpolls,
	"PLUGIN_STATISTICS_TOTALDBPOLLSVOTES" => $totaldbpollsvotes,
	"PLUGIN_STATISTICS_TOTALDBFILES" => $totaldbfiles,
	"PLUGIN_STATISTICS_TOTALDBFILESIZE" => floor($totaldbfilesize / 1024),
	"PLUGIN_STATISTICS_UNKNOWN_COUNT" => $totalusers - $ii,
	"PLUGIN_STATISTICS_TOTALUSERS" => $totalusers
));

?>
