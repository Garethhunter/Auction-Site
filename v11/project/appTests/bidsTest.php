<?php
require_once("../simpletest/autorun.php");
require_once(dirname(__FILE__) . '/../'  . "/app/db/DAO_factory.php");



///tests the BID doa only and not the MVC , takes the normal PHP array as in our DOA

class BidsSQLTests extends UnitTestCase
{
	
		private $BidsDAO , $DAO_Factory;
		
		private $insertedid; //last value index for the inserting of a property so we can test the delete , update , of this item
			
		public function setUp(){
			
			$this->DAO_Factory = new DAO_Factory();
			$this->DAO_Factory->initDBResources();
			$this->BidsDAO =$this->DAO_Factory->getBidsDAO();
		}
		//add a item into the property database table
		public function testinsertItemArray()
		{
			
			
			$parameters["Bid_lowest_price"] = " 56";
			$parameters["bid_higest_price"] =  "32";
			$parameters["bid_description"] = "description";
			$parameters["bid_comments"] = "bid comments";
			$parameters["user_id"] = "1";
			$parameters["property_id"] =  "1";
					
		 	$this->assertTrue($this->BidsDAO->insertItemArray($parameters));
		 	$this->insertedid = $this->BidsDAO->getLast();
		  	echo "item no is " . $this->insertedid;
		 	
		 	$this->assertTrue($this->BidsDAO->isExisting($this->insertedid ));
		  	
		  	//compare the writen results by reading back from the database
		  	$compare = $this->BidsDAO->getItem($this->insertedid);
		 	$this->compareArrays($compare , $parameters);
		  	

		}
		public function testBadDateInsertArray()
		{
			$parameters["Bid_lowest_price"] = " 56";
			$parameters["bid_higest_price"] =  "32";
			$parameters["bid_description"] = "description";
			$parameters["bid_comments"] = "bid comments";
			$parameters["user_id"] = "1";
			$parameters["property_id"] =  "1";
			
		 	$this->assertTrue($this->BidsDAO->insertItemArray($parameters));
		 	
		}
		
		public function testgetAllPropertys()
		{
			$results = $this->BidsDAO->getAllItems();
			$this->assertTrue($results);
			echo  count($results) . " Items In Bids  table";
		}
			
		public function testgetItem()
		{
			//$this->assertFalse($this->BidsDAO->getItem("-45"));
		    $this->testgetItemException("abc");
		    $this->testgetItemException("%^45");
			//$this->assertFalse($this->BidsDAO->getItem("100876"));
		}
		private function testgetItemException($str)
		{
			try 
			{
			    $this->BidsDAO->getItem($str);
			    $this->fail("Exception was expected.");
			} 
			catch (Exception $e)
			{
			    $this->pass();
			}  
			
		}
		//updateItemArray
		public function testupdateItemArray()
		{
			echo "\n Updateing Item bids_id=" . $this->insertedid;
			
			$parameters["Bid_lowest_price"] = " 56";
			$parameters["bid_higest_price"] =  "32";
			$parameters["bid_description"] = "description";
			$parameters["bid_comments"] = "bid comments";
			$parameters["user_id"] = "1";
			$parameters["property_id"] =  "1";

			$this->assertTrue($this->BidsDAO->updateItemArray($this->insertedid , $parameters));
		 	$this->assertTrue($this->BidsDAO->isExisting($this->insertedid ));
		 	
		 	$compare = $this->BidsDAO->getItem($this->insertedid);
		 	
		 	$this->compareArrays($compare , $parameters);
		}
		private function compareArrays($compare , $parameters)
		{
		
			$this->assertEqual($compare["Bid_lowest_price"] ,$parameters["Bid_lowest_price"]) ;
			$this->assertEqual($compare["bid_higest_price"]  , $parameters["bid_higest_price"]);
			$this->assertEqual($compare["bid_description"] , $parameters["bid_description"]);
		 	$this->assertEqual($compare["bid_comments"] , $parameters["bid_comments"]);
		    $this->assertEqual($compare["user_id"] ,  $parameters["user_id"]);
		    $this->assertEqual($compare["property_id"] ,  $parameters["property_id"]);
		 
		 }
		///deleteItem
		public function testdeleteItem()
		{
			$this->assertTrue($this->BidsDAO->deleteItem($this->insertedid));	
			//try to read it back
			$this->assertFalse($this->BidsDAO->getItem($this->insertedid));	
			
		}
		
		public function tearDown(){
				$this ->validation = null;
		}
}
?>