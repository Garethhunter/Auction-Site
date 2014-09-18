// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";


// Retrieve publication list when application starts


$( document ).ready(function() {
	findById(1);
	});

function findById(property_id) {
	//http://localhost/bids/Admin/PROPID
	console.log('findById: ' + property_id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'admin/bids/' + property_id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findById success: ' + data.bid_id);
			currentPublication = data;
			renderDetails(currentPublication);
		}
	
	});
}
function renderDetails(data) {
	
	console.log('renderDetails');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#bidList li').remove();
	
	$.each(list, function(index, publication) {
		$('#bidList').append('<li><a data-identity="' + publication.bid_id + '">' + publication.bid_comments + '</a></li>');
		console.log("adding");
	});
	//refresh the view to load Jquery on it
	$('ul').listview('refresh');
}


