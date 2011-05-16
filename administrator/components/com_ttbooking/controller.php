<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class ttbookingsController extends JController
{

	function display()
	{
		parent::display();
	}
	
	function getContentView($row)
	{
		echo "<hr />";
		print_r($row);
	?>
<font size="+2"><u><?php echo JText::_('Tour code')?>:&nbsp <?php echo $row->id;?></u></font><br /><br />
<font size="+1"><?php echo JText::_('Personal Information')?></font><br />
<ul style="list-style:square;font-size:16px;">   
 	<li><?php echo JText::_('Tour code')?>:&nbsp <?php echo $row->id;?> 
	<li><?php echo JText::_('Customer Name')?>:&nbsp <?php echo $row->fullname;?></li>
	<li><?php echo JText::_('Address')?>:&nbsp <?php echo $row->address;?></li>
  	<li><?php echo JText::_('Gender')?>:&nbsp<?php echo $row->gender;?></li>
  	<li><?php echo JText::_('Date of Birth')?>:&nbsp<?php echo $row->dob?></li>
  	<li><?php echo JText::_('Country')?>:&nbsp<?php echo $row->countries?></li>
  	<li><?php echo JText::_('E-mail')?>:&nbsp<?php echo $row->mail?></li>
    
</ul>

<font size="+1"><?php echo JText::_('Tour Information')?></font><br />

<ul style="list-style:square;font-size:16px;">
  	<li><?php echo JText::_('Tourcode')?>:&nbsp<?php echo $row->tcode?></li>
  	<li><?php echo JText::_('Hotel')?>:&nbsp<?php echo $row->hotel?></li>
  	<li><?php echo JText::_('ID')?>:&nbsp<?php echo $row->idt?></li>
  	<li><?php echo JText::_('Departure Date')?>:&nbsp<?php echo $row->departuredate?></li>
  	<li>
    	<?php echo JText::_('Room Preference')?>:<?php echo JText::_('Single')?>&nbsp<?php echo $row->rp_single?>
		&nbsp&nbsp<?php echo JText::_('Double')?>:&nbsp<?php echo $row->rp_double?>
		&nbsp&nbsp<?php echo JText::_('Twin')?>:&nbsp<?php echo $row->rp_twin?>
    </li>
  	
  	<li><?php echo JText::_('Adult')?>:&nbsp<?php echo $row->np_adult?></li>
  	<li><?php echo JText::_('Chile')?>:&nbsp<?php echo $row->np_child?></li>
  	<li><?php echo JText::_('Detail')?>:&nbsp<?php echo $row->detail?></li>
</ul>
<hr />
	<?php $k = 1 - $k; 
	}
	
	function getBooking($id)
	{
		$db = JFactory::getDBO();
		$db->setQuery("SELECT * FROM jos_ttbooking where id in ($id)");
		$db->query();
		$booking=$db->loadObject();
		
		return $booking;
	}
	
	function report()
	{
		$act=JRequest::getWord('controller');
		$id=JRequest::getVar('cid');
		for($i=0;$i<count($id);$i++){$stid=$stid.$id[$i].",";}
		$stid=$stid."0";
		
		$db = JFactory::getDBO();
		$db->setQuery("SELECT * FROM jos_ttbooking where id in ($stid)");
		$db->query();
		$booking=$db->loadObjectList();
		
		?>

    <input type="button" value="Print" onclick="printSelection(document.getElementById('txtHint'));return false " /> 
     <div id="txtHint" style="margin-left:70px;">
     <br />
    <font size="+1">Abktour Col,LTD</font>&nbsp;&nbsp;
	<?php 
		if($act=='ttbooking')echo 'Booking';   
		if($act=='ttbookingcheckin') echo 'Checkin';
		if($act=='ttbookingcheckout') echo 'Chectout';
	?>
    <hr /> 
<?php
	
	$k = 0;
	for ($i=0, $n=count($booking ); $i < $n; $i++)	
	{
		$row = &$booking[$i];
		echo $this->getContentView($row);
	}?>
</div>	
	<?php 
}
}?>


<script type="text/javascript">
function printSelection(node)
{

  var content=node.innerHTML
  var pwin=  window.open ("", "print_content","location=1,status=0,scrollbars=1, width=800,height=500");

  pwin.document.open();
  pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
  pwin.document.close();
 
  //setTimeout(function(){pwin.close();},1000);

}
</script>
