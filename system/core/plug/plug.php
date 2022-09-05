<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plug.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Plugin loader
[END_SED]
==================== */

if (!defined('SED_CODE')) exit();

define('SED_PLUG', TRUE);
$location = 'Plugins';
$z = 'plug';

if(!empty($_GET['ajx'])) { define('SED_DISABLE_XFORM', true); } 

require(SED_ROOT . '/system/functions.php');
require(SED_ROOT . '/datas/config.php');
require(SED_ROOT . '/system/common.php');

sed_dieifdisabled($cfg['disable_plug']);

switch($m)
	{
	default:
	require(SED_ROOT . '/system/core/plug/plug.inc.php');
	break;
	}

?>
