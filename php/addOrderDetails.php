<?php
	$qErr = $upErr = $tpErr = $pErr = $pErr = $oErr = "";
    $quantity = $unitPrice = $totalPrice = $product = $order = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['addOrderDetails']))
		{

			if(isset($_POST['quantity']) && !empty($_POST['quantity']))
			{		
				$quantity=$_POST['quantity'];	
			}
			else
			{
				$nErr = "Quantity Required";
			}

			if(isset($_POST['unitPrice']) && !empty($_POST['unitPrice']))
			{		
				$unitPrice=$_POST['unitPrice'];	
			}
			else
			{
				//$upErr = "Status Required";
			}

			if(isset($__SESSION['totalPrice']) && !empty($__SESSION['totalPrice']))
			{		
				$totalPrice=$_SESSION['totalPrice'];	
			}
			else
			{
				//$tpErr = "Customer Required";
			}

			if(isset($_POST['product']) && !empty($_POST['product']))
			{		
				$product=$_POST['product'];	
			}
			else
			{
				$pErr = "Product Required";
			}

			if(isset($_POST['order']) && !empty($_POST['order']))
			{		
				$order=$_POST['order'];	
			}
			else
			{
				$oErr = "Order Required";
			}
		}
	}

	//  $quantity = $unitPrice = $totalPrice = $product = $order = "";
	if ($quantity && $unitPrice && $totalPrice && $product &&  $order)
	{  
		include('dal.php');
		
		$rooms = DAL::getRooms()->selectOneByNumber($room);
		$roomId = $rooms->roomId;

		$result = new OrderDetail();

		/*$result->orderDetailId, 
		$result->orderDetailProductQuantity,
		$result->orderDetailUnitPrice,
		$result->orderDetailTotalPrice,
		$result->productId, 
		$result->orderId*/

		
								 
		// $users = DAL::getProducts()->insert($result);
		
		
	}	
	else 
	{
		$addSuccess = "Missing info";
	}
			
		

?>