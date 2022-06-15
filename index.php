<?php
	require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

	function get_user(){
		$sql = "SELECT * FROM account";
		$conn = create_connection();
		$result = $conn->query($sql);
		$data=array();
	  
		for($i =1 ; $i <= $result-> num_rows; $i++ ){
		  $row = $result -> fetch_assoc();
		  $data[] = $row;
		}
		return $data;
	}

	function get_department(){
		$sql = "SELECT * FROM department";
		$conn = create_connection();
		$result = $conn->query($sql);
		$data=array();
	  
		for($i =1 ; $i <= $result-> num_rows; $i++ ){
		  $row = $result -> fetch_assoc();
		  $data[] = $row;
		}
		return $data;
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>
<?php 
	$User = get_user();
	$department = get_department();
	$i=0;
	$j=0;
	foreach ($User as $u){
	  $i++;
	}
	foreach ($department as $d){
		$j++;
	  }
?>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Dashboard</a></li>
					<li><a href="nhansu.php">Human Resources</a></li>
					<li><a href="phongban.php">Department</a></li>
					<li><a href="manage_leave.php">Leaves Management</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Hello, <?= $_SESSION['username'] ?></a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Internal Website</h1>
				</div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li class="active">Dashboard</li>
			</ol>
		</div>
	</section>

	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="list-group">
						<a href="index.php" class="list-group-item active main-color-bg">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Control Panel
						</a>
						<a href="nhansu.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Human resource Management</a>
						<a href="phongban.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Department Management</a>
						<a href="manage_leave.php" class="list-group-item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Leave Management</a>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Overview</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-6">
								<div class="well dash-box">
									<h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $i ?></h2>
									<h4>Employees</h4>
								</div>
							</div>
							<div class="col-md-6">
								<div class="well dash-box">
									<h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?= $j ?></h2>
									<h4>Department</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <footer id="footer" class="col-md-12">
		<p>Copyright Software Engineering TDTU, &copy; 2021</p>
    </footer>
    <!-- Bootstrap core JavaScript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    </body>
    </html>
