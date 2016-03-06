<?php  

include('classes2/db_selects.php'); 

$total_basket = 0;
if(!isset($_REQUEST["logout"]))

session_start();
else
session_destroy();

if(isset($_REQUEST["confirmOrder"]))
{
	$numberoforder=-1;
	$_SESSION['numberoforder']=-1;
	$_SESSION['orders']=[]; 
	
}

// Store Session Data
if(isset($_SESSION['customerName']))
{
	$customerName=$_SESSION["customerName"];
	$customerPassword=$_SESSION["customerPassword"];
	$customerId=$_SESSION["customerId"];
}
if(isset($_POST["customerName"]))
{
	$customerName=$_POST["customerName"];
	$customerPassword=$_POST["customerPassword"];

	$customerObj=new db_selects();
	$customer_result=$customerObj->authtiate($customerName,$customerPassword);
	if(isset($customer_result["customer_name"])  )
	{
		$_SESSION['customerName']=$customerName;
		$_SESSION['customerPassword']= $customerPassword;
		$_SESSION['numberoforder']=-1;
		$_SESSION['customerId']= $customer_result["customer_id"];
	}
	else 
	{
		session_destroy(); 
	}
  
}


if(isset($_REQUEST["product-name"]))
{

$_SESSION['numberoforder']=$_SESSION['numberoforder']+1;
$numberoforder=$_SESSION['numberoforder'];
$_SESSION['orders'][$numberoforder]["product-name"]=$_REQUEST["product-name"];
$_SESSION['orders'][$numberoforder]["product-id"]=$_REQUEST["product-id"];
$_SESSION['orders'][$numberoforder]["product-price"]=$_REQUEST["product-price"];
$_SESSION['orders'][$numberoforder]["unit"]=$_REQUEST["unit"];
$_SESSION['orders'][$numberoforder]["product-quantity"]=$_REQUEST["product-quantity"];
 	 echo "<script>window.location = 'index.php';</script>";
	 
		  
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="description" content=" "   />
    <meta name="keywords" content=" "   />
	<title>Thimar</title>
	<link rel="shortcut icon" href="images" />
    
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="BS-css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style/jcarousel.responsive.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
    
    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="js/jcarousel.responsive.js"></script>
    <script type="text/javascript" src="BS-js/bootstrap.js"></script>
 	
    <!--[if lt IE]>
    <style>
    .image-res {height: auto !important; width: 100% !important; overflow: hidden; position: absolute; margin:auto; display:block; left: 0; top:0; right:0; left:0; text-align: center;}
    </style>
    <![endif]-->
   
</head>

<body>

<?php  include('dal.php'); ?>
 

<nav class="navbar nav0 navbar-fixed-top" > 
 <div class="container">     
    <div class="navbar-header thimar-logo">
      <img class="navbar-brand thimar" alt="Thimar" name="Thimar" src="images/logo.png"/> 
    </div>
       
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group search-div has-feedback">
          <input type="text" class="form-control search-input" placeholder="Search">
          <button type="submit" class="search">
          <span class="glyphicon glyphicon-search form-control-feedback"></span></button>
        </div>
      </form>
    
      <ul class="nav navbar-nav toll">
        <li><a>Call: <span class="li-grey">+966 50 748 9995</span></a> </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <span class="glyphicon glyphicon-user user"></span><span class="li-grey" >My Account</span>		
        <span class="caret"></span></a>
             <ul class="dropdown-menu" role="menu">
          	<li>
            	<a class="text-center" href="#">
            		<img class="img-circle" alt="Profile" name="Profile" src="images/profile-img.jpg"/>  
            	</a> 
            </li>
            <li><a href="logout.php">Log Out</a></li>
            <?php if( isset($_SESSION["customerName"])) { ?>
            <li><p class="text-center"><?php echo $_SESSION["customerName"]; ?></p></li>
          	<li class="divider"></li>
            <li><a href="#">Acoount Setting</a></li>
            <li><a href="order-history.php">Orders History</a> </li>
            <li><a href="#">Complain</a> </li>
			<li><a href="logout.php">Log Out</a></li>
			
			<?php } else { ?>
            <li><p class="text-center">User Login</p></li>
          	<li class="divider"></li>
			<li> 
                <form action="index.php" method="post" >
                    <input type="text" name="customerName" id="customerName" placeholder="User Name" >
                    <input type="password" name="customerPassword" id="customerPassword" placeholder="Password">
                    <input type="submit" value=" login " class="btn btn-default login">
                </form>
			 </li> 
              
			 <?php } ?>
			
          </ul>
    </li>
      </ul>
     
  </div>
 
</nav>

<section class="patern0">
	<div class="container pat0">
		<img class="logo" alt="Thimar" name="Thimar" src="images/logo.png" />
    </div>
</section>
    

<nav class="nav1" id="menu">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav1"> 
      <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse none" id="nav1">
      <ul class="nav navbar-nav main-menu">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a> </li>
        <li><a href="fruits.php">Fruits</a> </li>
        <li><a href="vegetables.php">Vegetables</a> </li>
        <li><a data-toggle="tab" href="#aboutUs">About Us</a> </li>
        <li><a data-toggle="tab" href="#contactUs">Contact Us</a> </li>
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right basket-menu">
        <li class="dropdown"> 
        <a href="#" class="dropdown-toggle basket" data-toggle="dropdown" role="button" aria-expanded="false">
        <span class="glyphicon glyphicon-shopping-cart user"></span><span class="li-white" >Basket (<?php if(isset($_SESSION['numberoforder']) && $_SESSION['numberoforder']>=0) echo $_SESSION['numberoforder']+1; else echo "0"?>)</span> 		
        <span class="caret"></span></a>
          <ul class="dropdown-menu basket-ul" role="menu">
            <li><a><p class="li-hi">
            	<span class="cart-pro bold">Your Chipping cart</span></p>
            	</a> 
            </li>
            <?php 
			if(isset($_SESSION['numberoforder']) && isset($_SESSION['customerName'])) 
			for($i=0;$i<=$_SESSION['numberoforder'];$i++)
				
				{
			?>
			
          	<li class="divider no-marg"></li>
            
          	<li><a><p class="li-hi">
            	<span class="cart-pro"><?php echo $_SESSION['orders'][$i]["product-name"]; ?></span>
               <span class="red cart-pri"><?php echo $_SESSION['orders'][$i]["product-quantity"]."×".$_SESSION['orders'][$i]["product-price"]; ?></span></p>
                </a>	
            </li>
			<?php 
				$total_basket+=$_SESSION['orders'][$i]["product-quantity"]*$_SESSION['orders'][$i]["product-price"];
				}
			?>
             
            
            <li><a><p class="li-hi">
          <a href='order.php#shopping-cart'> <button class="btn btn-default checkout" >Chech Out</button></a>
                <span class="cart-pri">Total: <span class="bold"><?= $total_basket ?></span></span></p>
                </a>
            </li>
            
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<section class="tab-content">
<div id="home" class="tab-pane fade in active">
<div class="container-fluid oandn slider">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-pad">
        <div id="carousel1" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#carousel1" data-slide-to="0" class="active"> </li>
            <li data-target="#carousel1" data-slide-to="1" class=""> </li>
            <li data-target="#carousel1" data-slide-to="2" class=""> </li>
          </ol>
          <div class="carousel-inner">
            <div class="item"> <img class="img-responsive" src="images/100.jpg">
              <div class="carousel-caption"> Carousel caption 1. 
              		Here goes slide description. Lorem ipsum dolor set amet. </div>
            </div>
            <div class="item active"> <img class="img-responsive" src="images/door.jpg">
              <div class="carousel-caption"> Carousel caption 2. 
              		Here goes slide description. Lorem ipsum dolor set amet. </div>
            </div>
            <div class="item"> <img class="img-responsive" src="images/any.jpg">
              <div class="carousel-caption"> Carousel caption 3. 
              		Here goes slide description. Lorem ipsum dolor set amet. </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel1" data-slide="prev"><span class="icon-prev"></span></a> 
          <a class="right carousel-control" href="#carousel1" data-slide="next"><span class="icon-next"></span></a>
          </div>
      </div>
   </div>
</div>

<section class="fresh-slide">
    <div class="container fresh">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h2 class="HW">Fresh products from our store</h2>
    		<div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/tomato.jpg" alt="Thumbnail Image 1" class="image-res">
                                	<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/cucumbers.jpg" alt="Thumbnail Image 1" class="image-res">
									<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/figs.jpg" alt="Thumbnail Image 1" class="image-res">
                                 	<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/berry.jpg" alt="Thumbnail Image 1" class="image-res">
                                 	<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/tomato.jpg" alt="Thumbnail Image 1" class="image-res">
                                    <p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/tomato.jpg" alt="Thumbnail Image 1" class="image-res">
                                 	<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                        <li>
                        	<div class="thumbnail slide-thumb"> 
                            	<div class="img-thumbnail img-thumb">
                            		<img src="images/tomato.jpg" alt="Thumbnail Image 1" class="image-res">
                                 	<p class="chart"><a href="#" class="btn btn-default add-chart" role="button">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                                          Add to Cart</a></p>
                                    <p class="price XY"><span class="price-no">120 </span>SAR</p>
                                </div>
                                <div class="caption mod-caption">
                                    <h3 class="HO">Product Name</h3>
                                    <p>Available: All the year</p>
                                    <p>Type of Selling: KG & Carton.</p>
                                </div>
							</div>
                        </li>
                    </ul>
                </div>
            
                <a href="#" class="jcarousel-control-prev"></a>
                <a href="#" class="jcarousel-control-next"></a>
            
                <p class="jcarousel-pagination"></p>
            </div>


          </div>
       </div>
    </div>
</section>

<section class="new-product">
<div class="container new-pro">
  <h2 class="HB">New Products</h2>
  <div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 none">
          <div class="thumbnail upper-thumb"> 
            <div class="img-thumbnail img-upper">
                <img src="images/figs.jpg" alt="Thumbnail Image 1" class="image-res">
                    <div class="pc-XY">
                        <p class="price price-xy"><span class="price-no">420 </span>SAR</p>
                        <p class="chart-xy"><a href="#" class="btn btn-default add-chart" role="button">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                          Add to Cart</a></p>
                    </div>
            </div>        
          </div>
       </div>
       <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 none">
          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 PR">
              <div class="thumbnail down-thumb"> 
                <div class="img-thumbnail img-down">
                    <img src="images/cucumbers.jpg" alt="Thumbnail Image 1" class="image-res">
                        <div class="pc-XY">
                            <p class="price price-xy"><span class="price-no">420 </span>SAR</p>
                            <p class="chart-xy"><a href="#" class="btn btn-default add-chart" role="button">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                              Add to Cart</a></p>
                        </div>
                </div>
                <div class="caption new-caption">
                    <h3 class="HON">Product Name</h3>
                    <p>Available: All the year</p>
                    <p>Type of Selling: KG & Carton.</p>
                </div>                 
              </div>
           </div>
           <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 HPLR">
              <div class="thumbnail down-thumb"> 
                <div class="img-thumbnail img-down">
                    <img src="images/berry.jpg" alt="Thumbnail Image 1" class="image-res">
                        <div class="pc-XY">
                            <p class="price price-xy"><span class="price-no">420 </span>SAR</p>
                            <p class="chart-xy"><a href="#" class="btn btn-default add-chart" role="button">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                              Add to Cart</a></p>
                        </div>
                </div>
                <div class="caption new-caption">
                    <h3 class="HON">Product Name</h3>
                    <p>Available: All the year</p>
                    <p>Type of Selling: KG & Carton.</p>
                </div>                 
              </div>
           </div>
           <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 PL">
              <div class="thumbnail down-thumb"> 
                <div class="img-thumbnail img-down">
                    <img src="images/cucumbers.jpg" alt="Thumbnail Image 1" class="image-res">
                        <div class="pc-XY">
                            <p class="price price-xy"><span class="price-no">420 </span>SAR</p>
                            <p class="chart-xy"><a href="#" class="btn btn-default add-chart" role="button">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                              Add to Cart</a></p>
                        </div>
                </div>
                <div class="caption new-caption">
                    <h3 class="HON" id="All">Product Name</h3>
                    <p>Available: All the year</p>
                    <p>Type of Selling: KG & Carton.</p>
                </div>                 
              </div>
           </div>
       </div>
    </div>
    
    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
      <div class="thumbnail delivery-thumb"> 
		<div class="img-thumbnail img-delivery">
			<img src="images/delivery.jpg" alt="Thumbnail Image 1" class="image-res">
			<p class="delivery-caption">Your local veg team will deliver <span class="del-no">Free</span></p>
		</div>                
	  </div>
      
    </div>
    
  </div>

 
</div>
</section>
  
<div class="container patern1" id="AllProducts">
  <nav class="letters row">
  	<div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active all"><a href="index.php#All">All</a></li>
            <li><a href="?se=a&#All">A</a></li>
            <li><a href="?se=b&#All">B</a></li>
            <li><a href="?se=c&#All">C</a></li>
            <li><a href="?se=d&#All">D</a></li>
            <li><a href="?se=e&#All">E</a></li>
            <li><a href="?se=f&#All">F</a></li>
            <li><a href="?se=g&#All">G</a></li>
            <li><a href="?se=h&#All">H</a></li>
            <li><a href="?se=i&#All">I</a></li>
            <li><a href="?se=j&#All">J</a></li>
            <li><a href="?se=k&#All">K</a></li>
            <li><a href="?se=l&#All">L</a></li>
            <li><a href="?se=m&#All">M</a></li>
            <li><a href="?se=n&#All">N</a></li>
            <li><a href="?se=o&#All">O</a></li>
            <li><a href="?se=p&#All">P</a></li>
            <li><a href="?se=q&#All">Q</a></li>
            <li><a href="?se=r&#All">R</a></li>
            <li><a href="?se=s&#All">S</a></li>
            <li><a href="?se=t&#All">T</a></li>
            <li><a href="?se=u&#All">U</a></li>
            <li><a href="?se=v&#All">V</a></li>
            <li><a href="?se=w&#All">W</a></li>
            <li><a href="?se=x&#All">X</a></li>
            <li><a href="?se=y&#All">Y</a></li>
            <li><a href="?se=z&#All">Z</a></li>
          </ul>
       </div>
    </nav>
   
   
   <div class="row MB">
   <?php
			$lt= $pId = $uId = $uName = $pIm = "";  
			if(isset($_REQUEST['se']) && !empty($_REQUEST['se']))
			{
				$lt=$_REQUEST['se'];
				
						$lim=0;
							if(isset($_REQUEST["lim"]))
							{
								$lim=$_REQUEST["lim"]	;
							}
				$products = DAL::getProducts()->SelectAllByLetter($lt,$lim);
			} 
			else
			{
				$lim=0;
							if(isset($_REQUEST["lim"]))
							{
								$lim=$_REQUEST["lim"]	;
							}
				$products = DAL::getProducts()->SelectAll($lim);
			}
				foreach($products as $pro)
				{
					$pId = $pro->productId ; 
					$pIm = $pro->productImage;
					$proPrice = $pro->productBasicPrice;
				
					$units = DAL::getProductUnits()->selectOne($pId);
					
					$uId = $units->unitId;
					$unitName = DAL::getUnits()->selectOne($uId);
					$uName = $unitName->unitName ; 
				
   ?>
  
    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 PB">
      <div class="thumbnail down-thumb"> 
		<div class="img-thumbnail img-down">
			<img src="uploads/<?= $pro->productImage ?>" alt="<?= $pro->productImage ?>" class="image-res">
			<?php 
            if(isset($_SESSION['numberoforder']) && isset($_SESSION['customerName']))
			{
				$customer_name = $_SESSION['customerName'];
				
					$customer = DAL::getCustomers()->selectOne($customer_name);
					$levelId = $customer->levelId;
					$level = DAL::getCustomerLevels()->selectOne($levelId);
					$percertage = $level->levelPercentage;
					
					$price = $proPrice *(1+($percertage/100));
			?>
            <div class="pc-XY">
				<p class="price-pro price-xy"><span class="price-no"><?= $price ?></span>SAR</p>
				<p class="chart-xy">
					<a href="#addToCart<?= $pro->productId ?>" class="btn btn-default add-chart" role="button">
				<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
					  Add to Cart</a>
               </p>
                     
			</div>
            <?php } else { ?>
		    <div class="pc-XY">
				<p class="chart-xy">
					<a href="#" class="btn btn-default add-chart" role="button" 
                    	onClick="alert('you should login first');">
				<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
					  Add to Cart</a>
               </p> 
			</div>
            <?php } ?>	
		</div>
		<div class="caption pro-caption">
			<h3 class="HON"><?= $pro->productName ?></h3>
			<p><?= $pro->productAvailable ?></p>
			<p>Type of Selling: <?= $uName ?></p>
		</div>                 
	  </div>
    </div>
    <form method="POST" name="index.php">
   <div id="addToCart<?= $pro->productId ?>" class="addToCart col-sm-7 col-md-5 col-lg-5 col-xs-7">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
    	<div class="img-thumbnail img-down col-sm-6 col-md-6 col-lg-6 col-xs-6">
			<img src="uploads/<?= $pro->productImage ?>" alt="<?= $pro->productImage ?>" class="image-res">
		</div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        	<input type='hidden' id='se' name='se'  value=<?php echo $lt; ?> />
            <input type='hidden' id='lim' name='lim'  value=<?php echo $lim; ?> />
            <input type='hidden' id='product-id' name='product-id'  value='<?php echo $pro->productId; ?>'/>
        	
            <div class="form-group no-marg-bot">
				<input class="pName input-sm" type="text" id="product-name" name="product-name" 
            		value='<?= $pro->productName ?>' readonly/>
			</div>
        	<div class="form-group">
			<input class="pAvail input-sm" type="text" id="product-available" name="product-available" 
            		value="<?= $pro->productAvailable ?>" readonly/> 
			</div>
                  
			<div class="form-group">
                <select class="pUnit input-sm" id="unit" name="unit">
                    <?php
                        $pId = $pro->productId;
                        $units = DAL::getProductUnits()->selectOne($pId);
                        $uId = $units->unitId;
                        $unitName = DAL::getUnits()->selectOne($uId);
                        $uName = $unitName->unitName;
                    ?>
                    <option value='<?= $uName ?>'> <?= $uName ?> </option>
                </select>
            </div>
            <div class="form-group">
           		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="pPrice input-sm" type="text" id="product-price" name="product-price" 
            		value="<?php echo $price ?> " readonly/>
                </div>
			    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="pPrice1 input-sm" type="text" id="product-price" name="product-price" 
            		value="<?php echo " SAR "?>" readonly/>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <input class="pPrice2 input-sm" type="text" id="product-price" name="product-price" 
            		value="<?php echo " /".$uName ?>" readonly/>
                </div>
			</div> 
            
		</div>
	  </div>
      <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 pQuntAdd">
        <input type='button' value='-' class='qtyminus' field='quantity' />
        <input type='text' name='quantity' value='0' class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity' />
         
      <!--<input class="pquantity" type="text" min="1" id="product-quantity" name="product-quantity" value="1"/>-->
                    
        <p class="chart-xy"><input type="submit" class="btn btn-default add-chart" value="Add to Cart">
				<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
		</p>
      </div>
    </div>
   </form>
    <?php
			}
	?>
    
     
    
    </div>
  
  
  <nav class="text-center">
    <!-- Add class .pagination-lg for larger blocks or .pagination-sm for smaller blocks-->
    <ul class="pagination padger">
<?php	if($lim>0){ ?>
      <li> <a href="index.php?lim=<?php echo $lim-16;  ?>&se=<?php echo $lt ;?>" > <span aria-hidden="true">Previous</span> </a> </li>
<?php } else { ?>

      <li>  <span aria-hidden="true">Previous</span>   </li>
<?php }  ?>

	  
		<?php
		$db_fns=new db_selects();
		$total= $db_fns->countproducts($lt);	
for($i=0;$i<$total/16;$i++)		
{
	$lm=$i*16;
	if($i==$lim/16)
	echo " <li class='active'><a href='index.php?lim=".$lm."&se=".$lt."'>".($i+1)."</a></li>";
else
	echo " <li ><a href='index.php?lim=".$lm."&se=".$lt."'>".($i+1)."</a></li>";
	
}  
		?>
    <?php	if($lim+16 < $total){ ?>
	
      <li> <a href="index.php?lim=<?php echo $lim+16;  ?>&se=<?php echo $lt ;?>" > <span aria-label="Next"> <span aria-hidden="true">Next</span> </a> </li>
<?php } else { ?>

      <li>   <span aria-hidden="true">Next</span>   </li>
<?php }  ?>

    </ul>
  </nav>
  <!--<div class="patern1">
	<div class="container pat1"></div>
</div>-->
</div>


<div id="fruits" class="tab-pane fade in active"></div>
</div>
</section>

<footer>
    <div class="container">
    	<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 phone-p">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<p class="FHW"><span class="FHO">Get Social </span>Follow Us<br>
                	you can follow us on your favorite social network</p>
            </div>
                           
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<a class="contacts" href="">
                	<img class="contacts-img" alt="Facebook" name="Facebook" src="images/contacts/fb.png" />
                </a>
                <a class="contacts" href="">
                	<img class="contacts-img" alt="Twitter" name="Twitter"  src="images/contacts/TW.png" />
                </a>
                <a class="contacts" href="">
                	<img class="contacts-img" alt="Google+" name="Google+"  src="images/contacts/GP.png" />
                </a>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	 <p class="powered">Powerded by</p>
            	<a class="ME" href="http://multieng.net/">
                	<img class="ME" alt="Multi-Engineering" name="ME" src="images/ME-white.png" />
                </a>
            </div>
		</div> 
       <form role="form" action="#" method="post">
        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 phone-p">
        	<div class="form-group">
        		<p class="FHW"><span class="FHO">Contact Us </span>Any Time 24/7 </p>
            </div>
        	<div class="form-group">
            	<input type="text" class="form-control nem" name="name" placeholder="Your Name" required>
                <!--<span class="error"> <?php echo $nErr;?></span>-->
            </div>
            <div class="form-group">
            	<input type="email" class="form-control nem"  name="mail" placeholder="Your Email" required>
                <!--<span class="error"> <?php echo $eErr;?></span>-->
            </div>        
            <div class="form-group">
		   		<textarea class="form-control msg" rows="5" name="message" placeholder="Your Message Type Here" required></textarea>
            	<!--<span class="error"> <?php echo $mErr;?></span>-->
            </div>                
            <div class="form-group">
            	<div class="submit">
                	<button type="submit" name="sendMail" class="send-bt">Submit</button>
                </div>
            </div>
		</div> 
       </form>
	</div>

</footer>

<script>

	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.thimar').fadeIn();
			$('.nav0').css("background","white");
		} 
		else {
 		   $('.thimar').fadeOut();
		   $('.nav0').css("background","#f3f3f3");
		}
	});
	
	
	var  mn = $(".nav1");
    ns = "nav1-scrolled";
    pat = $('.patern0').height() + $('.nav0').height();

	$(window).scroll(function() {
	  if( $(this).scrollTop() + 50 > pat ) {
		mn.addClass(ns);
	  } else {
		mn.removeClass(ns);
	  }
	});
	
	var  mn1 = $(".letters");
    ns1 = "nav1-scrolled_letters";
    pat1 = $('.patern0').height() + $('.nav0').height() + $('.nav1').height() + $('.new-product').height() 
	+ $('.fresh-slide').height() + $('.slider').height();

	$(window).scroll(function() {
	  if( $(this).scrollTop() + 140 > pat1 ) {
		mn1.addClass(ns1);
	  } else {
		mn1.removeClass(ns1);
	  }
	});
	
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
	/*
	
	$(document).ready(function()
{    

	var popups = $('.fadePrice');
	var i = 0;
	
	function next() {
		if (i >= popups.length)
			i = 0;
		popups.eq(i).fadeIn(300).delay(2500).fadeOut(300).delay(1000).queue(function(){
			next();
			$(this).dequeue();
		});
		i++;
	}


    $("div.fadePrice").hover(
      function () {
        $("p.price").fadeIn('slow');
      }, 
      function () {
        $("p.price").fadeOut('slow');
      }
    );
});
*/
</script>
<?php
if(isset($_REQUEST["confirmOrder"]))
{
	echo "<script> alert('Your order has been sent successfully'); </script>";
}
?>
</body>
</html>
