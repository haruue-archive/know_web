<?php
require 'check_apikey.php'; 

include("connect.php");
include("token.php");

$name = addslashes($_POST["name"]);
$password = addslashes($_POST["password"]);
$password_md5 = md5(md5($password));

$query = "SELECT * FROM person WHERE name = '".$name."' AND password = '".$password_md5."'";
$result = mysql_query($query);
 if ($row = mysql_fetch_assoc($result)) {
 	$row["token"]  = create_unique($row["id"]);
 }else{
 	header("http/1.1 400 Bad Request");
	$row=array("error" => "账号密码错误");
 }
 echo json_encode($row);
?>