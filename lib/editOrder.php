<?php


	$addSuccess = "";
    $id = "";
	
	if(isset($_GET['eId']) && !empty($_GET['eId']))
	{		
		$id=$_GET['eId'];	
	}
	else
	{
		$iErr = "Id Required";
	}
			
			
	if ($id)
	{  
		include('dal.php');
		
		$delOrder = DAL::getOrders()->updateStatus($id);
		
		if($delOrder) 
		{   
			$addSuccess = "This Order has been Removed";
		}
		else
		{
			$addSuccess = "This Order exists";
		}
	}	
	else 
	{
		//$addError = "Missing info";
	}
			
		

?>