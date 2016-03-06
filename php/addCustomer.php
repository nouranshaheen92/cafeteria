<?php
	$uErr = $exErr = $eErr = $pErr = $tErr = $rErr = $nErr = $addSuccess = $addError = "";
	$username = $password = $room = $notes = $name = $extension = $telephone = $email = $image = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['addCustomer']))
		{
			if(isset($_POST['name']) && !empty($_POST['name']))
			{		
				$name=$_POST['name'];	
			}
			else
			{
				$nErr = "Name Required";
			}
			
			if(isset($_POST['telephone']) && !empty($_POST['telephone']))
			{		
				$telephone=$_POST['telephone'];	
			}
			else
			{
				$tErr = "Telephone Required";
			}

			if(isset($_POST['email']) && !empty($_POST['email']))
			{		
				$email=$_POST['email'];	
			}
			else
			{
				$eErr = "Email Required";
			}

			if(isset($_POST['extension']) && !empty($_POST['extension']))
			{		
				$extension=$_POST['extension'];	
			}
			else
			{
				$exErr = "Email Required";
			}
			
			if(isset($_POST['username']) && !empty($_POST['username']))
			{		
				$username=$_POST['username'];	
			}
			else
			{
				$uErr = "Username Required";
			}
			
			if(isset($_POST['password']) && !empty($_POST['password']))
			{		
				$password=$_POST['password'];
				$password=md5($password);
			}
			else
			{
				$pErr = "Password Required";
			}
			
			if(isset($_POST['notes']) && !empty($_POST['notes']))
			{		
				$notes=$_POST['notes'];
			}
			else
			{
				//$cpAErr = "Required";
			}
			
			if(isset($_POST['room']) && !empty($_POST['room']))
			{		
				$room=$_POST['room'];	
			}
			else
			{
				$rErr = "Room Required";
			}

			//$image="profile.jpg";
			$notes="Notes";
			
			$target_dir = "images/profile/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				
					$check = getimagesize($_FILES["image"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["image"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
						$image=basename( $_FILES["image"]["name"]);
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}
			
			
		}
	

	

	if ($username && $password && $room && $email && $extension && $name && $telephone && $image)
	{  
		include('dal.php'); 
			
		$customers = DAL::getCustomers()->selectOneByName($username);
		//echo $customers->customerUsername;
	
		if(empty($customers->customerUsername)) 
		{   
 
			$result = new Customer();
				
			$result->customerName = $name ; 
			$result->customerTelephone = $telephone ; 
			$result->customerEmail = $email ; 
			$result->customerExtension = $extension ;  
			$result->customerUsername = $username ;  
			$result->customerPassword = $password ; 
			$result->customerImage = $image ; 
			$result->customerNotes = $notes ; 
			$result->roomId = $room ; 
								 
			$users = DAL::getCustomers()->insert($result);

			$addSuccess = "This User has been added";
		}
		else{
			$addError = "This User is exist";
		}
		
	}	
	else 
	{
		$addError = "Missing info";
	}
			
		
}
?>