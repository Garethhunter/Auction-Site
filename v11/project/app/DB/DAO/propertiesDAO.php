<?php


require_once("Basedao.php");



class propertiesDAO extends BaseDAO {
	
	public function isExisting($id){
	
		$sqlQuery ="SELECT count(*) as isExisting";
		$sqlQuery .=" FROM property_items";
		$sqlQuery .=" WHERE property_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		if($result[0]["isExisting"] == 1) 
				return (true);
		else return (false);
	}
	
	//get all bids
	public function getAllItems()
	{
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM property_items";
		$result=$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	public  function getItemAnd($id , $id2)
	{
		//not implemented should not be called
		throw new Exception("not implemented propertiesDAO::getItemAnd");
	}

	//delete prop	
	public function deleteItem($property_id) 
	{
		$sqlQuery ="DELETE FROM property_items";
		$sqlQuery .=" WHERE property_id =$property_id";
		$result =$this ->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	//To get a list of all bids for a particular property	
	public function getItem($id)
	{
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM property_items";
		$sqlQuery .="  WHERE property_id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result[0];
	}
	
public function insertItemArray($parameters)
	{
		$property_description = $parameters["property_description"];
		$auction_start_date =  $parameters["auction_start_date"];
		$auction_close_date =  $parameters["auction_close_date"];
		$property_comments =  $parameters["property_comments"];
		$property_address =  $parameters["property_address"];
	 	$auction_actual_selling_price = $parameters["auction_actual_selling_price"] ;
		$property_reserve_price =  $parameters["property_reserve_price"];
		$current_successful_bidder_user = $parameters["current_successful_bidder_user"] ;
		$property_photo=  $parameters["property_photo"];
		$property_rooms = $parameters["property_rooms"];
	
		$sqlQuery = "INSERT INTO property_items(property_description,auction_start_date,auction_close_date,property_comments,";
		$sqlQuery .= "property_address,auction_actual_selling_price ,property_reserve_price,current_successful_bidder_user , property_photo , property_rooms)";
		$sqlQuery .=" VALUES('$property_description','$auction_start_date','$auction_close_date','$property_comments',";
		$sqlQuery .="'$property_address','$auction_actual_selling_price','$property_reserve_price','$current_successful_bidder_user' , '$property_photo', '$property_rooms' )";
		
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
		
		
	}
	public function updateItemArray($property_id , $parameters)
	{
		
		$property_description = $parameters["property_description"];
		$auction_start_date =  $parameters["auction_start_date"];
		$auction_close_date =  $parameters["auction_close_date"];
		$property_comments =  $parameters["property_comments"];
		$property_address =  $parameters["property_address"];
	 	$auction_actual_selling_price = $parameters["auction_actual_selling_price"] ;
		$property_reserve_price =  $parameters["property_reserve_price"];
		$current_successful_bidder_user = $parameters["current_successful_bidder_user"] ;
		$property_photo=  $parameters["property_photo"];
		$property_rooms = $parameters["property_rooms"];
		
		$sqlQuery ="UPDATE property_items SET property_description='$property_description',
									auction_start_date='$auction_start_date', 
									auction_close_date='$auction_close_date', 
									property_comments='$property_comments' ,
									property_address='$property_address' , 
									auction_actual_selling_price='$auction_actual_selling_price' , 
									property_reserve_price='$property_reserve_price' , 
									current_successful_bidder_user='$current_successful_bidder_user' , 
									property_photo='$property_photo' , 
									property_rooms='$property_rooms' 
		 ";
		
		$sqlQuery .= " WHERE property_id=$property_id";
		$result =$this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	
	
	//only for unit testing ... 
	public function getLast()
	{
		$sqlQuery= "SELECT MAX(property_id) as maxid FROM property_items;";
		$result = $this ->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result[0]["maxid"]) ? $result[0]["maxid"] : -1 ;
	}
	

}
?>