<?php

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.com.tr
-----------------------
Seditio language pack
Language : Türkçe (code:tr)
Localization done by : Neocrome
-----------------------
[BEGIN_SED]
File=system/core/admin/lang/tr/admin.lang.php
Version=179
Updated=2022-jul-15
Type=Lang
Author=Seditio Team
Description=Admin panel
[END_SED]
==================== */

/* ====== Core ====== */

$L['core_main'] = "Ana kurulum";
$L['core_parser'] = "Ayrıştırıcı"; 			// New in v120
$L['core_rss'] = "RSS beslemeleri"; 			// New in v173
$L['core_dic'] = "Dizinler ve Ekstra alanlar"; 			// New in v173
$L['core_time'] = "Saat ve tarih";
$L['core_skin'] = "Temalar";
$L['core_lang'] = "Diller";
$L['core_menus'] = "Menü yuvaları";
$L['core_comments'] = "Yorumlar";
$L['core_page'] = "Sayfalar";
$L['core_pfs'] = "Kişisel dosya alanı";
$L['core_gallery'] = "Galeri";
$L['core_plug'] = "Eklentiler";
$L['core_pm'] = "Özel mesajlar";
$L['core_polls'] = "Anketler";
$L['core_ratings'] = "Derecelendirmeler";
$L['core_trash'] = "Çöp tenekesi";
$L['core_users'] = "Üyeler";
$L['core_meta'] = "HTML Meta";
$L['core_index'] = "Ana sayfa";
$L['core_menu'] = "Menü Yöneticisi"; // New in v178

/* ====== Upgrade ====== */

$L['upg_upgrade'] = "Güncelleme";      // New in v130
$L['upg_codeversion'] = "Kod sürümü";     // New in v130
$L['upg_sqlversion'] = "SQL veritabanı sürümü";    // New in v130
$L['upg_codeisnewer'] = "Kod, SQL sürümünden daha yeni.";    // New in v130
$L['upg_codeisolder'] = "Kod SQL sürümünden daha eski, bu olağandışı ve desteklenmiyor.<br />Tüm dosyaları en yeni paketten yüklediğinizi iki kez kontrol etmelisiniz..";    // New in v130
$L['upg_codeissame'] = "Kod ve SQL sürümleri eşleşiyor.";    // New in v130
$L['upg_upgradenow'] = "SQL veritabanını hemen yükseltmeniz şiddetle tavsiye edilir, yükseltmek için buraya tıklayın !";    // New in v130
$L['upg_upgradenotavail'] = "Bu sürüm numaraları için yükseltme yok.";       // New in v130
$L['upg_manual'] = "Veritabanını manuel olarak yükseltmeyi tercih ederseniz, SQL komut dosyaları /docs/upgrade/ klasöründedir..";       // New in v130
$L['upg_success'] = "Yükseltme başarılı oldu, devam etmek için burayı tıklayın...";       // New in v130
$L['upg_failure'] = "Yükseltme başarısız oldu, devam etmek için burayı tıklayın...";       // New in v130
$L['upg_force'] = "Bazı nedenlerden dolayı SQL veritabanında yazılan Seditio sürüm numarası yanlış olabilir.. Aşağıda SQL sürüm numarasını zorlamak için bir düğme bulunmaktadır, bu yalnızca SQL veritabanını etiketleyecektir, başka bir değişiklik YAPMAYACAKTIR.<br />SQL sürüm numarasını zorla : ";	// New in v130

/* ====== General ====== */

$L['editdeleteentries'] = "Girişleri düzenleyin veya silin";
$L['viewdeleteentries'] = "Girişleri görüntüleyin veya silin";
$L['addnewentry'] = "Yeni bir giriş ekle";
$L['adm_purgeall'] = "Tümünü temizle";
$L['adm_listisempty'] = "Liste boş";
$L['adm_totalsize'] = "Toplam boyut";
$L['adm_showall'] = "Hepsini Göster ↓";
$L['adm_area'] = "Alan";
$L['adm_option'] = "Seçenek";
$L['adm_setby'] = "Olarak ayarla";
$L['adm_more'] = "Daha fazla araç...";
$L['adm_from'] = "Nereden";
$L['adm_to'] = "Nereye";
$L['adm_confirm'] = "Onaylamak için bu düğmeye basın : ";
$L['adm_done'] = "Tamamlandı";
$L['adm_failed'] = "Hatalı";
$L['adm_warnings'] = "Uyarılar";
$L['adm_valqueue'] = "Doğrulama bekleniyor";
$L['adm_required'] = "(Gerekli)";
$L['adm_clicktoedit'] = "(Düzenlemek için tıkla)";
$L['adm_manage'] = "Araçlar";  // New in v150
$L['adm_pagemanager'] = "Sayfa yöneticisi";  // New in v177
$L['adm_module_name'] = "Modül Adı";  // New in v178
$L['adm_tool_name'] = "Araç adı";  // New in v178

/* ====== Banlist ====== */

