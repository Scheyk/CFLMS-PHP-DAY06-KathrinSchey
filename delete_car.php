<?php

	ob_start();
	session_start();
	require_once 'actions/db_connecting.php';
	
	// if session is not set this will redirect to login page
	if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
	 header("Location: index.php");
	 exit;
	}
	if($_SESSION['user']) {
		header("Location: home.php");
		exit;
	}

	require_once 'actions/db_connecting.php';



	if($_GET["id"]) {
		$id = $_GET["id"];

		$sql = "DELETE FROM cars WHERE id = $id";

		if(mysqli_query($conn, $sql)) {
			echo "sucess <br>
			 	  <a href='admin.php'>back home</a>";
		} else {
			echo "error4";
		}

	}
?>