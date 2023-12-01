<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plugins/skineditor/skineditor.codemirror.php
Version=179
Updated=2022-jul-15
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=skineditor
Part=codemirror
File=skineditor.codemirror
Hooks=admin.main
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) {
	die('Wrong URL.');
}

if ($p == "skineditor") {
	$init_codemirror = "<link rel=\"stylesheet\" href=\"plugins/skineditor/js/codemirror/lib/codemirror.css\">
	<script src=\"plugins/skineditor/js/codemirror/lib/codemirror.js\"></script>";
	$moremetas .= $init_codemirror;
}
