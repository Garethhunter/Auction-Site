
<?php
require_once "simple_db_manager.php";

class DAO_Factory {
	private $dbManager;
	
	function getDbManager() 
	{
		if($this->dbManager == null)
			throw new Exception("No persistence storage link " );
		return $this ->dbManager;
	}
	
	function initDBResources() 
	{
		$this->dbManager = new dbmanager();
		$this->dbManager->openConnection();
	}
	
	function clearDBResources() 
	{
		if($this->dbManager != null)
			$this->dbManager ->closeConnection();
	}
	
	function getBidsDAO() 
	{
		require_once("dao/bidsDAO.php");
		return new bidsDAO($this ->getDbManager());
	}
	
	
	function getPropertiesDAO() 
	{
		require_once("dao/propertiesDAO.php");
		return new propertiesDAO($this ->getDbManager());
	}
	function getUsersDAO() 
	{
		require_once("dao/usersDAO.php");
		return new usersDAO($this ->getDbManager());
	}

}
?>
