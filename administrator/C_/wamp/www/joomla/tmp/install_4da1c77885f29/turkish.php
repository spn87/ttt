<?php
/**
* @version $Id: english.php 3002 2007-12-23 16:33:34Z Sigrid Suski $
* @package: Gallery Plugin for Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* translate kirik.kurabiye
* ===================================================
* @copyright Copyright (C) 2007 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/copyleft/gpl.html GNU/GPL.
* The Gallery Plugin is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
*/


// no direct access
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

/* RC2.4 */
/* --------------------------------- */

/* Fee's Addition */
/* --------------------------------- */

DEFINE("_S_2_ADM_CONFIG_HEADER_F", " - Fee Options");

DEFINE("_SGADM_ADM_FEE", "Fee");
DEFINE("_SGADM_ADM_FEE_EXPL", "This is the amount charged for the first Image and every X images set below.");
DEFINE("_SGADM_ADM_PER_ITEMS", " Per ");
DEFINE("_SGADM_ADM_PER_ITEMS_EXPL", "The Above Fee will be Charged for each group of this many images.");
DEFINE("_SGADM_ADM_PER_ITEMS_END", " Images");
DEFINE("_SGADM_ADM_FREE_IMAGES", "Number of Free Images");
DEFINE("_SGADM_ADM_FREE_IMAGES_EXPL", "This is the number of images that can be submitted at no charge before a fee will apply.");
DEFINE("_SGADM_ADM_FEE_DISCOUNT", "Fee Cumulative Premium/Discount %");
DEFINE("_SGADM_ADM_FEE_DISCOUNT_EXPL", "This is a Premium or Discount will be applied to each group of paid entries after the first.  Enter as Positive Number for Premium (ie 10 for +10%) and Negative Number for Discount (-10 for -10%).  These percentages are cumulative for each group after the first (ie Full Price, -10%, -20% etc.)");
DEFINE("_SGADM_ADM_MAX_DISCOUNT", "Maximum Premium/Discount %");
DEFINE("_SGADM_ADM_MAX_DISCOUNT_EXPL", "This will be the maximum Premium or Discount applied to groups of images.");

DEFINE("_SGADM_GEN_FEE_REFERENCE", "Image Insertion fee level");
DEFINE("_SGADM_GEN_FREE_IMAGES_1", "You can add up to ");
DEFINE("_SGADM_GEN_FREE_IMAGES_2", " Images for Free.");
DEFINE("_SGADM_GEN_IMAGES_FEE_1", "Current Fee for Selected Images is ");

DEFINE("_S_2_GALLERY_UPLOAD_BUTTON", "Upload");			//Adjust to fit your needs
DEFINE("_S_2_GALLERY_UPDATE_BUTTON", "Update");			//Adjust to fit your needs

DEFINE("_S_2_GALLERY_EDIT_DETAILS_BUTTON", "Edit Image Details");			//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_FILENAME_LBL", "Filename");	//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_WARNING", "Update this form BEFORE Saving Entry or Images will not be saved!");	//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_TITLE_LBL", "Title");			//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_ALTTEXT_LBL", "Alt Text");	//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_POSITION_LBL", "Position");	//Adjust to fit your needs
DEFINE("_S_2_GALLERY_EDIT_UPDATE_BUTTON", "Update");	//Adjust to fit your needs


/* RC2.2 */
/* --------------------------------- */
DEFINE("_S_2_GALLERY_NOIMAGES", "Resim Kullanılamaz");		//Adjust to fit your needs

