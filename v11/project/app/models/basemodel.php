<?php
require_once "../app/config/config.inc.php";
include_once "../app/DB/DAO_factory.php";
require_once "validation/validation_factory.php";


//abstract class to conform to an interface as all this code is the same for whatever , DAO table we are calling
//also the validation logic is the same

abstract class baseModel {

		//factories and data access , protected to allow extended classes to access
		protected $DAO_Factory , $validationFactory, $DAO;
		public $apiResponse;
		public $errordetails;
		// the only function that is important to concrete classes , if it wants to modify the input JSON Array		
		abstract protected function ConvertJSONToArray($parameters);
				
		//sets up the factorys for creating the concrete DAO , and validation classes for this type of
		public function __construct()
		{
			$this->DAO_Factory = new DAO_Factory();
			$this->validationFactory = new validation_Factory();
			$this->DAO_Factory->initDBResources();
		}
		// get a Object with ID  and where clause ie "select * from this where that = id and this= id2 
		//needed for some API calls ie REST get /resource/:id/:id2
		public function getItemAnd($id , $id2)
		{
			return $this->DAO->getItemAnd($id , $id2);
		}
		// does Object with ID exist 
		public function isExisting($id)
		{
			return $this->DAO->isExisting($id);
		}
		//get all Items object in the database , what ever the concreate DOA is for this instance of this class
		public function getAllItems()
		{
			return $this->DAO->getAllItems();
		}
		//get the Item object with the id , what ever the concreate DOA is for this instance of this class
		public function getItem($id)
		{
			return $this->DAO->getItem($id);;
		}
		//delete the database object with the id , what ever the concreate DOA is for this instance of this class 
		// returns true on success
		public function deleteItem($id)
		{
			return $this->DAO->deleteItem($id);
		}
		//take a JSON array and converts it to the parameters that the DOA object requires
		//this will call its concrete implementation of the validation factory to make sure these
		//parameters are correct for this type , and then insert them in its concrete DOA
		//it will return false on failure.
		//ie 
		public function insertItemJSON($parameters)
		{
			$status=false;
			$safeArray=$this->ConvertJSONToArray($parameters);
			if($safeArray)
			{
				$status = $this->validation->checkValidParameters($safeArray);
				if($status)
					$status = $this->DAO->insertItemArray($safeArray);
				else 
					$this->errordetails = $this->validation->errordetails;
			}
			return $status;
			
		}
		//same as obove except will only call a update on the DOA object
		public function updateItemJSON($bid_id , $parameters)
		{
			$status =false;
			$safeArray = $this->ConvertJSONToArray($parameters);
			if($safeArray)
			{
				$status = $this->validation->checkValidParameters($safeArray);
				if($status)
					$status = $this->DAO->updateItemArray($bid_id , $safeArray);
				else 
					$this->errordetails = $this->validation->errordetails;
			}
			return $status;
		}
		//clean the Input parameters of nasty strings
		function clean($string) 
		{
   			// Replace sequences of spaces with one space
		//$string = preg_replace('/   */', '  ', $string);
			return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
		}
		//clear and close the database
		public function __destruct()
		{
			$this->DAO_Factory->clearDBResources();
		}
		
		
}
?>