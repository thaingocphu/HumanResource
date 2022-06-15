<?php
	session_start();
	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resend Task</title>
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
					<li><a href="manage_Task.php">Dashboard</a></li>
					<li><a href="H_inf_user.php">Personal Information</a></li>
					<li><a href="H_manage_leave.php">Leaves Management</a></li>
					<li><a href="H_leave_history.php">Leaves History</a></li>
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
        <li><a href="manage_Task.php">Dashboard</a></li>
        <li class="active">Resend Task</li>
      </ol>
		</div>
	</section>
    
      <section id="main">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                  <a href="manage_Task.php" class="list-group-item active main-color-bg">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Control Panel
                  </a>
                  <a href="H_inf_user.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Personal Information</a>
                  <a href="H_manage_leave.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Leaves Management</a>
                  <a href="H_leave_history.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Leave History</a>
                </div>
              </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading main-color-bg">
                  <h3 class="panel-title">Resend Task</h3>
                </div>
                <div class="panel-body">
                    <form>
                        <h3 class="text-center text-primary">Packing Products</h3>
                        <div class="form-group">
                          <label for="Decription">Decription:</label>
                          <textarea rows="4" type="text" class="form-control" id="Decription" placeholder="Enter Decription for your works" name="Decription"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="file">Choose file:</label>
                          <input type="file" name="file" id="file">
                        </div>
                        <div style="display:none" class="errorMessage alert alert-danger">Please enter</div>
                        <button class="submit btn btn-primary" type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <footer id="footer" class="col-md-12">
      <p>Copyright Software Engineering TDTU, &copy; 2021</p>
    </footer>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="js/bootstrap.min.js"></script>
</body>
</html>