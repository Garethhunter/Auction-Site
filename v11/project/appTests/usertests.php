<?php
require_once("../simpletest/autorun.php");
require_once(dirname(__FILE__) . '/../'  . "/app/db/DAO_factory.php");



class userSQLTests extends UnitTestCase
{
	
		private $userDAO , $DAO_Factory;
		
		private $insertedid; //last value index for the inserting of a property so we can test the delete , update , of this item
			
		public function setUp(){
			
			$this->DAO_Factory = new DAO_Factory();
			$this->DAO_Factory->initDBResources();
			$this->userDAO =$this->DAO_Factory->getUsersDAO();
		}
		//add a item into the property database table
		public function testinsertItemArray()
		{
			
			$parameters["user_id"] = "1";	
			$parameters["user_name"] = "gareth";
			$parameters["user_address"] = " outh there";
			$parameters["user_email"] = " user@dit.ie";
			$parameters["user_phone"] = "12345";
			$parameters["user_password"] = "apassword";
			$parameters["user_description"] = " A bidder";
					
		 	$this->assertTrue($this->userDAO->insertItemArray($parameters));
		 	$this->insertedid = $this->userDAO->getLast();
		  	echo "item no is " . $this->insertedid;
		 	
		 	$this->assertTrue($this->userDAO->isExisting($this->insertedid ));
		  	
		  	//compare the writen results by reading back from the database
		  	$compare = $this->userDAO->getItem($this->insertedid);
		 	//$this->compareArrays($compare , $parameters);
		  	

		}
		public function testinsertItemArray2()
		{
			
			$parameters["user_id"] = "5";	
			$parameters["user_name"] = "gareth5";
			$parameters["user_address"] = " outh there5";
			$parameters["user_email"] = " user5@dit.ie";
			$parameters["user_phone"] = "12345";
			$parameters["user_password"] = "apassword5";
			$parameters["user_description"] = " A 5 bidder";
					
		 	$this->assertTrue($this->userDAO->insertItemArray($parameters));
		 	$this->insertedid = $this->userDAO->getLast();
		  	echo "item no is " . $this->insertedid;
		 	
		 	$this->assertTrue($this->userDAO->isExisting($this->insertedid ));
		  	
		  	//compare the writen results by reading back from the database
		  	$compare = $this->userDAO->getItem($this->insertedid);
		 	//$this->compareArrays($compare , $parameters);
		  	

		}
		public function testBadDateInsertArray()
		{
			$parameters["user_name"] = "gareth";
			$parameters["user_address"] = " outh there";
			$parameters["user_email"] = " user@dit.ie";
			$parameters["user_phone"] = "12345";
			$parameters["user_password"] = "apassword";
			$parameters["user_description"] = " A bidder";
			
		 	$this->assertTrue($this->userDAO->insertItemArray($parameters));
		 	
		}
		
		public function testgetAllPropertys()
		{
			$results = $this->userDAO->getAllItems();
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
			    $this->userDAO->getItem($str);
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
			

			$parameters["user_name"] = "gareth";
			$parameters["user_address"] = " outh there";
			$parameters["user_email"] = " user@dit.ie";
			$parameters["user_phone"] = "12345";
			$parameters["user_password"] = "apassword";
			$parameters["user_description"] = " A bidder";

			$this->assertTrue($this->userDAO->updateItemArray($this->insertedid , $parameters));
		 	$this->assertTrue($this->userDAO->isExisting($this->insertedid ));
		 	
		 	$compare = $this->userDAO->getItem($this->insertedid);
		 	
		 	//$this->compareArrays($compare , $parameters);
		}
		
		private function compareArrays($compare , $parameters)
		{
			 //$this->assertEqual($compare["user_id"] , $parameters["user_id"]);
			 $this->assertEqual($compare["user_name"] , $parameters["user_name"]);
			 $this->assertEqual($compare["user_address"], $parameters["user_address"]);
			 $this->assertEqual($compare["user_email"] , $parameters["user_email"]);
			 $this->assertEqual($compare["user_phone"] , $parameters["user_phone"]);
			 $this->assertEqual($compare["user_password"] , $parameters["user_password"] );
			 $this->assertEqual($compare["user_description"], $parameters["user_description"]);
		 }
		///deleteItem
		public function testdeleteItem()
		{
			$this->assertTrue($this->userDAO->deleteItem($this->insertedid));	
			//try to read it back
			$this->assertFalse($this->userDAO->getItem($this->insertedid));	
			
		}
		
		public function tearDown(){
				$this ->validation = null;
		}
}
?>