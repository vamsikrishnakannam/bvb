<?php 
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
</head>
<body style="background-image:url('loginbg.jpg'); color: black;">
	<?php 
	if(isset($_POST['submit']))
	{
		$email=validate($_POST['email']);
		$password=validate($_POST['password']);
		$query="select * from users where email='$email'";
		$run=mysqli_query($conn,$query);
		if(mysqli_num_rows($run))
		{
			$result=mysqli_fetch_array($run);
			$pass=$result['password'];
			$pass_decode=password_verify($password, $pass);
			if($pass_decode)
			{
				if($result['status']=='active')
				{
					$_SESSION['email']=$result['email'];
					$_SESSION['name']=$result['name'];
					$_SESSION['id']=$result['id'];
					header("location:home.php");
					exit();
				}
				else
				{
					$error[]='Your acccount is not activated';
				}
			}
			else
			{
				$error[]="Incorrect Login details";
			}
		}
		else
		{
			$error[]="Incorrect Login details";
		}
	}
	?>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">BVB Codes</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="float: right;">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="mailto:knrblj@gmail.com">Contact Us</a></li>
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
		<div class="container-fluid" style="margin-top: 5px;">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<div class="form-group form">
			<form action="" method="POST">
				<center><h4>Login</h4></center>

				<?php 
				if(isset($error))
				{
					foreach ($error as $error)
					{
				?>
				<p class="alert alert-danger"><?php echo $error;?></p>
				<?php }}?>

				<?php
					if(isset($_SESSION['msg']))
					{?>
						<p class="alert alert-success"><?php echo $_SESSION['msg'];?></p>
					<?php 
					unset($_SESSION['msg']);
					}
				?>



				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email; } ?>" placeholder="Email address..." required=""><br>

				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="<?php if(isset($password)){echo $password; } ?>" placeholder="Your Password..." required=""><br>


				<input type="submit" name="submit" class="btn btn-primary" value="Login"><br>
				<a href="reset.php" class="btn btn-link" style="margin:3px 0px; padding: 0px;">Forgot Password?</a><br>

				<a href="resend.php" class="btn btn-link" style="margin:3px 0px; padding: 0px;">Resend activation Mail</a><br>
				</form>
		</div>
	</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>