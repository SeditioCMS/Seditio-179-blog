<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=system/functions.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Functions
[END_SED]
==================== */

if (!defined('SED_CODE')) {
	die('Wrong URL.');
}

$cfg = array();
$out = array();
$plu = array();
$sys = array();
$usr = array();

require(SED_ROOT . '/system/config.extensions.php');

/* ======== Urltranslation rules ========= */
require(SED_ROOT . '/system/config.urltranslation.php');

/* ======== Image functions ========= */
require(SED_ROOT . '/system/functions.image.php');

/* ======== Xtemplate class ========= */
require(SED_ROOT . '/system/templates.php');

/* ======== Pre-sets ========= */

$i = explode(' ', microtime());
$sys['starttime'] = $i[1] + $i[0];

unset($warnings, $moremetas, $morejavascript, $error_string,  $sed_cat, $sed_smilies, $sed_acc, $sed_catacc, $sed_rights, $sed_config, $sql_config, $sed_usersonline, $sed_plugins, $sed_parser, $sed_groups, $rsedition, $rseditiop, $rseditios, $tcount, $qcount);

// ALL the value below are DEFAULTS, change the value in datas/config.php if needed, NOT HERE.

$cfg['authmode'] = 3; 				// (1:cookies, 2:sessions, 3:cookies+sessions)
$cfg['enablecustomhf'] = TRUE;		// To enable header.$location.tpl and footer.$location.tpl
$cfg['devmode'] = FALSE;
$cfg['sefurls'] = TRUE;
$cfg['abs_url'] = TRUE;
$cfg['redirmode'] = FALSE;
$cfg['pfs_dir'] = 'datas/users/';
$cfg['av_dir'] = 'datas/avatars/';
$cfg['photos_dir'] = 'datas/photos/';
$cfg['sig_dir'] = 'datas/signatures/';
$cfg['defav_dir'] = 'datas/defaultav/';
$cfg['th_dir'] = 'datas/thumbs/';
$cfg['res_dir'] = 'datas/resized/';
$cfg['font_dir'] = 'datas/fonts/';
$cfg['gd_supported'] = array('jpg', 'jpeg', 'png', 'gif');
$cfg['pagination'] = '<li class="page-item">[ %s ]</li>';
$cfg['pagination_cur'] = '<li class="page-item active"><strong class="page-link">&gt; %s &lt;</strong></li>';
$cfg['pagination_arrowleft'] = "<";
$cfg['pagination_arrowright'] = ">";
$cfg['readmore'] = " <div class=\"readmore\"> %s </div>";
$cfg['pfsmaxuploads'] = 6;
$cfg['textarea_default_width'] = 75;
$cfg['textarea_default_height'] = 16;
$cfg['sqldb'] = 'mysql';
$cfg['sqldbprefix'] = 'sed_';
$cfg['version'] = '179';
$cfg['versions_list'] = array(120, 121, 125, 126, 130, 150, 159, 160, 161, 162, 170, 171, 172, 173, 175, 177, 178, 179);
$cfg['group_colors'] = array('red', 'yellow', 'black', 'blue', 'white', 'green', 'gray', 'navy', 'darkmagenta', 'pink', 'cadetblue', 'linen', 'deepskyblue', 'inherit');
$cfg['separator_symbol'] = "&raquo;";

$cfg['available_image_sizes'] = array(); // array("800x600", "400x300");

$cfg['adminskin'] = "sympfy";

/* Message type:  warning => w, error => e, success => s, info => i */
$cfg['msgtype'] = array(
	'100' => 'e', '101' => 'e', '102' => 'i', '104' => 'i', '105' => 's', '106' => 's', '109' => 's', '113' => 's', '117' => 'i', '118' => 's', '151' => 'e',
	'152' => 'e', '153' => 'e', '157' => 'w', '300' => 's', '400' => 'e', '401' => 'e', '403' => 'e', '404' => 'e', '500' => 'e', '502' => 's', '602' => 'w',
	'603' => 'w', '900' => 'w', '904' => 'w', '907' => 'e', '911' => 'e', '915' => 'e', '916' => 's', '917' => 's', '930' => 'w', '940' => 'w', '950' => 'e'
);

$cfg['msgtype_name'] = array('e' => 'error', 's' => 'success', 'i' => 'info', 'w' => 'warning');

/* ======== Empty default Var ======== */

$out['notices'] = '';
$out['subdesc'] = '';
$out['subkeywords'] = '';
$morejavascript = '';
$moremetas = '';
$sys['abs_url'] = '';
$sys['sublocation'] = '';
$sys['qcount'] = 0;
$sys['tcount'] = 0;
$error_string = '';
$shield_hammer = 0;

/* ======== Names of the SQL tables ========= */

$sed_dbnames = array('auth', 'banlist', 'cache', 'com', 'core', 'config', 'dic', 'dic_items', 'extra_fields', 'groups', 'groups_users', 'logger', 'menu', 'online', 'pages', 'parser', 'pfs', 'pfs_folders', 'plugins', 'pm', 'polls_options', 'polls', 'polls_voters', 'rated', 'ratings', 'referers', 'smilies', 'stats', 'structure', 'trash', 'users');

foreach ($sed_dbnames as $k => $i) {
	$j = 'db_' . $i;
	$$j = $cfg['sqldbprefix'] . $i;
}

// For compatibility with PHP < 5.2 

if (PHP_VERSION < '5.2.0') {
	function mb_stripos($haystack, $needle, $offset = 0)
	{
		return stripos($haystack, $needle, $offset);
	}

	function mb_stristr($haystack, $needle)
	{
		return stristr($haystack, $needle);
	}

	function mb_strripos($haystack, $needle, $offset = 0)
	{
		return strripos($haystack, $needle, $offset);
	}

	function mb_strstr($haystack, $needle)
	{
		return strstr($haystack, $needle);
	}
}
/* ------------------ */

if (!function_exists('str_split')) {
	function str_split($txt, $length = 1)
	{
		if ($length < 1) {
			return (FALSE);
		}
		$res = array();
		for ($i = 0; $i < mb_strlen($txt); $i += $length) {
			$res[] = mb_substr($txt, $i, $length);
		}
		return ($res);
	}
}

if (!function_exists('set_magic_quotes_runtime')) {
	function set_magic_quotes_runtime($new_setting)
	{
		return true;
	}
}

/** 
 * Add protocol to url
 * 
 * @param string $url Url
 * @param string $scheme Protocol
 * @return string 
 */
function sed_addhttp($url, $scheme = "http://")
{
	if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
		$url = empty(parse_url($url)['scheme']) ? $scheme . ltrim($url, '/') : $url;
	}
	return $url;
}

/** 
 * Strips everything but alphanumeric, hyphens and underscores 
 * 
 * @param mixed $alert Alert text (or arr text & title)
 * @param string $type Alert type 
 * @return string 
 */
function sed_alert($alert, $type = 'i', $close = TRUE)
{
	global $L, $cfg, $out;

	if (is_array($alert) && isset($alert['title'])) {
		$alert_text = "<strong>" . $alert['title'] . "</strong><br />" . $alert['text'];
	} else {
		$alert_text = $alert;
	}

	$alert_icon = isset($out['ic_alert_' . $cfg['msgtype_name'][$type]]) ? "<span class=\"alert-icon\">" . $out['ic_alert_' . $cfg['msgtype_name'][$type]] . "</span>" : '';
	$alert_close = ($close) ? "<button class=\"alert-close\" title=\"" . $L['Close'] . "\">" . $out['ic_close'] . "</button>" : '';

	return "<div class=\"alert alert-" . $cfg['msgtype_name'][$type] . "\">" . $alert_icon . $alert_text . $alert_close . "</div>";
}

/** 
 * Strips everything but alphanumeric, hyphens and underscores 
 * 
 * @param string $text Input 
 * @return string 
 */
function sed_alphaonly($text)
{
	return (preg_replace('/[^a-zA-Z0-9_]/', '', $text));
}

/** 
 * Displays results AJAX request 
 * 
 * Clearing the output buffer and sending a new content generated as a result of the AJAX call. 
 * 
 * @param string $res Result of the AJAX call
 * @param string $ajax Ajax content flag
 * @param string $content_type Content type
 */
function sed_ajax_flush($res, $ajax, $content_type = 'text/html')
{
	if ($ajax) {
		ob_clean();
		sed_sendheaders($content_type);
		echo $res;
		ob_flush();
		exit;
	}
}

/**
 * Generation avatar from first username letter
 *
 * @param int $uid
 * @return array|bool status result
 */
function sed_autogen_avatar($uid)
{
	global $usr, $cfg, $db_pfs, $db_users;

	$sql = sed_sql_query("SELECT * FROM $db_users WHERE user_id='$uid' LIMIT 1");
	if (sed_sql_numrows($sql) == 0) return FALSE;

	$urr = sed_sql_fetchassoc($sql);

	$gen_avatar = sed_gen_letteravatar($urr['user_name'], $uid, (int)$cfg['av_maxy'] / 2, $cfg['av_maxx'], $cfg['av_maxy']);

	if ($gen_avatar['status']) {
		$avatarpath = $gen_avatar['imagepath'];
		$avatar = $gen_avatar['image'];

		$dotpos = mb_strrpos($avatar, ".") + 1;
		$f_extension = mb_strtolower(mb_substr($avatar, $dotpos, 5));

		$uav_size = filesize($avatarpath);
		$sql = sed_sql_query("UPDATE $db_users SET user_avatar='$avatarpath' WHERE user_id='" . $urr['user_id'] . "'");
		$sql = sed_sql_query("DELETE FROM $db_pfs WHERE pfs_file='$avatar'");
		$sql = sed_sql_query("INSERT INTO $db_pfs (pfs_userid, pfs_file, pfs_extension, pfs_folderid, pfs_desc, pfs_size, pfs_count) VALUES (" . (int)$urr['user_id'] . ", '$avatar', '$f_extension', -1, '', " . (int)$uav_size . ", 0)");
		@chmod($avatarpath, 0666);
	}

	return $gen_avatar;
}

/**
 * Returns specific access permissions
 *
 * @param string $area Seditio area
 * @param string $option Option to access
 * @param string $mask Access mask
 * @return mixed
 */
function sed_auth($area, $option, $mask = 'RWA')
{
	global $sys, $usr;

	$mn['R'] = 1;
	$mn['W'] = 2;
	$mn['1'] = 4;
	$mn['2'] = 8;
	$mn['3'] = 16;
	$mn['4'] = 32;
	$mn['5'] = 64;
	$mn['A'] = 128;

	$masks = str_split($mask);
	$res = array();

	foreach ($masks as $k => $ml) {
		if (empty($mn[$ml])) {
			$sys['auth_log'][] = $area . "." . $option . "." . $ml . "=0";
			$res[] = FALSE;
		} elseif ($option == 'any') {
			$cnt = 0;

			if (is_array($usr['auth'][$area])) {
				foreach ($usr['auth'][$area] as $k => $g) {
					$cnt += (($g & $mn[$ml]) == $mn[$ml]);
				}
			}
			$cnt = ($cnt == 0 && $usr['auth']['admin']['a'] && $ml == 'A') ? 1 : $cnt;

			$sys['auth_log'][] = ($cnt > 0) ? $area . "." . $option . "." . $ml . "=1" : $area . "." . $option . "." . $ml . "=0";
			$res[] = ($cnt > 0) ? TRUE : FALSE;
		} else {
			$sys['auth_log'][] = ((isset($usr['auth'][$area][$option]) && $usr['auth'][$area][$option] & $mn[$ml]) == $mn[$ml]) ? $area . "." . $option . "." . $ml . "=1" : $area . "." . $option . "." . $ml . "=0";
			$res[] = ((isset($usr['auth'][$area][$option]) && $usr['auth'][$area][$option] & $mn[$ml]) == $mn[$ml]) ? TRUE : FALSE;
		}
	}
	if (count($res) == 1) {
		return ($res[0]);
	} else {
		return ($res);
	}
}

/**
 * Builds Access Control List for a specific user
 *
 * @param int $userid User ID
 * @param int $maingrp User main group
 * @return array
 */
function sed_auth_build($userid, $maingrp = 0)
{
	global $db_auth, $db_groups_users;

	$groups = array();
	$authgrid = array();
	$tmpgrid = array();

	if ($userid == 0 || $maingrp == 0) {
		$groups[] = 1;
	} else {
		$groups[] = $maingrp;
		$sql = sed_sql_query("SELECT gru_groupid FROM $db_groups_users WHERE gru_userid='$userid'");

		while ($row = sed_sql_fetchassoc($sql)) {
			$groups[] = $row['gru_groupid'];
		}
	}

	$sql_groups = implode(',', $groups);
	$sql = sed_sql_query("SELECT auth_code, auth_option, auth_rights FROM $db_auth WHERE auth_groupid IN (" . $sql_groups . ") ORDER BY auth_code ASC, auth_option ASC");

	$i = 0;
	while ($row = sed_sql_fetchassoc($sql)) {
		$i++;
		@$authgrid[$row['auth_code']][$row['auth_option']] |= $row['auth_rights'];
	}

	return ($authgrid);
}

/**
 * Clears user permissions cache
 *
 * @param mixed $id User ID or 'all'
 * @return int
 */
function sed_auth_clear($id = 'all')
{
	global $db_users;

	if ($id == 'all') {
		$sql = sed_sql_query("UPDATE $db_users SET user_auth='' WHERE 1");
	} else {
		$sql = sed_sql_query("UPDATE $db_users SET user_auth='' WHERE user_id='$id'");
	}
	return (sed_sql_affectedrows());
}

/** 
 * Block user if he is not allowed to access the page 
 * 
 * @param bool $allowed Authorization result 
 * @return bool 
 */
function sed_block($allowed)
{
	if (!$allowed) {
		global $sys;
		sed_redirect(sed_url("message", "msg=930&" . $sys['url_redirect'], "", true));
	}
	return (FALSE);
}

/** 
 * Block guests from viewing the page 
 * 
 * @return bool 
 */
function sed_blockguests()
{
	global $usr, $sys;

	if ($usr['id'] < 1) {
		sed_redirect(sed_url("message", "msg=930&" . $sys['url_redirect'], "", true));
	}
	return (FALSE);
}

/** 
 * Builds a javascript function for text insertion 
 * 
 * @param string $c1 Form name 
 * @param string $c2 Field name 
 * @return string 
 */
function sed_build_addtxt($c1, $c2)
{
	$result = "
	function addtxt(text)
	{
	document." . $c1 . "." . $c2 . ".value  += text;
	document." . $c1 . "." . $c2 . ".focus();
	}
	";
	return ($result);
}

/** 
 * Calculates age out of D.O.B. 
 * 
 * @param int $birth Date of birth as UNIX timestamp 
 * @return int|string 
 */
function sed_build_age($birth)
{
	global $sys;

	if ($birth == 1) {
		return ('?');
	}

	$day1 = @date('d', $birth);
	$month1 = @date('m', $birth);
	$year1 = @date('Y', $birth);

	$day2 = @date('d', $sys['now_offset']);
	$month2 = @date('m', $sys['now_offset']);
	$year2 = @date('Y', $sys['now_offset']);

	$age = ($year2 - $year1) - 1;

	if ($month1 < $month2 || ($month1 == $month2 && $day1 <= $day2)) {
		$age++;
	}

	if ($age < 0) {
		$age += 136;
	}

	return ($age);
}

/** 
 * Builds category path 
 * 
 * @param string $cat Category code 
 * @param string $mask Format mask 
 * @return string 
 */
function sed_build_catpath($cat, $mask)
{
	global $sed_cat, $cfg;

	$pathcodes = explode('.', $sed_cat[$cat]['path']);
	$tmp = array();
	foreach ($pathcodes as $k => $x) {
		if ($x != 'system') {
			$tmp[] = sprintf($mask, sed_url("list", "c=" . $x), $sed_cat[$x]['title']);
		}
	}

	$result = (count($tmp) > 0) ? implode(' ' . $cfg['separator'] . ' ', $tmp) : '';
	return ($result);
}

/** 
 * Builds comments 
 * 
 * @param string $code Item code 
 * @param string $url Base url 
 * @param int $display Display comments on page
 * @param bool $allow Enable or disable comments an item  
 * @return array 
 */
