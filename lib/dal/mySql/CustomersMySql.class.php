<?php
	class CustomersMySql
	{     
		public function insert($customer)
		{
			$sql = "INSERT INTO customers
					(
						customer_name,
						customer_telephone,
						customer_email,
						customer_extension,
						customer_username,
						customer_password,
						customer_image,
						customer_notes,
						room_id
					)
					VALUES
					(
						?, ?, ?, ?, ?, ?, ?, ?, ?
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
			
			$stmt->bind_param( "ssssssssi", 
								$customer->customerName,
								$customer->customerTelephone,
								$customer->customerEmail,
								$customer->customerExtension, 
								$customer->customerUsername,
								$customer->customerPassword,
								$customer->customerImage,
								$customer->customerNotes, 
								$customer->roomId
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
		
		public function update($customer)
		{
			$sql = "UPDATE customers
					SET
						customer_name = ?,
						customer_telephone = ?,
						customer_email = ?,
						customer_extension = ?,
						customer_username = ?,
						customer_password = ?,
						customer_image = ?,
						customer_notes = ?,
						room_id = ?
					WHERE
						customer_id = ?
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
			
			$stmt->bind_param( "ssssssssii",
								$customer->customerName,
								$customer->customerTelephone,
								$customer->customerEmail,
								$customer->customerExtension, 
								$customer->customerUsername,
								$customer->customerPassword,
								$customer->customerImage,
								$customer->customerNotes, 
								$customer->roomId,
								$customer->customerId
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
		
		public function delete($customer_id)
		{
			$sql = "Delete FROM customers
					WHERE customer_id = ?";
			echo"heeeeeeeeeeeereee";
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
				echo"heeeeeeeeeeeereee";
				$result = true;
				
			}
			else
			{
				echo $stmt->error;
				$result = false;
			}
			$stmt->close();
			return $result;
		}
		
		public function selectAll()
		{
			$sql = "SELECT *
					FROM customers
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
				$result = new Customer();
				$stmt->bind_result( 
								$result->customerId, 
								$result->customerName,
								$result->customerTelephone,
								$result->customerEmail,
								$result->customerExtension, 
								$result->customerUsername,
								$result->customerPassword,
								$result->customerImage,
								$result->customerNotes, 
								$result->roomId
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Customer();
					//$new_record->clone($result);
					
					$new_record->customerId = $result->customerId;
					$new_record->customerName = $result->customerName;
					$new_record->customerTelephone = $result->customerTelephone;
					$new_record->customerEmail = $result->customerEmail;
					$new_record->customerExtension = $result->customerExtension;
					$new_record->customerUsername = $result->customerUsername;
					$new_record->customerPassword = $result->customerPassword;
					$new_record->customerImage = $result->customerImage;
					$new_record->customerNotes = $result->customerNotes;
					$new_record->roomId = $result->roomId;
					
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
		
		public function selectOne($customer_id)
		{
			$sql = "SELECT *
					FROM customers
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
				$result = new Customer();
				$stmt->bind_result(
								$result->customerId, 
								$result->customerName,
								$result->customerTelephone,
								$result->customerEmail,
								$result->customerExtension, 
								$result->customerUsername,
								$result->customerPassword,
								$result->customerImage,
								$result->customerNotes, 
								$result->roomId
									);
				$stmt->fetch();
				if ($result->customerId <= 0)
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
		
		public function selectOneByName($customer_username)
		{
			$sql = "SELECT *
					FROM customers
					WHERE customer_username = ?
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
								$customer_username);
			
			if ($stmt->execute())
			{ 
				$result = new Customer();
				$stmt->bind_result(
								$result->customerId, 
								$result->customerName,
								$result->customerTelephone,
								$result->customerEmail,
								$result->customerExtension, 
								$result->customerUsername,
								$result->customerPassword,
								$result->customerImage,
								$result->customerNotes, 
								$result->roomId
									);
				$stmt->fetch();
				if ($result->customerUsername == "")
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

		public function selectOneByEmail($customer_email)
		{ 
			$sql = "SELECT *
					FROM customers
					WHERE customer_email = ?
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
								$customer_email);
			
			if ($stmt->execute())
			{   
				$result = new Customer();
				$stmt->bind_result(
								$result->customerId, 
								$result->customerName,
								$result->customerTelephone,
								$result->customerEmail,
								$result->customerExtension, 
								$result->customerUsername,
								$result->customerPassword,
								$result->customerImage,
								$result->customerNotes, 
								$result->roomId
									);
				$stmt->fetch(); 
				
				if ($result->customerEmail == "")
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