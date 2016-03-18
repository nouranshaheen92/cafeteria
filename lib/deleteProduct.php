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

		//$categories = DAL::getCategories()->selectOneByName($category);
		//$categoryId = $categories->categoryId;
			
		$delProduct = DAL::getProducts()->delete($id);
	
		if($delProduct) 
		{   
			$addSuccess = "This Product has been Removed";
		}
		else{
			$addSuccess = "This Product exists";
		}
		
	}	
	else 
	{
		//$addError = "Missing info";
	}
			
		

?>