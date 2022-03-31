<?php 
	session_start();
	require_once '../core/db_connect.php';
	require_once '../core/urls_conf.php';
	require_once '../core/csrf_protection.php';

	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' and check_csrf()){
		if ($_FILES && $_FILES["dictionary"]["error"] == UPLOAD_ERR_OK){
    		move_uploaded_file($_FILES["dictionary"]["tmp_name"], 'media/dictionaries/'.$_FILES["dictionary"]["name"]);

    		$dictionary = R::dispense('dictionary');
    		$dictionary->name = $_FILES["dictionary"]["name"];
    		R::store($dictionary);

    		if ($_FILES && $_FILES["images"]["error"] == UPLOAD_ERR_OK){
				$images_names = 'media/images/'.$dictionary['id'].$_FILES['dictionary']['name'].'/'.$_FILES['images']['name'];
				mkdir('media/images/'.$dictionary['id'].$_FILES['dictionary']['name']);
				move_uploaded_file($_FILES['images']['tmp_name'], $images_names);
				$zip = new ZipArchive;
				if ($zip->open($images_names) === TRUE){
					$zip->extractTo('media/images/'.$dictionary['id'].$_FILES['dictionary']['name']);
					$zip->close();
				}
				unlink($images_names);
			}
			
    		$dictionary_f = fopen('media/dictionaries/'.$_FILES["dictionary"]["name"], 'rt') or die("Ошибка");

    		for ($i=0; $data=fgetcsv($dictionary_f, 1000,";"); $i++){
    			$data_string = explode(",", $data[0]);
    			
    			$word = R::dispense('words');
    			$word->eng = $data_string[0];
    			$word->rus = $data_string[1];
    			$word->photo = 'media/images/'.$dictionary['id'].$dictionary['name'].'/'.$data_string[2];
    			$dictionary->xownWordList[] = $word;
    			R::store($dictionary);
    		}
		}
		header("location: index.php");
	}
?>
