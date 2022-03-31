var xhr = new XMLHttpRequest();
var words;


function view_row(i){
	return '<div class="row"><div class="col-sm-2">' + 
    		i +'</div><div class="col-sm-2">' + words[i]['dictionary'] 
    		+ '</div><div class="col-sm-4">' + words[i]['eng'] + 
    		'</div><div class="col-sm-4">' + words[i]['rus'] + '</div>';
}



xhr.onreadystatechange = function() {
 	if (xhr.readyState == 4 && xhr.status == 200) {
    	var list = document.getElementById("words");

    	words = xhr.response
    	for (i = 0; i < words.length; i++){
    		list.innerHTML += view_row(i);
    	}
   	}
}

xhr.open("POST", '/ajax/request-handler.php');
xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
xhr.responseType = 'json';
xhr.send(JSON.stringify({'db-query':'get-all-words'}));