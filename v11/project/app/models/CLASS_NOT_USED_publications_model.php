<?php
require_once "/config/config.inc.php";
require_once "/db/DAO_factory.php";
require_once "validation_functions.php";


class publicationsModel{

	public $DAO_Factory , $validationFactory;
	//factories
	public $publicationsDAO;
	public $apiResponse;

		public function __construct()
		{
			$this->DAO_Factory = new DAO_Factory();
			$this->DAO_Factory ->initDBResources();
			$this->publicationsDAO =$this->DAO_Factory->getPublicationsDAO();
			//$this ->validationFactory = new validation_factory();
		}
		
		public function isPublicationExisting($id)
		{
			return ($this->publicationsDAO->isPublicationExisting($id));
		}
		
		public function getPublications(){
			$publicationsList =$this->publicationsDAO->getPublications();
			return $publicationsList;
		}
		
		public function getPublication($id)
		{
			$publicationDetail =$this->publicationsDAO->getPublicationById($id);
			return $publicationDetail[0];
		}
		
		public function findPublicationsByString($str)
		{
			$publicationsList =$this->publicationsDAO->findPublicationsByString($str);
			return $publicationsList;
		}
	   //mege with update .. and add
		public function addPublication($title ,$authors ,$year ,$proceeding)
		{
			//echo ":::addPublication";
			return ($this->publicationsDAO->insertPublication($title ,$authors ,$year ,$proceeding));
		}
		
		public function updatePublication($id,$newTitle ,$newAuthors ,$newYear,$newProceeding) 
		{
			return ($this->publicationsDAO->updatePublication($id,$newTitle ,$newAuthors ,$newYear ,$newProceeding));
		}
		
		public function deletePublication($id)
		{
			$this->publicationsDAO->deletePublication($id);
		}
		
		public function __destruct()
		{
			$this->DAO_Factory->clearDBResources();
		}
}
?>