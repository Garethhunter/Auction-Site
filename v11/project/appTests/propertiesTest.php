<?php
require_once("../simpletest/autorun.php");
require_once(dirname(__FILE__) . '/../'  . "/app/db/DAO_factory.php");



class PropertieSQLTests extends UnitTestCase
{
	
		private $propDAO , $DAO_Factory;
		
		private $insertedid; //last value index for the inserting of a property so we can test the delete , update , of this item
			
		public function setUp(){
			
			$this->DAO_Factory = new DAO_Factory();
			$this->DAO_Factory->initDBResources();
			$this->propDAO =$this->DAO_Factory->getPropertiesDAO();
		}
		//add a item into the property database table
		public function testinsertItemArray()
		{
			$parameters["property_description"] ="lhsedjfhlkhf";
			$parameters["auction_start_date"] = "2011-06-06";
			$parameters["auction_close_date"] = "2011-06-06";
		 	$parameters["auction_actual_selling_price"] = "300";
		    $parameters["property_reserve_price"] = "1";
		    $parameters["current_successful_bidder_user"] = "user 5";
		 	$parameters["property_comments"] = "comments";
		    $parameters["property_photo"] = "1";
		    $parameters["property_rooms"] = "56";
		    $parameters["property_address"] = "out there somewhere";
		 	$this->assertTrue($this->propDAO->insertItemArray($parameters));
		 	$this->insertedid = $this->propDAO->getLast();
		  	$this->assertTrue($this->propDAO->isExisting($this->insertedid ));
		  	
		  	//compare the writen results by reading back from the database
		  	$compare = $this->propDAO->getItem($this->insertedid);
		 	$this->compareArrays($compare , $parameters);
		  	

		}
		public function testBadDateInsertArray()
		{
			$parameters["property_description"] ="lhsedjfhlkhf";
			$parameters["auction_start_date"] = "hfsafgaksgfaks";
			$parameters["auction_close_date"] = "asgfjasfgaksd";
		 	$parameters["auction_actual_selling_price"] = "dssjkgagfsakh";
		    $parameters["property_reserve_price"] = "1";
		    $parameters["current_successful_bidder_user"] = "6587568765";
		 	$parameters["property_comments"] = "dssjkgagfsakh";
		    $parameters["property_photo"] = "1";
		    $parameters["property_rooms"] = "6587568765";
		    $parameters["property_address"] = "asgfjasfgaksd";
		 	$this->assertTrue($this->propDAO->insertItemArray($parameters));
		 	
		}
		
		public function testgetAllPropertys()
		{
			$results = $this->propDAO->getAllItems();
			$this->assertTrue($results);
			echo  count($results) . " Items In Propertys  table";
		}
			
		public function testgetItem()
		{
			$this->assertTrue($this->propDAO->getItem("2"));
			$this->assertTrue($this->propDAO->getItem("4"));
			$this->assertFalse($this->propDAO->getItem("-45"));
		    $this->testgetItemException("abc");
		    $this->testgetItemException("%^45");
			$this->assertFalse($this->propDAO->getItem("100876"));
		}
		private function testgetItemException($str)
		{
			try 
			{
			    $this->propDAO->getItem($str);
			    $this->fail("Exception was expected.");
			} 
			catch (Exception $e)
			{
			    $this->pass();
			}  
			
		}
		public function testSQLInjection()
		{
			
		}	

		
		public function testcrossSiteXSS()
		{
			
		}	
		//updateItemArray
		public function testupdateItemArray()
		{
			echo "\n Updateing Item property_id=" . $this->insertedid;
			$parameters["property_description"] ="new description";
			$parameters["auction_start_date"] = "2001-06-09";
			$parameters["auction_close_date"] = "2008-06-09";
		 	$parameters["auction_actual_selling_price"] = "340";
		    $parameters["property_reserve_price"] = "300";
		    $parameters["current_successful_bidder_user"] = "user1";
		 	$parameters["property_comments"] = "new comments";
		    $parameters["property_photo"] = "new 1";
		    $parameters["property_rooms"] = "5";
		    $parameters["property_address"] = "new address";
		    
		 	$this->assertTrue($this->propDAO->updateItemArray($this->insertedid , $parameters));
		 	
		 	$this->assertTrue($this->propDAO->isExisting($this->insertedid ));
		 	
		 	$compare = $this->propDAO->getItem($this->insertedid);
		 	
		 	$this->compareArrays($compare , $parameters);
		}
		private function compareArrays($compare , $parameters)
		{
			$this->assertEqual($compare["property_description"] ,$parameters["property_description"]) ;
			$this->assertEqual($compare["auction_start_date"]  , $parameters["auction_start_date"]);
			$this->assertEqual($compare["auction_close_date"] , $parameters["auction_close_date"]);
		 	$this->assertEqual($compare["auction_actual_selling_price"] , $parameters["auction_actual_selling_price"]);
		    $this->assertEqual($compare["property_reserve_price"] ,  $parameters["property_reserve_price"]);
		    $this->assertEqual($compare["current_successful_bidder_user"] ,  $parameters["current_successful_bidder_user"]);
		 	$this->assertEqual($compare["property_comments"] , $parameters["property_comments"]);
		    $this->assertEqual($compare["property_photo"] , $parameters["property_photo"]);
		    $this->assertEqual($compare["property_rooms"] , $parameters["property_rooms"]);
		    $this->assertEqual($compare["property_address"], $parameters["property_address"]);
		 }
		///deleteItem
		public function testdeleteItem()
		{
			$this->assertTrue($this->propDAO->deleteItem($this->insertedid));	
			//try to read it back
			$this->assertFalse($this->propDAO->getItem($this->insertedid));	
			
		}
		
		public function tearDown(){
				$this ->validation = null;
		}
}
?>