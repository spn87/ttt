<?php
/**
* @version $Id: gallery_init.php 3003 2009-12-18 13:15:34Z Sigrid Suski $
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
	if(defined("_SOBI_FE_PATH")) {
		$config =& sobi2Config::getInstance();
		if(sobi2Config::import("plugins|gallery|gallery.class")) {
			if(!sobi2Config::import("plugins|gallery|{$config->sobi2Language}", "front", false, false)) {
				sobi2Config::import("plugins|gallery|english", "front", true, false);
			}
			$config->S2_plugins[$plugin->name_id] = new sobi_gallery();
		}
		else {
			trigger_error("Cannot import class definition files for the Gallery Plugin", E_USER_WARNING);
		}
	}
?>
