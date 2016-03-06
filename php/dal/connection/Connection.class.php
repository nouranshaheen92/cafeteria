<?php
	class Connection
	{
		static public function getConnection()
        {
    		$connection = new mysqli
                        (
                            ConnectionData::getHost(),
                            ConnectionData::getUser(),
                            ConnectionData::getPassword(),
                            ConnectionData::getDatabase()
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