function sed_build_comments($code, $url, $display, $allow = TRUE)
{
	global $db_com, $db_users, $db_pages, $cfg, $out, $usr, $L, $sys, $skin, $flocation;

	$flocation = 'Comments';

	$n = sed_import('n', 'G', 'ALP');
	$a = sed_import('a', 'G', 'ALP');
	$b = sed_import('b', 'G', 'INT');
	$quote = sed_import('quote', 'G', 'INT');
	//$cm = sed_import('cm', 'G', 'INT');  
	$d = sed_import('d', 'G', 'INT');

	$error_string = '';

	$wd = (is_null($d) && empty($b)) ? TRUE : FALSE;

	//fix for sed_url()
	if (is_array($url)) {
		$url_part = $url['part'];
		$url_params = $url['params'];
	} else {
		$url = str_replace('&amp;', '&', $url);
		$url_part = mb_substr($url, 0, mb_strpos($url, '.php'));
		$url_params = mb_substr($url, mb_strpos($url, '?') + 1, mb_strlen($url));
	}
	//--------
	$lurl = ($cfg['showcommentsonpage']) ? "" : "&comments=1";
	//-------- 

	if (!empty($b)) {
		$before_after = ($cfg['commentsorder'] == "DESC") ? ">" : "<";
		$sql = sed_sql_query("SELECT COUNT(*) FROM $db_com WHERE com_code='$code' AND com_id " . $before_after . " '$b'");
		$com_before_after = sed_sql_result($sql, 0, "COUNT(*)");
		$d = $cfg['maxcommentsperpage'] * floor($com_before_after / $cfg['maxcommentsperpage']);
	}

	$d = empty($d) ? 0 : (int)$d;

	list($usr['auth_read_com'], $usr['auth_write_com'], $usr['isadmin_com']) = sed_auth('comments', 'a');
	sed_block($usr['auth_read_com']);

	if ($cfg['disable_comments'] || !$usr['auth_read_com']) {
		return (array('', '', ''));
	}

	// ---------- Extra fields - getting
	$extrafields = array();
	$extrafields = sed_extrafield_get('com');
	$number_of_extrafields = count($extrafields);

	// ----------------------

	if ($display) {
		if ($n == 'send' && $usr['auth_write_com'] && $allow) {
			sed_shield_protect();

			$rtext = sed_import('rtext', 'P', 'HTM');

			// --------- Extra fields     
			if ($number_of_extrafields > 0) $newcommentextrafields = sed_extrafield_buildvar($extrafields, 'r', 'com');
			// ----------------------			

			/* == Hook for the plugins == */
			$extp = sed_getextplugins('comments.send.first');
			if (is_array($extp)) {
				foreach ($extp as $k => $pl) {
					include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
				}
			}
			/* ===== */

			$error_string .= (mb_strlen($rtext) < 2) ? $L['com_commenttooshort'] . "<br />" : '';
			$error_string .= (mb_strlen($rtext) > $cfg['maxcommentlenght']) ? $L['com_commenttoolong'] . "<br />" : '';

			if (empty($error_string)) {

				// ------ Extra fields 
				if (count($extrafields) > 0) {
					foreach ($extrafields as $i => $row) {
						$ssql_extra_columns .= ', com_' . $row['code'];
						$ssql_extra_values .= ", '" . sed_sql_prep($newcommentextrafields['com_' . $row['code']]) . "'";
					}
				}
				// ----------------------

				$sql = sed_sql_query("INSERT INTO $db_com 
						(com_code, 
						com_author, 
						com_authorid, 
						com_authorip, 
						com_text, 
						com_date" . $ssql_extra_columns . ") 
					VALUES 
						('" . sed_sql_prep($code) . "', 
						'" . sed_sql_prep($usr['name']) . "', 
						" . (int)$usr['id'] . ", 
						'" . $usr['ip'] . "', 
						'" . sed_sql_prep($rtext) . "', 
						" . (int)$sys['now_offset'] . $ssql_extra_values . ")");

				if (mb_substr($code, 0, 1) == 'p') {
					$page_id = mb_substr($code, 1, 10);
					$sql = sed_sql_query("UPDATE $db_pages SET page_comcount='" . sed_get_comcount($code) . "' WHERE page_id='" . $page_id . "'");
				}

				/* == Hook for the plugins == */
				$extp = sed_getextplugins('comments.send.new');
				if (is_array($extp)) {
					foreach ($extp as $k => $pl) {
						include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
					}
				}
				/* ===== */

				sed_shield_update(20, "New comment");
				sed_redirect(sed_url($url_part, $url_params . $lurl, "", true));
				exit;
			}
		}

		if ($n == 'delete') {
			sed_check_xg();

			$sql = sed_sql_query("SELECT * FROM $db_com WHERE com_id='$b' LIMIT 1");
			$row = sed_sql_fetchassoc($sql);

			$time_limit = ($sys['now_offset'] < ($row['com_date'] + $cfg['maxtimeallowcomedit'] * 60)) ? TRUE : FALSE;
			$usr['isowner_com'] = ($row['com_authorid'] == $usr['id'] && $time_limit);
			$usr['allow_edit_com'] = ($usr['isadmin'] || $usr['isowner_com']);

			if (!$usr['allow_edit_com']) {
				$error_string .= $L['com_commentdeleteallowtime'] . "<br />";
			}

			if (empty($error_string)) {
				sed_block($usr['allow_edit_com']);
				if ((sed_sql_numrows($sql) > 0) && ($usr['isowner_com'] || $usr['isadmin_com'])) {
					if ($cfg['trash_comment']) {
						sed_trash_put('comment', $L['Comment'] . " #" . $b . " (" . $row['com_author'] . ")", $b, $row);
					}

					$sql = sed_sql_query("DELETE FROM $db_com WHERE com_id='$b'");

					if (mb_substr($row['com_code'], 0, 1) == 'p') {
						$page_id = mb_substr($row['com_code'], 1, 10);
						$sql = sed_sql_query("UPDATE $db_pages SET page_comcount=" . sed_get_comcount($row['com_code']) . " WHERE page_id=" . $page_id);
					}
					$com_grp = ($usr['isadmin']) ? "adm" : "usr";
					sed_log("Deleted comment #" . $b . " in '" . $code . "'", $com_grp);
				}
				sed_redirect(sed_url($url_part, $url_params . $lurl, "", true));
				exit;
			}
		}

		if ($a == "edit") {
			$sql1 = sed_sql_query("SELECT * FROM $db_com WHERE com_id='$b' LIMIT 1");
			sed_die(sed_sql_numrows($sql1) == 0);

			$row = sed_sql_fetchassoc($sql1);

			$time_limit = ($sys['now_offset'] < ($row['com_date'] + $cfg['maxtimeallowcomedit'] * 60)) ? TRUE : FALSE;
			$usr['isowner_com'] = ($row['com_authorid'] == $usr['id'] && $time_limit);
			$usr['allow_edit_com'] = ($usr['isadmin'] || $usr['isowner_com']);

			if (!$usr['allow_edit_com']) {
				$error_string .= $L['com_commenteditallowtime'] . "<br />";
			}

			if ($n == 'update') {
				sed_check_xg();
				sed_shield_protect();

				$rtext = sed_import('rtext', 'P', 'HTM');

				// --------- Extra fields     
				if ($number_of_extrafields > 0) $rcommentextrafields = sed_extrafield_buildvar($extrafields, 'r', 'com');
				// ----------------------	

				/* == Hook for the plugins == */
				$extp = sed_getextplugins('comments.edit.update.first');
				if (is_array($extp)) {
					foreach ($extp as $k => $pl) {
						include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
					}
				}
				/* ===== */

				$error_string .= (mb_strlen($rtext) < 2) ? $L['com_commenttooshort'] . "<br />" : '';
				$error_string .= (mb_strlen($rtext) > $cfg['maxcommentlenght']) ? $L['com_commenttoolong'] . "<br />" : '';

				if (empty($error_string)) {
					sed_block($usr['allow_edit_com']);

					// ------ Extra fields 
					if (count($extrafields) > 0) {
						foreach ($extrafields as $i => $row) {
							$ssql_extra .= ", com_" . $row['code'] . " = " . "'" . sed_sql_prep($rcommentextrafields['com_' . $row['code']]) . "'";
						}
					}
					// ----------------------	

					$sql3 = sed_sql_query("UPDATE $db_com SET com_text = '" . sed_sql_prep($rtext) . "'" . $ssql_extra . " WHERE com_id='$b'");

					/* == Hook for the plugins == */
					$extp = sed_getextplugins('comments.edit.update.done');
					if (is_array($extp)) {
						foreach ($extp as $k => $pl) {
							include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
						}
					}
					/* ===== */

					unset($rtext);

					$com_grp = ($usr['isadmin']) ? "adm" : "usr";
					sed_log("Edited comment #" . $b . " in '" . $code . "'", $com_grp);
					sed_redirect(sed_url($url_part, $url_params . $lurl . "&b=" . $b, "#c" . $b, true));
					exit;
				}
			}

			$t = new XTemplate(sed_skinfile('comments'));

			/* == Hook for the plugins == */
			$extp = sed_getextplugins('comments.main');
			if (is_array($extp)) {
				foreach ($extp as $k => $pl) {
					include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
				}
			}
			/* ===== */

			if (!empty($error_string)) {
				$t->assign("COMMENTS_ERROR_BODY", $error_string);
				$t->parse("COMMENTS.COMMENTS_ERROR");
			}

			if ($usr['allow_edit_com']) {
				if ($usr['auth_write_com']) {
					$pfs = ($usr['id'] > 0) ? sed_build_pfs($usr['id'], "editcomment", "rtext", $L['Mypfs']) : '';
					$pfs .= (sed_auth('pfs', 'a', 'A')) ? " &nbsp; " . sed_build_pfs(0, "editcomment", "rtext", $L['SFS']) : '';
					$post_main = sed_textarea('rtext', $row['com_text'], 6, $cfg['textarea_default_width'], 'Micro') . " " . $pfs;
				}

				$t->assign(array(
					"COMMENTS_EDIT_CODE" => $code,
					"COMMENTS_EDIT_FORM_ID" => $row['com_id'],
					"COMMENTS_EDIT_FORM_SEND" => sed_url($url_part, $url_params . $lurl . "&a=edit&n=update&b=" . $b . "&" . sed_xg()),
					"COMMENTS_EDIT_FORM_URL" => sed_url($url_part, $url_params . $lurl, "#" . $row['com_id']),
					"COMMENTS_EDIT_FORM_AUTHOR" => $usr['name'],
					"COMMENTS_EDIT_FORM_AUTHORID" => $usr['id'],
					"COMMENTS_EDIT_FORM_TEXT" => $post_main,
					"COMMENTS_EDIT_FORM_MYPFS" => $pfs
				));

				// Extra fields 
				if (count($extrafields) > 0) {
					$extra_array = sed_build_extrafields('com', 'COMMENTS_EDIT_FORM', $extrafields, $row, 'r');
					$t->assign($extra_array);
				}
				// -----------				

				if ($usr['auth_write_com']) {

					/* == Hook for the plugins == */
					$extp = sed_getextplugins('comments.editcomment.tags');
					if (is_array($extp)) {
						foreach ($extp as $k => $pl) {
							include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
						}
					}
					/* ===== */

					$t->parse("COMMENTS.COMMENTS_EDITCOMMENT");
				}
			}
		} else {
			$error_string .= ($n == 'added') ? $L['com_commentadded'] . "<br />" : '';

			$t = new XTemplate(sed_skinfile('comments'));

			/* == Hook for the plugins == */
			$extp = sed_getextplugins('comments.main');
			if (is_array($extp)) {
				foreach ($extp as $k => $pl) {
					include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
				}
			}
			/* ===== */

			if (!empty($error_string)) {
				$t->assign("COMMENTS_ERROR_BODY", sed_alert($error_string, 'e'));
				$t->parse("COMMENTS.COMMENTS_ERROR");
			}

			$pfs = '';
			$post_main = '';

			if ($usr['auth_write_com'] && $allow) {
				$rtext = sed_import('rtext', 'P', 'HTM');
				if ($quote > 0) {
					$sqlq = sed_sql_query("SELECT com_id, com_author, com_text FROM $db_com WHERE com_id = '$quote' LIMIT 1");
					if ($rowq = sed_sql_fetchassoc($sqlq)) {
						$rtext = "<blockquote><a href=\"" . sed_url($url_part, $url_params . $lurl, "#" . $rowq['com_id']) . "\">#" . $rowq['com_id'] . "</a> <strong>" . $rowq['com_author'] . " :</strong><br />" . $rowq['com_text'] . "</blockquote><br />";
					}
				}
				$pfs = ($usr['id'] > 0) ? sed_build_pfs($usr['id'], "newcomment", "rtext", $L['Mypfs']) : '';
				$pfs .= (sed_auth('pfs', 'a', 'A')) ? " &nbsp; " . sed_build_pfs(0, "newcomment", "rtext", $L['SFS']) : '';
				$post_main = sed_textarea('rtext', $rtext, 6, $cfg['textarea_default_width'], 'Micro') . " " . $pfs;
			}

			$t->assign(array(
				"COMMENTS_CODE" => $code,
				"COMMENTS_FORM_SEND" => sed_url($url_part, $url_params . $lurl . "&n=send"),
				"COMMENTS_FORM_AUTHOR" => $usr['name'],
				"COMMENTS_FORM_AUTHORID" => $usr['id'],
				"COMMENTS_FORM_TEXT" => $post_main,
				"COMMENTS_FORM_MYPFS" => $pfs
			));

			// Extra fields 
			if (count($extrafields) > 0) {
				$extra_array = sed_build_extrafields('com', 'COMMENTS_FORM', $extrafields, $newcommentextrafields, 'r');
				$t->assign($extra_array);
			}
			// -----------

			if ($usr['auth_write_com'] && $allow) {

				/* == Hook for the plugins == */
				$extp = sed_getextplugins('comments.newcomment.tags');
				if (is_array($extp)) {
					foreach ($extp as $k => $pl) {
						include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
					}
				}
				/* ===== */

				$t->parse("COMMENTS.COMMENTS_NEWCOMMENT");
			}

			/* ===== */

			$sql = sed_sql_query("SELECT COUNT(*) FROM $db_com AS c
					LEFT JOIN $db_users AS u ON u.user_id=c.com_authorid
					WHERE com_code='$code'");

			$totallines = sed_sql_result($sql, 0, "COUNT(*)");
			$totalpages = ceil($totallines / $cfg['maxcommentsperpage']);

			$currentpage = ceil($d / $cfg['maxcommentsperpage']) + 1;

			$pagination = sed_pagination(sed_url($url_part, $url_params . $lurl), $d, $totallines, $cfg['maxcommentsperpage']);
			list($pageprev, $pagenext) = sed_pagination_pn(sed_url($url_part, $url_params . $lurl), $d, $totallines, $cfg['maxcommentsperpage'], TRUE);

			$t->assign(array(
				"COMMENTS_PAGINATION" => $pagination,
				"COMMENTS_PAGEPREV" => $pageprev,
				"COMMENTS_PAGENEXT" => $pagenext
			));

			/* ===== */

			$sql = sed_sql_query("SELECT c.*, u.user_id, u.user_avatar, u.user_maingrp FROM $db_com AS c
					LEFT JOIN $db_users AS u ON u.user_id=c.com_authorid
					WHERE com_code='$code' ORDER BY com_id " . $cfg['commentsorder'] . " LIMIT $d, " . $cfg['maxcommentsperpage']);

			if (sed_sql_numrows($sql) > 0) {
				$i = 0;

				/* === Hook - Part1 : Set === */
				$extp = sed_getextplugins('comments.loop');
				/* ===== */

				while ($row = sed_sql_fetchassoc($sql)) {
					$row['com_text'] = sed_parse($row['com_text']);
					$i++;
					$com_author = sed_cc($row['com_author']);
					$com_text = "<div id=\"blkcom_" . $row['com_id'] . "\" >" . $row['com_text'] . "</div>";

					$time_limit = ($sys['now_offset'] < ($row['com_date'] + $cfg['maxtimeallowcomedit'] * 60)) ? TRUE : FALSE;
					$usr['isowner_com'] = ($row['com_authorid'] == $usr['id'] && $time_limit);
					$com_gup = $sys['now_offset'] - ($row['com_date'] + $cfg['maxtimeallowcomedit'] * 60);
					$allowed_time = ($usr['isowner_com'] && !$usr['isadmin']) ? " - " . sed_build_timegap($sys['now_offset'] + $com_gup, $sys['now_offset']) . $L['com_gup'] : '';

					$com_quote = ($usr['id'] > 0) ? "<a href=\"" . sed_url($url_part, $url_params . $lurl . "&quote=" . $row['com_id'] . "&" . sed_xg()) . "#nc" . "\" class=\"btn btn-adm\">" . $L['Quote'] . "</a>&nbsp;" : "";

					$com_admin = ($usr['isadmin_com'] || $usr['isowner_com']) ? "<a href=\"" . sed_url($url_part, $url_params . $lurl . "&a=edit&b=" . $row['com_id'] . "&" . sed_xg(), "#c" . $row['com_id']) . "\" title=\"" . $L['Edit'] . $allowed_time . "\" class=\"btn btn-adm\">" . $L['Edit'] . "</a>&nbsp;<a href=\"" . sed_url($url_part, $url_params . $lurl . "&n=delete&b=" . $row['com_id'] . "&" . sed_xg()) . "\" class=\"btn btn-adm\">" . $L['Delete'] . "</a>&nbsp;" . $L['Ip'] . ":" . sed_build_ipsearch($row['com_authorip']) : '';

					$com_authorlink = ($row['com_authorid'] > 0 && $row['user_id'] > 0) ? sed_build_user($row['com_authorid'], $com_author, $row['user_maingrp']) : $com_author;

					$t->assign(array(
						"COMMENTS_ROW_ID" => $row['com_id'],
						"COMMENTS_ROW_ORDER" => $i + $d,
						"COMMENTS_ROW_URL" => sed_url($url_part, $url_params . $lurl . "&b=" . $row['com_id'], "#c" . $row['com_id']),
						"COMMENTS_ROW_AUTHOR" => $com_authorlink,
						"COMMENTS_ROW_AUTHORID" => $row['com_authorid'],
						"COMMENTS_ROW_AVATAR" => sed_build_userimage($row['user_avatar']),
						"COMMENTS_ROW_TEXT" => $com_text,
						"COMMENTS_ROW_DATE" => sed_build_date($cfg['dateformat'], $row['com_date']),
						"COMMENTS_ROW_ODDEVEN" => sed_build_oddeven($i),
						"COMMENTS_ROW_ADMIN" => $com_quote . $com_admin
					));

					// ---------- Extra fields - getting
					if (count($extrafields) > 0) {
						$extra_array = sed_build_extrafields_data('com', 'COMMENTS_ROW', $extrafields, $row);
						$t->assign($extra_array);
					}
					// ----------------------						

					/* === Hook - Part2 : Include === */
					if (is_array($extp)) {
						foreach ($extp as $k => $pl) {
							include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
						}
					}
					/* ===== */

					$t->parse("COMMENTS.COMMENTS_ROW");
				}
			} elseif ($allow) {
				$t->assign(array(
					"COMMENTS_EMPTYTEXT" => $L['com_nocommentsyet']
				));
				$t->parse("COMMENTS.COMMENTS_EMPTY");
			}

			/* === sed 173 */
			if (!$allow) {
				$t->assign(array(
					"COMMENTS_DISABLETEXT" => $L['com_disable']
				));
				$t->parse("COMMENTS.COMMENTS_DISABLE");
			}
			/* === */
		}

		/* == Hook for the plugins == */
		$extp = sed_getextplugins('comments.tags');
		if (is_array($extp)) {
			foreach ($extp as $k => $pl) {
				include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
			}
		}
		/* ===== */

		$t->parse("COMMENTS");
		$res_display = $t->text("COMMENTS");
	} else {
		$res_display = '';
	}

	$res = "<a href=\"" . sed_url($url_part, $url_params . $lurl) . "\">" . $out['ic_comment'];

	if ($cfg['countcomments']) {
		$nbcomment = sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM $db_com where com_code='$code'"), 0, "COUNT(*)");
		$res .= " (" . $nbcomment . ")";
	}
	$res .= "</a>";

	return (array($res, $res_display, $nbcomment));
}


/** 
 * Parsing user signature text 
 * 
 * @param string $text Signature text 
 * @return string 
 */
function sed_build_usertext($text)
{
	global $cfg;
	/*
    $text = sed_cc($text); 
    $text = nl2br($text); 
	*/
	return ($text);
}

/** 
 * Returns country text button 
 * 
 * @param string $flag Country code 
 * @return string 
 */
function sed_build_country($flag)
{
	global $sed_countries;

	$flag = (empty($flag)) ? '00' : $flag;
	$result = "<a href=\"" . sed_url("users", "f=country_" . $flag) . "\">" . $sed_countries[$flag] . "</a>";
	return ($result);
}

/** 
 * Returns date 
 * 
 * @param string $formatmask Date mask
 * @param int $udate Date in UNIX timestamp
 * @param string $mask Custom date mask   
 * @return string
 * @example $mask = "<span class=\"sdate\">{d-m-Y}</span><span class=\"stime\">{H:i}</span>";  
 */
function sed_build_date($dateformat, $udate, $mask = "")
{
	global $usr, $cfg;

	$udate = $udate + $usr['timezone'] * 3600;

	if (!empty($mask)) {
		$mask = preg_replace('#\{(.+?)\}#isu', "{{" . $udate . "}{\$1}}", $mask);
		$result = preg_replace_callback('#\{\{(.+?)\}\{(.+?)\}\}#isu', function ($matches) {
			return @date($matches[2], $matches[1]);
		}, $mask);
		return ($result);
	}

	$result = @date($dateformat, 	$udate);
	return ($result);
}

/** 
 * Returns user email link 
 * 
 * @param string $email E-mail address 
 * @param bool $hide Hide email option 
 * @return string 
 */
function sed_build_email($email, $hide = false)
{
	global $L;
	if ($hide) {
		$result = $L['Hidden'];
	} elseif (!empty($email) && mb_strpos($email, '@') !== FALSE) {
		$email = sed_cc($email);
		$result = "<a href=\"mailto:" . $email . "\">" . $email . "</a>";
	}

	return ($result);
}

/** 
 * Returns country flag button 
 * 
 * @param string $flag Country code 
 * @return string 
 */
function sed_build_flag($flag)
{
	$flag = (empty($flag)) ? '00' : $flag;
	$result = "<a href=\"" . sed_url("users", "f=country_" . $flag) . "\"><img src=\"system/img/flags/f-" . $flag . ".gif\" alt=\"\" /></a>";
	return ($result);
}

/** 
 * List breadcrumbs build path arr
 *
 * @param string $cat Category code  
 */
function sed_build_list_bc($cat)
{
	global $sed_cat, $cfg, $urlpaths;

	$pathcodes = explode('.', $sed_cat[$cat]['path']);
	foreach ($pathcodes as $k => $x) {
		if ($x != 'system') {
			$urlpaths[sed_url("list", "c=" . $x)] = $sed_cat[$x]['title'];
		}
	}
}

/** 
 * Build a link for open popup or modal window for gallery 
 * 
 * @param int $id ID folder is gallery
 * @param string $c1 Form name 
 * @param string $c2 Field name
 * @param string $title Title link  
 * @return string 
 */
function sed_build_gallery($id, $c1, $c2, $title)
{
	return ("<a href=\"javascript:sedjs.gallery('" . $id . "','" . $c1 . "','" . $c2 . "')\">" . $title . "</a>");
}

/** 
 * Returns group link (button) 
 * 
 * @param int $grpid Group ID 
 * @return string 
 */
function sed_build_group($grpid)
{
	global $sed_groups, $L;

	if (empty($grpid)) {
		$res = '';
	} else {
		if ($sed_groups[$grpid]['hidden']) {
			if (sed_auth('users', 'a', 'A')) {
				$res = "<a href=\"" . sed_url("users", "gm=" . $grpid) . "\">" . $sed_groups[$grpid]['title'] . "</a> (" . $L['Hidden'] . ')';
			} else {
				$res = $L['Hidden'];
			}
		} else {
			$res = "<a href=\"" . sed_url("users", "gm=" . $grpid) . "\">" . $sed_groups[$grpid]['title'] . "</a>";
		}
	}
	return ($res);
}

/** 
 * Builds "edit group" option group for "user edit" part 
 * 
 * @param int $userid Edited user ID 
 * @param bool $edit Permission 
 * @param int $maingrp User main group 
 * @return string 
 */
function sed_build_groupsms($userid, $edit = false, $maingrp = 0)
{
	global $db_groups_users, $sed_groups, $L;

	$sql = sed_sql_query("SELECT gru_groupid FROM $db_groups_users WHERE gru_userid='$userid'");

	while ($row = sed_sql_fetchassoc($sql)) {
		$member[$row['gru_groupid']] = true;
	}

	$res = '';
	foreach ($sed_groups as $k => $i) {
		$checked = (isset($member[$k]) && $member[$k]) ? "checked=\"checked\"" : '';
		$checked_maingrp = ($maingrp == $k) ? "checked=\"checked\"" : '';
		$readonly = (!$edit || $k == 1 || $k == 2 || $k == 3 || ($k == 5 && $userid == 1)) ? "disabled=\"disabled\"" : '';
		$readonly_maingrp = (!$edit || $k == 1 || ($k == 2 && $userid == 1) || ($k == 3 && $userid == 1)) ? "disabled=\"disabled\"" : '';

		if ((isset($member[$k]) && $member[$k]) || $edit) {
			if (!($sed_groups[$k]['hidden'] && !sed_auth('users', 'a', 'A'))) {
				$res .= "<span class=\"radio-item\"><input type=\"radio\" class=\"radio\" id=\"rusermaingrp_$k\" name=\"rusermaingrp\" value=\"$k\" " . $checked_maingrp . " " . $readonly_maingrp . " /><label for=\"rusermaingrp_$k\"></label></span>\n";
				$res .= "<span class=\"checkbox-item\"><input type=\"checkbox\" class=\"checkbox\" id=\"rusergroupsms_$k\" name=\"rusergroupsms[$k]\" " . $checked . " $readonly /><label for=\"rusergroupsms_$k\"></label></span>\n";
				$res .= ($k == 1) ? $sed_groups[$k]['title'] : "<a href=\"" . sed_url("users", "g=" . $k) . "\">" . $sed_groups[$k]['title'] . "</a>";
				$res .= ($sed_groups[$k]['hidden']) ? ' (' . $L['Hidden'] . ')' : '';
				$res .= "<br />";
			}
		}
	}

	return ($res);
}

/** 
 * Returns IP Search link 
 * 
 * @param string $ip IP mask 
 * @return string 
 */
function sed_build_ipsearch($ip)
{
	if (!empty($ip)) {
		$result = "<a href=\"" . sed_url("admin", "m=tools&p=ipsearch&a=search&id=" . $ip . "&" . sed_xg()) . "\">" . $ip . "</a>";
	}
	return ($result);
}

/** 
 * Returns Skype call link 
 * 
 * @param string $skype Skype login 
 * @return string 
 */
function sed_build_skype($skype)
{
	$result = '';
	if (!empty($skype)) {
		$skype = sed_cc($skype);
		$result = "<a href=\"skype:" . $skype . "?call\">" . $skype . "</a>";
	}
	return ($result);
}

/** 
 * Odd/even class choser for row 
 * 
 * @param int $number Row number 
 * @return string 
 */
function sed_build_oddeven($number)
{
	if ($number % 2 == 0) {
		return ('even');
	} else {
		return ('odd');
	}
}

/** 
 * Build a link for open popup or modal window for PFS 
 * 
 * @param int $id ID User ID
 * @param string $c1 Form name 
 * @param string $c2 Field name
 * @param string $title Title link  
 * @return string 
 */
function sed_build_pfs($id, $c1, $c2, $title)
{
	global $L, $cfg, $usr, $sed_groups;
	if ($cfg['disable_pfs']) {
		$res = '';
	} else {
		$modal = ($cfg['enablemodal']) ? ',1' : '';
		if ($id == 0) {
			$res = "<a href=\"javascript:sedjs.pfs('0','" . $c1 . "','" . $c2 . "'" . $modal . ")\">" . $title . "</a>";
		} elseif ($sed_groups[$usr['maingrp']]['pfs_maxtotal'] > 0 && $sed_groups[$usr['maingrp']]['pfs_maxfile'] > 0 && sed_auth('pfs', 'a', 'R')) {
			$res = "<a href=\"javascript:sedjs.pfs('" . $id . "','" . $c1 . "','" . $c2 . "'" . $modal . ")\">" . $title . "</a>";
		} else {
			$res = '';
		}
	}
	return ($res);
}

/** 
 * Returns user PM link 
 * 
 * @param int $user User ID 
 * @return string 
 */
function sed_build_pm($user)
{
	global $usr, $cfg, $L, $out;
	$result = "<a href=\"" . sed_url("pm", "m=send&to=" . $user) . "\">" . $out['ic_pm'] . "</a>";
	return ($result);
}

/** 
 * Builds ratings for an item 
 * 
 * @param string $code Item code 
 * @param string $url Base url 
 * @param int $display Display available for edit
 * @param bool $allow Enable or disable ratings an item  
 * @return array 
 */
function sed_build_ratings($code, $url, $display, $allow = true)
{
	global $db_ratings, $db_rated, $db_pages, $db_users, $cfg, $usr, $sys, $L;

	$ajax = sed_import('ajax', 'P', 'BOL');
	$ajax = ($cfg['ajax']) ? $ajax : false;

	list($usr['auth_read_rat'], $usr['auth_write_rat'], $usr['isadmin_rat']) = sed_auth('ratings', 'a');

	if ($cfg['disable_ratings'] || !$usr['auth_read_rat']) {
		return (array('', ''));
	}

	if (is_array($url)) //fix for sed_url()
	{
		$url_part = $url['part'];
		$url_params = $url['params'];
	} else {
		$url = str_replace('&amp;', '&', $url);
		$url_part = mb_substr($url, 0, mb_strpos($url, '.php'));
		$url_params = mb_substr($url, mb_strpos($url, '?') + 1, mb_strlen($url));
	}

	//----------------

	$ina = sed_import('ina', 'G', 'ALP');
	$newrate = sed_import('newrate', 'P', 'INT');

	$alr_rated = sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM " . $db_rated . " WHERE rated_userid=" . $usr['id'] . " AND rated_code = '" . sed_sql_prep($code) . "'"), 0, 'COUNT(*)');

	if ($ina == 'send' && $newrate >= 1 && $newrate <= 10 && $usr['auth_write_rat'] && $alr_rated <= 0 && $allow) {

		$sql = sed_sql_query("SELECT * FROM $db_ratings WHERE rating_code='$code' LIMIT 1");

		if ($row = sed_sql_fetchassoc($sql)) {
			$rating_average = $row['rating_average'];
			$yetrated = TRUE;

			if ($rating_average < 1) {
				$rating_average = 1;
			} elseif ($rating_average > 10) {
				$rating_average = 10;
			}

			$rating_cntround = round($rating_average, 0);
		} else {
			$yetrated = FALSE;
			$rating_average = 0;
			$rating_cntround = 0;
		}

		/* == Hook for the plugins == */
		$extp = sed_getextplugins('ratings.send.first');
		if (is_array($extp)) {
			foreach ($extp as $k => $pl) {
				include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
			}
		}
		/* ===== */

		if (!$yetrated) {
			$sql = sed_sql_query("INSERT INTO $db_ratings (rating_code, rating_state, rating_average, rating_creationdate, rating_text) VALUES ('" . sed_sql_prep($code) . "', 0, " . (int)$newrate . ", " . (int)$sys['now_offset'] . ", '') ");
		}

		$sql = sed_sql_query("INSERT INTO $db_rated (rated_code, rated_userid, rated_value) VALUES ('" . sed_sql_prep($code) . "', " . (int)$usr['id'] . ", " . (int)$newrate . ")");
		$sql = sed_sql_query("SELECT COUNT(*) FROM $db_rated WHERE rated_code='$code'");
		$rating_voters = sed_sql_result($sql, 0, "COUNT(*)");
		$ratingnewaverage = ($rating_average * ($rating_voters - 1) + $newrate) / ($rating_voters);
		$sql = sed_sql_query("UPDATE $db_ratings SET rating_average='$ratingnewaverage' WHERE rating_code='$code'");

		$alr_rated = 1;

		if (mb_substr($code, 0, 1) == 'p') {
			$page_id = mb_substr($code, 1, 10);
			$sql = sed_sql_query("UPDATE $db_pages SET page_rating='$ratingnewaverage' WHERE page_id=" . (int)$page_id);
		}

		/* == Hook for the plugins == */
		$extp = sed_getextplugins('ratings.send.done');
		if (is_array($extp)) {
			foreach ($extp as $k => $pl) {
				include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
			}
		}
		/* ===== */

		if (!$ajax) {
			sed_redirect(sed_url($url_part, $url_params . "&ratings=1&ina=added", "", true));
			exit;
		}
	}

	//----------------

	$sql = sed_sql_query("SELECT * FROM $db_ratings WHERE rating_code='$code' LIMIT 1");

	if ($row = sed_sql_fetchassoc($sql)) {
		$rating_average = $row['rating_average'];
		$yetrated = TRUE;

		if ($rating_average < 1) {
			$rating_average = 1;
		} elseif ($rating_average > 10) {
			$rating_average = 10;
		}

		$rating_cntround = round($rating_average, 0);
	} else {
		$yetrated = FALSE;
		$rating_average = 0;
		$rating_cntround = 0;
	}

	$res = "<div class=\"rating-box\" id=\"rat-" . $code . "\"><ul class=\"rating s" . $rating_cntround . "\">\n";
	for ($i = 1; $i <= 10; $i++) {
		$onclick = "javascript:sedjs.ajax.bind({'url': '" . sed_url($url_part, $url_params . "&ratings=1&display=1&ina=send&ajax=1&newrate=" . $i . "&" . sed_xg()) . "', 'format':  'text', 'method':  'POST', 'update':  'rat-" . $code . "', 'loading': 'rat-" . $code . "'});";
		$res .= "<li class=\"s" . $i . "\"><a href=\"javascript:void(0);\" onClick=\"" . $onclick . "\" title=\"" . $i . " - " . $L['rat_choice' . $i] . "\">" . $i . " - " . $L['rat_choice' . $i] . "</a></li>\n";
	}
	$res .= "</ul></div>";

	if (($usr['id'] == 0) || ($alr_rated > 0) || !$cfg['ajax']) {
		$res = "<a href=\"" . sed_url($url_part, $url_params . "&ratings=1") . "\"><img src=\"skins/" . $usr['skin'] . "/img/system/vote" . $rating_cntround . ".gif\" alt=\"\" /></a>";
	}

	sed_ajax_flush($res, $ajax);  // AJAX Output

	if (!$display) {
		return (array($res, ''));
	}

	$votedcasted = ($ina == 'added') ? 1 : 0;
	$alreadyvoted = FALSE;
	$rate_form = '';

	for ($i = 1; $i <= 10; $i++) {
		$rate_form .= sed_radio_item("newrate", $i, "<img src=\"skins/" . $usr['skin'] . "/img/system/vote" . $i . ".gif\" alt=\"\" /> " . $i . " - " . $L['rat_choice' . $i], $i) . "<br />";
	}

	if ($usr['id'] > 0) {
		$sql1 = sed_sql_query("SELECT rated_value FROM $db_rated WHERE rated_code='$code' AND rated_userid='" . $usr['id'] . "' LIMIT 1");

		if ($row1 = sed_sql_fetchassoc($sql1)) {
			$alreadyvoted = TRUE;
			$rating_uservote = $L['rat_alreadyvoted'] . " (" . $row1['rated_value'] . ")";
		}
	}

	$t = new XTemplate(sed_skinfile('ratings'));

	/* == Hook for the plugins == */
	$extp = sed_getextplugins('ratings.main');
	if (is_array($extp)) {
		foreach ($extp as $k => $pl) {
			include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
		}
	}
	/* ===== */

	if (!empty($error_string)) {
		$t->assign("RATINGS_ERROR_BODY", $error_string);
		$t->parse("RATINGS.RATINGS_ERROR");
	}

	if ($yetrated) {
		$sql = sed_sql_query("SELECT COUNT(*) FROM $db_rated WHERE rated_code='$code' ");
		$rating_voters = sed_sql_result($sql, 0, "COUNT(*)");
		$rating_average = $row['rating_average'];
		$rating_since = $L['rat_since'] . " " . sed_build_date($cfg['dateformat'], $row['rating_creationdate']);

		if ($rating_average < 1) {
			$rating_average = 1;
		} elseif ($rating_average > 10) {
			$rating_average = 10;
		}

		$rating = round($rating_average, 0);
		$rating_averageimg = "<img src=\"skins/" . $usr['skin'] . "/img/system/vote" . $rating . ".gif\" alt=\"\" />";
		$sql = sed_sql_query("SELECT COUNT(*) FROM $db_rated WHERE rated_code='$code' ");
		$rating_voters = sed_sql_result($sql, 0, "COUNT(*)");
	} else {
		$rating_voters = 0;
		$rating_since = '';
		$rating_average = $L['rat_notyetrated'];
		$rating_averageimg = '';
	}

	$t->assign(array(
		"RATINGS_AVERAGE" => $rating_average,
		"RATINGS_AVERAGEIMG" => $rating_averageimg,
		"RATINGS_VOTERS" => $rating_voters,
		"RATINGS_SINCE" => $rating_since
	));

	if ($usr['id'] > 0 && $votedcasted && $allow) {
		$t->assign(array(
			"RATINGS_EXTRATEXT" => $L['rat_votecasted'],
		));
		$t->parse("RATINGS.RATINGS_EXTRA");
	} elseif ($usr['id'] > 0 && $alreadyvoted && $allow) {
		$t->assign(array(
			"RATINGS_EXTRATEXT" => $rating_uservote,
		));
		$t->parse("RATINGS.RATINGS_EXTRA");
	} elseif ($usr['id'] == 0 && $allow) {
		$t->assign(array(
			"RATINGS_EXTRATEXT" => $L['rat_registeredonly'],
		));
		$t->parse("RATINGS.RATINGS_EXTRA");
	} elseif ($usr['id'] > 0 && !$alreadyvoted && $allow) {
		$t->assign(array(
			"RATINGS_NEWRATE_FORM_SEND" => sed_url($url_part, $url_params . "&ratings=1&ina=send"),
			"RATINGS_NEWRATE_FORM_VOTER" => $usr['name'],
			"RATINGS_NEWRATE_FORM_RATE" => $rate_form
		));
		$t->parse("RATINGS.RATINGS_NEWRATE");
	}

	/* ==== sed 173 */
	if (!$allow) {
		$t->assign(array(
			"RATINGS_DISABLETEXT" => $L['rat_disable']
		));
		$t->parse("RATINGS.RATINGS_DISABLE");
	}
	/* ===   	
	
	/* == Hook for the plugins == */
	$extp = sed_getextplugins('ratings.tags');
	if (is_array($extp)) {
		foreach ($extp as $k => $pl) {
			include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
		}
	}
	/* ===== */

	$t->parse("RATINGS");
	$res_display = $t->text("RATINGS");

	return (array($res, $res_display));
}

/** 
 * Returns stars image for user level 
 * 
 * @param int $level User level 
 * @return string 
 */
function sed_build_stars($level)
{
	global $skin;

	if ($level > 0 and $level < 100) {
		return ("<img src=\"skins/" . $skin . "/img/system/stars" . (floor($level / 10) + 1) . ".gif\" alt=\"\" />");
	} else {
		return ('');
	}
}

/** 
 * Returns time gap between 2 dates 
 * 
 * @param int $t1 Stamp 1 
 * @param int $t2 Stamp 2 
 * @return string 
 */
function sed_build_timegap($t1, $t2)
{
	global $L;

	$gap = $t2 - $t1;

	if ($gap <= 0 || !$t2) {
		$result = '';
	} elseif ($gap < 60) {
		$result  = $gap . ' ' . $L['Seconds'];
	} elseif ($gap < 3600) {
		$gap = floor($gap / 60);
		$result = ($gap < 2) ? '1 ' . $L['Minute'] : $gap . ' ' . $L['Minutes'];
	} elseif ($gap < 86400) {
		$gap1 = floor($gap / 3600);
		$gap2 = floor(($gap - $gap1 * 3600) / 60);
		$result = ($gap1 < 2) ? '1 ' . $L['Hour'] . ' ' : $gap1 . ' ' . $L['Hours'] . ' ';

		if ($gap2 > 0) {
			$result .= ($gap2 < 2) ? '1 ' . $L['Minute'] : $gap2 . ' ' . $L['Minutes'];
		}
	} else {
		$gap = floor($gap / 86400);
		$result = ($gap < 2) ? '1 ' . $L['Day'] : $gap . ' ' . $L['Days'];
	}

	return ($result);
}

/** 
 * Returns user timezone offset 
 * 
 * @param int $tz Timezone 
 * @return string 
 */
function sed_build_timezone($tz)
{
	global $L;

	$result = 'GMT';

	if ($tz == -1 or $tz == 1) {
		$result .= $tz . ' ' . $L['Hour'];
	} elseif ($tz != 0) {
		$result .= $tz . ' ' . $L['Hours'];
	}
	return ($result);
}

/** 
 * Returns link for URL 
 * 
 * @param string $text URL 
 * @param int $maxlen Max allowed length 
 * @return string 
 */
function sed_build_url($text, $maxlen = 64)
{
	global $cfg;

	if (!empty($text)) {
		$text = sed_cc($text);
		$url = $text;
		if (mb_stripos($url, 'http://') === FALSE) {
			$url = 'http://' . $url;
		}

		$text = "<a href=\"" . $url . "\">" . sed_cutstring($text, $maxlen) . "</a>";
	}
	return ($text);
}

/** 
 * Returns link to user profile 
 * 
 * @param int $id User ID 
 * @param string $user User name
 * @param int $group User group 
 * @return string 
 */
function sed_build_user($id, $user, $group = '')  // Modify in v175
{
	global $cfg, $sed_groups, $db_users;

	if ($cfg['color_group']) {
		if (($id > 0) && !empty($user) && empty($group)) {
			$sql = sed_sql_query("SELECT user_maingrp FROM $db_users WHERE user_id='$id' LIMIT 1");
			if (sed_sql_numrows($sql) > 0) {
				$row = sed_sql_fetchassoc($sql);
				$color = $sed_groups[$row['user_maingrp']]['color'];
			} else {
				$color = "inherit";
			}
		} elseif (($id > 0) && !empty($user) && !empty($group)) {
			$color =  $sed_groups[$group]['color'];
		} else {
			$color =  $sed_groups[1]['color'];
		}
	} else {
		$color = "inherit";
	}

	if (($id == 0 && !empty($user))) {
		$result = "<span style=\"color:" . $color . ";\">" . $user . "</span>";
	} elseif ($id == 0) {
		$result = '';
	} else {
		$result = (!empty($user)) ? "<a href=\"" . sed_url("users", "m=details&id=" . $id) . "\"><span style=\"color:" . $color . ";\">" . $user . "</span></a>" : '?';
	}
	return ($result);
}

/** 
 * Returns user avatar image 
 * 
 * @param string $image Image src 
 * @return string 
 */
function sed_build_userimage($image)
{
	global $cfg;
	if (!empty($image)) {
		$result = "<img src=\"" . $image . "\" alt=\"\" class=\"avatar post-author-avatar\" />";
	} else {
		$result = "<img src=\"" . $cfg['defav_dir'] . "default.png\" alt=\"\" class=\"avatar post-author-avatar\" />";
	}
	return ($result);
}

/** 
 * Automatic replace \n on <br /> 
 * 
 * @param string $text Text body 
 * @return string 
 */
function sed_br2nl($text)
{
	return (preg_replace('#<br\s*/?>#i', "\n", $text));
}

/** 
 * Build breadcrumbs 
 * 
 * @global array $urlpaths Urls and titles array
 * @global int $startpos Position 
 * @param bool $home Home link flag 
 * @return string 
 */
function sed_breadcrumbs($urlpaths, $startpos = 1, $home = true)
{
	global $L, $t, $sys;

	if (is_array($urlpaths)) {
		$isarray = true;
	} else {
		$urlpaths = explode(',', $urlpaths);
	}

	$urlpaths = ($home) ? array_merge(array($sys['dir_uri'] => $L['Home']), $urlpaths) : $urlpaths;

	$b = new XTemplate(sed_skinfile('breadcrumbs'));

	foreach ($urlpaths as $url => $title) {
		$b->assign(array(
			"BREADCRUMB_URL" => $url,
			"BREADCRUMB_TITLE" => $title,
			"BREADCRUMB_POSITION" => $startpos
		));
		$startpos++;
		$b->parse("BREADCRUMBS.BREADCRUMBS_LIST");
	}

	$b->parse("BREADCRUMBS");
	$breadcrumbs = $b->text("BREADCRUMBS");
	$t->assign("BREADCRUMBS", $breadcrumbs);

	return $breadcrumbs;
}

/** 
 * Clears cache item 
 * 
 * @param string $name Item name 
 * @return bool 
 */
function sed_cache_clear($name)
{
	global $db_cache;

	$sql = sed_sql_query("DELETE FROM $db_cache WHERE c_name='$name'");
	return (TRUE);
}

/** 
 * Clears cache completely 
 * 
 * @return bool 
 */
function sed_cache_clearall()
{
	global $db_cache;
	$sql = sed_sql_query("DELETE FROM $db_cache");
	return (TRUE);
}

/** 
 * Fetches cache value 
 * 
 * @param string $name Item name
 * @param bool $expire Flag disable expire time 
 * @return mixed 
 */
function sed_cache_get($name, $expire = true)
{
	global $cfg, $sys, $db_cache;

	if (!$cfg['cache']) {
		return FALSE;
	}

	$sql_exp = ($expire) ? " AND c_expire > '" . $sys['now'] . "'" : "";

	$sql = sed_sql_query("SELECT c_value FROM $db_cache WHERE c_name='$name'" . $sql_exp);
	if ($row = sed_sql_fetchassoc($sql)) {
		return (unserialize($row['c_value']));
	} else {
		return (FALSE);
	}
}

/** 
 * Get all cache data and import it into global scope 
 * 
 * @param int $auto Only with autoload flag 
 * @return mixed 
 */
function sed_cache_getall($auto = 1)
{
	global $cfg, $sys, $db_cache;

	if (!$cfg['cache']) {
		return FALSE;
	}
	$sql = sed_sql_query("DELETE FROM $db_cache WHERE c_expire < '" . $sys['now'] . "'");
	if ($auto) {
		$sql = sed_sql_query("SELECT c_name, c_value FROM $db_cache WHERE c_auto = 1");
	} else {
		$sql = sed_sql_query("SELECT c_name, c_value FROM $db_cache");
	}
	if (sed_sql_numrows($sql) > 0) {
		return ($sql);
	} else {
		return (FALSE);
	}
}

/** 
 * Puts an item into cache 
 * 
 * @param string $name Item name 
 * @param mixed $value Item value 
 * @param int $expire Expires in seconds 
 * @param int $auto Autload flag 
 * @return bool 
 */
function sed_cache_store($name, $value, $expire, $auto = 1)
{
	global $db_cache, $sys, $cfg;

	if (!$cfg['cache']) {
		return (FALSE);
	}
	$sql = sed_sql_query("REPLACE INTO $db_cache (c_name, c_value, c_expire, c_auto) VALUES ('$name', '" . sed_sql_prep(serialize($value)) . "', '" . ($expire + $sys['now']) . "', '$auto')");
	return (TRUE);
}

/** 
 * Build & display captcha image
 * 
 * @param string $code Captcha code
 * @return mixed 
 */
function sed_captcha_image($code)
{
	global $cfg;

	$image = imagecreatetruecolor(150, 70);
	imagesetthickness($image, 2);

	$background_color = imagecolorallocate($image, rand(220, 255), rand(220, 255), rand(220, 255));
	imagefill($image, 0, 0, $background_color);

	$linenum = rand(3, 5);
	for ($i = 0; $i < $linenum; $i++) {
		$color = imagecolorallocate($image, rand(0, 150), rand(0, 100), rand(0, 150));
		imageline($image, rand(0, 150), rand(1, 70), rand(20, 150), rand(1, 70), $color);
	}

	$font_arr = array_values(array_diff(scandir(SED_ROOT . "/" . $cfg['font_dir']), array('.', '..')));
	$font_size = rand(20, 30);
	$x = rand(0, 10);

	for ($i = 0; $i < strlen($code); $i++) {
		$x += 20;
		$letter = substr($code, $i, 1);
		$color = imagecolorallocate($image, rand(0, 200), 0, rand(0, 200));
		$current_font = rand(0, sizeof($font_arr) - 1);

		imagettftext($image, $font_size, rand(-10, 10), $x, rand(50, 55), $color, SED_ROOT . "/" . $cfg['font_dir'] . $font_arr[$current_font], $letter);
	}

	$pixels = rand(2000, 4000);
	for ($i = 0; $i < $pixels; $i++) {
		$color = imagecolorallocate($image, rand(0, 200), rand(0, 200), rand(0, 200));
		imagesetpixel($image, rand(0, 150), rand(0, 150), $color);
	}

	for ($i = 0; $i < $linenum; $i++) {
		$color = imagecolorallocate($image, rand(0, 255), rand(0, 200), rand(0, 255));
		imageline($image, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
	}

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Content-type: image/png");
	imagepng($image);
	imagedestroy($image);
}

/** 
 * Makes HTML sequences safe 
 * 
 * @param string $text Source string
 * @param bool $ent_quotes Flag ENT_QUOTES
 * @param bool $bbmode Using bbcode in HTML mode  
 * @return string 
 */
function sed_cc($text, $ent_quotes = null, $bbmode = FALSE)
{
	global $cfg;
	$text = is_null($text) ? '' : $text;
	if (!$bbmode) {
		return is_null($ent_quotes) ? htmlspecialchars($text) : htmlspecialchars($text, ENT_QUOTES);
	} else {
		$text = preg_replace('/&#([0-9]{2,4});/is', '&&#35$1;', $text);
		$text = str_replace(
			array('{', '<', '>', '$', '\'', '"', '\\', '&amp;', '&nbsp;'),
			array('&#123;', '&lt;', '&gt;', '&#036;', '&#039;', '&quot;', '&#92;', '&amp;amp;', '&amp;nbsp;'),
			$text
		);
		return ($text);
	}
}

/** 
 * Checks GET anti-XSS parameter 
 * 
 * @return bool 
 */
function sed_check_xg()
{
	global $xg, $cfg;

	if ($xg != sed_sourcekey()) {
		sed_diefatal('Wrong parameter in the URL.');
	}
	return (TRUE);
}

/** 
 * Checks POST anti-XSS parameter 
 * 
 * @return string
 */
function sed_check_xp()
{
	global $xp;

	$sk = sed_sourcekey();
	if ($_SERVER["REQUEST_METHOD"] == 'POST' && !defined('SED_AUTH') && !defined('SED_DISABLE_XFORM')) {
		if (empty($xp) || $xp != $sk) {
			sed_diefatal('Wrong parameter in the URL.');
		}
	}
	return ($sk);
}

/** 
 * Forward and backward replacement tag HR to comment
 * 
 * @param string $text Source string
 * @param bool $more Forward OR backward
 * @return string 
 */
function sed_checkmore($text = '', $more = false)
{
	global $cfg;

	$text = (is_null($text)) ? '' : $text;

	if ($more == true) {
		$text = preg_replace('/(\<hr id="readmore"(.*?)?\>)/', '<!--readmore-->', $text);
	} else {
		$text = preg_replace('/(\<!--readmore--\>)/', '<hr id="readmore" />', $text);
	}

	return ($text);
}

/** 
 * Truncates a string 
 * 
 * @param string $res Source string 
 * @param int $l Length 
 * @return string 
 */
function sed_cutstring($res, $l, $ellipsis = '...')
{
	global $cfg;

	$enc = mb_strtolower($cfg['charset']);
	if ($enc == 'utf-8') {
		if (mb_strlen($res) > $l) {
			$res = mb_substr($res, 0, ($l - mb_strlen($ellipsis)), $enc) . $ellipsis;
		}
	} else {
		if (mb_strlen($res) > $l) {
			$res = mb_substr($res, 0, ($l - mb_strlen($ellipsis))) . $ellipsis;
		}
	}
	return ($res);
}

/** 
 * Truncates a string and add readmore link 
 * 
 * @param string $text Source string 
 * @param string $url Url 
 * @return string 
 */
function sed_cutreadmore($text, $url)
{
	global $cfg, $L;

	$readmore = mb_strpos($text, "<!--readmore-->");
	if ($readmore == 0) {
		$readmore = mb_strpos($text, "[more]");
	}

	if ($readmore > 0) {
		$text = mb_substr($text, 0, $readmore) . " ";
		$text .= sprintf($cfg['readmore'], "<a href=\"" . $url . "\">" . $L['ReadMore'] . "</a>");
	}

	return ($text);
}

/** 
 * JS build antispam
 * 
 * @return string
 */
function sed_build_antispam()
{
	$hash1 = sed_unique(5);
	$hash2 = sed_unique(3);
	$_SESSION['antispam'] = $hash1 . $hash2;
	$res = sed_textbox_hidden('anti1', $hash1) . sed_textbox_hidden('anti2', $hash2);
	return $res;
}

/** 
 * JS check antispam
 * 
 * @return bool 
 */
function sed_check_antispam()
{
	$anti1 = sed_import('anti1', 'P', 'TXT');
	$anti2 = sed_import('anti2', 'P', 'TXT');
	if ($_SESSION['antispam'] == $anti1) {
		return 1;
	}
	return false;
}

/**
 * Checks if an absolute URL belongs to current site or its subdomains
 *
 * @param string $url Absolute URL
 * @return bool
 */
function sed_url_check($url)
{
	global $sys;
	return preg_match('`^' . preg_quote($sys['scheme'] . '://') . '([\w\p{L}\.\-]+\.)?' . preg_quote($sys['domain']) . '`ui', $url);
}


/** 
 * Terminates script execution and performs redirect 
 * 
 * @param bool $cond Really die? 
 * @return bool 
 */
function sed_die($cond = TRUE, $code = '950')
{
	if ($cond) {
		sed_die_message($code);
	}
	return (FALSE);
}

function sed_die_message($code, $message_title = '', $message_body = '', $redirect = '')
{
	global $L, $cfg, $sys, $usr, $lang;

	$mskin = sed_skinfile(array($code, 'message')) ? sed_skinfile(array($code, 'message')) : sed_skinfile('service.message');
	require(SED_ROOT . "/system/lang/$lang/message.lang.php");

	// Determine response header 
	$msg_status = array(
		100 => '403 Forbidden',
		101 => '200 OK',
		102 => '200 OK',
		105 => '200 OK',
		106 => '200 OK',
		109 => '200 OK',
		117 => '403 Forbidden',
		118 => '200 OK',
		151 => '403 Forbidden',
		152 => '403 Forbidden',
		153 => '403 Forbidden',
		157 => '403 Forbidden',
		300 => '200 OK',
		400 => '400 Bad Request',
		401 => '401 Authorization Required',
		403 => '403 Forbidden',
		404 => '404 Not Found',
		500 => '500 Internal Server Error',
		503 => '503 Service Unavailable',
		602 => '403 Forbidden',
		603 => '403 Forbidden',
		900 => '503 Service Unavailable',
		904 => '403 Forbidden',
		907 => '404 Not Found',
		911 => '404 Not Found',
		915 => '200 OK',
		916 => '200 OK',
		920 => '200 OK',
		930 => '403 Forbidden',
		940 => '403 Forbidden',
		950 => '403 Forbidden',
		951 => '503 Service Unavailable'
	);

	if (array_key_exists($code, $msg_status)) {
		sed_sendheaders('text/html', $msg_status[$code]);

		// Determine message title and body 
		$title = empty($message_title) ? $L['msg' . $code . '_0'] : $message_title;
		$body = empty($message_body) ? $L['msg' . $code . '_1'] : $message_body;

		// Render the message page 
		$redirect_meta = '';
		if (!empty($redirect)) {
			if (sed_url_check($redirect)) {
				$redirect_meta = '<meta http-equiv="refresh" content="3; url=' . $redirect . '" />';
			}
		}

		$t = new XTemplate($mskin);

		$t->assign(array(
			'MESSAGE_BASEHREF' => $sys['abs_url'],
			'MESSAGE_CODE' => $code,
			'MESSAGE_REDIRECT' => $redirect_meta,
			'MESSAGE_TITLE' => $title,
			'MESSAGE_BODY' => $body
		));

		$t->parse('MAIN');
		$t->out('MAIN');

		exit;
	} else {
		return (FALSE);
	}
}

/** 
 * Terminates script execution with fatal error 
 * 
 * @param string $text Reason 
 * @param string $title Message title 
 */
function sed_diefatal($text = 'Reason is unknown.', $title = 'Fatal error')
{
	global $cfg;
	$disp = "<div style=\"font:14px Segoe UI, Verdana, Arial; border:1px dashed #CCCCCC; padding:8px; margin:16px;\">";
	$disp .= (isset($cfg['mainurl']) && isset($cfg['mainurl'])) ? "<strong><a href=\"" . $cfg['mainurl'] . "\">" . $cfg['maintitle'] . "</a></strong><br />" : "";
	$disp .= @date('Y-m-d H:i') . ' / ' . $title . ' : ' . $text;
	$disp .= "</div>";
	die($disp);
}

/** 
 * Terminates with "disabled" error and performs redirect 
 * 
 * @param bool $disabled 
 */
function sed_dieifdisabled($disabled)
{
	if ($disabled) {
		sed_redirect(sed_url("message", "msg=940", "", true));
	}
	return;
}

/** 
 * Maintenance Mode
 * 
 */
function sed_diemaintenance()
{
	global $L, $cfg, $sys;

	$mskin = "skins/" . $cfg['defaultskin'] . "/maintenance.tpl";

	if (file_exists($mskin)) {
		$maintenans_header1 = $cfg['doctype'] . "<html><head>" . sed_htmlmetas();
		$maintenans_header2 = "</head><body>";
		$maintenans_footer = "</body></html>";

		$t = new XTemplate($mskin);
		$t->assign(array(
			"MAINTENANCE_HEADER1" => $maintenans_header1,
			"MAINTENANCE_HEADER2" => $maintenans_header2,
			"MAINTENANCE_FOOTER" => $maintenans_footer,
			"MAINTENANCE_MAINTITLE" => sed_cc($cfg['maintitle']),
			"MAINTENANCE_SUBTITLE" => sed_cc($cfg['subtitle']),
			"MAINTENANCE_REASON" => $cfg['maintenancereason'],
			"MAINTENANCE_FORM_SEND" => sed_url("users", "m=auth&a=check&" . $sys['url_redirect']),
			"MAINTENANCE_USER" => sed_textbox("rusername", "", 24, 100),
			"MAINTENANCE_PASSWORD" => sed_textbox("rpassword", "", 16, 32, "password", false, "password")
		));
		$t->parse("MAINTENANCE");
		$t->out("MAINTENANCE");
		exit;
	} else {
		sed_redirect(sed_url("users", "m=auth", "", true));
		exit;
	}
}

/** 
 * Counter captcha error message  
 * 
 * @param string $message Error message
 * @return string 
 */
function sed_error_msg($message)
{
	if (isset($_SESSION[$_SERVER['REMOTE_ADDR']])) {
		$_SESSION[$_SERVER['REMOTE_ADDR']]++;
	} else {
		$_SESSION[$_SERVER['REMOTE_ADDR']] = 1;
	}
	return ($message);
}


/**
 * Function to generate letter avatar
 *
 * @param string, Font Size, Image width and height
 * @return array Url
 */
function sed_gen_letteravatar($text, $uid, $fontSize, $imgWidth, $imgHeight)
{
	global $cfg, $usr;

	/* settings */
	$font = SED_ROOT . "/" . $cfg['font_dir'] . 'calibri.ttf'; /*define font*/

	// Split words and get first letter of each word. Example - Kannan m -> KM
	$words = explode(" ", $text);
	$text = "";

	foreach ($words as $w) {
		$text .= mb_substr($w, 0, 1);
	}

	// File name and extension
	$fileName = $uid . '-avatar.jpg';

	// Default text color - White
	$textColor = '#FFF';

	// Convert hex code to RGB
	$textColor = sed_hextorgb($textColor);

	// if exist return the image

	if (file_exists($cfg['av_dir'] . $fileName)) {
		return array('status' => TRUE, 'image' => $fileName, 'imagepath' => $cfg['av_dir'] . $fileName);
	}

	$im = imagecreatetruecolor($imgWidth, $imgHeight);
	$textColor = imagecolorallocate($im, $textColor['r'], $textColor['g'], $textColor['b']);

	// Random background Colors
	$colorCode = array("#56aad8", "#61c4a8", "#d3ab92", "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f", "#e67e22", "#e74c3c", "#f39c12", "#d35400", "#c0392b", "#7f8c8d");
	$backgroundColor = sed_hextorgb($colorCode[rand(0, count($colorCode) - 1)]);
	$backgroundColor = imagecolorallocate($im, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);

	imagefill($im, 0, 0, $backgroundColor);
	list($x, $y) = sed_image_ttf_center($im, $text, $font, $fontSize);
	imagettftext($im, $fontSize, 0, $x, $y, $textColor, $font, $text);

	if (imagejpeg($im, $cfg['av_dir'] . $fileName, 90)) {
		/*save image as JPG*/
		imagedestroy($im);
		return array('status' => TRUE, 'image' => $fileName, 'imagepath' => $cfg['av_dir'] . $fileName);
	} else {
		return array('status' => FALSE);
	}
}

/** 
 * Generate captcha code
 * 
 * @return string 
 */
function sed_generate_code()
{
	$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$length = rand(4, 6);
	$numChars = strlen($chars);

	$str = '';
	for ($i = 0; $i < $length; $i++) {
		$str .= substr($chars, rand(1, $numChars) - 1, 1);
	}

	$array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
	srand((float) microtime() * 1000000);
	shuffle($array_mix);

	$result = implode("", $array_mix);
	sed_session_write($result);

	return $result;
}

/** 
 * Generate field code
 * 
 * @return string 
 */
function sed_generate_field_code()
{
	$captcha_field = md5(md5(uniqid('', true) . date('His')));
	sed_session_field_write($captcha_field);
	return $captcha_field;
}

/** 
 * Returns a list of plugins registered for a hook 
 * 
 * @param string $hook Hook name 
 * @param string $cond Permissions 
 * @return array 
 */
function sed_getextplugins($hook, $cond = 'R')
{
	global $sed_plugins, $cfg, $sys;

	$extplugins = array();

	if (isset($sed_plugins[$hook]) && is_array($sed_plugins[$hook])) {
		foreach ($sed_plugins[$hook] as $i => $k) {
			if ($k['pl_hook'] == $hook && sed_auth('plug', $k['pl_code'], $cond)) {
				$extplugins[] = $k;
				if ($cfg['devmode']) {
					$sys['devmode']['hooks'][] = $k;
				}
			}
		}
	}
	return ($extplugins);
}

/** 
 * Returns number of comments for item 
 * 
 * @param string $code Item code 
 * @return int 
 */
function sed_get_comcount($code)
{
	global $db_com;

	$sql = sed_sql_query("SELECT DISTINCT com_code, COUNT(*) FROM $db_com WHERE com_code='$code' GROUP BY com_code");

	if ($row = sed_sql_fetchassoc($sql)) {
		return ($row['COUNT(*)']);
	} else {
		return ("0");
	}
}

/** 
 * Returns current url 
 * 
 * @return string 
 */
function sed_getcurrenturl()
{
	global $_SERVER;
	$url = (sed_is_ssl()) ? 'https' : 'http';
	$url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

	return ($url);
}

/** 
 * Hashes a value with given salt. 
 * 
 * @param  string $data Data to be hash-protected
 * @param  int $type Type algoritm hashing (1 - double md5 with salt, 2 - double md5 with salt & site secret, 3 - only md5)
 * @param  string $salt Hashing salt, usually a random value 
 * @return string $res Hashed value 
 */
function sed_hash($data, $type = 1, $salt = '')
{
	global $cfg;
	if (isset($cfg['site_secret']) && !empty($cfg['site_secret']) && ($type == 2)) {
		$res = md5(md5($data) . $cfg['site_secret'] . $salt);
	} else {
		$res = ($type == 1) ?  md5(md5($data) . $salt) : md5($data);
	}

	return $res;
}

/**
 * Convert hex value to rgb array
 *
 * @param string $colour Hex code
 * @return array|bool RGB code
 */
function sed_hextorgb($colour)
{
	if ($colour[0] == '#') {
		$colour = substr($colour, 1);
	}
	if (strlen($colour) == 6) {
		list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
	} elseif (strlen($colour) == 3) {
		list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
	} else {
		return false;
	}
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	return array('r' => $r, 'g' => $g, 'b' => $b);
}

/** 
 * Generation meta tags, base href & favicon link 
 * 
 * @param  string $description Value meta decription
 * @param  string $keywords Value meta keywords
 * @return string $result
 */
function sed_htmlmetas($description = '', $keywords = '', $contenttype = 'text/html')
{
	global $cfg, $sys;

	$description = (empty($description)) ? $cfg['subtitle'] : htmlspecialchars($description);
	$keywords = (empty($keywords)) ? $cfg['metakeywords'] : htmlspecialchars($keywords);

	$result = "
	<base href=\"" . $sys['abs_url'] . "\" />
	<meta http-equiv=\"content-type\" content=\"" . $contenttype . "; charset=" . $cfg['charset'] . "\" />
	<meta name=\"description\" content=\"" . $description . "\" />
	<meta name=\"keywords\" content=\"" . $keywords . "\" />
	<meta name=\"generator\" content=\"Seditio by Neocrome & Seditio Team https://seditio..com.tr\" />
	<meta http-equiv=\"pragma\" content=\"no-cache\" />
	<meta http-equiv=\"cache-control\" content=\"no-cache\" />
	<meta http-equiv=\"last-modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\" />
	<link rel=\"shortcut icon\" href=\"favicon.ico\" />";
	return ($result);
}

/** 
 * The function of the future, for compatibility upgrading bb to html! 
 * 
 */
function sed_html($text)
{
	/* =====	
	To implement the changes [spoiler] [/spoiler] [hidden] [/hidden] and etc.
  ===== */
	return $text;
}

/**
 * Get center position on image
 *
 * @param GdImage $image
 * @param string $text
 * @param string $font
 * @param float $size
 * @param float $angle
 * @return array Position 
 */
function sed_image_ttf_center($image, $text, $font, $size, $angle = 8)
{
	$xi = imagesx($image);
	$yi = imagesy($image);
	$box = imagettfbbox($size, $angle, $font, $text);
	$xr = abs(max($box[2], $box[4])) + 5;
	$yr = abs(max($box[5], $box[7]));
	$x = intval(($xi - $xr) / 2);
	$y = intval(($yi + $yr) / 2);
	return array($x, $y);
}

/** 
 * Imports data from the outer world 
 * 
 * @param string $name Variable name 
 * @param string $source Source type: G (GET), P (POST), C (COOKIE) or D (variable filtering) 
 * @param string $filter Filter type 
 * @param int $maxlen Length limit 
 * @param bool $dieonerror Die with fatal error on wrong input 
 * @return mixed 
 */
function sed_import($name, $source, $filter, $maxlen = 0, $dieonerror = FALSE)
{
	global $cfg;

	switch ($source) {
		case 'G':
			$v = (isset($_GET[$name])) ? $_GET[$name] : NULL;
			$log = TRUE;
			break;

		case 'P':
			$v = (isset($_POST[$name])) ? $_POST[$name] : NULL;
			$log = TRUE;
			if ($filter == 'ARR') {
				return ($v);
			}
			break;

		case 'C':
			$v = (isset($_COOKIE[$name])) ? $_COOKIE[$name] : NULL;
			$log = TRUE;
			break;

		case 'D':
			$v = $name;
			$log = FALSE;
			break;

		default:
			sed_diefatal('Unknown source for a variable : <br />Name = ' . $name . '<br />Source = ' . $source . ' ? (must be G, P, C or D)');
			break;
	}

	if ($v == '' || $v == NULL) {
		return ($v);
	}

	if ($maxlen > 0) {
		$v = mb_substr($v, 0, $maxlen);
	}

	$pass = FALSE;
	$defret = NULL;
	$filter = ($filter == 'STX') ? 'TXT' : $filter;

	switch ($filter) {
		case 'INT':
			if (is_numeric($v) == TRUE && floor($v) == $v) {
				$pass = TRUE;
			}
			break;

		case 'NUM':
			if (is_numeric($v) == TRUE) {
				$pass = TRUE;
			}
			break;

		case 'TXT':
			$v = trim($v);
			if (mb_strpos($v, '<') === FALSE) {
				$pass = TRUE;
			} else {
				$defret = str_replace('<', '&lt;', $v);
			}
			break;

		case 'SLU':
			$v = trim($v);
			$f = preg_replace('/[^a-zA-Z0-9_=\/]/', '', $v);
			if ($v == $f) {
				$pass = TRUE;
			} else {
				$defret = '';
			}
			break;

		case 'ALP':
			$v = trim($v);
			$f = sed_alphaonly($v);
			if ($v == $f) {
				$pass = TRUE;
			} else {
				$defret = $f;
			}
			break;

		case 'ALS':
			$v = trim($v);
			$v = preg_replace('/[^\w\s-]/u', '_', $v);
			$pass = TRUE;
			break;

		case 'PSW':
			$v = trim($v);
			$f = preg_replace('#[\'"&<>]#', '', $v);
			$f = mb_substr($f, 0, 32);

			if ($v == $f) {
				$pass = TRUE;
			} else {
				$defret = $f;
			}
			break;

		case 'H32':
			$v = trim($v);
			$f = sed_alphaonly($v);
			$f = mb_substr($f, 0, 32);

			if ($v == $f) {
				$pass = TRUE;
			} else {
				$defret = $f;
			}
			break;

		case 'HTR':
			$v = trim($v);
			$pass = TRUE;
			break;

		case 'HTM':
			$v = trim($v);

			/* == Hook for the plugins html filter == */
			$extp = sed_getextplugins('import.filter');
			if (is_array($extp)) {
				foreach ($extp as $k => $pl) {
					include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
				}
			}
			/* ===== */

			$pass = TRUE;
			break;

		case 'ARR':
			if (TRUE)	// !!!!!!!!!!!
			{
				$pass = TRUE;
			}
			break;

		case 'BOL':
			if ($v == "1" || $v == "on") {
				$pass = TRUE;
				$v = "1";
			} elseif ($v == "0" || $v == "off") {
				$pass = TRUE;
				$v = "0";
			} else {
				$defret = "0";
			}
			break;

		case 'LVL':
			if (is_numeric($v) == TRUE && $v >= 0 && $v <= 100 && floor($v) == $v) {
				$pass = TRUE;
			} else {
				$defret = NULL;
			}
			break;

		case 'NOC':
			$pass = TRUE;
			break;

		default:
			sed_diefatal('Unknown filter for a variable : <br />Var = ' . $v . '<br />Filter = ' . $filter . ' ?');
			break;
	}

	if ($pass) {
		return ($v);
	} else {
		if ($log) {
			sed_log_sed_import($source, $filter, $name, $v);
		}
		if ($dieonerror) {
			sed_diefatal('Wrong input.');
		} else {
			return ($defret);
		}
	}
}

/** 
 * Extract info from SED file headers 
 * 
 * @param string $file File path 
 * @param string $limiter Tag name 
 * @param int $maxsize Max header size 
 * @return array 
 */
function sed_infoget($file, $limiter = 'SED', $maxsize = 32768)
{
	$result = array();

	if ($fp = @fopen($file, 'r')) {
		$limiter_begin = "[BEGIN_" . $limiter . "]";
		$limiter_end = "[END_" . $limiter . "]";
		$data = fread($fp, $maxsize);
		$begin = mb_strpos($data, $limiter_begin);
		$end = mb_strpos($data, $limiter_end);

		if ($end > $begin && $begin > 0) {
			$lines = mb_substr($data, $begin + 8 + mb_strlen($limiter), $end - $begin - mb_strlen($limiter) - 8);
			$lines = explode("\n", $lines);

			foreach ($lines as $k => $line) {
				$linex = explode("=", $line);
				$ii = 1;
				while (!empty($linex[$ii])) {
					@$result[$linex[0]] .= trim($linex[$ii]);
					$ii++;
				}
			}
		} elseif (mb_substr(mb_strtolower($file), mb_strlen($file) - 12) == ".install.php") {
			$result['Error'] = 'Optional install file';
		} elseif (mb_substr(mb_strtolower($file), mb_strlen($file) - 14) == ".uninstall.php") {
			$result['Error'] = 'Optional uninstall file';
		} else {
			$result['Error'] = 'Warning: No markers found in ' . $file;
		}
		@fclose($fp);
	} else {
		$result['Error'] = 'Error: File ' . $file . ' is missing!';
	}
	return ($result);
}

/** 
 * Creating input field radio item
 * 
 * @param string $name Name input tag 
 * @param string $value Value input tag
 * @param string $title Title for radio item 
 * @param string $id Title for radio item 
 * @param bool $checked Checked flag 
 * @return string 
 */
function sed_radio_item($name, $value, $title = '', $id = '', $checked = false, $onclick = "")
{
	$id = (empty($id)) ? $name : $name . "_" . $id;
	$checked = ($checked) ? " checked" : "";
	$onclick = ($onclick) ? " onclick=\"" . $onclick . "\"" : "";
	$result = "<span class=\"radio-item\"><input type=\"radio\" class=\"radio\" id=\"" . $id . "\" name=\"" . $name . "\" value=\"" . $value . "\"" . $checked . $onclick . " /><label for=\"" . $id . "\">" . $title . "</label></span>";
	return ($result);
}

/** 
 * Creating input field radio
 * 
 * @param string $name Name input tag 
 * @param string|array $data Value input tag
 * @param bool $check Checked flag  
 * @return string 
 */
function sed_radiobox($name, $data, $check_data = '')
{
	if (is_array($data)) {
		$isarray = true;
	} else {
		$data = explode(',', $data);
	}

	$jj = 0;
	$result = '';

	foreach ($data as $key => $v) {
		$jj++;
		$result .= ($key == $check_data) ? sed_radio_item($name, $key, $v, $jj, true) : sed_radio_item($name, $key, $v, $jj, false);
	}

	return ($result);
}

/** 
 * Replace relative path to absolute url
 * 
 * @param string $text Text
 * @return string 
 */
function sed_rel2abs($text)
{
	global $cfg;
	$text = preg_replace('#(href|src)="([^:"]*)("|(?:(?:%20|\s|\+)[^"]*"))#', '$1="' . $cfg['mainurl'] . "/" . '$2$3', $text);
	return $text;
}

/** 
 * Translit seo url
 * 
 * @param string $value Text for url value
 * @return string 
 */
function sed_translit_seourl($value)
{
	global $sed_translit;

	$value = mb_strtolower($value);
	$value = strtr($value, $sed_translit);
	$value = mb_ereg_replace('[^-_0-9a-z]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');
	$value = rtrim($value, '-');
	$value = str_replace('-.', '.', $value);

	return $value;
}

/** 
 * Creating input field text
 * 
 * @param string $name Name input tag 
 * @param string $value Value textarea tag
 * @param int $size Input size
 * @param int $maxlength Input max size
 * @param string $class Css class
 * @param bool $disabled Disabled flag 
 * @param string $type Input type  
 * @return string 
 */

function sed_textbox($name, $value, $size = 56, $maxlength = 255, $class = "text", $disabled = false, $type = "text")
{
	$add_disabled = ($disabled) ? " disabled=\"disabled\"" : "";
	$res = "<input type=\"" . $type . "\" class=\"" . $class . "\" name=\"" . $name . "\" value=\"" . sed_cc($value) . "\" size=\"" . $size . "\" maxlength=\"" . $maxlength . "\"" . $add_disabled . " />";
	return ($res);
}

function sed_textbox_hidden($name, $value, $size = 56, $maxlength = 255, $class = "text", $disabled = false)
{
	return sed_textbox($name, $value, $size, $maxlength, $class, $disabled, 'hidden');
}

/** 
 * Creating field textarea
 * 
 * @param string $name Name input tag 
 * @param string $value Value textarea tag
 * @param int $rows Count of rows
 * @param int $cols Count of cols
 * @param string $editor Toolbar for wysiwyg editor
 * @param bool $disabled Disabled flag  
 * @return string 
 */
function sed_textarea($name, $value, $rows, $cols, $editor = "noeditor")
{
	global $cfg;
	$rows = (empty($rows)) ? $cfg['textarea_default_height'] : $rows;
	$cols = (empty($cols)) ? $cfg['textarea_default_width'] : $cols;

	$res = "<textarea name=\"" . $name . "\" rows=\"" . $rows . "\" cols=\"" . $cols . "\" data-editor=\"" . $editor . "\">" . sed_cc(sed_checkmore($value, false), ENT_QUOTES) . "</textarea>";
	return ($res);
}

/** 
 * Creating input field checkbox
 * 
 * @param string $name Name input tag 
 * @param string|array $data Value(s) checkbox input tag
 * @param string|array $check_data Checked value(s) checkbox input tag
 * @param bool $disabled Disabled flag  
 * @return string 
 */
function sed_checkbox($name, $data = '', $check_data = FALSE, $disabled = FALSE)
{
	if (empty($data) || !is_array($data)) {
		$val = (empty($data)) ? "1" : $data;

		$checked = ($check_data) ? " checked" : "";
		$disabled = ($disabled) ? " disabled" : "";
		$result = "<span class=\"checkbox-item\"><input type=\"checkbox\" class=\"checkbox\" id=\"" . $name . "\" name=\"" . $name . "\"" . $checked . $disabled . " value=\"" . $val . "\" /><label for=\"" . $name . "\">&nbsp;</label></span>";
	} else {
		if (!is_array($data)) $data = explode(',', $data);
		if (!is_array($check_data)) $check_data = explode(',', $check_data);
		$jj = 0;
		$result = '';
		foreach ($data as $key => $v) {
			$jj++;
			if (is_array($check_data) && in_array($key, $check_data)) {
				$result .= '<span class="checkbox-item"><input type="checkbox" class="checkbox" id="' . $name . "_" . $jj . '" name="' . $name . '[]' . '" value="' . $key . '" checked /><label for="' . $name . "_" . $jj . '">' . $v . '</label></span>';
			} else {
				$result .= '<span class="checkbox-item"><input type="checkbox" class="checkbox" id="' . $name . "_" . $jj . '" name="' . $name . '[]' . '" value="' . $key . '"  /><label for="' . $name . "_" . $jj . '">' . $v . '</label></span>';
			}
		}
	}
	return ($result);
}

/** 
 * Check SSL 
 * 
 * @return bool
 */
function sed_is_ssl()   // New in 175
{
	if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		$_SERVER['HTTPS'] = 'on';
	}
	if (isset($_SERVER['HTTPS'])) {
		if (mb_strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') return true;
	} elseif (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == '443')) {
		return true;
	}
	return false;
}

/** 
 * Check user agent is bot? 
 * 
 * @return bool
 */
function sed_is_bot()
{
	if (!empty($_SERVER['HTTP_USER_AGENT'])) {
		$options = array(
			'YandexBot', 'YandexAccessibilityBot', 'YandexMobileBot', 'YandexDirectDyn',
			'YandexScreenshotBot', 'YandexImages', 'YandexVideo', 'YandexVideoParser',
			'YandexMedia', 'YandexBlogs', 'YandexFavicons', 'YandexWebmaster',
			'YandexPagechecker', 'YandexImageResizer', 'YandexAdNet', 'YandexDirect',
			'YaDirectFetcher', 'YandexCalendar', 'YandexSitelinks', 'YandexMetrika',
			'YandexNews', 'YandexNewslinks', 'YandexCatalog', 'YandexAntivirus',
			'YandexMarket', 'YandexVertis', 'YandexForDomain', 'YandexSpravBot',
			'YandexSearchShop', 'YandexMedianaBot', 'YandexOntoDB', 'YandexOntoDBAPI',
			'Googlebot', 'Googlebot-Image', 'Mediapartners-Google', 'AdsBot-Google',
			'Mail.RU_Bot', 'bingbot', 'Accoona', 'ia_archiver', 'Ask Jeeves',
			'OmniExplorer_Bot', 'W3C_Validator', 'WebAlta', 'YahooFeedSeeker', 'Yahoo!',
			'Ezooms', '', 'Tourlentabot', 'MJ12bot', 'AhrefsBot', 'SearchBot', 'SiteStatus',
			'Nigma.ru', 'Baiduspider', 'Statsbot', 'SISTRIX', 'AcoonBot', 'findlinks',
			'proximic', 'OpenindexSpider', 'statdom.ru', 'Exabot', 'Spider', 'SeznamBot',
			'oBot', 'C-T bot', 'Updownerbot', 'Snoopy', 'heritrix', 'Yeti',
			'DomainVader', 'DCPbot', 'PaperLiBot'
		);

		foreach ($options as $row) {
			if (stripos($_SERVER['HTTP_USER_AGENT'], $row) !== false) {
				return true;
			}
		}
	}

	return false;
}

/** 
 * Outputs standard javascript 
 * 
 * @param string $more Extra javascript 
 * @return string 
 */
function sed_javascript($more = '')
{
	$result = "<script type=\"text/javascript\" src=\"system/javascript/core.js\"></script>\n";
	$result .= (!empty($more)) ? "<script type=\"text/javascript\">\n" . $more . "\n</script>\n" : '';
	return ($result);
}

/** 
 * Loads comlete category structure into array 
 * 
 * @return array 
 */
function sed_load_structure()
{
	global $db_structure, $cfg, $L;

	$res = array();

	$path = array(); // code path tree
	$tpath = array(); // title path tree

	$sql = sed_sql_query("SELECT * FROM $db_structure ORDER BY structure_path ASC");

	while ($row = sed_sql_fetchassoc($sql)) {
		if (!empty($row['structure_icon'])) {
			$row['structure_icon_src'] = $row['structure_icon'];
			$row['structure_icon'] = "<img src=\"" . $row['structure_icon'] . "\" alt=\"\" />";
		} else {
			$row['structure_icon_src'] = '';
			$row['structure_icon'] = '';
		}

		$last_dot = mb_strrpos($row['structure_path'], '.');

		$row['structure_tpl'] = (empty($row['structure_tpl'])) ? $row['structure_code'] : $row['structure_tpl'];

		if ($last_dot > 0) {
			$path1 = mb_substr($row['structure_path'], 0, ($last_dot));
			$spath = $path[$path1]; //new sed175
			$path[$row['structure_path']] = $path[$path1] . '.' . $row['structure_code'];
			$tpath[$row['structure_path']] = $tpath[$path1] . ' ' . $cfg['separator_symbol'] . ' ' . $row['structure_title'];
			$parent_dot = mb_strrpos($path[$path1], '.');
			$parent_tpl = ($parent_dot > 0) ? mb_substr($path[$path1], $parent_dot + 1) : $path[$path1];
			$row['structure_tpl'] = ($row['structure_tpl'] == 'same_as_parent') ? $parent_tpl : $row['structure_tpl'];
		} else {
			$path[$row['structure_path']] = $row['structure_code'];
			$tpath[$row['structure_path']] = $row['structure_title'];
			$spath = ""; //new sed175
		}

		$order = explode('.', $row['structure_order']);

		$res[$row['structure_code']] = array(
			'id' => $row['structure_id'],
			'path' => $path[$row['structure_path']],
			'tpath' => $tpath[$row['structure_path']],
			'spath' => $spath, //new sed175
			'rpath' => $row['structure_path'],
			'tpl' => $row['structure_tpl'],
			'title' => $row['structure_title'],
			'desc' => $row['structure_desc'],
			'icon' => $row['structure_icon'],
			'iconsrc' => $row['structure_icon_src'],
			'thumb' => $row['structure_thumb'],
			'seo_h1' => $row['structure_seo_h1'],
			'seo_title' => $row['structure_seo_title'],
			'seo_desc' => $row['structure_seo_desc'],
			'seo_keywords' => $row['structure_seo_keywords'],
			'group' => $row['structure_group'],
			'allowcomments' => $row['structure_allowcomments'],
			'allowratings' => $row['structure_allowratings'],
			'order' => $order[0],
			'way' => $order[1]
		);
	}

	return ($res);
}

/** 
 * Logs an event 
 * 
 * @param string $text Event description 
 * @param string $group Event group 
 */
function sed_log($text, $group = 'def')
{
	global $db_logger, $sys, $usr;

	$text = mb_substr($text, 0, 250 - mb_strlen($sys['request_uri'])) . ' - ' . $sys['request_uri'];
	$sql = sed_sql_query("INSERT INTO $db_logger (log_date, log_ip, log_name, log_group, log_text) VALUES (" . (int)$sys['now_offset'] . ", '" . $usr['ip'] . "', '" . sed_sql_prep($usr['name']) . "', '$group', '" . sed_sql_prep($text) . "')");
	return;
}

/** 
 * Logs wrong input 
 * 
 * @param string $s Source type 
 * @param string $e Filter type 
 * @param string $v Variable name 
 * @param string $o Value 
 */
function sed_log_sed_import($s, $e, $v, $o)
{
	$text = "A variable type check failed, expecting " . $s . "/" . $e . " for '" . $v . "' : " . $o;
	sed_log($text, 'sec');
	return;
}

/** 
 * Sends mail with standard PHP mail() 
 * 
 * @global $cfg 
 * @param string $fmail Recipient 
 * @param string $subject Subject 
 * @param string $body Message body 
 * @param string $headers Message headers
 * @param string $param Additional parameters passed to sendmail
 * @param string $content Content type: plain or html 
 * @return bool 
 */
function sed_mail($fmail, $subject, $body, $headers = '', $param = '', $content = 'plain')
{
	global $cfg;

	$connector = 0;

	/* === Hook === */  //New in 177

	$c_fmail = $fmail;
	$c_subject = $subject;
	$c_body = $body;
	$c_headers = $headers;
	$c_param = $param;
	$c_content = $content;

	$extp = sed_getextplugins('mail.connector');
	if (is_array($extp)) {
		foreach ($extp as $k => $pl) {
			include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
		}
	}

	/* ===== */

	if (!$connector) {
		if (empty($fmail)) {
			return (FALSE);
		} else {
			$hdrs   = array();  // new in 175
			$hdrs[] = "MIME-Version: 1.0";
			$hdrs[] = "Content-type: text/" . $content . "; charset=" . $cfg['charset'];
			$hdrs[] = "Content-Transfer-Encoding: 8bit";
			$hdrs[] = "Date: " . date('r', $_SERVER['REQUEST_TIME']);
			$hdrs[] = "Message-ID: <" . md5(uniqid(microtime())) . "@" . $_SERVER['SERVER_NAME'];
			$hdrs[] = "From: =?" . $cfg['charset'] . "?B?" . base64_encode($cfg['maintitle']) . "?= <" . $cfg['adminemail'] . ">";
			$hdrs[] = "Reply-To: <" . $cfg['adminemail'] . ">";
			$hdrs[] = "X-Mailer: PHP/" . phpversion();

			$headers = (empty($headers)) ? implode("\r\n", $hdrs) : $headers;

			$param = empty($param) ? "-f" . $cfg['adminemail'] : $param;

			$body .= "\n\n" . $cfg['maintitle'] . " - " . $cfg['mainurl'] . "\n" . $cfg['subtitle'];

			$subject = "=?" . $cfg['charset'] . "?B?" . base64_encode($subject) . "?=";

			if (ini_get('safe_mode')) {
				mail($fmail, $subject, $body, $headers);
			} else {
				mail($fmail, $subject, $body, $headers, $param);
			}

			sed_stat_inc('totalmailsent');
			return (TRUE);
		}
	}
}

/** 
 * Menu tree generation
 * 
 * @return string
 */
function sed_menu_tree($menus, $parent_id, $level = 0, $only_parent = false, $only_childrensonlevel = false, $class = "")
{
	global $sys;
	if (is_array($menus) && isset($menus[$parent_id])) {
		$class = (!empty($class)) ? " " . $class : "";
		$tree = "<ul class=\"level-" . $level . $class . "\">";
		if ($only_parent == false) {
			$level++;
			foreach ($menus[$parent_id] as $item) {
				$item['menu_url'] = ($item['menu_url'] == '/') ? $sys['dir_uri'] : $item['menu_url'];
				if ($only_childrensonlevel) {
					$tree .= "<li><a href=\"" . $item['menu_url'] . "\" data-mid=\"" . $item['menu_id'] . "\">" . $item['menu_title'] . "</a></li>";
				} else {
					$has_children = isset($menus[$item['menu_id']]) ? " class=\"has-children\"" : "";
					$tree .= "<li" . $has_children . "><a href=\"" . $item['menu_url'] . "\" data-mid=\"" . $item['menu_id'] . "\">" . $item['menu_title'] . "</a>";
					$tree .=  sed_menu_tree($menus, $item['menu_id'], $level);
					$tree .= "</li>";
				}
			}
		} elseif ($only_parent) {
			$item = $menus[$parent_id];
			$tree = (!empty($item['menu_url'])) ? "<a href=\"" . $item['menu_url'] . "\" data-mid=\"" . $item['menu_id'] . "\">" . $item['menu_title'] . "</a>" : "<span data-mid=\"" . $item['menu_id'] . "\">" . $item['menu_title'] . "</span>";
			return $tree;
		}
		$tree .= "</ul>";
	} else {
		return null;
	}
	return $tree;
}

/** 
 * Menu array options generate
 * 
 * @return array
 */
function sed_menu_options($array, $parent = 0, $indent = "&nbsp; &nbsp; &nbsp;")
{
	$return = array();
	foreach ($array as $key => $val) {
		if ($val['menu_pid'] == $parent) {
			$return['x' . $val['menu_id']] = $indent . $val['menu_title'];
			$return = array_merge($return, sed_menu_options($array, $val['menu_id'], $indent . "&nbsp; &nbsp; &nbsp;"));
		}
	}
	return $return;
}

/** 
 * Creates UNIX timestamp out of a date 
 * 
 * @param int $hour Hours 
 * @param int $minute Minutes 
 * @param int $second Seconds 
 * @param int $month Month 
 * @param int $date Day of the month 
 * @param int $year Year 
 * @return int 
 */
function sed_mktime($hour = false, $minute = false, $second = false, $month = false, $date = false, $year = false)
{

	if ($hour === false)  $hour  = Date('G');
	if ($minute === false) $minute = Date('i');
	if ($second === false) $second = Date('s');
	if ($month === false)  $month  = Date('n');
	if ($date === false)  $date  = Date('j');
	if ($year === false)  $year  = Date('Y');

	if ($year >= 1970) return mktime($hour, $minute, $second, $month, $date, $year);

	$m_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	if ($year % 4 == 0 && ($year % 100 > 0 || $year % 400 == 0)) {
		$m_days[1] = 29;
	}

	$d_year = 1970 - $year;
	$days = 0 - $d_year * 365;
	$days -= floor($d_year / 4);
	$days += floor(($d_year - 70) / 100);
	$days -= floor(($d_year - 370) / 400);

	for ($i = 1; $i < $month; $i++) {
		$days += $m_days[$i - 1];
	}
	$days += $date - 1;

	$stamp = $days * 86400;
	$stamp += $hour * 3600;
	$stamp += $minute * 60;
	$stamp += $second;

	return $stamp;
}

/** 
 * Mobile detect 
 * 
 * @return bool 
 */
function sed_mobile_detect()
{
	if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
		return (TRUE);
	}

	if (isset($_SERVER['HTTP_ACCEPT'])) {
		if (mb_strpos(mb_strtolower($_SERVER['HTTP_ACCEPT']), 'wap') !== FALSE) {
			return (TRUE);
		}
	}

	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== FALSE) {
			return (TRUE);
		}

		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE) {
			return (TRUE);
		}
	}
	return (FALSE);
}

