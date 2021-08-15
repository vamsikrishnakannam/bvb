<?php 
include 'connection.php';
if(isset($_GET['token']))
{
	$token=$_GET['token'];      
	if(isset($_POST['submit']))
	{
		$password=validate($_POST['password']);
		$cpassword=validate($_POST['cpassword']);
		if(strlen($password)<6)
		{
			$error[]="Password must be greather than 6 characters";
		}
		else if ($password!=$cpassword) 
		{
			$error[]="Password and Confrim password not match";
		}
		else
		{
			$password=password_hash($password, PASSWORD_BCRYPT);
			$query="UPDATE `users` SET `password`='$password' WHERE token='$token'";
			$run=mysqli_query($conn,$query);
			if($run)
			{
				$_SESSION['msg']="Password is Updated Successfuly...";
				header("location:login.php");
				exit();
			}
			else
			{
				$error[]="unable to update";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
</head>
<body style="background-image:url('loginbg.jpg'); color: black;">
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
				<center><h4>Recover your Account</h4></center>

				<?php if(isset($error))
				{
					foreach ($error as $error)
					{
				?>
				<p class="alert alert-danger"><?php echo $error;?></p>
				<?php }}?>

				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="<?php if(isset($password)){echo $password; } ?>" placeholder="Your Password..." required=""><br>

				<label for="cpassword">Confrim Password</label>
				<input type="password" name="cpassword" class="form-control" value="<?php if(isset($cpassword)){echo $cpassword; } ?>" placeholder="Confrim Password..." required=""><br>


				<input type="submit" name="submit" class="btn btn-primary" value="Reset"><br>

				<a href="login.php" class="btn btn-link" style="margin:3px 0px; padding: 0px;">Login</a><br>
			</form>
		</div>
	</div>
	<div class="col-sm-4"></div>
	</div>

</body>
</html>
<?php
} 
else
{
	header("location:login.php");
	exit();
}
?>
?>