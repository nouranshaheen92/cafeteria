<?php
	//$uErr = $ulErr = $eErr ="";
	$editPostText = $userIdL = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['editPost']))
		{
			if(isset($_POST['editPostText']) && !empty($_POST['editPostText']))
			{		
				$editPostText=$_POST['editPostText'];	
				//echo $post;
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
	
	if ($editPostText)
	{  
		
		include('dal.php');
		
			$result = new Post();
					
			$result->postContent = $editPostText ;
			//$result->postDate = date("Y-M-D") ; 
			$result->userId = $userIdL ;
			$result->postId = $postId ;
								 
			$posts = DAL::getPosts()->UPDATE($result);
		
		
			
		
	}	
	else 
	{
		$addSuccess = "This User is exist";
	}
			
		

?>