<?php
	
	require_once 'db_connecting.php';
	
	

	if($_POST){
		$img_car = $_POST["car_img"];
		$company = $_POST["company"];
		$typ = $_POST["typ"];
		$year_of = $_POST["year_of"];
		$price = $_POST["price"];
		$arrivel = $_POST["arrivel"];

		$sql = "INSERT INTO `cars`(`car_img`,`company`, `typ`, `year_of`, `price`, `arrivel`)
				VALUES ('$img_car','$company','$typ','$year_of','$price','$arrivel')";

		if(mysqli_query($conn, $sql)){
			echo "success <br>
				  <a href='../admin.php'>back home</a>";
		}else {
			echo "error2";
		}
	}
?>