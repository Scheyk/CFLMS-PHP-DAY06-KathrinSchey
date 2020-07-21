<?php
	error_reporting(E_ERROR | E_PARSE);

	$hostName = "localhost";
	$user = "root";
	$pw = "";
	$db_name = "car_rental";

	$conn = mysqli_connect($hostName, $user, $pw, $db_name);

	if(!$conn){
		echo "error";
	}
?>