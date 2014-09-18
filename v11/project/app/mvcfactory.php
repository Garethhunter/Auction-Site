<?php
require_once "/views/view.php";

//wrap up mvc in a class

class MVCFactory {
       
    function makeBidsMVC($action ,$app ,$parameters=null) {
        return new bidsMVC($action ,$app ,$parameters);
    }
     function makepropertiesMVC($action ,$app ,$parameters=null) {
        return new propertiesMVC($action ,$app ,$parameters);
   	}
   	//makeUsersMVC
	function makeUsersMVC($action ,$app ,$parameters=null) {
        return new usersMVC($action ,$app ,$parameters);
   	}
}

abstract class AbstractMVC
{
	protected $model,$view,$controller,$app,$action;
	
	function __construct($action ,$app ,$parameters=null)
    {
    	$this->action = $action;
		$this->app = $app;
		$this->parameters = $parameters; 
    }
    //lazy instantition only create view when called
	function show() {
		$this->view = new View($this->controller ,$this->model ,$this->app);
		$this->view->output();
    }
}


class bidsMVC extends AbstractMVC {
   
	function __construct($action ,$app ,$parameters=null)
    {
      	parent::__construct($action, $app ,$parameters);
    	require_once "/models/bidsmodel.php";
    	$this->model = new bidsModel();
    	require_once "/controller/bidscontroller.php";
		$this->controller = new bidsController($this->model ,$this->action ,$this->app , $this->parameters);
		$this->show();
	}
}

class propertiesMVC extends AbstractMVC {
   	 
    function __construct($action ,$app ,$parameters=null)
    {
       	parent::__construct($action, $app ,$parameters);
    	require_once "/models/propertiesmodel.php";
		$this->model = new propertiesModel();
		require_once "/controller/propertycontroller.php";
		$this->controller = new propertyController($this->model ,$this->action ,$this->app , $this->parameters);
		$this->show();
		
    }
}
class usersMVC extends AbstractMVC {
   	 
    function __construct($action ,$app ,$parameters=null)
    {
       	parent::__construct($action, $app ,$parameters);
    	require_once "/models/usersmodel.php";
		$this->model = new usersModel();
		require_once "/controller/userscontroller.php";
		$this->controller = new usersController($this->model ,$this->action ,$this->app , $this->parameters);
		$this->show();
		
    }
}



?>