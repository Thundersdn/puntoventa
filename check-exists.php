<?php

//verifica si existe el archivo
// Define a destination
$targetFolder = 'AdminSRECC/img_articulos';
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
?>