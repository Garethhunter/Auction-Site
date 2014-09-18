<?php
//require_once "/db/DAO_factory.php";
require_once "/validation/validation_factory.php";
require_once "basemodel.php";

/*
 * as REST has the same API , the MVC was constructed with the same API that only the Data ojects and validation are differnet
 * to add a new table to the database we only need extend the model and controller form the base classes , and construct the
 * DOA for this new table. This makes our code completly decoupled 
 * 
 * this below object is used to access the property table note it is the same as the bidModel except different
 * factories created.
 * 
 */


class propertiesModel extends baseModel
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
   	    	$jo = json_decode($inputJson ,true);
	     	if( isset($inputJson) )
	     	{
	   		    $joTemp = json_decode($inputJson ,true);
				if( isset($joTemp["property_description"]) && isset($joTemp["auction_start_date"]) )
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
				$compare = null;
				$compare["property_description"]  = $this->clean($joTemp["property_description"]) ;
				$compare["auction_start_date"] = $this->clean($joTemp["auction_start_date"]);
				//DATE CHECKED LATER
			    $compare["auction_close_date"] = $joTemp["auction_close_date"];
				$compare["auction_actual_selling_price"] =$joTemp["auction_actual_selling_price"];
				$compare["property_reserve_price"] =  $this->clean($joTemp["property_reserve_price"]);
				$compare["current_successful_bidder_user"] =  $this->clean($joTemp["current_successful_bidder_user"]);
				$compare["property_comments"]= $this->clean($joTemp["property_comments"]);
				$compare["property_photo"] = $this->clean($joTemp["property_photo"]);;
				$compare["property_rooms"] = $this->clean($joTemp["property_rooms"]);
				$compare["property_address"]= $this->clean($joTemp["property_address"]);
				return $compare;
		}
		//our concrete implemention of the propertys DAO and the validation factory
		//for making sure that the input JSON from the user conforms to the database properties TABLE
		public function __construct()
		{
			//construct the factories
			parent::__construct();
			//set factories to build classes for the properties table
			$this->DAO =$this->DAO_Factory->getPropertiesDAO();
			//the validation for the properties table make sure they exist and in correct format
			//in the input JSON
			$this->validation = $this->validationFactory->getPropertiesvalidation();
		}
		
}
?>