/** 
 * Rename file name uses translit or unique number
 * 
 * @global $sed_translit 
 * @param string $name File name to be rename
 * @param bool $underscore Replace spaces to symbol under score 
 * @return string 
 */
function sed_newname($name, $underscore = TRUE)
{
	global $lang, $sed_translit;

	$newname = mb_substr($name, 0, mb_strrpos($name, "."));
	$ext = mb_strtolower(mb_substr($name, mb_strrpos($name, ".") + 1));
	if (is_array($sed_translit)) {
		$newname = strtr($newname, $sed_translit);
	}
	if ($underscore) {
		$newname = str_replace(' ', '_', $newname);
	}

	$newname = preg_replace('#[^a-zA-Z0-9\-_\.\ \+]#', '', $newname);
	$newname = str_replace('..', '.', $newname);
	if (empty($newname)) {
		$newname = sed_unique();
	}

	return $newname . "." . $ext;
}

/** 
 * Standard SED output filters, adds XSS protection to forms 
 * 
 * @param string $output 
 * @return string 
 */
function sed_outputfilters($output)
{
	global $cfg;

	chdir($_SERVER['DOCUMENT_ROOT']); //fix v173

	/* === Hook === */
	$extp = sed_getextplugins('output');
	if (is_array($extp)) {
		foreach ($extp as $k => $pl) {
			include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
		}
	}
	/* ==== */

	if (!defined('SED_DISABLE_XFORM')) {
		$output = str_replace('</FORM>', '</form>', $output);
		$output = str_replace('</form>', sed_xp() . '</form>', $output);
	}

	return ($output);
}

