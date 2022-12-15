<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/sednews/sednews.setup.php
Version=179
Updated=2022-jul-15
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=sednews
Name=Seditio News
Description=Broadcasting Seditio news on the main page of the administration panel
Version=179
Date=2022-jul-15
Author=Seditio Team
Copyright=
Notes=
SQL=
Auth_guests=0
Lock_guests=RW12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
rssfeed=01:string::https://seditio.com.tr/rss:RSS Feed URL
maxitems=01:select:0,1,2,3,4,5,6,7,8,9,10:3:Recent item displayed
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

?>
