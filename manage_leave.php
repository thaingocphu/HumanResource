<?php
  require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['id'])){
      $id = $_POST['id'];
      $status = isset($_POST['action']) ? 1 : 2;

      $sql = "UPDATE leave_app SET status = {$status} WHERE id = {$id}";
      if ($conn -> query($sql)  === TRUE){
        $mess = 'This application accepted';
      }
      else{
        $error = "This application did not accept";
      }

    } else {
      $error = "can not manage this application";
    }
  }

  function get_application() {
    $sql = "SELECT * FROM leave_app, account WHERE account.username = leave_app.username and role ='1' order by leave_app.id asc";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage leave Applications</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>
  <?php $application = get_application(); ?>
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
					<li class="active"><a href="manage_leave.php">Leaves Management</a></li>
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
        <li class="active">Leaves Management</li> 

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
                  <h3 class="panel-title">Manage Leave Applications</h3>
                </div>
                <div class="panel-body">
                    <?php
                      if (!empty($error)) {
                          echo "<div class='errorMessage alert alert-danger'>$error</div>";
                      }else if(!empty($mess)){
                        echo "<div class='errorMessage alert alert-success'>$mess</div>";
                      } 
                    ?>
                    <ul class="list-group">
                      <?php
                        $i=0;
                        foreach ($application as $a){
                          $id = $a['id'];
                          $dayoff = $a['num_off'];
                          $reason = $a['reason'];
                          $fname = $a['fname'];
                          $file = $a['file'];
                          $status = $a['status'];
                          $i++;
                      ?>
                      <form method="post">
                      <input type="hidden" name="id" value="<?= $id ?>" />  
                      <li class="list-group-item clearfix border 1 mb-3">
                          <h4 class="list-group-item-heading">
                            <b><?= $fname ?></b>
                            <span class="pull-right">
                              <i>Status: 
                              <?php 
                                if ($status == 0) {
                                  echo '<span class="label label-default">Processing</span>';
                                } else if ($status == 1) {
                                  echo '<span class="label label-success">Accepted</span>';
                                } else {
                                  echo '<span class="label label-warning">Not Accept</span>';
                                }
                              ?>
                              </i>
                            </span>
                          </h4>
                          <hr/>
                          <div class="list-group-item-text col-md-8">
                              <a class="text-decoration-none text-primary" data-toggle="collapse" href="#<?= $i ?>" aria-expanded="false" aria-controls="detail">
                                  <p>Detail...</p>
                              </a>
                              <div class="collapse" id="<?= $i ?>">
                                  <div class="card card-body" style="padding: 10px;">
                                      <p><b>Number day off:</b> <?= $dayoff ?></p>
                                      <p><b>reason:</b> <?= $reason ?></p>
                                      <p><b>File:</b> <?= $file ?></p>
          
                                  </div>
                                </div>
                          </div>
                          <div class="col-md-2">
                              <input type="submit" class="btn btn-warning" name="not_action" value="Not Accept"/>
                            </div>
                            <div class="col-md-2">
                              <input type="submit" class="btn btn-success float-right" name="action" value="Accept"/>
                            </div>                     
                      </li>
                      </form>
                      <?php } ?>
                  </ul>
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