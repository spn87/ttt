<?php
/**
* @package: Gallery Plugin for Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2008 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/copyleft/gpl.html GNU/GPL.
* The Gallery Plugin is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
* spanish.php March 2008 Sigrid Suski - translated by Jose Luis, info@craion.com
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

DEFINE("_S_2_GALLERY_NOIMAGES", "No hay im&aacute;genes disponibles");		//Adjust to fit your needs

DEFINE("_SGADM_GEN_NOIMAGE", "Mostrar texto si no hay im&aacute;genes");
DEFINE("_SGADM_GEN_NOIMAGE_EXPL", "Mostrar un texto en la Vista de V-Card y la Vista de Detalles en vez del n&uacute;mero de im&aacute;genes o galer&iacute;a si no hay im&aacute;genes disponibles para un aviso. Modificar el texto en el archivo de idioma de la galer&iacute;a.");
DEFINE("_SGADM_GEN_POPUP", "Mostrar como Popup");
DEFINE("_SGADM_GEN_POPUP_EXPL", "Mostrar la Imagen en una ventana popup en vez de utilizar efectos Lightbox. Esto s&oacute;lo funciona en Firefox. Usar en IE s&oacute;lo si est&aacute; satisfecho con el resultado.");
DEFINE("_SGADM_GEN_NUMBERR", "N&uacute;mero de im&aacute;genes por fila");
DEFINE("_SGADM_GEN_NUMBERR_EXPL", "Ingrese cuantas im&aacute;genes deber&iacute;an mostrarse en una fila (=n&uacute;mero de columnas). El n&uacute;mero resultante de filas depende del n&uacute;mero total de im&aacute;genes.");
DEFINE("_SGADM_GEN_ADJUSTSIZ", "Ajustar tama&ntilde;o de tabla");
DEFINE("_SGADM_GEN_ADJUSTSIZ_EXPL", "El tama&ntilde;o de la tabla se ajusta dependiendo del tama&ntilde;o de la vista previa. Si las im&aacute;genes se muestran en horizontal, el ancho de la galer&iacute;a es 100%. Si las im&aacute;genes se muestran en vertical, el ancho de la galer&iacute;a depender&aacute; del tama&ntilde;o de la vista previa y del n&uacute;mero de im&aacute;genes por fila.");
DEFINE("_SGADM_GEN_SHOWFIRSTT", "Mostrar primera imagen en V-Card");
DEFINE("_SGADM_GEN_SHOWFIRSTT_EXPL", "Mostrar primera imagen tambi&eacute;n en V-Card.");

DEFINE("_S_2_ADM_CONFIG_HEADER_G", " - General");
DEFINE("_S_2_ADM_CONFIG_HEADER_S", " - Tama&ntilde;os/L&iacute;mites");
DEFINE("_S_2_ADM_CONFIG_HEADER_V", " - Vista V-Card");
DEFINE("_S_2_ADM_CONFIG_HEADER_A", " - Formulario de Ingreso");
DEFINE("_S_2_ADM_INFOVCARD"," en el archivo de Vista de V-Card para mostrar el n&uacute;mero de im&aacute;genes y/o la primera imagen.");
DEFINE("_S_2_ADM_INFODV"," en el archivo de Plantilla de Vista de Detalles para mostrar la Galer&iacute;a.");

/* Changed */
DEFINE('_S_2_ADM_DISPLAY_EXPL', 'Mostrar las vistas previas de Im&aacute;genes de manera Horizontal o Vertical en la vista de detalles. Esta opci&oacute;n s&oacute;lo tiene efecto si \'Ajustar tama&ntilde;o de tabla\' es elegido.');
DEFINE('_S_2_ADM_INFO', 'Colocar "
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
DEFINE('_S_2_ADM_USED_SCRIPT', 'Usat MooTools Existentes');
DEFINE('_S_2_ADM_USED_SCRIPT_EXPL', 'Si ya ha instalado MooTools con su plantilla esto podr&iacute;a generar conflictos con Lightbox. Elija esta opci&oacute;n para utilizar los MooTools existentes y Slimbox en vez de Lightbox. Si no ha instalado MooTools elegir S&iacute;. S&oacute;lo es v&aacute;lido si se usa el efecto Lightbox.');
DEFINE("_SGADM_GEN_POS_EXPL", "Posici&oacute;n del IFrame en el formulario de ingreso de avisos. Ingresar el n&uacute;mero de orden. Si coloca 0, el IFrame no se mostrar&aacute; en el formulario.");

/* RC2.0 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_TITLE', 'Galer&iacute;a de Im&aacute;genes');
DEFINE("_SGADM_GEN_POS", "Posici&oacute;n del IFrame");

/* Beta 4 */
/* --------------------------------- */
DEFINE('_S_2_GALLERY_DELETE_FILE', 'Eliminar esta Imagen');
DEFINE('_S_2_GALLERY_IMAGE_TITLE', 'Descripci&oacute;n');
DEFINE('_S_2_GALLERY_IMAGES', 'Im&aacute;genes: ');
DEFINE('_S_2_GALLERY_ADD_IMAGE', '<strong>Agregar Nueva Imagen</strong>');
DEFINE('_S_2_GALLERY_ERR_RESAMPLING', 'Error al editar imagen');
DEFINE('_S_2_GALLERY_ERR_COPY', 'Error al copiar imagen');
DEFINE('_S_2_GALLERY_ERR_MOVE', 'Error al mover imagen');
DEFINE('_S_2_GALLERY_ERR_FILESIZE', 'El archivo subido es demasiado pesado');
DEFINE('_S_2_GALLERY_ERR_EXT', 'El archivo subido tiene una extensi&oacute;n no permitida');

DEFINE('_S_2_ADM_INFO_TITLE', 'Info ');
DEFINE('_S_2_ADM_CONFIG_HEADER', 'Configuraci&oacute;n de la Galer&iacute;a');
DEFINE('_S_2_ADM_DISPLAY', 'Mostrar Im&aacute;genes');
DEFINE('_S_2_ADM_DISPLAY_H', 'Horizontal');
DEFINE('_S_2_ADM_DISPLAY_V', 'Vertical');
DEFINE('_S_2_ADM_COUNT_IN_LIST', 'Mostrar el n&uacute;mero de Imagenes en la vista de Categor&iacute;as.');
DEFINE('_S_2_ADM_COUNT_IN_LIST_EXPL', 'Mostrar el n&uacute;mero de Imagenes en la vista de Detalles.');
DEFINE('_S_2_ADM_ALLOWED_IMGS', 'N&uacute;mero M&aacute;ximo de Im&aacute;genes.');
DEFINE('_S_2_ADM_ALLOWED_IMGS_EXPL', 'N&uacute;mero M&aacute;ximo de Im&aacute;genes que el usuario puede agregar en un aviso.');
DEFINE('_S_2_ADM_IMG_SIZE', 'Tama&ntilde;o de la Imagen');
DEFINE('_S_2_ADM_IMG_SIZE_EXPL', 'Tama&ntilde;o m&aacute;ximo de Imagen para mostrar en Lightbox.');
DEFINE('_S_2_ADM_IMG_RESIZE', 'Siempre adaptar el tama&ntilde;o de la Imagen.');
DEFINE('_S_2_ADM_IMG_RESIZE_EXPL', 'Adaptar la Imagen incluso si es mas peque&ntilde;a que el tama&ntilde;o m&aacute;ximo de la imagen. En ese caso la imagen se agrandar&aacute;.');
DEFINE('_S_2_ADM_THM_SIZE', 'Tama&ntilde;o de la Vista Previa');
DEFINE('_S_2_ADM_THM_SIZE_EXPL', 'N&aacute;mero m&aacute;ximo de la Vista Previa.');
DEFINE('_S_2_ADM_THM_RESIZE', 'Siempre adaptar el tama&ntilde;o de la Vista Previa');
DEFINE('_S_2_ADM_THM_RESIZE_EXPL', 'Adaptar la Vista Previa incluso si es mas peque&ntilde;a que el tama&ntilde;o permitido. Si es mas peque&ntilde;o la Vista Previa se agrandara.');
DEFINE('_S_2_ADM_FILE_SIZE', 'Tama&ntilde;o m&aacute;ximo del archivo.');
DEFINE('_S_2_ADM_FILE_SIZE_EXPL', 'Tama&ntilde;o m&aacute;ximo del archivo permitido al subir Imagenes.');
DEFINE('_S_2_ADM_IMG_H', 'Alto');
DEFINE('_S_2_ADM_IMG_W', 'Ancho');
DEFINE('_S_2_ADM_IFRAME_H', 'Alto del IFrame');
DEFINE('_S_2_ADM_IFRAME_H_EXPL', 'Alto del IFrame en el formulario de Editar / Agregar Imagen. Ajustar correspondiendo al tama&ntilde;o m&aacute;ximo de la Vista Previa y el n&uacute;mero m&aacute;ximo de Im&aacute;genes. Si el contenido del IFrame es mas grande que su tama&ntilde;o, se mostrar&aacute; una barra de navegaci&oacute;n.');
?>