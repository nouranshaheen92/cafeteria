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
    <link rel="stylesheet" type="text/css" href="style/jcarousel.responsive.css">
  <link rel="stylesheet" type="text/css" href="style/style.css">
    
    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script>
  <script type="text/javascript" src="js/jcarousel.responsive.js"></script>
    <script type="text/javascript" src="BS-js/bootstrap.js"></script>
   
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
        <li  class="active"><a href="products.php">Products</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="manualOrders.php">Manual Orders</a></li>
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
<a class="pull-right" href="newProduct.php">Add new product</a>
<h3 class="pull-left">All Products</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    
    <tbody>
      <?php
        $products = DAL::getProducts()->selectAllNoLimit();
      
        foreach($products as $pro)
        {
          $pId = $pro->productId ; 
          $pIm = $pro->productImage;
          $proPrice = $pro->productPrice;
          $proName = $pro->productName;
      ?>
      <tr>  
        <td><?php echo $proName; ?></td>
        <td><?php echo $proPrice." "; ?>LE</td>
        <td><img src="images/products/<?= $pIm; ?>" width="30px" height="30px" alt="Product" name="Product"></td>
        <td><a href="#">Edit</a> <a href="#">Delete</a></td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>

<?php } ?>
