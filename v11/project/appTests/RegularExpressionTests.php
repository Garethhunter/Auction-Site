<?php
require_once("../simpletest/autorun.php");

class emailRegularExpressionTests extends UnitTestCase
{

		private $validation;
			
		public function setUp(){
			require_once("../app/models/validation/bidsvalidation.php");
			$this ->validation = new BidsValidation();
		
		}
		public function testEmptyAndValidEmails(){
			$this->assertFalse($this->validation->validateEMAIL(""));
			$this->assertTrue($this->validation->validateEMAIL("luca.longo@dit.ie"));
			$this->assertTrue($this->validation->validateEMAIL("luca_1.2.3_longo@dit.ie"));
			$this->assertTrue($this->validation->validateEMAIL("mr.luca.longo@dit.ie"));
		}
			
			
		public function testStrangeSymbolsInEmailsAndDots(){
			$this ->assertFalse($this->validation->validateEMAIL("luca.longo@@dit.ie"));
			$this ->assertFalse($this->validation->validateEMAIL(".luca.longo@dit.ie"));
			$this ->assertFalse($this->validation->validateEMAIL("luca.longo@.dit.ie"));
			$this ->assertFalse($this->validation->validateEMAIL("luca.longo@dit..ie"));
		}
			
		public function testDomainEmailParts(){
			
			$this ->assertTrue($this ->validation ->validateEMAIL("luca.longo@dit.co.uk"));
			$this ->assertTrue($this ->validation ->validateEMAIL("luca.longo@dit.aa.aa.aa.aa"));
		}
			
		public function testBeginningPartOfEmails(){
			$this->assertFalse($this ->validation->validateEMAIL("ˆluca.longo@dit.ie"));
			$this->assertTrue($this ->validation->validateEMAIL("_luca.longo@dit.ie"));
		}
		
		public function testfailAll(){
			
			$this->assertFalse($this->validation->isLengthStringValid("4565675" , 5));
			$this->assertFalse($this->validation->checkNumber("luca.longo@dit.ie", 4));
			$this->assertFalse($this->validation->isNumber("luca_1.2.3_longo@dit.ie"));
			$this->assertFalse($this->validation->isCurrency("mr.luca.longo@dit.ie"));
			$this->assertFalse($this->validation->isDate("mr.luca.longo@dit.ie"));
			
		}
		public function testAll2(){
			$this->assertFalse($this->validation->isLengthStringValid("476547654754754754" , 6));
			$this->assertTrue($this->validation->checkNumber("55" , 2));
			$this->assertTrue($this->validation->isNumber("5764"));
			$this->assertTrue($this->validation->isCurrency("34"));
			$this->assertTrue($this->validation->isCurrency("34.34"));
			$this->assertTrue($this->validation->isCurrency("343456"));
			$this->assertTrue($this->validation->isDate("2010-12-01"));
			$this->assertTrue($this->validation->isDate("2010-12-12"));
			$this->assertFalse($this->validation->isDate("10-12-12"));
			$this->assertFalse($this->validation->isDate("13-13-13"));
			$this->assertTrue($this->validation->isDate("0001-01-01"));
		}
		
			
		public function tearDown(){
				$this ->validation = null;
		}
}
?>