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

  if(isset($_REQUEST["confirmOrder"]) || !isset($_SESSION['orders']))
  {
    $numberoforder=-1;
    $_SESSION['numberoforder']=-1;
    $_SESSION['orders']=[]; 
    
  }

  if(isset($_REQUEST["product-name"]))
  {

  $_SESSION['numberoforder']=$_SESSION['numberoforder']+1;
  $numberoforder=$_SESSION['numberoforder'];
  $_SESSION['orders'][$numberoforder]["product-name"]=$_REQUEST["product-name"];
  $_SESSION['orders'][$numberoforder]["product-id"]=$_REQUEST["product-id"];
  $_SESSION['orders'][$numberoforder]["product-price"]=$_REQUEST["product-price"];
     echo "<script>window.location = 'home.php';</script>";
     
     echo $_POST["product-name"];
     echo $_SESSION['orders'][$numberoforder]["product-name"];

  }

/*
  if(isset($_REQUEST["confirm-product-name"]))
  {

  $_SESSION['numberoforder']=$_SESSION['numberoforder']+1;
  $numberoforder=$_SESSION['numberoforder'];
  $_SESSION['orders'][$numberoforder]["product-name"]=$_REQUEST["product-name"];
  $_SESSION['orders'][$numberoforder]["product-id"]=$_REQUEST["product-id"];
  $_SESSION['orders'][$numberoforder]["product-price"]=$_REQUEST["product-price"];
  $_SESSION['orders'][$numberoforder]["product-quantity"]=$_REQUEST["product-quantity"];
     echo "<script>window.location = 'home.php';</script>";
     
        
  }
*/

if(isset($_REQUEST["delorder"]))
{
  unset($_SESSION['orders'][$_REQUEST["delorder"]]);
  $_SESSION['orders']=  array_values($_SESSION['orders']);
  $_SESSION['numberoforder']=$_SESSION['numberoforder']-1;
}

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
        <li class="active"><a href="#">Home</a></li>
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
<section class="container">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 none">
    <div class="row">

      <h4 class="HB">Shopping Cart</h4>
        <div class="row">
          <form method="POST" name="order">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 none">
            <table id="shop" style="width:100%">
                <tr class="orange">
                    <th class="item t1">Drink</th>
                    <th class="border-gray t2">Quantity</th> 
                    <th class="border-gray t4">Price</th>
                    <th class="t5"></th>  
                </tr>

                <?php 
                if(isset($_SESSION['numberoforder']) && isset($_SESSION['customerName'])) 
                { echo $_SESSION['numberoforder'];
                for($i=0;$i<=$_SESSION['numberoforder'];$i++)
                  
                  {
                ?>
                 
                <tr>
                    <td class=" border-gray item t1">
                      
                        <input class="product-name" type="text" id="confirm-product-name" 
                              name="confirm-product-name" value="<?php echo $_SESSION['orders'][$i]['product-name']; ?>" readonly/>
                      </span>
                    </td>

                    <td class="pQuntAdd">
                      <input type='button' value='-' class='qtyminus' field='product-quantity' />
                      <input type='text' name='confirm-product-quantity' value='1' class='qty' id="confirm-product-quantity<?php echo $i; ?>"/>
                      <input type='button' value='+' class='qtyplus' field='product-quantity' />
                    </td>

                    <td class="border-gray t4">
                      <input class="entryInput" type="text" id="confirm-product-price<?php echo $i; ?>" 
                              name="confirm-product-price" value="4" readonly/></td>    

                    <td class="border-gray t4">
                      <a href='home.php?delorder=<?php echo $i; ?>'>
                        <input class="deleteEntry" type="text" id="delete" 
                              name="delete" value="X" readonly/>
                      </a>
                      <input type='hidden' value='<?php echo $_SESSION["numberoforder"]; ?>' class='numberoforder' id="numberoforder"/>
                    </td>
                </tr>
              
                <?php 
                  //$total_basket+=$_SESSION['orders'][$i]["product-quantity"]*$_SESSION['orders'][$i]["product-price"];
                  }}
                ?>
               
                <tr id="final-price">
                    <th></th>
                    <td colspan="3" class="total"><span id="tot-price">Total Price: </span>
                        <span id="price"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                        <span id="sr">&nbsp;SR</span></td>    
                </tr>

                <script type="text/javascript">
                  jQuery(document).ready(function(){
                  $count = $("#numberoforder").val();
                  alert("$count");
                  for($i=0; $i<=$count; $i++){
                    $total-price = $("#confirm-product-price"+$i).val() * $("#confirm-product-quantity"+$i).val();
                  }

                  $("#price").html($count);
                </script>
              
            </table>
            </div>
            
            <button id="addProductB" type="submit" name="confirmOrder" class="btn btn-default confirm-order"> 
              CONFIRM ORDER 
            </button>
          </form>
        </div>
    
     


    </div>
    
  </div>
    <div  class="col-lg-8 col-md-8 col-sm-8 col-xs-9 none"> 
      <form class="" role="search" method="GET">
        <div class="form-group search-div has-feedback">
          <input type="text" class="form-control search-input" name="se" placeholder="Search" value="">
          <button type="submit" class="search">
          <span class="glyphicon glyphicon-search form-control-feedback"></span></button>
        </div>
      </form>
      <form method="POST" name="index.php">

      <h4 class="HB">Products</h4>
        <?php
          $lim=0;
              if(isset($_REQUEST["lim"]))
              {
                $lim=$_REQUEST["lim"] ;
              }

              if(isset($_GET["se"]))
              {
                $letters=$_GET["se"] ;
                $products = DAL::getProducts()->selectAllByLetter($letters);
              }
              else
              {
                 $products = DAL::getProducts()->SelectAll($lim);
              }

        foreach($products as $pro)
        {
          $pId = $pro->productId ; 
          $pIm = $pro->productImage;
          $proPrice = $pro->productPrice;
          $proName = $pro->productName;
          //echo $pIm;
      ?>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <img src="images/products/<?= $pIm; ?>" width="100%" height="150px" alt="Product" name="Product">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input class="input-sm" type="text" id="product-name" name="product-name" 
                  value='<?= $proName ?>' readonly/>
          <input class="input-sm" type="hidden" id="product-price" name="product-price" 
                  value='<?= $proPrice ?>'/>
          <input class="input-sm" type="hidden" id="product-id" name="product-id" 
                  value='<?= $pId ?>'/>
          <p class="info-success text-center none"><?php echo $proName; ?></p>
        </div>
        <button class="btn btn-default" style="position:absolute; margin:auto; top:0; right:15px; border-radius:20px;"><?php echo $proPrice; ?>LE</button>
      </div>
    <?php
      }
    ?>


  
    </form>
  </div>
</section>

<script type="text/javascript">
  jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
  });

