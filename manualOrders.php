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

<?php  
    include('lib/dal.php');
    include('lib/deleteOrder.php');
    include('lib/editOrder.php');
    include('nav.php');
 ?>


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
        $orders = DAL::getOrders()->selectAllByOrderStatus("Processing");
      
        foreach($orders as $ord)
        {
          $oId = $ord->orderId ; 
          $oTime = $ord->orderTime;
          $oNotes = $ord->orderNotes;
          $oStatus = $ord->orderStatus;
          $cId = $ord->customerId;

          if($cId){
          $customer = DAL::getCustomers()->selectOne($cId);

         
          $cName = $customer->customerName;
          $cExt = $customer->customerExtension;
          $rId = $customer->roomId;

          $room = DAL::getRooms()->selectOne($rId);

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
        <td>
           <a href="manualOrders.php?eId=<?= $oId ?>">Deliver</a> 
           <!--<a href="manualOrders.php?dId=<?= $oId ?>">Cancel</a>-->
        </td>
      </tr>
    </tbody>
    </table>

      <table class="table table-striped panel-collapse collapse" id="<?php echo $oId; ?>" >
      <tbody>  <tr>
      <?php
      
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
         // echo $pId;

          $product = DAL::getProducts()->selectOneById($pId);
          if($product){
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
     } }
    ?>
    </tr>
    </tbody>
    </table>
   

  <?php
    } 

  }
  ?>
    
    

</div>

  
  

</body>
</html>
<?php } ?>
