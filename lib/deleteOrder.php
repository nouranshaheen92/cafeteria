<?php
	$addSuccess = "";
    $id = "";
	
	if(isset($_GET['dId']) && !empty($_GET['dId']))
	{		
		$id=$_GET['dId'];	
	}
	else
	{
		$iErr = "Id Required";
	}
			
			
	if ($id)
	{  
		include('dal.php');

		$orderDetails = DAL::getOrderDetails()->selectAllByOrderId($id);
		
		foreach ($orderDetails as $orderDetail) {
			$orderDetailId = $orderDetail->orderDetailId;

			$delorderDetails = DAL::getOrderDetails()->delete($orderDetailId);
		}
		
		if($delorderDetails)
		{	
			$delOrder = DAL::getOrders()->delete($id);
		
			if($delOrder) 
			{   
				$addSuccess = "This Order has been Removed";
			}
			else
			{
				$addSuccess = "This Order exists";
			}
		}
	}	
	else 
	{
		//$addError = "Missing info";
	}
			
		

?>