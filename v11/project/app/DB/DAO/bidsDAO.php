<?php


require_once("Basedao.php");

class bidsDAO extends BaseDAO {

	public function isExisting($id){
		
		$sqlQuery ="SELECT count(*) as isExisting";
		$sqlQuery .=" FROM bids";
		$sqlQuery .=" WHERE bid_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		if($result[0]["isExisting"] == 1) 
			return true;
		return false;
	}

	public function getItem($id){
		
		$sqlQuery ="SELECT * ";
		$sqlQuery .=" FROM bids";
		$sqlQuery .=" WHERE bid_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result[0];
	}
	//this fuction enables this to fit into our api
	//by selecting from the database with a where clause
	//if Parameter 1 is set and not parameter 2 it is a user
	//if Parameter 1 and 2 is set it is a select from .. where enity = parameter1 and where enity = parameter2
	//if only parameter 2 is set then where select on property	
	public function getItemAnd($id , $id2){
		
		$sqlQuery ="SELECT * ";
		$sqlQuery .=" FROM bids";
		if($id2)
		{
			$sqlQuery .=" WHERE property_id=$id2";
		}
		if($id && $id2)
		{
			$sqlQuery .=" and user_id=$id";
		}
		if(!$id2) 
		{
			$sqlQuery .=" where user_id=$id";
		}
		
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	
	//get all bids
	public function getAllItems()
	{
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM bids";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	
	public function insertItemArray($parameters)
	{
		$Bid_lowest_price = $parameters["Bid_lowest_price"];
		$bid_higest_price =  $parameters["bid_higest_price"];
		$bid_description =  $parameters["bid_description"];
		$bid_comments =  $parameters["bid_comments"];
		$user_id =  $parameters["user_id"];
		$property_id =  $parameters["property_id"];
		
		$sqlQuery = "INSERT INTO bids(Bid_lowest_price, bid_higest_price ,bid_description,bid_comments,user_id,property_id )";
		$sqlQuery .=" VALUES('$Bid_lowest_price','$bid_higest_price','$bid_description','$bid_comments','$user_id' , '$property_id' )";
		
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	public function updateItemArray($bid_id , $parameters)
	{
		$Bid_lowest_price = $parameters["Bid_lowest_price"];
		$bid_higest_price =  $parameters["bid_higest_price"];
		$bid_description =  $parameters["bid_description"];
		$bid_comments =  $parameters["bid_comments"];
		$user_id =  $parameters["user_id"];
		$property_id =  $parameters["property_id"];
		$sqlQuery ="UPDATE bids SET bid_description='$bid_description',bid_comments='$bid_comments', bid_higest_price='$bid_higest_price', Bid_lowest_price='$Bid_lowest_price' ,user_id='$user_id' , property_id='$property_id' ";
		$sqlQuery .= " WHERE bid_id=$bid_id";
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	
	
	//delete bid	
	public function deleteItem($bid_id) 
	{
		$sqlQuery ="DELETE FROM bids";
		$sqlQuery .=" WHERE bid_id =$bid_id";
		$result =$this ->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	
//only for unit testing ... 
	public function getLast()
	{
		$sqlQuery= "SELECT MAX(bid_id) as maxid FROM bids;";
		$result = $this ->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result[0]["maxid"]) ? $result[0]["maxid"] : -1 ;
	}
	

}