</script>

<?php
if(isset($_REQUEST["confirmOrder"]))
{
  include('dal.php');

    //$categories = DAL::getCategories()->selectOneByName($category);
    //$categoryId = $categories->categoryId;

      //order_id  order_time  order_notes   delivery_status   customer_id 

      // order_details_id   order_details_product_quantity  order_details_unit_price  order_details_total_price   product_id  order_id 

      $result = new Order();

      //$result->orderTime = date() ; 
      $result->orderNotes = $_POST["notes"]; 
      $result->deliveryStatus = "Processing"; 
      $result->customerId = $_SESSION["customerId"]; 
                 
      $order = DAL::getOrders()->insert($result);

      $ord = DAL::getOrders()->selectAllByCustomerId($_SESSION["customerId"]);

      foreach ($ord as $orderr) {
        $orderId = $orderr->orderId;
      }

      $pro = DAL::getProducts()->selectOne($_Post["confirm-product-name"]);

      
        $productId = $pro->productId;
     

      $results = new OrderDetail();
      $results->orderDetailProductQuantity = $_POST["confirm-product-quantity"]; 
      $results->orderDetailUnitPrice = $_POST["confirm-product-price"]; 
      $results->orderDetailTotalPrice = $_POST["confirm-product-quantity"] * $_POST["confirm-product-price"];
      $results->productId = $productId;
      $results->orderId = $orderId; 

      $orderDetailss = DAL::getOrderDetails()->insert($results);

    if($order && $orderDetailss){
      echo "<script> alert('Your order has been sent successfully'); </script>";
    }
    else{
      echo "<script> alert('Your order has not been sent successfully'); </script>";
    }
}
?>

</body>
</html>
<?php } ?>
