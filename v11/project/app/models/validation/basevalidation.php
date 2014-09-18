<?php

class baseValidation {

	var $ValidationManager = null;
	var $errordetails;

	function BasBaseValidatione($ValidationManager) 
	{
		$this ->$ValidationManager =$ValidationManager;
	}
	function getValidationManager() 
	{
		return $this->$ValidationManager;
	}
	
	function validateEMAILold($EMAIL) 
	{
		$regex ="/ˆ[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
	    if(!preg_match($regex ,$EMAIL)) return (false);
		else return (true);
		
		//return (bool)preg_match($regex, $EMAIL);
	}
	function validateEMAIL($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}
	public function isNumberInRangeValid()
	{
	
	}
	public function isLengthStringValid($string ,$maxchars)
	{
		if(is_string($string))
		if(strlen($string)<=$maxchars) return (true);
		return (false);
	}
	function checkNumber($num, $length)
	{
	  if($num > 0 && strlen($num) == $length)
	  {
	  	 return true;
	  }
	  return false;
	
	}
	function isNumber($data)
	{
		return is_numeric($data);
	}
	function isCurrency($number)
	{
  		return (preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number)) ? true : !is_numeric($number) ;
	}
	//from stack overflow 
	//http://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format
	function isDate($date)
	{
		$split = array();
		if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $split) ||
		//added me
			preg_match ("/^([0-9]{2})/([0-9]{2})/([0-9]{4})$/", $date, $split) ||
			preg_match ("/^([0-9]{4})/([0-9]{2})/([0-9]{2})$/", $date, $split)
		)
		{
		   if(checkdate($split[2],$split[3],$split[1]))
		   {
		      return true;
		   }
		   else
		   {
		     return false;
		   }
		}
		else
		{
	  		return false;
		}
		
	}
	
}


?>