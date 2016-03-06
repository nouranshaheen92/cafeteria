<?php
class DAL
{
	public static function getCustomers()
	{
		return new CustomersMySql();
	}	
	public static function getProducts()
	{
		return new ProductsMySql();
	}	
	public static function getRooms()
	{
		return new RoomsMySql();
	}	
	public static function getCategories()
	{
		return new CategoriesMySql();
	}	
	public static function getOrders()
	{
		return new OrdersMySql();
	}	
	public static function getOrderDetails()
	{
		return new OrderDetailsMySql();
	}	
}
?>