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
						?, ?, ?, Now()
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
			
			$stmt->bind_param( "sssi", 
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
				$result = false;
			}
			$stmt->close();
			return $result;
		}
		
		public function update($order)
		{
			$sql = "UPDATE orders
					SET
						order_time = Now(),
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