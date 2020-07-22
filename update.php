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

		$sql = "SELECT * FROM cars WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		
		

		$row = $result->fetch_assoc();
	}

	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>update Car</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-sm bg-light sticky-top">

   <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="logout.php?logout">Logout</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="add_new_car.php">add car</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="admin.php">Home</a>
    </li>	   
  </ul>   
</nav>
<div class="d-flex welcome mr-4">
	<div>
		<img class="img-fluid" src="img/user.jpg" alt="logo_user" style="width:40px;">
	</div>
	<p class="h3"> Welcome <?php echo $userRow['userName'];?></p>
</div>

<div class="container">

	<h2>Update Car</h2>

<div class="form">
<form action="actions/function_update_car.php" method="post">
	<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<div class="form-group">
    <label for="car_img">Img:</label>
    <input type="text" class="form-control" name="car_img" value="<?php echo $row['car_img']?>">
  </div>
  <div class="form-group">
    <label for="company">Company:</label>
    <input type="text" class="form-control" name="company" value="<?php echo $row['company']?>">
  </div>
  <div class="form-group">
    <label for="typ">Typ:</label>
    <input type="text" class="form-control" name="typ" value="<?php echo $row['typ']?>">
  </div>
  <div class="form-group">
    <label for="year_of">Production Date:</label>
    <input type="date" class="form-control" name="year_of" value="<?php echo $row['year_of']?>">
  </div>
  <div class="form-group">
    <label for="price">Price:</label>
    <input type="text" class="form-control" name="price" value="<?php echo $row['price']?>">
  </div>
  <div class="form-group">
    <label for="arrivel">Arrivel:</label>
	<select name="arrivel" value="<?php echo $row['arrivel']?>">
		<option value="yes">Yes</option>
		<option value="no">No</option>
	</select>    
  </div>  
  <input type="submit" name="submit" value="submit"></input>
  </form>
  </div>
  </div>	

</body>
</html>