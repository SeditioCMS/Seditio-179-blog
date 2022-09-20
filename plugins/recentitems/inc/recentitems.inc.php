<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/recentitems/inc/recentitems.inc.php
Version=179
Updated=2022-jul-15
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

/* ================== FUNCTIONS ================== */

function sed_get_latestpages($limit, $mask)
	{
	global $t, $L, $db_pages, $db_users, $sys, $usr, $cfg, $sed_cat, $plu_empty;

	$pcomments = ($cfg['showcommentsonpage']) ? "" : "&comments=1";
	
	$res = '';
	
	$sql = sed_sql_query("SELECT p.page_id, p.page_alias, p.page_cat, p.page_title, p.page_date, p.page_ownerid, p.page_count, p.page_comcount, u.user_id, u.user_name, u.user_maingrp, u.user_avatar 
						FROM $db_pages AS p LEFT JOIN $db_users AS u ON u.user_id = p.page_ownerid 
						WHERE p.page_state = 0 AND p.page_cat NOT LIKE 'system' 
						ORDER BY p.page_date DESC LIMIT $limit");

	while ($row = sed_sql_fetchassoc($sql))
		{
		if (sed_auth('page', $row['page_cat'], 'R'))
			{			
			$sys['catcode'] = $row['page_cat']; //new in v175
			$row['page_pageurl'] = (empty($row['page_alias'])) ? sed_url("page", "id=".$row['page_id']) : sed_url("page", "al=".$row['page_alias']);
			$row['page_pageurlcom'] = (empty($row['page_alias'])) ? sed_url("page", "id=".$row['page_id'].$pcomments) : sed_url("page", "al=".$row['page_alias'].$pcomments);
			
			$t-> assign(array(
				"LATEST_PAGES_ROW_URL" => $row['page_pageurl'],
				"LATEST_PAGES_ROW_ID" => $row['page_id'],
				"LATEST_PAGES_ROW_CAT" => $row['page_cat'],
				"LATEST_PAGES_ROW_CATTITLE" => $sed_cat[$row['page_cat']]['title'],
				"LATEST_PAGES_ROW_CATPATH" => sed_build_catpath($row['page_cat'], "<a href=\"%1\$s\">%2\$s</a>"),
				"LATEST_PAGES_ROW_SHORTTITLE" => sed_cutstring($row['page_title'], 50),
				"LATEST_PAGES_ROW_TITLE" => $row['page_title'],			
				"LATEST_PAGES_ROW_DATE" => sed_build_date($cfg['formatyearmonthday'], $row['page_date'], $cfg['plu_mask_pages_date']),
				"LATEST_PAGES_ROW_AUTHOR" => sed_cc($row['user_name']),
				"LATEST_PAGES_ROW_USERURL" => sed_url("users", "m=details&id=".$row['page_ownerid']),
				"LATEST_PAGES_ROW_USER" => sed_build_user($row['page_ownerid'], sed_cc($row['user_name']), $row['user_maingrp']),
				"LATEST_PAGES_ROW_COUNT" => $row['page_count'],
				"LATEST_PAGES_ROW_COMMENTS_URL" => $row['page_pageurlcom'],
				"LATEST_PAGES_ROW_COMMENTS_COUNT" => $row['page_comcount'],				
				"LATEST_PAGES_ROW_AVATAR" => sed_build_userimage($row['user_avatar'])
			));
			
			$t->parse("MAIN.LATEST_PAGES.LATEST_PAGES_ROW");

			/* old result view use mask */
			$res .= sprintf($mask,
				"<a href=\"".sed_url("list", "c=".$row['page_cat'])."\">".$sed_cat[$row['page_cat']]['title']."</a>",
				"<a href=\"".$row['page_pageurl']."\">".sed_cc(sed_cutstring(stripslashes($row['page_title']), 50))."</a>",
				sed_build_date($cfg['formatyearmonthday'], $row['page_date'], $cfg['plu_mask_pages_date'])
			);

			}			
		}
		
	$t->parse("MAIN.LATEST_PAGES");	

	$res = (empty($res)) ? $plu_empty : $res;

	return($res);
	}

/* ------------------ */

function sed_get_latestcomments($limit, $mask)
	{
	global $t, $L, $db_com, $sys, $db_pages, $db_users, $usr, $cfg, $sed_cat, $plu_empty, $ishtml;

	$modal = ($cfg['enablemodal']) ? ',1' : ''; 

	$res = '';
	
	$sql = sed_sql_query("SELECT MAX(com_id) AS max_com_id, MAX(com_date) AS max_com_date FROM $db_com WHERE com_isspecial = 0 GROUP BY com_code ORDER BY max_com_date DESC LIMIT $limit");

	$com_latest = array();

	while ($row = sed_sql_fetchassoc($sql)) $com_latest[] = $row['max_com_id'];
  
	$sql = sed_sql_query("SELECT c.com_id, c.com_code, c.com_text_ishtml, c.com_date, c.com_text, c.com_author, c.com_authorid, u.user_id, u.user_avatar, u.user_maingrp  
					FROM $db_com AS c LEFT JOIN $db_users AS u ON u.user_id = c.com_authorid 
					WHERE c.com_id IN('".implode("','",$com_latest)."') 
					ORDER BY c.com_date DESC");

  while ($row = sed_sql_fetchassoc($sql))
    {
    
    $com_code = $row['com_code'];
    
    $com_text = sed_cutstring(strip_tags($row['com_text']), 100);
    
    $j = substr($com_code, 0, 1);
    $k = substr($com_code, 1);
    
	switch($j)
		{
		case 'p':
			$sql2 = sed_sql_query("SELECT page_id, page_title, page_cat, page_alias FROM sed_pages WHERE page_id = $k LIMIT 1");
			$row2 = sed_sql_fetchassoc($sql2);		      
			$sys['catcode'] = $row2['page_cat']; //new in v175          
			$row2['page_pageurl'] = (empty($row2['page_alias'])) ? sed_url("page", "id=".$row2['page_id']."&comments=1", "#c".$row['com_id']) : sed_url("page", "al=".$row2['page_alias']."&comments=1", "#c".$row['com_id']);		  
			$lnk = "<a href=\"".$row2['page_pageurl']."\">".sed_cutstring(stripslashes($row2['page_title']),60)."</a>";
			break;
    
        case 'v':
			$lnk = "<a href=\"javascript:sedjs.polls('".$k."&comments=1#c".$row['com_id']."'".$modal.")\">".$L['Poll']." #".$k."</a>";
			break;
		
        case 'g':
			$lnk = "<a href=\"".sed_url("gallery", "id=".$k."&comments=1", "#c".$row['com_id'])."\">".$L['Gallery']." #".$k."</a>";
			break;		
		}
    
    $com_author = sed_cc($row['com_author']);
	$com_authorlink = ($row['com_authorid'] > 0 && $row['user_id'] > 0) ? sed_build_user($row['com_authorid'], $com_author, $row['user_maingrp']) : $com_author;

	$t-> assign(array(
		"LATEST_COMMENTS_ROW_ID" => $row['com_id'],
		"LATEST_COMMENTS_ROW_AUTHOR" => $com_author,
		"LATEST_COMMENTS_ROW_AUTHORLINK" => $com_authorlink,
		"LATEST_COMMENTS_ROW_LNK" => $lnk,		
		"LATEST_COMMENTS_ROW_DATE" => sed_build_date($cfg['formatyearmonthday'], $row['com_date'], $cfg['plu_mask_comments_date']),
		"LATEST_COMMENTS_ROW_AVATAR" => sed_build_userimage($row['user_avatar']),
		"LATEST_COMMENTS_ROW_TEXT" => $com_text
	));
	
	$t->parse("MAIN.LATEST_COMMENTS.LATEST_COMMENTS_ROW");
	
	/* old result view use mask */
	$res .= sprintf($mask, 
		$lnk, $com_authorlink, sed_build_date($cfg['formatyearmonthday'], $row['com_date'], $cfg['plu_mask_comments_date']), 
		sed_build_userimage($row['user_avatar']), $com_text);
    
	}
	
	$t->parse("MAIN.LATEST_COMMENTS");

  $res = (empty($res)) ? $plu_empty : $res;
  return($res);
  }


/* ------------------ */

function sed_get_latestpolls($limit, $mask)
	{
	global $t, $L, $cfg, $db_polls, $db_polls_voters, $db_polls_options, $usr, $plu_empty;

	$res = '';
	
	$sql_p = sed_sql_query("SELECT poll_id, poll_text FROM $db_polls WHERE 1 AND poll_state=0  AND poll_type=0 ORDER by poll_creationdate DESC LIMIT $limit");

	$modal = ($cfg['enablemodal']) ? ',1' : ''; 
	
	$ajax = sed_import('ajax', 'G', 'BOL');
	$a = sed_import('a','G','ALP');
	$id = sed_import('id','G','ALP',8);
	$vote = sed_import('vote','G','INT');
	
	// -- AJAX Poll vote
	if ($ajax && $cfg['ajax'] && $a == "send")
	{
		if (!empty($id) && !empty($vote))
			{
			if ($usr['id'] > 0)
				{ $sql2 = sed_sql_query("SELECT pv_id FROM $db_polls_voters WHERE pv_pollid='$id' AND (pv_userid='".$usr['id']."' OR pv_userip='".$usr['ip']."') LIMIT 1"); }
					else
				{ $sql2 = sed_sql_query("SELECT pv_id FROM $db_polls_voters WHERE pv_pollid='$id' AND pv_userip='".$usr['ip']."' LIMIT 1"); }
			
			$alreadyvoted = (sed_sql_numrows($sql2) > 0) ? 1 : 0;
	
			if (!$alreadyvoted)
				{
				$sql2 = sed_sql_query("UPDATE $db_polls_options SET po_count=po_count+1 
							WHERE po_pollid='$id' AND po_id='$vote'");
				if (sed_sql_affectedrows() == 1)
					{
					$sql2 = sed_sql_query("INSERT INTO $db_polls_voters (pv_pollid, pv_userid, pv_userip) 
							VALUES (".(int)$id.", ".(int)$usr['id'].", '".$usr['ip']."')");
					}
				}
			}
	}
	else { $ajax = false; }
	// --

	$res_all = "<div id=\"pollajx\">";
	while ($row_p = sed_sql_fetchassoc($sql_p))
		{
		$res = '';
		$poll_id = $row_p['poll_id'];

		if ($usr['id'] > 0)
	 		{ $sql2 = sed_sql_query("SELECT pv_id FROM $db_polls_voters WHERE pv_pollid='$poll_id' AND (pv_userid='".$usr['id']."' OR pv_userip='".$usr['ip']."') LIMIT 1"); }
	       else
	 		{ $sql2 = sed_sql_query("SELECT pv_id FROM $db_polls_voters WHERE pv_pollid='$poll_id' AND pv_userip='".$usr['ip']."' LIMIT 1"); }

		if (sed_sql_numrows($sql2) > 0)
			{
			$alreadyvoted = 1;
			$sql2 = sed_sql_query("SELECT SUM(po_count) FROM $db_polls_options WHERE po_pollid='$poll_id'");
			$totalvotes = sed_sql_result($sql2, 0, "SUM(po_count)");
			}
		else
			{ 
			$alreadyvoted = 0; 
			$res .= "<form name=\"pollvote_".$poll_id."\" action=\"javascript:sedjs.pollvote(document.pollvote_".$poll_id.".id.value, document.pollvote_".$poll_id.".cvote_".$poll_id.".value); window.location.reload();\" method=\"post\">"; // sed175      
			}
    
		$res .= "<h5>".$row_p['poll_text']."</h5>\n";
		$res .= "<div style=\"padding:10px 0;\" id=\"pollajx_".$poll_id."\">\n";

		$sql = sed_sql_query("SELECT po_id, po_text, po_count FROM $db_polls_options WHERE po_pollid='$poll_id' ORDER by po_id ASC");

		while ($row = sed_sql_fetchassoc($sql))
			{
			if ($alreadyvoted)
				{
				$percentbar = floor(($row['po_count'] / $totalvotes) * 100);
				$res .= "<div class=\"poll-item\">".$row['po_text']." : $percentbar%<div style=\"width:100%;\"><div class=\"bar_back\"><div class=\"bar_front\" style=\"width:".$percentbar."%;\"></div></div></div></div>\n";
				}
			else
				{
				$res .= "<div class=\"poll-item\"><span class=\"radio-item\"><input type=\"radio\" class=\"radio\" id=\"vote_".$row['po_id']."\" name=\"vote\" value=\"".$row['po_id']."\" onClick=\"document.getElementById('cvote_".$poll_id."').value=".$row['po_id']."\" /><label for=\"vote_".$row['po_id']."\">".stripslashes($row['po_text'])."</label></span></div>\n";
				}
			}
 
		if ($alreadyvoted)
			{         
			$res .= "<div style=\"text-align:center;\"><a href=\"javascript:sedjs.polls('".$poll_id."'".$modal.")\">".$L['polls_viewresults']."</a> &nbsp; \n";
			$res .= "<a href=\"javascript:sedjs.polls('viewall'".$modal.")\">".$L['polls_viewarchives']."</a></div>\n";
			}
		else
			{
			$res .= "<input type=\"hidden\" name=\"id\" value=".$poll_id.">\n";
			$res .= "<input type=\"hidden\" id=\"cvote_".$poll_id."\" name=\"cvote_".$poll_id."\" value=\"\">\n";
			$res .= "<input type=\"hidden\" name=\"a\" value=\"send\">\n";
			if ($cfg['ajax']) 
				{					
				$onclick = "javascript:sedjs.ajax.bind({'url': '?ajax=1&a=send&id='+document.pollvote_".$poll_id.".id.value+'&vote='+document.pollvote_".$poll_id.".cvote_".$poll_id.".value, 'format':  'text', 'method':  'GET', 'update':  'pollajx', 'loading': 'pollajx', 'formid':  'pollajx_".$poll_id."'});";					
				$res .= "<div style=\"text-align:center;\"><input type=\"button\" onClick=\"".$onclick."\" class=\"submit btn\" value=\"".$L['Voteto']."\"></div>\n";
				}
			else 
				{
				$res .= "<div style=\"text-align:center;\"><input type=\"submit\" class=\"submit btn\" value=\"".$L['Voteto']."\"></div>\n";
				}
			$res .= "</form>\n";
			}
			
		$res .= "</div>";	   
		$res_all .= sprintf($mask, $res);
		}
	
	$res_all .= "</div>";
    
	sed_ajax_flush($res_all, $ajax);  // AJAX Output
	
	$res_all = (empty($res_all)) ? $plu_empty : $res_all;

	return($res_all);
	}

?>