$L['adm_ipmask'] = "IP mask";
$L['adm_emailmask'] = "Email mask";
$L['adm_neverexpire'] = "Hiç bir zaman";
$L['adm_help_banlist'] = "IP maskeleri için örnekler :194.31.13.41 , 194.31.13.* , 194.31.*.* , 194.*.*.*<br />E-posta maskeleri için örnekler : @hotmail.com, @yahoo (Joker karakterler desteklenmez)<br />Tek bir giriş, bir IP maskesi veya bir e-posta maskesi veya her ikisini birden içerebilir.<br />IP'ler, görüntülenen her sayfa için filtrelenir ve e-posta maskeleri yalnızca kullanıcı kaydı sırasında filtrelenir.";

/* ====== Cache ====== */

$L['adm_internalcache'] = "Dahili önbellek";
$L['adm_help_cache'] = "Müsait değil";

/* ====== Configuration ====== */

$L['adm_help_config']= "Müsait değil";
$L['cfg_adminemail'] = array("Yöneticinin e-postası", "Gerekli");
$L['cfg_maintitle'] = array("Site Başlığı", "Web sitesi için ana başlık, gerekli");
$L['cfg_subtitle'] = array("Description", "İsteğe bağlı, site başlığından sonra gösterilecektir");
$L['cfg_mainurl'] = array("Site URL", "https:// ile ve sonda slash olmayacak !");
$L['cfg_clustermode'] = array("Sunucu kümesi", "Yük dengeli bir kurulum ise evet olarak ayarlayın.");			// New in v125
$L['cfg_hostip'] = array("Server IP", "Sunucunun IP'si, isteğe bağlı.");
$L['cfg_gzip'] = array("Gzip", "HTML çıktısının Gzip sıkıştırması");
$L['cfg_cache'] = array("Internal cache", "Daha iyi performans için etkin durumda tutun");
$L['cfg_devmode'] = array("Debugging mode", "Bunun canlı sitelerde etkinleştirilmesine izin verme");
$L['cfg_doctypeid'] = array("Document Type", "&lt;!DOCTYPE> of the HTML layout");
$L['cfg_charset'] = array("HTML charset", "");
$L['cfg_cookiedomain'] = array("Çerezler için alan", "Varsayılan: boş");
$L['cfg_cookiepath'] = array("Çerezler için yol", "Varsayılan: boş");
$L['cfg_cookielifetime'] = array("Maksimum çerezlerin ömrü", "Saniye cinsinden");
$L['cfg_metakeywords'] = array("HTML Meta anahtar sözcükleri (virgülle ayrılmış)", "Arama motorları");
$L['cfg_disablesysinfos'] = array("Sayfa oluşturma süresini kapat", "footer.tpl de");
$L['cfg_keepcrbottom'] = array("Telif hakkı bildirimi {FOOTER_BOTTOMLINE}", "footer.tpl de");
$L['cfg_showsqlstats'] = array("SQL sorgu istatistiklerini göster", "footer.tpl de");
$L['cfg_shieldenabled'] = array("Kalkanı Etkinleştir", "Anti-spam ve hızlı vuruş");
$L['cfg_shieldtadjust'] = array("Anti-spam kalkanı ayarla (%)", "Ne kadar yüksek olursa, spam göndermek o kadar zor olur");
$L['cfg_shieldzhammer'] = array("Hızlı vuruştan sonra Anti-Hammer *", "Ne kadar küçükse, 3 dakika otomatik yasaklama o kadar hızlı gerçekleşir");
$L['cfg_maintenance'] = array("Bakım Modu", "Sitedeki teknik çalışmaları duyurun");  // New in v175
$L['cfg_maintenancelevel'] = array("Kullanıcı Erişim Düzeyi", "Kullanıcıların erişim düzeyini seçin"); // New in v175
$L['cfg_maintenancereason'] = array("Bakım nedeni", "Bakımın nedenini açıklayın"); // New in v175
$L['cfg_multihost'] = array("Multihost mode", "Birden çok ana bilgisayarı etkinleştirmek için");  // New in v175
$L['cfg_absurls'] = array("Absolute URL", "Mutlak URL kullanımını etkinleştirir");  // New in v175
$L['cfg_sefurls'] = array("SEF URLs", "Sitede SEF URL'lerini etkinleştirmek için");  // New in v175
$L['cfg_sefurls301'] = array("301, SEF URL'lerine yönlendirme", "Eski URL'den SEF URL'lerine 301 yönlendirmesini etkinleştir");  // New in v175
$L['cfg_dateformat'] = array("Ana tarih maskesi", "Varsayılan: Y-m-d H:i");
$L['cfg_formatmonthday'] = array("Kısa tarih maskesi", "Varsayılan: m-d");
$L['cfg_formatyearmonthday'] = array("Orta tarih maskesi", "Varsayılan: Y-m-d");
$L['cfg_servertimezone'] = array("Sunucu saat dilimi", "Sunucu varsayılan GMT+00");
$L['cfg_defaulttimezone'] = array("Varsayılan saat dilimi", "-12'den +12'ye kadar misafirler ve yeni üyeler için");
$L['cfg_timedout'] = array("Boşta kalma süresi", "Bu süreden sonra kullanıcı uzakta olarak ayarlanır");
$L['cfg_maxusersperpage'] = array("Kullanıcı listesindeki maksimum satır", "");
$L['cfg_regrequireadmin'] = array("Yeni hesaplar Yönetici tarafından onaylanır", "");
$L['cfg_regnoactivation'] = array("Yeni kullanıcılar için e-posta kontrolünü atla", "\"Hayır\" güvenlik nedeniyle tavsiye edilir");
$L['cfg_useremailchange'] = array("Kullanıcıların e-posta adreslerini değiştirmesine izin ver", "\"Hayır\" güvenlik nedeniyle tavsiye edilir");
$L['cfg_usertextimg'] = array("Kullanıcı imzasında resimlere ve HTML'ye izin ver", "\"Hayır\" güvenlik nedeniyle tavsiye edilir");
$L['cfg_av_maxsize'] = array("Avatar, maksimum dosya boyutu", "Varsayılan: 8000 bytes");
$L['cfg_av_maxx'] = array("Avatar, maksimum genişlik", "Varsayılan: 64 pixels");
$L['cfg_av_maxy'] = array("Avatar, maksimum yükseklik", "Varsayılan: 64 pixels");
$L['cfg_usertextmax'] = array("Kullanıcı imzası için maksimum uzunluk", "Varsayılan: 300 karakter");
$L['cfg_sig_maxsize'] = array("İmza, maksimum dosya boyutu", "Varsayılan: 50000 bytes");
$L['cfg_sig_maxx'] = array("İmza, maksimum genişlik", "Varsayılan: 468 pixels");
$L['cfg_sig_maxy'] = array("İmza, maksimum yükseklik", "Varsayılan: 60 pixels");
$L['cfg_ph_maxsize'] = array("Fotoğraf, maksimum dosya boyutu", "Varsayılan: 8000 bytes");
$L['cfg_ph_maxx'] = array("Fotoğraf, maksimum genişlik", "Varsayılan: 96 pixels");
$L['cfg_ph_maxy'] = array("Fotoğraf, maksimum yükseklik", "Varsayılan: 96 pixels");
$L['cfg_maxrowsperpage'] = array("Listelerdeki maksimum satır sayısı", "");
$L['cfg_showpagesubcatgroup'] = array("Alt bölümlerde grup sayfalarını göster", "");   //New Sed171
$L['cfg_genseourls'] = array("SEO url'si oluştur (otomatik gen* sayfa alias)? ", "");   //New Sed178
$L['cfg_maxcommentsperpage'] = array("Sayfa başına maksimum yorum", "");  //New Sed173
$L['cfg_commentsorder'] = array("Yorumlar için sıralama düzeni", "ASC - new bottom, DESC - en yeni en üstte");  //New Sed173
$L['cfg_maxtimeallowcomedit'] = array("Yorumları düzenlemek için izin verilen süre", "Dakika içinde, 0 ise - düzenleme yasaktır");  //New Sed173
$L['cfg_showcommentsonpage'] = array("Sayfalardaki yorumları göster", "Varsayılan olarak sayfada yorumu görüntüler");   //New Sed171
$L['cfg_maxcommentlenght'] = array("Bir yorumun maksimum uzunluğu", "Varsayılan: 2000 characters");  //New Sed175
$L['cfg_countcomments'] = array("Yorumları say", "Simgenin yanında yorum sayısını göster");
$L['cfg_pfsuserfolder'] = array("Klasör depolama modu", "Etkinleştirilirse, dosya adının başına USERID'yi eklemek yerine kullanıcı dosyalarını /datas/users/USERID/... alt klasörlerinde depolar.. SADECE sitenin İLK kurulumunda ayarlanmalıdır. Bir dosya bir PFS'ye yüklenir yüklenmez bunu değiştirmek için çok geç.");
$L['cfg_th_amode'] = array("Küçük resim oluşturma", "");
$L['cfg_th_x'] = array("Küçük resimler, genişlik", "Varsayılan: 112 pixels");
$L['cfg_th_y'] = array("Küçük resimler, yükseklik", "Varsayılan: 84 pixel, recommended : Width x 0.75");
$L['cfg_th_border'] = array("Küçük resimler, kenarlık boyutu", "Varsayılan: 4 pixels");
$L['cfg_th_keepratio'] = array("Küçük resim, oranı koru ?", "");
$L['cfg_th_jpeg_quality'] = array("Küçük resimler, JPEG kalitesi", "Varsayılan: 85");
$L['cfg_th_colorbg'] = array("Küçük resimler, kenarlık rengi", "Varsayılan: 000000, hex color code");
$L['cfg_th_colortext'] = array("Küçük resimler, metin rengi", "Varsayılan: FFFFFF, hex color code");
$L['cfg_th_rel'] = array("Küçük resim rel özelliği", "Varsayılan: sedthumb"); // New in v175
$L['cfg_th_dimpriority'] = array("Küçük resimler, yeniden boyutlandırma ölçütü", "Varsayılan: Width");       // New in v160
$L['cfg_th_textsize'] = array("Küçük resimler, metnin boyutu", "");
$L['cfg_pfs_filemask'] = array("Zaman düzenine göre dosya adları", "Bir zaman düzeninde dosya adları oluşturun");  // New in sed172

