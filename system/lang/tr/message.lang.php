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
File=system/lang/tr/message.lang.php
Version=179
Updated=2022-jun-15
Type=Lang
Author=Seditio Team
Description=Language messages
[END_SED]
==================== */

$L['msg_Message'] = "Mesaj";
$L['msg_Error'] = "Hata";
$L['msg_Warning'] = "Uyarı";
$L['msg_Security'] = "Güvenlik";
$L['msg_System'] = "Sistem";

/* ======== Users ======== */

$L['msg100_0'] = "Kullanıcı oturum açmadı, profile erişim reddedildi";
$L['msg100_1'] = "Yalnızca kayıtlı ve oturum açmış kullanıcılar profillerini görüntüleyebilir!";
$L['msg101_0'] = "Kullanıcı oturum açmadı";
$L['msg101_1'] = "Gerek yok, oturum açmadın.";
$L['msg102_0'] = "Kullanıcı oturumu kapattı";
$L['msg102_1'] = "Bitti, çıkış yaptınız.";
$L['msg104_0'] = "Kullanıcı oturum açtı";
$L['msg104_1'] = "Tekrar hoşgeldiniz ".$usr['name'].", şimdi giriş yaptın.";
$L['msg105_0'] = "Kayıt tamamlandı (1. adım)";
$L['msg105_1'] = "Lütfen posta kutunuzu birkaç dakika içinde kontrol edin,<br /> ve lütfen kayıt işlemini onaylayın<br />mesajın gövdesindeki URL'yi tıklayarak ...<br />Bu zamana kadar hesabınız kullanıcı listesinde 'Etkin değil' olarak işaretlenir..";
$L['msg106_0'] = "Kayıt tamamlandı";
$L['msg106_1'] = "Hoş geldiniz, hesabınız artık geçerli ve etkinleştirildi.<br />Artık şifrenizle giriş yapabilirsiniz.";
$L['msg109_0'] = "Kullanıcı silindi";
$L['msg109_1'] = "Bitti, kullanıcı silindi.";
$L['msg113_0'] = "Profil güncellendi";
$L['msg113_1'] = "Tamamlandı, değişiklikler hesabınıza uygulandı.";
$L['msg117_0'] = "Kayıt devre dışı";
$L['msg117_1'] = "Yeni kullanıcılar için kayıt devre dışı bırakıldı.";
$L['msg118_0'] = "Kayıt tamamlandı (1. adım)";
$L['msg118_1'] = "Hesabınız şu anda etkin değil,<br />oturum açabilmeniz için site yöneticisinin onu etkinleştirmesi gerekecek.<br />Bu gerçekleştiğinde başka bir e-posta alacaksınız.";
$L['msg151_0'] = "Oturum açılamadı (yanlış ad veya parola)";
$L['msg151_1'] = "Hata, girdiğiniz kullanıcı adı veritabanında değil veya parola eşleşmiyor !";
$L['msg152_0'] = "Giriş başarısız oldu (hesap etkinleştirilmedi)";
$L['msg152_1'] = "Hata, hesabınız kayıtlı ancak henüz etkinleştirilmedi.";
$L['msg153_0'] = "Giriş başarısız oldu (kullanıcı yasaklandı)";
$L['msg153_1'] = "Hata, hesabınız yasaklandı.";
$L['msg157_0'] = "Yanlış doğrulama URL'si";
$L['msg157_1'] = "Bu doğrulama URL'si geçerli değil.";

/* ======== General ======== */

$L['msg300_0'] = "Yeni gönderim";
$L['msg300_1'] = "Tamam, bu öğe şimdi veritabanına kaydedildi.<br />Bir moderatör en kısa sürede kontrol edecek,<br />Teşekkürler !";
$L['msg301_0'] = "Yeni gönderim";
$L['msg301_1'] = "Tamam, bu öğe şimdi veritabanına kaydedildi.";
$L['msg302_0'] = "Kayıt silindi";
$L['msg302_1'] = "Tamam, kayıt veritabanından silindi.";
$L['msg303_0'] = "Veri girişi sırasında bir hata oluştu";
$L['msg303_1'] = "Bir hata oluştu, gerekli alanlardan biri veya birileri doldurulmadı veya yanlış dolduruldu.";

