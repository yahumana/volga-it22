var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function() {
 	if (xhr.readyState == 4 && xhr.status == 200) {
    	var list = document.getElementById("dictionaries-list");

    	for (let i = 0; i < xhr.response.length; i++){
    		list.innerHTML += '<div class="row"><div class="col-sm-6">' + xhr.response[i]['name'] + 
    		'</div><div class="col-sm-4">' + xhr.response[i]['length'] + 
    		'</div><div class="col-sm-2"><a onclick="select_dictionary('+ xhr.response[i]['id'] +')">&#10145;</a></div></div>';
    	}
   	}
}

xhr.open("POST", '/ajax/request-handler.php');
xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
xhr.responseType = 'json';
xhr.send(JSON.stringify({'db-query':'get-dictionaries'}));

function select_dictionary(id){
	var request = new XMLHttpRequest();

	request.open("POST", '/ajax/request-handler.php');
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
	request.responseType = 'json';
	request.send(JSON.stringify({'set-session-disctionary-id':id}));
	get_content_ajax('view-dictionary');
}