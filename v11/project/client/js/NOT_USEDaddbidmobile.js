// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";
var currentBid;

//$('#btnSavebid').click(function() {
//	if ($('#bid_id').val() == '')
//		addBid();
//	else
//		updateBid();
//	return false;
//});


function addBid() {
	console.log('addBid1');
	$.ajax({
		type : 'POST',
		contentType : 'application/json',
		url : rootURL + 'bids',
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) {
			console.log('bid created successfully');
			
	
		},
		error : function(jqXHR, textStatus, errorThrown) { alert("bid nont saved");console.log('addbid error: ' + textStatus + errorThrown); }
	});
}

//Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	return JSON.stringify({
		"bid_id" : $('#bid_id').val(),
		"Bid_lowest_price" : $('#Bid_lowest_price').val(),
		"bid_higest_price" : $('#bid_higest_price').val(),
		"bid_description" : $('#bid_description').val(),
		"bid_comments" : $('#bid_comments').val(),
		"user_id" : $('#user_id').val(),
		"property_id" : $('#property_id').val(),
	});
}