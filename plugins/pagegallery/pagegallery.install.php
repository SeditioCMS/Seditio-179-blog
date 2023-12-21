<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
https://www.seditio.org

[BEGIN_SED]
File=plugins/pagegallery/pagegallery.install.php
Version=179
Updated=2022-jul-30
Type=Plugin
Author=Amro
Description=
[END_SED]

==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) { die('Wrong URL.'); }

global $db_pages;

$sql = sed_sql_query("ALTER TABLE $db_pages MODIFY page_thumb TEXT");

?>
