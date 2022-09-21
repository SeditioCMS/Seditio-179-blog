<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plugins/search/search.php
Version=179
Date=2022-jul-28
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=search
Part=main
File=search
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE') || !defined('SED_PLUG')) { die('Wrong URL.'); }

$cfg_maxwords = 5;
$cfg_maxitems = 50;

$sq = sed_import('sq','P','TXT');
$a = sed_import('a','G','TXT');
$checked_catarr = array();
      
$error_string = '';
$total_items = 0;

// ---------- Breadcrumbs
$urlpaths = array();
$urlpaths[sed_url("plug", "e=search")] = $L['plu_title'];	

if ($a == 'search')
	{	
	if (empty($sq) || mb_strlen($sq) < 3)
		{
		$error_string .= $L['plu_querytooshort']."<br />";
		}
	else
		{
		$sq = sed_sql_prep($sq);
		$words = explode(" ", $sq);
		$words_count = count($words);
		if ($words_count > $cfg_maxwords)
			{
			$error_string .= $L['plu_toomanywords']." ".$cfg_maxwords."<br />";
			}
		}
		
	if (empty($error_string))
		{
		$sqlsearch = (count($words) > 1) ? implode("%", $words) : $words[0];
		$sqlsearch = "%".$sqlsearch."%";

		if (!$cfg['disable_page'])
			{
				
			$pag_sub = sed_import('pag_sub', 'P', 'ARR');
			if (!is_array($pag_sub) || $pag_sub[0] == 'all')
				{ $sqlsections = ''; }
			else
				{
				$sub = array();
				foreach($pag_sub as $i => $k)
					{ 
					$k = sed_import($k,'D','TXT');
					$checked_catarr[] = $k;
					$sub[] = "page_cat='".sed_sql_prep($k)."'"; 
					}
				 $sqlsections = "AND (".implode(' OR ', $sub).")";
				}

			$pagsql = "(p.page_title LIKE '".$sqlsearch."' OR p.page_text LIKE '".sed_sql_prep($sqlsearch)."') AND ";

			$sql  = sed_sql_query("SELECT page_id, page_ownerid, page_title, page_cat, page_alias, page_date from $db_pages p, $db_structure s
					WHERE $pagsql (p.page_title LIKE '".$sqlsearch."' OR p.page_text LIKE '".sed_sql_prep($sqlsearch)."') AND p.page_cat = s.structure_code
					AND p.page_cat NOT LIKE 'system' $sqlsections ORDER by page_date DESC 
					LIMIT $cfg_maxitems");
			  
			$items = sed_sql_numrows($sql);

			if ($items > 0)
				{			
				while ($row = sed_sql_fetchassoc($sql))
					{
					if (sed_auth('page', $row['page_cat'], 'R'))
						{
						$sys['catcode'] = $row['page_cat'];
						$row['page_pageurl'] = (empty($row['page_alias'])) ? sed_url("page", "id=".$row['page_id']) : sed_url("page", "al=".$row['page_alias']);
						$ownername = sed_sql_fetchassoc(sed_sql_query("SELECT user_name FROM $db_users WHERE user_id='".$row['page_ownerid']."'"));					
						$t->assign(array(
							"PLUGIN_SEARCH_ROW_PAGE_CATEGORY_URL" => sed_url("list", "c=".$row['page_cat']),
							"PLUGIN_SEARCH_ROW_PAGE_CATEGORY_TITLE" => $sed_cat[$row['page_cat']]['tpath'],
							"PLUGIN_SEARCH_ROW_PAGE_URL" =>	$row['page_pageurl'],
							"PLUGIN_SEARCH_ROW_PAGE_TITLE" => sed_cc($row['page_title']),
							"PLUGIN_SEARCH_ROW_PAGE_DATE" => @date($cfg['dateformat'], $row['page_date'] + $usr['timezone'] * 3600),
							"PLUGIN_SEARCH_ROW_PAGE_OWNER" => sed_build_user($row['page_ownerid'], $ownername['user_name'])	
						));					
						$t->parse("MAIN.PLUGIN_SEARCH_PAGES.PLUGIN_SEARCH_PAGES_ROW");
						}				
					}
				$total_items += $items;
				$t->assign("PLUGIN_SEARCH_PAGE_FOUND", $items);				
				$t->parse("MAIN.PLUGIN_SEARCH_PAGES");			
				}
			}
	  
	
		}
	}
	
if (!$cfg['disable_page'])
	{
	$page_cats = "<select multiple name=\"pag_sub[]\" size=\"5\">";
	$page_cats .= "<option value=\"all\" selected=\"selected\">".$L['plu_allcategories']."</option>";

	foreach ($sed_cat as $i =>$x)
		{
		if ($i != 'all' && $i != 'system' && sed_auth('page', $i, 'R'))
			{
			$selected = (count($checked_catarr) > 0 && in_array($i, $checked_catarr)) ? "selected=\"selected\"" : '';
			$page_cats .= "<option value=\"".$i."\" $selected> ".$x['tpath']."</option>";
			}
		}
		
	$page_cats .= "</select>";

	$t->assign("PLUGIN_SEARCH_FORM_PAGES", $page_cats);
	$t->parse("MAIN.PLUGIN_SEARCH_FORM.PLUGIN_SEARCH_FORM_PAGES");
	}


	
$t->assign(array(
	"PLUGIN_SEARCH_FORM_SEND" => sed_url("plug", "e=search&a=search"),
	"PLUGIN_SEARCH_FORM_INPUT" => sed_textbox('sq', sed_cc($sq), 40, 64)
));

$t->parse("MAIN.PLUGIN_SEARCH_FORM");

if ($total_items == 0 && $a == 'search') 
	{ $error_string .= $L['plu_nofound']; }

if (!empty($error_string))
	{
	$t->assign("PLUGIN_SEARCH_ERROR_BODY", sed_alert($error_string, 'e'));
	$t->parse("MAIN.PLUGIN_SEARCH_ERROR");
	}	
	
$t->assign(array(
	"PLUGIN_SEARCH_TITLE" => "<a href=\"".sed_url("plug", "e=search")."\">".$L['plu_title'] ."</a>",
	"PLUGIN_SEARCH_SHORTTITLE" => $L['plu_title'],
	"PLUGIN_SEARCH_BREADCRUMBS" => sed_breadcrumbs($urlpaths),
	"PLUGIN_SEARCH_URL" => sed_url("plug", "e=search")
));

?>
