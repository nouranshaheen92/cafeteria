<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 'On');

include("functions.php");
include('lib/dal.php');
 
if(isset($_SESSION["customerId"])) {
  if(isLoginSessionExpired()) {
    header("Location:logout.php");  //?session_expired=1
  }
}
 
if(!isset($_SESSION["customerName"])){  
  header("Location:index.php");
}
else{
 
  $customerName=$_SESSION["customerName"];
  //echo $customerName;
  $customerId=$_SESSION["customerId"];
  //echo $customerId;

    
    
 

?> 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="description" content=" " />
  <meta name="keywords" content=" " />
	<title>Cafeteria</title>
	<link rel="shortcut icon" href="images/" />
    
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

<?php 
   
  include('nav.php');
?>
 
<section class="container">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 none">
    <div class="row">

      <h4 class="HB">Shopping Cart</h4>
        <div class="row">
          <form method="POST" name="order">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 none" id="cart_item">

                <div id="test">

                </div>

            </div>
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
    
      <div class="txt-heading"><a href="home.php" style="color:black;">Products</a></div>
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
                if(!$products)
                {
                  echo "<div class='alert alert-info'>";
                  echo "No products found with this letter!";
                  echo "</div>";
                }
              }
              else
              {
                 $products = DAL::getProducts()->SelectAll($lim);
              }
        if($products){
        foreach($products as $pro)
        {
          $pId = $pro->productId ; 
          $pIm = $pro->productImage;
          $proPrice = $pro->productPrice;
          $proName = $pro->productName;

      ?>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 product-item" id="shop">
        <form id="frmCart" method="POST">
        <div class="product-image"><img src="images/products/<?= $pIm; ?>"></div>
        <div><strong><?= $proName ?></strong></div>
        <div class="product-price"><?= $proPrice ?> LE</div>
         <div><!--<input type="text" id="qty_<?= $pId ?>" name="quantity" value="1" size="2" /> -->
        <?php
         // $in_session = "0";
          /*if(!empty($_SESSION["cart_item"])) {
            $session_code_array = array_keys($_SESSION["cart_item"]);
              if(in_array($pId,$session_code_array)) {
              $in_session = "1";
              }
          }*/
          if(empty($_SESSION["cart_item"])) {
             $_SESSION['cart_item'] = array();
          }
          if(array_key_exists($pId, $_SESSION['cart_item'])){
        ?>
        <input type="button" id="added_<?php echo $pId; ?>" value="Added" class="btnAdded"/>
        <?php }else{ ?>
        <input type="button" id="add_<?php echo $pId; ?>" value="Add to cart" class="btnAddAction cart-action" onClick ="cartAction('add','<?php echo $pId; ?>')"/>
        <?php }  ?>
        </div>
        </form>
      </div>


    <?php
      }
      }
      else{
          echo "<div class='alert alert-danger'>";
              echo "<strong>No products found</strong> to Show!";
          echo "</div>";
      }
    ?>


  
   
  </div>
</section>

<script type="text/javascript">

  function cartAction(action,product_code) {

      //alert(product_code);
      //alert(action);
      var queryString =" ";
        if(action != "") {
          switch(action) {
            case "add":
              //queryString = 'action='+action+'&code='+ product_code+'&quantity='+$("#qty_"+product_code).val();
              //queryString = 'action='+action+'&code='+ product_code+'&quantity='+$("#qty_"+product_code).val();
              //queryString = 'action:"'+action+'" , code:"'+ product_code+'" , quantity:"'+$("#qty_"+product_code).val()+'"';

              queryString = "action:'add',code:'2',quantity:'1'";
            break;
            case "remove":
              queryString = 'action='+action+'&code='+ product_code;
            break;
            case "empty":
              queryString = 'action='+action;
            break;
          }  //
        }

       // queryString = $(this).serialize() + "&" + $.param(queryString);

        jQuery.ajax({
        type: "POST",
        url: "addToCart.php",
        data: {action:action,code:product_code,quantity:'1'},   //action:"add",code:"2",quantity:"1"
        success:function(data){
          //var data ="<div><button> Test </button> <?php if(isset($_SESSION['cart_item'])) { echo 'Heeereeee'; foreach ($_SESSION['cart_item'] as $item){ ?> <tr> <td><strong><?php echo $item['name']; ?></strong></td> <?php } }?> </div> ";
          $("#test").html(data);
          //alert(queryString);
          //alert(data);
          if(action != "") {
            switch(action) {
              case "add":
                $("#add_"+product_code).hide();
                $("#added_"+product_code).show();
              break;
              case "remove":
                $("#add_"+product_code).show();
                $("#added_"+product_code).hide();
              break;
              case "empty":
                $(".btnAddAction").show();
                $(".btnAdded").hide();
              break;
            }  
          }
        },
        error:function (){}
        }); 
      }


 jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        //alert("pluuuuuuuuus");
        e.preventDefault();

        //var qtyid = $(".qty").val();

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
            $('input[name='+fieldName+']').val(1);
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
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });

  /*  var productCartName = document.getElementById('productCartPrice').val();
    var qty = document.getElementById('qty').val();
    var totalOneproductPrice = $productCartPrice * $qty;
    document.getElementById('totalOneproductPrice').value() = $totalOneproductPrice;  */

  });

</script>

<?php
if(isset($_REQUEST["confirmOrder"]))
{
  include('lib/dal.php');

     $result = new Order();

      //$result->orderTime = date() ; 
      //echo $_POST["confirm-product-notes"]

     if($_SESSION["customerId"] ==1)
       {
         $customerId = $_POST["customerId"];
         //echo $customerId ."Admin";
       }
       else
       {
          $customerId = $_SESSION["customerId"];
           //echo $customerId;
       }

      $result->orderNotes = $_POST["confirm-product-notes"]; 
      $result->orderStatus = "Processing"; 
      $result->customerId = $customerId; 
                 
      $order = DAL::getOrders()->insert($result);


    foreach($_SESSION['cart_items'] as $id=>$value){
               
      $addedProducts = DAL::getProducts()->selectOneById($id);

      $adPId = $addedProducts->productId ; 
      $adPName = $addedProducts->productName;
      $adPPrice = $addedProducts->productPrice;

      $ord = DAL::getOrders()->selectAll();

      foreach ($ord as $orderr) {
        $orderId = $orderr->orderId;
      }

      $quantity = $_POST[$id];
      $totalPrice = $quantity * $adPPrice;
      $results = new OrderDetail(); 

      /*echo $id."                    ";
      echo $adPId."                    ";
      echo $_POST[$id]."              ";
      echo $adPPrice."              ";
      echo $orderId."              ";*/

      $results->orderDetailProductQuantity = $quantity; 
      $results->orderDetailUnitPrice = $adPPrice; 
      $results->orderDetailTotalPrice = $totalPrice;
      $results->productId = $adPId;
      $results->orderId = $orderId; 

      $orderDetailss = DAL::getOrderDetails()->insert($results);

    }

    if($order && $orderDetailss){
      echo "<script> alert('Your order has been sent successfully'); </script>";
      unset($_SESSION['cart_items']);
    }
    else{
      echo "<script> alert('Your order has not been sent successfully'); </script>";
    }
}
?>

</body>
</html>
<?php } ?>
