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
  include('lib/dal.php');
  include('lib/deleteUser.php'); 
   include('nav.php');
?>


<div class="container">
<a <span class="pull-right" href="newUser.php">Add new user</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Room</th>
 	      <th>Image</th>
        <th>Ext</th>
	      <th>Action</th>
      </tr>
    </thead>
    <tbody>
   
    <?php
        $users = DAL::getCustomers()->selectAll();
      if($users){
        foreach($users as $usr)
        {
          $uId = $usr->customerId ; 
          $uName = $usr->customerName ; 
          $uIm = $usr->customerImage;
          $roomId = $usr->roomId;
          $uExt = $usr->customerExtension;

          $room = DAL::getRooms()->selectOne($roomId);

          $rNumber = $room->roomNumber;
      ?>
      <tr>	
      	<td><?php echo $uName; ?></td>
      	<td><?php echo $rNumber; ?></td>
        <td><img src="images/profile/<?php echo $uIm; ?>" width="30px" height="30px" alt="Product" name="Product"></td>
        <td><?php echo $uExt; ?></td>
        <td>
          <?php if($uId !=1)
          {
            ?>
          <a href="users.php?id=<?= $uId ?>">Edit</a> 
          <a href="users.php?id=<?= $uId ?>">Delete</a>
            <?php } ?>
        </td>
      </tr>
      <?php }}
        else{
              echo "<div class='alert alert-info'>";
                  echo "No Users To Show!";
              echo "</div>";
          }

       ?>
      
    </tbody>
  </table>
  <span style="color:green;"><?php echo $addSuccess; ?></span>
</div>

</body>
</html>

<?php } ?>