/* ======== Error Pages ======== */

$L['msg400_0'] = "Kötü Sözdizimi";
$L['msg400_1'] = "İsteğinizde hatalı bir sözdizimi var";
$L['msg401_0'] = "Yetkiniz Yok";
$L['msg401_1'] = "İstediğiniz URL, doğru bir kullanıcı adı ve şifre gerektiriyor.<br />Ya yanlış bir kullanıcı adı/şifre girdiniz ya da tarayıcınız bu özelliği desteklemiyor.";
$L['msg403_0'] = "Erişim Yasak";
$L['msg403_1'] = "İstediğiniz URL'yi veya bağlantıyı alma izniniz yok.<br />Bunun bir hata olduğunu düşünüyorsanız, lütfen yönlendiren sayfanın yöneticisini bilgilendirin..";
$L['msg404_0'] = "Bulunamadı";
$L['msg404_1'] = "İstenen nesne veya URL bu sunucuda bulunamadı. <br />İzlediğiniz bağlantı ya güncel değil, yanlış ya da sunucuya sayfaya erişmenize izin vermemesi talimatı verildi.";
$L['msg500_0'] = "İç Sunucu Hatası";
$L['msg500_1'] = "Sunucu bir dahili hata veya yanlış yapılandırma ile karşılaştı ve isteğinizi tamamlayamadı. <br />Lütfen yönetici ile iletişime geçin ve hatanın meydana geldiği zamanı ve hataya neden olabilecek herhangi bir şey yapmış olabileceğiniz konusunda onları bilgilendirin..";

/* ======== Private messages ======== */

$L['msg502_0'] = "Özel mesaj gönderildi";
$L['msg502_1'] = "Tamamlandı, özel mesajınız başarıyla gönderildi.<br /> ";
$L['msg502_2'] = "Özel mesajlara geri dönmek veya yeni bir PM göndermek için";
$L['msg502_3'] = "  burayı tıklayın.";

/* ======== System ======== */

$L['msg900_0'] = "Yapım halinde";
$L['msg900_1'] = "Sayfa henüz tamamlanmadı, lütfen daha sonra tekrar gelin.";
$L['msg904_0'] = "Yalnızca yöneticiler için sistem sayfaları";
$L['msg904_1'] = "Seviyenize göre sistem sayfalarını listeleyemezsiniz.";
$L['msg907_0'] = "Eklenti yüklenmedi";
$L['msg907_1'] = "Bu eklenti yüklenmeye çalışılırken bir hata oluştu, dosya(lar) eksik ?";
$L['msg911_0'] = "Dil dosyası eksik";
$L['msg911_1'] = "Bu dil paketini kontrol etmeye çalışırken bir hata oluştu.";
$L['msg915_0'] = "Hata !";
$L['msg915_1'] = "En az 1 alan boş.";
$L['msg916_0'] = "Veritabanı güncellendi";
$L['msg916_1'] = "Bitti, veritabanı başarıyla güncellendi.<br />Etkilenen girişler : ".(isset($num)?$num:'');
$L['msg917_0'] = "Veritabanı güncellendi";
$L['msg917_1'] = "Bitti, veritabanı başarıyla güncellendi.";
$L['msg930_0'] = "Erişim reddedildi";
$L['msg930_1'] = "Bunu yapmana izin verilmiyor.";
$L['msg940_0'] = "Bölüm devre dışı";
$L['msg940_1'] = "Web sitesinin bu bölümü devre dışı.";
$L['msg950_0'] = "Hata";
$L['msg950_1'] = "Bir hata oluştu, belki yanlış bir URL ?";

/* ======== Overall  ======== */

$L['msgredir'] = "Yönleniyor...";

?>
