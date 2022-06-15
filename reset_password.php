<?php
	require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

	$e_name = '';
	$error = '';
	$mess = '';



	if($_SERVER["REQUEST_METHOD"] == "POST"){
	  if(isset($_POST["e_name"])){
		$e_name = $_POST["e_name"];
		$fname ='';
		
		$slqi = "SELECT * FROM account WHERE fname = '$e_name'";
		$result = $conn->query($slqi);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
			  $fname = $row['fname'];
			}
		  }
		  
		if(empty($e_name)){
		  $error = 'please enter employee name';
		}
		else if($fname !== $e_name){
			$error = 'employee not exist';
		}
		else {
		  $sql = "UPDATE account SET password = username WHERE fname ='$e_name' ";
		  if ($conn->query($sql) === TRUE) {
			$mess = 'Reset password successful';
		  } else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
		  }
		}
		$conn->close();
	  }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>

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
					<li><a href="index.php">Dashboard</a></li>
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
                <li><a href="index.php">Dashboard</a></li>
                <li class="active">Reset Password</li> 
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
						<a href="manage_leave.php" class="list-group-item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> leave Management</a>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading main-color-bg">
							<h3 class="panel-title">Reset Password</h3>
						</div>
						<div class="panel-body">
                            <div class="text-center">
                                <h2 class="text-center">Your Employee Forgot Password?</h2>
                                <p>You can reset Employee password here.</p>
                                <div class="panel-body">
                  
                                  <form method="POST">
                  
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input value="<?= $e_name ?>" type="text" id="e_name" name="e_name" placeholder="Enter employee's name" class="form-control" >
                                      </div>
                                    </div>
									<?php
										if (!empty($error)) {
											echo "<div class='errorMessage alert alert-danger'>$error</div>";
										}else if(!empty($mess)){
											echo "<div class='errorMessage alert alert-success'>$mess</div>";
										} 
									?>
                                    <div class="form-group">
                                      <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>                                    
                                  </form>
                  
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
