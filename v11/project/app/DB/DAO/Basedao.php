<?php
abstract class BaseDAO 
{
		var $dbManager = null;

		function BaseDAO($dbMng) 
		{
			$this ->dbManager =$dbMng;
		}
		function getDbManager() 
		{
			return $this ->dbManager;
		}
		abstract public function isExisting($id);
		abstract public function getItem($id);
		abstract public function getItemAnd($id , $id2);
		abstract public function getAllItems();
		abstract public function insertItemArray($parameters);
		abstract public function updateItemArray($bid_id , $parameters);
		abstract public function deleteItem($id); 
		abstract public function getLast();
}
?>