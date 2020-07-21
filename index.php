<?php
	ob_start();
	session_start();
	require_once 'actions/db_connecting.php';

	// it will never let you open index(login) page if session is set
	if (isset($_SESSION['user'])!=""){
 		header("Location: home.php");
 		exit;
	}
  if(isset($_SESSION['admin'])!=""){
    header("location: admin.php");
    exit;
  }

	$error = false;	
	if(isset($_POST['btn-login'])){
	// prevent sql injections/ clear user invalid inputs
 	$email = trim($_POST['userEmail']);
 	$email = strip_tags($email);
 	$email = htmlspecialchars($email);

 	// prevent sql injections / clear user invalid inputs
 	$pass = trim($_POST['userPass']);
 	$pass = strip_tags($pass);
 	$pass = htmlspecialchars($pass);

 	if(empty($email)){
  		$error = true;
  		$emailError = "Please enter your email address.";
 		}else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
  			$error = true;
  			$emailError = "Please enter valid email address.";
		}
		

 	if(empty($pass)){
  		$error = true;
  		$passError = "Please enter your password.";
 	}

 	// if there's no error, continue to login
 	if(!$error) {
 
  		$password = hash('sha256', $pass); // password hashing

  		$res=mysqli_query($conn, "SELECT * FROM `users` WHERE userEmail='$email'");
		  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);		  
  		$count=mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
 
  		if($count == 1 && $row['userPass']==$password) {
        if($row["status"] == 'admin') {
          $_SESSION["admin"] = $row["userId"];
          header("Location: admin.php");
        } else {
            $_SESSION['user']= $row['userId'];
            header("Location: home.php");
        }
   			
  		} else {
   			$errMSG ="Incorrect Credentials, Try again...";
  		}
	}
}
     
	 
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  <?php
            if(isset($errMSG) ) {
			  echo $errMSG; 
			}
             
               
  ?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">

		<h2>Sign In.</h2>		
		
        <input type="email" name="userEmail" class="form-control" placeholder="Your Email" value="<?php echo $email;?>" maxlength="40"/>
        <span class="text-danger"></span>

        <input type="password" name="userPass" class="form-control" placeholder="Your Password" maxlength="15"/>
        <span class="text-danger"></span>

        <hr/>
        <button type="submit" name="btn-login">Sign In</button>
        <hr/>
        <a href="register.php">Sign Up Here...</a>
	</form>

</body>
</html>
<?php ob_end_flush();?>