<?php
class OrderCheck
{  
   
   function check_orders($value,$user,$from,$to)
   {
	global $obj;
	if($user==false&& $from==false)
	{
		//echo "All";
	$result=$obj->dbselect('customers, orders, order_details',array('customers.*','SUM( order_details_total_price ) as total'),'WHERE customers.customer_id >1
	AND customers.customer_id = orders.customer_id and orders.order_id = order_details.order_id
	GROUP BY customers.customer_id');
    }
    else if($user==false  && ($from!=false && $to !=false))
     {
     	//echo "dateAll";
    $result=$obj->dbselect('customers, orders, order_details',array('customers.*','SUM( order_details_total_price ) as total'),'WHERE customers.customer_id >1
	AND customers.customer_id = orders.customer_id and orders.order_id = order_details.order_id and order_time between "'.$from.'" and "'.$to.'"
	GROUP BY customers.customer_id');
     }
    else if($user!=false  && $from!=false && $to !=false){
    	//echo "user";
    $result=$obj->dbselect('customers, orders, order_details',array('customers.*','SUM( order_details_total_price ) as total'),'WHERE customers.customer_id ='.$user.'
	AND customers.customer_id = orders.customer_id and orders.order_id = order_details.order_id and order_time between "'.$from.'" and "'.$to.'"
	GROUP BY customers.customer_id');
    }
    else
    {
    	//echo "else";
	$result=$obj->dbselect('customers, orders, order_details',array('customers.*','SUM( order_details_total_price ) as total'),'WHERE customers.customer_id ='.$user.'
	AND customers.customer_id = orders.customer_id and orders.order_id = order_details.order_id
	GROUP BY customers.customer_id');
}
    

	$tbl="<table class='table table-hover'><th colspan='2'>Name</th><th>Total</th>";
	
	foreach($result as $row) {
		$tbl.="<tr><td><a id='show' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus'href='#tr".$row['customer_id']."' data-toggle='collapse'></a></td><td>". $row['customer_name'] . "</td><td>". $row['total'] . " EGP</td></tr>";

		$entriesres = $obj->dbselect('orders, order_details',array('orders.*','SUM( order_details_total_price ) as total'),"WHERE customer_id = " . $row['customer_id'].
		" and orders.order_id = order_details.order_id GROUP by orders.order_id ORDER BY order_time DESC");

		$tbl.= "<tr class='collapse' id=tr".$row['customer_id']." ><td colspan='3'><div id=".$row['customer_id']." ><ul>";
		foreach($entriesres  as $entriesrow  ) {
			$tbl.= "<li style='width:50%; list-style:none;'>
			<a id='desc' style='color:pink;decoration:none;' class='glyphicon glyphicon-plus' href='#tr".$entriesrow['order_id']."' data-toggle='collapse' aria-expanded='true'></a>
			".$entriesrow['order_time']."&nbsp;&nbsp;&nbsp;&nbsp;".$entriesrow['total'] ." EGP
			 <a href='orders.php?eId=". $entriesrow['order_id'] ."'>Deliver</a>
          </li>";

			$itemsres =$obj->dbselect('products, order_details, orders',array('products.*','orders.*','order_details.*'),
              
		    " WHERE orders.order_id =".$entriesrow['order_id']."
			AND products.product_id = order_details.product_id
			AND orders.order_id = order_details.order_id");

			$tbl.= "<div><ul class='collapse' id=tr".$entriesrow['order_id'].">";
			foreach($itemsres as $itemsrow) {
			$tbl.= "<li>". $itemsrow['product_name']."&nbsp;&nbsp;&nbsp;".$itemsrow['order_details_unit_price'] ." EGP &nbsp;&nbsp; Quantity: ".$itemsrow['order_details_product_quantity']."</li>";

			}$tbl.= "</ul></div>";
		}$tbl.= "</ul></div></td></tr>";
	}
	echo $tbl."</table>" ;  //.$this->displayPager($obj->get_effected_number());	 
   }

   
    function displayPager($numRow){
	  $links="<div><";
	  $p=1;
	  for($x=1;$x<=$numRow;$x+=4)
	     {
		    $links.="|<a href='checks.php?from=$x'>$p</a>";
			$p++;
		 }
		 return $links."|></div>";
	}   
	
	
	function getAllUsers()
	{
		global $obj;
	    $result=$obj->dbselect('customers',array('customers.*'),'WHERE customers.customer_id >1');
		echo "<option> </option>";
		foreach($result as $row)
	    echo "<option value='".$row['customer_id']."'>".$row['customer_name']."</option>";
	}
		
}

?>






