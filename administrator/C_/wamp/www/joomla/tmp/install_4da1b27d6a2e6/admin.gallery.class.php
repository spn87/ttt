<?php
/**
* @version $Id: admin.gallery.class.php 3002 2007-12-23 16:33:34Z Sigrid Suski $
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
class sobi_gallery_adm extends sobi_gallery {
/*
 *
 * ************************************************************
 * required methods
 * ************************************************************
 */

	function customTask($sobi2Task) {
		$sgssid = sobi2Config::request( $_REQUEST, "sgssid");
		$return = false;
		switch($sobi2Task) {
			case 'galleryForm':
				$this->checkSession($sgssid);
				$this->adminformIframe((int) sobi2Config::request( $_REQUEST, "sobi2Id", 0), sobi2Config::request( $_REQUEST, "sobi_gallery_id", 0),$sgssid);
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

	
	function saveConfig() {
    	$config =& adminConfig::getInstance();
    	$config->setValueInDB(floatval(sobi2Config::request( $_POST, 'imagefee',$this->imagefee )),"sg_imagefee","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'perimages', $this->perimages )),"sg_perimages","sobi_gallery");
    	$config->setValueInDB(floatval(sobi2Config::request( $_POST, 'feeDiscount',$this->feeDiscount )),"sg_feeDiscount","sobi_gallery");
    	$config->setValueInDB(floatval(sobi2Config::request( $_POST, 'maxDiscount', $this->maxDiscount )),"sg_maxDiscount","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'freeImages', $this->freeImages )),"sg_freeImages","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'display',$this->displayVert )),"sg_displayVert","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'countInListing', $this->countInListing )),"sg_countInListing","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'allowedImg',$this->allowedImg )),"sg_allowedImg","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imgH',$this->imgH )),"sg_imgH","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imgW', $this->imgW )),"sg_imgW","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'alwaysResizeImages', $this->alwaysResizeImages )),"sg_alwaysResizeImages","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'thmH', $this->thmH )),"sg_thmH","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'thmW', $this->thmW )),"sg_thmW","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'alwaysResizeThumb', $this->alwaysResizeThumb )),"sg_alwaysResizeThumb","sobi_gallery");
    	$fileSize = intval(sobi2Config::request( $_POST, 'sobi_gallery_fileSize',$this->sobi_gallery_fileSize )) * 1024;
    	$config->setValueInDB($fileSize,"sg_fileSize","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'iframeH', $this->iframeH )),"sg_iframeH","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'fPos', $this->iframeH )),"sg_fPos","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'usedScript', $this->usedScript )),"sg_usedScript","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'imagePopup', $this->imagePopup )),"sg_imagePopup","sobi_gallery");
		if ($this->numberInRows > $this->allowedImg)
			$this->numberInRows = $this->allowedImg;
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'numberInRows', $this->numberInRows )),"sg_numberInRows","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'adjustSizes', $this->adjustSizes )),"sg_adjustSizes","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showFirstThumb', $this->showFirstThumb )),"sg_showFirstThumb","sobi_gallery");
    	$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showNoImage', $this->showNoImage )),"sg_showNoImage","sobi_gallery");
		$config->setValueInDB(intval(sobi2Config::request( $_POST, 'showNum', $this->showNoImage )),"sg_showNum","sobi_gallery");
		
    }

    function config() {
    ?>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 100%;"><?php echo _S_2_ADM_CONFIG_HEADER._S_2_ADM_CONFIG_HEADER_G; ?></th>
		</tr>
	</table>

	<table class="SobiAdminForm" width="100%">

	<tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_SHOWNUM_EXPL),addslashes(_SGADM_ADM_SHOWNUM),'','',_SGADM_ADM_SHOWNUM, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="showNum" value="<?php echo $this->showNum ?>" size="6" maxlength="6"/></td>
    </tr>
	<tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_ALLOWED_IMGS_EXPL),addslashes(_S_2_ADM_ALLOWED_IMGS),'','',_S_2_ADM_ALLOWED_IMGS, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="allowedImg" value="<?php echo $this->allowedImg ?>" size="5" maxlength="5"/></td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_NUMBERR_EXPL),addslashes(_SGADM_GEN_NUMBERR),'','',_SGADM_GEN_NUMBERR, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="numberInRows" value="<?php echo $this->numberInRows ?>" size="5" maxlength="5"/></td>
    </tr>

     <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_ADJUSTSIZ_EXPL),addslashes(_SGADM_GEN_ADJUSTSIZ),'','',_SGADM_GEN_ADJUSTSIZ, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'adjustSizes', 'class="inputbox"', $this->adjustSizes ); ?></td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_DISPLAY_EXPL),addslashes(_S_2_ADM_DISPLAY),'','',_S_2_ADM_DISPLAY, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'display', 'class="inputbox"', $this->displayVert,  _S_2_ADM_DISPLAY_V, _S_2_ADM_DISPLAY_H ); ?></td>
    </tr>

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_USED_SCRIPT_EXPL),addslashes(_S_2_ADM_USED_SCRIPT),'','',_S_2_ADM_USED_SCRIPT, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'usedScript', 'class="inputbox"', $this->usedScript ); ?></td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_POPUP_EXPL),addslashes(_SGADM_GEN_POPUP),'','',_SGADM_GEN_POPUP, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'imagePopup', 'class="inputbox"', $this->imagePopup ); ?></td>
    </tr>

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_NOIMAGE_EXPL),addslashes(_SGADM_GEN_NOIMAGE),'','',_SGADM_GEN_NOIMAGE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'showNoImage', 'class="inputbox"', $this->showNoImage ); ?></td>
    </tr>

   <tr class="row1">
      <td valign="top" width="20%"><?php echo _S_2_ADM_INFO_TITLE ?></td>
      <td valign="top" width="80%"><?php echo _S_2_ADM_INFO._S_2_ADM_INFODV ?></td>
    </tr>
	</table>


	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 100%;"><?php echo _S_2_ADM_CONFIG_HEADER._S_2_ADM_CONFIG_HEADER_S; ?></th>
		</tr>
	</table>

	<table class="SobiAdminForm" width="100%">

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_IMG_SIZE_EXPL),addslashes(_S_2_ADM_IMG_SIZE),'','',_S_2_ADM_IMG_SIZE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%">
      	<?php echo _S_2_ADM_IMG_W; ?>:&nbsp;<input type="text" title="<?php echo _S_2_ADM_IMG_W; ?>" class="text_area" style="text-align:center;" name="imgW" value="<?php echo $this->imgW ?>" size="5" maxlength="15"/> &nbsp; px &nbsp; x  &nbsp;
      	<?php echo _S_2_ADM_IMG_H; ?>:&nbsp;<input type="text" title="<?php echo _S_2_ADM_IMG_H; ?>" class="text_area" style="text-align:center;" name="imgH" value="<?php echo $this->imgH ?>" size="5" maxlength="15"/> &nbsp; px
      </td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_IMG_RESIZE_EXPL),addslashes(_S_2_ADM_IMG_RESIZE),'','',_S_2_ADM_IMG_RESIZE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'alwaysResizeImages', 'class="inputbox"', $this->alwaysResizeImages ); ?></td>
    </tr>

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_THM_SIZE_EXPL),addslashes(_S_2_ADM_THM_SIZE),'','',_S_2_ADM_THM_SIZE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%">
      	<?php echo _S_2_ADM_IMG_W; ?>:&nbsp;<input type="text" title="<?php echo _S_2_ADM_IMG_W; ?>" class="text_area" style="text-align:center;" name="thmW" value="<?php echo $this->thmW ?>" size="5" maxlength="15"/> &nbsp; px &nbsp; x  &nbsp;
      	<?php echo _S_2_ADM_IMG_H; ?>:&nbsp;<input type="text" title="<?php echo _S_2_ADM_IMG_H; ?>" class="text_area" style="text-align:center;" name="thmH" value="<?php echo $this->thmH ?>" size="5" maxlength="15"/> &nbsp; px
      </td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_THM_RESIZE_EXPL),addslashes(_S_2_ADM_THM_RESIZE),'','',_S_2_ADM_THM_RESIZE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'alwaysResizeThumb', 'class="inputbox"', $this->alwaysResizeThumb ); ?></td>
    </tr>

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_FILE_SIZE_EXPL),addslashes(_S_2_ADM_FILE_SIZE),'','',_S_2_ADM_FILE_SIZE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%">
      	<input type="text" class="text_area" style="text-align:center;" name="sobi_gallery_fileSize" value="<?php echo $this->sobi_gallery_fileSize ?>" size="10" maxlength="50"/> &nbsp; Kb
      </td>
    </tr>
	</table>


	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 100%;"><?php echo _S_2_ADM_CONFIG_HEADER._S_2_ADM_CONFIG_HEADER_V; ?></th>
		</tr>
	</table>

	<table class="SobiAdminForm" width="100%">

    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_COUNT_IN_LIST_EXPL),addslashes(_S_2_ADM_COUNT_IN_LIST),'','',_S_2_ADM_COUNT_IN_LIST, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'countInListing', 'class="inputbox"', $this->countInListing ); ?></td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_SHOWFIRSTT_EXPL),addslashes(_SGADM_GEN_SHOWFIRSTT),'','',_SGADM_GEN_SHOWFIRSTT, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'showFirstThumb', 'class="inputbox"', $this->showFirstThumb ); ?></td>
    </tr>

   <tr class="row0">
      <td valign="top" width="20%"><?php echo _S_2_ADM_INFO_TITLE ?></td>
      <td valign="top" width="80%"><?php echo _S_2_ADM_INFO._S_2_ADM_INFOVCARD ?></td>
    </tr>
	</table>


	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 100%;"><?php echo _S_2_ADM_CONFIG_HEADER._S_2_ADM_CONFIG_HEADER_A; ?></th>
		</tr>
	</table>

	<table class="SobiAdminForm" width="100%">
	
    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_S_2_ADM_IFRAME_H_EXPL),addslashes(_S_2_ADM_IFRAME_H),'','',_S_2_ADM_IFRAME_H, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%">
      	<input type="text" class="text_area" style="text-align:center;" name="iframeH" value="<?php echo $this->iframeH ?>" size="5" maxlength="8"/> &nbsp; px
      </td>
    </tr>
	
	<tr class="row1">
		<td width="20%">
	      	<span class="editlinktip">
	      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_GEN_POS_EXPL),addslashes(_SGADM_GEN_POS),'','',_SGADM_GEN_POS, '#',0 );?>
	      	</span>
		</td>
		<td width="80%">
			<input type="text" class="text_area" style="text-align:center;" name="fPos" value="<?php echo $this->fPos ?>" size="5" maxlength="5"/>
		</td>
	</tr>

	</table>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 100%;"><?php echo _S_2_ADM_CONFIG_HEADER._S_2_ADM_CONFIG_HEADER_F; ?></th>
		</tr>
	</table>

	<table class="SobiAdminForm" width="100%">
	
    <tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_FEE_EXPL),addslashes(_SGADM_ADM_FEE),'','',_SGADM_ADM_FEE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%">
		<input type="text" class="text_area" style="text-align:center;" name="imagefee" value="<?php echo $this->imagefee ?>" size="10" maxlength="10"/>
		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_PER_ITEMS_EXPL),addslashes(_SGADM_ADM_PER_ITEMS),'','',_SGADM_ADM_PER_ITEMS, '#',0 );?>
		<input type="text" class="text_area" style="text-align:center;" name="perimages" value="<?php echo $this->perimages ?>" size="5" maxlength="5"/>
		<?php echo _SGADM_ADM_PER_ITEMS_END; ?>
	  </td>
    </tr>

    <tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_FREE_IMAGES_EXPL),addslashes(_SGADM_ADM_FREE_IMAGES),'','',_SGADM_ADM_FREE_IMAGES, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="freeImages" value="<?php echo $this->freeImages ?>" size="5" maxlength="5"/></td>
    </tr>

	<tr class="row0">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_FEE_DISCOUNT_EXPL),addslashes(_SGADM_ADM_FEE_DISCOUNT),'','',_SGADM_ADM_FEE_DISCOUNT, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="feeDiscount" value="<?php echo $this->feeDiscount ?>" size="6" maxlength="6"/></td>
    </tr>

	<tr class="row1">
      <td valign="top" width="20%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SGADM_ADM_MAX_DISCOUNT_EXPL),addslashes(_SGADM_ADM_MAX_DISCOUNT),'','',_SGADM_ADM_MAX_DISCOUNT, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="maxDiscount" value="<?php echo $this->maxDiscount ?>" size="6" maxlength="6"/></td>
    </tr>
	
	</table>
	<br /><br /><br /><br /><br /><br />
    <?php
    }