$L['cfg_disable_gallery'] = array("Galeriyi devre dışı bırak", "");     	// New in v150
$L['cfg_gallery_gcol'] = array("Galeriler için sütun sayısı", "Varsayılan : 4");     // New in v150
$L['cfg_gallery_bcol'] = array("Resimler için sütun sayısı", "Varsayılan : 6");    	// New in v150
$L['cfg_gallery_logofile'] = array("Tüm yeni PFS görüntülerine eklenecek Png/jpeg/Gif logosu", "Devre dışı bırakmak için boş bırakın");    	// New in v150
$L['cfg_gallery_logopos'] = array("PFS görüntülerinde logonun konumu", "Varsayılan : Bottom left");    	// New in v150
$L['cfg_gallery_logotrsp'] = array("Logo için birleştirme seviyesi %", "Varsayılan : 50");    	// New in v150
$L['cfg_gallery_logojpegqual'] = array("Jpeg ise, logo eklendikten sonraki resim kalitesi", "Varsayılan : 90");    	// New in v150
$L['cfg_gallery_imgmaxwidth'] = array("Görüntülenen bir resim için piksel cinsinden maksimum genişlik, daha büyükse küçültülmüş bir kopya işlenir", "");     	// New in v150

$L['cfg_pm_maxsize'] = array("Mesajlar için maksimum uzunluk", "Varsayılan: 10000 chars");
$L['cfg_pm_allownotifications'] = array("E-posta ile PM bildirimlerine izin ver", "");
$L['cfg_disablehitstats'] = array("İsabet istatistiklerini devre dışı bırak", "Referanslar ve günlük isabet sayısı");
$L['cfg_disablereg'] = array("Kayıt işlemini devre dışı bırak", "Kullanıcıların yeni hesaplar kaydetmesini engelle");
$L['cfg_disablewhosonline'] = array("Kimin çevrimiçi olduğunu devre dışı bırak", "Kalkanı açarsanız otomatik olarak etkinleştirilir");
$L['cfg_defaultcountry'] = array("Yeni kullanıcılar için varsayılan ülke", "2 harfli ülke kodu");	// New in v130
$L['cfg_forcedefaultskin'] = array("Tema değiştirmeye izin verme", "");
$L['cfg_forcedefaultlang'] = array("Dil değiştirmeye izin verme", "");
$L['cfg_separator'] = array("Genel ayırıcı", "Default:>");
$L['cfg_menu1'] = array("Menü yuvası #1<br />{PHP.cfg.menu1} tüm tpl dosyalarında", "");
$L['cfg_menu2'] = array("Menü yuvası #2<br />{PHP.cfg.menu2} tüm tpl dosyalarında", "");
$L['cfg_menu3'] = array("Menü yuvası #3<br />{PHP.cfg.menu3} tüm tpl dosyalarında", "");
$L['cfg_menu4'] = array("Menü yuvası #4<br />{PHP.cfg.menu4} tüm tpl dosyalarında", "");
$L['cfg_menu5'] = array("Menü yuvası #5<br />{PHP.cfg.menu5} tüm tpl dosyalarında", "");
$L['cfg_menu6'] = array("Menü yuvası #6<br />{PHP.cfg.menu6} tüm tpl dosyalarında", "");
$L['cfg_menu7'] = array("Menü yuvası #7<br />{PHP.cfg.menu7} tüm tpl dosyalarında", "");
$L['cfg_menu8'] = array("Menü yuvası #8<br />{PHP.cfg.menu8} tüm tpl dosyalarında", "");
$L['cfg_menu9'] = array("Menü yuvası #9<br />{PHP.cfg.menu9} tüm tpl dosyalarında", "");
$L['cfg_topline'] = array("Üst çizgi<br />{HEADER_TOPLINE} header.tpl de", "");
$L['cfg_banner'] = array("Banner<br />{HEADER_BANNER} header.tpl de", "");
$L['cfg_motd'] = array("Günün mesajı<br />{NEWS_MOTD} index.tpl de", "");
$L['cfg_bottomline'] = array("Alt çizgi<br />{FOOTER_BOTTOMLINE} footer.tpl de", "");
$L['cfg_freetext1'] = array("Serbest Metin Yuvası #1<br />{PHP.cfg.freetext1} tüm tpl dosyalarında", "");
$L['cfg_freetext2'] = array("Serbest Metin Yuvası #2<br />{PHP.cfg.freetext2} tüm tpl dosyalarında", "");
$L['cfg_freetext3'] = array("Serbest Metin Yuvası #3<br />{PHP.cfg.freetext3} tüm tpl dosyalarında", "");
$L['cfg_freetext4'] = array("Serbest Metin Yuvası #4<br />{PHP.cfg.freetext4} tüm tpl dosyalarında", "");
$L['cfg_freetext5'] = array("Serbest Metin Yuvası #5<br />{PHP.cfg.freetext5} tüm tpl dosyalarında", "");
$L['cfg_freetext6'] = array("Serbest Metin Yuvası #6<br />{PHP.cfg.freetext6} tüm tpl dosyalarında", "");
$L['cfg_freetext7'] = array("Serbest Metin Yuvası #7<br />{PHP.cfg.freetext7} tüm tpl dosyalarında", "");
$L['cfg_freetext8'] = array("Serbest Metin Yuvası #8<br />{PHP.cfg.freetext8} tüm tpl dosyalarında", "");
$L['cfg_freetext9'] = array("Serbest Metin Yuvası #9<br />{PHP.cfg.freetext9} tüm tpl dosyalarında", "");
$L['cfg_extra1title'] = array("Alan #1 (String), title", "");
$L['cfg_extra2title'] = array("Alan #2 (String), title", "");
$L['cfg_extra3title'] = array("Alan #3 (String), title", "");
$L['cfg_extra4title'] = array("Alan #4 (String), title", "");
$L['cfg_extra5title'] = array("Alan #5 (String), title", "");
$L['cfg_extra6title'] = array("Alan #6 (Select box), title", "");
$L['cfg_extra7title'] = array("Alan #7 (Select box), title", "");
$L['cfg_extra8title'] = array("Alan #8 (Select box), title", "");
$L['cfg_extra9title'] = array("Alan #9 (Long text), title", "");
$L['cfg_extra1tsetting'] = array("Bu alandaki maksimum karakter", "");
$L['cfg_extra2tsetting'] = array("Bu alandaki maksimum karakter", "");
$L['cfg_extra3tsetting'] = array("Bu alandaki maksimum karakter", "");
$L['cfg_extra4tsetting'] = array("Bu alandaki maksimum karakter", "");
$L['cfg_extra5tsetting'] = array("Bu alandaki maksimum karakter", "");
$L['cfg_extra6tsetting'] = array("Seçim kutusu için değerler, virgülle ayrılmış", "");
$L['cfg_extra7tsetting'] = array("Seçim kutusu için değerler, virgülle ayrılmış", "");
$L['cfg_extra8tsetting'] = array("Seçim kutusu için değerler, virgülle ayrılmış", "");
$L['cfg_extra9tsetting'] = array("Metin için maksimum uzunluk", "");
$L['cfg_extra1uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra2uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra3uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra4uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra5uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra6uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra7uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra8uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_extra9uchange'] = array("Kullanıcı profilinde düzenlenebilir ?", "");
$L['cfg_disable_comments'] = array("Yorumları devre dışı bırak", "");
$L['cfg_disable_pfs'] = array("PFS'yi devre dışı bırakın", "");
$L['cfg_disable_polls'] = array("Anketleri devre dışı bırak", "");
$L['cfg_disable_pm'] = array("Özel mesajları devre dışı bırak", "");
$L['cfg_disable_ratings'] = array("Derecelendirmeleri devre dışı bırak", "");
$L['cfg_disable_page'] = array("Sayfaları devre dışı bırak", "");
$L['cfg_disable_plug'] = array("Eklentileri devre dışı bırak", "");
$L['cfg_trash_prunedelay'] = array("Silinenleri * gün sonra çöp kutusundan sil (Sonsuza kadar saklamak için sıfır)", ""); 	
$L['cfg_trash_comment'] = array("Yorumlar için çöp kutusunu kullanın", "");			
$L['cfg_trash_page'] = array("Sayfalar için çöp kutusunu kullanın", "");		
$L['cfg_trash_pm'] = array("Özel mesajlar için çöp kutusunu kullanın", "");		
$L['cfg_trash_user'] = array("Kullanıcılar için çöp kutusunu kullanın", "");

