// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";
var currentid;

findAll();

 


$(document).on('click', '#btnSave', function(e){
	
	console.log('firing');
 	var id=  $('#property_id').val();
   	updateBid();
  	$('#bidList li').remove();
  
	findBidsByPropId($("#myhidden").val());
	//$.mobile.changePage( "#bidsforproperty", { role: "dialog" } );;
	//$.mobile.changePage( 'index.html#bidsforproperty');
	//$.mobile.page('index.html#bidsforproperty');
	//$.mobile.changePage( '#bidsforproperty', { reloadPage: true, transition: "none"} );
	//$.mobile.changePage( "#bidsforproperty", { role: "dialog" } );;
});

//
$(document).on('click', '#addbid', function(e){
   	console.log('firing');
   	
   	//get the prop ID
   	currentBid = {};
   	renderSingleBid(currentBid); // Display empty form
   	$('#property_id').val($("#myhidden").val());
   	
   	$.mobile.changePage( "#viewenterbid", { role: "" } );;
});

$('#btnDelete').click(function() {
	deleteBid();
	return false;
});


$( document ).delegate("#bidsforproperty", "pagebeforeshow", function() {
	//findBidsByPropId($("#myhidden").val());
	//alert('A page with an ID of "foo" was just created by jQuery Mobile!' + dirName);
	
	});
$('#PropertyList a').live('click', function() {
	console.log('list clicked');
	$('#bidList li').remove();
	$("#myhidden").val( $(this).data('identity'));
	findBidsByPropId($(this).data('identity'));
	$.mobile.changePage( "#bidsforproperty", { role: "" } );;
});
//bidList
$('#bidList a').live('click', function() {
	console.log('bidList clicked');
	findBidById($(this).data('identity'));
	$.mobile.changePage( "#viewenterbid", { role: "dialog" } );;
});


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
	var id =$('#bid_id').val();
	if(id!="")
	{	
		$.ajax({
			type : 'PUT',
			contentType : 'application/json',
			url : rootURL + 'bids/' + $('#bid_id').val(),
			dataType : "json",
			data : formToJSON(),
			success : function(data, textStatus, jqXHR) { console.log('bid updated successfully'); },
			error : function(jqXHR, textStatus, errorThrown) { console.log('bid update error: ' + textStatus); }
		});
	}
	else
	{
		console.log('post bid');
		console.log(formToJSON);
		$.ajax({
			type : 'POST',
			contentType : 'application/json',
			url : rootURL + 'bids',
			dataType : "json",
			data : formToJSON(),
			success : function(data, textStatus, jqXHR) { console.log('bid added successfully'); },
			error : function(jqXHR, textStatus, errorThrown) { console.log('bid add error: ' + textStatus); }
		});
	}
}

function findBidById(bid_id) {
	console.log('findById: ' + bid_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'bids/' + bid_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findById success: ' + data.bid_id);
			currentPublication = data;
			renderSingleBid(currentPublication);
		}
	});
}



function findAll() {
	console.log('findAll');
	$.ajax({
		type : 'GET',
		url : rootURL + 'property',
		dataType : "json", // data type of response
		success : renderList
	});
	
}
function findBidsByPropId(property_id) {
	//http://localhost/bids/Admin/PROPID
	console.log('findById: ' + property_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'admin/bids/' + property_id,
		dataType : "json",
		success : function(data) {
			console.log('findById success: ' + data.property_id);
			currentPublication = data;
			renderDetails(currentPublication);
		}
	
	});
}

function renderList(data) {
	
	console.log('renderList');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#PropertyList li').remove();
	$("#PropertyList").trigger ("create");
	
	$.each(list, function(index, publication) {
		var strings = '<li><a  data-identity="' + publication.property_id +  '"><img src="../app/pics/' + publication.property_photo + '.jpg"><h2>' + publication.property_description + '</h2><p>' + publication.property_address + '</p><p class="ui-li-aside">' + publication.property_reserve_price + '</p></a></li>';
		$('#PropertyList').append(strings);
	});
	$("#PropertyList").listview('refresh');
}
function renderDetails(data) {
	
	console.log('find by renderDetails');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#bidList li').remove();
	
	$.each(list, function(index, publication) {
		$('#bidList').append('<li><a data-identity="' + publication.bid_id + '">' + publication.bid_comments + '</a></li>');
		console.log('adding');
	});
	
		
	$("#bidList").listview('refresh');

}

function renderSingleBid(bids) {
	$('#bid_id').val(bids.bid_id);
	$('#Bid_lowest_price').val(bids.Bid_lowest_price);
	$('#bid_higest_price').val(bids.bid_higest_price);
	$('#bid_description').val(bids.bid_description);
	$('#bid_comments').val(bids.bid_comments);
	$('#user_id').val(bids.user_id);
	$('#property_id').val(bids.property_id);
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





$(document).on('click', '#btnPropSave', function(e){
	//alert(formToJSON1());	
	if(addProperty1())
		$.mobile.changePage( 'mobile.html');
});



function addProperty1() {
	var status=false;
	console.log('addProperty1');
	$.ajax({
		type : 'POST',
		contentType : 'application/json',
		url : rootURL + 'property',
		dataType : "json",
		data : formToJSON1(),
		success : function(data, textStatus, jqXHR) {
			console.log('Property created successfully');
			status=true;
		},
		error : function(jqXHR, textStatus, errorThrown) { alert('property nont saved'); console.log('addProperty error: ' + textStatus + errorThrown); }
	});
	return status;
}


//Helper function to serialize all the form fields into a JSON string
function formToJSON1() {
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



