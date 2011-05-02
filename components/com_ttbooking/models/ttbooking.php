<?php

defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );


class ttbookingModelttbooking extends JModel
{
	function getttbooking()
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT * FROM jos_ttbooking';
		$db->setQuery( $query );
		$Data_ttbooking = $db->loadResult();

		return $Data_ttbooking;
	}
}
