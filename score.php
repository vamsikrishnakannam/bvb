<?php 
//session_start();
include 'connection.php';
if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
	$name=$_SESSION['name'];
	$email=$_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Score Board</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>">
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
        <li><a href="home.php">Home</a></li>
        <li class="active"><a href="score.php">Score Board</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  	</div>
	</nav>

	<div class="container">
		<div class="panel panel-default" style="margin-top: 3px;">
		<div class="panel-heading">Leader Board</div>
		<div class="panel-body">
			<table class="table table-striped tb">
				<thead>
					<tr>
						<th scope="col">S.No</th>
						<th scope="col">Name</th>
						<th scope="col">Solved</th>
						<th scope="col">Score</th>
					</tr>
				</thead>
				<tbody>
					<?php 
							$sql="SELECT name,sum(testcase) score FROM `codedata` group by email ORDER BY `score` DESC";
							$run=mysqli_query($conn,$sql);
							$i=0;
							while ($res=mysqli_fetch_array($run))
							{ $i++?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $res['name'];?></td>
									<td><?php echo $res['score']/2;?></td>
									<td><?php echo $res['score'];?></td>
								</tr>
					<?php 
						}

					?>
				</tbody>
			</table>
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