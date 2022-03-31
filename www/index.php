<?php
	session_start();
	
	require_once '../core/urls_conf.php';
	require_once '../core/csrf_protection.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Учим английский</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container my-5">
			<div class="row">
				<div class="border col-sm-9">
					<a onclick="get_content_ajax('upload-dictionary')" class="">Загрузить словарь</a>
					<a onclick="get_content_ajax('select-dictionary')" class="">Выбрать словарь</a>
					<a onclick="get_content_ajax('view-words')" class="">Все слова</a>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
		</div>
		<div class="container" id="content"></div>
	</body>
	<script>
		var scripts_elements = [];

		function get_html_content(content_url, id){
			var xhr = new XMLHttpRequest();
			xhr.open('GET', content_url);
			xhr.responseType = 'text';

			xhr.onload = function() {
				document.getElementById(id).innerHTML = xhr.response;
			}

			xhr.send();
		}


		function get_scripts(scripts_urls, id){
			for (let i = 0; i < scripts_elements.length; i++){
				let elem = document.getElementById(scripts_elements[i]);
				elem.parentNode.removeChild(elem);
			}

			scripts_elements = [];

			for (let i = 0; i < scripts_urls.length; i++){
				scripts_elements.push('script-' + i);
				var elem = document.createElement( 'script' );
				elem.type = 'text/javascript';
				elem.async = true;
				elem.id = 'script-' + i;
				document.body.appendChild(elem);
				elem.src = scripts_urls[i];
			}
		}
		

		function get_content_ajax(content_name){
			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function() {
        		if (xhr.readyState == 4 && xhr.status == 200) {
            		get_html_content(xhr.response['html_file'], "content");
            		get_scripts(xhr.response['scripts'], "scripts");
        		}
    		}

			xhr.open("POST", '<?=$urls['request-handler']?>');
			xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			xhr.responseType = 'json';
			xhr.send(JSON.stringify({'content':content_name}));
		}

		get_content_ajax('select-dictionary');
	</script>
</html>