function search_word() {
	var search_export = document.getElementById("words");
	search_export.innerHTML = '';
	var rus = document.Search.rus.value;
	
	if (rus != ''){
		for (i=0; i<words.length; i++){
			if (words[i]['rus'].includes(rus)){
				console.log(1);
				search_export.innerHTML += view_row(i);
			}
		}
	}


	var eng = document.Search.eng.value;
	if (eng != ''){
		for (i=0; i<words.length; i++){
			if (words[i]['eng'].includes(eng)){
				console.log(1);
				search_export.innerHTML += view_row(i);
			}
		}
	}
} 
