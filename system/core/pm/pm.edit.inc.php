<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=pm.edit.inc.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Private messages
[END_SED]
==================== */

if (!defined('SED_CODE')) {
	die('Wrong URL.');
}

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('pm', 'a');
sed_block($usr['auth_write']);

$a = sed_import('a', 'G', 'TXT');
$id = sed_import('id', 'G', 'INT');
$f = sed_import('f', 'G', 'ALP');
$to = sed_import('to', 'G', 'TXT');
$q = sed_import('q', 'G', 'INT');
$d = sed_import('d', 'G', 'INT');

unset($touser);
$totalrecipients = 0;
$touser_all = array();
$touser_sql = array();
$touser_ids = array();
$touser_names = array();

sed_check_xg();

/* === Hook === */
$extp = sed_getextplugins('pm.edit.first');
if (is_array($extp)) {
	foreach ($extp as $k => $pl) {
		include(SED_ROOT . '/plugins/' . $pl['pl_code'] . '/' . $pl['pl_file'] . '.php');
	}
}
/* ===== */

$sql = sed_sql_query("SELECT * FROM $db_pm WHERE pm_id='$id' AND pm_state<3");
sed_die(sed_sql_numrows($sql) == 0);

$row = sed_sql_fetchassoc($sql);
$pm_id = $row['pm_id'];
$pm_state = $row['pm_state'];
$pm_date = $row['pm_date'];
$pm_fromuserid = $row['pm_fromuserid'];
$pm_fromuser = $row['pm_fromuser'];
$pm_touserid = $row['pm_touserid'];
$pm_title = $row['pm_title'];
$pm_text = $row['pm_text'];

if ($a == 'archive') {
	if ($pm_touserid != $usr['id'] || $pm_state > 1) {
		sed_redirect(sed_url("message", "msg=550", "", true));
		exit;
	}
	$sql = sed_sql_query("UPDATE $db_pm SET pm_state=2 WHERE pm_id='$id'");
	sed_redirect(sed_url("pm", "", "", true));
	exit;
} elseif ($a == 'delete') {
	if (($pm_state > 0 && $pm_touserid != $usr['id']) || ($pm_state == 0 && $pm_fromuserid != $usr['id'])) {
		sed_redirect(sed_url("message", "msg=950", "", true));
		exit;
	}

	$sql = sed_sql_query("SELECT * FROM $db_pm WHERE pm_id='$id' LIMIT 1");

	if ($row = sed_sql_fetchassoc($sql)) {
		if ($cfg['trash_pm']) {
			sed_trash_put('pm', $L['Private_Messages'] . " #" . $id . " " . $row['pm_title'] . " (" . $row['pm_fromuser'] . ")", $id, $row);
		}
		$sql = sed_sql_query("DELETE FROM $db_pm WHERE pm_id='$id'");
	}

	sed_redirect(sed_url("pm", "f=" . $f, "", true));
	exit;
} elseif ($a == 'update') {
	if (($pm_state > 0 && $pm_touserid != $usr['id']) || ($pm_state == 0 && $pm_fromuserid != $usr['id'])) {
		sed_redirect(sed_url("message", "msg=950", "", true));
		exit;
	}

	$newpmtext = sed_import('newpmtext', 'P', 'HTM');

	if (empty($newpmtext)) {
		sed_redirect(sed_url("pm", "m=edit&a=delete&" . sed_xg() . "&id=" . $id . "&f=" . $f, "", true));
		exit;
	}

	$sql = sed_sql_query("UPDATE $db_pm SET pm_text='" . sed_sql_prep($newpmtext) . "', pm_date='" . $sys['now_offset'] . "' WHERE pm_id='$id'");
	sed_redirect(sed_url("pm", "id=" . $id, "", true));
	exit;
}

sed_die();
