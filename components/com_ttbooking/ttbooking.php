<?php

defined('_JEXEC') or die('Restricted access');

require_once (JPATH_COMPONENT.DS.'controller.php');

$controllerName = JRequest::getWord('controller');

switch ($controllerName) 
{
	case"ttbooking":
		JSubMenuHelper::addEntry(JText::_('Booking'), 'index.php?option=com_ttbooking&controller=ttbooking&task=view', true );
		JSubMenuHelper::addEntry(JText::_('Check In'), 'index.php?option=com_ttbooking&controller=ttbookingcheckin&task=view');
		JSubMenuHelper::addEntry(JText::_('Check Out'), 'index.php?option=com_ttbooking&controller=ttbookingcheckout&task=view');
		break;
		
	case"ttbookingcheckin":
		JSubMenuHelper::addEntry(JText::_('Booking'), 'index.php?option=com_ttbooking&controller=ttbooking&task=view' );
		JSubMenuHelper::addEntry(JText::_('Check In'), 'index.php?option=com_ttbooking&controller=ttbookingcheckin&task=view',true);
		JSubMenuHelper::addEntry(JText::_('Check Out'), 'index.php?option=com_ttbooking&controller=ttbookingcheckout&task=view');
	break;
	
	case"ttbookingcheckout":
		JSubMenuHelper::addEntry(JText::_('Booking'), 'index.php?option=com_ttbooking&controller=ttbooking&task=view' );
		JSubMenuHelper::addEntry(JText::_('Check In'), 'index.php?option=com_ttbooking&controller=ttbookingcheckin&task=view');
		JSubMenuHelper::addEntry(JText::_('Check Out'), 'index.php?option=com_ttbooking&controller=ttbookingcheckout&task=view',true);
	break;
	
	default :
		JSubMenuHelper::addEntry(JText::_('Booking'), 'index.php?option=com_ttbooking&controller=ttbooking&task=view', true );
		JSubMenuHelper::addEntry(JText::_('Check In'), 'index.php?option=com_ttbooking&controller=ttbookingcheckin&task=view');
		JSubMenuHelper::addEntry(JText::_('Check Out'), 'index.php?option=com_ttbooking&controller=ttbookingcheckout&task=view');
}



// Require specific controller if requested
if (!($controllerName = JRequest::getWord('controller')))
    {$controllerName = 'ttbooking';};


if($controllerName)
    {
        $path = JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php';
		
        if( file_exists($path))
            {
                require_once $path;
            } else
            {
                $controllerName = '';
            }
    }
$classname = 'ttbookingsController'.$controllerName;
// Create the controller
$controllerName = new $classname();

// Perform the Request task
if (!(JRequest::getVar('task'))) {
    $task = 'view';
}else{
    $task = JRequest::getVar('task');
};

$controllerName->execute( $task );

// Redirect if set by the controller
$controllerName->redirect();


?>
