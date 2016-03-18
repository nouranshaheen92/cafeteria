<?php
session_start();
unset($_SESSION["customerName"]);
unset($_SESSION["customerId"]);
unset($_SESSION["customerPassword"]);
unset($_SESSION["orders"]);
unset($_SESSION["cart_item"]);
session_destroy();
$url = "index.php";
/*if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}*/
header("Location:$url");
?>