/** 
 * Creating page navigation bar 
 * 
 * @param string $url Basic URL 
 * @param int $current Current page number 
 * @param int $entries Total rows 
 * @param int $perpage Rows per page 
 * @param string $characters It is symbol for parametre which transfer pagination 
 * @return string 
 */
function sed_pagination($url, $current, $entries, $perpage, $characters = 'd')
{
	global $cfg;

	if ($entries <= $perpage) {
		return ("");
	}

	$address = $url . ((mb_strpos($url, '?') !== false) ? '&amp;' : '?') . $characters . '=';

	$totalpages = ceil($entries / $perpage);
	$currentpage = floor($current / $perpage) + 1;
	$each_side = 3;
	$cur_left = $currentpage - $each_side;
	if ($cur_left < 1) $cur_left = 1;
	$cur_right = $currentpage + $each_side;
	if ($cur_right > $totalpages) $cur_right = $totalpages;

	$i = 1;
	$n = 0;
	$res = '';

	while ($i < $cur_left) {
		$k = ($i - 1) * $perpage;
		$res .= sprintf($cfg['pagination'], "<a href=\"" . (($k == 0) ? $url : $address . $k) . "\" class=\"page-link\">" . ($i) . "</a>");
		$i *= ($n % 2) ? 2 : 5;
		$n++;
	}
	for ($j = $cur_left; $j <= $cur_right; $j++) {
		$k = ($j - 1) * $perpage;
		if (($j == $currentpage) && ($j != $totalpages)) {
			$res .= sprintf($cfg['pagination_cur'], ($j));
		} elseif ($j != $totalpages) {
			$res .= sprintf($cfg['pagination'], "<a href=\"" . (($k == 0) ? $url : $address . $k) . "\" class=\"page-link\">" . ($j) . "</a>");
		}
	}
	while ($i <= $cur_right) {
		$i *= ($n % 2) ? 2 : 5;
		$n++;
	}
	while ($i < $totalpages) {
		$k = ($i - 1) * $perpage;
		$res .= sprintf($cfg['pagination'], "<a href=\"" . (($k == 0) ? $url : $address . $k) . "\" class=\"page-link\">" . ($i) . "</a>");
		$i *= ($n % 2) ? 5 : 2;
		$n++;
	}
	$k = ($totalpages - 1) * $perpage;
	if ($currentpage == $totalpages) {
		$res .= sprintf($cfg['pagination_cur'], ($totalpages));
	} else {
		$res .= sprintf($cfg['pagination'], "<a href=\"" . (($k == 0) ? $url : $address . $k) . "\" class=\"page-link\">" . ($totalpages) . "</a>");
	}
	return ($res);
}

