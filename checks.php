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

<body >

<?php  
  include('php/dal.php'); 
?>

<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Cafeteria</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <?php
          if($_SESSION["customerId"] !=1)
          {
        ?>
        <li><a href="orders.php">Checks</a></li>
        <?php }
          else{
        ?>
        <li><a href="products.php">Products</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="manualOrders.php">Manual Orders</a></li>
        <li class="active"><a href="checks.php">Checks</a></li>
        <?php } ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>




<div class="container">
  <h2>Checks</h2>
 <div class="row">
        <div class='col-sm-4'>
<div class="form-group">
                <div class='input-group date'>
                    <input type='text' id='datepicker1' class="form-control" placeholder="Date From" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
			<div class='col-sm-4'>
                <div class='input-group date'>
                    <input type='text' id='datepicker2' class="form-control" placeholder="Date To" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        
<div class='col-sm-4'>
		<select class="form-control" name="category" id="category">
		 <?php
        $username = DAL::getCustomers()->selectAll();
    
        foreach($username as $user)
        {
          $uId = $user->customerId ; 
          $Uname = $user->customerName;
   
      ?>
        <option value="<?php echo $uId; ?>"><?php echo $Uname; ?></option>
        <?php } ?>
       
      </select>
	  </div>
	      <table class="table table-striped">
      	  <thead>
            <tr>
              <th>Name</th>
              <th>Total Amount</th>
            </tr>
          </thead>
        </table>
        
       <?php

        $username = DAL::getCustomers()->selectAll();
      
         foreach($username as $user)
        {
          $totalPrice="0";
          $Uname = $user->customerName;
          $UId = $user->customerId;

          $orderbyCst = DAL::getOrders()->selectAllByCustomerId($UId);

          foreach($orderbyCst as $oCst)
          {
            $oId = $oCst->orderId;

            //echo $oId;

            $orderDetails = DAL::getOrderDetails()->selectAllByOrderId($oId);
      
            foreach ($orderDetails as $detail)
            { 
              $odId = $detail->orderDetailId ; 
              $odQuantity = $detail->orderDetailProductQuantity;
              $odPrice = $detail->orderDetailUnitPrice;
              $odTotal = $detail->orderDetailTotalPrice;
              $pId = $detail->productId;
              $ordId = $detail->orderId;

              //echo $odId;

              $totalPrice += $odTotal; 
            }
          
          }
      ?>
      <table class="table table-striped">
        <tbody>
          <tr>  
            <td><a data-toggle="collapse" href="#<?php echo $UId; ?>" ><?php echo $Uname; ?></a></td>
            <td><?php echo $totalPrice." "; ?>LE</td>
          </tr>

        </tbody>
      </table>
        <table class="table table-striped panel-collapse collapse" id="<?php echo $UId; ?>" >
          <thead>
            <tr>
              <th>Date</th>
              <th>Total amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $orderbyCst = DAL::getOrders()->selectAllByCustomerId($UId);

                foreach($orderbyCst as $oCst)
                {
                  $oId = $oCst->orderId;
                  $orderdate = $oCst->orderTime ; 
                  //echo $oId;

                  $orderDetails = DAL::getOrderDetails()->selectAllByOrderId($oId);
                  $orderPrice ="0";
                  foreach ($orderDetails as $detail)
                  { 

                    $odId = $detail->orderDetailId ; 
                    $odQuantity = $detail->orderDetailProductQuantity;
                    $odPrice = $detail->orderDetailUnitPrice;
                    $odTotal = $detail->orderDetailTotalPrice;
                    $pId = $detail->productId;
                    $ordId = $detail->orderId;

                    //echo $odId;

                    $orderPrice += $odTotal; 
                  }
                
                
            ?>
            <tr>  
              <td><?php echo $orderdate; ?></td>
              <td><?php echo $totalPrice." "; ?>LE</td> 
            </tr>
            <?php
              } 
            ?>
          </tbody>
        </table>

      <?php
        } 
      ?>
    

</div>

<script type="text/javascript">
            $(function () {
              //$( "#datepicker" ).datepicker();
                $('#datepicker1').datepicker();
            });
       $(function () {
                $('#datepicker2').datepicker();
            });
        </script>

</body>
</html>

<?php } ?>