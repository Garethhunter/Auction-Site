<?php
require_once("../simpletest/autorun.php");
require_once(dirname(__FILE__) . '/../'  . "/app/db/DAO_factory.php");
require_once "../Slim/Slim.php";
require_once "../app/config/config.inc.php";
require_once "../app/mvcfactory.php";
require_once "../app/controller/propertyController.php";
require_once "../app/models/propertiesmodel.php";


Slim\Slim::registerAutoloader();



//need to refactor as all the one class like in MVC factory // no need for view here
// as we are testing the classes not the MVC
class PropSLIMTests extends UnitTestCase
{
	
		private $app , $model;
		private $insertedid; //last value index for the inserting of a property so we can test the delete , update , of this item
			
		public function setUp()
		{
			$this->model = new propertiesModel();
			$this->app = new \Slim\Slim();  // just pretend to fit model
		}
		//add a bid gives HTTPSTATUS_CREATED if ok
		public function testaddBid()
		{
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-01-01\",\"auction_close_date\":\"0000-01-01\",\"property_comments\":\"dssjkgagfsakh\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
			$controller = new propertyController($this->model, ACTION_ADD ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual(HTTPSTATUS_CREATED , $status );
		}
		//update a bid gives HTTPSTATUS_OK if ok
		public function testuppdateBid()
		{
			$parameters["id"] = "10";
    		$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"dssjkgagfsakh\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_UPDATE ,$this->app , $parameters);
			$jsonResponse = json_encode($this->model->apiResponse);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual(HTTPSTATUS_OK , $status );
			
		}
		//add bid with a script tag and read it back to make sure it has been stripped off. to test for cross site scripting
		//<A HREF=\"http://trusted.org/search.cgi?criteria=<SCRIPT SRC='http://evil.org/badkama.js'></SCRIPT>\"> Go to trusted.org</A>
		public function testcrosssiteScriptingaddbadBid()
		{
	    	$parameters["id"] ="10";
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"gareth<SCRIPT SRC='http://evil.org/badkama.js'></SCRIPT>\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_UPDATE ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual(HTTPSTATUS_OK , $status );
			
			//read it back from the database to compare that the script is taken away
			$parameters1["id"] = "10";
			$controller = new propertyController($this->model,ACTION_GET ,$this->app , $parameters1);
			$status = $this->app->response->getStatus(); 
			$jsonResponse = json_encode($this->model->apiResponse);
			$this->assertNotEqual($jsonResponse , $parameters["json"] );
			
		}
		
		public function testcrosssiteScriptingaddbadBid2()
		{
	    	$parameters["id"] ="10";
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"<A HREF=\"http://trusted.org/search.cgi?criteria=<SCRIPT SRC='http://evil.org/badkama.js'></SCRIPT>\"> Go to trusted.org</A>\"\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_UPDATE ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual(HTTPSTATUS_BADREQUEST , $status );
			
			//read it back from the database to compare that the script is taken away
			$parameters1["id"] = "10";
			$controller = new propertyController($this->model,ACTION_GET ,$this->app , $parameters1);
			$status = $this->app->response->getStatus(); 
			$jsonResponse = json_encode($this->model->apiResponse);
			$this->assertNotEqual($jsonResponse , $parameters["json"] );
			
		}
	public function testcrosssiteScriptingaddbadBid3()
		{
	    	$parameters["id"] ="10";
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"<A HREF=\"http://trusted.org/search.cgi?criteria=<SCRIPT SRC='http://evil.org/badkama.js'></SCRIPT>\"> Go to trusted.org</A>\"\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_UPDATE ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
		    $this->assertEqual(HTTPSTATUS_BADREQUEST , $status );
			
			//read it back from the database to compare that the script is taken away
			$parameters1["id"] = "10";
			$controller = new propertyController($this->model,ACTION_GET ,$this->app , $parameters1);
			$status = $this->app->response->getStatus(); 
			$jsonResponse = json_encode($this->model->apiResponse);
			$this->assertNotEqual($jsonResponse , $parameters["json"] );
			
		}
		
		//add bid with a string for Bid_lowest_price should be error bid lowest_price MESSAGE_INVALID_BID_LOWEST_PRICE
		public function testBADaddBid()
		{
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-01-01\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"dssjkgagfsakh\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_ADD ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual($this->model->errordetails , MESSAGE_INVALID_BID_LOWEST_PRICE);
			$this->assertEqual(HTTPSTATUS_INTSERVERERR , $status );
			
		}
		//test bid_description > 100 chars
		public function testBADaddBid2()
		{
	 		$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"dssjkgagfsakh\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_ADD ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual($this->model->errordetails , MESSAGE_INVALID_BID_DESC);
			$this->assertEqual(HTTPSTATUS_INTSERVERERR , $status );
			
		}
		//test property_id =  chars
		public function testBADaddBid3()
		{
			$parameters["json"] ="{\"property_id\":\"2\",\"auction_start_date\":\"0000-00-00\",\"auction_close_date\":\"0000-00-\",\"property_comments\":\"dssjkgagfsakh\",\"property_address\":\"asgfjasfgaksd\",\"auction_actual_selling_price\":\"0.00\",\"property_reserve_price\":\"1.00\",\"current_successful_bidder_user\":\"6587568765\",\"property_photo\":\"1\",\"property_rooms\":\"6587568765\",\"property_description\":\"lhsedjfhlkhf\"}";
    		$controller = new propertyController($this->model,ACTION_ADD ,$this->app , $parameters);
			$status = $this->app->response->getStatus(); 
			$this->assertEqual($this->model->errordetails , MESSAGE_INVALID_BID_PROPID);
			$this->assertEqual(HTTPSTATUS_INTSERVERERR , $status );
			
		}
		
		public function tearDown(){
				
		}
				
	
}
?>