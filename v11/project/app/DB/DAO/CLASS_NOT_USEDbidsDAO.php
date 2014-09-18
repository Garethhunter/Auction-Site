<?php


require_once("dao.php");

class bidsDAO extends BaseDAO {

	function messagesDAO($dbMng)
	{
		parent::BaseDAO($dbMng);
	}
	
	public function isBidExisting($id){
		
		$id = mysql_real_escape_string($id);
		$sqlQuery ="SELECT count(*) as isExisting";
		$sqlQuery .=" FROM bids";
		$sqlQuery .=" WHERE bid_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		if($result[0]["isExisting"] == 1) 
			return true;
		return false;
	}
	//To get a list of all user bids
	public function getUserBidsByID($userID){
		
		$userID = mysql_real_escape_string($userID);
		$sqlQuery ="SELECT * ";
		$sqlQuery .=" FROM bids";
		$sqlQuery .=" WHERE user_id=$userID";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}
	
	public function getBid($id)
	{
		$id = mysql_real_escape_string($id);
		$sqlQuery ="SELECT * ";
		$sqlQuery .=" FROM bids";
		$sqlQuery .=" WHERE bid_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}
	
	//get all bids
	public function getAllBids()
	{
		
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM bids";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}
	
	public function insertBid($Bid_lowest_price ,$bid_higest_price ,$bid_description,$bid_comments,$user_id , $property_id )
	{
		$Bid_lowest_price = mysql_real_escape_string($Bid_lowest_price);
		$bid_higest_price = mysql_real_escape_string($bid_higest_price);
		$bid_description = mysql_real_escape_string($bid_description);
		$bid_comments = mysql_real_escape_string($bid_comments);
		$user_id = mysql_real_escape_string($user_id);
		$property_id = mysql_real_escape_string($property_id);
		
		$sqlQuery = "INSERT INTO bids(Bid_lowest_price, bid_higest_price ,bid_description,bid_comments )";
		$sqlQuery .=" VALUES('$Bid_lowest_price','$bid_higest_price','$bid_description','$bid_comments' )";
		$result =$this->getDbManager()->executeInsertQuery($sqlQuery);
		return $result;
	}
	//udate a bid
	public function updateBid($bid_id,$Bid_lowest_price,$bid_higest_price,$bid_description,$bid_comments,$user_id,$property_id)
	{
		$sqlQuery ="UPDATE bids SET bid_description='$bid_description',bid_comments='$bid_comments', bid_higest_price='$bid_higest_price', Bid_lowest_price='$Bid_lowest_price' ,user_id='$user_id' , property_id='$property_id' ";
		$sqlQuery .= " WHERE bid_id=$bid_id";
		echo "\nsql:\n\n";
		echo $sqlQuery;
		$result =$this->getDbManager()->executeInsertQuery($sqlQuery);
		return $result;
	}
	
	//delete bid	
	public function deleteBid($bid_id) 
	{
		$bid_id = mysql_real_escape_string($bid_id);
		$sqlQuery ="DELETE FROM bids";
		$sqlQuery .=" WHERE bid_id =$bid_id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	//To get a list of all bids for a particular property	
	public function getBidsByPropertyID($property_id)
	{
		$property_id = mysql_real_escape_string($property_id);
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM bids";
		$sqlQuery .= " WHERE property_id=$property_id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}

}