/** 
 * Creating page navigation previous/next buttons 
 * 
 * @param string $url Basic URL 
 * @param int $current Current page number 
 * @param int $entries Total rows 
 * @param int $perpage Rows per page 
 * @param bool $res_array Return results as array 
 * @param string $characters It is symbol for parametre which transfer pagination 
 * @return mixed 
 */
function sed_pagination_pn($url, $current, $entries, $perpage, $res_array = FALSE, $characters = 'd')
{
	global $L, $cfg;

	$address = $url . ((mb_strpos($url, '?') !== false) ? '&amp;' : '?') . $characters . '=';
	$res_r = '';
	$res_l = '';

	if ($current > 0) {
		$prevpage = $current - $perpage;
		if ($prevpage < 0 || $prevpage == 0) {
			$address_prev = $url;
		} else {
			$address_prev = $address . $prevpage;
		}
		$res_l = "<a href=\"" . $address_prev . "\" class=\"page-link page-prev\">" . $cfg['pagination_arrowleft'] . " " . $L['Previous'] . "</a>";
	}

	if (($current + $perpage) < $entries) {
		$nextpage = $current + $perpage;
		$res_r = "<a href=\"" . $address . $nextpage . "\" class=\"page-link page-next\">" . $L['Next'] . " " . $cfg['pagination_arrowright'] . "</a>";
	}
	if ($res_array) {
		return (array($res_l, $res_r));
	} else {
		return ($res_l . " " . $res_r);
	}
}

