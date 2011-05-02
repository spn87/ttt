<?php
/**
* @version $Id: gallery.class.php 3913 2008-03-24 19:13:47Z Sigrid Suski $
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
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobi_gallery {

/*
 *
 * ************************************************************
 * required attributes
 * ************************************************************
 */

	var $name = "Gallery";
	var $listingStyle = "sobi_gallery_VC";

/*
 *
 * ************************************************************
 * free definied attributes
 * ************************************************************
 */

	var $imagesLivePath = null;
	var $imagesAbsPath = null;
	var $displayVert = 0;
	var $allowedImg = 10;
	var $imgH = 450;
	var $imgW = 450;
	var $thmH = 50;
	var $thmW = 50;
	var $iframeH = 500;
	var $sobi_gallery_fileSize = 500;
	var $alwaysResizeThumb = true;
	var $alwaysResizeImages = false;
	var $allowableFilesExt = array ('gif','jpg','png');
	var $countInListing = 1;
	var $usedScript = 0;
	var $adm = 0;
	var $fPos = 5;
	var $imagePopup = 0;
	var $numberInRows = 10;
    var $adjustSizes = 0;
 	var $showFirstThumb = 0;
	var $showNoImage = 0;
	var $imagefee = 0;
	var $perimages = 1;
	var $freeImages = 0;
	var $feeDiscount = 0;
	var $maxDiscount = 0;
	var $showNum = 0;
