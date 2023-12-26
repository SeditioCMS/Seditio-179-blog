<?PHP

/* ====================
Seditio – Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=rss.inc.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Rss Creator
[END_SED]
==================== */

/*
Example of feeds:
rss/pages?c=XX (XX – category code)
rss/comments?id=XX (XX – page ID)
*/

if (!defined('SED_CODE')) {
	die('Wrong URL.');
}

/* ===============*/

$c = sed_import('c', 'G', 'TXT');
$m = sed_import('m', 'G', 'ALP');
$id = sed_import('id', 'G', 'INT');
$q = sed_import('q', 'G', 'INT');
$s = sed_import('s', 'G', 'INT');

$c = empty($c) ? $cfg['rss_defaultcode'] : $c;

if ($cfg['disable_rss']) {
	exit();
}

$items = array();

// RSS output
header("Content-type: text/xml; charset=" . $cfg['charset']);

if ($usr['id'] == 0) {
	$name = mb_substr(md5($m . $c . $id . $q . $s), 0, 10);
	$cache = sed_cache_get("rss_" . $name);
	if ($cache) {
		echo $cache; // output cache if avaiable
		exit();
	}
}

$rss_title = $cfg['maintitle'];
$rss_link = $cfg['mainurl'];
$rss_description = $cfg['subtitle'];

/* === Hook === */
$extp = sed_getextplugins('rss.create');
if (is_array($extp)) {
	foreach ($extp as $k => $pl) {
		include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
	}
}
/* ===== */

switch ($m) {
	case "comments":

		if ($cfg['disable_comments'] || $cfg['disable_rsscomments']) {
			$i = 0;
			break;
		}

		$sql = sed_sql_query("SELECT * FROM $db_pages WHERE page_id='$id' LIMIT 1");
		if (sed_sql_numrows($sql) > 0) {
			$row = sed_sql_fetchassoc($sql);

			if (sed_auth('page', $row['page_cat'], 'R')) {
				$rss_title = $L['rss_lastcomments'] . " – " . $row['page_title'] . " – " . $cfg['maintitle'];
				$rss_description = $row['page_desc'];

				$sql1 = sed_sql_query("SELECT c.*, u.user_avatar FROM $db_com AS c
				LEFT JOIN $db_users AS u ON u.user_id=c.com_authorid
				WHERE com_code='p$id' ORDER BY com_date DESC LIMIT " . $cfg['rss_maxitems']);

				$i = 0;

				while ($row1 = sed_sql_fetchassoc($sql1)) {
					$items[$i]['title'] = $L['rss_commentauthor'] . " – " . sed_cc($row1['com_author']);

					$row1['com_text'] = sed_parse($row1['com_text']);

					$items[$i]['description'] = $row1['com_text'];

					$page_url = empty($row['page_alias']) ? sed_url("page", "id=" . $id . "&comments=1&b=" . $row1['com_id'], "#c" . $row1['com_id'], false, false) : sed_url("page", "al=" . $row['page_alias'] . "&comments=1&b=" . $row1['com_id'], "#c" . $row1['com_id'], false, false);

					$items[$i]['link'] = $cfg['mainurl'] . "/" . $page_url;
					$items[$i]['pubDate'] = date('r', $row1['com_date']);
					$i++;
				}
			}
		}

		break;

		//pages

		default:

		if ($cfg['disable_page'] || $cfg['disable_rsspages']) {
			$i = 0;
			break;
		}

		$mtch = $sed_cat[$c]['path'] . ".";
		$mtchlen = mb_strlen($mtch);
		$catsub = array();
		$catsub[] = $c;

		foreach ($sed_cat as $k => $x) {
			if (mb_substr($x['path'], 0, $mtchlen) == $mtch && sed_auth('page', $k, 'R')) {
				$catsub[] = $k;
			}
		}

		$sql = sed_sql_query("SELECT page_id, page_alias, page_title, page_text, page_text2, page_cat, page_date FROM $db_pages 
	WHERE page_state=0 AND page_cat NOT LIKE 'system' AND page_cat IN ('" . implode("','", $catsub) . "') 
	ORDER by page_date DESC LIMIT " . $cfg['rss_maxitems']);

		$rss_title = $sed_cat[$c]['title'] . " – " . $cfg['maintitle'];
		$rss_description = (!empty($sed_cat[$c]['desc'])) ? $sed_cat[$c]['desc'] : $rss_description;
		$i = 0;

		while ($row = sed_sql_fetchassoc($sql)) {

			$sys['catcode'] = $row['page_cat']; //new in v175

			$row['page_pageurl'] = (empty($row['page_alias'])) ? sed_url("page", "id=" . $row['page_id'], "", false, false) : sed_url("page", "al=" . $row['page_alias'], "", false, false);

			$row['page_text'] = sed_parse($row['page_text']);

			$row['page_text'] = sed_cutreadmore($row['page_text'], $row['page_pageurl']);

			$items[$i]['title'] = $row['page_title'];
			$items[$i]['link'] = $cfg['mainurl'] . "/" . $row['page_pageurl'];
			$items[$i]['pubDate'] = date('r', $row['page_date']);
			$items[$i]['description'] = $row['page_text'];

			$i++;
		}

		break;
}

/* output */

$out = "<?xml version='1.0' encoding='" . $cfg['charset'] . "'?>\n";
$out .= "<rss version='2.0'>\n";
$out .= "<channel>\n";
$out .= "<title>" . htmlspecialchars($rss_title) . "</title>\n";
$out .= "<link>" . $rss_link . "</link>\n";
$out .= "<description>" . htmlspecialchars($rss_description) . "</description>\n";
$out .= "<generator>Seditio</generator>\n";
$out .= "<pubDate>" . date("r", time()) . "</pubDate>\n";

if (count($items) > 0) {
	foreach ($items as $item) {
		$out .= "<item>\n";
		$out .= "<title>" . htmlspecialchars($item['title']) . "</title>\n";
		$out .= "<description><![CDATA[" . sed_rel2abs($item['description']) . "]]></description>\n";
		$out .= "<pubDate>" . $item['pubDate'] . "</pubDate>\n";
		$out .= "<link><![CDATA[" . sed_rel2abs(str_replace('&amp;', '&', $item['link'])) . "]]></link>\n";
		$out .= "</item>\n";
	}
}

$out .= "</channel>\n";
$out .= "</rss>";

/* === Hook === */
$extp = sed_getextplugins('rss.output');
if (is_array($extp)) {
	foreach ($extp as $k => $pl) {
		include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
	}
}
/* ===== */

if ($usr['id'] == 0 && $i > 0) {
	$name = mb_substr(md5($m . $c . $id . $q . $s), 0, 10);
	sed_cache_store("rss_" . $name, $out, $cfg['rss_timetolive']);
}

echo $out;
