<?php
require_once("basecontroller.php");

class propertyController extends baseController {

	//this is an abstract function that needs to be implemented for each new conntroller we wish to add 
	// it takes JSON input for each controller and returns JSON of the input coforms to the layout defined here
	// for success we return the JSON decoded for false we return NULL
	
	/*
	 * $compare["property_description"]  = $this->clean($joTemp["property_description"]) ;
				$compare["auction_start_date"] = $this->clean($joTemp["auction_start_date"]);
			    $compare["auction_close_date"] = $this->clean($joTemp["auction_close_date"]);
				$compare["auction_actual_selling_price"] = $this->clean($joTemp["auction_actual_selling_price"]);
				$compare["property_reserve_price"] =  $this->clean($joTemp["property_reserve_price"]);
				$compare["current_successful_bidder_user"] =  $this->clean($joTemp["current_successful_bidder_user"]);
				$compare["property_comments"]= $this->clean($joTemp["property_comments"]);
				$compare["property_photo"] = $this->clean($joTemp["property_photo"]);;
				$compare["property_rooms"] = $this->clean($joTemp["property_rooms"]);
				$compare["property_address"]= $this->clean($joTemp["property_address"]);
	 */
	
	
	public function checkValidInputParameters($parameters)
	{
		
	   	   $jo = null;
	   	   $inputJson =$parameters["json"];
	  	   if( isset($inputJson) )
			{
				//auction_close_date
				$joTemp = json_decode($inputJson ,true);
			  //	var_dump(isset(  $joTemp["auction_close_date"]    ));
				
				
				if( isset($joTemp["property_description"]) 
				&& isset($joTemp["property_comments"]) 
				
								&& isset($joTemp["auction_start_date"])
								&& isset($joTemp["auction_close_date"])
								&& isset($joTemp["auction_actual_selling_price"])
								&& isset($joTemp["property_reserve_price"])
								&& isset($joTemp["current_successful_bidder_user"])
								&& isset($joTemp["property_photo"])
								&& isset($joTemp["property_rooms"])
								&& isset($joTemp["property_address"])
				) 
				{
					//var_dump($joTemp);
			
					$jo = $joTemp;	
				}
			}
	   return $jo;
	   
	}


}
?>
