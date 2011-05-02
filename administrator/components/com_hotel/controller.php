<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport("joomla.application.component.controller");

class HotelController extends JController
{
	public function index()
	{
		$view = &$this->getView();
		$view->index();
	}
	
	public function add()
	{
		$id = JRequest::getCmd("id",null);
		$model = $this->getModel();	

		$data = $model->getHotel($id);
		$view = &$this->getView();
		$view->add($model->getHotelGroup(),$data);
	}
	
	public function update()
	{
		
	}
}

?>