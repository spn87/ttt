<?php
/**
* @version $Id: install.php 3002 2007-12-23 16:33:34Z Sigrid Suski $
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
/*
 * $backendPath
 */
	defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
	if(defined("_SOBI_ADM_PATH")) {
		$config =& adminConfig::getInstance();
		$installPath = adminConfig::translatePath("includes|install|gallery", "adm", false, null);
		$config->sobiMakePath(adminConfig::translatePath("images|com_sobi2|gallery", "root", false, null));
		$config->sobiMakePath($frontPath.DS."images");
		$imgPath = $frontPath.DS."images";
		@copy($installPath.DS."close.gif", $imgPath.DS."close.gif");
		@copy($installPath.DS."delete.png", $imgPath.DS."delete.png");
		@copy($installPath.DS."loading.gif", $imgPath.DS."loading.gif");
		@copy($installPath.DS."next.gif", $imgPath.DS."next.gif");
		@copy($installPath.DS."prev.gif", $imgPath.DS."prev.gif");
	}
	else {
		$url = "index2.php?option=com_sobi2&task=pluginsManager&mosmsg=".urlencode("The Gallery plugin requires at least SOBI2 RC 2.8.0. Please uninstall this plugin and update your SOBI2 version");
		@ob_end_clean();
		header( 'HTTP/1.1 301 Moved Permanently' );
		header( "Location: ". $url );
		exit();
	}
?>