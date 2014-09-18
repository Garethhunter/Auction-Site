<?php


class validation_Factory {
	private $validationManager;
	
	function getvalidationManager() 
	{
		if($this->$validationManager == null)
			throw new Exception("No validation link " );
		return $this ->$validationManager;
	}
	function getBidsvalidation() 
	{
		require_once("bidsvalidation.php");
		return new bidsValidation($this ->$validationManager());
	}
	function getpropertiesvalidation() 
	{
		require_once("propertiesvalidation.php");
		return new propertiesValidation($this ->$validationManager());
	}
	function getusersvalidation() 
	{
		require_once("uservalidation.php");
		return new userValidation($this ->$validationManager());
	}
	

}
?>