/*
 * ************************************************************
 * required methods
 * ************************************************************
 */

    function customTask($sobi2Task) {
		$sgssid = sobi2Config::request( $_REQUEST, "sgssid");
		$gid = sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0);
		$sid = sobi2Config::request( $_REQUEST, "sobi2Id", 0);
		$return = false;
		
		if ($gid == $sid){
			return $return;
		}
		switch($sobi2Task) {
			case 'galleryForm':
				$this->checkSession($sgssid);
				$this->formIframe((int) sobi2Config::request( $_REQUEST, "sobi2Id", 0), sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0),$sgssid);
				$return = true;
				break;
			case 'uploadGfile':
				$this->checkSession($sgssid);
				$this->sobi_gallery_getImagesFromRequest(((int) sobi2Config::request( $_REQUEST, "sobi2Id", 0, null)), sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0, null),$sgssid);
				$return = true;
				break;
			case 'delGalleryImgForm':
				$this->checkSession($sgssid);
				$this->deleteImageFromForm((int) sobi2Config::request( $_REQUEST, "sobi2Id", null), sobi2Config::request( $_REQUEST, "sobi_gallery_id",  null),  sobi2Config::request( $_REQUEST, "imgName", null),$sgssid);
				$return = true;
				break;
			case 'modGalleryImgForm':
				$this->checkSession($sgssid);
				$this->modifyImageFromForm((int) sobi2Config::request( $_REQUEST, "sobi2Id", null), sobi2Config::request( $_REQUEST, "sobi_gallery_id",  null),  sobi2Config::request( $_REQUEST, "imgName", null),$sgssid);
				$return = true;
				break;
			case 'modGDetails':
				$this->checkSession($sgssid);
				$this->updateGalleryImageInfo((int) sobi2Config::request( $_REQUEST, "sobi2Id", null), sobi2Config::request( $_REQUEST, "sobi_gallery_id",  null),  sobi2Config::request( $_REQUEST, "imgName", null),$sgssid);
				$return = true;
				break;
			case 'admingalleryForm':
				$this->checkSession($sgssid);
				$this->adminformIframe((int) sobi2Config::request( $_REQUEST, "sobi2Id", 0), sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0),$sgssid);
				$return = true;
				break;
			default:
				$return = false;
				break;
		}
		return $return;
    }

	function editFormStart($sobi2Id,&$fields) {

		if ($this->fPos > 0) {
			$config =& sobi2Config::getInstance();
			$dummy = new stdClass();
			$dummy->label = "<span class=\"gallery_plugin_label\">"._S_2_GALLERY_TITLE."</span>";
			$dummy->fieldname = "sobi_gallery_plugin";
			$dummy->is_free = true;
			$dummy->fieldType = 4;
			$dummy->wysiwyg = false;
			$dummy->payment = 0;
			$dummy->customCode = $this->editForm($sobi2Id);
			$dummy->is_required = false;
			$this->fPos = $this->fPos - 1;
			$newArray = array();
			$c = 0;
			foreach ($fields as $n => $field) {
				if($c == $this->fPos) {
					define("_SGO_LINK_ADDED",1);
					$newArray[$c] = $dummy;
					$c++;
				}
				$newArray[$c] = $field;
				$c++;
			}
			if(!defined("_SGO_LINK_ADDED")) {
				define("_SGO_LINK_ADDED",1);
				$newArray[$c] = $dummy;
			}
			$fields = $newArray;
		}
	}

    function showDetails($sobi2Id) {
		$config =& sobi2Config::getInstance();
    	if($sobi2Id) {
    		$images = $this->getImages($sobi2Id);
    		$imgScr = $this->buidImages($images,false,$sobi2Id);
    	}
    	if(!count($images))
    	{
    		if ($this->showNoImage) {
				$details = "<div class=\"sobi_gallery_noimage\">"._S_2_GALLERY_NOIMAGES."</div>";
				return $details;
			}
			else
				return null;
    	}

		//wenn Bildpopup
		switch ($this->imagePopup) {
			case 1: // popup image
				$style = 'function sobiGallery_openWindow (adr, breite, hoehe) {
				w = screen.width;
				h = screen.height;
				breite += 20;
				hoehe += 20;
				sobiGallery_window = window.open(adr, "GalleryImage", "width="+breite+",height="+hoehe+",left="+((w-breite)/2)+",top="+((h-hoehe)/2)+"menubar=no", false);
				sobiGallery_window.resizeTo(breite+8,hoehe+80);
				sobiGallery_window.moveTo((w-breite)/2,(h-hoehe)/2);
				sobiGallery_window.focus();
				}';
				$config->addCustomScript($style);
				break;
			
			default: // Lightbox effect
				if (!$this->usedScript) {
					$config->loadScript("prototype");
					$config->addCustomHeadTag("<script type='text/javascript' src='{$config->liveSite}/components/com_sobi2/plugins/gallery/scriptaculous.js?load=effects'></script>");
					$config->addCustomHeadTag("<script type='text/javascript' src='{$config->liveSite}/components/com_sobi2/plugins/gallery/lightbox.js'></script>");

					$style = "<style type=\"text/css\"> \n\t" .
							"#prevLink:hover, #prevLink:visited:hover { background: url({$config->liveSite}/components/com_sobi2/plugins/gallery/images/prev.gif) left 15% no-repeat; } \n\t\t" .
							"#nextLink:hover, #nextLink:visited:hover { background: url({$config->liveSite}/components/com_sobi2/plugins/gallery/images/next.gif) right 15% no-repeat; } \n\t\t" .
							"#overlay{ background-image: url({$config->liveSite}/components/com_sobi2/plugins/gallery/images/overlay.png); } \n\t\t ".
							"</style>\n";
					$config->addCustomHeadTag($style);
				}
				else {
					$config->addCustomHeadTag("<script type='text/javascript' src='{$config->liveSite}/components/com_sobi2/plugins/gallery/slimbox.js'></script>");
				}
				break;
		}

    	$count = count($images);
    	$fullbreite = "";
    	if ($this->displayVert && $this->adjustSizes)
			$fullbreite = "style=\"width:".$this->thmW*$this->numberInRows."px;\"";
	   	$details = "<table class='sobi_gallery' {$fullbreite}>";
    	$breite = "";
		if ($this->adjustSizes)
			$breite = "style=\"width:{$this->thmW}px;\"";

    	if ($this->showNum){
			$max = $this->showNum +1;
		} else {
			$max = $this->allowedImg + 1;
		}
		for($i = 1; $i < $this->allowedImg + 1; $i++){	 //Array l�uft von 1 bis ...
			if ($i == $max) $breite = "style=\"visibility:hidden;\"";
			if(isset($imgScr) && isset($imgScr[$i])) {
				if (((($i-1) % $this->numberInRows) == 0))
	    			$details .= "\n\t <tr>";
	    		$details .= " \n\t\t\t <td {$breite}>";
	    		$details .= $imgScr[$i];
	    		$details .= "\n\t\t\t </td>";
	    		if ((($i % $this->numberInRows) == 0) || ($i == $count)) {
					if (($i == $count)) {
						$j = $i;
						while (($j % $this->numberInRows) != 0) {
							$details .= " \n\t\t\t <td {$breite} class='sobi_gallery_emptycell'>&nbsp;</td>";		//tds auff�llen
							$j++;
						}
					}
	    			$details .= " \n\t </tr>";
				}
			}
    	}
    	$details .= "</table>";
    	return $details;
    }


    function editForm($sobi2Id) {
		if(defined("_SGO_LINK_ADDED") || !$this->fPos ) {
			return null;
		}
    	$config =& sobi2Config::getInstance();
		@session_name('_SG_2_VALID');
		@session_start();
		$ssid = session_id();
    	$sobi_gallery_id = time() + rand(0,10000);
    	$href = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=galleryForm&amp;sobi2Id={$sobi2Id}&amp;sobi_gallery_id={$sobi_gallery_id}&amp;sgssid={$ssid}";
    	$form = "<iframe width=\"100%\" height=\"{$this->iframeH}\" frameborder=\"0\" id=\"formIframe\" src=\"{$href}\" class=\"sobi2_gallery_frame\"></iframe>";
    	$form .= "<input type='hidden' name='sobi_gallery_id' id='sobi_gallery_id' value='{$sobi_gallery_id}'/>";
    	return $form;
    }
    /*
     * $input['fees']
     * $input['msg']                         Reference         Payment
     * adding fees: $input['fees'] += array("test"      =>     10);
     */
    function save($input,$sobi2Id,$actionSwitch='save') {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	$sobi_gallery_id = sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0, null);
		if($actionSwitch == 'save'){
			$query = "SELECT COUNT(*) FROM `#__sobi2_plugin_gallery` WHERE `params` = '{$sobi_gallery_id}'";
			$database->setQuery( $query );
			$images = $database->loadResult();
		} else { // Renew or update
			$query = "SELECT COUNT(*) FROM `#__sobi2_plugin_gallery` WHERE `itemid` = {$sobi2Id};";
			$database->setQuery( $query );
			$images = $database->loadResult(); // if still 0 there were no images
		}
		if($images && $images <= $this->allowedImg) {
	   		if ($actionSwitch == 'save'){
				$savePath = sobi2Config::translatePath("{$this->imagesAbsPath}|{$sobi2Id}|", null, false, null);
				if(!file_exists($savePath))
					$config->sobiMakePath($savePath);
				if(!($tempFolder = sobi2Config::translatePath("{$this->imagesAbsPath}|{$sobi_gallery_id}|", null, true, null))) {
					return $input;
				}
				$dir = opendir($tempFolder);
				while ($file = readdir($dir)) {
					$fileExt = strtolower(substr($file,-3));
					if(in_array($fileExt, $this->allowableFilesExt)) {
						$newFile = str_replace($sobi_gallery_id,$sobi2Id,$file);
						@copy($tempFolder.$file,$savePath.$newFile);
						if(stristr($newFile,'_image_')) {
							$thumb = str_replace('_image_','_thumb_',$newFile);
							$statement = "UPDATE `#__sobi2_plugin_gallery` " .
									"SET " .
									"`itemid` = '{$sobi2Id}', " .
									"`filename` = '{$newFile}', " .
									"`thumb` = '{$thumb}', " .
									"`params` = '' " .
									"WHERE(`params` = '{$sobi_gallery_id}' AND `filename` = '{$file}') LIMIT 1";
							$database->setQuery($statement);
							$database->query();
						}
					}
				}
				$config->removeDirRecursive($tempFolder);
			}
			/* Enable Uploaded Images since payments will now be requested */
			$statement = "UPDATE `#__sobi2_plugin_gallery` " .
					"SET " .
					"`enabled` = '1' " .
					"WHERE `itemid` = '{$sobi2Id}'";
			$database->setQuery($statement);
			$database->query();
						
			
			
			/* Fees */
			$feeChk = ($this->imagefee >0) ? 1 : 0;
			if ($feeChk){
				( ($images - $this->freeImages) > 0 ) ? $ChargeLevel = ceil(($images - $this->freeImages)/$this->perimages) : $ChargeLevel = 0;
				if ( $this->feeDiscount < 0 ){
					if ($this->maxDiscount > 0) $this->maxDiscount = $this->maxDiscount * -1;
					if ($this->maxDiscount < -100) $this->maxDiscount = -100;
					$ChargeSwitch = -1;
				} else {
					if ($this->maxDiscount < 0) $this->maxDiscount = $this->maxDiscount * -1;
					$ChargeSwitch = 1;
				}
				$ChargeCount = 1;
				while ( $ChargeCount <= $ChargeLevel ){
						$ChargeDiscount = ( ( $ChargeSwitch * $this->feeDiscount * ($ChargeCount-1) ) < ( $ChargeSwitch * $this->maxDiscount) ) ?
											($this->feeDiscount * ($ChargeCount-1)) : $this->maxDiscount;
						$ChargeAmount = round(($this->imagefee + ($ChargeDiscount * $this->imagefee /100)), 2);
						if ($actionSwitch == 'update'){
							$testPayment = _SGADM_GEN_FEE_REFERENCE.$ChargeCount;
							
							$query = "SELECT COUNT(*) FROM #__sobi2_payments WHERE sid={$sobi2Id} AND (reference='new: {$testPayment}' OR reference='renew: {$testPayment}');";
							$database->setQuery( $query );
							$paymentExists = $database->loadResult();
							if (!$paymentExists){ 
								$input['fees'] += array( $testPayment => $ChargeAmount);
							}
						} elseif ($actionSwitch == 'save'){ //Save
							$testPayment = _SGADM_GEN_FEE_REFERENCE.$ChargeCount;
							$input['fees'] += array( $testPayment => $ChargeAmount);
						} else { // Renew
							$testPayment = _SGADM_GEN_FEE_REFERENCE.$ChargeCount;
							$input += array( $testPayment => $ChargeAmount);
						}
						$ChargeCount++;
					}
			}
		}
		return $input;
    }
    /*
     * $input['fees']
     * $input['msg']                         Reference         Payment
     * adding fees: $input['fees'] += array("test"      =>     10);
     */
    function update($input,$sobi2Id) {
		$input = $this->save($input,$sobi2Id,'update');
    	return $input;
    }

	/*
     * $input['fees']
     * $input['msg']                         Reference         Payment
     * adding fees: $input['fees'] += array("test"      =>     10);
     */
    function renew($input,$sobi2Id) {
		$input = $this->save($input,$sobi2Id,'renew');
    	return $input;
    }

	
    function showListing($sobi2Id) {

    	if ($this->showFirstThumb) {	//1.Thumbnail in V-Cad anzeigen
	    	$images = $this->getImages( $sobi2Id );
	    	foreach ($images as $img ) {
	    		$thumbSrc = "{$this->imagesLivePath}/{$img->itemid}/{$img->thumb}";
	    		if( isset( $img->thumb ) && $img->thumb ) {
	    			$img = "<div class=\"sobiGalleryImage\"><img src=\"{$thumbSrc}\" alt=\"{$img->alt}\" title=\"{$img->title}\"/>";
					if($this->countInListing)
						$img = $img."<div class=\"sobiGalleryImage_caption\" style=\"width:{$this->thmW}px;\">"._S_2_GALLERY_IMAGES.$this->countImages($sobi2Id)."</div>";
					$img .= "</div>\n";
					return $img;
	    		}
	    	}
    	}
    	if($this->countInListing) {
			if (($this->countImages($sobi2Id) == 0) && ($this->showNoImage))
				$img = "<div class=\"sobiGalleryImage_caption\">"._S_2_GALLERY_NOIMAGES."</div>";
			else
    			$img = "<div class=\"sobiGalleryImage_caption\">"._S_2_GALLERY_IMAGES.$this->countImages($sobi2Id)."</div>";
			return $img;
		}
    	else
    		return null;
    }

    function replaceMarkers($string) {
    	return $string;
    }
