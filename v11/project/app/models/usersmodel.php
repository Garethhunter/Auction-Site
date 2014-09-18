<?php
require_once "/db/DAO_factory.php";
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


class usersModel extends baseModel
{
		protected function ConvertJSONToArray($parameters)
		{
			//modified via api call so just insert them into safe array
			
			return $safeArray;
		}	
	
		//our concrete implemention of the propertys DAO and the validation factory
		//for making sure that the input JSON from the user conforms to the database properties TABLE
		public function __construct()
		{
			//construct the factories
			parent::__construct();
			//set factories to build classes for the properties table
			$this->DAO =$this->DAO_Factory->getUsersDAO();
			//the validation for the properties table make sure they exist and in correct format
			//in the input JSON
			$this->validation = $this->validationFactory->getusersvalidation();
		}
		
}
?>