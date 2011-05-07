<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
class ttbookingsControllerttbookingcheckin extends ttbookingsController
{

	function __construct()
	{
		parent::__construct();
		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}

	function edit()
	{
		JRequest::setVar( 'view', 'ttbookingcheckin' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);
		parent::display();
	}
	
	function show()
	{
		echo "<h1>hellllllllllllllllll</h1>";
	}
	
	function remove()
	{
		$model = $this->getModel('ttbookingcheckins');
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
		$this->setRedirect( 'index.php?option=com_ttbooking&controller=ttbookingcheckins&task=view', $msg );
	}
	

}