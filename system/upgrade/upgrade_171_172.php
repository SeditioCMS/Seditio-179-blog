<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=upgrade_171_172.php
Version=179
Updated=2022-jul-15
Type=Core.upgrade
Author=Seditio Team
Description=Database upgrade
[END_SED]
==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) {
    die('Wrong URL.');
}


// ========================================

$adminmain .= "Clearing the internal SQL cache...<br />";
$sql = sed_sql_query("TRUNCATE TABLE " . $cfg['sqldbprefix'] . "cache");

$adminmain .= "Adding the Pages new config into the core<br />";
$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'page', '03', 'showpagesubcatgroup', 3, '0', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the Comments new config into the core<br />";
$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'comments', '03', 'showcommentsonpage', 3, '0', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the PFS new config into the core<br />";
$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'pfs', '02', 'pfs_filemask', 3, '0', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the Parser config into the core<br />";
$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '10', 'parser_vid', 3, '1', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '20', 'parsebbcodeusertext', 3, '1', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '20', 'parsebbcodecom', 3, '1', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '20', 'parsebbcodepages', 3, '1', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '30', 'parsesmiliesusertext', 3, '0', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '30', 'parsesmiliescom', 3, '1', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "INSERT INTO " . $cfg['sqldbprefix'] . "config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default, config_text) 
VALUES ('core', 'parser', '30', 'parsesmiliespages', 3, '0', '', '')";
$adminmain .= sed_cc($sqlqr) . "<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Changing the SQL version number to 172...<br />";
$sql = sed_sql_query("UPDATE " . $cfg['sqldbprefix'] . "stats SET stat_value=172 WHERE stat_name='version'");

$upg_status = TRUE;
