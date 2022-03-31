<?php
	$urls = array(
		"request-handler" => "/ajax/request-handler.php",
		"main" => "/ajax/index.php",
		"upload-dictionary" => '/upload-dictionary.php',
	);


	$contents = array(
		"select-dictionary" => array("file" => "/templates/select-dictionary.html",
			"scripts" => array("/js/select-dictionary.js")),
		"upload-dictionary" => array("file" => "/templates/upload-dictionary.php",
			"scripts" => array()),
		"view-words" => array("file" => "/templates/view-words.html",
			"scripts" => array("/js/get-words.js", '/js/search-word.js')),
		"view-dictionary" => array("file" => "/templates/view-dictionary.html",
			"scripts" => array("/js/get-dictionary.js", "/js/study-logic.js")),
	);


	/* Функции хранятся в core/connect_db.php, возвращают json */ 
	$dbQuery = array(
		"get-dictionaries" => 'getDictionaries',
		"get-all-words" => 'getAllWords',
		"get-dictionary" => 'getDictionary',
	);