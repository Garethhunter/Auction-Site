<?php
//controller is a abstast base class and is used to minise the code required as all controllers have the rest API have the same commands
//so we dont have to make different controoler code , for each database table all the same will do , and we can override in the extended class
//if needs be.. this class was refactored also to minimise the input parameters to the model , and now passed as just one parameter.
// the validation factory in the model takes care of the validation of these parameters. this class has to be extended to construct


abstract class baseController {

	protected $model,$slimApp;
		
    abstract protected function checkValidInputParameters($parameters);
	
	function __construct($model ,$action=null ,$slimApp ,$parameteres=null)
	{
		$this->model =$model;
		$this->slimApp =$slimApp;
		$requestPar =$this->slimApp->request()->params();
		$this->execute($parameteres ,$action);
	}
	
	private function execute($parameteres , $action=null)
	{
		if($action!=null)
			{
				//ACTION_GET_BID
				// noticed that all actions in a rest API are all the same either Get SomeThing , add Something
				//UPdate or delete so decicded to bundle them together , in this base class so we can reuse them , 
				// the model will be created by the Type and this will set the DAO objects based upon the table in database we are 
				//accessing , 
				switch($action) 
				{
						
						case ACTION_GETALL:
						$this->getAllItems();
						break;
						
						case ACTION_GET:
						$this->getItem($parameteres);
						break;
						
						case ACTION_ADD:
						$this->addItem($parameteres);
						break;
						
						case ACTION_UPDATE:
						$this->updateItem($parameteres);
						break;
						
						case ACTION_DELETE:
						$this->deleteItem($parameteres);
						break;
						
						case ACTION_GETIDWHEREID2:
						$this->getItemAnd($parameteres);
						break;
						
						
					default:
				}
				
			}
		
		
	}
	/*
	 * check that the ID is a valid number and that it is in the database
	 * returns OK if found
	 */
	public function checkValidIdExists($id)
	{
		if(is_numeric($id))
		{
			return  (($this->model->isExisting($id) ) ? HTTPSTATUS_OK : HTTPSTATUS_NOTFOUND );
		}
	    return HTTPSTATUS_BADREQUEST;
	}
	/*
	 * get all items in the database for a table
	 * 
	 * 	 
	*/
	public function getAllItems()
	{
		$this->model->apiResponse=$this->model->getAllItems();
		if(count($this->model->apiResponse)==0)
		{
			$this->slimApp->response->setStatus(HTTPSTATUS_NOCONTENT);
			$this->model->apiResponse=$this->model->errordetails;
		}
		else
		{
			$this->slimApp->response->setStatus(HTTPSTATUS_OK);	
		}
	}
	/*
	 * get a particular item , specified in parameters
	 */
	public function getItem($parameters)
	{
		$id = $parameters["id"];
		$IsValidId = $this->checkValidIdExists($id);
   		if($IsValidId == HTTPSTATUS_OK)
  		{
			$this->model->apiResponse=$this->model->getItem($id);
			$this->slimApp->response->setStatus(HTTPSTATUS_OK);
		}
		else 
		{
			$this->model->apiResponse=$this->model->errordetails;
			$this->slimApp->response->setStatus(HTTPSTATUS_NOCONTENT);
		}
	}
	public function addItem($parameters)
	{
	 	$status = HTTPSTATUS_BADREQUEST;
	 	$jo = $this->checkValidInputParameters($parameters);
	 	if($jo!=null)
	 	{
		 	$id =$this->model->insertItemJSON($parameters);
			if($id)
			{
					$this->model->apiResponse=HTTPSTATUS_CREATED;
					$status=HTTPSTATUS_CREATED;
			}
			else 
			{
					$status = HTTPSTATUS_INTSERVERERR;
					$this->model->apiResponse=$this->model->errordetails;
			}
	 	}
	 	$this->slimApp->response->setStatus($status);
	}
	
	public function deleteItem($parameters)
	{
		$id = $parameters["id"];
		$Status = $this->checkValidIdExists($id);
		if($Status == HTTPSTATUS_OK)
  		{
			$Status = $this->model->deleteItem($id);
		}
		$this->slimApp->response->setStatus($Status);
	
	}
	
	public function updateItem($parameters)
	{
		$status = HTTPSTATUS_BADREQUEST;
		$id=$parameters["id"];
		$jo = $this->checkValidInputParameters($parameters);
		if($jo!=null && isset($id)) 
		{
			if($this->model->isExisting($id))
			{
				
				$jsonResponse = $this->model->UpdateItemJSON( $id , $parameters);
				$this->model->apiResponse=$jsonResponse;	
				$status = HTTPSTATUS_OK;
			}
			else 
			{
				$this->model->apiResponse= $this->model->errordetails;
				$status = HTTPSTATUS_NOTFOUND;	
			}		
		}
		$this->slimApp->response->setStatus($status);
	
	}
	
	public function getItemAnd($parameters)
	{
		
		$id1 = $parameters["id"];
		$id2  = $parameters["id2"];
		//$IsValidId = $this->checkValidIdExists($id);
   		//if($IsValidId == HTTPSTATUS_OK)
  		//{
			$this->model->apiResponse=$this->model->getItemAnd($id1 , $id2);
			$this->slimApp->response->setStatus(HTTPSTATUS_OK);
		//}
		//else 
		//{
		//	$this ->slimApp->response->setStatus($IsValidId);
		//}
	   
	}
	
}
?>