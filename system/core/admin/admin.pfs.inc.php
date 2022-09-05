<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=admin.pfs.inc.php
Version=179
Updated=2022-jul-15
Type=Core.admin
Author=Seditio Team
Description=Administration panel
[END_SED]
==================== */

if ( !defined('SED_CODE') || !defined('SED_ADMIN') ) { die('Wrong URL.'); }

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('pfs', 'a');
sed_block($usr['isadmin']);

// ---------- Breadcrumbs
$urlpaths = array();
$urlpaths[sed_url("admin", "m=tools")] =  $L['adm_manage'];
$urlpaths[sed_url("admin", "m=pfs")] =  $L['PFS'];

$admintitle = $L['PFS'];

$t = new XTemplate(sed_skinfile('admin.pfs', false, true)); 

$t -> assign(array( 
	"BUTTON_PFS_CONFIG_URL" => sed_url("admin", "m=config&n=edit&o=core&p=pfs"),
	"BUTTON_SFS_CONFIG_URL" => sed_url("pfs", "userid=0")
));

$t -> parse("ADMIN_PFS.PFS_BUTTONS");

// ============= All PFS ==============================

unset ($disp_list);

$sql = sed_sql_query("SELECT DISTINCT p.pfs_userid, u.user_name, u.user_id, COUNT(*) FROM $db_pfs AS p 
	LEFT JOIN $db_users AS u ON p.pfs_userid=u.user_id
	WHERE pfs_folderid>=0 GROUP BY p.pfs_userid ORDER BY u.user_name ASC");

while ($row = sed_sql_fetchassoc($sql))
	{
	$row['user_name'] = ($row['user_id']==0) ? $L['SFS'] : $row['user_name'];
	$row['user_id'] = ($row['user_id']==0) ? "0" : $row['user_id'];
	
	$t -> assign(array( 
		"PFS_LIST_EDIT" => "<a href=\"".sed_url("pfs", "userid=".$row['user_id'])."\">".$out['ic_edit']."</a>",
		"PFS_LIST_USER" => sed_build_user($row['user_id'], sed_cc($row['user_name'])),
		"PFS_LIST_COUNTFILES" => $row['COUNT(*)']
	));

	$t -> parse("ADMIN_PFS.PFS_LIST");
	}
	
$t->assign("ADMIN_PFS_TITLE", $admintitle);	

$t -> parse("ADMIN_PFS");

$adminmain .= $t -> text("ADMIN_PFS"); 


?>
