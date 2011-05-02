<?php
/**
 * The Piecemaker
 * This program is free software: you can redistribute it and/or modify it under the terms
 * of the GNU General Public License as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *@author Neerav Dobaria
 *@copyright (C) 2011 Neerav
 *@link http://www.vareen.com/ Official website
**/
defined('_JEXEC') or die('Restricted access!');
global $mainframe;
jimport('joomla.filesystem.file');
$realw = JURI::root();

$document = &JFactory::getDocument();
$jsurl = $realw . "modules/mod_the_piecemaker/js/swfobject.js";
$swfurl = $realw . "modules/mod_the_piecemaker/js/expressInstall.swf";

$document->addScript($jsurl);

$xmlfile = JPATH_BASE . "/modules/mod_the_piecemaker/banner/xml/piecemakerXML".$module->id.".xml";

$width = $params->get("width");
$height = $params->get("height");

$shadow = $params->get('shadow');
$swf = ($shadow)?'piecemakerShadow.swf':'piecemakerNoShadow.swf';

if( $params->get('rebuildcache') or !file_exists($xmlfile) ) :

//params
$segments = $params->get("segments");
$tweenTime = $params->get("tweenTime");
$tweenDelay = $params->get("tweenDelay");
$tweenType = $params->get("tweenType");
$zDistance = $params->get("zDistance");
$expand = $params->get("expand");
$innerColor = str_replace('#','',$params->get("innerColor"));
$textBackground = str_replace('#','',$params->get("textBackground"));
$shadowDarkness = $params->get("shadowDarkness");
$textDistance = $params->get("textDistance");
$autoplay = $params->get("autoplay");

$playlist = <<<EOP
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>
  <Settings>
    <imageWidth>$width</imageWidth>
    <imageHeight>$height</imageHeight>
    <segments>$segments</segments>
    <tweenTime>$tweenTime</tweenTime>
    <tweenDelay>$tweenDelay</tweenDelay>
    <tweenType>$tweenType</tweenType>
    <zDistance>$zDistance</zDistance>
    <expand>$expand</expand>
    <innerColor>0x$innerColor</innerColor>
    <textBackground>0x$textBackground</textBackground>
    <shadowDarkness>$shadowDarkness</shadowDarkness>
    <textDistance>$textDistance</textDistance>
    <autoplay>$autoplay</autoplay>
  </Settings>

EOP;

$image = explode(CHR(10),trim($params->get('image')));
$description = explode(CHR(10),trim($params->get('description')));

$count = count($image);

for( $i = 0 ; $i < $count ; $i++ )
{
$image[$i] = str_replace($realw, '', trim($image[$i]));
$playlist .= <<<EOQ
  <Image Filename="$image[$i]">
    <Text>
    	$description[$i]
    </Text>
  </Image>

EOQ;
}
$playlist .= '</Piecemaker>';

$compat = '';
if (!@JFile::write($xmlfile, $playlist))
{
    printf('<div style="background-color: red;">
<center><span style="font-size: small; color: white;"><strong>Unable to create <span STYLE="color: yellow">
' . str_replace(JPATH_BASE, "", $xmlfile) . '</span> configuration file. <br/>
Please check your permissions!</strong></div>');
}
endif;
?>
<?php ob_start();?>
	var flashvars = {};
	flashvars.xmlSource = "<?php echo $realw; ?>/modules/mod_the_piecemaker/banner/xml/piecemakerXML<?php echo $module->id;?>.xml";
	flashvars.cssSource = "<?php echo $realw; ?>/modules/mod_the_piecemaker/banner/xml/piecemakerCSS.css";
	flashvars.imageSource = "<?php echo $realw; ?>";
	var attributes = {};
	attributes.wmode = "transparent";
	swfobject.embedSWF("<?php echo $realw; ?>/modules/mod_the_piecemaker/<?php echo $swf;?>", "flashcontent<?php echo $module->id; ?>", "<?php echo $width + 150; ?>", "<?php echo $height + 150; ?>", "10", "<?php echo $swfurl; ?>", flashvars, attributes);
<?php $script = '<script type="text/javascript">'.ob_get_clean().'</script>'; ?>
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
    <td align="center">        
        <!-- this div will be overwritten by SWF object -->		
        <div id="flashcontent<?php echo $module->id;?>">
            <p>In order to view this object you need Flash Player 9+ support!</p>
            <a href="http://www.adobe.com/go/getflashplayer">
                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
            </a>
        </div>    
    </td>
</table>
<?php echo $script; ?>