/** 
 * Parses text body 
 * 
 * @param string $text Source text 
 * @param bool $parse_bbcodes Enable bbcode parsing 
 * @param bool $parse_smilies Enable emoticons 
 * @param bool $parse_newlines Replace line breaks with <br />   
 * @return string 
 */
function sed_parse($text, $parse_bbcodes = TRUE, $parse_smilies = TRUE, $parse_newlines = TRUE)
{
	global  $cfg, $sys, $sed_smilies, $L;

	return (sed_html($text));
}

/** 
 * Delete all PFS files for a specific user. Returns number of items removed. 
 * 
 * @param int $userid User ID 
 * @return int 
 */
function sed_pfs_deleteall($userid)
{
	global $db_pfs_folders, $db_pfs, $cfg;

	if (!$userid) {
		return;
	}

	$num = 0;

	$sql = sed_sql_query("DELETE FROM $db_pfs_folders WHERE pff_userid='$userid'");
	$num = $num + sed_sql_affectedrows();
	$sql = sed_sql_query("DELETE FROM $db_pfs WHERE pfs_userid='$userid'");
	$num = $num + sed_sql_affectedrows();

	$bg = $userid . '-';
	$bgl = mb_strlen($bg);

	$handle = @opendir($cfg['pfs_dir']);
	while ($f = @readdir($handle)) {
		if (mb_substr($f, 0, $bgl) == $bg) {
			@unlink($cfg['pfs_dir'] . $f);
		}
	}
	@closedir($handle);

	$handle = @opendir($cfg['th_dir']);
	while ($f = @readdir($handle)) {
		if (mb_substr($f, 0, $bgl) == $bg) {
			@unlink($cfg['th_dir'] . $f);
		}
	}
	@closedir($handle);

	return ($num);
}


/** 
 * Reads raw data from file 
 * 
 * @param string $file File path 
 * @return string 
 */
function sed_readraw($file)
{
	if ($fp = @fopen($file, 'r')) {
		$res = fread($fp, 256000);
		@fclose($fp);
	} else {
		$res = "File not found : " . $file;
	}
	return ($res);
}

/** 
 * Displays redirect page 
 * 
 * @param string $url Target URI 
 */
function sed_redirect($url, $base64 = false)
{
	global $cfg;

	$url = ($base64) ? base64_decode($url) : $url;

	if ($cfg['redirmode']) {
		$output = $cfg['doctype'] . "
		<html>
		<head>
		<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-1\" />
		<meta http-equiv=\"refresh\" content=\"0; url=" . $url . "\" />
		<title>Redirecting...</title></head>
		<body>Redirecting to <a href=\"" . $url . "\">" . $cfg['mainurl'] . "/" . $url . "</a>
		</body>
		</html>";
		header("Refresh: 0; URL=" . $url);
		echo ($output);
		exit;
	} else {
		header("Location: " . $url);
		exit;
	}
	return;
}

/** 
 * Renders a dropdown 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @param array $values Options available
 * @param bool $empty_option Insert first empty element ---  
 * @param bool $key_isvalue Use value & key from array $values, or only value (if false)  
 * @return string 
 */
function sed_selectbox($check, $name, $values, $empty_option = TRUE, $key_isvalue = TRUE)
{
	$check = trim($check);

	$isarray = FALSE;
	if (is_array($values)) {
		$isarray = TRUE;
	} else {
		$values = explode(',', $values);
	}

	$selected = (empty($check) || $check == "00") ? "selected=\"selected\"" : '';
	if ($empty_option) {
		$first_option = "<option value=\"\" $selected>---</option>";
	} else {
		$first_option = '';
	}
	$result =  "<select name=\"$name\" size=\"1\">" . $first_option;
	foreach ($values as $k => $x) {
		$x = trim($x);
		$v = ($isarray && $key_isvalue) ? $k : $x;
		$selected = ($v == $check) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$v\" $selected>" . sed_cc($x) . "</option>";
	}
	$result .= "</select>";
	return ($result);
}

/** 
 * Renders category dropdown 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @param bool $hideprivate Hide private categories
 * @param string $redirecturl Redirect URL 
 * @param string $additional Selectbox additional 
 * @return string 
 */
function sed_selectbox_categories($check, $name, $hideprivate = TRUE, $redirecturl = "", $additional = "")
{
	global $db_structure, $usr, $sed_cat, $L;

	$onchange = (!empty($redirecturl)) ? " onchange=\"sedjs.redirect(this)\"" : "";

	$result =  "<select name=\"$name\"" . $onchange . " size=\"1\">" . $additional;

	foreach ($sed_cat as $i => $x) {
		$display = ($hideprivate) ? sed_auth('page', $i, 'W') : TRUE;

		if (sed_auth('page', $i, 'R') && $i != 'all' && $display) {
			$points_count = substr_count($x['path'], '.');
			$x['title'] = str_repeat("--", $points_count) . " " . $x['title'];
			$x['tpath'] = str_repeat("&nbsp;&nbsp;&nbsp;", $points_count) . " " . $x['title'];
			$selected = ($i == $check) ? "selected=\"selected\"" : '';
			$result .= "<option value=\"" . $redirecturl . $i . "\" $selected> " . $x['tpath'] . "</option>";
		}
	}
	$result .= "</select>";
	return ($result);
}

/** 
 * Renders country dropdown 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @return string 
 */
function sed_selectbox_countries($check, $name)
{
	global $sed_countries;

	$selected = (empty($check) || $check == '00') ? "selected=\"selected\"" : '';
	$result =  "<select name=\"$name\" size=\"1\">";
	foreach ($sed_countries as $i => $x) {
		$selected = ($i == $check) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>" . $x . "</option>";
	}
	$result .= "</select>";

	return ($result);
}

/** 
 * Generates date part dropdown 
 * 
 * @param int $utime Selected timestamp 
 * @param string $mode Display mode: 'short' or complete 
 * @param string $ext Variable name suffix 
 * @return string 
 */
function sed_selectbox_date($utime, $mode, $ext = '')
{
	global $L;
	list($s_year, $s_month, $s_day, $s_hour, $s_minute) = explode('-', @date('Y-m-d-H-i', $utime));
	$p_monthes = array();
	$p_monthes[] = array(1, $L['January']);
	$p_monthes[] = array(2, $L['February']);
	$p_monthes[] = array(3, $L['March']);
	$p_monthes[] = array(4, $L['April']);
	$p_monthes[] = array(5, $L['May']);
	$p_monthes[] = array(6, $L['June']);
	$p_monthes[] = array(7, $L['July']);
	$p_monthes[] = array(8, $L['August']);
	$p_monthes[] = array(9, $L['September']);
	$p_monthes[] = array(10, $L['October']);
	$p_monthes[] = array(11, $L['November']);
	$p_monthes[] = array(12, $L['December']);

	$result = "<select name=\"ryear" . $ext . "\">";
	for ($i = 1902; $i < 2030; $i++) {
		$selected = ($i == $s_year) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>$i</option>";
	}
	$result .= ($utime == 0) ? "<option value=\"0\" selected=\"selected\">---</option>" : "<option value=\"0\">---</option>";

	$result .= "</select><select name=\"rmonth" . $ext . "\">";
	reset($p_monthes);
	foreach ($p_monthes as $k => $line) {
		$selected = ($line[0] == $s_month) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"" . $line[0] . "\" $selected>" . $line[1] . "</option>";
	}
	$result .= ($utime == 0) ? "<option value=\"0\" selected=\"selected\">---</option>" : "<option value=\"0\">---</option>";

	$result .= "</select><select name=\"rday" . $ext . "\">";
	for ($i = 1; $i < 32; $i++) {
		$selected = ($i == $s_day) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>$i</option>";
	}
	$result .= ($utime == 0) ? "<option value=\"0\" selected=\"selected\">---</option>" : "<option value=\"0\">---</option>";
	$result .= "</select> ";

	if ($mode == 'short') {
		return ($result);
	}

	$result .= " <select name=\"rhour" . $ext . "\">";
	for ($i = 0; $i < 24; $i++) {
		$selected = ($i == $s_hour) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>" . sprintf("%02d", $i) . "</option>";
	}
	$result .= ($utime == 0) ? "<option value=\"0\" selected=\"selected\">---</option>" : "<option value=\"0\">---</option>";

	$result .= "</select>:<select name=\"rminute" . $ext . "\">";
	for ($i = 0; $i < 60; $i = $i + 1) {
		$selected = ($i == $s_minute) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>" . sprintf("%02d", $i) . "</option>";
	}
	$result .= ($utime == 0) ? "<option value=\"0\" selected=\"selected\">---</option>" : "<option value=\"0\">---</option>";
	$result .= "</select>";

	return ($result);
}

/** 
 * Renders PFS folder selection dropdown 
 * 
 * @param int $user User ID 
 * @param int $skip Skip folder 
 * @param int $check Checked folder 
 * @return string 
 */
function sed_selectbox_folders($user, $skip, $check)
{
	global $db_pfs_folders;

	$sql = sed_sql_query("SELECT pff_id, pff_title, pff_type FROM $db_pfs_folders WHERE pff_userid='$user' ORDER BY pff_title ASC");

	$result =  "<select name=\"folderid\" size=\"1\">";

	if ($skip != "/" && $skip != "0") {
		$selected = (empty($check) || $check == "/") ? "selected=\"selected\"" : '';
		$result .=  "<option value=\"0\" $selected>/ &nbsp; &nbsp;</option>";
	}

	while ($row = sed_sql_fetchassoc($sql)) {
		if ($skip != $row['pff_id']) {
			$selected = ($row['pff_id'] == $check) ? "selected=\"selected\"" : '';
			$result .= "<option value=\"" . $row['pff_id'] . "\" $selected>" . sed_cc($row['pff_title']) . "</option>";
		}
	}
	$result .= "</select>";
	return ($result);
}

/** 
 * Generates gender dropdown 
 * 
 * @param string $check Checked gender 
 * @param string $name Input name 
 * @return string 
 */
function sed_selectbox_gender($check, $name)
{
	global $L;

	$genlist = array('U', 'M', 'F');
	$result =  "<select name=\"$name\" size=\"1\">";
	foreach (array('U', 'M', 'F') as $i) {
		$selected = ($i == $check) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"$i\" $selected>" . $L['Gender_' . $i] . "</option>";
	}
	$result .= "</select>";
	return ($result);
}

/** 
 * Returns group selection dropdown code 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @param array $skip Hidden groups 
 * @return string 
 */
function sed_selectbox_groups($check, $name, $skip = array(0))
{
	global $sed_groups;

	$res = "<select name=\"$name\" size=\"1\">";

	foreach ($sed_groups as $k => $i) {
		$selected = ($k == $check) ? "selected=\"selected\"" : '';
		$res .= (in_array($k, $skip)) ? '' : "<option value=\"$k\" $selected>" . $sed_groups[$k]['title'] . "</option>";
	}
	$res .= "</select>";

	return ($res);
}

/** 
 * Returns language selection dropdown 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @return string 
 */
function sed_selectbox_lang($check, $name)
{
	global $sed_languages, $sed_countries;

	$handle = opendir("system/lang/");
	while ($f = readdir($handle)) {
		if ($f[0] != '.') {
			$langlist[] = $f;
		}
	}
	closedir($handle);
	sort($langlist);

	$result = "<select name=\"$name\" size=\"1\">";
	foreach ($langlist as $i => $x) {
		$selected = ($x == $check) ? "selected=\"selected\"" : '';
		$lng = (empty($sed_languages[$x])) ? $sed_countries[$x] : $sed_languages[$x];
		$result .= "<option value=\"$x\" $selected>" . $lng . " (" . $x . ")</option>";
	}
	$result .= "</select>";

	return ($result);
}

/** 
 * Returns skin selection dropdown 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @return string 
 */
function sed_selectbox_skin($check, $name)
{
	$handle = opendir("skins/");
	while ($f = readdir($handle)) {
		if (mb_strpos($f, '.') === FALSE) {
			$skinlist[] = $f;
		}
	}
	closedir($handle);
	sort($skinlist);

	$result = "<select name=\"$name\" size=\"1\">";
	foreach ($skinlist as $i => $x) {
		$selected = ($x == $check) ? "selected=\"selected\"" : '';
		$skininfo = SED_ROOT . "/skins/" . $x . "/" . $x . ".php";
		if (file_exists($skininfo)) {
			$info = sed_infoget($skininfo);
			$result .= (!empty($info['Error'])) ? "<option value=\"$x\" $selected>" . $x . " (" . $info['Error'] . ")" : "<option value=\"$x\" $selected>" . $info['Name'];
		} else {
			$result .= "<option value=\"$x\" $selected>" . $x;
		}
		$result .= "</option>";
	}
	$result .= "</select>";

	return ($result);
}

/** 
 * Return translate & beautify date
 * 
 * @param int $timestampDate Timestamp date
 * @return string 
 */
function sed_translate_date($timestampDate)
{
	global $sed_months_list;
	$tday = date("d", $timestampDate);
	$tmonths = $sed_months_list[(date('n', $timestampDate))];
	$tyear = date("Y", $timestampDate);
	return $tday . " " . $tmonths . " " . $tyear;
}

/** 
 * Returns skin selection radiobox 
 * 
 * @param string $check Selected value 
 * @param string $name Dropdown name 
 * @return string 
 */
function sed_radiobox_skin($check, $name)
{
	$handle = opendir("skins/");
	while ($f = readdir($handle)) {
		if (mb_strpos($f, '.') === FALSE) {
			$skinlist[] = $f;
		}
	}
	closedir($handle);
	sort($skinlist);
	$result = '';
	foreach ($skinlist as $i => $x) {
		$checked = ($x == $check) ? "checked=\"checked\"" : '';
		$skininfo = SED_ROOT . "/skins/" . $x . "/" . $x . ".php";
		$info = sed_infoget($skininfo);
		$result .= (!empty($info['Error'])) ? $x . " (" . $info['Error'] . ")" : "<table class=\"flat\"><tr><td><img src=\"skins/$x/$x.png\" alt=\"$name\" /></td><td style=\"vertical-align:top;\"><input type=\"radio\" name=\"$name\" value=\"$x\" $checked> <strong>" . $info['Name'] . "</strong><br />&nbsp;<br />Version : " . $info['Version'] . "<br />Updated : " . $info['Updated'] . "<br />Author : " . $info['Author'] . "</td></tr></table>";
	}

	return ($result);
}

/** 
 * Gets huge user selection box 
 * 
 * @param int $to Selected user ID 
 * @return string 
 */
function sed_selectbox_users($to)
{
	global $db_users;

	$result = "<select name=\"userid\">";
	$sql = sed_sql_query("SELECT user_id, user_name FROM $db_users ORDER BY user_name ASC");
	while ($row = sed_sql_fetchassoc($sql)) {
		$selected = ($row['user_id'] == $to) ? "selected=\"selected\"" : '';
		$result .= "<option value=\"" . $row['user_id'] . "\" $selected>" . sed_cc($row['user_name']) . "</option>";
	}
	$result .= "</select>";
	return ($result);
}

/** 
 * Sends standard HTTP headers and disables browser cache 
 * 
 * @return bool 
 */
function sed_sendheaders($content_type = 'text/html', $response_code = '200 OK')
{
	$protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
	header($protocol . ' ' . $response_code);
	header('Expires: Mon, Apr 01 1974 00:00:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: post-check=0,pre-check=0', FALSE);
	header('Content-Type: ' . $content_type . '; charset=UTF-8');
	header('Cache-Control: no-store,no-cache,must-revalidate');
	header('Cache-Control: post-check=0,pre-check=0', FALSE);
	header('Pragma: no-cache');
	return TRUE;
}

/** 
 * Set cookie with optional HttpOnly flag
 *   
 * @param string $name The name of the cookie 
 * @param string $value The value of the cookie 
 * @param int $expire The time the cookie expires in unixtime 
 * @param string $path The path on the server in which the cookie will be available on. 
 * @param string $domain The domain that the cookie is available. 
 * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection. When set to TRUE, the cookie will only be set if a secure connection exists. 
 * @param bool $httponly HttpOnly flag 
 * @return bool 
 */
function sed_setcookie($name, $value, $expire = '', $path = '/', $domain = '', $secure = false, $httponly = true)
{
	// local domains cookie support
	if (mb_strpos($domain, '.') === FALSE) {
		$domain = '';
	}

	if (!empty($domain)) {
		if (mb_strtolower(mb_substr($domain, 0, 4)) == 'www.') {
			$domain = mb_substr($domain, 4);
		}
		// Add the dot prefix for subdomain support on some browsers
		if (mb_substr($domain, 0, 1) != '.') $domain = '.' . $domain;
	}

	if (PHP_VERSION < '5.2.0') {
		return setcookie($name, $value, $expire, $path, $domain, $secure);
	} else {
		return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
	}
}

/** 
 * Set the session cookie parameters with optional HttpOnly flag
 *   
 * @param int $expire The time the cookie expires in unixtime 
 * @param string $path The path on the server in which the cookie will be available on. 
 * @param string $domain The domain that the cookie is available. 
 * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection. When set to TRUE, the cookie will only be set if a secure connection exists. 
 * @param bool $httponly HttpOnly flag 
 * @return bool 
 */
