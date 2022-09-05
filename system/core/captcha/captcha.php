<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=captcha.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Amro
Description=Captcha generate
[END_SED]
==================== */

if (!defined('SED_CODE')) exit();

session_start();

require(SED_ROOT . '/system/functions.php');

$cfg['font_dir'] = "datas/fonts/";
$captcha_code = sed_generate_code();
sed_captcha_image($captcha_code);

?>
