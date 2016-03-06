<?php
	class ProductsMySql
	{
		public function insert($product)
		{
			$sql = "INSERT INTO products
					(
						product_name,
						product_price,
						product_image,
						product_available,
						category_id
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
		
			$stmt->bind_param( "sdssi",
								$product->productName,
								$product->productPrice,
								$product->productImage,
								$product->productAvailable,
								$product->categoryId);
			
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
		
		public function update($product)
		{
			$sql = "UPDATE products
					SET
						product_name = ?,
						product_price = ?,
						product_image = ?,
						product_available = ?,
						category_id = ?
					WHERE
						product_id = ?
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
			
			$stmt->bind_param( "sdssi",
								$product->productName,
								$product->productPrice,
								$product->productImage,
								$product->productAvailable,
								$product->categoryId,
								$product->productId);
			
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
			
		public function delete($product_id)
		{
			$sql = "Delete FROM products
					WHERE product_id = ?";
			
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
								$product_id);
			
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
		
		public function selectAll($lim)
		{
			$sql = "SELECT *
					FROM products limit $lim , 16
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
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId);
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Product();
					//$new_record->clone($result);
					
					$new_record->productId = $result->productId;
					$new_record->productName = $result->productName;
					$new_record->productPrice = $result->productPrice;
					$new_record->productImage = $result->productImage;
					$new_record->productAvailable = $result->productAvailable;
					$new_record->categoryId = $result->categoryId;
					
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

		public function selectAllNoLimit()
		{
			$sql = "SELECT *
					FROM products 
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
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId);
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Product();
					//$new_record->clone($result);
					
					$new_record->productId = $result->productId;
					$new_record->productName = $result->productName;
					$new_record->productPrice = $result->productPrice;
					$new_record->productImage = $result->productImage;
					$new_record->productAvailable = $result->productAvailable;
					$new_record->categoryId = $result->categoryId;
					
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
		
		public function selectAllByLetter($letter) //$lim  // limit $lim , 16
		{
			$sql = "SELECT *
					FROM products
					WHERE product_name like '$letter%' 
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

			/*$stmt->bind_param( "s",
								$letter);*/
					
			if ($stmt->execute())
			{
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId);
				$result_array = array();
				
				while($stmt->fetch())
				{
					$new_record = new Product();
					
					$new_record->productId = $result->productId;
					$new_record->productName = $result->productName;
					$new_record->productPrice = $result->productPrice;
					$new_record->productImage = $result->productImage;
					$new_record->productAvailable = $result->productAvailable;
					$new_record->categoryId = $result->categoryId;
					
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
		
		
		
		public function selectOne($product_name)
		{
			$sql = "SELECT *
					FROM products
					WHERE product_name = ?
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
								$product_name);
			
			if ($stmt->execute())
			{
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId
									);
				$stmt->fetch();
				if ($result->productName == "") 
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
		
		public function selectOneByCategory($category_id)
		{
			$sql = "SELECT *
					FROM products
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
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId
									);
				$stmt->fetch();
				if ($result->categoryId == "") 
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
		
		public function selectOneByCategoryLetter($category_id, $letter)
		{
			$sql = "SELECT *
					FROM products
					WHERE category_id = ? AND product_name like '$letter%'
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
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId
									);
				$stmt->fetch();
				if ($result->categoryId == "") 
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
		
		public function selectOneById($product_id)
		{
			$sql = "SELECT *
					FROM products
					WHERE product_id = ?
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
								$product_id);
			
			if ($stmt->execute())
			{
				$result = new Product();
				$stmt->bind_result(
								$result->productId,
								$result->productName,
								$result->productPrice,
								$result->productImage,
								$result->productAvailable,
								$result->categoryId
									);
				$stmt->fetch();
				if ($result->productId <= 0) 
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