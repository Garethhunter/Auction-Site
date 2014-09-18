<?php

require_once "../Slim/Slim.php";
require_once "/config/config.inc.php";
require_once "mvcfactory.php";


Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$MVCfactory = new MVCFactory();

	$app->get("/", function () use ($app)
	{		
		echo "invalid url! see API guide";
	});
	$app->get("/bids", function () use ($app , $MVCfactory)
	{
			$MVC1 =  $MVCfactory->makeBidsMVC(ACTION_GETALL ,$app);
	});
	$app->get("/bids/:id", function ($id) use ($app , $MVCfactory)
	{	
			$parameters["id"] =$id;	
			$MVC1 =  $MVCfactory->makeBidsMVC(ACTION_GET ,$app , $parameters);
	});
	$app->post("/bids", function () use ($app , $MVCfactory)
	{
			$parameters["json"]=$app->request->getBody();
			 $MVCfactory->makeBidsMVC(ACTION_ADD ,$app , $parameters);
	});
	$app->put("/bids/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makeBidsMVC(ACTION_UPDATE ,$app , $parameters);
	});
	$app->delete("/bids/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$MVCfactory->makeBidsMVC(ACTION_DELETE ,$app , $parameters);
	});	
	//http://localhost/bids/PROPID
	$app->get("/bids/:userid/:propertyID", function ($userid ,$propertyID ) use ($app , $MVCfactory)
	{	
		    $parameters["id"] =$userid;
			$parameters["id2"] =$propertyID;	
			$MVCfactory->makeBidsMVC(ACTION_GETIDWHEREID2 ,$app , $parameters);
	});
	$app->post("/bids/:userid/:propID", function ($userid ,$propID ) use ($app , $MVCfactory)
	{	
			$parameters["json"]=$app->request->getBody();
			$parameters["user_id"] =$userid;
			$parameters["property_id"] =$propID;
			$MVCfactory->makeBidsMVC(ACTION_ADD ,$app , $parameters);
	});
	//// propertys api
	$app->get("/property", function () use ($app , $MVCfactory)
	{
			 $MVCfactory->makepropertiesMVC(ACTION_GETALL ,$app);
	});
	
	$app->get("/property/:id", function ($id) use ($app , $MVCfactory)
	{	
			$parameters["id"] =$id;	
			$MVCfactory->makepropertiesMVC(ACTION_GET ,$app , $parameters);
	});
		
	$app->post("/property", function () use ($app , $MVCfactory)
	{
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makepropertiesMVC(ACTION_ADD ,$app , $parameters);
	});
	$app->put("/property/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makepropertiesMVC(ACTION_UPDATE ,$app , $parameters);
	});
	$app->delete("/property/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$MVCfactory->makepropertiesMVC(ACTION_DELETE ,$app , $parameters);
	});	
	//users  Api
	$app->get("/users", function () use ($app , $MVCfactory)
	{
			$MVCfactory->makeUsersMVC(ACTION_GETALL ,$app);
	});
	//get user with ID
	$app->get("/users/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makeUsersMVC(ACTION_GET ,$app , $parameters);
	});
	//Add new user
	$app->post("/users", function () use ($app , $MVCfactory)
	{
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makeUsersMVC(ACTION_ADD ,$app , $parameters);
	});
	//Update a user
	$app->put("/users/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$parameters["json"]=$app->request->getBody();
			$MVCfactory->makeUsersMVC(ACTION_UPDATE ,$app , $parameters);
	});
	$app->get("/users/:id/request", function ($id) use ($app , $MVCfactory)
	{
		echo "request password user id $id not implemted";
		//read email for user
		//send email with chang pw link..
		//$MVC1 =  $MVCfactory->makeUsersMVC(ACTION_GETALL ,$app);
		
	});
	$app->delete("/users/:id", function ($id) use ($app , $MVCfactory)
	{
			$parameters["id"]=$id;
			$MVCfactory->makeUsersMVC(ACTION_DELETE ,$app , $parameters);
	});	
	//get list of bids for user cant user bids/userID as USERID and BIDID will clash
	$app->get("/users/bids/:userid", function ($userid) use ($app , $MVCfactory)
	{
		$parameters["id"] =$userid;
		$parameters["id2"] ="";
		$MVCfactory->makeBidsMVC(ACTION_GETIDWHEREID2 ,$app , $parameters);
	});
	//http://localhost/admin/bids/PROPID
	//get a list of all bids for a particular property
	//This is an admin function , only to be executed by the administator
	//so when authenacation is added we will need to harden this function
	$app->get("/admin/bids/:propid", function ($propid) use ($app , $MVCfactory)
	{
		$parameters["id"] ="";
		$parameters["id2"] =$propid;
		$MVCfactory->makeBidsMVC(ACTION_GETIDWHEREID2 ,$app , $parameters);
	});
	//post a image to the server .. no bounds check for the moment
	//just used to test how to upload file to the server ..
	//stored in this directory call pics , need to harden all this
	//as extremely open to security exploits
	//cant get IMAGE to work with JSON yet , need to convert to base64 ect
	//this is only to test my API
	//so we just read binary and normal paramters

	$app->post("/image/", function () use ($app , $MVCfactory)
	{
		//$property_id = $app->request()->get('property_id');
		if(isset($_FILES['file']['name']))
		{
	  		var_dump($_FILES);
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
	  		$target_path = $destination_path . DIRECTORY_SEPARATOR . "pics" . DIRECTORY_SEPARATOR . $property_id . DIRECTORY_SEPARATOR ;
			if (!is_dir($target_path)) 
			{
    			mkdir($target_path, 0700);    
			}
			if(@move_uploaded_file($_FILES['file']['tmp_name'], $target_path . basename( $_FILES['file']['name'])))
			{
	      		//now update the DB ....
				
				echo "<<<<<<<<<ok>>>>>>>>>>>>";
	   		}
		}

	});
   
	
	
	//run slim
	$app->response()->header("Content-Type" , "application/json; charset=utf-8");
	$app->run();

?>