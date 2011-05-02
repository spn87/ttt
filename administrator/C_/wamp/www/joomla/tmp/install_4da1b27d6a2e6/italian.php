<?php
/**
* @version $Id: english.php 2742 2007-11-03 19:23:19Z Sigrid Suski $
* @package: Gallery Plugin for Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2007 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/copyleft/gpl.html GNU/GPL.
* The Gallery Plugin is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
* italian.php 12-Apr-2008 Pasquale Riefoli on thuridilla file
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
DEFINE("_S_2_GALLERY_NOIMAGES", "Nessuna immagine disponibile");		//Adjust to fit your needs

DEFINE("_SGADM_GEN_NOIMAGE", "Mostra testo se non vi sono immagini");
DEFINE("_SGADM_GEN_NOIMAGE_EXPL", "Mostra un testo in V-Card e Vista Dettagli invece di un numero di immagini o gallerie se non vi sono immagini. Regola il testo nel file lingua della galleria. ");
DEFINE("_SGADM_GEN_POPUP", "Mostra come Popup");
DEFINE("_SGADM_GEN_POPUP_EXPL", "Mostra immagine in una finestra popup invece di utilizzare effetti Lightbox. Funziona correttamente solo con Firefox. Verifica con Ie e usa solo se sei soddisfatto dei risultati.");
DEFINE("_SGADM_GEN_NUMBERR", "Numero immagini per Riga");
DEFINE("_SGADM_GEN_NUMBERR_EXPL", "Definisci quante immagini dovrebbero essere mostrate in una riga (=numero di colonne). Il risultante numero di righe dipende dal numero totale di immagini.");
DEFINE("_SGADM_GEN_ADJUSTSIZ", "Regola Dimensioni Tabella");
DEFINE("_SGADM_GEN_ADJUSTSIZ_EXPL", "Le dimensioni della tabella vengono regolate a seconda delle dimensioni della miniatura. Se 100%. Se le immagini sono mostrate verticalmente la larghezza della galleria dipende dalle dimensioni delle miniature e dal numero di immagini per riga .");
DEFINE("_SGADM_GEN_SHOWFIRSTT", "Mostra la prima miniatura nella V-Card");
DEFINE("_SGADM_GEN_SHOWFIRSTT_EXPL", "Mostra la prima miniatura anche nella  V-Card.");

DEFINE("_S_2_ADM_CONFIG_HEADER_G", " - Generale");
DEFINE("_S_2_ADM_CONFIG_HEADER_S", " - Dimensioni/Limiti");
DEFINE("_S_2_ADM_CONFIG_HEADER_V", " - Vista V-Card ");
DEFINE("_S_2_ADM_CONFIG_HEADER_A", " - Scheda aggiunta elementi");
DEFINE("_S_2_ADM_INFOVCARD"," nel tuo template V-Card per mostrare il numero di immagini e o la prima miniatura.");
DEFINE("_S_2_ADM_INFODV"," nel tuo template vista dettagliata per mostrare la galleria.");

/* Changed */
DEFINE('_S_2_ADM_DISPLAY_EXPL', 'Mostra le miniature verticalmente o orizzontalmente nella vista dettagliata, Questo settaggio ha effetto solo se la caratteristica \'Regola dimensioni tabella\'   impostata a si.');
DEFINE('_S_2_ADM_INFO', 'Posiziona "
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
DEFINE('_S_2_ADM_USED_SCRIPT', 'Usa MooTools Esistente');
DEFINE('_S_2_ADM_USED_SCRIPT_EXPL', 'Se hai già installato MooTools nel tuo template, esso potrebbe andare in conflitto con Lightbox della Galleria. Imposta questo su Si per usare gli esistenti MooTools e Slimbox invece di Lightbox. Se non si dispone di MooTools già installato non impostarlo su Si. Valido solo se gli effetti di Lightbox sono usati.');
DEFINE("_SGADM_GEN_POS_EXPL", "Posizione IFrame nel form di inserimento scheda. Inserisci il numero dell\'ordine. Se impostato a 0, l\'IFrame non verrà mostrato nel form di inserimento scheda.");

/* RC2.0 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_TITLE', 'Galleria immagini');
DEFINE("_SGADM_GEN_POS", "Posizione IFrame");

/* Beta 4 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_DELETE_FILE', 'Elimina questa immagine');
DEFINE('_S_2_GALLERY_IMAGE_TITLE', 'Descrizioe immagine');
DEFINE('_S_2_GALLERY_IMAGES', 'Immagini: ');
DEFINE('_S_2_GALLERY_ADD_IMAGE', '<strong>Aggiungi nuova immagine</strong>');
DEFINE('_S_2_GALLERY_ERR_RESAMPLING', 'Errore nel ridimensionamento immagine');
DEFINE('_S_2_GALLERY_ERR_COPY', 'Errore di copiatura immagine');
DEFINE('_S_2_GALLERY_ERR_MOVE', 'Errore di spostamento immagine');
DEFINE('_S_2_GALLERY_ERR_FILESIZE', 'Il file caricato è troppo grande ');
DEFINE('_S_2_GALLERY_ERR_EXT', 'Il file caricato non ha estensione consentita');

DEFINE('_S_2_ADM_INFO_TITLE', 'Info ');

DEFINE('_S_2_ADM_CONFIG_HEADER', 'Configurazione SOBI2 Gallery');
DEFINE('_S_2_ADM_DISPLAY', 'Mostra Immagini');
DEFINE('_S_2_ADM_DISPLAY_H', 'orizzontalmente');
DEFINE('_S_2_ADM_DISPLAY_V', 'verticalmente');
DEFINE('_S_2_ADM_COUNT_IN_LIST', 'Conta numero immagini in V-Card');
DEFINE('_S_2_ADM_COUNT_IN_LIST_EXPL', 'Mostra il numero di immagini di un inserimento nella vista  V-Card .');
DEFINE('_S_2_ADM_ALLOWED_IMGS', 'Max. numero di immagini');
DEFINE('_S_2_ADM_ALLOWED_IMGS_EXPL', 'Max. numero di immagini che possono essere inserite in un inserimento.');
DEFINE('_S_2_ADM_IMG_SIZE', 'Dimensioni immagine');
DEFINE('_S_2_ADM_IMG_SIZE_EXPL', 'Massime dimensioni immagine mostrata nel lightbox.');
DEFINE('_S_2_ADM_IMG_RESIZE', 'Ridimensiona sempre immagine');
DEFINE('_S_2_ADM_IMG_RESIZE_EXPL', 'Ridimensiona immagine anche se è più piccola delle dimensioni max immagine. Se è più piccola sarà allargata.');
DEFINE('_S_2_ADM_THM_SIZE', 'Dimensioni miniatura');
DEFINE('_S_2_ADM_THM_SIZE_EXPL', 'Max. dimensioni miniatura.');
DEFINE('_S_2_ADM_THM_RESIZE', 'Ridimensiona sempre miniatura');
DEFINE('_S_2_ADM_THM_RESIZE_EXPL', 'Ridimensiona miniatura anche se è più piccola delle dimensioni max miniatura. Se è più piccola sarà allargata..');
DEFINE('_S_2_ADM_FILE_SIZE', 'Max. Dimensioni file');
DEFINE('_S_2_ADM_FILE_SIZE_EXPL', 'Max. Dimensioni file delle immagini caricate.');
DEFINE('_S_2_ADM_IMG_H', 'Altezza');
DEFINE('_S_2_ADM_IMG_W', 'Larghezza');
DEFINE('_S_2_ADM_IFRAME_H', 'Altezza IFrame');
DEFINE('_S_2_ADM_IFRAME_H_EXPL', 'Altezza IFrame nel modulo modifica/aggiunta nuovo inserimento. Regolare a seconda delle massime dimensioni delle miniature e del numero max di immagini. Se il contenuto IFrame è più grande delle dimensioni IFrame viene mostrata una barra di scorrimento');
?>
