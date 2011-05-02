<?php
/**
 * Joom!Fish - Multi Lingual extention and translation manager for Joomla!
 * Copyright (C) 2003-2007 Think Network GmbH, Munich
 *
 * All rights reserved.  The Joom!Fish project is a set of extentions for
 * the content management system Joomla!. It enables Joomla!
 * to manage multi lingual sites especially in all dynamic information
 * which are stored in the database.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * -----------------------------------------------------------------------------
 * $Id: joomfish.sql 567 2007-07-17 05:53:43Z akede $
 *
 * Based on:
 * Content Table ETL
 * 
 * This plugin handles ETL for the Content Component 
 * 
 * PHP4
 *  
 * Created on May 22, 2007
 * 
 * @package JMigrator
 * @author Sam Moffatt <S.Moffatt@toowoomba.qld.gov.au>
 * @author Toowoomba City Council Information Management Department
 * @license GNU/GPL http://www.gnu.org/licenses/gpl.html
 * @copyright 2007 Toowoomba City Council/Developer Name 
 * @see JoomlaCode Project: http://joomlacode.org/gf/project/pasamioproject
 */

/**
 * Joom!Fish Content table
 */
class JF_Content_ETL extends ETLPlugin {
	
	var $ignorefieldlist = Array();
	var $valuesmap = Array('value');
	function getName() { return "Joom!Fish Content ETL Plugin"; }	
	function getAssociatedTable() { return 'jf_content'; }
	
	function mapvalues($key,$value) {

		switch($key) {
			case 'value':
				//---------------------------------------------------
				// mospagebreak
				// Replace {mospagebreak} -> <hr class="system-pagebreak" />
				$value = str_replace('{mospagebreak}','<hr class="system-pagebreak" />',$value);
				// Replace {mospagebreak title=The page title} -> <hr class="system-pagebreak" title="The page title" />
				$value = preg_replace('/{mospagebreak title=([A-Za-z0-9 ]*)}/','<hr class="system-pagebreak" title="\1" />', $value);
				// Replace {mospagebreak heading=The first page} -> <hr class="system-pagebreak" alt="The first page" />
				$value = preg_replace('/{mospagebreak heading=([A-Za-z0-9 ]*)}/','<hr class="system-pagebreak" alt="\1" />', $value);
				// Replace {mospagebreak title=The page title&heading=The first page} -> <hr class="system-pagebreak" title="The page title" alt="The first page" />
				$value = preg_replace('/{mospagebreak title=([A-Za-z0-9 ]*)&heading=([A-Za-z0-9 ]*)}/', '<hr class="system-pagebreak" title="\1" alt="\2" />', $value);
				// Replace {mospagebreak heading=The first page&title=The page title} -> <hr class="system-pagebreak" title="The page title" alt="The first page" />
				$value = preg_replace('/{mospagebreak heading=([A-Za-z0-9 ]*)&title=([A-Za-z0-9 ]*)}/', '<hr class="system-pagebreak" title="\2" alt="\1" />', $value);
				
				//---------------------------------------------------
				// mosloadposition
				$value = str_replace('{mosloadposition', '{loadposition',$value);
				
				//---------------------------------------------------
				// mosimage
				$value = handleMosImage($key, $value, $this);
				
				//---------------------------------------------------
				// moscode; turn it into geshi (not really appropriate but best match)
				$value = str_replace('{moscode}','<pre>', $value);
				$value = str_replace('{/moscode}','</pre>', $value);
				
				
				//---------------------------------------------------
				// Done, return result
				return $value;
				break;
			default:
				return $value;
				break;
		}
	}

}

