<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 'On');
include("functions.php");

if(isset($_SESSION["customerId"])) {
  if(isLoginSessionExpired()) {
    header("Location:logout.php?session_expired=1");
  }
}

if(!isset($_SESSION["customerName"])){ 
header("Location:index.php");
}
else{

  $customerName=$_SESSION["customerName"];
  $customerId=$_SESSION["customerId"];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <meta name="description" content=" " />
    <meta name="keywords" content=" " />
  <title>Cafeteria</title>
  <link rel="shortcut icon" href="images" />
    
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="BS-css/bootstrap.css"> 
    <link rel="stylesheet" type="text/css" href="css/home.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <script type="text/javascript" src="js/jquery-1.11.4.js"></script>
    
    <script type="text/javascript" src="BS-js/bootstrap.js"></script>
   
</head>

<body>

<?php  
    include('lib/dal.php');
    include('lib/deleteOrder.php');
    include('lib/editOrder.php');
    include('nav.php');

    
  require 'dborm_connect.php';
  require "orderUser.php";
   $order=new OrderCheck();

?>

<div class="container">
<h2>Orders </h2>


 <form method="get" action="orders.php">
      <div class="row">
      <div class='col-sm-4'>
        <div class="form-group">
                <div class='input-group date'>
                    <input type='text' id='from' class="form-control" placeholder="Date From" min="2016-01-01" name="date_from" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
      <div class='col-sm-4'>
                <div class='input-group date'>
                    <input type='text' id='to' class="form-control" placeholder="Date To" name="date_to"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

  
  <input class="btn btn-default" type="submit">
  </form>


<div id="my_orders">
<?php
if(isset($_GET['user']))
{
  if($_GET['user']=="" && ($_GET['date_from']!="" && $_GET['date_to']!=""))
    $order->check_orders(false,false,$_GET['date_from'],$_GET['date_to']);
  else 
    $order->check_orders(false,false,false,false);
}
else
$order->check_orders(false,false,false,false);
?>
</div>

  
   

    

</div>

  
    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#from').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            })
        </script>        
    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#to').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>

</body>
</html>
<?php } ?>
