// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";
var currentBid;

// Retrieve publication list when application starts
findAll();
findUsers()

// Nothing to delete in initial application state
$('#btnDelete').hide();
$('#biddetails').hide();

$('#btnAdd').click(function() {
	newBid();
	return false;
});

$('#allBids').click(function() {
	findAll();
	return false;
});

$('#btnSave').click(function() {
	if ($('#bid_id').val() == '')
		addBid();
	else
		updateBid();
	return false;
});

$('#btnDelete').click(function() {
	deleteBid();
	return false;
});

$('#bidList').on('click', 'a', function () {
	$('#biddetails').show();
	findById($(this).data('identity'));
});

$('#userList').change(function()
{
	getUserSelectedBids();
});
function getUserSelectedBids()
{
	var option = $('#userList').find('option:selected').val();
	console.log(option);
	//find all the bids for the user
	findAllbidsforUsers(option);	
}

function findAllbidsforUsers(user_id) {
	
	currentPublication = {};
	console.log('findAllbidsforUsers: ' +user_id );
	$.ajax({
		type : 'GET',
		url : rootURL + 'users/bids/' + user_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			currentPublication = data;
			renderList(currentPublication);
		}
	});
	
}
function newBid() {
	$('#btnDelete').hide();
	currentBid = {};
	renderDetails(currentBid); // Display empty form
}
function findUsers() {
	console.log('findAllusers');
	$.ajax({
		type : 'GET',
		url : rootURL + 'users',
		dataType : "json", // data type of response
		success : renderBox
	});
}

function findAll() {
	console.log('findAll');
	$.ajax({
		type : 'GET',
		url : rootURL + 'bids',
		dataType : "json", // data type of response
		success : renderList
	});
}



function findById(bid_id) {
	console.log('findById: ' + bid_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'bids/' + bid_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findById success: ' + data.bid_id);
			currentPublication = data;
			renderDetails(currentPublication);
		}
	});
}


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
			$('#btnDelete').show();
			$('#bid_id').val(data.bid_id);
			findAll();
		},
		error : function(jqXHR, textStatus, errorThrown) { console.log('addbid error: ' + textStatus + errorThrown); }
	});
}

function updateBid() {
	console.log('updatebid');
	$.ajax({
		type : 'PUT',
		contentType : 'application/json',
		url : rootURL + 'bids/' + $('#bid_id').val(),
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) { console.log('bid updated successfully'); getUserSelectedBids();},
		error : function(jqXHR, textStatus, errorThrown) { console.log('bid update error: ' + textStatus); }
	});
}


function deleteBid() {
	console.log('deleteBid');
	$.ajax({
		type : 'DELETE',
		url : rootURL + 'bids/' + $('#bid_id').val(),
		success : function(data, textStatus, jqXHR) { console.log('bid deleted successfully'); getUserBids();},
		error : function(jqXHR, textStatus, errorThrown) { console.log('bid delete error'); }
	});
	findAll();
}



function renderList(data) {
	$('#biddetails').hide();
	console.log('renderList');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#bidList li').remove();
	
	$.each(list, function(index, publication) {
		$('#bidList').append('<li><a data-identity="' + publication.bid_id + '">' + publication.bid_comments + '</a></li>');
	});
}

function renderBox(data) {
	console.log('renderBox');
	$('#biddetails').show();
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#userList select').remove();

	$.each(list, function(index, user) {
		//console.log(user.user_id +  user.user_name);
		$('#userList')
		 .append($("<option></option>")
         .attr("value",user.user_id )
         .text(user.user_name)); 
	});
}

function renderDetails(bids) {
	$('#bid_id').val(bids.bid_id);
	$('#Bid_lowest_price').val(bids.Bid_lowest_price);
	$('#bid_higest_price').val(bids.bid_higest_price);
	$('#bid_description').val(bids.bid_description);
	$('#bid_comments').val(bids.bid_comments);
	$('#user_id').val(bids.user_id);
	$('#property_id').val(bids.property_id);
}

// Helper function to serialize all the form fields into a JSON string
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

