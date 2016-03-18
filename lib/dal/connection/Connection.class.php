<?php
define("DB_NAME","cafeteria");
define("DB_USER",getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define("DB_PASSWORD",getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));

define("DB_SERVER",getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
	class Connection
	{
		static public function getConnection()
        {
    		$connection = new mysqli
                        (
                            DB_SERVER,
                            DB_USER,
                            DB_PASSWORD,
                            DB_NAME,
                            DB_PORT
                        );
            if(!$connection)
            {
    			throw new Exception('ERROR in database connection !!');
    		}
			$connection->query("SET time_zone =  '+2:00';");
            $connection->query("SET NAMES 'utf8'");
    		return $connection;
    	}
		
		static public function close($connection)
        {
    		$connection->close();
    	}
	}
	
?>
