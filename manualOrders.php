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
 	
    <!--[if lt IE]>
    <style>
    .image-res {height: auto !important; width: 100% !important; overflow: hidden; position: absolute; margin:auto; display:block; left: 0; top:0; right:0; left:0; text-align: center;}
    </style>
    <![endif]-->
   
</head>

<body >

<?php  include('php/dal.php'); ?>
 
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
        <li><a href="orders.php">My Orders</a></li>
        <?php }
          else{
        ?>
        <li><a href="products.php">Products</a></li>
        <li><a href="users.php">Users</a></li>
        <li class="active"><a href="manualOrders.php">Manual Orders</a></li>
        <li><a href="checks.php">Checks</a></li>
        <?php } ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">
<h2>Orders </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Action</th>
        <th>Date</th>
        <th>Name</th>
        <th>Room</th>
        <th>Ext</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
   
    <?php
        $orders = DAL::getOrders()->selectAll();
      
        foreach($orders as $ord)
        {
          $oId = $ord->orderId ; 
          $oTime = $ord->orderTime;
          $oNotes = $ord->orderNotes;
          $oStatus = $ord->orderStatus;
          $cId = $ord->customerId;

          $customer = DAL::getCustomers()->selectOne($cId);

          $cName = $customer->customerName;
          $cExt = $customer->customerExtension;
          $rId = $customer->roomId;

          $room = DAL::getRooms()->selectOne($cId);

          $rNumber = $room->roomNumber;


      ?>
    <table class="table table-striped">
    <tbody>
      <tr>  
        <td> <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#<?php echo $oId; ?>">Show Orders</button></td>
        <td><?php echo $oTime; ?></td>
        <td><?php echo $cName; ?></td>
        <td><?php echo $rNumber; ?></td>
        <td><?php echo $cExt; ?></td>
        <td><span>Deliver</span></td>
      </tr>
    </tbody>
    </table>

      <table class="table table-striped panel-collapse collapse" id="<?php echo $oId; ?>" >
      <tbody>  <tr>
      <?php
      
        $orderDetails = DAL::getOrderDetails()->selectAllByOrderId($oId);
      
        foreach ($orderDetails as $detail)
        {
          $odId = $detail->orderDetailId ; 
          $odQuantity = $detail->orderDetailProductQuantity;
          $odPrice = $detail->orderDetailUnitPrice;
          $odTotal = $detail->orderDetailTotalPrice;
          $pId = $detail->productId;
          $ordId = $detail->orderId;
          //echo $pId;

          $product = DAL::getProducts()->selectOneById($pId);

          $pName = $product->productName;
          $pIm = $product->productImage;
      ?>
      
        <td>
        <div class="col-lg-10 col-md-3 col-sm-4 col-xs-6">
          <img src="images/products/<?= $pIm; ?>" width="100%" height="150px" alt="Product" name="Product">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="info-success text-center none"><?php echo $pName; ?></p>
          </div>
          <span class="btn btn-default" style="position:absolute; margin:auto; top:0; right:15px; border-radius:20px;"><?php echo $odPrice; ?>LE</span>
        </div>
      </td>
      
    
    <?php
     } 
    ?>
    </tr>
    </tbody>
    </table>
   

  <?php
    } 
  ?>
    
    

</div>

  
  

</body>
</html>
<?php } ?>
