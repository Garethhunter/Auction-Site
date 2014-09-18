<?php
require_once("baseController.php");

class usersController extends baseController {

	//this is an abstract function that needs to be implemented for each new conntroller we wish to add 
	// it takes JSON input for each controller and returns JSON of the input coforms to the layout defined here
	// for success we return the JSON decoded for false we return NULL
	public function checkValidInputParameters($parameters)
	{
	   $jo = null;
	   
	   	   $inputJson =$parameters["json"];
	   	   $jo = json_decode($inputJson ,true);
		//   if( isset($inputJson) )
		//	{
		//		$joTemp = json_decode($inputJson ,true);
		//		if(isset($joTemp["property_description"]) && isset($joTemp["auction_start_date"]) && isset($joTemp["auction_close_date"])
		//			&& isset($joTemp["property_comments"]) ) //&& isset($joTemp["user_id"]) && isset($joTemp["property_id"]) )
		//		{
		//			$jo = $joTemp;	
		//		}
		//	}
	   return $jo;
	}
	
	
	
	
}
?>