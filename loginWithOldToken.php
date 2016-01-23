<?php
require 'check_apikey.php'; 

include("connect.php");
include("token.php");

$id = checkToken(addslashes($_POST["token"]),$returnData);

if ($id == -1) {
 	header("http/1.1 400 Bad Request");
	$row=array("error" => "TOKEN无效");
} else {
	$query = "SELECT * FROM person WHERE id = '".$id."'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
 	$row["token"]  = create_unique($row["id"]);
}

echo json_encode($row);
?>