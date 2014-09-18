// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";
var currentBid;

// Retrieve publication list when application starts
findAll();


$(function() {
	
	$( "#auction_start_date" ).datepicker();
	$( "#auction_close_date" ).datepicker();
	$( "#auction_start_date" ).datepicker("option", "dateFormat", "yy-mm-dd");
	$( "#auction_close_date" ).datepicker("option", "dateFormat", "yy-mm-dd");

	});

// Nothing to delete in initial application state
$('#btnDelete').hide();
$('#Propdetails').hide();


$('#btnAdd').click(function() {
	$('#btnDelete').hide();
	newProperty();
	return false;
});



$('#btnSave').click(function() {
	console.log('save');
	//alert(formToJSON());
	if ($('#property_id').val() == '')
		addProperty();
	else
		updateProperty();
	return false;
});

$('#btnDelete').click(function() {
	console.log('btnDelete clicked');
	deleteProperty();
	return false;
});


$('#PropertyList').on('click', 'a', function () {
	
	findById($(this).data('identity'));
});

function newProperty() {
	$('#btnPropDelete').hide();
	currentProp = {};
	renderDetails(currentProp); // Display empty form
}

function findAll() {
	console.log('findAll');
	$('#Propdetails').hide();
	$.ajax({
		type : 'GET',
		url : rootURL + 'property',
		dataType : "json", // data type of response
		success : renderList
	});
}

function findById(property_id) {
	console.log('findById: ' + property_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'property/' + property_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findById success: ' + data.property_id);
			currentPublication = data;
			renderDetails(currentPublication);
		}
	});
}

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
			$('#btnDelete').show();
			$('#property_id').val(data.property_id);
			findAll();
		},
		error : function(jqXHR, textStatus, errorThrown) { console.log('addProperty error: ' + textStatus + errorThrown); }
	});
}

function updateProperty() {
	console.log('Propertybid');
	$.ajax({
		type : 'PUT',
		contentType : 'application/json',
		url : rootURL + 'property/' + $('#property_id').val(),
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) { console.log('Property updated successfully'); findAll(); },
		error : function(jqXHR, textStatus, errorThrown) { console.log('Property update error: ' + textStatus); }
	});
}



function deleteProperty() {
	console.log('deleteProperty');
	$.ajax({
		type : 'DELETE',
		url : rootURL + 'property/' + $('#property_id').val(),
		success : function(data, textStatus, jqXHR) { console.log('Property deleted successfully'); findAll();},
		error : function(jqXHR, textStatus, errorThrown) { console.log('Property delete error'); }
	});
	findAll();
}



function renderList(data) {
	console.log('renderList');
	
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#PropertyList li').remove();
	
	$.each(list, function(index, publication) {
		$('#PropertyList').append('<li><a data-identity="' + publication.property_id + '">' + publication.property_comments + '</a></li>');
	});
}
function renderDetails(bids) {
	$('#Propdetails').show();
	$('#btnPropDelete').show();
	$('#property_id').val(bids.property_id);
	$('#property_description').val(bids.property_description);
	$('#auction_start_date').val(bids.auction_start_date);
	$('#auction_close_date').val(bids.auction_close_date);
	$('#auction_actual_selling_price').val(bids.auction_actual_selling_price);
	$('#property_reserve_price').val(bids.user_id);
	$('#current_successful_bidder_user').val(bids.property_reserve_price);
	$('#property_comments').val(bids.property_comments);
	$('#property_photo').val(bids.property_photo);
	$('#bid_higest_price').val(bids.bid_higest_price);
	$('#property_rooms').val(bids.property_rooms);
	$('#property_address').val(bids.property_address);
	$('#bproperty_id').val(bids.property_id);

	
}

// Helper function to serialize all the form fields into a JSON string
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


