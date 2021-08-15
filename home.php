<?php
include 'connection.php';
if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
	$name=$_SESSION['name'];
	$email=$_SESSION['email'];
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
</head>
<body>
	<nav class="navbar navbar-inverse" style="margin:1px;">
  	<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">CODES</a>
    	</div>
    	<div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="float: right;">
        <li><a href="#">Welcome <?php echo $name; ?>!</a></li>
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="score.php">Score Board<span class="label label-danger" style="margin: 1px;">New</span></a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  	</div>
	</nav>

<div class="container">
	<h1>Challenges</h1>
	
	<div class="col-lg-4 codes">
		<h4><strong>Length Of A String</strong></h4>
		<p>Write a java program to count the total number of characters excluding spaces .....</p>
		<a href="1.php" class="btn btn-success">Solve</a>
		<?php 
		$q="select * from codedata where email='$email' and codeid=1;";
		$u=mysqli_query($conn,$q);
		if(mysqli_num_rows($u)==1)
		{
			$row=mysqli_fetch_array($u);
			$status=$row['testcase'];
		}
		if($status==2) { ?>
		<div class="btn" style="float: right; background-color: white; color: green; border:1px solid green;">Completed</div>
		<?php
		$status=0;
		}
		?>
	</div>

	<div class="col-lg-4 codes">
		<h4><strong>Sum of Digits in a integer</strong></h4>
		<p>Write a java program to count the sum of digits in the given number.....</p>
		<a href="2.php" class="btn btn-success">Solve</a>
		<?php 
		$q="select * from codedata where email='$email' and codeid=2;";
		$u=mysqli_query($conn,$q);
		if(mysqli_num_rows($u)==1)
		{
			$row=mysqli_fetch_array($u);
			$status=$row['testcase'];
		}
		if($status==2) { ?>
		<div class="btn" style="float: right; background-color: white; color: green; border:1px solid green;">Completed</div>
		<?php 
		$status=0;
		} 
		?>
	</div>

	<div class="col-lg-4 codes">
		<h4><strong>Sum of n Natural numbers</strong></h4>
		<p>Write a java program to count the sum of n Natural Numbers.....</p>
		<a href="3.php" class="btn btn-success">Solve</a>
		<?php 
		//infront end question need to change
		//codeid need to change
		$q="select * from codedata where email='$email' and codeid=3;";
		$u=mysqli_query($conn,$q);
		if(mysqli_num_rows($u)==1)
		{
			$row=mysqli_fetch_array($u);
			$status=$row['testcase'];
		}
		if($status==2) { ?>
		<div class="btn" style="float: right; background-color: white; color: green; border:1px solid green;">Completed</div>
		<?php
		$status=0;
		} 
		?>
	</div>

	<!-- second column-->
	<div class="col-lg-4 codes">
		<p>update soon</p>
	</div>
	<div class="col-lg-4 codes">
		<p>update soon</p>
	</div>
	<div class="col-lg-4 codes">
		<p>update soon</p>
	</div>


</div>

</body>
</html>


<?php 
}else
{
	header("location:login.php");
	exit();
}
?>