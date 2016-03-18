<?php
	class OrdersMySql
	{
		public function insert($order)
		{
			$sql = "INSERT INTO orders
					(
						order_notes,
						order_status,
						customer_id,
						order_time
					)
					VALUES
					(
						?, ?, ?, DATE_FORMAT(NOW(),'%d/%m/%Y')
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
				echo "ERROR : Order STMT PREPARATION!";
				exit();
			}
			
			$stmt->bind_param( "ssi", 
								$order->orderNotes,
								$order->orderStatus,
								$order->customerId
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
		
		public function update($order)
		{
			$sql = "UPDATE orders
					SET
						order_time = DATE_FORMAT(NOW(),'%d/%m/%Y'),
						order_notes =?,
						order_status =?,
						customer_id =?
					WHERE
						order_id = ?
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
			
			$stmt->bind_param( "sssii",
								$order->orderTime, 
								$order->orderNotes,
								$order->orderStatus,
								$order->customerId,
								$order->orderId
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

		public function updateStatus($order_id)
		{
			$sql = "UPDATE orders
					SET
						order_status ='Delivered'
					WHERE
						order_id = ?
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
								$order_id
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
		
		public function delete($order_id)
		{
			$sql = "Delete FROM orders
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
		}

		public function deleteByCustomerId($customer_id)
		{
			$sql = "Delete FROM orders
					WHERE customer_id = ?";
			
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
				
				$result = true;
				
			}
			else
			{
				$result = false;
			}
			$stmt->close();
			return $result;
		}
		
		public function selectAll()
		{
			$sql = "SELECT *
					FROM orders
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
				$result = new Order();
				$stmt->bind_result(
								$result->orderId,
								$result->orderTime, 
								$result->orderNotes,
								$result->orderStatus,
								$result->customerId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Order();
					//$new_record->clone($result);
					
					$new_record->orderId = $result->orderId;
					$new_record->orderTime = $result->orderTime;
					$new_record->orderNotes = $result->orderNotes;
					$new_record->orderStatus = $result->orderStatus;
					$new_record->customerId = $result->customerId;

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
					FROM orders
					WHERE customer_id=?
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
				$result = new Order();
				$stmt->bind_result(
								$result->orderId,
								$result->orderTime, 
								$result->orderNotes,
								$result->orderStatus,
								$result->customerId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Order();
					//$new_record->clone($result);
					
					$new_record->orderId = $result->orderId;
					$new_record->orderTime = $result->orderTime;
					$new_record->orderNotes = $result->orderNotes;
					$new_record->orderStatus = $result->orderStatus;
					$new_record->customerId = $result->customerId;

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

		public function selectAllByOrderStatus($order_status)
		{
			$sql = "SELECT *
					FROM orders
					WHERE order_status=?
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
			
			$stmt->bind_param( "s",
								$order_status);

			if ($stmt->execute())
			{
				$result = new Order();
				$stmt->bind_result(
								$result->orderId,
								$result->orderTime, 
								$result->orderNotes,
								$result->orderStatus,
								$result->customerId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Order();
					//$new_record->clone($result);
					
					$new_record->orderId = $result->orderId;
					$new_record->orderTime = $result->orderTime;
					$new_record->orderNotes = $result->orderNotes;
					$new_record->orderStatus = $result->orderStatus;
					$new_record->customerId = $result->customerId;

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
		
		public function selectOne($order_id)
		{
			$sql = "SELECT *
					FROM orders
					WHERE order_id = ?
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
				$result = new Order();
				$stmt->bind_result(
								$result->orderId,
								$result->orderTime, 
								$result->orderNotes,
								$result->orderStatus,
								$result->customerId
									);
				$stmt->fetch();
				if ($result->orderId <= 0)
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
