<!-- login.php: login page (accessible by all users) -->

<?php
    

	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
		$link = mysqli_connect("localhost", "root", "", "farm_db2");
 
	// Check connection
		if($link === false)
		{
    		die("ERROR: Could not connect. " . mysqli_connect_error());
		}
	
	
	
	// check login information
	require 'config.php';
	if(isset($_POST['username']) && isset($_POST['password-field'])){ /* if the email was provided */
		$username = $_POST['username'];
		$password = $_POST['password-field'];
		$query = "SELECT `ID_AFM` FROM `PERSON` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'";
		$result = mysqli_query($link,$query);
		
		$num = mysqli_num_rows($result);
		
		if($num != 0){ /* email and password exists */
			$data = mysqli_fetch_array($result);
			$id = $data['ID_AFM'];
			// redirect to main page or other pages for successful login
			session_start();
			$_SESSION['ID_AFM'] = $data['ID_AFM'];
			//$_SESSION['USERNAME'] = $username;
				
			echo '<script language="javascript">document.location="main.php";</script>';
			
		}
		else{ 
			echo '<script language="javascript">alert(" Wrong Usermane or Password");</script>';
			echo '<script language="javascript">document.location="login.php";</script>';
		}
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Agro Smart Monitor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<style>
		.img_logo{
			margin-top: 65px;
			text-align: center;
		}
	</style>
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img_logo" >
						<img src='Logos/LogoSample_2.png'  width='80%'>
						</div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								
			      	</div>
							<form action="Index-login.php" class="signin-form" name="form1" method="POST">
			      		<div class="form-group mt-3">
			      			<input name="username" id="username" type="text" class="form-control" required>
			      			<label class="form-control-placeholder" for="username">Username</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" name="password-field" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            
		          </form>
		          
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>