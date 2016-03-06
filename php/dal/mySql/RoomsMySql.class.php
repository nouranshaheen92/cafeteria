<?php
	class RoomsMySql
	{
		public function insert($room)
		{
			$sql = "INSERT INTO rooms
					(
						room_number
					)
					VALUES
					(
						?
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
			
			$stmt->bind_param( "s", 
								$room->roomNumber
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
		
		public function update($room)
		{
			$sql = "UPDATE rooms
					SET
						room_number = ?
					WHERE
						room_id = ?
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
			
			$stmt->bind_param( "si",
								$room->roomNumber,
								$room->roomId
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
		
		public function delete($room_id)
		{
			$sql = "Delete FROM rooms
					WHERE room_id = ?";
			
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
								$room_id);
			
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
					FROM rooms
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
				$result = new Room();
				$stmt->bind_result( 
								$result->roomId, 
								$result->roomNumber
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Room();
					//$new_record->clone($result);
					
					$new_record->roomId = $result->roomId;
					$new_record->roomNumber = $result->roomNumber;
					
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
		
		public function selectOne($room_id)
		{
			$sql = "SELECT *
					FROM rooms
					WHERE room_id = ?
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
								$room_id);
			
			if ($stmt->execute())
			{
				$result = new Room();
				$stmt->bind_result(
								$result->roomId, 
								$result->roomNumber
									);
				$stmt->fetch();
				if ($result->roomId <= 0)
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
		
		public function selectOneByNumber($room_number)
		{
			$sql = "SELECT *
					FROM rooms
					WHERE room_number = ?
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
								$roomNumber);
			
			if ($stmt->execute())
			{
				$result = new Room();
				$stmt->bind_result(
								$result->roomId, 
								$result->roomNumber
									);
				$stmt->fetch();
				if ($result->roomNumber == "")
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