DEFINE("_SGADM_GEN_NOIMAGE", "Resim Yoksa Metni Göster");
DEFINE("_SGADM_GEN_NOIMAGE_EXPL", "Resim Kullanılabilir Olmadığında V-Card ı Metin Olarak Göster ve Fotoğraf veya Galeri Sayısı Yerine Detayları Görüntüle. Galerideki Dil Dosyasındaki Metni Ayarlayın.");
DEFINE("_SGADM_GEN_POPUP", "Yeni Pencerede Göster");
DEFINE("_SGADM_GEN_POPUP_EXPL", "Lightbox effect Kullanarak Yeni Pencerede Gösterir.  Sadece firefox da Çalışmaktadır. IE yi Kendiniz Kontrol edin. Memun Olduklarını sizde Göreceksiniz.");
DEFINE("_SGADM_GEN_NUMBERR", "Satır Başına Resim Sayısı");
DEFINE("_SGADM_GEN_NUMBERR_EXPL", "Bir Satıda Gösterilebilecek Resim Sayısını Giriniz (= Kolon Sayısı). The resulting number of rows depends on the total number of images.");
DEFINE("_SGADM_GEN_ADJUSTSIZ", "Tablo Boyutunu Ayarla");
DEFINE("_SGADM_GEN_ADJUSTSIZ_EXPL", "Tablo boyutları küçük resim boyutuna bağlı olarak ayarlanır.Eğer görüntü yatay ise genişliği% 100 gösterilir. Eğer görüntü dikey ise galeri genişliği minyatür resim boyutu bağlıdır ve satır başına fotoğraf sayısı gösterilir.");
DEFINE("_SGADM_GEN_SHOWFIRSTT", "İlk Küçük Resmi V-Card ta Göster");
DEFINE("_SGADM_GEN_SHOWFIRSTT_EXPL", "İlk Küçük Resmi Aynı Zamanda V-Card da Göster.");

DEFINE("_S_2_ADM_CONFIG_HEADER_G", " - Genel");
DEFINE("_S_2_ADM_CONFIG_HEADER_S", " - Boyut/Limit");
DEFINE("_S_2_ADM_CONFIG_HEADER_V", " - V-Card Görünümü");
DEFINE("_S_2_ADM_CONFIG_HEADER_A", " - Giriş Formuna Ekle");
DEFINE("_S_2_ADM_INFOVCARD"," in your V-Card-Template to show the number of images and/or the first thumbnail.");
DEFINE("_S_2_ADM_INFODV"," Detay Görünümünde Galeriyi Göstermek için.");

