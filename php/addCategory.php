<?php
	//$uErr = $ulErr = $eErr ="";
	$category = $ctErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{   
		if(isset($_POST['addCategory']))
		{
			if(isset($_POST['category']) && !empty($_POST['category']))
			{		
				$category = $_POST['category'];	
				//echo $category; echo "here"; 
			}
			else
			{
				$ctErr = "Category Required";
			}
		}
		

	
	if ($category)
	{  
		
		include('dal.php');
		   
			$result = new Category();
					
			$result->categoryName = $category ;
								 
			$cat = DAL::getCategories()->insert($result);
		
		
			
		
	}	
	else 
	{
		$addSuccess = "Enter A new category";
	}
			
			}

?>