<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$db_connection=mysql_connect("localhost","root","123456"); ///"multieng_root","ims_123"
	if($db_connection)
	{
		if(mysql_select_db("thimar",$db_connection))  ///multieng_testims
		{
		}
		else
		{
			echo" ERROR : can not select from database ";
		}
	}
	else
		{
			echo" ERROR : can not connect the Server ";
		}
?>