$L['cfg_parser_vid'] = array("Videolar için BBcode'lara izin ver", "");		// New in v120
$L['cfg_parser_vid_autolink'] = array("URL'leri bilinen video sitelerine otomatik olarak bağla", "");						// New in v120
$L['cfg_parsebbcodecom'] = array("Yorumlarda ve özel mesajlarda BBcode'u ayrıştırın", "");
$L['cfg_parsebbcodepages'] = array("Sayfalarda BBcode ayrıştırma", "");
$L['cfg_parsebbcodeusertext'] = array("Kullanıcı imzasında BBcode ayrıştırma", "");
$L['cfg_parsesmiliescom'] = array("Yorumlarda ve özel mesajlarda ifadeleri ayrıştırın", "");
$L['cfg_parsesmiliespages'] = array("Sayfalardaki ifadeleri ayrıştırın", "");
$L['cfg_parsesmiliesusertext'] = array("Kullanıcı imzasındaki ifadeleri ayrıştır", "");

$L['cfg_color_group'] = array("Kullanıcı grubunu renklendir", "Varsayılan: Hayır, daha iyi performans için");  // New in v175

$L['cfg_ajax'] = array("AJAX'ı etkinleştir", "");  // New in v175
$L['cfg_enablemodal'] = array("Kalıcı pencereleri etkinleştir", "");  // New in v175

