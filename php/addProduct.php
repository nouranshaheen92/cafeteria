<?php
	$nErr = $pErr = $iErr = $aErr = $cErr = $addSuccess = $addError = "";
    $name = $price = $image = $available = $category = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		if(isset($_POST['addProduct']))
		{
			if(isset($_POST['name']) && !empty($_POST['name']))
			{		
				$name=$_POST['name'];	
			}
			else
			{
				$nErr = "Name Required";
			}
			
			if(isset($_POST['price']) && !empty($_POST['price']))
			{		
				$price=$_POST['price'];	
			}
			else
			{
				$pErr = "Telephone Required";
			}

			/*if(isset($_POST['available']) && !empty($_POST['available']))
			{		
				$available=$_POST['available'];	
			}
			else
			{
				$eErr = "Email Required";
			}*/

			$available=1;
			//$image = "image.jpg";

			if(isset($_POST['category']) && !empty($_POST['category']))
			{		
				$category=$_POST['category'];	
			}
			else
			{
				$exErr = "Email Required";
			}

			
			$target_dir = "images/products/";
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
			        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			        $image= basename($_FILES["image"]["name"]);
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}

		}
	}

	//echo $name . $price . $image . $available . $category ;
	if ($name && $price && $image && $available && $category)
	{  
		include('dal.php');

		//$categories = DAL::getCategories()->selectOneByName($category);
		//$categoryId = $categories->categoryId;
			
		$products = DAL::getProducts()->SelectOne($name);
	
		if(empty($products->productName)) 
		{   
			$result = new Product();

			$result->productName = $name ; 
			$result->productPrice = $price ; 
			$result->productImage = $image ; 
			$result->productAvailable = $available ; 
			$result->categoryId = $category ; 
								 
			$prod = DAL::getProducts()->insert($result);

			$addSuccess = "This Product has been added";
		}
		else{
			$addError = "This Product is exist";
		}
		
	}	
	else 
	{
		//$addError = "Missing info";
	}
			
		

?>