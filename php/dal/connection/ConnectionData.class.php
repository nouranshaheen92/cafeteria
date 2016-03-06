<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	class ConnectionData
	{
		private static $host = "localhost";
		private static $user = "root";
		private static $password = "";
		private static $database = "cafeteria";
		
		public static function getHost()
		{
			return ConnectionData::$host;
		}
		
		public static function getUser()
		{
			return ConnectionData::$user;
		}
		
		public static function getPassword()
		{
			return ConnectionData::$password;
		}
		
		public static function getDatabase()
		{
			return ConnectionData::$database;
		}
	}
?>