function sed_setcookie_params($expire = 0, $path = '/', $domain = '', $secure = false, $httponly = true)
{
	// local domains cookie support
	if (mb_strpos($domain, '.') === FALSE) {
		$domain = '';
	}

	if (!empty($domain)) {
		if (mb_strtolower(mb_substr($domain, 0, 4)) == 'www.') {
			$domain = mb_substr($domain, 4);
		}
		// Add the dot prefix for subdomain support on some browsers
		if (mb_substr($domain, 0, 1) != '.') $domain = '.' . $domain;
	}

	if (PHP_VERSION < '5.2.0') {
		return session_set_cookie_params($expire, $path, $domain, $secure);
	} else {
		return session_set_cookie_params($expire, $path, $domain, $secure, $httponly);
	}
}

/** 
 * Set the doctype
 *   
 * @param int $type The number doctype from settings 
 * @return string 
 */
function sed_setdoctype($type)
{
	switch ($type) {
		case '0': // HTML 4.01
			return ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">");
			break;

		case '1': // HTML 4.01 Transitional
			return ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">");
			break;

		case '2': // HTML 4.01 Frameset
			return ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\" \"http://www.w3.org/TR/html4/frameset.dtd\">");
			break;

		case '3': // XHTML 1.0 Strict
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">");
			break;

		case '4': // XHTML 1.0 Transitional
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");
			break;

		case '5': // XHTML 1.0 Frameset
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Frameset//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd\">");
			break;

		case '6': // XHTML 1.1
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">");
			break;

		case '7': // XHTML 2 
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 2//EN\" \"http://www.w3.org/TR/xhtml2/DTD/xhtml2.dtd\">");
			break;

		case '8': // HTML 5
			return ("<!DOCTYPE html>");
			break;

		default: // ...
			return ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");
			break;
	}
}

/** 
 * Check and set $_SERVER['HTTP_HOST']
 *   
 * @param string $default_host Default host 
 * @return string 
 */
function sed_set_host($default_host)  // New in 175
{
	if (isset($_SERVER['HTTP_HOST'])) {
		$_SERVER['HTTP_HOST'] = mb_strtolower($_SERVER['HTTP_HOST']);
		if (!preg_match('/^\[?(?:[a-z0-9-:\]_]+\.?)+$/', $_SERVER['HTTP_HOST'])) {
			header('HTTP/1.1 400 Bad Request');
			exit;
		}
	} else {
		$_SERVER['HTTP_HOST'] = $default_host;
	}
	return $_SERVER['HTTP_HOST'];
}

/** 
 * Clears current user action in Who's online. 
 * 
 */
function sed_shield_clearaction()
{
	global  $db_online, $usr;

	$sql = sed_sql_query("UPDATE $db_online SET online_action='' WHERE online_ip='" . $usr['ip'] . "'");
	return;
}

/** 
 * Anti-hammer protection 
 * 
 * @param int $hammer Hammer rate 
 * @param string $action Action type 
 * @param int $lastseen User last seen timestamp 
 * @return int 
 */
function sed_shield_hammer($hammer, $action, $lastseen)
{
	global $cfg, $sys, $usr;

	if ($action == 'Hammering') {
		sed_shield_protect();
		sed_shield_clearaction();
		sed_stat_inc('totalantihammer');
	}

	if (($sys['now'] - $lastseen) < 4) {
		$hammer++;
		if ($hammer > $cfg['shieldzhammer']) {
			sed_shield_update(180, 'Hammering');
			sed_log('IP banned 3 mins, was hammering', 'sec');
			$hammer = 0;
		}
	} else {
		if ($hammer > 0) {
			$hammer--;
		}
	}
	return ($hammer);
}

/** 
 * Warn user of shield protection 
 * 
 */
function sed_shield_protect()
{
	global $cfg, $sys, $online_count, $shield_limit, $shield_action;

	if ($cfg['shieldenabled'] && $online_count > 0 && $shield_limit > $sys['now']) {
		sed_diefatal('Shield protection activated, please retry in ' . ($shield_limit - $sys['now']) . ' seconds...<br />After this duration, you can refresh the current page to continue.<br />Last action was : ' . $shield_action);
	}
	return;
}

/** 
 * Updates shield state 
 * 
 * @param int $shield_add Hammer 
 * @param string $shield_newaction New action type 
 */
function sed_shield_update($shield_add, $shield_newaction)
{
	global $cfg, $usr, $sys, $db_online;
	if ($cfg['shieldenabled']) {
		$shield_newlimit = $sys['now'] + floor($shield_add * $cfg['shieldtadjust'] / 100);
		$sql = sed_sql_query("UPDATE $db_online SET online_shield='$shield_newlimit', online_action='$shield_newaction' WHERE online_ip='" . $usr['ip'] . "'");
	}
	return;
}

/** 
 * Returns skin file path 
 * 
 * @param mixed $base Item name (string), or base names (array) 
 * @return string 
 */
function sed_skinfile($base, $plugskin = false, $adminskin = false)
{
	global $usr, $cfg;

	$base = (is_string($base) && mb_strpos($base, '.') !== false) ? explode('.', $base) : $base;
	$bname = is_array($base) ? $base[0] : $base;

	if ($plugskin) {
		$scan_prefix[] = SED_ROOT . '/skins/' . $usr['skin'] . '/plugins/';
		$scan_prefix[] = SED_ROOT . '/skins/' . $usr['skin'] . '/plugin.standalone.';
		if ($usr['skin'] != $cfg['defaultskin']) {
			$scan_prefix[] = SED_ROOT . '/skins/' . $cfg['defaultskin'] . '/plugins/';
			$scan_prefix[] = SED_ROOT . '/skins/' . $cfg['defaultskin'] . '/plugin.standalone.';
		}
		$scan_prefix[] = SED_ROOT . '/plugins/' . $bname . '/';
		$scan_prefix[] = SED_ROOT . '/plugins/' . $bname . '/tpl/';
	}

	if ($adminskin) {
		$scan_prefix[] = SED_ROOT . '/system/adminskin/' . $cfg['adminskin'] . '/';
		if ($plugskin) {
			$scan_prefix[] = SED_ROOT . '/system/adminskin/' . $cfg['adminskin'] . '/plugins/';
		}
	}

	$scan_prefix[] = SED_ROOT . '/skins/' . $usr['skin'] . '/';
	if ($usr['skin'] != $cfg['defaultskin']) {
		$scan_prefix[] = SED_ROOT . 'skins/' . $cfg['defaultskin'] . '/';
	}

	if (is_array($base)) {
		$base_depth = count($base);
		for ($i = $base_depth; $i > 0; $i--) {
			$levels = array_slice($base, 0, $i);
			$skinfile = implode('.', $levels) . '.tpl';
			foreach ($scan_prefix as $pfx) {
				if (file_exists($pfx . $skinfile)) {
					return $pfx . $skinfile;
				}
			}
		}
	} else {
		foreach ($scan_prefix as $pfx) {
			if (file_exists($pfx . $base . '.tpl')) {
				return $pfx . $base . '.tpl';
			}
		}
	}
	return "";
}

/** 
 * Parses smilies in text 
 * 
 * @param string $res Source text 
 * @return string 
 */
function sed_smilies($res)
{
	global $sed_smilies;

	if (is_array($sed_smilies)) {
		foreach ($sed_smilies as $k => $v) {
			$res = str_replace($v['smilie_code'], "<img src=\"" . $v['smilie_image'] . "\" alt=\"\" />", $res);
		}
	}
	return ($res);
}

/** 
 * Gets XSS protection code 
 * 
 * @return string 
 */
function sed_sourcekey()
{
	global $usr;

	$result = ($usr['id'] > 0) ? mb_strtoupper(mb_substr($usr['sessionid'], 0, 6)) : 'GUEST';
	return ($result);
}

/** 
 * Creates new stats parameter 
 * 
 * @param string $name Parameter name 
 */
function sed_stat_create($name, $value = 1)
{
	global $db_stats;

	$sql = sed_sql_query("INSERT INTO $db_stats (stat_name, stat_value) VALUES ('" . sed_sql_prep($name) . "', '" . sed_sql_prep($value) . "')");
	return;
}

/** 
 * Returns statistics parameter 
 * 
 * @param string $name Parameter name 
 * @return int 
 */
function sed_stat_get($name)
{
	global $db_stats;

	$sql = sed_sql_query("SELECT stat_value FROM $db_stats where stat_name='$name' LIMIT 1");
	$result = (sed_sql_numrows($sql) > 0) ? sed_sql_result($sql, 0, 'stat_value') : FALSE;
	return ($result);
}

/** 
 * Increments stats 
 * 
 * @param string $name Parameter name 
 */
function sed_stat_inc($name)
{
	global $db_stats;

	$sql = sed_sql_query("UPDATE $db_stats SET stat_value=stat_value+1 WHERE stat_name='$name'");
	return;
}

/** 
 * Set stats 
 * 
 * @param string $name Parameter name
 * @param string $value Parameter value  
 */
function sed_stat_set($name, $value)
{
	global $db_stats;

	$sql = sed_sql_query("UPDATE $db_stats SET stat_value='$value' WHERE stat_name='$name'");
	return;
}

/** 
 * Returns substring position in file 
 * 
 * @param string $file File path 
 * @param string $str Needle 
 * @param int $maxsize Search limit 
 * @return int 
 */
function sed_stringinfile($file, $str, $maxsize = 32768)
{
	if ($fp = @fopen($file, 'r')) {
		$data = fread($fp, $maxsize);
		$pos = mb_strpos($data, $str);
		$result = ($pos === FALSE) ? FALSE : TRUE;
	} else {
		$result = FALSE;
	}
	@fclose($fp);
	return ($result);
}

/** 
 * Returns a String afterbeing processed by a sprintf mask for titles 
 * 
 * @param string $mask maskname or actual mask 
 * @param array $tags Tag Masks 
 * @param array $data title options 
 * @return string 
 */
function sed_title($mask, $tags, $data)
{
	global $cfg;

	$mask = (empty($cfg[$mask])) ? '{MAINTITLE} - {TITLE}' : $cfg[$mask];

	$mask = str_replace($tags[0], $tags[1], $mask);

	$cnt = count($data);
	for ($i = 0; $i < $cnt; $i++) {
		if (version_compare(PHP_VERSION, '5.2.2', '<=')) {
			$data[$i] = htmlspecialchars($data[$i], ENT_COMPAT, 'UTF-8');
		} else {
			$data[$i] = htmlspecialchars($data[$i], ENT_COMPAT, 'UTF-8', false);
		}
	}
	$title = vsprintf($mask, $data);
	return $title;
}

/** 
 * Sends item to trash 
 * 
 * @param string $type Item type 
 * @param string $title Title 
 * @param int $itemid Item ID 
 * @param mixed $datas Item contents 
 */
