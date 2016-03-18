<?php
	class CategoriesMySql
	{
		public function insert($category)
		{
			$sql = "INSERT INTO categories
					(
						category_name
					)
					VALUES
					(
						?, ?
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
								$category->categoryName
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
		
		public function update($category)
		{
			$sql = "UPDATE categories
					SET
						category_name = ?
					WHERE
						category_id = ?
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
								$category->categoryName,
								$category->categoryId
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
		
		public function delete($category_id)
		{
			$sql = "Delete FROM categories
					WHERE category_id = ?";
			
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
								$ategory_id);
			
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
					FROM categories
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
				$result = new Category();
				$stmt->bind_result( 
								$result->categoryId,
								$result->categoryName
								  );
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Category();
					//$new_record->clone($result);
					echo "here";
					$new_record->categoryId = $result->categoryId;
					$new_record->categoryName = $result->categoryName;
					
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
		
		public function selectOne($category_id)
		{
			$sql = "SELECT *
					FROM categories
					WHERE category_id = ?
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
								$category_id);
			
			if ($stmt->execute())
			{
				$result = new Category();
				$stmt->bind_result(
								$result->categoryId,
								$result->categoryName
									);
				$stmt->fetch();
				if ($result->categoryId <= 0)
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
		
		public function selectOneByName($category_name)
		{
			$sql = "SELECT *
					FROM categories
					WHERE category_name = ?
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
								$categoryName);
			
			if ($stmt->execute())
			{
				$result = new Category();
				$stmt->bind_result(
								$result->categoryId,
								$result->categoryName
									);
				$stmt->fetch();
				if ($result->categoryName == "")
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