<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

class ttbookingsViewttbookings extends JView
{
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'Booking checkin' ), 'generic.png' );

		$this->assignRef('items',"check int");

		parent::display($tpl);
	}
}