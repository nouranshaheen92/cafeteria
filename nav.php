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

<?php //if ($_Get["p"]="home") echo 'class="active"' ?>

        <li class="active"><a href="home.php">Home</a></li>
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
        <li><a href="manualOrders.php">All Orders</a></li>
        <li><a href="checks.php">Checks</a></li>
        <?php } ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>