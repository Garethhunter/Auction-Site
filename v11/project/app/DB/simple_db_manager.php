<?php

include_once '../app/config/config.inc.php';

class DBManager{

	private $db_link;
	private $hostname = DB_HOST; //"localhost";
	private $username = DB_USER; //"slim";
	private $password =DB_PASS; //"password";
	private $dbname = DB_NAME; //
	private $dbport = DB_PORT; //
	
		function __construct($dbname = DB_NAME )
		{
			$this ->dbname =$dbname;
		}
		function openConnection()
		{
		   $this->db_link = mysqli_connect($this->hostname ,$this->username ,$this->password,$this->dbname ,$this->dbport ); 
		   if(!$this->db_link)
		    	throw new Exception("Unable to connect to database . ");
		}
		function executeSelectQuery($query)
		{
		//echo "executeSelectQuery:: "; echo $query; echo "\n"; //for quick testing
			$rows = null;
			$result = mysqli_query($this ->db_link ,$query); 
		 	if(!$result)
			{
				//$this->db_link->close();	
			  	throw new Exception("error in sql ");
			}
					     
			while($row =$result->fetch_array(MYSQLI_ASSOC))
			{
				$rows[] =$row;
			}
			return $rows;
		}
		function executeQuery($query)
		{
		//echo "executeQuery:: "; echo $query; echo "\n"; //for quick testing
			$result = mysqli_query($this ->db_link ,$query); 
		 	if(!$result)
			{
				//$this->db_link->close();	
			  	throw new Exception("error in sql ");
			}
					     
			return ($result);
		}
		function closeConnection()
		{
			$this->db_link->close();
		}
		

}

?>