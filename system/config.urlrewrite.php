<?php

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=system/config.urlrewrite.php
Version=179
Updated=2013-sep-26
Type=Core
Author=Seditio Team
Description=Url rewriting config
[END_SED]
==================== */

$sed_urlrewrite = array(

    /*  Resizer rewriting */
    array(
         'cond' => '#^/datas/resized/(.+)#',
         'rule' => 'system/core/resizer/resizer.php?file=$1'
    ),
	
    /*  Installation rewriting */
    array(
         'cond' => '#^/install(/?)$#',
         'rule' => 'system/install/install.php'
    ),	

    /*  Captcha rewriting */
    array(
         'cond' => '#^/captcha(/?)$#',
         'rule' => 'system/core/captcha/captcha.php'
    ),
	
    /*  Captcha rewriting */
    array(
         'cond' => '#^/captcha.png$#',
         'rule' => 'system/core/captcha/captcha.php'
    ),	
    
    /*  Viewer rewriting */
    array(
         'cond' => '#^/view/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/view/view.php?v=$1'
    ),
    
    /*  RSS rewriting */
    array(
         'cond' => '#^/rss/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/rss/rss.php?m=$1'
    ),
    array(
         'cond' => '#^/rss(/?)$#',
         'rule' => 'system/core/rss/rss.php'
    ),
    
    /*  Sitemap rewriting */
    array(
         'cond' => '#^/sitemap/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/sitemap/sitemap.php?m=$1'
    ),
    array(
         'cond' => '#^/sitemap(/?)$#',
         'rule' => 'system/core/sitemap/sitemap.php'
    ),  
    array(
         'cond' => '#^/sitemap.xml$#',
         'rule' => 'system/core/sitemap/sitemap.php'
    ), 	
    
    /*  Poll rewriting */
    array(
         'cond' => '#^/polls/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/polls/polls.php?id=$1'
    ),
    array(
         'cond' => '#^/polls(/?)$#',
         'rule' => 'system/core/polls/polls.php'
    ),	
    
    /*  Gallery rewriting */
    array(
         'cond' => '#^/gallery/pic/([0-9]+)(/?)$#',
         'rule' => 'system/core/gallery/gallery.php?id=$1'
    ),
    array(
         'cond' => '#^/gallery/([0-9]+)(/?)$#',
         'rule' => 'system/core/gallery/gallery.php?f=$1'
    ),    
    array(
         'cond' => '#^/gallery(/?)$#',
         'rule' => 'system/core/gallery/gallery.php'
    ),  
    
    /*  PFS rewriting */
    array(
         'cond' => '#^/pfs/([0-9]+)(/?)$#',
         'rule' => 'system/core/pfs/pfs.php?f=$1'
    ),
    array(
         'cond' => '#^/pfs(/?)$#',
         'rule' => 'system/core/pfs/pfs.php'
    ),     
    
    /*  Pm rewriting */
    array(
         'cond' => '#^/pm/mess/([0-9]+)(/?)$#',
         'rule' => 'system/core/pm/pm.php?id=$1'
    ), 
    array(
         'cond' => '#^/pm/action/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/pm/pm.php?m=$1'
    ),                         
    array(
         'cond' => '#^/pm/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/pm/pm.php?f=$1'
    ),  
    array(
         'cond' => '#^/pm(/?)$#',
         'rule' => 'system/core/pm/pm.php'
    ),
    
    /*  Plugins rewriting */   
    array(
         'cond' => '#^/contact(/?)$#',
         'rule' => 'system/core/plug/plug.php?e=contact'
    ),   
    array(
         'cond' => '#^/whosonline(/?)$#',
         'rule' => 'system/core/plug/plug.php?e=whosonline'
    ),   
    array(
         'cond' => '#^/passrecover(/?)$#',
         'rule' => 'system/core/plug/plug.php?e=passrecover'
    ), 
    array(
         'cond' => '#^/plug/([a-zA-Z0-9_-]+)(/?)$#',
         'rule' => 'system/core/plug/plug.php?e=$1'
    ), 
    array(
         'cond' => '#^/plug(/?)$#',
         'rule' => 'system/core/plug/plug.php'
    ),    
    
    /*  Admin area rewriting */   
    array(
         'cond' => '#^/admin/([a-zA-Z0-9_-]+)(/?)$#',
         'rule' => 'system/core/admin/admin.php?m=$1'
    ),
    array(
         'cond' => '#^/admin(/?)$#',
         'rule' => 'system/core/admin/admin.php'
    ),
    
    /*  Users rewriting */
    array(
         'cond' => '#^/users/filter/([a-zA-Z0-9_-]+)/sort/([a-zA-Z]+)-(asc|desc)(/?)$#',
         'rule' => 'system/core/users/users.php?f=$1&s=$2&w=$3'
    ),
    array(
         'cond' => '#^/users/filter/([a-zA-Z0-9_-]+)(/?)$#',
         'rule' => 'system/core/users/users.php?f=$1'
    ),
    array(
         'cond' => '#^/users/group/([0-9]+)/sort/([a-zA-Z]+)-(asc|desc)(/?)$#',
         'rule' => 'system/core/users/users.php?f=all&gm=$1&s=$2&w=$3'
    ),
    array(
         'cond' => '#^/users/group/([0-9]+)(/?)$#',
         'rule' => 'system/core/users/users.php?gm=$1'
    ),
    array(
         'cond' => '#^/users/maingroup/([0-9]+)/sort/([a-zA-Z]+)-(asc|desc)(/?)$#',
         'rule' => 'system/core/users/users.php?f=all&g=$1&s=$2&w=$3'
    ), 
    array(
         'cond' => '#^/users/maingroup/([0-9]+)(/?)$#',
         'rule' => 'system/core/users/users.php?g=$1'
    ),
    array(
         'cond' => '#^/users/([a-zA-Z]+)/([a-zA-Z]+)(/?)$#',
         'rule' => 'system/core/users/users.php?m=$1&a=$2'
    ),  		   
    array(
         'cond' => '#^/users/([a-zA-Z]+)/([0-9]+)(/?)$#',
         'rule' => 'system/core/users/users.php?m=$1&id=$2'
    ),      
    array(
         'cond' => '#^/users/([a-zA-Z]+)(/?)$#',
         'rule' => 'system/core/users/users.php?m=$1'
    ),    
    array(
         'cond' => '#^/users(/?)$#',
         'rule' => 'system/core/users/users.php'
    ),
    array(
         'cond' => '#^/register(/?)$#',
         'rule' => 'system/core/users/users.php?m=register'
    ),
    array(
         'cond' => '#^/login(/?)$#',
         'rule' => 'system/core/users/users.php?m=auth'
    ),
    
    /*  Messages rewriting */
    array(
         'cond' => '#^/message/([0-9]+)/([a-zA-Z0-9]+)(/?)$#',
         'rule' => 'system/core/message/message.php?msg=$1&redirect=$2'
    ), 
    array(
         'cond' => '#^/message/([0-9]+)(/?)$#',
         'rule' => 'system/core/message/message.php?msg=$1'
    ),                 
    
    /*  Lists rewriting */
	  array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([a-zA-Z0-9_\-\+/%]+)/sort/([a-zA-Z]+)-(asc|desc)(/?)$#',
         'rule' => 'system/core/list/list.php?c=$2&s=$3&w=$4' 
    ),
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+%]+)/sort/([a-zA-Z]+)-(asc|desc)(/?)$#',
         'rule' => 'system/core/list/list.php?c=$1&s=$2&w=$3' 
    ),    
                     
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([a-zA-Z0-9_\-\+/%]+)/$#',
         'rule' => 'system/core/list/list.php?c=$2'
    ),
    array(
         /* If you will not use the system pages set  #^/([a-zA-Z0-9_\-\+%]+)(/?)$#  */
         'cond' => '#^/([a-zA-Z0-9_\-\+%]+)/$#', 
         'rule' => 'system/core/list/list.php?c=$1'
         ),     
    
    /*  Pages rewriting */
    array(
         'cond' => '#^/page/([a-zA-Z]+)(/?)$#',
         'rule' => 'system/core/page/page.php?m=$1'
    ),
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([0-9]+)/download(/?)$#',
         'rule' => 'system/core/page/page.php?id=$2&a=dl'
    ),
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([a-zA-Z0-9_\-\+%]+)/download(/?)$#',
         'rule' => 'system/core/page/page.php?al=$2&a=dl'
    ), 
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([0-9]+)/comments(/?)$#',
         'rule' => 'system/core/page/page.php?id=$2&comments=1'
    ),                  
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([a-zA-Z0-9_\-\+%]+)/comments(/?)$#',
         'rule' => 'system/core/page/page.php?al=$2&comments=1'
    ),
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([0-9]+)$#',
         'rule' => 'system/core/page/page.php?id=$2'
    ),                   
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+/%]+)/([a-zA-Z0-9_\-\+%]+)$#',
         'rule' => 'system/core/page/page.php?al=$2'          
    ),
    
    /* For "system" pages */
    array(
         'cond' => '#^/([0-9]+)$#',
         'rule' => 'system/core/page/page.php?id=$1'
    ),                   
    array(
         'cond' => '#^/([a-zA-Z0-9_\-\+%]+)$#',
         'rule' => 'system/core/page/page.php?al=$1'          
    ),
    /*------------------*/
         
    /*  Index rewriting */
    array(
         'cond' => '#^/$#',
         'rule' => 'system/core/index/index.php'                
    )
);
                 

?>