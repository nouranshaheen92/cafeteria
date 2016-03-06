 <?php
	//$uErr = $ulErr = $eErr ="";
	$postIdD = $userIdL = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['delPost']))
		{
			if(isset($_POST['postIdD']) && !empty($_POST['postIdD']))
			{		
				$postIdD=$_POST['postIdD'];	
			}
			else
			{
				$uErr = "Required";
			}
			if(isset($_SESSION["user_id"])) {
			 	$userIdL = $_SESSION["user_id"];
			}
		
		}
		
	}
	
	if ($postIdD)
	{  
		
		include('dal.php');
			$result = new Post();
					
			
			$posts = DAL::getPosts()->delete($postIdD);
		
		
			
		
	}	
	else 
	{
		$addSuccess = "Missing Info";
	}
			
		

?>