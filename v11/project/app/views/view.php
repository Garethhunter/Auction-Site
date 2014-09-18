<?php
//only one view Required for all models
//but new views can be implemented if need be ie a XML output or html
//this view sets JSON as the output or just add xml method ie
/*
 * 	
		public function outputXML(){
			$XMLresponse = xml_encode($this->model->apiResponse);
			$this->slimApp->response->write($XMLresponse);
		}
 */

class View
{
	private $model ,$controller ,$slimApp;

		public function __construct($controller ,$model ,$slimApp) {
			$this ->controller =$controller;
			$this ->model =$model;
			$this ->slimApp =$slimApp;
		}
		
		public function output(){
			$jsonResponse = json_encode($this->model->apiResponse);
			$this->slimApp->response->write($jsonResponse);
		}
}
?>