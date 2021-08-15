<?php
include 'connection.php';
if(isset($_POST['submit']))
{
	$email=validate($_POST['email']);
	$query="select * from users where email='$email'";
	$run=mysqli_query($conn,$query);
	if(mysqli_num_rows($run))
	{
		$result=mysqli_fetch_array($run);
		$token=$result['token'];
		$name=$result['name'];
		$subject="Reset your account";
		$message="Hi, $name<br>Reset password to your account <br> <a href='https://knrblj.xyz/rpass.php?token=$token'>Click here</a>";
		$headers="Content-type:text/html;charset=UTF-8";
		if(mail($email,$subject,$message,$headers))
		{
			$_SESSION['msg']="Check your mail to reset password.Check in spam folder also";
		}
		else
		{
			$error[]="unable to send mail";
		}
	}
	else
	{
		$error[]="unable to find the account";
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
		<center><h4>Reset Password</h4></center>
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


				<input type="submit" name="submit" class="btn btn-primary" value="reset"><br>
				<a href="login.php" class="btn btn-link" style="margin:3px 0px; padding: 0px;">Login</a><br>
				</form>
		</div>
	</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>