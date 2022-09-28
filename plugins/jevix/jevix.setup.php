<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plugins/jevix/jevix.setup.php
Version=179
Updated=2012-may-22
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=jevix
Name=Jevix 1.3b
Description=Jevix - HTML Filter for Seditio, beta version for Seditio 16x-17x
Version=179
Date=2012-may-22
Author=Amro
Copyright=Amro
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
use_xhtml=01:select:yes,no:yes:Use XHTML standart
use_for_admin=02:select:yes,no:yes:Use Jevix for Administrators
ext_link_enc=03:select:yes,no:no:Nofollow and Base64 encode external link
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

?>