$L['cfg_hometitle'] = array("Ana sayfa başlığı", "Opsiyonel, SEO için"); // New in v179
$L['cfg_homemetadescription'] = array("Ana sayfa meta açıklaması", "Opsiyonel, SEO için"); // New in v179
$L['cfg_homemetakeywords'] = array("Ana sayfa meta anahtar kelimeleri", "Opsiyonel, SEO için"); // New in v179

/* ====== HTML Meta ====== */

$L['cfg_defaulttitle'] = array("Varsayılan Başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}");		//Sed 175
$L['cfg_indextitle'] = array("Ana Sayfa Başlığı", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		//Sed 179
$L['cfg_listtitle'] = array("Sayfa listeleri için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		//Sed 175
$L['cfg_pagetitle'] = array("Sayfalar için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}, {CATEGORY}");		//Sed 175
$L['cfg_userstitle'] = array("Kullanıcılar için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		//Sed 175
$L['cfg_pmtitle'] = array("PM için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		//Sed 175
$L['cfg_gallerytitle'] = array("Galeri başlığı", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		//Sed 175
$L['cfg_pfstitle'] = array("PFS için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		///Sed 175
$L['cfg_plugtitle'] = array("Eklentiler için başlık", "Mevcut seçenekler: {MAINTITLE}, {SUBTITLE}, {TITLE}");		///Sed 175

/* ====== Rss ====== */

$L['cfg_disable_rss'] = array("RSS beslemelerini devre dışı bırak", "");
$L['cfg_disable_rsspages'] = array("Sayfalar için RSS beslemesini devre dışı bırak", "");
$L['cfg_disable_rsscomments'] = array("Yorumlar için RSS beslemesini devre dışı bırak", "");
$L['cfg_rss_timetolive'] = array("RSS beslemesi için zaman", "in seconds");
$L['cfg_rss_defaultcode'] = array("Varsayılan RSS beslemesi", "kategori kodunu girin");
$L['cfg_rss_maxitems'] = array("RSS beslemesindeki maksimum satır sayısı", "");

$L['adm_help_config_rss'] = "RSS beslemelerini açmak için bağlantılar: <br />".$cfg['mainurl']."/"."rss (varsayılan olarak, ayarlarda belirtilen haber kategorilerinin çıktısı) <br /> ".$cfg['mainurl']."/"."rss/pages?c=XX (XX - Kategori kodu, kategorinin son sayfaları) <br />".$cfg['mainurl']."/"."rss/comments?id=XX (XX - Sayfa ID, yorumlar sayfası)";

/* ====== IP search ====== */

$L['adm_searchthisuser'] = "Bu IP'yi kullanıcı veritabanında arayın";
$L['adm_dnsrecord'] = "Bu adres için DNS kaydı";

/* ====== Smilies ====== */

$L['adm_help_smilies'] = "Müsait değil";

/* ====== Dictionary ====== */

$L['adm_dic_list'] = "Dizin listesi";
$L['adm_dictionary'] = "Dizin";
$L['adm_dic_title'] = "Dizinin başlığı";
$L['adm_dic_code'] = "Extra alan adı";
$L['adm_dic_list'] = "Dizinlerin listesi";
$L['adm_dic_term_list'] = "Terimler listesi";
$L['adm_dic_add'] = "Yeni dizin ekle";
$L['adm_dic_edit'] = "Dizini düzenle";
$L['adm_dic_add_term'] = "Yeni bir terim ekle";
$L['adm_dic_term_title'] = "Terimin başlığı";
$L['adm_dic_term_value'] = "Terimin değeri";
$L['adm_dic_term_defval'] = "Terimi varsayılan yap?";
$L['adm_dic_term_edit'] = "Dizinden terimi düzenle";
$L['adm_dic_children'] = "Alt dizini";

$L['adm_dic_mera'] = "Birim";
$L['adm_dic_values'] = "Dizin için değer listesi";

$L['adm_dic_form_title'] = "Form öğesi için başlık";
$L['adm_dic_form_desc'] = "Form öğesi için metin";
$L['adm_dic_form_size'] = "Metin alanının boyutu";
$L['adm_dic_form_maxsize'] = "Maksimum metin alanı boyutu";
$L['adm_dic_form_cols'] = "Metin alanının sütunları";
$L['adm_dic_form_rows'] = "Metin alanı satırları";

$L['adm_dic_extra'] = "Ekstra alan";
$L['adm_dic_addextra'] = "Fazladan alan ekle";
$L['adm_dic_editextra'] = "Fazladan alanı düzenle";
$L['adm_dic_extra_location'] = "Tablonun adı";
$L['adm_dic_extra_type'] = "Alanın veri türü";
$L['adm_dic_extra_size'] = "Alan uzunluğu";

$L['adm_dic_comma_separat'] = "(virgülle ayrılmış değerler)";

$L['adm_help_dic'] = ""; //Need add

/* ====== Menu manager ====== */

$L['adm_menuitems'] = "Menü öğeleri";
$L['adm_additem'] = "Öğe eklemek";
$L['adm_position'] = "Durum";
$L['adm_confirm_delete'] = "Silmeyi onayla?";
$L['adm_addmenuitem'] = "Menü öğesi ekle";
$L['adm_editmenuitem'] = "Menü öğesini düzenle";
$L['adm_parentitem'] = "Ana öğe";
$L['adm_url'] = "URL";
$L['adm_activity'] = "Aktif?";

/* ====== PFS ====== */

$L['adm_gd'] = "GD grafik kitaplığı";
$L['adm_allpfs'] = "Tüm PFS";
$L['adm_allfiles'] = "Tüm dosyalar";
$L['adm_thumbnails'] = "Küçük resimler";
$L['adm_orphandbentries'] = "Orphan DB entries";
$L['adm_orphanfiles'] = "Orphan files";
$L['adm_delallthumbs'] = "Tüm küçük resimleri sil";
$L['adm_rebuildallthumbs']= "Tüm küçük resimleri silin ve yeniden oluşturun";
$L['adm_help_pfsthumbs'] = "Müsait değil";
$L['adm_help_check1'] = "Müsait değil";
$L['adm_help_check2'] = "Müsait değil";
$L['adm_help_pfsfiles'] = "Müsait değil";
$L['adm_help_allpfs'] = "Müsait değil";
$L['adm_nogd'] = "GD grafik kitaplığı bu ana bilgisayar tarafından desteklenmiyor, Seditio PFS görüntüleri için küçük resimler oluşturamayacak. Yapılandırma paneline, 'Kişisel Dosya Alanı' sekmesine gitmeli ve Küçük Resim oluşturma = 'Devre Dışı' olarak ayarlamalısınız.'.";

/* ====== Pages ====== */

$L['adm_structure'] = "Sayfaların yapısı (kategoriler)";
$L['adm_syspages'] = "'Sistem' kategorisini görüntüleyin";
$L['adm_help_page'] = "'Sistem' kategorisine ait sayfalar genel listelerde gösterilmez, bağımsız sayfalar yapmak içindir..";
$L['adm_sortingorder'] = "Kategoriler için varsayılan sıralama düzeni";
$L['adm_fileyesno'] = "Dosya (evet/hayır)";
$L['adm_fileurl'] = "File URL";
$L['adm_filesize'] = "File size";
$L['adm_filecount'] = "Dosya indirme";

$L['adm_tpl_mode'] = "Şablon modu";	
$L['adm_tpl_empty'] = "Default";	
$L['adm_tpl_forced'] = "Same as";	
$L['adm_tpl_parent'] = "Ana kategoriyle aynı";	

$L['adm_enablecomments'] = "Yorumları Etkinleştir";   // New v173
$L['adm_enableratings'] = "Derecelendirmeleri Etkinleştir";     // New v173

/* ====== Polls ====== */

$L['adm_help_polls'] = "Yeni bir anket konusu oluşturduktan sonra, bu anket için seçenekler (seçenekler) eklemek için 'Düzenle'yi seçin.<br />'Sil' seçilen anketi, seçenekleri ve ilgili tüm oyları siler.<br />'Sıfırla' seçilen anket için tüm oyları siler. Anketin kendisini veya seçenekleri silmez.<br />'Bump', anket oluşturma tarihini geçerli tarihe değiştirecek ve böylece anketi listenin en üstünde 'geçerli' yapacaktır..";
$L['adm_poll_title'] = "Poll title";

/* ====== Statistics ====== */

$L['adm_phpver'] = "PHP sürümü";
$L['adm_zendver'] = "Zend versiyonu";
$L['adm_interface'] = "Web sunucusu ve PHP arasındaki arayüz";
$L['adm_os'] = "İşletim sistemi";
$L['adm_clocks'] = "Saatler";
$L['adm_time1'] = "#1 : Ham sunucu zamanı";
$L['adm_time2'] = "#2 : Sunucu tarafından döndürülen GMT zamanı";
$L['adm_time3'] = "#3 : GMT zamanı + sunucu ofseti (Seditio referansı)";
$L['adm_time4'] = "#4 : Profilinizden ayarlanan yerel saatiniz";
$L['adm_help_versions'] = "3 numaralı saatin doğru şekilde ayarlanması için Sunucu saat dilimini ayarlayın.<br />4 numaralı saat, profilinizdeki saat dilimi ayarına bağlıdır.<br />1 ve 2 numaralı saatler Seditio tarafından yok sayılır.";
$L['adm_log'] = "Sistem günlüğü";
$L['adm_infos'] = "Bilgiler";
$L['adm_versiondclocks'] = "Sürümler ve saatler";
$L['adm_checkcoreskins'] = "Çekirdek dosyaları ve temayı kontrol edin";
$L['adm_checkcorenow'] = "Çekirdek dosyaları şimdi kontrol edin !";
$L['adm_checkingcore'] = "Çekirdek dosyaları kontrol etme...";
$L['adm_checkskins'] = "Tüm dosyaların temada olup olmadığını kontrol edin";
$L['adm_checkskin'] = "Tema için TPL dosyalarını kontrol edin";
$L['adm_checkingskin'] = "Temayı kontrol etmek...";
$L['adm_hits'] = "Hit";
$L['adm_check_ok'] = "Ok";
$L['adm_check_missing'] = "Eksik";
$L['adm_ref_lowhits'] = "Reflerin 5'ten düşük olduğu girişleri temizle";
$L['adm_maxhits'] = "Maksimum isabet sayısına ulaşıldı %1\$s, bu gün görüntülenen %2\$s sayfa."; 
$L['adm_byyear'] = "Yıla göre"; 		
$L['adm_bymonth'] = "Aya göre"; 	
$L['adm_byweek'] = "Haftaya göre"; 		

/* ====== Ratings ====== */

$L['adm_ratings_totalitems'] = "Puanlanan toplam sayfa sayısı";
$L['adm_ratings_totalvotes'] = "Toplam oy";
$L['adm_help_ratings'] = "Bir derecelendirmeyi sıfırlamak için silmeniz yeterlidir. İlk yeni oylama ile yeniden oluşturulacak.";

/* ====== Trash can ====== */

$L['adm_help_trashcan'] = "Kullanıcılar ve moderatörler tarafından en son silinen öğeler burada listelenmiştir.<br /> &nbsp;<br />Sil : Öğeyi sonsuza kadar silin.<br />Geri Yükle : Öğeyi veritabanına geri yükle."; 

/* ====== Users ====== */

$L['adm_defauth_members'] = "Üyeler için varsayılan haklar";
$L['adm_deflock_members'] = "Üyeler için maskeyi kilitle";
$L['adm_defauth_guests'] = "Misafirler için varsayılan haklar";
$L['adm_deflock_guests'] = "Misafirler için maskeyi kilitle";
$L['adm_rightspergroup'] = "Grup başına haklar";
$L['adm_copyrightsfrom'] = "Grupla aynı hakları ayarla";
$L['adm_maxsizesingle'] = "Tek bir dosya için maksimum PFS boyutu (KB)";
$L['adm_maxsizeallpfs'] = "Tüm PFS dosyalarının maksimum boyutu (KB)";
$L['adm_rights_allow10'] = "İzin verildi";
$L['adm_rights_allow00'] = "Reddedildi";
$L['adm_rights_allow11'] = "Güvenlik nedeniyle izin verildi ve kilitlendi";
$L['adm_rights_allow01'] = "Güvenlik nedeniyle reddedildi ve kilitlendi";
$L['adm_color'] = "Grup için renk"; // New in v175

/* ====== Plugins ====== */

$L['adm_extplugins'] = "Genişletilmiş eklentiler";
$L['adm_present'] = "Mevcut";
$L['adm_missing'] = "Eksik";
$L['adm_paused'] = "Duraklatıldı";
$L['adm_running'] = "Çalışıyor";
$L['adm_partrunning'] = "Kısmen çalışıyor";
$L['adm_notinstalled'] = "Yüklü değil";

$L['adm_opt_installall'] = "Hepsini yükle";
$L['adm_opt_installall_explain'] = "Bu eklentinin tüm parçalarını yükleyecek veya ayarları sıfırlayacaktır..";
$L['adm_opt_uninstallall'] = "Hepsini kaldır";
$L['adm_opt_uninstallall_explain'] = "Bu eklentinin tüm bölümlerini devre dışı bırakır, ancak dosyaları fiziksel olarak kaldırmaz.";
$L['adm_opt_pauseall'] = "Hepsini durdur";
$L['adm_opt_pauseall_explain'] = "Bu eklentinin tüm bölümlerini duraklatacak (devre dışı bırakacaktır).";
$L['adm_opt_unpauseall'] = "Tümünü çalıştır";
$L['adm_opt_unpauseall_explain'] = "Bu eklentinin tüm bölümlerini etkinleştirecek.";

/* ====== Private messages ====== */

$L['adm_pm_totaldb'] = "Veritabanındaki özel mesajlar";
$L['adm_pm_totalsent'] = "Şimdiye kadar gönderilen toplam özel mesaj";

?>
