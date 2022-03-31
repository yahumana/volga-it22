<?php
	session_start();
	require_once '../../core/urls_conf.php';
	require_once '../../core/csrf_protection.php';
?>
<form enctype="multipart/form-data" action="<?=$urls['upload-dictionary']?>" method="POST" >
	<?=csrf_html()?>
	<p>Архив csv <input name="dictionary" type="file" accept=".csv"></p>
	<p>Изображения .zip <input name="images" type="file" accept=".zip"></p>
	<p class="mt-2">
		<input type="submit" value="Загрузить">
	</p>
</form>