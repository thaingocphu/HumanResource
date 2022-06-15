<?php
  require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}


  function get_leave(){
    $username = $_SESSION["username"];
    $sql = "SELECT * FROM leave_app WHERE username = '$username' ";
    $conn = create_connection();
    $result = $conn->query($sql);
    $data=array();
  
    for($i =1 ; $i <= $result-> num_rows; $i++ ){
      $row = $result -> fetch_assoc();
      $data[] = $row;
    }
    return $data;
  }

  function get_num_off_accepted(){
    $username = $_SESSION["username"];
    $sql = "SELECT * FROM leave_app WHERE username = '$username' and status = 1";
    $conn = create_connection();
    $result = $conn->query($sql);
    $data=array();
    $num = 0;
    if($result){
			while($row = $result->fetch_assoc()){
			  $num += $row['num_off'];
			}
		}

    return $num;
  }

  function get_lib_num_off() {
    $sql = "SELECT * FROM lib_num_off WHERE position = '{$_SESSION["position"]}' ";
    $conn = create_connection();
    $result = $conn->query($sql);
    $num = 0;
    if($result){
			while($row = $result->fetch_assoc()){
			  $num = $row['num_off'];
			}
		}
    return $num;   
  }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>
<?php $leave = get_leave(); $lib_num_off = get_lib_num_off(); $num_off = get_num_off_accepted();?>
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
					<li class="active"><a href="H_leave_history.php">Leaves History</a></li>
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
                <div class="col-md-2">
                    <div class="dropdown create">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Options
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="H_leave_application.php">Create Leave Application</a></li>
                      </ul>
                    </div>
                  </div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
                <li><a href="manage_Task.php">Dashboard</a></li>
                <li class="active">Leave History</li>			
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
              <h3 class="panel-title">Leaves History</h3>
            </div>
            <div class="panel-body">
              <table class="table bg-success">
              <tr>
                  <th>Number days of leave:</th>
                  <td><?= $lib_num_off ?> days</td>
                </tr>
                <tr>
                  <th>Total days of leaved:</th>
                  <td><?= $num_off ?> days</td>
                </tr>
                <tr>
                  <th>The remaining days of leave:</th>
                  <td><?= $lib_num_off - $num_off ?> days</td>
                </tr>
              </table>
              <table class="table table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">number day off</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i=0;
                  foreach ($leave as $l){
                    $dayoff = $l['num_off'];
                    $reason = $l['reason'];
                    $status = $l['status'];
                    $i++;
                ?> 
                  <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $dayoff ?></td>
                    <td><?= $reason ?></td>
                    <td><?php 
                      if ($status == 0) {
                        echo '<span class="label label-default">Processing</span>';
                      } else if ($status == 1) {
                        echo '<span class="label label-success">Accepted</span>';
                      } else {
                        echo '<span class="label label-warning">Not Accept</span>';
                      }
                      ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
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