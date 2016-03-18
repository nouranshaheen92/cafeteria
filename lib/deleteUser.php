<?php
	$addSuccess = "";
    $id = "";
	
	if(isset($_GET['id']) && !empty($_GET['id']))
	{		
		$id=$_GET['id'];	
	}
	else
	{
		$iErr = "Id Required";
	}
			
			
	if ($id)
	{  
		include('dal.php');
		//$orderIds=[];
		/*$orders = DAL::getOrders()->selectAllByCustomerId($id);

		foreach($orders as $order)
		{
			$orderId = $order->orderId;
		
			$orderdetails = DAL::getOrderDetails()->delete($id);*/
			

			//mysql_query('SET foreign_key_checks = 0');
			//mysql_query('UPDATE customers SET reference=NULL');

			$delUser = DAL::getCustomers()->delete($id);
		
			if($delUser) 
			{   
				$addSuccess = "This User has been Removed";
			}
			else{
				$addSuccess = "This User exists";
			}

			//mysql_query('SET foreign_key_checks = 1');
	//	}
		
	}	
	else 
	{
		//$addError = "Missing info";
	}
			
		

?>