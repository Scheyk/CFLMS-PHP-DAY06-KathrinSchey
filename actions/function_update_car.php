<?php
	require_once 'db_connecting.php';

	if($_POST) {
		$id = $_POST["id"];
		$img_car = $_POST["car_img"];
		$company = $_POST["company"];
		$typ = $_POST["typ"];
		$year_of = $_POST["year_of"];
		$price = $_POST["price"];
		$arrivel = $_POST["arrivel"];

		$sql = "UPDATE `cars` SET `car_img`='$img_car', `company`='$company',`typ`='$typ',`year_of`='$year_of',`price`='$price',`arrivel`='$arrivel' WHERE id = '$id'";

		if(mysqli_query($conn,$sql)) {
			echo "success <br>
			 	  <a href='../admin.php'>back home</a>";
		} else {
			error3;
		}
	}
?>