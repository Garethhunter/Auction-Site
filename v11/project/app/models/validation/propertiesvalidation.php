<?php


require_once("baseValidation.php");

class propertiesValidation extends baseValidation {

	
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
		return true;
		$status =true;
		if(!$this->isLengthStringValid($safeArray["property_description"] , 255))
		{
			$status=false;
			$this->errordetails .=  " " .  MESSAGE_INVALID_PROP_DESC;
		}
		if(!$this->isDate($safeArray["auction_start_date"]))
		{
			$status=false;
			$this->errordetails .=  " " .MESSAGE_INVALID_PROP_STARTDATE;
		}
		if(!$this->isDate($safeArray["auction_close_date"]))
		{
			$status=false;
			$this->errordetails .=  " " . MESSAGE_INVALID_PROP_CLOSEDATE;
		}
		if(!$this->isCurrency($safeArray["auction_actual_selling_price"]))
		{
			$status=false;
			$this->errordetails .=  " " . MESSAGE_INVALID_PROP_SPRICE;
		}
		if(!$this->isCurrency($safeArray["property_reserve_price"]))
		{
			$status=false;
			 $this->errordetails .=  " " . MESSAGE_INVALID_PROP_RPRICE;
		}
		if(!$this->isLengthStringValid($safeArray["current_successful_bidder_user"] , 50))
		{
			$status=false;
			$this->errordetails .= " " . MESSAGE_INVALID_PROP_SBIDDER;
		}
		if(!$this->isLengthStringValid($safeArray["property_comments"] , 255))
		{
			$status=false;
			$this->errordetails .= " " . MESSAGE_INVALID_BID_COMMENTS;
		}
		if(!$this->isLengthStringValid($safeArray["property_photo"] , 255))
		{
			$status=false;
			$this->errordetails .=" " . MESSAGE_INVALID_PROP_PPHOTO;
		}
		if(!$this->isNumber($safeArray["property_rooms"] , 255))
		{
			$status=false;
			$this->errordetails .= " " . MESSAGE_INVALID_PROP_ROOMS;
		}
		if(!$this->isLengthStringValid($safeArray["property_address"] , 255))
		{
			$status=false;
			$this->errordetails .= MESSAGE_INVALID_PROP_ADDRESS;
		}
		return $status;
		
	}
	
	

}
