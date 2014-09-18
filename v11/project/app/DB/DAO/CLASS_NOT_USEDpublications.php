<?php

require_once("dao.php");

class publicationsDAO extends BaseDAO {

	function messagesDAO($dbMng)
	{
		parent::BaseDAO($dbMng);
	}
	public function isPublicationExisting($id){
		
		$sqlQuery ="SELECT count(*) as isExisting";
		$sqlQuery .=" FROM publications";
		$sqlQuery .=" WHERE id=$id";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		if($result[0]["isExisting"] == 1) 
				return (true);
		else return (false);
	}
	public function getPublications(){
		
		$sqlQuery ="SELECT * ";
		$sqlQuery .="FROM publications";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}
	public function getPublicationById($id)
	{
		
		$sqlQuery ="SELECT *";
		$sqlQuery .=" FROM publications";
		$sqlQuery .=" WHERE id='";
		$sqlQuery .= $id;
		$sqlQuery .="'";
		$result =$this->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}

	public function findPublicationsByString($str)
	{
		
		$sqlQuery= "SELECT *";
		$sqlQuery .=" FROM publications";
		$sqlQuery .=" WHERE title LIKE '%$str%'";
		$result =$this ->getDbManager()->executeSelectQuery($sqlQuery);
		return ($result);
	}
	public function insertPublication($title ,$authors ,$year ,$proceeding)
	{
		$sqlQuery = "INSERT INTO publications(title,authors,year,proceeding)";
		$sqlQuery .=" VALUES('$title','$authors','$year','$proceeding')";
		$result =$this->getDbManager()->executeInsertQuery($sqlQuery);
		return $result;
	}
	public function updatePublication($id,$newTitle ,$newAuthors ,$newYear,$newProceeding)
	{
		$sqlQuery ="UPDATE publications SET title='$newTitle', authors='$newAuthors', year='$newYear', proceeding='$newProceeding'";
		$sqlQuery .= " WHERE id=$id";
		$result =$this->getDbManager()->executeInsertQuery($sqlQuery);
		return $result;
	}
	
	public function deletePublication($id) 
	{
	
		$sqlQuery ="DELETE FROM publications";
		$sqlQuery .=" WHERE id =$id";
		$result =$this ->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
}


