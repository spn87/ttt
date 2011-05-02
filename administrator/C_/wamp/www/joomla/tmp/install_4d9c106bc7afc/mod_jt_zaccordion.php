<?php 
/*
# ------------------------------------------------------------------------
# Templates for Joomla 1.5 / Joomla 1.6
# ------------------------------------------------------------------------
# Copyright (C) 2011 Jtemplate.ru. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: JTemplate.ru
# Websites:  http://www.jtemplate.ru 
# ---------  http://code.google.com/p/jtemplate/   
# ------------------------------------------------------------------------
*/
// no direct access
defined('_JEXEC') or die;
	$document =& JFactory::getDocument();
	$document->addScript(JURI::base() . 'modules/mod_jt_zaccordion/js/jquery-1.4.2.min.js');
	$document->addScript(JURI::base() . 'modules/mod_jt_zaccordion/js/jquery.easing.1.3.js');
	$document->addScript(JURI::base() . 'modules/mod_jt_zaccordion/js/jquery.zaccordion.min.js');
//width-height	all img
	$width					= $params->get('width');
	$height					= $params->get('height');
// img parameters	
	$img1 				= $params->get('img1');
	$img2 				= $params->get('img2');
	$img3 				= $params->get('img3');
	$img4 				= $params->get('img4');
	$img5 				= $params->get('img5');
	$img6 				= $params->get('img6');
	$img7 				= $params->get('img7');
	$img8 				= $params->get('img8');
	$img9 				= $params->get('img9');
	$img10 				= $params->get('img10');
// alt parameters	
	$alt1				= $params->get('alt1');
	$alt2				= $params->get('alt2');
	$alt3				= $params->get('alt3');
	$alt4				= $params->get('alt4');
	$alt5				= $params->get('alt5');
	$alt6				= $params->get('alt6');
	$alt7				= $params->get('alt7');
	$alt8				= $params->get('alt8');
	$alt9				= $params->get('alt9');
	$alt10				= $params->get('alt10');
// array
$img = array($img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $img9, $img10);
$alt = array($alt1, $alt2, $alt3, $alt4, $alt5, $alt6, $alt7, $alt8, $alt9, $alt10);
$arrayimg = array();
$arrayalt = array();
// body
	echo '<div id="mod-jt-zaccordion">';
	echo '<ul id="jt-zaccordion">';
	
	for($n=0;$n < count($img);$n++)
     {
     $arrayimg[$img[$n]]= htmlspecialchars($alt[$n]);
	 $arrayalt[$alt[$n]]=$img[$n];
	 	 if(($arrayimg[$img[$n]]) != '') 
		 {
		 	echo '<li><img src="'. $arrayalt[$alt[$n]] .' "width="'. $width. '" height="'. $height. '" alt="'. $arrayimg[$img[$n]]. '"/></li>';
		 }
	 }
	echo '</ul>';
	echo '</div><div class="clr"></div>'; 
?>
<script type="text/javascript">
    $(document).ready(function() {
    $("#jt-zaccordion").zAccordion({
    easing: "easeOutBounce",
    timeout: 5500,
    slideWidth: 600,
    width: 960,
    height: 310
	});
});
</script>