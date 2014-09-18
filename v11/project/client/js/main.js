// The root URL for the RESTful services
var rootURL = "http://localhost/project/project/app/index.php/";
var currentPublication;

// Retrieve publication list when application starts
findAll();

// Nothing to delete in initial application state
$('#btnDelete').hide();

// Register listeners
$('#btnSearch').click(function() {
	search($('#searchKey').val());
	return false;
});

// Trigger search when pressing 'Return' on search key input field
$('#searchKey').keypress(function(e) {
	if (e.which == 13) {
		search($('#searchKey').val());
		e.preventDefault();
		return false;
	}
});

$('#btnAdd').click(function() {
	newPublication();
	return false;
});

$('#btnSave').click(function() {
	if ($('#publicationId').val() == '')
		addPublication();
	else
		updatePublication();
	return false;
});

$('#btnDelete').click(function() {
	deletePublication();
	return false;
});

$('#publicationList a').live('click', function() {
	findById($(this).data('identity'));
});

function search(searchKey) {
	if (searchKey == '')
		findAll();
	else
		findByName(searchKey);
}

function newPublication() {
	$('#btnDelete').hide();
	currentPublication = {};
	renderDetails(currentPublication); // Display empty form
}

function findAll() {
	console.log('findAll');
	$.ajax({
		type : 'GET',
		url : rootURL + 'publications',
		dataType : "json", // data type of response
		success : renderList
	});
}

function findByName(searchKey) {
	console.log('findByName: ' + searchKey);
	$.ajax({
		type : 'GET',
		url : rootURL + 'publications/search/' + searchKey,
		dataType : "json",
		success : renderList
	});
}

function findById(id) {
	console.log('findById: ' + id);
	$.ajax({
		type : 'GET',
		url : rootURL + 'publications/' + id,
		dataType : "json",
		success : function(data) {
			$('#btnDelete').show();
			console.log('findById success: ' + data.id);
			currentPublication = data;
			renderDetails(currentPublication);
		}
	});
}

function addPublication() {
	console.log('addPublication');
	$.ajax({
		type : 'POST',
		contentType : 'application/json',
		url : rootURL + 'publications',
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) {
			console.log('Publication created successfully');
			$('#btnDelete').show();
			$('#publicationId').val(data.id);
			findAll();
		},
		error : function(jqXHR, textStatus, errorThrown) { console.log('addPublication error: ' + textStatus); }
	});
}

function updatePublication() {
	console.log('updatePublication');
	$.ajax({
		type : 'PUT',
		contentType : 'application/json',
		url : rootURL + 'publications/' + $('#publicationId').val(),
		dataType : "json",
		data : formToJSON(),
		success : function(data, textStatus, jqXHR) { console.log('Publication updated successfully'); },
		error : function(jqXHR, textStatus, errorThrown) { console.log('updatePublication error: ' + textStatus); }
	});
}

function deletePublication() {
	console.log('deletePublication');
	$.ajax({
		type : 'DELETE',
		url : rootURL + 'publications/' + $('#publicationId').val(),
		success : function(data, textStatus, jqXHR) { console.log('Publication deleted successfully');},
		error : function(jqXHR, textStatus, errorThrown) { console.log('deletePublication error'); }
	});
	findAll();
}

function renderList(data) {
	console.log('renderList');
	var list = data == null ? [] : (data instanceof Array ? data : [ data ]);
	$('#publicationList li').remove();
	
	$.each(list, function(index, publication) {
		$('#publicationList').append('<li><a data-identity="' + publication.id + '">' + publication.title + '</a></li>');
	});
}

function renderDetails(publication) {
	$('#publicationId').val(publication.id);
	$('#title').val(publication.title);
	$('#authors').val(publication.authors);
	$('#year').val(publication.year);
	$('#proceeding').val(publication.proceeding);
}

// Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	return JSON.stringify({
		"id" : $('#publicationId').val(),
		"title" : $('#title').val(),
		"authors" : $('#authors').val(),
		"year" : $('#year').val(),
		"proceeding" : $('#proceeding').val(),
	});
}
