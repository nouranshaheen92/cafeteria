<?php
session_start();
include("functions.php");

error_reporting(E_ALL); ini_set('display_errors', 'on');   ///// for displaying errors in which line

$message = "";

if(isset($_SESSION["customerId"])) {
	if(!isLoginSessionExpired()) {
		header("Location:home.php");
	} else {
		header("Location:logout.php");
	}
}

if(isset($_GET["session_expired"])) {
//	$message = "Login Session is Expired. Please Login Again";
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

	<?php include("lib/sendMail.php"); ?>

    <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 none login">
    	<img class="cafe" alt="Cafe" name="Cafe" src="images/logo.png" />
       
        <div class="col-lg-5 col-md-4 col-sm-6 col-xs-10 middle">
        	<form role="form" class="MB" method="POST" action="">
            	<?php if($message!="") { ?>
                <div class="message"><?php echo $message; ?></div>
                <?php } ?>
                <input class="form-control bbt" name="sendMail" type="email" placeholder="EMAIL" required>
                <span class="note unote"><?php echo $message ;?></span>
                
                <input class="form-control btp" name="name" type="text" placeholder="Your Name" required>
                <span class="note pnote"><?php echo $message ;?></span>
                
                <button class="loginB" name="sendPassword" type="submit"  class="text-center">Send Password</button>  
            </form>
            <p class="text-center"><a class="chup" href="index.php">Back to Login</a></p>	
        </div>
        
       <div class="PWME">
           <p style="color:#78344d;"> POWERED BY <span style="color:#78344d;">4Girls</span></p>
       </div>
    </section>
      
    <!--<footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12 none">
    	<img alt="MultiEngineering" name="MultiEngineering" src="images/ME/ME-white.png" />
    	<p>Copyright &copy; 2014 Multi-Engineering Co.</p>
    </footer>-->
    
    
    
</body>
</html>
