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
  include('php/addProduct.php');
  include('php/addCategory.php'); 
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
  <h2>Add product</h2> 
  <form class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Product:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="price">Price:</label>
      <div class="col-sm-5">
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter parice">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="image">Image:</label>
      <div class="col-sm-5">
        <input type="file" name="image" id="image" accept="image/*">
      </div>
    </div>
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="category">Category:</label>
      <div class="col-sm-5">
      <select class="form-control" name="category" id="category">
        <?php
        $categories = DAL::getCategories()->selectAll();
     // echo $categories;
        foreach($categories as $cat)
        {
          $cId = $cat->categoryId ; 
          $catName = $cat->categoryName;
         // echo $catName;
      ?>
        <option value="<?php echo $cId; ?>"><?php echo $catName; ?></option>
        <?php } ?>
      </select>
    </div>
     <a href="#" data-toggle="modal" data-target="#myModal">Add category</a>
    </div>
     
  <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="addProduct" class="btn btn-default">Submit</button>
	      <div class="col-sm-5">          
	 <button type="reset" class="btn btn-default">Reset</button>
		</div>
      <span style="color:green;"><?php echo $addSuccess; ?></span>
      <span style="color:red;"><?php echo $addError; ?></span>
      </div>
    </div>
  </form>


  <!-- Modal
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add new category</h4>
        </div>
        <div class="modal-body">
           <form class="form-horizontal" role="form" action="#" method="POST">
              <div class="form-group">
                 <label class="control-label col-sm-2" for="name">Category name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="category" placeholder="Enter category name">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="Submit" name="addCategory" class="btn btn-default" data-dismiss="modal">Submit</button>
              </div>
           </form>
        </div>
      </div>
    </div>
  </div> -->

  
    </div>

</div>

</body>
</html>

<?php } ?>
