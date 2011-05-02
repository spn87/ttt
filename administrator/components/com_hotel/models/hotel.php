<?php

jimport("joomla.application.component.model");

class HotelModelHotel extends JModel
{
	public function getHotelGroup()
	{
		$this->_db->setQuery("select * from #__hotel_group");
		
		$r = $this->_db->loadObjectList();
		
		return $r;
	}
	
	public function getHotel($id=null)
	{
		$data = array();
		if ($id ==null)
		{
			$data["name"] = 'fdafd';
			$data["max_rate"] = 0;
			$data["min_rate"] = 0;
			$data["star"] = 10;
			$data["description"] = "";
			$data["checkout"] = $data["checkin"] =  $data["built"] = "";
			$data["floor_num"] = $data["rest_num"] = $data["room_num"] = 0;
			$data["parking_service"] =  $data["s24"] = "yes";
			$data["room_volt"] = "220";
			
			
		}else
		{
			$data["name"] = "loading";
		}
		
		return $data;
	}
}

?>