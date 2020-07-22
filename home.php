<?php
	ob_start();
	session_start();
	require_once 'actions/db_connecting.php';
	
	// if session is not set this will redirect to login page

	if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
	 header("Location: index.php");
	 exit;
	}
	if($_SESSION['admin']) {
		header("Location: admin.php");
		exit;
	}

	// select logged-in users details
	$res = mysqli_query($conn, "SELECT * FROM `users` WHERE userId=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$resCar = mysqli_query($conn, "SELECT * FROM cars WHERE arrivel = 'yes'");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome-<?php echo $userRow['userEmail'];?></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="logout.php?logout">Logout</a>
    </li>    
  </ul>
</nav>

<div class="container-fluid">
	

<div class="user">
	<p> Welcome <?php echo $userRow['userName']?>
	<span class="pic">
		<img class="img-fluid" src="img/user.jpg" alt="picture">	
	</span></p>
</div>
       
	    <a href="logout.php?logout">Sign Out</a>
		<br>
		<br>
		<br>

	    <?php
		include 'actions/db_connecting.php';

		// $sql = "SELECT * FROM cars";
		// $result = mysqli_query($conn, $sql);

		if($resCar->num_rows == 0) {

			echo "no data inside";

		}elseif (mysqli_num_rows($resCar) == 1) {

			$row = $resCar->fetch_assoc();
			echo $row["car_img"]." ". $row["company"]." ". $row["typ"]." ". $row["year_of"]." ".$row["price"]. " ".$row["arrivel"]." <a href='book_car.php?id=".$value["id"]."'>book</a><br>";

		}else {

			$rows = $resCar->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $value) {
				echo $value["car_img"]." ".$value["company"]." ".$value["typ"]." ".$value["year_of"]." ".$value["price"]. " ".$value["arrivel"]." <a href='book_car.php?id=".$value["id"]."'>book</a><br>";

			}
		}

	?>

	   </div>     
	 
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
<?php ob_end_flush(); ?>