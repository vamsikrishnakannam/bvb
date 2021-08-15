<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
</head>
<body style="background-image:url('loginbg.jpg'); color: black;">
	<?php
	include 'connection.php';
	if(isset($_POST['submit'])) 
	{
		$email=validate($_POST['email']);
		$phone=validate($_POST['phone']);
		$name=validate($_POST['name']);
		$password=validate($_POST['password']);
		$cpassword=validate($_POST['cpassword']);
		if(strlen($phone)<10 or strlen($phone)>10)
		{
			$error[]="Phone Number is INVALID";
		}
		else if (strlen($name)<4)
		{
			$error[]="Name must be greather than 4 characters";
		}
		else if(strlen($password)<6)
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
			$token = bin2hex(random_bytes(15));
			$query="SELECT * FROM users WHERE email='$email';";
			$run=mysqli_query($conn,$query);
			if(mysqli_num_rows($run))
			{
				$error[]="Email already exists";
			}
			else
			{
				$q="INSERT INTO users VALUES('','$email','$phone','$name','$password','$token','inactive')";
				$r=mysqli_query($conn,$q);
				if($r)
				{
					$subject="Verify your account";
					$message="Hi, $name<br>Verify your account <br> <a href='https://knrblj.xyz/validate.php?token=$token'>Click here</a>";
					$headers="Content-type:text/html;charset=UTF-8";
					if(mail($email, $subject, $message,$headers))
					{
						$_SESSION['msg']="Activate your account, Mail send to $email.Check in spam folder also";
						header("location:login.php");
						exit();
					}
					else
					{
						$error[]="Unable to send mail";
					}

				}
				else
				{
					$error[]="Something Went Wrong";
				}
			}
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
        <li class="active"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
	<div class="container-fluid" style="margin-top: 5px;">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<div class="form-group form">
			<form action="" method="POST">
				<center><h4>Register</h4></center>

				<?php if(isset($error))
				{
					foreach ($error as $error)
					{
				?>
				<p class="alert alert-danger"><?php echo $error;?></p>
				<?php }}?>

				<label for="email">Email</label>
				<input type="email" id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email; } ?>" placeholder="Email address..." required=""><br>

				<label for="name">Phone Number</label>
				<input type="number" id="phone" name="phone" class="form-control" value="<?php if(isset($phone)){echo $phone; } ?>" placeholder="Your phone number" required=""><br>

				<label for="name">Name</label>
				<input type="name" id="name" name="name" class="form-control" value="<?php if(isset($name)){echo $name; } ?>" placeholder="Your Name..." required=""><br>

				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="<?php if(isset($password)){echo $password; } ?>" placeholder="Your Password..." required=""><br>

				<label for="cpassword">Confrim Password</label>
				<input type="password" name="cpassword" class="form-control" value="<?php if(isset($cpassword)){echo $cpassword; } ?>" placeholder="Confrim Password..." required=""><br>


				<input type="submit" name="submit" class="btn btn-primary" value="register"><br>

				<a href="login.php" class="btn btn-link" style="margin:3px 0px; padding: 0px;">Already have account</a><br>
			</form>
		</div>
	</div>
</div>
<div class="col-sm-4"></div>
</body>
</html>