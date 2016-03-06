<?php
	//$uErr = $ulErr = $eErr ="";
	$room = $rmErr = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['addRoom']))
		{
			if(isset($_POST['room']) && !empty($_POST['room']))
			{		
				$room = $_POST['room'];	
			}
			else
			{
				$rmErr = "Room Required";
			}
		}
		
	}
	
	if ($room)
	{  
		
		include('dal.php');
		   
			$result = new Room();
					
			$result->roomNumber = $room ;
								 
			$posts = DAL::getRooms()->insert($result);
		
		
			
		
	}	
	else 
	{
		$addSuccess = "Enter A new Room";
	}
			
		

?>