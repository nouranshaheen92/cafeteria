<?php
session_start();
unset($_SESSION["customerName"]);
unset($_SESSION["customerId"]);
unset($_SESSION["customerPassword"]);
session_destroy();
$url = "index.php";
/*if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}*/
header("Location:$url");
?>