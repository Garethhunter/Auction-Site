// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";


$(document).on('click', '#btnPropSave', function(e){
	alert(formToJSON());	
	addProperty();
});



function addProperty() {
	console.log('addProperty');
	$.ajax({
		type : 'POST',
		contentType : 'application/json',
		url : rootURL + 'property',
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) {
			console.log('Property created successfully');
			 $.mobile.reloadPage ( 'index.html');
		},
		error : function(jqXHR, textStatus, errorThrown) { alert('property nont saved'); console.log('addProperty error: ' + textStatus + errorThrown); }
	});
}


//Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	return JSON.stringify({
		
		"property_id" : $('#property_id').val(),
		"property_description" : $('#property_description').val(),
		"auction_start_date" : $('#auction_start_date').val(),
		"auction_close_date" : $('#auction_close_date').val(),
		"auction_actual_selling_price" : $('#auction_actual_selling_price').val(),
		"property_reserve_price" : $('#property_reserve_price').val(),
		"current_successful_bidder_user" : $('#current_successful_bidder_user').val(),
        "property_comments" : $('#property_comments').val(),
		"property_photo" : $('#property_photo').val(),
		"bid_higest_price" : $('#bid_higest_price').val(),
		"property_rooms" : $('#property_rooms').val(),
		"property_address" : $('#property_address').val(),
	     
        
	});
}