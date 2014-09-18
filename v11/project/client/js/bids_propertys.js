// this script is  for the administrator to see the list of all bids for a particular property
// by calling api functions in our RESTful API
// GET http://.......app/index.php/property       to get list of all propertys
// GET http://...../app/index.php/admin/bids/PROPID   to get list of all bids for property ID

// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";

$(document).ready(function(){
	// Retrieve property list when application starts
	findAllPropertys();
	
	});

///register listerns for both lists 

$('#propertyList').on('click', 'a', function () {
	$('#bidddetils').hide(); //hide unless we find
	console.log('propertyList clicked');
	findBidsByPropertyId($(this).data('identity'));
});




//if the property list is clicked on get the list of all bids for this property
//and propulate the BidList in the Html page
function findAllPropertys() {
	console.log('findAllPropertys');
	$.ajax({
		type : 'GET',
		url : rootURL + 'property',
		dataType : "json", // data type of response
		success : renderPropertyList 
	});
}
//find all bids for property Id and populate list
///admin/bids/
function findBidsByPropertyId(id) {
	console.log('findBidsByPropertyId: ' + id);
	$('#bidList li').remove();
	$.ajax({
		type : 'GET',
		url : rootURL + 'admin/bids/' + id,
		dataType : "json",
		success : function(data) {
			console.log('findById success: ' + data.bid_id);
			bidList = data;
			renderBidList(bidList);
		}
		
	});
}
//get one bid by id
function findBidById(bid_id) {
	console.log('findBidById: ' + bid_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'bids/' + bid_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findBidById success: ' + data.bid_id);
			currentBid = data;
			renderBidDetails(currentBid);
		}
	});
}
//print the list to screen
function renderPropertyList(data) {
	$('#bidddetils').hide();
	console.log('renderList');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#propertyList li').remove();
	//	$('#bidList').append('<li><a data-identity="' + publication.bid_id + '">' + publication.bid_comments + '</a></li>');
	$.each(list, function(index, publication) {
	
		$('#propertyList').append('<li><a data-identity="' + publication.property_id + '">' + publication.property_comments +  '</a></li>');
	});
}
function renderBidList(data) {
	$('#bidddetils').show();
	console.log('renderBidList');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#bidList li').remove();
	
	$.each(list, function(index, bid) {
		$('#bidList').append('<li> bid id=' + bid.bid_id + '   ' + bid.bid_comments + '</a></li>');
	});
}
//populate the dialog box fields
function renderBidDetails(bids) {
	$('#bid_id').val(bids.bid_id);
	$('#Bid_lowest_price').val(bids.Bid_lowest_price);
	$('#bid_higest_price').val(bids.bid_higest_price);
	$('#bid_description').val(bids.bid_description);
	$('#bid_comments').val(bids.bid_comments);
	$('#user_id').val(bids.user_id);
	$('#property_id').val(bids.property_id);
}

