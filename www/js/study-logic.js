var language_code = "rus";
var currently_displayed = 0;


function speak(text, local) {
    const message = new SpeechSynthesisUtterance();
    message.lang = local;
    message.text = text;
    window.speechSynthesis.speak(message);
}


function view_word(id){
	if (words.length == id){
		id = 0;
		currently_displayed = 0;
	} 

	if (language_code == "rus"){
		document.getElementById("word").innerHTML = words[id]['rus'];

		document.getElementById("translation").innerHTML = get_question_marks(words[id]['eng'].length);

	} else {
		document.getElementById("word").innerHTML = words[id]['eng'];

		document.getElementById("translation").innerHTML = get_question_marks(words[id]['rus'].length);
	}

	document.getElementById("photo").innerHTML = '<img src="' + words[id]['photo'] + '" width="100" height="100" onerror="image_dont_view(true)" onload="image_dont_view(false)">';

}


function image_dont_view(sw) {
	if (sw){
		document.getElementById("photo").style.visibility="hidden";
	} else {
		document.getElementById("photo").style.visibility="visible";
	}
}


function show_translation(){
	if (language_code == "rus"){
		document.getElementById("translation").innerHTML = words[currently_displayed]['eng'];
	} else {
		document.getElementById("translation").innerHTML = words[currently_displayed]['rus'];
	}
}


function next_word(){
	currently_displayed += 1;
	view_word(currently_displayed);
}


function sound_word(code){
	if (code == 'rus'){
		speak(words[currently_displayed][code], 'ru-RU');
	} else {
		speak(words[currently_displayed][code], 'en-EN');
	}
}


function change_language(code){
	language_code = code;
	view_word(currently_displayed);
}


function get_question_marks(length){
	var str = '';
	while (length > 0){
		str += '?';
		length--;
	}
	return str;
}