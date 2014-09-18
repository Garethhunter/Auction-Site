<?php


require_once("baseValidation.php");

class userValidation extends baseValidation {

	
	public function checkValidParameters($parameters)
	{
 	   $safeArray = null;
   
   	   $inputJson =$parameters["json"];
   	   $jo = json_decode($inputJson ,true);
	   if( isset($inputJson) )
	   {
			$joTemp = json_decode($inputJson ,true);
			if(isset($joTemp["user_name"]) && isset($joTemp["user_address"]) && isset($joTemp["user_email"])
				&& isset($joTemp["user_phone"]) ) //&& isset($joTemp["user_id"]) && isset($joTemp["property_id"]) )
			{
				
				$safeArray = $this->toSafeArray($joTemp);
			}
			else 
			{
				$this->errordetails = MESSAGE_FORM_ERRORS_STR;
			}
		}
		else 
			{
				$this->errordetails = MESSAGE_NO_INPUT_JSON;
			}
   		return $safeArray;

	}
	public function toSafeArray($parameters)
	{
		
	/*
	 * 
		//define("MESSAGE_FORM_ERRORS_STR"," Errors exist in the form ");
define("MESSAGE_FORM_MAX_TITLE_LENGTH", 100); //varchar(100)
define("MESSAGE_FORM_MAX_CONTENT_LENGTH", 1000);//varchar(1000)
define("MESSAGE_FORM_SIMPLE","simple form");//idofsimpleform
define("MESSAGE_FORM_INTERACTIVE","interactive form"); //id of interactive form
 */			
		 $compare = null;
		 $compare["user_id"] = $parameters["user_id"];
		 $compare["user_name"] = $parameters["user_name"];
		 $compare["user_address"] = $parameters["user_address"];
		 $compare["user_email"] = $parameters["user_email"];
		 $compare["user_phone"] = $parameters["user_phone"];
	 	 $compare["user_password"] = $parameters["user_password"] ;
		 $compare["user_description"] = $parameters["user_description"];
		 return $compare;
		
	}
	
	

}