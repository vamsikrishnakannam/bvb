<?php 
include 'connection.php';
if(isset($_GET['token']))
{
	$token=$_GET['token'];
	$query="UPDATE `users` SET `status`='active' WHERE token='$token'";
	$run=mysqli_query($conn,$query);
	if($run)
	{
		$_SESSION['msg']="Your account is Activated Successfully";
		header("location:login.php");
		exit();
	}
	else
	{
		$_SESSION['msg']="Unable to activate your account";
		header("location:register.php");
		exit();
	}
}
else
{
	header("location:register.php");
	exit();
}
?>