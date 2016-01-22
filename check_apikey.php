<?php
//TODO: Put your api key here
$apikey = 'demoapikey';

//TODO: Put your 404 page url here, it must be a php file.
$page404 = '../404.php';

if (empty($_POST['apikey'])) {
	include $page404;
	exit;
}

if ($_POST['apikey'] != $apikey) {
	include $page404;
	exit;
}
?>
