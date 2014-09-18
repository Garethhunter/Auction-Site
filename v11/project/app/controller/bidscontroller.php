<?php
require_once("baseController.php");

class bidsController extends baseController {

	//this is an abstract function that needs to be implemented for each new conntroller we wish to add 
	// it takes JSON input for each controller and returns JSON of the input coforms to the layout defined here
	// for success we return the JSON decoded for false we return NULL
	public function checkValidInputParameters($parameters)
	{
	   		$jo = null;
	       $inputJson =$parameters["json"];
	   	   $jo = json_decode($inputJson ,true);
		   if( isset($inputJson) )
			{
				$joTemp = json_decode($inputJson ,true);
				if(isset($joTemp["Bid_lowest_price"]) && isset($joTemp["bid_higest_price"]) && isset($joTemp["bid_description"])
					&& isset($joTemp["bid_comments"]) ) //&& isset($joTemp["user_id"]) && isset($joTemp["property_id"]) )
				{
					$jo = $joTemp;	
				}
			}
	   return $jo;
	}
	
	
	
	
}
?>