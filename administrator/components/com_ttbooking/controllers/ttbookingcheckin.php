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


}