<?php
require_once "/config/config.inc.php";
require_once "/db/DAO_factory.php";
require_once "validation_functions.php";


class bidsModel{

	public $DAO_Factory , $validationFactory;
	//factories
	public $bidDAO;
	public $apiResponse;

		public function __construct()
		{
			$this->DAO_Factory = new DAO_Factory();
			$this->DAO_Factory ->initDBResources();
			$this->bidDAO =$this->DAO_Factory->getbidsDAO();
			//$this ->validationFactory = new validation_factory();
		}
		
		public function isBidExisting($id)
		{
			return ($this->bidDAO->isBidExisting($id));
		}
		
		public function getBids(){
			$publicationsList =$this->bidDAO->getAllBids();
			return $publicationsList;
		}
		
		public function getBid($id)
		{
			$publicationDetail =$this->bidDAO->getBid($id);
			return $publicationDetail[0];
		}
		
		//$id =$this->model->addBid($jo["Bid_lowest_price"],$jo["bid_higest_price"],$jo["bid_description"],$jo["bid_comments"],$jo["user_id"] , $jo["property_id"]);
	   //mege with update .. and add
		public function addBid($Bid_lowest_price ,$bid_higest_price ,$bid_description ,$bid_comments ,$user_id , $property_id )
		{
			
			//$id =$this->model->addBid($jo["Bid_lowest_price"],$jo["bid_higest_price"],$jo["bid_description"],$jo["bid_comments"]);
			return ($this->bidDAO->insertBid($Bid_lowest_price ,$bid_higest_price ,$bid_description ,$bid_comments ,$user_id , $property_id ));
		}
		
		public function updateBid($id,$Bid_lowest_price ,$bid_higest_price ,$bid_description ,$bid_comments , $user_id , $property_id) 
		{
			return ($this->bidDAO->updateBid($id,$Bid_lowest_price ,$bid_higest_price ,$bid_description ,$bid_comments , $user_id , $property_id));
		}
		
		public function deleteBid($id)
		{
			$this->bidDAO->deleteBid($id);
		}
		
		public function __destruct()
		{
			$this->DAO_Factory->clearDBResources();
		}
}
?>