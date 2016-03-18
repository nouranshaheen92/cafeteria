<?php
	$mailSent = $eErr = $nErr = $mErr = "";
	$mail = $name = $message = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['sendPassword']))
		{
			if(isset($_POST['name']) && !empty($_POST['name']))
			{		
				$name=$_POST['name'];	
			}
			else
			{
				$nErr = "Required";
			}
			
			if(isset($_POST['sendMail']) && !empty($_POST['sendMail']))
			{		
				$mail=$_POST['sendMail'];
			}
			else
			{
				$eErr = "Required";
			}
			
		}
	}
	
	if ($name && $mail)
	{  
		if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
		{
				// send mail
				function generateRandomString($length = 10) {
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[rand(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}

				$passwordReset = generateRandomString(); 

				$to = "hoda.mtaha@gmail.net";  
				$subject = "Cafteria App Password";
				$message = " 
				Hello Mr/Miss:" . $name ." 
				Mail:" . $mail ." 
				Message:" . $passwordReset;
				$message = str_replace("\n.", "\n..", $message);
				$from = "hoda.mtaha@gmail.net";;
				$headers = "From:" . $from;
				//$headers = "From: info@multieng.net". "\r\n" ."CC: somebodyelse@example.com";

				mail($to,$subject,$message,$headers);
						
				$message = "Mail has been sent";
				
		}
	}	

?>