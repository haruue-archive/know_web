<?php
//TODO: Config MySQL Database information here
$db_srv_address = 'localhost';
$db_user = 'redrock';
$db_password = 'redrock';
$db_name = 'redrock';

$con = mysql_connect($db_srv_address, $db_user, $db_password);
if (!$con){
  die('Could not connect: ' . mysql_error());
  echo "connect error";
}
mysql_query("set names 'utf8'");
mysql_select_db($db_name, $con);
?>