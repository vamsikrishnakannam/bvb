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
	<title>Length of a string</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
	<script type="text/javascript" src="voilate.js"></script>
</head>
<body>
	<?php 
	include("run.php");
	if(isset($_POST['run']))
	{
		$code=$_POST['code'];
		$sql="select * from codedata where email='$email' and codeid=1;";
		$run=mysqli_query($conn,$sql);
		if(mysqli_num_rows($run)==0)
		{
			$s="INSERT INTO codedata VALUES ('','$email','$name','1','\r\n$code','0');";
			$r=mysqli_query($conn,$s);
			if($r)
			{
				$input="java";
				$result=request($code,$input);
			}
			else
			{
				echo "something wrong";
			}
		}
		else
		{
			$s="UPDATE `codedata` SET `code`='\r\n$code' WHERE email='$email' AND codeid=1;";
			$r=mysqli_query($conn,$s);
			if($r)
			{
				$input="java";
				$result=request($code,$input);
			}
			else
			{
				echo "Something wrong";
			}
		}
		
	}
	if(isset($_POST['submit']))
	{
		$code=$_POST['code'];
		$in = array('python','kotlin');
		$op= array(6,6);
		$output= array();
		foreach($in as $input)
		{
			$res=request($code,$input);
			array_push($output, $res);
		}
		$testcase=0;
		for($x=0;$x<2;$x++)
		{
			if($op[$x]==$output[$x])
			{
				$testcase+=1;
			}
		}

		$sql="select * from codedata where email='$email' and codeid=1;";
		$run=mysqli_query($conn,$sql);
		if(mysqli_num_rows($run)==0)
		{
			$s="INSERT INTO codedata VALUES ('','$email','$name','1','\r\n$code','$testcase');";
			$r=mysqli_query($conn,$s);
		}
		else
		{
			$s="UPDATE `codedata` SET `code`='$code',`testcase`='$testcase' WHERE email='$email' AND codeid='1';";
			$r=mysqli_query($conn,$s);
		}

	}
	?>
	<div class="container-fluid">
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
        <li><a href="score.php">Score Board</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  	</div>
	</nav>
		<div class="col-lg-6" style="margin-top:3px; margin-right: 0px;">
				<div class="panel panel-default pb" style="margin: 0px;">
					<div class="panel-heading">Challenge</div>
					<div class="panel-body" style="height:465px;overflow-y: scroll;">
						<h2>length of a string</h2>
						<p>write a Java Program to count the total number of characters excluding spaces between the words in the above given string</p>
						<p><b>Input Format :</b> Input contains a string</p>
						<p><b>Input Constraints :</b>1<=(length of a string)<=10^5</p>
						<p><b>Output Format :</b> Print the desired output</p>
						<p><b>Sample Input :</b></p>
						<p>java</p>
						<p><b>Sample Output :</b></p>
						<p>4</p>
					</div>
				</div>
		</div>
		<div class="col-lg-6" style="margin-top:3px; margin-left: 0px;">
			<div class="panel panel-default pb">
				<div class="panel-heading">Code</div>
				<div class="panel-body" style="height:465px;overflow-y: scroll;">
					<form action="" method="POST">
						<div class="form-group">
							<textarea id="d2" class="form-control pb" style="text-align:left; width: 100%; height: 400px; overflow-y: scroll;" spellcheck="false" name="code" required="" value="">
								<?php 
									$q="select * from codedata where email='$email' and codeid=1;";
									$u=mysqli_query($conn,$q);
									if(mysqli_num_rows($u)==1)
									{
										$row=mysqli_fetch_array($u);
										$ccc=$row['code'];
										echo $ccc;
									}
								?>	
							</textarea>
							<button name="submit" class="btn btn-success button" style="float: right; margin: 5px;">submit</button>
							<button name="run" class="btn btn-success button" style="float: right; margin: 5px;">Run</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
		<div class="result">
		<div class="col-lg-6">
		<div class="panel panel-default pb">
			<div class="panel-heading">Output</div>
			<div class="panel-body" style="height:200px;overflow-y: scroll;">
				<p><b>Input:</b></p>
				<p>java</p>
				<p><b>Excepted Output:</b></p>
				<p>4</p>
				<p><b>Your output:</b></p>
				<p></p><?php if(isset($result)) {echo $result;} ?></p>
				<br>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default pb">
				<div class="panel-heading">Test Cases</div>
				<div class="panel-body" style="height:200px;overflow-y: scroll;">
				<?php if (isset($op)) {?>
					<?php if($op[0]==$output[0])
					{ ?>
						<div class="alert alert-success">TestCase #1 passed</div>
					<?php }else{ ?>
						<div class="alert alert-danger">TestCase #1 failed</div>
					<?php } ?>

					<?php if($op[1]==$output[1])
					{ ?>
						<div class="alert alert-success">TestCase #2 passed</div>
					<?php }else{ ?>
						<div class="alert alert-danger">TestCase #2 failed</div>
					<?php } ?>

				<?php } ?>
				</div>
			</div>
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