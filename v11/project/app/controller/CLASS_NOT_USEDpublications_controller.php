<?php

class publicationsController{

private $model ,$slimApp;

public function __construct($model ,$action=null ,$slimApp ,$parameteres=null)
{

$this->model =$model;

$this->slimApp =$slimApp;
$requestPar =$this->slimApp->request()->params();

	if($action!=null)
	{
		switch($action) 
			{
				case ACTION_GET_PUBLICATIONS:
				$this->getPublications();
				break;
				
				case ACTION_GET_PUBLICATION:
				$this->getPublication($parameteres);
				break;
				
				case ACTION_SEARCH_PUBLICATIONS:
				$this->findPublicationsByString($parameteres);
				break;
				
				case ACTION_ADD_PUBLICATION:
				$this->addPublication($parameteres);
				break;
				
				case ACTION_UPDATE_PUBLICATION:
				$this ->updatePublication($parameteres);
				break;
				
				case ACTION_DELETE_PUBLICATION:
				$this->deletePublication($parameteres);
				break;
				
				default:
			}
		
	}
}

private function getPublications(){
	$this ->model ->apiResponse =$this ->model ->getPublications();
	
	if(count($this ->model ->apiResponse)==0)
		$this ->slimApp ->response ->setStatus(HTTPSTATUS_NOCONTENT);
	else
		$this ->slimApp ->response ->setStatus(HTTPSTATUS_OK);
	
}


private function getPublication($parameters)
{
	$id =$parameters["id"];
	if(isset($id))
	{
			if(is_numeric($id)){
				if($this ->model ->isPublicationExisting($id))
				{
					$this ->model ->apiResponse =$this ->model ->getPublication($id);
					$this ->slimApp ->response ->setStatus(HTTPSTATUS_OK);
					return;
				}
			}
	else
	{
		$this ->slimApp ->response ->setStatus(HTTPSTATUS_BADREQUEST);
		return;
	}
	}
	$this ->slimApp ->response ->setStatus(HTTPSTATUS_NOTFOUND);

}
private function findPublicationsByString($parameters){
	$query =$parameters["query"];
	$this ->model ->apiResponse =$this->model->findPublicationsByString($query);
	$this ->slimApp ->response ->setStatus(HTTPSTATUS_OK);
}

//refactor
private function checkValidJsonParameters($parameters)
{
   $jo = null;
   $inputJson =$parameters["json"];
   if( isset($inputJson) )
	{
		$joTemp = json_decode($inputJson ,true);
		if(isset($joTemp["title"]) && isset($joTemp["authors"]) && isset($joTemp["year"]) && isset($joTemp["proceeding"]) )
		{
			$jo = $joTemp;	
		}
	}
	return $jo;
}
//refactor
private function addPublication($parameters)
{
	$status = HTTPSTATUS_BADREQUEST;
    $jo = $this->checkValidJsonParameters($parameters);
	if($jo!=null)
	{
		$id =$this->model->addPublication($jo["title"],$jo["authors"],$jo["year"],$jo["proceeding"]);
		if($id)
		{
				$jsonResponse["Location"]="publications/$id";
				$this->model->apiResponse=$jsonResponse;
				$status=HTTPSTATUS_CREATED;
		}
		else 
		{
			$status = HTTPSTATUS_INTSERVERERR;
		}
	}
	$this->slimApp->response->setStatus($status);
}
//refactor
private function updatePublication($parameters)
{
	$status = HTTPSTATUS_BADREQUEST;
	$id=$parameters["id"];
	$jo = $this->checkValidJsonParameters($parameters);
	if($jo!=null && isset($id)) 
	{
			if(is_numeric($jo["year"]))
			{
				if($this->model->isPublicationExisting($id))
				{
						$id =$this->model->updatePublication($id,$jo["title"],$jo["authors"],$jo["year"],$jo["proceeding"]);
						$status = HTTPSTATUS_OK;
				}
				else 
					$status = HTTPSTATUS_NOTFOUND;			
			}
	}
	$this->slimApp->response->setStatus($status);
}

private function deletePublication($parameters)
{
	$id =$parameters["id"];
	if($this->model->isPublicationExisting($id))
	{
		$this->model->deletePublication($id);
		$this->slimApp->response->setStatus(HTTPSTATUS_OK);
		
	}
	else 
	{
		$this ->slimApp ->response ->setStatus(HTTPSTATUS_NOTFOUND);
	}
}
}
?>