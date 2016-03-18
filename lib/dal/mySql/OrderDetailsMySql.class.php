<?php
	class OrderDetailsMySql
	{
		public function insert($orderDetail)
		{
			$sql = "INSERT INTO order_details
					(
						order_details_product_quantity,
						order_details_unit_price,
						order_details_total_price,
						product_id,
						order_id
					)
					VALUES
					(
						?, ?, ?, ?, ?
					)";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "iddii", 
								$orderDetail->orderDetailProductQuantity,
								$orderDetail->orderDetailUnitPrice,
								$orderDetail->orderDetailTotalPrice,
								$orderDetail->productId, 
								$orderDetail->orderId
								);
			
			if ($stmt->execute())
			{
				
				$result = $stmt->insert_id;
				
			}
			else
			{
				echo $stmt->error;
				$result = false;
			}
			$stmt->close();
			return $result;
		}
		
		public function update($orderDetail)
		{
			$sql = "UPDATE order_details
					SET
						order_details_product_quantity =?,
						order_details_unit_price =?,
						order_details_total_price =?,
						product_id,
						order_id = ?
					WHERE
						order_details_id = ?
					";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "iddiii",
								$orderDetail->orderDetailProductQuantity,
								$orderDetail->orderDetailUnitPrice,
								$orderDetail->orderDetailTotalPrice,
								$orderDetail->productId, 
								$orderDetail->orderId,
								$orderDetail->orderDetailId
								);
								
			if ($stmt->execute())
			{
				
				$result = true;
				
			}
			else
			{
				$result = false;
			}
			$stmt->close();
			return $result;
		}
		
		public function delete($order_details_id)
		{
			$sql = "Delete FROM order_details
					WHERE order_details_id = ?";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "i",
								$order_details_id);
			
			if ($stmt->execute())
			{
				
				$result = true;
				
			}
			else
			{
				$result = false;
			}
			$stmt->close();
			return $result;
		}

		/*public function deleteByOrderId($order_id)
		{
			$sql = "Delete FROM order_details
					WHERE order_id = ?";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "i",
								$order_id);
			
			if ($stmt->execute())
			{
				
				$result = true;
				
			}
			else
			{
				$result = false;
			}
			$stmt->close();
			return $result;
		}*/
		
		public function selectAll()
		{
			$sql = "SELECT *
					FROM order_details
					";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
					
			if ($stmt->execute())
			{
				$result = new OrderDetail();
				$stmt->bind_result( 
								$result->orderDetailId, 
								$result->orderDetailProductQuantity,
								$result->orderDetailUnitPrice,
								$result->orderDetailTotalPrice,
								$result->productId, 
								$result->orderId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new OrderDetail();
					//$new_record->clone($result);
					
					$new_record->orderDetailId = $result->orderDetailId;
					$new_record->orderDetailProductQuantity = $result->orderDetailProductQuantity;
					$new_record->orderDetailUnitPrice = $result->orderDetailUnitPrice;
					$new_record->orderDetailTotalPrice = $result->orderDetailTotalPrice;
					$new_record->productId = $result->productId;
					$new_record->orderId = $result->orderId;

					$result_array[] = $new_record;
				}
			}
			else
			{
				$result_array = array();
			}
			$stmt->close();
			return $result_array;
		}

		public function selectAllByCustomerId($customer_id)
		{
			$sql = "SELECT *
					FROM order_details
					WHERE customer_id = ?
					";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}

			$stmt->bind_param( "i",
								$customer_id);
					
			if ($stmt->execute())
			{
				$result = new OrderDetail();
				$stmt->bind_result( 
								$result->orderDetailId, 
								$result->orderDetailProductQuantity,
								$result->orderDetailUnitPrice,
								$result->orderDetailTotalPrice,
								$result->productId, 
								$result->orderId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new OrderDetail();
					//$new_record->clone($result);
					
					$new_record->orderDetailId = $result->orderDetailId;
					$new_record->orderDetailProductQuantity = $result->orderDetailProductQuantity;
					$new_record->orderDetailUnitPrice = $result->orderDetailUnitPrice;
					$new_record->orderDetailTotalPrice = $result->orderDetailTotalPrice;
					$new_record->productId = $result->productId;
					$new_record->orderId = $result->orderId;

					$result_array[] = $new_record;
				}
			}
			else
			{
				$result_array = array();
			}
			$stmt->close();
			return $result_array;
		}

		public function selectAllByOrderId($order_id)
		{
			$sql = "SELECT *
					FROM order_details
					WHERE order_id =?
					";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "i",
								$order_id);

			if ($stmt->execute())
			{
				$result = new OrderDetail();
				$stmt->bind_result( 
								$result->orderDetailId, 
								$result->orderDetailProductQuantity,
								$result->orderDetailUnitPrice,
								$result->orderDetailTotalPrice,
								$result->productId, 
								$result->orderId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new OrderDetail();
					//$new_record->clone($result);
					
					$new_record->orderDetailId = $result->orderDetailId;
					$new_record->orderDetailProductQuantity = $result->orderDetailProductQuantity;
					$new_record->orderDetailUnitPrice = $result->orderDetailUnitPrice;
					$new_record->orderDetailTotalPrice = $result->orderDetailTotalPrice;
					$new_record->productId = $result->productId;
					$new_record->orderId = $result->orderId;

					$result_array[] = $new_record;
				}
			}
			else
			{
				$result_array = array();
			}
			$stmt->close();
			return $result_array;
		}

		public function selectOne($order_details_id)
		{
			$sql = "SELECT *
					FROM order_details
					WHERE order_details_id = ?
					";
			
			try
			{
				$conn = Connection::getConnection();
			}
			catch(Exception $e)
			{
				echo "ERROR : DB CONNECTION!";
				exit();
			}
			
			if (!($stmt = $conn->prepare($sql)))
			{
				echo "ERROR : STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "i",
								$order_details_id);
			
			if ($stmt->execute())
			{
				$result = new OrderDetail();
				$stmt->bind_result(
								$result->orderDetailId, 
								$result->orderDetailProductQuantity,
								$result->orderDetailUnitPrice,
								$result->orderDetailTotalPrice,
								$result->productId, 
								$result->orderId
									);
				$stmt->fetch();
				if ($result->orderDetailId <= 0)
				{
					$result = null;
				}
			}
			else
			{
				$result = null;
			}
			$stmt->close();
			return $result;
		}

		
	}
?>