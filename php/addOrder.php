<?php
	$tErr = $nErr = $sErr = $cErr ="";
    $time = $notes = $status = $customer = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['addOrder']))
		{
			date_default_timezone_set('Africa/Cairo');  
			$time=date("Y-m-d H:i:s");	
			
			if(isset($_POST['notes']) && !empty($_POST['notes']))
			{		
				$notes=$_POST['notes'];	
			}
			else
			{
				$nErr = "Notes Required";
			}

			if(isset($_POST['status']) && !empty($_POST['status']))
			{		
				$email=$_POST['status'];	
			}
			else
			{
				$sErr = "Status Required";
			}

			if(isset($__SESSION['customer_id']) && !empty($__SESSION['customer_id']))
			{		
				$customerId=$_SESSION['customer_id'];	
			}
			else
			{
				if(isset($_POST['customer']) && !empty($_POST['customer']))
				{		
					$email=$_POST['customer'];	
				}
				else
				{
					$sErr = "Customer Required";
				}
			}
		}
	}

	//  $time = $notes = $status = $customer 
	if ($time && $notes && $status && $customer)
	{  
		include('dal.php');
			
		$result = new Order();

		$result->orderTime = $time ;
		$result->orderNotes = $notes ;
		$result->orderStatus = $status ;
		$result->customerId = $customerId ;
								 
		$users = DAL::getProducts()->insert($result);
		
		
	}	
	else 
	{
		$addSuccess = "Missing info";
	}
			
		

?>