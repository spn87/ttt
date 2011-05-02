<?php
/**
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
DEFINE("_S_2_GALLERY_NOIMAGES", "Keine Bilder verf&uuml;gbar");		//Adjust to fit your needs

DEFINE("_SGADM_GEN_NOIMAGE", "Zeige Hinweistext wenn keine Bilder");
DEFINE("_SGADM_GEN_NOIMAGE_EXPL", "Zeigt einen Hinweistext in der V-Card und in der Detailansicht anstelle von Anzahl Bilder oder Galerie wenn ein Eintrag keine Galeriebilder hat. Der Text kann in der Sprachdatei der Galerie angepasst werden.");

DEFINE("_SGADM_GEN_POPUP", "Zeige als Popup");
DEFINE("_SGADM_GEN_POPUP_EXPL", "Zeigt das Bild in einem Popup-Fenster anstelle der Verwendung des Lightbox Effektes. Dies funktioniert nur im Firefox einwandfrei. Teste es in IE und benutze es nur wenn Du mit dem Ergebnis zufrieden sind.");
DEFINE("_SGADM_GEN_NUMBERR", "Anzahl Bilder pro Zeile");
DEFINE("_SGADM_GEN_NUMBERR_EXPL", "Angabe, wieviele Bilder in einer Zeile dargestellt werden sollen (=Anzahl Spalten). Die Anzahl Zeilen h&auml;ngt von der Gesamtzahl der Bilder ab.");
DEFINE("_SGADM_GEN_ADJUSTSIZ", "Passe Tabellengr&ouml;&szlig;en an");
DEFINE("_SGADM_GEN_ADJUSTSIZ_EXPL", "Die Tabellengr&ouml;&szlig;en werden entsprechend der Gr&ouml;&szlig;e der Vorschaubilder angepasst. Werden die Bilder horizontal dargestellt, betr&auml;gt die Breite der Galerie 100%. Werden die Bilder vertikal angezeigt, ist die Breite der Galerie abh&auml;ngig von der Gr&ouml;&szlig;e der Vorschaubilder und der Anzahl der Bilder pro Zeile.");
DEFINE("_SGADM_GEN_SHOWFIRSTT", "Zeige erstes Vorschaubild in V-Card");
DEFINE("_SGADM_GEN_SHOWFIRSTT_EXPL", "Zeige das erste Vorschaubild auch in der V-Card.");

DEFINE("_S_2_ADM_CONFIG_HEADER_G", " - Allgemein");
DEFINE("_S_2_ADM_CONFIG_HEADER_S", " - Gr&ouml;&szlig;en/Grenzen");
DEFINE("_S_2_ADM_CONFIG_HEADER_V", " - V-Card Ansicht");
DEFINE("_S_2_ADM_CONFIG_HEADER_A", " - Eintragsformular");
DEFINE("_S_2_ADM_INFOVCARD"," in das V-Card-Template ein um die Anzahl der Bilder und/oder das erste Vorschaubild anzuzeigen.");
DEFINE("_S_2_ADM_INFODV"," in das Template f&uuml;r die Detailansicht ein um die Galerie anzuzeigen.");

/* Changed */
DEFINE('_S_2_ADM_DISPLAY_EXPL', 'Zeige die Vorschaubilder in der Detailansicht vertikal oder horizontal. Diese Eintellung wirkt nur, wenn \'Passe Tabellengr&ouml;&szlig;en an\' auf Ja gestellt ist.');
DEFINE('_S_2_ADM_INFO', 'F&uuml;ge "
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
DEFINE('_S_2_ADM_USED_SCRIPT', 'Benutze vorhandene MooTools');
DEFINE('_S_2_ADM_USED_SCRIPT_EXPL', 'Wenn die MooTools Bibliothek durch das Template eingebunden wird, kann es zu Konflikten mit der Lightbox der Gallery kommen. Stelle hier Ja ein um die bestehende MooTools Bibliothek mit der Slimbox anstelle der Lightbox zu benutzen. Hast Du MooTools nicht installiert, darfst Du diesen Wert nicht auf Ja stellen. Diese Einstellung it nur g&uuml;ltig wenn der Lightbox-Effekt verwendet wird.');
DEFINE("_SGADM_GEN_POS_EXPL", "IFrame Position im Eingabeformular. Eingabe der Ordnungsnummer. Ein Wert von 0 schaltet den IFrame im Add Entry Formular aus.");

/* RC2.0 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_TITLE', 'Bildergalerie');
DEFINE("_SGADM_GEN_POS", "IFrame Position");

/* Beta 4 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_DELETE_FILE', 'Bild l&ouml;schen');
DEFINE('_S_2_GALLERY_IMAGE_TITLE', 'Bildbeschreibung ');
DEFINE('_S_2_GALLERY_IMAGES', 'Bilder: ');
DEFINE('_S_2_GALLERY_ADD_IMAGE', '<strong>Neues Bild hinzuf&uuml;gen</strong>');
DEFINE('_S_2_GALLERY_ERR_RESAMPLING', 'Fehler bei der Bildverarbeitung');
DEFINE('_S_2_GALLERY_ERR_COPY', 'Fehler beim Kopieren des Bildes');
DEFINE('_S_2_GALLERY_ERR_MOVE', 'Fehler beim Verschieben des Bildes');
DEFINE('_S_2_GALLERY_ERR_FILESIZE', 'Die hochgeladene Datei ist zu gro&szlig;');
DEFINE('_S_2_GALLERY_ERR_EXT', 'Die hochgeladene Datei hat keine erlaubte Namenserweiterung');

DEFINE('_S_2_ADM_INFO_TITLE', 'Info ');
DEFINE('_S_2_ADM_CONFIG_HEADER', 'SOBI2 Galerie Konfiguration');
DEFINE('_S_2_ADM_DISPLAY', 'Zeige Bilder ');
DEFINE('_S_2_ADM_DISPLAY_H', 'Horizontal');
DEFINE('_S_2_ADM_DISPLAY_V', 'Vertikal');
DEFINE('_S_2_ADM_COUNT_IN_LIST', 'Zeige Anzahl Bilder in V-Card');
DEFINE('_S_2_ADM_COUNT_IN_LIST_EXPL', 'Zeige die Anzahl der Bilder in der V-Card');
DEFINE('_S_2_ADM_ALLOWED_IMGS', 'Max. Anzahl Bilder');
DEFINE('_S_2_ADM_ALLOWED_IMGS_EXPL', 'Max. Anzahl der Bilder die ein Benutzer zu einem Eintrag hinzuf&uuml;gen kann.');
DEFINE('_S_2_ADM_IMG_SIZE', 'Bildgr&ouml;&szlig;e');
DEFINE('_S_2_ADM_IMG_SIZE_EXPL', 'Max. Gr&ouml;&szlig;e der Bilder die in der Lightbox angezeigt werden.');
DEFINE('_S_2_ADM_IMG_RESIZE', 'Bilder immer anpassen');
DEFINE('_S_2_ADM_IMG_RESIZE_EXPL', 'Die Gr&ouml;&szlig;e der Bilder wird immer angepasst, auch wenn das Bild kleiner als die angegebene maximale Gr&ouml;&szlig;e ist. D.h., dass das Bild vergr&ouml;&szlig;ert wird, wenn es kleiner ist.');
DEFINE('_S_2_ADM_THM_SIZE', 'Gr&ouml;&szlig;e der Vorschaubilder');
DEFINE('_S_2_ADM_THM_SIZE_EXPL', 'Max. Gr&ouml;&szlig;e der Vorschaubilder.');
DEFINE('_S_2_ADM_THM_RESIZE', 'Vorschaubilder immer anpassen');
DEFINE('_S_2_ADM_THM_RESIZE_EXPL', 'Die Gr&ouml;&szlig;e der Vorschaubilder wird immer angepasst, auch wenn das Bild kleiner als die angegebene maximale Gr&ouml;&szlig;e ist. D.h., dass das Vorschaubild vergr&ouml;&szlig;ert wird, wenn es kleiner ist.');
DEFINE('_S_2_ADM_FILE_SIZE', 'Max. Dateigr&ouml;&szlig;e');
DEFINE('_S_2_ADM_FILE_SIZE_EXPL', 'Max. erlaubte Dateigr&ouml;&szlig;e f&uuml;r hochgeladene Bilddateien.');
DEFINE('_S_2_ADM_IMG_H', 'H&ouml;he');
DEFINE('_S_2_ADM_IMG_W', 'Breite');
DEFINE('_S_2_ADM_IFRAME_H', 'IFrame H&ouml;he');
DEFINE('_S_2_ADM_IFRAME_H_EXPL', 'H&ouml;he des IFrames im Eintragsformular. Passe es entsprechend der maximalen Gr&ouml;&szlig;e der Vorschaubilder und der maximalen Anzahl der Bilder an. Wenn der Inhalt des IFrames gr&ouml;&szlig;er als die IFrame Gr&ouml;&szlig;e ist, wird ein Rollbalken angezeigt.');
?>