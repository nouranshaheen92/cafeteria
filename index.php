<?php
session_start();
include("functions.php");
error_reporting(E_ALL); ini_set('display_errors', 'on');
$message=$userNameErr=$passwordErr="";
$email = $password = $user = $pass = $level = "";

if(count($_POST)>0) {
	$email = $_POST["email"];
	//echo $email;
	$password = $_POST["password"];
	$password=md5($password);

	include("php/dal.php");
	$customers = DAL::getCustomers()->selectOneByEmail($email);
	$emailLogin = $customers->customerEmail ;
	$pass = $customers->customerPassword ;

	if($emailLogin) 
	{
		if ($password == $pass)
		{
			$_SESSION["customerId"] = $customers->customerId;
			$_SESSION["customerName"] = $customers->customerName;
			$_SESSION['loggedin_time'] = time(); 
			
			//$level = $users->userLevel ;
			//$_SESSION["user_level"] = $level;
			//$levels = DAL::getUserLevels()->selectOne($userLevel);
			//$levelId = $levels->userLevelName ;
		}
		else {
			$message = "Invalid Email or Password!!";
		}
	}
	else {
		$message = "Invalid Email or Password!";
	}
}

if(isset($_SESSION["customerId"])) {
	if(!isLoginSessionExpired()) {
		header("Location:home.php");
	} else {
		header("Location:logout.php?session_expired=1");
	}
}

if(isset($_GET["session_expired"])) {
	$message = "Login Session is Expired. Please Login Again";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="description" content=" "   />
    <meta name="keywords" content=" "   />
	<title>Cafeteria</title>
	<link rel="shortcut icon" href="images" />
    <link rel="stylesheet" type="text/css" href="BS-css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="BS-js/bootstrap.js"></script>   
</head>
<body class="container-fluid">
    <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 none login">
    	<img class="cafe" alt="Cafe" name="Cafe" src="images/logo.png" />
       
        <div class="col-lg-5 col-md-4 col-sm-6 col-xs-10 middle">
        	<form role="form" class="MB" method="POST" action="">
            	<?php if($message!="") { ?>
                <div class="message"><?php echo $message; ?></div>
                <?php } ?>
                <input class="form-control bbt" name="email" type="email" placeholder="EMAIL" required>
                <span class="note unote"><?php //echo $eErr ;?></span>
                
                <input class="form-control btp" name="password" type="password" placeholder="PASSWORD" required>
                <span class="note pnote"><?php //echo $pErr ;?></span>
                
                <button class="loginB" name="login" type="submit"  class="text-center">Login</button>  
            </form>
            <p class="text-center"><a class="chup" href="">Forget Password</a></p>	
        </div>
        
       <div class="PWME">
           <p> POWERED BY <span style="color:#ccc;">4Girls</span></p>
       </div>
    </section>
      
    <!--<footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12 none">
    	<img alt="MultiEngineering" name="MultiEngineering" src="images/ME/ME-white.png" />
    	<p>Copyright &copy; 2014 Multi-Engineering Co.</p>
    </footer>-->
    
    
    
</body>
</html>
