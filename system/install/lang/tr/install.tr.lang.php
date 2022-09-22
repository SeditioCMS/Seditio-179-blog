<?php

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.com.tr
[BEGIN_SED]
File=install.tr.lang.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Türkçe installation lang file
[END_SED]
==================== */

$L['install_step0'] = "Kurulum için dil seçin";
$L['install_step1'] = "Uyumluluk";
$L['install_step2'] = "Yapılandırma dosyası";
$L['install_step3'] = "MySQL veritabanı";
$L['install_step4'] = "Eklentiler";
$L['install_step5'] = "Tamamlandı";

$L['install_language installation'] = "Dil kurulumu";
$L['install_select_language installation'] = "Kurulum dilini seçin";
$L['install_title'] = "Seditio - Kurulum"; 
$L['install_build_config'] = "Yapılandırma dosyasının oluşturulması ";
$L['install_looks_chmod'] = "Başarılı görünüyor, sessizce dosyayı salt okunur olarak CHMOD yapmaya çalışıyor...";
$L['install_setting_mysql'] = "SQL veritabanını ayarlama...";
$L['install_creating_mysql'] = "SQL tablolarının oluşturulması...";
$L['install_presettings'] = "Yapılandırma girişlerini önceden ayarlama...";
$L['install_adding_administrator'] = "Yönetici hesabını ekleme...";
$L['install_done'] = "Tamamlandı.";
$L['install_contine_toplugins'] = "Eklentilere devam";
$L['install_error_notwrite'] = "Hata, dosya yazılamadı, lütfen bu dosyanın yazılabilir olup olmadığını kontrol edin.";
$L['install_now'] = "Şimdi kur";
$L['install_plugins'] = "Eklentiler";
$L['install_install'] = "Yükle";
$L['install_optional_plugins'] = "Burada eklentileri yükleyebilir ve yeni özellikler elde edebilirsiniz..<br /> Onlar isteğe bağlıdır, \n
           ve bunları daha sonra istediğiniz zaman yönetim panelinden 'Eklentiler' sekmesinden değiştirebilirsiniz..<br /> \n
           Neyin ne yaptığını tam olarak bilmiyorsanız, onay kutularını olduğu gibi bırakın.<br />";
$L['install_installing_plugins'] = "Eklentileri yükleme :";
$L['install_installed_plugins'] = "eklentiler kurulu (";
$L['install_display_log'] = "Günlüğü görüntüle";
$L['install_contine_homepage'] = "Ana sayfaya devam et";
$L['install_error'] = "Hata !";
$L['install_wrong_manual'] = "Bir şeyler ters gitti, Seditio'yu manuel olarak kurmanız gerekecek, adımlar ayrıntılı olarak açıklanmıştır <a href=\"https://www.seditiocms.com/seditio-kurulum-ve-sistem-gereksinimleri/63\">Kurulum burada</a>.";
$L['install_database_setup'] = "SQL veritabanı kurulumu :";
$L['install_database_hosturl'] = "Database host URL :";
$L['install_always_localhost'] = "Neredeyse her zaman 'localhost'";
$L['install_database_user'] = "Veritabanı kullanıcısı :";
$L['install_see_yourhosting'] = "Bunun için hosting kontrol panelinize bakın";
$L['install_database_password'] = "Veritabanı şifresi :";
$L['install_database_name'] = "Veritabanı ismi :";
$L['install_database_tableprefix'] = "Veritabanı tablosu öneki :";
$L['install_seditio_already'] = "Bu veritabanında başka bir Seditio'nuz yoksa değiştirmeyin";
$L['install_input_mode'] = "Metin alanları için giriş modu :";
$L['install_html_mode'] = "<strong>HTML</strong> (önerilen)<br /> \n
           Sayfalar ve özel mesajlar için metin alanları HTML kodu olarak işlenir.<br />\n
           Bir WYSIWYG HTML düzenleyicisi otomatik olarak yüklenecek.";
$L['install_bbcode_mode'] = "<strong>BBcode</strong><br />
          Sayfalar ve özel mesajlar için metin alanları ham metin ve [bbcode] etiketleri olarak işlenir..<br />\n
          Bir satır içi BBcode düzenleyicisi otomatik olarak yüklenecek.";
$L['install_skinandlang'] = "Tema ve dil :";
$L['install_default_skin'] = "Varsayılan Tema :<br />(Tema dosyaları skins/... klasöründe saklanır.";
$L['install_default_lang'] = "Varsayılan dil :";
$L['install_admin_account'] = "Yönetici hesabı :";
$L['install_account_name'] = "Hesap adı :";
$L['install_ownaccount_name'] = "Kendi kullanıcı adınız";
$L['install_password'] = "Şifre :";
$L['install_least8chars'] = "En az 8 karakter";
$L['install_email'] = "Email :";
$L['install_doublecheck'] = "İki kez kontrol edin, önemli!";
$L['install_country'] = "Ülke :";
$L['install_validate'] = "Doğrula";
$L['install_auto_installer'] = "Bu Seditio için otomatik yükleyicidir (derleme ".@$cfg['version'].")";
$L['install_create_configfile'] = "Yapılandırma dosyasını oluşturacak <strong>".@$cfg['config_file']."</strong>, \n
	         daha sonra MySQL veritabanınızdaki tabloları oluşturacak ve dolduracaktır.<br /> \n
	         Bu aracı çalıştırmadan önce, hosting paneliniz ile veritabanının kendisini oluşturmalısınız., \n
	         ve tüm PHP ve sistem dosyalarının web sunucunuza yüklenmesi gerekir.<br />&nbsp<br /> \n
	         Yükleme işlemi sırasında bir şeyler ters giderse dosyayı silin <strong>".@$cfg['config_file']."</strong> FTP istemcinizle ve tarayıcınızda web kök URL'sini yeniden açın.<br />&nbsp<br /> \n
	         Şu anda, CHMOD 0777, FTP istemcinizle aşağıda listelenen ve zaten yazılabilir olmayan herhangi bir klasör :<br />";
$L['install_folder'] = "Dosya";
$L['install_writable'] = "Yazılabilir";
$L['install_not_writable'] = "Yazılabilir değil";
$L['install_not_found'] = "Bulunamadı";
$L['install_file'] = "Dosya";
$L['install_found_writable'] = "Bulundu ve yazılabilir";
$L['install_found_notwritable'] = "Bulundu, Yazılamaz";
$L['install_notfound_folderwritable'] = "Bulunamadı ve klasör yazılabilir, bu yüzden sorun yok.";
$L['install_notfound_foldernotwritable'] = "Bulunamadı ve klasör yazılabilir değil";
$L['install_phpversion'] = "PHP version :";
$L['install_ok'] = "Ok";
$L['install_too_old'] = "Çok eski";
$L['install_mysql_extension'] = "MySQL uzantısı :";
$L['install_gd_extension'] = "GD uzantısı :";
$L['install_mysqli_extension'] = "MySQLi uzantısı :";
$L['install_mysql_connector'] = "MySQL bağlayıcı sürücüsü :";
$L['install_mysql_preffered'] = "En çok tercih edilen MySQLi uzantısı";
$L['install_available'] = "Mevcut";
$L['install_missing'] = "Eksik ?";
$L['install_refresh'] = "Yenile";
$L['install_nextstep'] = "Sonraki adım";

?>