function sed_trash_put($type, $title, $itemid, $datas)
{
	global $db_trash, $sys, $usr;

	$sql = sed_sql_query("INSERT INTO $db_trash (tr_date, tr_type, tr_title, tr_itemid, tr_trashedby, tr_datas)
		VALUES
		(" . $sys['now_offset'] . ", '" . sed_sql_prep($type) . "', '" . sed_sql_prep($title) . "', '" . sed_sql_prep($itemid) . "', " . $usr['id'] . ", '" . sed_sql_prep(serialize($datas)) . "')");

	return;
}

/** 
 * Generates random string 
 * 
 * @param int $l Length 
 * @return string 
 */
function sed_unique($l = 16)
{
	return (mb_substr(md5(mt_rand(0, 1000000)), 0, $l));
}

/** 
 * Splits a query string into keys and values array. In comparison with built-in 
 * parse_str() function, this doesn't apply addslashes and urldecode to parameters 
 * and does not support arrays and complex parameters. 
 * 
 * @param string $str Query string 
 * @return array 
 */
function sed_parse_str($str)
{
	$res = array();
	foreach (explode('&', $str) as $item) {
		if (!empty($item)) {
			list($key, $val) = explode('=', $item);
			$res[$key] = $val;
		}
	}
	return $res;
}

/** 
 * Putting a string without empty parameters. 
 * 
 * @param array $params Params 
 * @return string 
 */
function sed_build_str($params)
{
	$res = array();
	foreach ($params as $key => $val) {
		$res[] = $key . "=" . $val;
	}
	return implode("&", $res);
}

/** 
 * Check and cut off empty parameters 
 * 
 * @param array $params Params 
 * @return array 
 */
function sed_check_params($params)
{
	$res = array();
	foreach ($params as $key => $val) {
		if (!empty($val)) {
			$res[$key] = $val;
		}
	}
	return $res;
}

/** 
 * Debug var
 * 
 * @param mixed $v Array or Object
 * @param string $mode Mode: 'print_r' for array use print_r() OR object and other use var_dump()    
 * @return string 
 */
function sed_vardump($v, $mode = '')
{
	ob_start();
	unset($v['devmode'], $v['auth_log']);
	if ($mode == 'print_r') print_r($v);
	else var_dump($v);
	$res = "<pre style=\"white-space:pre-wrap; word-wrap: break-word;\">" . htmlspecialchars(ob_get_clean(), ENT_QUOTES) . "</pre>";
	return $res;
}

/** 
 * Verify captcha code
 *   
 * @return string 
 */
function sed_verify_code()
{
	global $L;

	$captcha_value = $_SESSION['captcha_value'];
	$captcha_field = $_SESSION['captcha_field'];
	$answer_time = $_SESSION['answer_time'];

	if (isset($_SESSION[$_SERVER['REMOTE_ADDR']]) && $_SESSION[$_SERVER['REMOTE_ADDR']] >= 10)
		return sed_error_msg($L['captcha_error_many_incorrect']);

	if (!empty($captcha_value) && !empty($captcha_field) && !empty($answer_time)) {
		$current_time = strtotime(date('d-m-Y H:i:s'));

		if ($current_time - $answer_time < 6)
			return sed_error_msg($L['captcha_error_you_robot_or_too_fast']);
		if ($_POST[$captcha_field] == '')
			return sed_error_msg($L['captcha_error_go_bad_robot']);

		if (md5(md5($_POST[$captcha_field])) == $captcha_value) {
			$ok = 1;
		} else {
			return sed_error_msg($L['captcha_error_incorrect']);
		}
	} else return sed_error_msg($L['captcha_error_hacker_go_home']);
}

/** 
 * Transforms parameters into URL by following user-defined rules into $sed_urltran
 * 
 * @param string $section Site area or script name 
 * @param mixed $params URL parameters as array or parameter string 
 * @param string $anchor URL postfix, e.g. anchor 
 * @param bool $header Set this TRUE if the url will be used in HTTP header rather than body output
 * @param bool $enableamp Set this TRUE if the URL you want to disable the replacement & to &amp;
 * @return string 
 */
function sed_url($section, $params = '', $anchor = '', $header = false, $enableamp = true)
{
	global $cfg, $sys, $sed_urltrans, $sed_cat;

	$params = preg_replace('/&$/', '', $params); // Fix $more in PFS     
	$url = $sed_urltrans['*'][0]['rewrite']; // Default rule  
	$params = is_array($params) ? $params : sed_parse_str($params);
	$args = sed_check_params($params);  // Array without empty parameters

	if ($cfg['sefurls']) {
		$rule = array();
		if (!empty($sed_urltrans[$section]))  // If there is a section with the rules
		{
			foreach ($sed_urltrans[$section] as $rule) // Extract each rule
			{
				$matched = true;  // By default, as if a rule is found            
				$rule['params'] = sed_parse_str($rule['params']);   // Parse the rule parameters of a string into an array                          
				foreach ($rule['params'] as $key => $val)  // Compare the presence of parameters in both arrays
				{
					if (
						empty($args[$key])
						|| (!array_key_exists($key, $args))
						|| ($val != '*' && $args[$key] != $val)
					) {
						$matched = false;
						break;
					}
				}
				if ($matched) {
					$url = $rule['rewrite'];
					break;
				}
			}
		}
	}

	if (preg_match_all('#\{(.+?)\}#', $url, $matches, PREG_SET_ORDER)) {
		foreach ($matches as $m) {
			if ($p = mb_strpos($m[1], '(')) {
				// Callback 
				$callbfunc = mb_substr($m[1], 0, $p);
				$url = str_replace($m[0], $callbfunc($args, $section), $url);
			} else {
				$var = $m[1];
				$url = str_replace($m[0], urlencode($args[$var]), $url);
				unset($args[$var]);
			}
		}
	}
	if (!empty($args)) {
		$qs = ($cfg['sefurls']) ? '?' : '&';
		foreach ($args as $key => $val) {
			if (isset($rule['params'][$key])) {
				if ($rule['params'][$key] != $val) {
					$qs .= $key . '=' . urlencode($val) . '&';
				}
			} else {
				$qs .= $key . '=' . urlencode($val) . '&';
			}
		}
		$qs = mb_substr($qs, 0, -1);
		$url .= $qs;
	}

	$url = ($header || ($enableamp == false)) ? $url : str_replace('&', '&amp;', $url);
	$path = ($header || (isset($cfg['absurls']) && $cfg['absurls'] && $enableamp)) ? $sys['abs_url'] : '';
	return ($path . $url . $anchor);
}

/** 
 * Redirect on SEFUrls (The function is in the status of revision)
 * 
 */
function sed_sefurlredirect()
{
	global $sys, $db_pages;

	if ($findphp = mb_strpos($sys['request_uri'], '.php')) {
		$params = $_SERVER['QUERY_STRING'];
		$params_arr = sed_parse_str($params);

		$section = mb_substr($sys['request_uri'], 1, $findphp - 1);
		$pos_sl = mb_strrpos($section, "/");

		if ($pos_sl > 1) {
			$section = mb_substr($section, $pos_sl + 1);
		}

		if ($section == 'list' && isset($params_arr['c'])) {
			$sys['catcode'] = $params_arr['c'];
		}
		if ($section == 'page') {
			if (isset($params_arr['al']) && !empty($params_arr['al'])) {
				$pal = sed_import($params_arr['al'], 'D', 'ALP');
				$sql = sed_sql_query("SELECT page_cat FROM $db_pages WHERE page_alias='$pal' LIMIT 1");
				$pag = sed_sql_fetchassoc($sql);
				$sys['catcode'] = $pag['page_cat'];
			} elseif (isset($params_arr['id']) && !empty($params_arr['id'])) {
				$pid = sed_import($params_arr['id'], 'D', 'ALP');
				$sql = sed_sql_query("SELECT page_cat FROM $db_pages WHERE page_id='$pid'");
				$pag = sed_sql_fetchassoc($sql);
				$sys['catcode'] = $pag['page_cat'];
			}
		}
		if ($params_arr['r'] != 'tb2preview') {   //fix textboxer preview   
			$redirect301 = sed_url($section, $params, "", true);

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: " . $redirect301);
			exit;
		}
	}
}

/** 
 * Captcha value & answer time write to $_SESSION
 * 
 * @param string $code Code 
 */
function sed_session_write($code)
{
	$_SESSION['captcha_value'] = md5(md5($code));
	$_SESSION['answer_time'] = strtotime(date('d-m-Y H:i:s'));
}

/** 
 * Captcha field name write to $_SESSION
 *
 * @param string $code Code
 */
function sed_session_field_write($code)
{
	$_SESSION['captcha_field'] = $code;
}

/** 
 * Replace all spaces on separator
 * 
 * @param string $text Data text 
 * @param bool $separator Separator
 * @return string   
 */
function sed_replacespace($text, $separator = '_')
{
	$text = preg_replace('|\s+|', $separator, $text);
	return ($text);
}

/** 
 * Fetches user entry from DB 
 * 
 * @param int $id User ID 
 * @return array 
 */
function sed_userinfo($id)
{
	global $db_users;

	$sql = sed_sql_query("SELECT * FROM $db_users WHERE user_id='$id'");
	if ($res = sed_sql_fetchassoc($sql)) {
		return ($res);
	} else {
		$res['user_name'] = '?';
		return ($res);
	}
}

/** 
 * Checks whether user is online 
 * 
 * @param int $id User ID 
 * @return bool 
 */
function sed_userisonline($id)
{
	global $sed_usersonline;

	$res = FALSE;
	if (is_array($sed_usersonline)) {
		$res = (in_array($id, $sed_usersonline)) ? TRUE : FALSE;
	}
	return ($res);
}

/** 
 * Check valid base64 string
 * 
 * @param string $string Text encode base64
 * @return bool 
 */
function sed_valid_base64($s)
{
	// Check if there are valid base64 characters
	if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

	// Decode the string in strict mode and check the results
	$decoded = base64_decode($s, true);
	if (false === $decoded) return false;

	// if string returned contains not printable chars
	if (0 < preg_match('/((?![[:graph:]])(?!\s)(?!\p{L}))./', $decoded, $matched)) return false;

	// Encode the string again
	if (base64_encode($decoded) != $s) return false;

	return true;
}

/** 
 * Wraps text 
 * 
 * @param string $str Source text 
 * @param int $wrap Wrapping boundary 
 * @return string 
 */
function sed_wraptext($str, $wrap = 128)
{
	if (!empty($str)) {
		$str = preg_replace("/([^\n\r ?&\.\/<>\"\\-]{80})/i", " \\1\n", $str);
	}
	return ($str);
}

/** 
 * Returns XSS protection variable for GET URLs 
 * 
 * @return unknown 
 */
function sed_xg()
{
	return ('x=' . sed_sourcekey());
}

/** 
 * Returns XSS protection field for POST forms 
 * 
 * @return string 
 */
function sed_xp()
{
	return ("<div><input type=\"hidden\" id=\"x\" name=\"x\" value=\"" . sed_sourcekey() . "\" /></div>");
}

/* ============== EXTRA FIELD FUNCTION =============== */

/** 
 * Get extra field for table 
 * 
 * @param string $sql_table SQL Table name
 * @return array 
 */
function sed_extrafield_get($sql_table)
{
	global $sed_dic, $cfg;
	$res = array();
	if (!empty($sed_dic)) {
		foreach ($sed_dic as $key => $row) {
			if ($row['extra_location'] == $sql_table) {
				$res[$key] = $row;
			}
		}
	}
	return $res;
}

/** 
 * Build vars if data is ARRAY? convert to type TXT 
 * 
 * @param array $data Array 
 * @return array 
 */
function sed_array_buildvars($data)
{
	$res = array();
	foreach ($data as $k => $v) {
		$res[] = sed_import($v, 'D', 'TXT');
	}
	return $res;
}


/** 
 * Build extra field variable 
 */
function sed_extrafield_buildvar($extrafields, $var_prefix, $table_prefix)
{
	if (count($extrafields) > 0) {
		foreach ($extrafields as $row) {
			$import = sed_import($var_prefix . $row['code'], 'P', $row['vartype']);
			$import = (is_array($import)) ? implode(',', sed_array_buildvars($import)) : $import;
			$res[$table_prefix . '_' . $row['code']] = $import;
		}
	}
	return $res;
}

/**
 * Add extra field for pages
 *
 * @param string $sql_table Table for adding extrafield (without sed_)
 * @param string $name Field name (unique)
 * @param string $type Field type (input, textarea etc)
 * @param string $size Field size
 * @return bool
 */
function sed_extrafield_add($sql_table, $name, $type, $size)
{
	global $db_dic, $cfg;

	$table_prefix = $cfg['sqldbprefix'];

	$fieldsres = sed_sql_query("SELECT dic_code FROM $db_dic WHERE dic_extra_location = '$sql_table'");

	$extrafieldsnames = array();
	while ($row = sed_sql_fetchassoc($fieldsres)) {
		$extrafieldsnames[] = $row['dic_code'];
	}

	if (count($extrafieldsnames) > 0) if (in_array($name, $extrafieldsnames)) return 0; // No adding - fields already exist 

	// Check table sed_$sql_table - if field with same name exists - exit. 
	if (sed_sql_numrows(sed_sql_query("SHOW COLUMNS FROM " . $table_prefix . $sql_table . " LIKE '%\_$name'")) > 0) {
		return FALSE;
	}

	$fieldsres = sed_sql_query("SELECT * FROM " . $table_prefix . $sql_table . " LIMIT 1");
	$i = 0;
	while ($i < sed_sql_numfields($fieldsres)) {
		$column = sed_sql_fetchfield($fieldsres, $i);

		// get column prefix in this table 
		$column_prefix = substr($column->name, 0, strpos($column->name, "_"));
		preg_match("#.*?_$name$#", $column->name, $match);
		if (isset($match[1]) && $match[1] != "") return false; // No adding - fields already exist 
		$i++;
	}

	$step1 = sed_sql_query("UPDATE $db_dic SET 
		dic_extra_location = '" . sed_sql_prep($sql_table) . "', 
		dic_extra_type = '" . sed_sql_prep($type) . "', 
		dic_extra_size = '" . $size . "' 
		WHERE dic_code = '" . $name . "'");

	switch ($type) {
		case "varchar":
			$sqltype = "VARCHAR(" . $size . ")";
			break;
		case "text":
			$sqltype = "TEXT";
			break;
		case "int":
			$sqltype = "VARCHAR(" . $size . ")";
			break;
		case "tinyint":
			$sqltype = "TINYINT(" . $size . ")";
			break;
		case "boolean":
			$sqltype = "TINYINT(1)";
			break;
	}

	$step2 = sed_sql_query("ALTER TABLE " . $table_prefix . $sql_table . " ADD " . $column_prefix . "_$name $sqltype ");
	return TRUE;
}

/**
 * Update extra field
 *
 * @param string $sql_table Table contains extrafield (without sed_)
 * @param string $name Field name (unique)
 * @param string $type Field type (input, textarea etc)
 * @param string $size Field size
 * @return bool
 */
function sed_extrafield_update($sql_table, $name, $type, $size)
{
	global $db_dic, $cfg;

	$table_prefix = $cfg['sqldbprefix'];

	$fieldsres = sed_sql_query("SELECT COUNT(*) FROM $db_dic WHERE dic_code = '$name' AND dic_extra_location='$sql_table'");

	if (sed_sql_numrows($fieldsres) <= 0 || sed_sql_numrows(sed_sql_query("SHOW COLUMNS FROM " . $table_prefix . $sql_table . " LIKE '%\_$name'")) <= 0) {
		return FALSE;
	}

	$fieldsres = sed_sql_query("SELECT * FROM " . $table_prefix . $sql_table . " LIMIT 1");
	$column = sed_sql_fetchfield($fieldsres, 0);
	$column_prefix = substr($column->name, 0, strpos($column->name, "_"));

	$step1 = sed_sql_query("UPDATE $db_dic SET 
		dic_extra_location = '" . sed_sql_prep($sql_table) . "', 
		dic_extra_type = '" . sed_sql_prep($type) . "', 
		dic_extra_size = '" . $size . "' 
		WHERE dic_code = '" . $name . "'");

	if (empty($size)) $size = 11;

	switch ($type) {
		case "varchar":
			$sqltype = "VARCHAR(" . $size . ")";
			break;
		case "text":
			$sqltype = "TEXT";
			break;
		case "int":
			$sqltype = "INT(" . $size . ")";
			break;
		case "tinyint":
			$sqltype = "TINYINT(" . $size . ")";
			break;
		case "boolean":
			$sqltype = "TINYINT(1)";
			break;
	}

	$step2 = sed_sql_query("ALTER TABLE " . $table_prefix . $sql_table . " CHANGE " . $column_prefix . "_$name " . $column_prefix . "_$name $sqltype ");
	return TRUE;
}

/**
 * Delete extra field
 *
 * @param string $sql_table Table contains extrafield (without sed_)
 * @param string $name Name of extra field
 * @return bool
 */
function sed_extrafield_remove($sql_table, $name)
{
	global $db_dic, $cfg;

	$table_prefix = $cfg['sqldbprefix'];

	if ((int) sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM $db_dic 
        WHERE dic_code = '$name' AND dic_extra_location='$sql_table'"), 0, 0) <= 0) {
		return FALSE; // Attempt to remove non-extra field 
	}

	$fieldsres = sed_sql_query("SELECT * FROM " . $table_prefix . $sql_table . " LIMIT 1");
	$column = sed_sql_fetchfield($fieldsres, 0);
	$column_prefix = substr($column->name, 0, strpos($column->name, "_"));

	$step1 = sed_sql_query("UPDATE $db_dic SET 
		dic_extra_location = '', 
		dic_extra_type = '', 
		dic_extra_size = '' 
		WHERE dic_code = '" . $name . "'");

	$step2 = sed_sql_query("ALTER TABLE " . $table_prefix . $sql_table . " DROP " . $column_prefix . "_" . $name);
	return TRUE;
}

/** 
 * Build extra field 
 */
function sed_build_extrafields($rowname, $tpl_tag, $extrafields, $data, $importrowname)
{
	global $sed_dic;

	foreach ($extrafields as $i => $row) {
		$t1 = $tpl_tag . '_' . strtoupper($row['code']);
		$t3 = $tpl_tag . '_' . strtoupper($row['code'] . '_TITLE');
		$t4 = $tpl_tag . '_' . strtoupper($row['code'] . '_DESC');
		$t5 = $tpl_tag . '_' . strtoupper($row['code'] . '_MERA');

		$data[$rowname . '_' . $row['code']] = isset($data[$rowname . '_' . $row['code']]) ? $data[$rowname . '_' . $row['code']] : '';
		$data[$rowname . '_' . $row['code']] = (empty($data[$rowname . '_' . $row['code']]) && !empty($row['term_default'])) ? $row['term_default'] : $data[$rowname . '_' . $row['code']];

		switch ($row['type']) {
			case 'textinput':
				$t2 = sed_textbox($importrowname . $row['code'], $data[$rowname . '_' . $row['code']], $row['form_size'], $row['form_maxsize']);
				break;

			case "textarea":
				$t2 = sed_textarea($importrowname . $row['code'], $data[$rowname . '_' . $row['code']], $row['form_rows'], $row['form_cols']);
				break;

			case "select":
				$t2 = sed_selectbox($data[$rowname . '_' . $row['code']], $importrowname . $row['code'], $row['terms']);
				break;

			case "checkbox":
				$t2 = sed_checkbox($importrowname . $row['code'], $row['terms'], $data[$rowname . '_' . $row['code']]);
				break;

			case "radio":
				$t2 = sed_radiobox($importrowname . $row['code'], $row['terms'], $data[$rowname . '_' . $row['code']]);
				break;
		}

		$return_arr[$t1] = $t2;
		$return_arr[$t3] = (!empty($row['form_title'])) ? $row['form_title'] : $row['title'];
		$return_arr[$t4] = $row['form_desc'];
		$return_arr[$t5] = $row['mera'];
	}
	return $return_arr;
}

/** 
 * Show extra field 
 */
function sed_build_extrafields_data($rowname, $tpl_tag, $extrafields, $data, $getvalue = false)
{
	global $sed_dic;

	foreach ($extrafields as $i => $row) {
		$t1 = $tpl_tag . '_' . strtoupper($row['code']);
		$t3 = $tpl_tag . '_' . strtoupper($row['code'] . '_TITLE');
		$t4 = $tpl_tag . '_' . strtoupper($row['code'] . '_DESC');
		$t5 = $tpl_tag . '_' . strtoupper($row['code'] . '_MERA');

		switch ($row['type']) {
			case 'textinput':
				$t2 = $data[$rowname . '_' . $row['code']];
				break;

			case "textarea":
				$t2 = $data[$rowname . '_' . $row['code']];
				break;

			case "select":
				$t2 = (isset($row['terms'][$data[$rowname . '_' . $row['code']]])) ? $row['terms'][$data[$rowname . '_' . $row['code']]] : "";
				break;

			case "checkbox":
				$data_arr = explode(',', $data[$rowname . '_' . $row['code']]);
				$res_arr = array();
				foreach ($data_arr as $k => $v) {
					$res_arr[] = $row['terms'][$v];
				}
				$t2 = implode(', ', $res_arr);
				break;

			case "radio":
				$t2 = isset($row['terms'][$data[$rowname . '_' . $row['code']]]) ? $row['terms'][$data[$rowname . '_' . $row['code']]] : "";
				break;
		}

		$return_arr[$t1] = ($getvalue) ? $data[$rowname . '_' . $row['code']] : $t2;
		$return_arr[$t3] = (!empty($row['form_title'])) ? $row['form_title'] : $row['title'];
		$return_arr[$t4] = $row['form_desc'];
		$return_arr[$t5] = $row['mera'];
	}
	return $return_arr;
}



/* ============== FLAGS AND COUNTRIES (ISO 3166) =============== */

$sed_languages['de'] = 'Deutsch';
$sed_languages['dk'] = 'Dansk';
$sed_languages['es'] = 'Espanol';
$sed_languages['fi'] = 'Suomi';
$sed_languages['fr'] = 'Francais';
$sed_languages['it'] = 'Italiano';
$sed_languages['nl'] = 'Nederlands';
$sed_languages['ru'] = '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;';
$sed_languages['se'] = 'Svenska';
$sed_languages['en'] = 'English';
$sed_languages['pl'] = 'Polski';
$sed_languages['pt'] = 'Portugese';
$sed_languages['cn'] = '&#27721;&#35821;';
$sed_languages['gr'] = 'Greek';
$sed_languages['hu'] = 'Hungarian';
$sed_languages['jp'] = '&#26085;&#26412;&#35486;';
$sed_languages['kr'] = '&#54620;&#44397;&#47568;';

$sed_countries = array(
	'00' => '---',
	'af' => 'Afghanistan',
	'al' => 'Albania',
	'dz' => 'Algeria',
	'as' => 'American Samoa',
	'ad' => 'Andorra',
	'ao' => 'Angola',
	'ai' => 'Anguilla',
	'aq' => 'Antarctica',
	'ag' => 'Antigua And Barbuda',
	'ar' => 'Argentina',
	'am' => 'Armenia',
	'aw' => 'Aruba',
	'au' => 'Australia',
	'at' => 'Austria',
	'az' => 'Azerbaijan',
	'bs' => 'Bahamas',
	'bh' => 'Bahrain',
	'bd' => 'Bangladesh',
	'bb' => 'Barbados',
	'by' => 'Belarus',
	'be' => 'Belgium',
	'bz' => 'Belize',
	'bj' => 'Benin',
	'bm' => 'Bermuda',
	'bt' => 'Bhutan',
	'bo' => 'Bolivia',
	'ba' => 'Bosnia And Herzegovina',
	'bw' => 'Botswana',
	'bv' => 'Bouvet Island',
	'br' => 'Brazil',
	'io' => 'British Indian Ocean Territory',
	'bn' => 'Brunei Darussalam',
	'bg' => 'Bulgaria',
	'bf' => 'Burkina Faso',
	'bi' => 'Burundi',
	'kh' => 'Cambodia',
	'cm' => 'Cameroon',
	'ca' => 'Canada',
	'cv' => 'Cape Verde',
	'ky' => 'Cayman Islands',
	'cf' => 'Central African Republic',
	'td' => 'Chad',
	'cl' => 'Chile',
	'cn' => 'China',
	'cx' => 'Christmas Island',
	'cc' => 'Cocos Islands',
	'co' => 'Colombia',
	'km' => 'Comoros',
	'cg' => 'Congo',
	'ck' => 'Cook Islands',
	'cr' => 'Costa Rica',
	'ci' => 'Cote D\'ivoire',
	'hr' => 'Croatia',
	'cu' => 'Cuba',
	'cy' => 'Cyprus',
	'cz' => 'Czech Republic',
	'dk' => 'Denmark',
	'dj' => 'Djibouti',
	'dm' => 'Dominica',
	'do' => 'Dominican Republic',
	'tp' => 'East Timor',
	'ec' => 'Ecuador',
	'eg' => 'Egypt',
	'sv' => 'El Salvador',
	'en' => 'England',
	'gq' => 'Equatorial Guinea',
	'er' => 'Eritrea',
	'ee' => 'Estonia',
	'et' => 'Ethiopia',
	'eu' => 'Europe',
	'fk' => 'Falkland Islands',
	'fo' => 'Faeroe Islands',
	'fj' => 'Fiji',
	'fi' => 'Finland',
	'fr' => 'France',
	'gf' => 'French Guiana',
	'pf' => 'French Polynesia',
	'tf' => 'French Southern Territories',
	'ga' => 'Gabon',
	'gm' => 'Gambia',
	'ge' => 'Georgia',
	'de' => 'Germany',
	'gh' => 'Ghana',
	'gi' => 'Gibraltar',
	'gr' => 'Greece',
	'gl' => 'Greenland',
	'gd' => 'Grenada',
	'gp' => 'Guadeloupe',
	'gu' => 'Guam',
	'gt' => 'Guatemala',
	'gn' => 'Guinea',
	'gw' => 'Guinea-bissau',
	'gy' => 'Guyana',
	'ht' => 'Haiti',
	'hm' => 'Heard And Mc Donald Islands',
	'hn' => 'Honduras',
	'hk' => 'Hong Kong',
	'hu' => 'Hungary',
	'is' => 'Iceland',
	'in' => 'India',
	'id' => 'Indonesia',
	'ir' => 'Iran',
	'iq' => 'Iraq',
	'ie' => 'Ireland',
	'il' => 'Israel',
	'it' => 'Italy',
	'jm' => 'Jamaica',
	'jp' => 'Japan',
	'jo' => 'Jordan',
	'kz' => 'Kazakhstan',
	'ke' => 'Kenya',
	'ki' => 'Kiribati',
	'kp' => 'North Korea',
	'kr' => 'South Korea',
	'kw' => 'Kuwait',
	'kg' => 'Kyrgyzstan',
	'la' => 'Laos',
	'lv' => 'Latvia',
	'lb' => 'Lebanon',
	'ls' => 'Lesotho',
	'lr' => 'Liberia',
	'ly' => 'Libya',
	'li' => 'Liechtenstein',
	'lt' => 'Lithuania',
	'lu' => 'Luxembourg',
	'mo' => 'Macau',
	'mk' => 'Macedonia',
	'mg' => 'Madagascar',
	'mw' => 'Malawi',
	'my' => 'Malaysia',
	'mv' => 'Maldives',
	'ml' => 'Mali',
	'mt' => 'Malta',
	'mh' => 'Marshall Islands',
	'mq' => 'Martinique',
	'mr' => 'Mauritania',
	'mu' => 'Mauritius',
	'yt' => 'Mayotte',
	'mx' => 'Mexico',
	'fm' => 'Micronesia',
	'md' => 'Moldavia',
	'mc' => 'Monaco',
	'mn' => 'Mongolia',
	'ms' => 'Montserrat',
	'ma' => 'Morocco',
	'mz' => 'Mozambique',
	'mm' => 'Myanmar',
	'na' => 'Namibia',
	'nr' => 'Nauru',
	'np' => 'Nepal',
	'nl' => 'Netherlands',
	'an' => 'Netherlands Antilles',
	'nc' => 'New Caledonia',
	'nz' => 'New Zealand',
	'ni' => 'Nicaragua',
	'ne' => 'Niger',
	'ng' => 'Nigeria',
	'nu' => 'Niue',
	'nf' => 'Norfolk Island',
	'mp' => 'Northern Mariana Islands',
	'no' => 'Norway',
	'om' => 'Oman',
	'pk' => 'Pakistan',
	'pw' => 'Palau',
	'ps' => 'Palestine',
	'pa' => 'Panama',
	'pg' => 'Papua New Guinea',
	'py' => 'Paraguay',
	'pe' => 'Peru',
	'ph' => 'Philippines',
	'pn' => 'Pitcairn',
	'pl' => 'Poland',
	'pt' => 'Portugal',
	'pr' => 'Puerto Rico',
	'qa' => 'Qatar',
	're' => 'Reunion',
	'ro' => 'Romania',
	'ru' => 'Russia',
	'rw' => 'Rwanda',
	'kn' => 'Saint Kitts And Nevis',
	'lc' => 'Saint Lucia',
	'vc' => 'Saint Vincent',
	'ws' => 'Samoa',
	'sm' => 'San Marino',
	'st' => 'Sao Tome And Principe',
	'sa' => 'Saudi Arabia',
	'sx' => 'Scotland',
	'sn' => 'Senegal',
	'sc' => 'Seychelles',
	'sl' => 'Sierra Leone',
	'sg' => 'Singapore',
	'sk' => 'Slovakia',
	'si' => 'Slovenia',
	'sb' => 'Solomon Islands',
	'so' => 'Somalia',
	'za' => 'South Africa',
	'gs' => 'South Georgia',
	'es' => 'Spain',
	'lk' => 'Sri Lanka',
	'sh' => 'St. Helena',
	'pm' => 'St. Pierre And Miquelon',
	'sd' => 'Sudan',
	'sr' => 'Suriname',
	'sj' => 'Svalbard And Jan Mayen Islands',
	'sz' => 'Swaziland',
	'se' => 'Sweden',
	'ch' => 'Switzerland',
	'sy' => 'Syria',
	'tw' => 'Taiwan',
	'tj' => 'Tajikistan',
	'tz' => 'Tanzania',
	'th' => 'Thailand',
	'tg' => 'Togo',
	'tk' => 'Tokelau',
	'to' => 'Tonga',
	'tt' => 'Trinidad And Tobago',
	'tn' => 'Tunisia',
	'tr' => 'Turkiye',
	'tm' => 'Turkmenistan',
	'tc' => 'Turks And Caicos Islands',
	'tv' => 'Tuvalu',
	'ug' => 'Uganda',
	'ua' => 'Ukraine',
	'ae' => 'United Arab Emirates',
	'uk' => 'United Kingdom',
	'us' => 'United States',
	'uy' => 'Uruguay',
	'uz' => 'Uzbekistan',
	'vu' => 'Vanuatu',
	'va' => 'Vatican',
	've' => 'Venezuela',
	'vn' => 'Vietnam',
	'vg' => 'Virgin Islands (british)',
	'vi' => 'Virgin Islands (u.s.)',
	'wa' => 'Wales',
	'wf' => 'Wallis And Futuna Islands',
	'eh' => 'Western Sahara',
	'ye' => 'Yemen',
	'yu' => 'Yugoslavia',
	'zr' => 'Zaire',
	'zm' => 'Zambia',
	'zw' => 'Zimbabwe'
);

/** 
 * CURL GET  
 */
function sed_browser($url, $post = array(), $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;)", $proxy = '', $ssl_verifypeer = false, $ssl_verifyhost = false)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // timeout 60 sec
	curl_setopt($ch, CURLOPT_TIMEOUT, 200); // timeout 200 sec
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl_verifypeer);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl_verifyhost);
	if (!empty($proxy)) {
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		curl_setopt($ch, CURLOPT_PROXY, "$proxy");
	}
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}

/**
 * CURL DOWNLOAD FILE
 *
 * @param string $url Distantion url
 * @param string $path Source file path
 * @param string $uagent User agent
 * @return void
 */
function sed_getfile($url, $path, $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;)", $proxy = '', $ssl_verifypeer = false, $ssl_verifyhost = false)
{
	$fp = fopen($path, 'w');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl_verifypeer);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl_verifyhost);
	if (!empty($proxy)) {
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		curl_setopt($ch, CURLOPT_PROXY, "$proxy");
	}
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
}

/**
 * Download image from distantion url
 *
 * @param string $source_file Source file path
 * @param string $dst_dir Distantion file path
 * @param int $uid 
 * @return string
 */
function sed_download_img($source_file, $dst_dir, $uid)
{
	$imgsize = getimagesize($source_file);
	$width = $imgsize[0];
	$height = $imgsize[1];
	$mime = $imgsize['mime'];
	switch ($mime) {
		case 'image/png':
			$ext = ".png";
			break;

		case 'image/gif':
			$ext = ".gif";
			break;

		case 'image/jpeg':
			$ext = ".jpg";
			break;

		default:
			return false;
	}
	$dst_file = $uid . $ext;
	sed_getfile($source_file, $dst_dir . $dst_file);
	return $dst_file;
}
