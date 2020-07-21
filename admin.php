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

	// select logged-in users details
	$res= mysqli_query($conn, "SELECT * FROM `users` WHERE userId= ".$_SESSION['admin']);
	$userRow= mysqli_fetch_array($res, MYSQLI_ASSOC);

	$resCar = mysqli_query($conn, "SELECT * FROM cars");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome-<?php echo $userRow['userEmail'];?></title>
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
  </ul>   
</nav>

<div class="d-flex welcome mr-4">
	<div>
		<img class="img-fluid" src="img/user.jpg" alt="logo_user" style="width:40px;">
	</div>
	<p class="h3"> Welcome <?php echo $userRow['userName']?></p>
</div>


<div class="container-fluid d-flex row justify-content-between">
	

	

	    <?php
		include 'actions/db_connecting.php';

		$sql = "SELECT * FROM cars";
		$result = mysqli_query($conn, $sql);

		if($result->num_rows == 0) {

			echo "no data inside";

		}elseif (mysqli_num_rows($result) == 1) {

			$row = $result->fetch_assoc();
			echo $row["company"]." ".$row["typ"]." ".$row["year_of"]." ".$row["price"]." ".$row["arrivel"]." <a href='update.php?id=".$value["id"]."'>update</a> <a href='delete_car.php?id=".$value["id"]."'>delete</a><br>";

		}else {

			$rows = $result->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $value) {
				echo "<div class='media border p-3 mt-2 self'>
						<img src='".$value['car_img']."' alt='Tesla' class='mr-3 mt-3 rounded-circle' style='width:90px;'>
							<div class='media-body'>
					  			<h4>".$value['company']." ".$value['typ']." <small><i>ID: ".$value['id']."</i></small></h4>
					  			<p>Year: ".$value["year_of"]."</p>
					  			<p>Price: ".$value["price"]."</p>
					  			<p>Arrivel: ".$value["arrivel"]."</p>
					  			<div class='d-flex justify-content-around'>
						  			<p><a href='update.php?id=".$value['id']."'>update</a></p>
						  			<p><a href='delete_car.php?id=".$value['id']."'>delete</a></p>
					  			</div>
							</div>
		  			 </div>";

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