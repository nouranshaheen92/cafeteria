<?php
class dbconnect{
/*
private $servername = "localhost";
private $username = "root";
private $password = "iti";
private $db_name ="cafeteriadb";
*/


static $conn =null;
         
        private  function __construct(){
                  
                  self::$conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT)or die('Can not Connect To DB');         
               }

static function connect_db(){
      
  // Create connection
    if(self::$conn==null){
           
           new dbconnect();
     }
        return self::$conn;
              
     }
 
}


 
?> 
