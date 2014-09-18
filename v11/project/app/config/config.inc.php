<?php
//setup database info 
define("DB_HOST","localhost");
define("DB_USER","slim");
define("DB_PASS","password");
define("DB_NAME","assignment");
define("DB_PORT", 3306);


define("MESSAGE_NO_INPUT_JSON","no input JSON or invalid"); //id of interactive form
/*
 * NO NEED FOR THESE ANTMORE  AS CONCRETE CLASSES KNOW WHAT OBJECTS THEY CALL
 * 
			
			define("ACTION_GET_BIDS", 7);
			define("ACTION_GET_BID", 8);
			define("ACTION_ADD_BID", 9);
			define("ACTION_UPDATE_BID", 10);
			define("ACTION_DELETE_BID", 11);
			define("ACTION_GET_PROPERTY", 12);
			define("ACTION_GET_PROPERTYS", 13);
			define("ACTION_ADD_PROPERTY", 14);
			define("ACTION_UPDATE_PROPERTY", 15);
			define("ACTION_DELETE_PROPERTY", 16);
			define("ACTION_GET_PUBLICATIONS", 1);
			define("ACTION_GET_PUBLICATION", 2);
			define("ACTION_SEARCH_PUBLICATIONS", 3);
			define("ACTION_ADD_PUBLICATION", 4);
			define("ACTION_UPDATE_PUBLICATION", 5);
			define("ACTION_DELETE_PUBLICATION", 6);
 */
/*
 * now defined as 
 */

define("ACTION_GET", 12);
define("ACTION_GETALL", 13);
define("ACTION_ADD", 14);
define("ACTION_UPDATE", 15);
define("ACTION_DELETE", 16);
define("ACTION_GETIDWHEREID2", 17);
define("ACTION_ADDID2", 18);


/*
 * RETURN CODES TO CONFORM WITH REST API
 
 */

define("HTTPSTATUS_OK", 200);
define("HTTPSTATUS_CREATED", 201);
define("HTTPSTATUS_NOCONTENT", 204);
define("HTTPSTATUS_BADREQUEST", 400);
define("HTTPSTATUS_NOTFOUND", 404);
define("HTTPSTATUS_INTSERVERERR", 500);

/*
 * RETURN CODES FOR ERROR MESSAGES BIDS
*/
define("MESSAGE_INVALID_BID_DESC","INVALID input parameter in JSON  bid_description"); 
define("MESSAGE_INVALID_BID_COMMENTS","INVALID input parameter in JSON  bid_comments"); 
define("MESSAGE_INVALID_BID_USER","INVALID input parameter in JSON user_id"); 
define("MESSAGE_INVALID_BID_PROPID","INVALID input parameter in JSON property_id"); 
define("MESSAGE_INVALID_BID_LOWEST_PRICE","INVALID input parameter in JSON Bid_lowest_price"); 
define("MESSAGE_INVALID_BID_HIGEST_PRICE","INVALID input parameter in JSON bid_higest_price"); 
/*
 * RETURN CODES FOR ERROR MESSAGES prop
*/
define("MESSAGE_INVALID_PROP_DESC","INVALID input parameter in JSON  property_description"); 
define("MESSAGE_INVALID_PROP_STARTDATE","INVALID input parameter in JSON  auction_start_date"); 
define("MESSAGE_INVALID_PROP_CLOSEDATE","INVALID input parameter in JSON auction_close_date"); 
define("MESSAGE_INVALID_PROP_SPRICE","INVALID input parameter in JSON auction_actual_selling_price"); 
define("MESSAGE_INVALID_PROP_RPRICE","INVALID input parameter in JSON property_reserve_price"); 
define("MESSAGE_INVALID_PROP_SBIDDER","INVALID input parameter in JSON current_successful_bidder_user"); 
define("MESSAGE_INVALID_PROP_PCOMMENTS","INVALID input parameter in JSON property_comments"); 
define("MESSAGE_INVALID_PROP_PPHOTO","INVALID input parameter in JSON property_photo"); 
define("MESSAGE_INVALID_PROP_ROOMS","INVALID input parameter in JSON property_rooms"); 
define("MESSAGE_INVALID_PROP_ADDRESS","INVALID input parameter in JSON property_address"); 

?>