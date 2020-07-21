<?php
	ob_start();
	session_start();
	require_once 'actions/db_connecting.php';
	
	// if session is not set this will redirect to login page

	if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
	 header("Location: index.php");
	 exit;
	}
	if($_SESSION['admin']) {
		header("Location: admin.php");
		exit;
	}

	if($_GET["id"]) {
		$id = $_GET["id"];

		$sql = "SELECT * FROM cars WHERE id = $id";		

	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>