/* Changed */
DEFINE('_S_2_ADM_DISPLAY_EXPL', 'Detay Görünümünde Küçük Resimleri yatay veya dikey olarak göster. Bu ayar sadece \'Tablo Boyutunu Ayarla\' evet seçilmişse çalışır.');
DEFINE('_S_2_ADM_INFO', 'Yer "
<span style="color: rgb(0, 0, 187);"><span
 style="color: rgb(204, 51, 204);">&lt;?php</span><span
 style="color: rgb(51, 204, 0);"> <span
 style="color: rgb(255, 0, 0);">echo</span> $plugins</span><span
 style="color: rgb(0, 0, 187);"></span>[<span
 style="color: rgb(221, 0, 0);">"gallery"</span><span
 style="color: rgb(0, 119, 0);">]</span><span
 style="color: rgb(0, 119, 0);"></span><span
 style="color: rgb(0, 119, 0);"></span><span
 style="color: rgb(0, 0, 187);"></span>; <span
 style="color: rgb(204, 51, 204);">?&gt;</span></span>"');

/* RC2.1 */
/* --------------------------------- */
DEFINE('_S_2_ADM_USED_SCRIPT', 'MooTools Kullan');
DEFINE('_S_2_ADM_USED_SCRIPT_EXPL', 'Eğer MooTools Template ile Yüklü ise Lightbox Galeri çakışabilir. Eğer MooTools mevcut ise \'MooTools Kullan\' ı set ediniz ve MooTools ve Slimbox ı Kullanınız. Eğer MooTools yüklü değilse set etmeyiniz. Sadece Lightbox effect kullanabilirsiniz.');
DEFINE("_SGADM_GEN_POS_EXPL", "IFrame pozisyonunu forma ekle. Sıra Numarasını Giriniz. Eğer 0 (Sıfır) Girerseniz, Giriş Formunda Görünmez.");

/* RC2.0 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_TITLE', 'Resim Galerisi');
DEFINE("_SGADM_GEN_POS", "IFrame Position");

/* Beta 4 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_DELETE_FILE', 'Bu Resmi Sil');
DEFINE('_S_2_GALLERY_IMAGE_TITLE', 'Resim Açıklaması');
DEFINE('_S_2_GALLERY_IMAGES', 'Resim: ');
DEFINE('_S_2_GALLERY_ADD_IMAGE', '<strong>Yeni Resim Ekle</strong>');
DEFINE('_S_2_GALLERY_ERR_RESAMPLING', 'Resim Boyutlandırma Hatası');
DEFINE('_S_2_GALLERY_ERR_COPY', 'Resim Kopyalama Hatası');
DEFINE('_S_2_GALLERY_ERR_MOVE', 'Resim Taşıma Hatası');
DEFINE('_S_2_GALLERY_ERR_FILESIZE', 'Eklenmek İstenen Resim Boyutu Çok Büyük');
DEFINE('_S_2_GALLERY_ERR_EXT', 'Eklenmek İstenen Resim Türü Desteklenmiyor');

DEFINE('_S_2_ADM_INFO_TITLE', 'Bilgi ');

DEFINE('_S_2_ADM_CONFIG_HEADER', 'SOBI2 Gallery Ayarları');
DEFINE('_S_2_ADM_DISPLAY', 'Resmi Göster');
DEFINE('_S_2_ADM_DISPLAY_H', 'Yatay');
DEFINE('_S_2_ADM_DISPLAY_V', 'Dikey');
DEFINE('_S_2_ADM_COUNT_IN_LIST', 'V-Card da Gözükecek Resim Sayısı');
DEFINE('_S_2_ADM_COUNT_IN_LIST_EXPL', 'V-Card görünümünde eklenebilecek resim sayısı.');
DEFINE('_S_2_ADM_ALLOWED_IMGS', 'En Fazla Resim Sayısı');
DEFINE('_S_2_ADM_ALLOWED_IMGS_EXPL', 'Max.number of images the user can add to one entry.');
DEFINE('_S_2_ADM_IMG_SIZE', 'Resim Boyutu');
DEFINE('_S_2_ADM_IMG_SIZE_EXPL', 'Max. size of the image shown in the lightbox.');
DEFINE('_S_2_ADM_IMG_RESIZE', 'Resmi Daima Boyutlandır');
DEFINE('_S_2_ADM_IMG_RESIZE_EXPL', 'Resim Boyutlandırırken Büyükse Küçült, Değilse Resim Boyutlarına Büyült.');
DEFINE('_S_2_ADM_THM_SIZE', 'Küçük Resim Boyutu');
DEFINE('_S_2_ADM_THM_SIZE_EXPL', 'En Fazla Küçük Resim Boyutu.');
DEFINE('_S_2_ADM_THM_RESIZE', 'Daima Küçük Resme Boyutlandır');
DEFINE('_S_2_ADM_THM_RESIZE_EXPL', 'Küçük Resme Boyutlandırırken Resim Büyükse Küçült, Değilse Küçük Resim Boyutlarına Büyült.');
DEFINE('_S_2_ADM_FILE_SIZE', 'En Fazla Resim Boyutu');
DEFINE('_S_2_ADM_FILE_SIZE_EXPL', 'En Fazla Kabul Edilebilir dosya Boyutu.');
DEFINE('_S_2_ADM_IMG_H', 'Genişlik');
DEFINE('_S_2_ADM_IMG_W', 'Yükseklik');
DEFINE('_S_2_ADM_IFRAME_H', 'IFrame Yüksekliği');
DEFINE('_S_2_ADM_IFRAME_H_EXPL', 'Height of the IFrame in edit/new entry form. Adjust it corresponding to the max. size of the thumbnails and the max. number of the images. If the IFrame content is larger than the IFrame size, a scrollbar is shown.');
?>