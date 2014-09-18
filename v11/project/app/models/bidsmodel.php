<?php
//require_once "/DB/DAO_factory.php";
require_once "/validation/validation_factory.php";
require_once "basemodel.php";

/*
 * as REST has the same API , the MVC was constructed with the same API that only the Data ojects and validation are differnet
 * to add a new table to the database we only need extend the model and controller form the base classes , and construct the
 * DOA for this new table. This makes our code completly decoupled 
 * 
 * this below object is used to access the bid table note it is the same as the propertyModel except different
 * factories created.
 * 
 * 
 */


class bidsModel extends baseModel
{
	
		//the data should be trusted from the controller but just in case, we will check it again
		//also the model converts json to an PHP array , removes cross site scripting and SQL injection
		//It also sets an error message if any parameters are wrong via the validition factory
		//and validates that they are the correct type and length ect
		//as our design document has input validation in both the controller and model.
		protected function ConvertJSONToArray($parameters)
		{
		   $safeArray = null;
	   	   $inputJson =$parameters["json"];
	       if( isset($inputJson) )
		   {
			  	$joTemp = json_decode($inputJson ,true);
				if(isset($joTemp["bid_higest_price"]) && isset($joTemp["bid_description"])
					&& isset($joTemp["bid_comments"]) ) //&& isset($joTemp["user_id"]) && isset($joTemp["property_id"]) )
				{
					$safeArray = $this->toSafeArray($joTemp , $parameters);
				}
				else 
				{
					$this->errordetails = MESSAGE_NO_INPUT_JSON;
				}
		   }
		   return $safeArray;
	   }
	   
		public function toSafeArray($joTemp , $parameters)
		{
			$safeArray = null;
			$safeArray["Bid_lowest_price"] = $this->clean($joTemp["Bid_lowest_price"]); 
			$safeArray["bid_higest_price"] = $this->clean($joTemp["bid_higest_price"]);
			$safeArray["bid_description"] =  $this->clean($joTemp["bid_description"]);
			$safeArray["bid_comments"] =     $this->clean($joTemp["bid_comments"]);
			//if adding a complete new user we do not need the user ID , but if we are updating we do
			$safeArray["user_id"] =    isset($parameters["user_id"]) ?  $parameters["user_id"]:  $this->clean($joTemp["user_id"]);
			$safeArray["property_id"] =isset($parameters["property_id"]) ?  $parameters["property_id"]:  $this->clean($joTemp["property_id"]);
			return $safeArray;
		}
		//our concrete implemention of the BIDs DAO and the validation factory
		//for making sure that the input JSON from the user conforms to the bids database TABLE
		//all methods are accessed thro the base class as to conform with the interface
		public function __construct()
		{
			//construct the factories
			parent::__construct();
			//set factories to build classes for the BID table
			$this->DAO =$this->DAO_Factory->getBidsDAO();
			$this->validation = $this->validationFactory->getBidsvalidation();
		}
}
?>