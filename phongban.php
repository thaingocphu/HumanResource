<?php
require_once ('db/db.php');
session_start();

if(!isset($_SESSION["username"])){
		header('location: login.php');
}

function get_deparment(){
  $sql = "SELECT * FROM department";
  $conn = create_connection();
  $result = $conn->query($sql);
  $data=array();

  for($i = 1; $i <= $result-> num_rows; $i++ ){
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
  <title>Department</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>
  <?php $department = get_deparment() ?>
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
					<li class="active"><a href="phongban.php">Department</a></li>
					<li><a href="manage_leave.php">Leaves Management</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Hello, <?= $_SESSION['username'] ?></a></li>
					<li><a href="logout.php">Logout</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Internal Website<small></small></h1>
        </div>
        <div class="col-md-2">
          <div class="dropdown create">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Options
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="add_department.php">Add Department</a></li>
              <li><a href="appoint_head.php">Appoint Head</a></li>
              <li><a href="degrade.php">Degrade Head</a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="index.php">Dashboard</a></li>
        <li class="active">Department</li> 
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
              <h3 class="panel-title">Department</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <input class="form-control" type="text" placeholder="Search Department">
                </div>
              </div>
              <br>
              <table class="table table-striped table-hover">
                <tr>
                  <th>NO</th>
                  <th>Department's ID</th>
                  <th>Department's Name</th>
                  <th></th>
                </tr>
                <?php
                  $i=0;
                  foreach ($department as $d){
                    $id = $d['id_department'];
                    $name = $d['name'];
                    $i++;
                ?>    
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $id ?></td>
                      <td><?= $name ?></td>
                      <td>
                        <a class="btn btn-info" href="edit_department.php?id='<?= $d['id_department']  ?>'">Edit</a>
                      </td>
                    </tr>
                <?php } ?>
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