if( !function_exists('handleMosImage') ) {
/**
 * Handle mosimage replacements...fun!
 * @param string key If its introtext or fulltext
 * @param string value The stuff we're replacing
 * @param ETLPlugin etlplugin An object of class or subclass of ETL Plugin
 * @return string result of $value being processed
 */
function handleMosImage($key, $value, $etlplugin) {
	global $database, $_MAMBOTS;
	if(!isset($_MAMBOTS)) {
		$_MAMBOTS = new stdClass();
	}
	
	if(strpos($value, 'mosimage') === false) {
		return $value;
	}
	$params = new mosParameters($etlplugin->_currentRecord['attribs']);
	
	// set up compat layer
	$row = new stdClass();
	$row->introtext = $etlplugin->_currentRecord['introtext'];
	$row->fulltext = $etlplugin->_currentRecord['fulltext'];
	$row->text = $row->introtext. chr(13) . chr(13) . $row->fulltext;
	$row->images = $etlplugin->_currentRecord['images'];

 	// expression to search for
	$regex = '/{mosimage\s*.*?}/i';
	
	//count how many {mosimage} are in introtext if we're on fulltext
	$introCount=0;
	//count how many {mosimage} are in introtext if we're on fulltext
	if($key == 'fulltext') {	
		preg_match_all( $regex, $row->introtext, $matches );
		$introCount = count ( $matches[0] );
	}
	
	// find all instances of mambot and put in $matches
	preg_match_all( $regex, $row->text, $matches );

 	// Number of mambots
	$count = count( $matches[0] );
 	// mambot only processes if there are any instances of the mambot in the text
 	if ( $count ) {
		// check if param query has previously been processed
		// ^^ i think this is probably a certainty
		if ( !isset($_MAMBOTS->_content_mambot_params['mosimage']) ) {
			// load mambot params info
			$query = "SELECT params"
			. "\n FROM #__mambots"
			. "\n WHERE element = 'mosimage'"
			. "\n AND folder = 'content'"
			;
			$database->setQuery( $query );
			$mambot = null;
			$database->loadObject($mambot);
			
			// save query to class variable
			$_MAMBOTS->_content_mambot_params['mosimage'] = $mambot;
		}

		// pull query data from class variable
		$mambot = $_MAMBOTS->_content_mambot_params['mosimage'];
		
	 	$botParams = new mosParameters( $mambot->params );

	 	$botParams->def( 'padding' );
	 	$botParams->def( 'margin' );
	 	$botParams->def( 'link', 0 );

		$images 	= processImages( $row, $botParams, $introCount );

		// store some vars in globals to access from the replacer
		$GLOBALS['botMosImageCount'] 	= 0;
		$GLOBALS['botMosImageParams'] 	=& $botParams;
		$GLOBALS['botMosImageArray'] 	=& $images;
		//$GLOBALS['botMosImageArray'] 	=& $combine;
		
		// perform the replacement
		//$row->text = preg_replace_callback( $regex, 'botMosImage_replacer', $row->text );
		$value = preg_replace_callback($regex, 'botMosImage_replacer', $value);
		
		// clean up globals
		unset( $GLOBALS['botMosImageCount'] );
		unset( $GLOBALS['botMosImageMask'] );
		unset( $GLOBALS['botMosImageArray'] );
		unset( $GLOBALS['botJosIntroCount'] );
	}	
	return $value;

}

function processImages ( &$row, &$params, &$introCount ) {
	global $mosConfig_absolute_path, $mosConfig_live_site;

	$images 		= array();

	// split on \n the images fields into an array
	$row->images 	= explode( "\n", $row->images );
	$total 			= count( $row->images );

	$start = $introCount; 
	for ( $i = $start; $i < $total; $i++ ) {
		$img = trim( $row->images[$i] );

		// split on pipe the attributes of the image
		if ( $img ) {
			$attrib = explode( '|', trim( $img ) );
			// $attrib[0] image name and path from /images/stories

			// $attrib[1] alignment
			if ( !isset($attrib[1]) || !$attrib[1] ) {
				$attrib[1] = '';
			}

			// $attrib[2] alt & title
			if ( !isset($attrib[2]) || !$attrib[2] ) {
				$attrib[2] = 'Image';
			} else {
				$attrib[2] = htmlspecialchars( $attrib[2] );
			}

			// $attrib[3] border
			if ( !isset($attrib[3]) || !$attrib[3] ) {
				$attrib[3] = 0;
			}

			// $attrib[4] caption
			if ( !isset($attrib[4]) || !$attrib[4] ) {
				$attrib[4]	= '';
				$border 	= $attrib[3];
			} else {
				$border 	= 0;
			}

			// $attrib[5] caption position
			if ( !isset($attrib[5]) || !$attrib[5] ) {
				$attrib[5] = '';
			}

			// $attrib[6] caption alignment
			if ( !isset($attrib[6]) || !$attrib[6] ) {
				$attrib[6] = '';
			}

			// $attrib[7] width
			if ( !isset($attrib[7]) || !$attrib[7] ) {
				$attrib[7] 	= '';
				$width 		= '';
			} else {
				$width 		= ' width: '. $attrib[7] .'px;';
			}

			// image size attibutes
			$size = '';
			if ( function_exists( 'getimagesize' ) ) {
				$size 	= @getimagesize( $mosConfig_absolute_path .'/images/stories/'. $attrib[0] );
				if (is_array( $size )) {
					$size = ' width="'. $size[0] .'" height="'. $size[1] .'"';
				}
			}

			// assemble the <image> tag
			$image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $attrib[0] .'"'. $size;
			// no aligment variable - if caption detected
			if ( !$attrib[4] ) {
				if ($attrib[1] == 'left' OR $attrib[1] == 'right') {
					$image .= ' style="float: '. $attrib[1] .';"';
				} else {
					$image .= $attrib[1] ? ' align="middle"' : '';
				}
			}
			$image .=' hspace="6" alt="'. $attrib[2] .'" title="'. $attrib[2] .'" border="'. $border .'" />';

			// assemble caption - if caption detected
			$caption = '';
			if ( $attrib[4] ) {				
				$caption = '<div class="mosimage_caption"';
				if ( $attrib[6] ) {
					$caption .= ' style="text-align: '. $attrib[6] .';"';
					$caption .= ' align="'. $attrib[6] .'"';
				}
				$caption .= '>';
				$caption .= $attrib[4];
				$caption .= '</div>';
			}
			
			// final output
			if ( $attrib[4] ) {
				// initialize variables
				$margin  		= '';
				$padding 		= '';
				$float			= '';
				$border_width 	= '';
				$style			= '';
				if ( $params->def( 'margin' ) ) {
					$margin 		= ' margin: '. $params->def( 'margin' ).'px;';
				}				
				if ( $params->def( 'padding' ) ) {
					$padding 		= ' padding: '. $params->def( 'padding' ).'px;';
				}				
				if ( $attrib[1] ) {
					$float 			= ' float: '. $attrib[1] .';';
				}
				if ( $attrib[3] ) {
					$border_width	= ' border-width: '. $attrib[3] .'px;';
				}
				
				if ( $params->def( 'margin' ) || $params->def( 'padding' ) || $attrib[1] || $attrib[3] ) {
					$style = ' style="'. $border_width . $float . $margin . $padding . $width .'"';
				}
				
				$img = '<div class="mosimage" '. $style .' align="center">'; 

				// display caption in top position
				if ( $attrib[5] == 'top' && $caption ) {
					$img .= $caption;
				}

				$img .= $image;

				// display caption in bottom position
				if ( $attrib[5] == 'bottom' && $caption ) {
					$img .= $caption;
				}
				$img .='</div>';
			} else {
				$img = $image;
			}

			$images[] = $img;
		}
	}

	return $images;
}

/**
* Replaces the matched tags an image
* @param array An array of matches (see preg_match_all)
* @return string
*/
function botMosImage_replacer( &$matches ) {
	$i = $GLOBALS['botMosImageCount']++;
	return @$GLOBALS['botMosImageArray'][$i];
}

} /** end of if (!function_exists ... */
?>