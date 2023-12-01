<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/ckeditor/ckeditor.install.php
Version=179
Updated=2022-jul-18
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) {
  die('Wrong URL.');
}

foreach ($sed_groups as $k => $v) {
  if ($v['id'] > 3) {
    //$value = ($v['id']==5) ? 'Extended' : 'Default';    
    sed_config_add('plug', 'ckeditor', 99, 'ckeditor_grp' . $v['id'], 'select', 'Default', 'Default,Micro,Basic,Extended,Full', "Global toolbar for the group '" . $v['title']);
  }
}
