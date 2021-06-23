<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ipaylogger');


/**
 * 
 */
class DBConnect 
{
	public $connect;
	
	function __construct()
	{
		$this->connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		mysqli_select_db($this->connect, DB_NAME);
		
	}
	public function closeDb()
	{
		mysqli_close($this->connect);
	}
}



?>