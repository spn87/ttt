<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
class ttbookingsControllerttbooking extends ttbookingsController
{

	function __construct()
	{
		parent::__construct();
		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}


	function edit()
	{
		JRequest::setVar( 'view', 'ttbooking' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}


	function save()
	{
		$model = $this->getModel('ttbooking');

		if ($model->store($post)) {
			$msg = JText::_( 'Booking Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Booking' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_ttbooking';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		$model = $this->getModel('ttbooking');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Booking Could not be Deleted' );
		} else {
			$msg = JText::_( 'Booking (s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_ttbooking', $msg );
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_ttbooking', $msg );
	}
}