
<?php 

class dborm{
            private $conn ;
            function __construct ($conn){
                 $this->conn=$conn;
              }
       

        function dbselect($table_name,$data,$where_clause=''){
              $whereSQL = '';
                if(!empty($where_clause))
                {
                    // check to see if the 'where' keyword exists
                    if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
                    {
                        // not found, add keyword
                        $whereSQL = " WHERE ".$where_clause;
                    } else
                    {
                        $whereSQL = " ".trim($where_clause);
                    }
                }  
                        if($data[0]!='*'){
                            $sql = "select ".implode(",", $data)." FROM ".$table_name.$whereSQL;
                        }else{
                           $sql = "select * FROM ".$table_name.$whereSQL;

                         }
                        //echo $sql;
                          $result=mysqli_query($this->conn,$sql);
                                    // echo $sql;                  
                         if(mysqli_num_rows($result)>0){
                               
                                 $arr=array();

                                 while($row=mysqli_fetch_assoc($result)){

                                    array_push($arr,$row);

                                 }
                                return $arr;

                             //return $res= mysqli_fetch_array($result,MYSQLI_ASSOC); 
                          }else{
                             return array();

                          }

         }
       function dbRowInsert($table_name, $form_data)
         {
              // retrieve the keys of the array (column titles)
              $fields = array_keys($form_data);

              // build the query
              $sql = "INSERT INTO ".$table_name."
              (`".implode('`,`', $fields)."`)
              VALUES('".implode("','", $form_data)."')";

              // run and return the query result resource
              //$sql=mysqli_real_escape_string($this->conn,$sql);
             // echo $sql;
             if($result=mysqli_query($this->conn,$sql)){
                     

                return 1;
             }else{
                return -1;
             }
    }


    // the where clause is left optional incase the user wants to delete every row!
function dbRowDelete($table_name, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;

    // run and return the query result resource
        if($result=mysqli_query($this->conn,$sql)){

                return 1;
             }else{
                return -1;
             }
   }



// again where clause is left optional
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result
    //return $sql;
   // $sql=mysqli_real_escape_string($this->conn,$sql);
    if($result=mysqli_query($this->conn,$sql)){

                return 1;
             }else{
                return -1;
             }
}
          function get_last_inserted_id(){

            return mysqli_insert_id($this->conn);
          }

          function get_effected_number(){

             return mysqli_affected_rows($this->conn);

          }


}

require __DIR__.'/connect.php';
$conn=dbconnect::connect_db();
$obj=new dborm($conn);

?>