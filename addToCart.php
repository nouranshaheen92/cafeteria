<?php
session_start();

include('lib/dal.php');
 
 if(!empty($_POST["action"])) {

      switch($_POST["action"]) {
        case "add":
     		//echo $_POST["action"] ;
            //echo $_POST["code"] ;
            
            $productByCode = DAL::getProducts()->selectOneById($_POST["code"]);

            $adPId = $productByCode->productId ; 
            $adPName = $productByCode->productName;
            $adPPrice = $productByCode->productPrice;
              //echo $adPName;

            //$itemArray = array($adPId=>array('name'=> $adPName, 'code'=>$adPId, 'quantity'=>$_POST["quantity"], 'price'=>$adPPrice));

            if(!isset($_SESSION['cart_item'])){
                  $_SESSION['cart_item'] = array();
            }
            
            if(array_key_exists($adPId, $_SESSION['cart_item'])){
			    //Product Exist
			}
			
			else{
			    $_SESSION['cart_items'][$adPId]=$adPName;
			}

            
			/*
            if(!empty($_SESSION["cart_item"])) {
            	echo count($_SESSION["cart_item"]);
              if(in_array($adPId,$_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($adPId == $k)
                      $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                }
              } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
              }
            } else {
              $_SESSION["cart_item"] = $itemArray;
              //echo "INNNNN";
            }
            */
          
        break;
        case "remove":
        //echo $_POST["code"]."here";
          /*if(!empty($_SESSION["cart_item"])) {
          	$idRemove = $_POST["code"]; 
          	echo $idRemove ;
          	echo $_SESSION["cart_item"][$idRemove]["code"];
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($_POST["code"] == $k["code"])
                { unset($_SESSION["cart_item"][$idRemove]); echo $_POST["code"];}
                if(empty($_SESSION["cart_item"]))
                  unset($_SESSION["cart_item"]);
            }
          }*/
          
          	$idRemove = $_POST["code"]; 
          		//echo $idRemove ;
          	unset($_SESSION['cart_items'][$idRemove]);
         
        break;
        case "empty":
          unset($_SESSION["cart_item"]);
        break;    
      }
    }


?> 

 <?php
              if(!isset($_SESSION['cart_items'])){
                  $_SESSION['cart_items'] = array();
              }

              $action = isset($_POS['action']) ? $_POST['action'] : "";
              //$name = isset($_GET['name']) ? $_GET['name'] : "";
               
              if($action=='removed'){
                  echo "<div class='alert alert-info'>";
                      echo "<strong>{$name}</strong> was removed from your cart!";
                  echo "</div>";
              }
               
              /*else if($action=='quantity_updated'){
                  echo "<div class='alert alert-info'>";
                      echo "<strong>{$name}</strong> quantity was updated!";
                  echo "</div>";
              }*/
               
              if(count($_SESSION['cart_items'])>0){
                  if($_SESSION["customerId"] ==1)
                  {
                ?>

                <div class="form-group">
                  <label class="control-label col-sm-3" for="room">Customer:</label>
                  <div class="col-sm-9">
                    <select class="form-control MB" name="customerId" id="customerId">
                      <?php
                     $users = DAL::getCustomers()->selectAll();
      
                      foreach($users as $usr)
                      {
                        $cstId = $usr->customerId ; 
                        $cstName = $usr->customerName ; 
                      ?>
                      <option value="<?php echo $cstId; ?>"><?php echo $cstName; ?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>
                </div>
                
                <?php
                  }
                  // get the product ids
                  $ids = "";
                  echo "<table class='table table-hover table-responsive table-bordered'>";
               
                      // our table heading
                      echo "<tr>";
                          echo "<th class='textAlignLeft'>Product Name</th>";
                          echo "<th>Quantity</th>";
                          echo "<th>Price</th>";
                          echo "<th>Action</th>";
                      echo "</tr>";
                        $total_price=0;

                  foreach($_SESSION['cart_items'] as $id=>$value){
               
                      $addedProducts = DAL::getProducts()->selectOneById($id);

                        $adPId = $addedProducts->productId ; 
                        $adPName = $addedProducts->productName;
                        $adPPrice = $addedProducts->productPrice;  //product price
                          
                          ?>
                        <tr>
                          <td><?= $adPName ?></td>
                          <td class="pQuntAdd">
                            <input type='button' value='-' class='qtyminus' field='<?= $adPId ?>' />
                            <input type='text' name='<?= $adPId ?>' value='1' class='qty' />
                            <input type='button' value='+' class='qtyplus' field='<?= $adPId ?>' />
                          </td>
                          <td><?= $adPPrice ?> LE</td>
                          <td><a onClick="cartAction('remove','<?php echo $adPId; ?>')" class="btn btn-danger"><span class='glyphicon glyphicon-remove'></span> </a></td>
                        </tr>
                        <?php
               
                          	$total_price = $total_price + $adPPrice;
                    
                    		}
                 		 ?>
                    <tr>
                        <td></td>
                        <td><b>Total</b></td>
                        <td><?= $total_price?> LE</td>
                              
                    </tr>
               
                  </table>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Notes:</label>
                    <div class="col-sm-10">
                      <textarea class="form-control MB" type="text" name="confirm-product-notes" value=""></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="room">Room:</label>
                    <div class="col-sm-10">
                      <select class="form-control MB" name="room" id="room">
                        <?php
                        $rooms = DAL::getRooms()->selectAll();
                      
                        foreach($rooms as $rm)
                        {
                          $rId = $rm->roomId ; 
                          $rmNumber = $rm->roomNumber;
                        ?>
                        <option value="<?php echo $rId; ?>"><?php echo $rmNumber; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <button id="addProductB" type="submit" name="confirmOrder" class="btn btn-default confirm-order"> 
                    CONFIRM ORDER 
                  </button>

                  <?php
              }
               
              else{
                  echo "<div class='alert alert-danger'>";
                      echo "<strong>No products found</strong> in your cart!";
                  echo "</div>";
              }

            ?>





              <script type="text/javascript">


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
				        if (!isNaN(currentVal) && currentVal > 0) {
				            // Decrement one
				            $('input[name='+fieldName+']').val(currentVal - 1);
				        } else {
				            // Otherwise put a 0 there
				            $('input[name='+fieldName+']').val(1);
				        }
				    });

				  });

			</script>



