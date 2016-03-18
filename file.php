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
                              name="confirm-product-price" value="<?php echo $_SESSION['orders'][$i]['product-price']?>" readonly/></td>  

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
                 /* jQuery(document).ready(function(){
                  $count = $("#numberoforder").val();
                  alert("$count");
                  for($i=0; $i<=$count; $i++){
                    $total-price = $("#confirm-product-price"+$i).val() * $("#confirm-product-quantity"+$i).val();
                  }

                  $("#price").html($count);*/
                </script>
              
            </table>