<?php


require_once("Basedao.php");

/*
 * 
 * CREATE TABLE users
(
	user_id           int NOT NULL AUTO_INCREMENT,
	user_name            VARCHAR(50) NULL,
	user_address         VARCHAR(100) NULL,
	user_email           VARCHAR(100) NULL,
	user_phone           VARCHAR(20) NULL,
	user_password        VARCHAR(25) NULL,
	user_description     VARCHAR(100) NULL
	PRIMARY KEY (user_id)
);
 */


class usersDAO extends BaseDAO {
	
	public function isExisting($id){
	
		$sqlQuery ="SELECT count(*) as isExisting";
		$sqlQuery .=" FROM users";
		$sqlQuery .=" WHERE user_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		if($result[0]["isExisting"] == 1) 
				return (true);
		else return (false);
	}
	//get all users
	public function getAllItems()
	{
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM users";
		$result=$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	public  function getItemAnd($id , $id2)
	{
		throw new Exception("not implemented usersDAO::getItemAnd");
	}
	//delete prop	
	public function deleteItem($id) 
	{
		$sqlQuery ="DELETE FROM users";
		$sqlQuery .=" WHERE user_id =$id";
		$result =$this ->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	//To get a list of all bids for a particular property	
	public function getItem($id)
	{
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM users";
		$sqlQuery .="  WHERE user_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	
	public function insertItemArray($parameters)
	{
		$user_name =  $parameters["user_name"];
		$user_address =  $parameters["user_address"];
		$user_email =  $parameters["user_email"];
		$user_phone =  $parameters["user_phone"];
	 	$user_password = $parameters["user_password"] ;
		$user_description =  $parameters["user_description"];
	
		$sqlQuery = "INSERT INTO users(user_name,user_address,user_email,";
		$sqlQuery .= "user_phone,user_password ,user_description)";
		$sqlQuery .=" VALUES('$user_name','$user_address','$user_email',";
		$sqlQuery .="'$user_phone','$user_password','$user_description')";
		echo $sqlQuery;
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
		
		
	}
	public function updateItemArray($user_id , $parameters)
	{
		//$user_id = $parameters["user_id"];
		$user_name =  $parameters["user_name"];
		$user_address =  $parameters["user_address"];
		$user_email =  $parameters["user_email"];
		$user_phone =  $parameters["user_phone"];
	 	$user_password = $parameters["user_password"] ;
		$user_description =  $parameters["user_description"];
		
		$sqlQuery ="UPDATE users SET user_name='$user_name',
									user_address='$user_address', 
									user_email='$user_email', 
									user_email='$user_phone' ,
									user_phone='$user_password' , 
									user_password='$user_description' , 
									user_description='$user_description'  
									
		 ";
		$sqlQuery .= " WHERE user_id=$user_id";
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	
	
	//only for unit testing ... 
	public function getLast()
	{
		$sqlQuery= "SELECT MAX(user_id) as maxid FROM users;";
		$result = $this ->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result[0]["maxid"]) ? $result[0]["maxid"] : -1 ;
	}
	

}
?>