<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=plugins/passrecover/passrecover.php
Version=179
Updated=2022-aug-03
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=passrecover
Part=main
File=passrecover
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE') || !defined('SED_PLUG')) { die('Wrong URL.'); }

$a = sed_import('a','G','TXT');
$v = sed_import('v','G','TXT');
$email = sed_import('email','P','TXT');

$plugin_title = $L['plu_title'];

$generate_password = $cfg['plugin']['passrecover']['generate_password'];

if ($a == 'request' && $email != '')
	{
	sed_shield_protect();
	$sql = sed_sql_query("SELECT user_id, user_name, user_lostpass FROM $db_users WHERE user_email='".sed_sql_prep($email)."' ORDER BY user_id ASC LIMIT 1");

	if ($row = sed_sql_fetchassoc($sql))
		{
		$rusername = $row['user_name'];
		$ruserid = $row['user_id'];
		$validationkey = $row['user_lostpass'];

		if (empty($validationkey) || $validationkey == "0")
			{
			$validationkey = md5(microtime());
			$sql = sed_sql_query("UPDATE $db_users SET user_lostpass='$validationkey', user_lastip='".$usr['ip']."' WHERE user_id='$ruserid'");
			
			}

		sed_shield_update(60, "Password recovery email sent");

		$rsubject = $cfg['maintitle']." - ".$L['plu_title'];
		
		if ($generate_password == "no") 
			{
				$ractivate = $cfg['mainurl']."/".sed_url("plug", "e=passrecover&a=auth&v=".$validationkey, "", false, false);
				$email_text = $L['plu_email1'];
				$t->parse("MAIN.PLUGIN_PASSRECOVER_AUTH");
			}
		else 
			{
				$ractivate = $cfg['mainurl']."/".sed_url("plug", "e=passrecover&a=newpassword&v=".$validationkey, "", false, false);
				$email_text = $L['plu_email2'];
				$t->parse("MAIN.PLUGIN_PASSRECOVER_NEWPASSWORD");
			}	
		
		$rbody = $L['Hi']." ".$rusername.",\n\n".$email_text."\n\n".$ractivate. "\n\n".$L['aut_contactadmin'];
		sed_mail ($email, $rsubject, $rbody);
		}
	else
		{
		sed_shield_update(10, "Password recovery requested");
		sed_log("Pass recovery failed, user : ".$rusername);
		sed_redirect(sed_url("message", "msg=151", "", true));
		exit;
		}
	}
elseif (($a == 'auth' || $a == 'newpassword') && mb_strlen($v) == 32)
	{
	sed_shield_protect();

	$sql = sed_sql_query("SELECT user_name, user_id, user_secret, user_email, user_maingrp, user_banexpire, user_skin FROM $db_users WHERE user_lostpass='".sed_sql_prep($v)."'");

	if ($row = sed_sql_fetchassoc($sql))
		{
		$rmdpass_secret  = $row['user_secret'];
		$rusername = $row['user_name'];
		$ruserid = $row['user_id'];
		$rdefskin = $row['user_skin'];
		$remail = $row['user_email'];

		if ($row['user_maingrp'] == 2)
			{
			sed_log("Password recovery failed, user inactive : ".$rusername);
			sed_redirect(sed_url("message", "msg=152", "", true));
			exit;
			}

	 	if ($row['user_maingrp'] == 3)
			{
			sed_log("Password recovery failed, user banned : ".$rusername);
			sed_redirect(sed_url("message", "msg=153&num=".$row['user_banexpire'], "", true));
			exit;
			}
		
		$validationkey = md5(microtime());
		$sql = sed_sql_query("UPDATE $db_users SET user_lostpass='$validationkey' WHERE user_id='$ruserid'");

		if ($generate_password == "yes" && $a == 'newpassword') 
			{
			$newpassword = sed_unique(7); // New sed172  					
			$mdsalt = sed_unique(16); // New sed172    
			$mdpass = sed_hash($newpassword, 1, $mdsalt);  // New sed172    		    	
			
			$sql = sed_sql_query("UPDATE $db_users SET user_password='$mdpass', user_salt='$mdsalt', user_passtype=1 WHERE user_id='$ruserid'");
			
			$rsubject = $cfg['maintitle']." - ".$L['plu_title'];
			
			$rbody = $L['Hi']." ".$rusername.",\n\n".$L['plu_email3'].$newpassword. "\n\n".$L['aut_contactadmin'];
			sed_mail ($remail, $rsubject, $rbody);
			
			$t->parse("MAIN.PLUGIN_PASSRECOVER_GENERATEPASS");
			}
		else 
			{	
				if ($cfg['authmode'] == 1 || $cfg['authmode'] == 3)
					{
					$u = base64_encode("$ruserid:_:$rmdpass_secret:_:".$cfg['defaultskin']);
					sed_setcookie($sys['site_id'], $u, time() + 86400, $cfg['cookiepath'], $cfg['cookiedomain'], $sys['secure'], true);
					}

				if ($cfg['authmode'] == 2 || $cfg['authmode'] == 3)
					{
					$_SESSION[$sys['site_id'].'_n'] = $ruserid;
					$_SESSION[$sys['site_id'].'_p'] = $rmdpass_secret;
					$_SESSION[$sys['site_id'].'_s'] = $rdefskin;
					}

				$t->assign("PLUGIN_PASSRECOVER_LOGGED_USERNAME", $rusername);
			
			$t->parse("MAIN.PLUGIN_PASSRECOVER_LOGGED");
			
			}
		}
	else
		{
		sed_shield_update(7,"Log in");
		sed_log("Pass recovery failed, user : ".$rusername);
		sed_redirect(sed_url("message", "msg=151", "", true));
		exit;
		}
	}
else
	{
	$t -> assign(array(
		"PLUGIN_PASSRECOVER_SEND" => sed_url("plug", "e=passrecover&a=request"),
		"PLUGIN_PASSRECOVER_EMAIL" => sed_textbox('email', '', 22, 64)
	));	
	$t -> parse("MAIN.PLUGIN_PASSRECOVER_RECOVER");	
	}
	
// ---------- Breadcrumbs
$urlpaths = array();
$urlpaths[sed_url("plug", "e=passrecover")] = $L['plu_title'];	
	
$t->assign(array(
  "PLUGIN_PASSRECOVER_TITLE" => $L['plu_title'],
  "PLUGIN_PASSRECOVER_BREADCRUMBS" => sed_breadcrumbs($urlpaths),
 ));

?>