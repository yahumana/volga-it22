var xhr = new XMLHttpRequest();
var words = {};

xhr.onreadystatechange = function() {
 	if (xhr.readyState == 4 && xhr.status == 200) {
    	document.getElementById("dictionary-name").innerHTML = 'Текущий словарь: ' + xhr.response['dictionary']['name'];
    	words = xhr.response['words'];
    	view_word(0);
   	}
}

xhr.open("POST", '/ajax/request-handler.php');
xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
xhr.responseType = 'json';
xhr.send(JSON.stringify({'db-query':'get-dictionary'}));