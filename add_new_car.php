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
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>add Car</title>
</head>
<body>

<form action="actions/function_add.php" method="post">
	<input type="hidden" name="id">
	<div class="form-group">
    <label for="car_img">Img:</label>
    <input type="text" class="form-control" name="car_img">
  </div>
  <div class="form-group">
    <label for="company">Company:</label>
    <input type="text" class="form-control" name="company">
  </div>
  <div class="form-group">
    <label for="typ">Typ:</label>
    <input type="text" class="form-control" name="typ">
  </div>
  <div class="form-group">
    <label for="year_of">Production Date:</label>
    <input type="date" class="form-control" name="year_of">
  </div>
  <div class="form-group">
    <label for="price">Price:</label>
    <input type="text" class="form-control" name="price">
  </div>
  <div class="form-group">
    <label for="arrivel">Arrivel:</label>
	<select name="arrivel" id="arrivel">
		<option value="yes">Yes</option>
		<option value="no">No</option>
	</select>    
  </div>  
  <input type="submit" name="submit" value="submit"></input>


</body>
</html>