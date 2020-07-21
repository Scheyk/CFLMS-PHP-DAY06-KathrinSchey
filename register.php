<?php
	ob_start();
	session_start(); // start a new session or continues the previous

	if(isset($_SESSION['user'])!=""){
		header("location: home.php"); // redirects to home.php
	}
  if(isset($_SESSION['admin'])!=""){
    header("location: admin.php");
  }

	include_once 'actions/db_connecting.php';

	$error = false;

	if(isset($_POST['btn-signup'])) {

		$name = trim($_POST['userName']); // sanitize user input to prevent sql injection
		$name = strip_tags($name); // strip_tags — strips HTML and PHP tags from a string
		$name = htmlspecialchars($name); // htmlspecialchars converts special characters to HTML entities

		$email = trim($_POST['userEmail']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['userPass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
	

	// basic name validation
	if (empty($name)) {
  		$error = true ;
  		$nameError = "Please enter your full name.";
 	} else if (strlen($name) < 3) {
  		$error = true;
  		$nameError = "Name must have at least 3 characters.";
 	} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  		$error = true ;
  		$nameError = "Name must contain alphabets and space.";
 	}

 	//basic email validation
  	if (!filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  		$error = true;
  		$emailError = "Please enter valid email address." ;
 	} else {
  		// checks whether the email exists or not
  		$query = "SELECT `userEmail` FROM `users` WHERE userEmail='$email'";
  		$result = mysqli_query($conn, $query);
  		$count = mysqli_num_rows($result);
  		if($count!=0){
   			$error = true;
  	 		$emailError = "Provided Email is already in use.";
  		}
    }

 	// password validation
  	if (empty($pass)){
  		$error = true;
  		$passError = "Please enter password.";
 	} else if(strlen($pass) < 6) {
  		$error = true;
  		$passError = "Password must have atleast 6 characters.";
 	}

 	// password hashing for security
	$pass = hash('sha256', $pass);
 
	// if there's no error, continue to signup
 	if(!$error) {
 
  		$query = "INSERT INTO `users`(`userName`,`userEmail`,`userPass`) VALUES('$name','$email','$pass')";
  		// var_dump($query);
      $res = mysqli_query($conn, $query);      
  
  		if ($res) {
   			$errTyp = "success";
   			$errMSG = "Successfully registered, you may login now";
   			unset($name);
    		unset($email);
   			unset($pass);
  			} else  {
   				$errTyp = "danger";
   				$errMSG = "Something went wrong, try again later..." ;
  				} 
		 }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>	

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
		
		<h2>Sign Up.</h2>

		<?php
   			if(isset($errMSG)) { 
   			?>
           		<div class="alert alert-<?php echo $errTyp;?>">
                    <?php echo $errMSG;?>
       			</div>
				<?php
  			}
  		?>

		<input type="text" name="userName" placeholder="Enter Name" maxlength="50" value="<?php echo $name;?>"/>     
        <span class="text-danger"><?php echo $nameError;?></span>

        <input type="email" name="userEmail" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email;?>"/>
        <span class="text-danger"><?php echo $emailError;?></span>
         
        <input type="password" name="userPass" class="form-control" placeholder="Enter Password" maxlength="15"/>
        <span class="text-danger"><?php echo $passError;?></span>
        <hr/>
        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
        <hr/>
        <a href="index.php">Sign in Here...</a>
	</form>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->

</body>
</html>
<?php ob_end_flush();?>