/*
 *
 * ************************************************************
 * free defined methods
 * ************************************************************
 */
    function sobi_gallery() {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	$config->addCustomHeadTag("<link rel='stylesheet'  href='{$config->liveSite}/components/com_sobi2/plugins/gallery/sobi_gallery.css' type='text/css' />");
    	$this->imagesLivePath = "{$config->liveSite}/images/com_sobi2/gallery";
    	$this->imagesAbsPath = sobi2Config::translatePath("images|com_sobi2|gallery", "root", false, null);
    	$this->displayVert = $config->getValueFromDB("sobi_gallery","sg_displayVert");
    	$this->allowedImg = $config->getValueFromDB("sobi_gallery","sg_allowedImg");
    	$this->imgH = $config->getValueFromDB("sobi_gallery","sg_imgH");
    	$this->imgW = $config->getValueFromDB("sobi_gallery","sg_imgW");
    	$this->thmH = $config->getValueFromDB("sobi_gallery","sg_thmH");
    	$this->thmW = $config->getValueFromDB("sobi_gallery","sg_thmW");
    	$this->sobi_gallery_fileSize = $config->getValueFromDB("sobi_gallery","sg_fileSize");
    	$this->alwaysResizeThumb = $config->getValueFromDB("sobi_gallery","sg_alwaysResizeThumb");
    	$this->alwaysResizeImages = $config->getValueFromDB("sobi_gallery","sg_alwaysResizeImages");
    	$this->countInListing = $config->getValueFromDB("sobi_gallery","sg_countInListing");
    	$this->sobi_gallery_fileSize /= 1024;
    	$this->iframeH = $config->getValueFromDB("sobi_gallery","sg_iframeH");
    	$this->fPos = $config->getValueFromDB("sobi_gallery","sg_fPos");
    	$this->usedScript = $config->getValueFromDB("sobi_gallery","sg_usedScript");
    	$this->imagePopup = $config->getValueFromDB("sobi_gallery","sg_imagePopup");
    	$this->numberInRows = $config->getValueFromDB("sobi_gallery","sg_numberInRows");
    	$this->adjustSizes = $config->getValueFromDB("sobi_gallery","sg_adjustSizes");
    	$this->showFirstThumb = $config->getValueFromDB("sobi_gallery","sg_showFirstThumb");
		$this->showNoImage = $config->getValueFromDB("sobi_gallery","sg_showNoImage");
		$this->imagefee = $config->getValueFromDB("sobi_gallery","sg_imagefee");
		$this->perimages = $config->getValueFromDB("sobi_gallery","sg_perimages");
		$this->freeImages = $config->getValueFromDB("sobi_gallery","sg_freeImages");
		$this->feeDiscount = $config->getValueFromDB("sobi_gallery","sg_feeDiscount");
		$this->maxDiscount = $config->getValueFromDB("sobi_gallery","sg_maxDiscount");
		$this->showNum = $config->getValueFromDB("sobi_gallery","sg_showNum");
		
    }
    function checkSession($sgssid) {
		$config =& sobi2Config::getInstance();
    	session_name('_SG_2_VALID');
		@session_start();
    	$ssid = session_id();
    	if(!$sgssid) {
    		 die( 'Restricted access' );
    	}
   }
   function deleteImageFromForm($sobi2Id,$sobi_gallery_id,$file,$sgssid) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
   		if($sobi2Id) {
   			$path = sobi2Config::translatePath("{$this->imagesAbsPath}|{$sobi2Id}|", null, false, null);
   		}
   		else {
   			$path = sobi2Config::translatePath("{$this->imagesAbsPath}|{$sobi_gallery_id}|", null, false, null);
   		}
   		$File = $path.$file;
		@unlink($File);
			/* get position */
   		if(!$sobi2Id) {
	   		$folderId = $sobi_gallery_id;
	   		$params = "AND `params` = '{$sobi_gallery_id}'";
   		}
	   	else {
	   		$folderId = $sobi2Id;
	   		$params = null;
	   	}

	   	$query = "SELECT `position`  FROM  `#__sobi2_plugin_gallery` WHERE `filename` = '{$file}' {$params}";
		$database->setQuery( $query );
		$filePos = $database->loadResult();

   		if(!$sobi2Id)
	   		$statement = "UPDATE `#__sobi2_plugin_gallery` SET `position` = position-1 WHERE (`params` = '{$sobi_gallery_id}' AND `position` > {$filePos} );";

	   	else
	   		$statement = "UPDATE `#__sobi2_plugin_gallery` SET `position` = position-1 WHERE (`itemid` = '{$sobi2Id}' AND `position` > {$filePos} );";

		$database->setQuery($statement);
		$database->query();

		$statement = "DELETE FROM `#__sobi2_plugin_gallery` WHERE `filename` = '{$file}' LIMIT 1;";
		$database->setQuery($statement);
		$database->query();
		$Thumb = str_replace('_image_', '_thumb_',$File);
		@unlink($Thumb);
   		$this->formIframe($sobi2Id, $sobi_gallery_id,$sgssid);
    }
   
	function updateGalleryImageInfo($sobi2Id,$sobi_gallery_id,$file,$sgssid) {
		$config =& sobi2Config::getInstance();
		$user =& $config->getUser();
		$imgids = array();
		$title = array();
		$alt = array();
		$position = array();
		$count = 0;
		foreach($_REQUEST['imgid'] as $id)
			{
				$imgids[] = $_REQUEST['imgid'][$count];
				$title[] = $_REQUEST['title'][$count];
				$alt[] = $_REQUEST['alt'][$count];
				$position[] = $_REQUEST['position'][$count];
				$count++;
			}
		$database =& $config->getDb();
   		$count = 0;
		foreach ($imgids as $imgid){
			if ($user->usertype <> 'Super Administrator'){
				/* Prevent injection attack */
				if ($sobi2Id == $sobi_gallery_id){
					exit( _SOBI2_NOT_AUTH );
				}
				if ($sobi2Id){
					$query = "SELECT itemid FROM `#__sobi2_plugin_gallery` WHERE `imgid` = '{$imgid}' LIMIT 1";
					$database->setQuery($query);
					$OWNERchk = $database->LoadResult();
					$query = "SELECT owner FROM `#__sobi2_item` WHERE `itemid` = '{$OWNERchk}' LIMIT 1";
					$database->setQuery($query);
					if ($database->LoadResult() !== $user->id) {
						exit( _SOBI2_NOT_AUTH );
					}
				} else {
					$query = "SELECT COUNT(*) FROM `#__sobi2_plugin_gallery` WHERE `imgid` = '{$imgid}' AND params='{$sobi_gallery_id}' LIMIT 1";
					$database->setQuery($query);
					if ($database->LoadResult() == 0){
						exit( _SOBI2_NOT_AUTH );
					}
				}
			}
			$statement = "UPDATE `#__sobi2_plugin_gallery` " .
					"SET " .
					"`title` = '{$title[$count]}', " .
					"`alt` = '{$alt[$count]}', " .
					"`position` = '{$position[$count]}' " .
					"WHERE `imgid` = '{$imgids[$count]}' LIMIT 1";
			$database->setQuery($statement);
			$database->query();
			$count++;
		}
		$this->formIframe($sobi2Id, $sobi_gallery_id,$sgssid);
    }
   
   function modifyImageFromForm($sobi2Id,$sobi_gallery_id,$file,$sgssid) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$user =& $config->getUser();
		if(!$sobi2Id) {
	   		$params = "`params` = '{$sobi_gallery_id}'";
			$gpid = $sobi_gallery_id;
   		}
	   	else {
	   		$params = "`itemid` = '{$sobi2Id}'";
			$gpid = $sobi2Id;
	   	}
		
	   	$Gimages = array();
		$query = "SELECT * FROM  `#__sobi2_plugin_gallery` WHERE {$params}";
		$database->setQuery( $query );
		$Gimages = $database->loadObjectList();
		$action = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=galleryForm&amp;sobi2Id={$sobi2Id}&amp;gallery_id={$sobi_gallery_id}&amp;sgssid={$sgssid}";
		$altaction = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=modGDetails&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
		
		?>
		<script language="JavaScript">
		<!--
		  if (document.images)
		   {
			 image_off= new Image( <?php echo $this->thmW.', '.$this->thmH; ?> );
			 image_off.src='<?php echo"{$this->imagesLivePath}/{$gpid}/{$Gimages[0]->thumb}";?>';  
			 
			<?php
			$count=1;
			$integretycheck = true;
			foreach($Gimages as $Gimage){
				if ($user->usertype <> 'Super Administrator'){
					/* Prevent injection attack */
					if ($sobi2Id == $sobi_gallery_id){
						exit( _SOBI2_NOT_AUTH );
					}
					if ($sobi2Id){
						$query = "SELECT owner FROM `#__sobi2_item` WHERE `itemid` = '{$Gimage->itemid}' LIMIT 1";
						$database->setQuery($query);
						if ($database->LoadResult() !== $user->id) {
							exit( _SOBI2_NOT_AUTH );
						}
					} else {
						if ($integretycheck) {
							$integretycheck = false;
							$integitem = $Gimage->itemid;
							$integid = $Gimage->params;
						} elseif ($integitem <> $Gimage->itemid || $integid <> $Gimage->params){
							exit( _SOBI2_NOT_AUTH );
						}
					}
				}
				echo"
				image{$count}= new Image({$this->thmW},{$this->thmH});
				image{$count}.src='{$this->imagesLivePath}/{$gpid}/{$Gimage->thumb}';
				";
				$count++;
			}
			?>
		   }

		function change1(picName,imgName)
		 {
		   if (document.images)
			{
			  imgOn=eval(imgName + ".src");
			  document[picName].src= imgOn;
			}
		 }
		//-->
		</script>
		<script type="text/javascript">
		<!--

		alert ("<?php echo _S_2_GALLERY_EDIT_WARNING; ?>")

		// -->
		</script> 
		<form action="<?php echo $action; ?>" id="sobi_gallery_form" name="sobi_gallery_form" enctype="multipart/form-data" method="post">
			<table class="sobi_gallery_GformBox" style='float: left;'>
				<tr>
					<th style='text-align: center; '><?php echo _S_2_GALLERY_EDIT_FILENAME_LBL; ?></th>
					<th style='text-align: center; '><?php echo _S_2_GALLERY_EDIT_TITLE_LBL; ?></th>
					<th style='text-align: center; ;'><?php echo _S_2_GALLERY_EDIT_ALTTEXT_LBL; ?></th>
					<th style='text-align: center; ;'><?php echo _S_2_GALLERY_EDIT_POSITION_LBL; ?></th>
					<td rowspan="5">
						<img src='<?php echo "{$this->imagesLivePath}/{$gpid}/{$Gimages[0]->thumb}"; ?>' style='align: top' width='<?php echo $this->thmW; ?>' height='<?php echo $this->thmH; ?>' name='pic1'/>
					</td>
				</tr>
				
		<?php
		$count = 1;
		foreach ($Gimages as $Gimage){
		?>
			<tr>
				<td style='text-align: center; '>
					<a href="url" onMouseover="change1('pic1','image<?php echo $count; ?>')" )"><?php echo $Gimage->filename; ?></a>
					<input type="hidden" name="imgid[]" value="<?php echo $Gimage->imgid; ?>"/>
				</td>
				<td style='text-align: center; '><input type="text" class="text_area" style="text-align:center;" name="title[]" value="<?php echo $Gimage->title ?>" size="30" maxlength="100"/></td>
				<td style='text-align: center; '><input type="text" class="text_area" style="text-align:center;" name="alt[]" value="<?php echo $Gimage->alt ?>" size="30" maxlength="100"/></td>
				<td style='text-align: center; '><input type="text" class="text_area" style="text-align:center;" name="position[]" value="<?php echo $Gimage->position ?>" size="5" maxlength="11"/></td>
			</tr>
			
		<?php
		$count++;
		}
   		?>
			</table>
			<input type="hidden" name="sobi_gallery_id" value="<?php echo $sobi_gallery_id; ?>"/>
			<input id="sobi2CustomSendButton2" class="button" type="submit" value="<?php echo _S_2_GALLERY_UPDATE_BUTTON; ?>" onclick="this.form.action='<?php echo $altaction ?>';"/>
		</form> 
		<?php
   }
   
   function getImages($sobi2Id,$sobi_gallery_id = null) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	$images = array();
    	if(!$sobi2Id)
    		$query = "SELECT * FROM `#__sobi2_plugin_gallery` WHERE `params` = '{$sobi_gallery_id}' ORDER BY `position` ASC";
    	else
    		$query = "SELECT * FROM `#__sobi2_plugin_gallery` WHERE `itemid` = '{$sobi2Id}' ORDER BY `position` ASC";
    	$database->setQuery( $query );
    	$resutlts = $database->loadObjectList();
    	if(count($resutlts)) {
	    	foreach($resutlts as $resutlt) {
	    		$images[$resutlt->position] = $resutlt;
	    	}
    	}
    	return $images;
   }
   function buidImages($images,$form = false, $sobi2Id, $sobi_gallery_id = null) {
		$imagesSrc = array();
		if(count($images)) {
			foreach($images as $image) {
				$thumbSrc = "{$this->imagesLivePath}/{$image->itemid}/{$image->thumb}";
				if(!$form) {
					if ($image->enabled){
						$imgSrc = "{$this->imagesLivePath}/{$image->itemid}/{$image->filename}";
						$img = "<img src='{$thumbSrc}' alt='{$image->alt}' title='{$image->title}' />";

						//grosses Bild im Popup darstellen
						switch ($this->imagePopup) {
							
							case 1: // Popup Window
								$size = getimagesize($imgSrc);	//Groesse des Bildes ermitteln
								list($width, $height, $type, $attr) = $size;
								if ($width == 0)
									$width= 400;
								if ($height == 0)
									$height= 300;
								$imagesSrc[$image->position] = "<div class=\"gallerythumb\"><a href='{$imgSrc}' title='{$image->title}' onclick=\"sobiGallery_openWindow(this.href,{$width},{$height}); return false;\">{$img}</a></div>";
								break;
							
							case 2: // Inline Preview
							case 3: // Inline Preview and Lightbox
								$imagesSrc[$image->position] = "<div class=\"gallerythumb\"> <a onMouseOver=\"document['galleryFeatureImg'].src={$imgSrc};\">{$img}</a></div>";
								break;
							
							default: // Lightbox
								$imagesSrc[$image->position] = "<div class=\"gallerythumb\"><a href='{$imgSrc}' title='{$image->title}' rel=\"lightbox[roadtrip]\">{$img}</a></div>";
								break;
						}
					}
				}
				else {
					if(!$sobi2Id) $thumbSrc = "{$this->imagesLivePath}/{$sobi_gallery_id}/{$image->thumb}";
					$imagesSrc[$image->position] = "<img src='{$thumbSrc}' alt='{$image->alt}' title='{$image->title}' />";
				}
			}
		}
		return $imagesSrc;
   }
   function countImages($sobi2Id) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
    	$query = "SELECT COUNT(*) FROM `#__sobi2_plugin_gallery` WHERE `itemid` = '{$sobi2Id}'";
		$database->setQuery( $query );
		return $database->loadResult();
   }
   function sobi_gallery_getImagesFromRequest($sobi2Id, $sobi_gallery_id,$sgssid) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		if(isset($_FILES["sobi_gallery_Gimg"]) && is_array($_FILES["sobi_gallery_Gimg"])) {
			/* get file */
	   		$file = $_FILES["sobi_gallery_Gimg"];

	   		/* check filesize */
	   		if($file['size'] > $this->sobi_gallery_fileSize * 1024) {
	   			echo "<div class='message'>"._S_2_GALLERY_ERR_FILESIZE."</div>";
	   			$this->formIframe($sobi2Id, $sobi_gallery_id,$sgssid);
	   			return false;
	   		}

	   		/* check extension */
	   		$fileExt = strtolower(substr( $file['name'], -3 ));
	   		$allowedFile = false;
			foreach( $this->allowableFilesExt as $allowableExt ){
				if (strcasecmp( $fileExt, $allowableExt ) == 0){
					$allowedFile = true;
				}
			}
	   		if(!$allowedFile) {
	   			echo "<div class='message'>"._S_2_GALLERY_ERR_EXT."</div>";
	   			$this->formIframe($sobi2Id, $sobi_gallery_id,$sgssid);
	   			return false;
	   		}

	   		/* when adding new entry */
	   		if(!$sobi2Id) {
		   		$folderId = $sobi_gallery_id;
		   		$query = "SELECT MAX(`position`)  FROM  `#__sobi2_plugin_gallery` WHERE `params` = '{$sobi_gallery_id}'";
	   		}
		   	else {
		   		$folderId = $sobi2Id;
		   		$query = "SELECT MAX(`position`) FROM  `#__sobi2_plugin_gallery` WHERE `itemid` = '{$sobi2Id}'";
		   	}
			$database->setQuery( $query );
			$filePos = $database->loadResult();
	   		if(!$filePos) {
	   			$filePos = 1;
	   		}
	   		else {
	   			$filePos++;
	   		}
	   		$savePath = sobi2Config::translatePath("{$this->imagesAbsPath}|{$folderId}", null, false, null);

	   		if(!file_exists($savePath)){
	   			$config->sobiMakePath($savePath);
	   		}
	   		$tempArray = array ('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','t');
			$tempStr = $tempArray[rand(0,20)].$tempArray[rand(0,20)].$tempArray[rand(0,20)];
			$imageName = "{$folderId}_image_{$filePos}_{$tempStr}.{$fileExt}";
			$thumbName = "{$folderId}_thumb_{$filePos}_{$tempStr}.{$fileExt}";
			 
			if(sobi2Config::translatePath("{$savePath}|{$imageName}", null, true, null)) {
				$tempStr = $tempArray[rand(0,20)].$tempArray[rand(0,20)].$tempArray[rand(0,20)];
				$imageName = "{$folderId}_image_{$filePos}_{$tempStr}.{$fileExt}";
				$thumbName = "{$folderId}_thumb_{$filePos}_{$tempStr}.{$fileExt}";
			}
	   		$thumb = sobi2Config::translatePath("{$savePath}|{$thumbName}", null, false, null);
	   		$image = sobi2Config::translatePath("{$savePath}|{$imageName}", null, false, null);
			if(@move_uploaded_file($_FILES["sobi_gallery_Gimg"]['tmp_name'],$thumb )){
				if(@copy($thumb,$image)) {
					if($this->sobi_gallery_resampleImage($thumb,true,$fileExt)) {
						if($this->sobi_gallery_resampleImage($image,false,$fileExt)) {
							$this->saveImage($folderId,$thumbName,$imageName,$filePos,$sobi2Id);
						}
						else
							echo "<div class='message'>"._S_2_GALLERY_ERR_RESAMPLING."</div>";
					}
					else
						echo "<div class='message'>"._S_2_GALLERY_ERR_RESAMPLING."</div>";
				}
				else
					echo "<div class='message'>"._S_2_GALLERY_ERR_COPY."</div>";
			}
			else
				echo "<div class='message'>"._S_2_GALLERY_ERR_MOVE."</div>";
   			@sobi2Config::chmodRecursive($savePath,0664,0775);
   			$this->formIframe($sobi2Id, $sobi_gallery_id,$sgssid);
   		}
   		return true;
   }
   function saveImage($name,$thumbName,$imageName,$pos,$sobi2Id) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		$title = (string) sobi2Config::request( $_REQUEST, "sobi_gallery_Gimg_title", null, null);
		if($sobi2Id){
			$params = null;
		}
		else{
			$params = $name;
		}
		$now = $config->getTimeAndDate();
		$statement = "INSERT INTO `#__sobi2_plugin_gallery` " .
				"( `itemid` , `filename` , `thumb` , `alt` , `title` , `added` , `params` , `enabled` , `position` ) " .
				"VALUES ( " .
				"'{$sobi2Id}', " .
				"'{$imageName}', " .
				"'{$thumbName}', " .
				"'', " .
				"'{$title}', " .
				"'{$now}', " .
				"'{$params}', " .
				"'0', " .
				"'{$pos}' ); ";
		$database->setQuery($statement);
		$database->query();
   }
   function sobi_gallery_resampleImage($file, $thumb, $fileType) {
   		$config =& sobi2Config::getInstance();
   		if($thumb) {
			$width = $this->thmW;
			$height = $this->thmH;
			$resize = $this->alwaysResizeThumb;
		}
		else {
			$width = $this->imgW;
			$height = $this->imgH;
			$resize = $this->alwaysResizeImages;
		}
		list($width_orig, $height_orig, $imgType) = getimagesize($file);
    	if(!$resize && (($width_orig < $width) && ($height_orig < $height)))
    	{
    		return true;
    	}
    	$ratio_orig = $width_orig/$height_orig;

		if ($thumb){
			if ($width/$height < $ratio_orig)
			{
				$width = $height*$ratio_orig;
			}
			else
			{
				$height = $width/$ratio_orig;
			}
		} else {
			if ($width/$height > $ratio_orig)
			{
				$width = $height*$ratio_orig;
			}
			else
			{
				$height = $width/$ratio_orig;
			}
		} 	
		switch($imgType) {
			case 1:
				if(!($image_p = imagecreatetruecolor($width, $height)))
					return false;
				if(!($image = imagecreatefromgif($file)))
					return false;
				if(!(imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig)))
					return false;
				if(!(imagegif($image_p, $file)))
					return false;
			break;
			case 2:
				if(!($image_p = imagecreatetruecolor($width, $height)))
					return false;
				if(!($image = imagecreatefromjpeg($file)))
					return false;
				if(!(imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig)))
					return false;
				if(!(imagejpeg($image_p, $file,$config->key( "general", "jpeg_image_quality", 75 ))))
					return false;
			break;
			case 3:
				if(!($image_p = imagecreatetruecolor($width, $height)))
					return false;
				if(!($image = imagecreatefrompng($file)))
					return false;
				if(!(imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig)))
					return false;
				if(!(imagepng($image_p, $file,$config->key( "general", "png_image_compression", 0 ))))
					return false;
			break;
		}
		imagedestroy($image_p);
		imagedestroy($image);
		return true;
   }
 
	function formIframe($sobi2Id, $sobi_gallery_id,$sgssid) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
		if( $sobi2Id ) {
			if( !$config->checkPerm() ) {
				$query = "SELECT owner FROM #__sobi2_item WHERE itemid = {$sobi2Id}";
				$database->setQuery( $query );
				$owner = $database->loadResult();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					exit( "Permissions Error "._SOBI2_NOT_AUTH );
				}
				$user =& $config->getUser();
				if( $user->id != $owner ) {
					exit( _SOBI2_NOT_AUTH );
				}
			}
		}
		$config->loadScript("advajax");
		$action = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=uploadGfile&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
		$images = $this->getImages($sobi2Id,$sobi_gallery_id);
		$imgScr = $this->buidImages($images, true, $sobi2Id, $sobi_gallery_id);
		?>
		<div class="sobi2">
		<div id="sobi_gallery_GalleryBox">
		<?php
		$delT = _S_2_GALLERY_DELETE_FILE;
		for($i = 0; $i < $this->allowedImg + 1; $i++) {
			if(isset($imgScr) && isset($imgScr[$i])) {
				$style = $this->thmH +40;
				$delpos = $style;
				if ($delpos >= 16)
					$delpos = $delpos - 16;
				else
					$delpos = 16;
				$style = "height: {$style}px;";
				$fname = $images[$i]->filename;
				$delHref = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=delGalleryImgForm&amp;sobi_gallery_id={$sobi_gallery_id}&amp;imgName={$fname}&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
				$modHref = "{$config->liveSite}/index2.php?option=com_sobi2&amp;sobi2Task=modGalleryImgForm&amp;sobi_gallery_id={$sobi_gallery_id}&amp;imgName={$fname}&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
				?>
				<div class="sobi_gallery_GimageBox" style="<?php echo $style; ?>">
					<div class="sobi_gallery_GdelBox"><!--  style="padding-top: <?php echo $delpos; ?>px;" -->
					<a href="<?php echo $delHref; ?>" onclick="sobi_gallery_loadImage();">
						<img src="./components/com_sobi2/plugins/gallery/images/delete.png" alt="<?php echo $delT ?>" title="<?php echo $delT ?>" height="16" width="16" />
					</a>
					</div>
					<div class="sobi_gallery_GthumbBox"><?php echo $imgScr[$i]; ?></div>
				<br/>
					<div class="sobi_gallery_GtitleBox"><?php echo $images[$i]->title; ?></div>
				</div>
			<?php
			}
		}
		if(count($images) < $this->allowedImg) {
			$numImages = count($images);
			( ($numImages - $this->freeImages) > 0 && $this->perimages > 0) ? $ChargeLevel = ceil(($numImages - $this->freeImages)/$this->perimages) : $ChargeLevel = 0;
			if ( $this->feeDiscount < 0 ){
				if ($this->maxDiscount > 0) $this->maxDiscount = $this->maxDiscount * -1;
				if ($this->maxDiscount < -100) $this->maxDiscount = -100;
				$ChargeSwitch = -1;
			} else {
				if ($this->maxDiscount < 0) $this->maxDiscount = $this->maxDiscount * -1;
				$ChargeSwitch = 1;
			}
			$ChargeCount = 1;
			$ChargeAmount = 0;
			while ( $ChargeCount <= $ChargeLevel ){
				$ChargeDiscount = ( ( $ChargeSwitch * $this->feeDiscount * ($ChargeCount-1) ) < ( $ChargeSwitch * $this->maxDiscount) ) ?
									($this->feeDiscount * ($ChargeCount-1)) : $this->maxDiscount;
				$ChargeAmount = $ChargeAmount + round(($this->imagefee + ($this->imagefee * $ChargeDiscount/100)), 2);
				$ChargeCount++;
			}
		?>
		</div>
		  <br/>
		  <form action="<?php echo $action; ?>" id="sobi_gallery_form" name="sobi_gallery_form" enctype="multipart/form-data" method="post">
			  <table class="sobi_gallery_GformBox">
			    <?php
				if (count($images)){
				?>
					<tr>
					  <td colspan="2">
						<input type="button" class="button" onclick="location.href='<?php echo $modHref; ?>'"  name="editEntry" value="<?php echo _S_2_GALLERY_EDIT_DETAILS_BUTTON; ?>"/>
					  </td>
					</tr>
				<?php
				} ?>
			    <tr>
			      <td colspan="2"><?php echo _S_2_GALLERY_ADD_IMAGE; ?></td>
			    </tr>
			    <tr>
			      <td colspan="2">
				  	<span class="sobi_gallery_GtitleBox">
				  		<label for="sobi_gallery_Gimg_title"><?php echo _S_2_GALLERY_IMAGE_TITLE; ?></label>
				  		<input name="sobi_gallery_Gimg_title" id="sobi_gallery_Gimg_title" class="inputbox" type="text" size="40" maxlength="100" value = ""/>
				  	</span>
			      </td>
			    </tr>
			    <tr>
			      <td colspan="2">
					<?php 
					if ($this->imagefee){
						if($this->freeImages){
							echo _SGADM_GEN_FREE_IMAGES_1.$this->freeImages._SGADM_GEN_FREE_IMAGES_2.'<br />';
						}
						if ($ChargeAmount){
							echo _SGADM_GEN_IMAGES_FEE_1.$ChargeAmount.' '.$config->currency.'<br />';
						}
					}
					?>
				  </td>
			    </tr>
			    <tr>
			      <td>
				  <input type="hidden" name="sobi_gallery_id" value="<?php echo $sobi_gallery_id; ?>"/>
  				  	<input type="file" name="sobi_gallery_Gimg" id="sobi_gallery_Gimg" class="inputbox" size="40" maxlength="100000" accept="text/*"/>
  					<input type="submit" name="name" class="button" onclick="sobi_gallery_loadImage();" value="<?php echo _S_2_GALLERY_UPLOAD_BUTTON; ?>"/>
				  </td>
				  <td><span id="sobi_gallery_loader"></span></td>
			  </table>
		  </form>
		</div>

		<?php
		}else{
			$numImages = count($images);
			( ($numImages - $this->freeImages) > 0 ) ? $ChargeLevel = ceil(($numImages - $this->freeImages)/$this->perimages) : $ChargeLevel = 0;
			if ( $this->feeDiscount < 0 ){
				if ($this->maxDiscount > 0) $this->maxDiscount = $this->maxDiscount * -1;
				if ($this->maxDiscount < -100) $this->maxDiscount = -100;
				$ChargeSwitch = -1;
			} else {
				if ($this->maxDiscount < 0) $this->maxDiscount = $this->maxDiscount * -1;
				$ChargeSwitch = 1;
			}
			$ChargeCount = 1;
			$ChargeAmount = 0;
			while ( $ChargeCount <= $ChargeLevel ){
				$ChargeDiscount = ( ( $ChargeSwitch * $this->feeDiscount * ($ChargeCount-1) ) < ( $ChargeSwitch * $this->maxDiscount) ) ?
									($this->feeDiscount * ($ChargeCount-1)) : $this->maxDiscount;
				$ChargeAmount = $ChargeAmount + round(($this->imagefee + ($this->imagefee * $ChargeDiscount/100)), 2);
				$ChargeCount++;
			}
		?>
		</div>
		  <br/>
		  <form action="<?php echo $action; ?>" id="sobi_gallery_form" name="sobi_gallery_form" enctype="multipart/form-data" method="post">
			  <table class="sobi_gallery_GformBox">
			    <?php
				if (count($images)){
				?>
					<tr>
					  <td colspan="2">
						<input type="button" class="button" onclick="location.href='<?php echo $modHref; ?>'"  name="editEntry" value="<?php echo _S_2_GALLERY_EDIT_DETAILS_BUTTON; ?>"/>
					  </td>
					</tr>
				<?php
				} ?>
			    <tr>
			      <td colspan="2">
					<?php 
					if ($this->imagefee){
						if($this->freeImages){
							echo _SGADM_GEN_FREE_IMAGES_1.$this->freeImages._SGADM_GEN_FREE_IMAGES_2.'<br />';
						}
						if ($ChargeAmount){
							echo _SGADM_GEN_IMAGES_FEE_1.$ChargeAmount.' '.$config->currency.'<br />';
						}
					}
					?>
				  </td>
			    </tr>
			    <tr>
			      <td>
					<input type="hidden" name="sobi_gallery_id" value="<?php echo $sobi_gallery_id; ?>"/>
  				  </td>
				  <td><span id="sobi_gallery_loader"></span></td>
			  </table>
		  </form>
		</div>
		<?php
		}
	?>
	<script language="JavaScript" type="text/javascript">
		function sobi_gallery_loadImage() {
			document.getElementById("sobi_gallery_loader").innerHTML = "<img src='./components/com_sobi2/plugins/gallery/images/loading.gif' >";
		}
	</script>
	<?php
   }
}
?>