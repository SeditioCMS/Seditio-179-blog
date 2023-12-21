<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/pagegallery/pagegallery.page.tags.php
Version=179
Updated=2022-jul-30
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=pagegallery
Part=main
File=pagegallery.page.tags
Hooks=page.tags
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$showfirstpic = $cfg['plugin']['pagegallery']['showfirstpic'];

if (is_array($page_thumbs_array) && count($page_thumbs_array) > 1)
	{
	$jj = 0;
	foreach ($page_thumbs_array as $page_thumb)
		{
		if ($showfirstpic == 'no' && $jj == 0) { $jj++; continue; }
		$jj++;
		$t->assign(array(
			"PAGE_GALLERY_ROW_NUM" => $jj,
			"PAGE_GALLERY_ROW_URL" => $cfg['pfs_dir'].$page_thumb,
			"PAGE_GALLERY_ROW_THUMB" => $page_thumb
		)); 
		$t->parse("MAIN.PAGE_GALLERY.PAGE_GALLERY_ROW");	
		}			
	$t->parse("MAIN.PAGE_GALLERY");	
	}
	
?>
