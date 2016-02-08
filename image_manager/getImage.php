<?php
	header('Content-type: image/jpg');
    echo file_get_contents('image/' . $_GET['file']);
?>