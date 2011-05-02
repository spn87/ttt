<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport("joomla.application.component.view");

class HotelViewHotel extends JView
{
	public function display($tpl = null)
	{
        parent::display($tpl);
	}
	
	public function index()
	{
		
	}

	public function add($hotelGroup,$data)
	{
		$hotelGroupOpt = "";
		foreach ($hotelGroup as $g)
		{
			$hotelGroupOpt .= "<option value=''>".$g->name."</option>";
		}
		?>
		<form class="adminForm">
			<table class="adminlist">
				<tr>
					<td>Province</td>
					<td>
						<select><?php echo $hotelGroupOpt;?></select>
					</td>
				</tr>
				<tr>
					<td>Hotel Name</td>
					<td><input type="text" value=<?php echo $data["name"];?> name="name" /></td>
				</tr>
				<tr>
					<td>Minimum rate</td>
					<td><input type="text" value="<?php echo $data["min_rate"];?>" name="min_rate"/></td>
				</tr>
				<tr>
					<td>Maximum rate</td>
					<td><input type="text" value="<?php echo $data["max_rate"];?>" name="max_rate"/></td>
				</tr>
				<tr>
					<td>Start</td>
					<td><input type="text" value="<?php echo $data["star"]?>" name="star" /></td>
				</tr>
				<tr>
					<td>Checkout</td>
					<td><input type="text" value="<?php echo $data["checkout"]?>" name="checkout" /></td>
				</tr>
				<tr>
					<td>Checkin</td>
					<td><input type="text" value="<?php echo $data["checkin"]?>" name="checkin" /></td>
				</tr>
				<tr>
					<td>Number of floors</td>
					<td><input type="text" value="<?php echo $data["floor_num"]?>" name="floor_num" /></td>
				</tr>
				<tr>
					<td>Number of rooms</td>
					<td><input type="text" value="<?php echo $data["room_num"]?>" name="room_num" /></td>
				</tr>
				<tr>
					<td>Number of restaurants</td>
					<td><input type="text" value="<?php echo $data["rest_num"]?>" name="rest_num" /></td>
				</tr>
				<tr>
					<td>Parking service</td>
					<td><input type="text" value="<?php echo $data["parking_service"]?>" name="parking_service" /></td>
				</tr>
				<tr>
					<td>Service 24</td>
					<td><input type="text" value="<?php echo $data["s24"]?>" name="s24" /></td>
				</tr>
				<tr>
					<td>Room voltage</td>
					<td><input type="text" value="<?php echo $data["room_volt"]?>" name="room_volt" /></td>
				</tr>
				<tr>
					<td>Built in year</td>
					<td><input type="text" value="<?php echo $data["built"]?>" name="built" /></td>
				</tr>
				<tr>
					<td colspan="2">Description<br />
					<textarea rows="5" cols="140" name="description"></textarea>
					</td>
				</tr>
				
			</table>
		</form>
		<?php
	}
}

?>