/*
 *
 * ************************************************************
 * free definied methods
 * ************************************************************
 */
    function sobi_gallery_adm() {
    	$this->sobi_gallery(true);
    }
	function addEditEntryTab( $sid, $tabs)
	{
		$tabs->startTab($this->name,"galltab");
    	echo "<div style='text-align:left;'>";
    	$config =& sobi2Config::getInstance();
		@session_name('_SG_2_VALID');
		@session_start();
		$ssid = session_id();
    	$sobi_gallery_id = time() + rand(0,10000);
		$adminuser =& $config->getUser();
    	$href = "{$config->liveSite}/administrator/index3.php?option=com_sobi2&amp;sobi2Task=admingalleryForm&amp;sobi2Id={$sid}&amp;sobi_gallery_id={$sobi_gallery_id}&amp;sgssid={$ssid}";
    	$form = "<iframe width=\"100%\" height=\"{$this->iframeH}\" frameborder=\"0\" id=\"formIframe\" src=\"{$href}\"></iframe>";
    	$form .= "<input type='hidden' name='sobi_gallery_id' id='sobi_gallery_id' value='{$sobi_gallery_id}'/>";
    	echo $form;
    	echo "</div>";
		$tabs->endTab();
	}
	/**
	 * @param array $fields
	 * @param int $sobiId
	 */
	function editFormStart( $sobiId, &$fields )
	{
		return null;
	}
	/**
	 * @param array $fields
	 * @param int $sobiId
	 */
	function editForm( $sobiId )
	{
		return null;
	}
	
	function adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid) {
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
		$action = "{$config->liveSite}/administrator/index3.php?option=com_sobi2&amp;sobi2Task=uploadGfile&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
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
				$delHref = "{$config->liveSite}/administrator/index3.php?option=com_sobi2&amp;sobi2Task=delGalleryImgForm&amp;sobi_gallery_id={$sobi_gallery_id}&amp;imgName={$fname}&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
				$modHref = "{$config->liveSite}/administrator/index3.php?option=com_sobi2&amp;sobi2Task=modGalleryImgForm&amp;sobi_gallery_id={$sobi_gallery_id}&amp;imgName={$fname}&amp;sobi2Id={$sobi2Id}&amp;sgssid={$sgssid}";
				?>
				<div class="sobi_gallery_GimageBox" style="<?php echo $style; ?>">
					<div class="sobi_gallery_GdelBox"><!--  style="padding-top: <?php echo $delpos; ?>px;" -->
					<a href="<?php echo $delHref; ?>" onclick="sobi_gallery_loadImage();">
						<img src="<?php echo $config->liveSite; ?>/components/com_sobi2/plugins/gallery/images/delete.png" alt="<?php echo $delT ?>" title="<?php echo $delT ?>" height="16" width="16" />
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
		<script language="JavaScript" type="text/javascript">
			function sobi_gallery_loadImage() {
				document.getElementById("sobi_gallery_loader").innerHTML = "<img src='./components/com_sobi2/plugins/gallery/images/loading.gif' >";
			}
		</script>

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
		<script language="JavaScript" type="text/javascript">
			function sobi_gallery_loadImage() {
				document.getElementById("sobi_gallery_loader").innerHTML = "<img src='./components/com_sobi2/plugins/gallery/images/loading.gif' >";
			}
		</script>

		<?php
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
   		$this->adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid);
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
	   			$this->adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid);
	   			return false;
	   		}

	   		/* check extension */
	   		$fileExt = strtolower(substr( $file['name'], -3 ));
	   		$allowedFile = false;
			foreach( $this->allowableFilesExt as $allowableExt )
				if (strcasecmp( $fileExt, $allowableExt ) == 0)
					$allowedFile = true;
	   		if(!$allowedFile) {
	   			echo "<div class='message'>"._S_2_GALLERY_ERR_EXT."</div>";
	   			$this->adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid);
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
	   		$imageName = "{$folderId}_image_{$filePos}.{$fileExt}";
	   		$thumbName = "{$folderId}_thumb_{$filePos}.{$fileExt}";


			if(sobi2Config::translatePath("{$savePath}|{$imageName}", null, true, null)) {
		   		$tempArray = array ('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','t','t','t' );
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
   			$this->adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid);
   		}
   		return true;
   }
   
   function updateGalleryImageInfo($sobi2Id,$sobi_gallery_id,$file,$sgssid) {
		$config =& sobi2Config::getInstance();
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
		$this->adminformIframe($sobi2Id, $sobi_gallery_id,$sgssid);
    }
   
      function modifyImageFromForm($sobi2Id,$sobi_gallery_id,$file,$sgssid) {
		$config =& sobi2Config::getInstance();
		$database =& $config->getDb();
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
			foreach($Gimages as $Gimage){
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

   
/* End of Class */
}
?>