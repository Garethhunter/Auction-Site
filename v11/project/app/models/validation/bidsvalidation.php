<?php


require_once("baseValidation.php");

class bidsValidation extends baseValidation {

	
	//this is the parameter check for each database table , it checks the json for errors then populates a standard PHP array to pass onto the
	//DOA , that is already safe for SQL injection and XSS
		
	public function checkValidParameters($parameters)
	{
  	   	$status = true;
   	 	if(!$this->checkSafeArray($parameters))
		{
			$status = false;
		}
		return $status;

	}
	//need to refactor
	private function checkSafeArray($safeArray)
	{
		//check that valid
		$status =true;
		if(!$this->isLengthStringValid($safeArray["bid_description"] , 255))
		{
			$status=false;
			$this->errordetails = MESSAGE_INVALID_BID_DESC;
		}
		if(!$this->isLengthStringValid($safeArray["bid_comments"] , 255))
		{
			$status=false;
			$this->errordetails = MESSAGE_INVALID_BID_COMMENTS;
		}
		if(!$this->isNumber($safeArray["user_id"] , 100))
		{
			$status=false;
			$this->errordetails = MESSAGE_INVALID_BID_USER;
		}
		if(!$this->isNumber($safeArray["property_id"] , 100))
		{
			$status=false;
			$this->errordetails = MESSAGE_INVALID_BID_PROPID;
		}
		if(!$this->isCurrency($safeArray["Bid_lowest_price"]))
		{
			$status=false;
			 $this->errordetails = MESSAGE_INVALID_BID_LOWEST_PRICE;
		}
		if(!$this->isCurrency($safeArray["bid_higest_price"]))
		{
			$status=false;
			$this->errordetails = MESSAGE_INVALID_BID_HIGEST_PRICE;
		}
		return $status;
		
	}
	
	

}
