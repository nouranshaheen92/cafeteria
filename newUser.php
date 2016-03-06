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

<?php  
  include('php/dal.php'); 
  include('php/addCustomer.php'); 
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
        <li><a href="#">Home</a></li>
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
  <h2>Add user</h2>
  <form class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="username" id="email" placeholder="Enter Username">
      </div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-5">          
        <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
      </div>
    </div> 
	
	<div class="form-group">
      <label class="control-label col-sm-2" for="image">Image:</label>
      <div class="col-sm-5">
        <input type="file" name="image" id="image" accept="image/*">
      </div>	
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="room">Room:</label>
      <div class="col-sm-5">
        <select class="form-control" name="room" id="room">
          <?php
          $rooms = DAL::getRooms()->selectAll();
        
          foreach($rooms as $rm)
          {
            $rId = $rm->roomId ; 
            $rmNumber = $rm->roomNumber;
            //echo $rmNumber;
          ?>
          <option value="<?php echo $rId; ?>"><?php echo $rmNumber; ?></option>
          <?php } ?>
        </select>
      </div>
     <a href="#" >Add Room</a>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="ext">Extension:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" name="extension" id="ext" placeholder="Enter extention number">
      </div>
    </div>   

    <div class="form-group">
      <label class="control-label col-sm-2" for="telephone">Telephone:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" name="telephone" id="ext" placeholder="Enter telephone number">
      </div>
    </div>

  <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="addCustomer" class="btn btn-default">Submit</button>
	      <div class="col-sm-5">          
	 <button type="reset" class="btn btn-default">Reset</button>
		</div>
      <span style="color:green;"><?php echo $addSuccess; ?></span>
      <span style="color:red;"><?php echo $addError; ?></span>
      </div>
    </div>
  </form>
</div>


</body>
</html>

<?php } ?>

