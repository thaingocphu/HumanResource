<?php
  require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  $id_d= '';
  $name='';
  $error='';
  $mess ='';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["id"]) && isset($_POST["name"])){
      $id_d=$_POST["id"];
      $name=$_POST["name"];

      $db_id = '';
      $db_name= '';
      $slqi = "SELECT * FROM department WHERE name = '$name' or id_department = '$id_d' ";
      $result = $conn->query($slqi);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $db_name = $row['name'];
          $db_id = $row['id_department'];
        }
      }  

      if(empty($id_d)){
        $error = 'Please enter department id';
      }
      else if($db_id == $id_d){
        $error ='ID department already exists';
      }
      else if(empty($name)){
        $error = 'Please enter department name';
      }
      else if($db_name = $name){
        $error = 'Department already exists';
      }
      else if($id_d === $name){
        $error= 'Department ID must not same Deparment name';
      }
      else{
        $sql = "INSERT INTO department (id_department, name) VALUES ('$id_d', '$name')";
        if ($conn->query($sql) === TRUE) {
          $mess = 'Add Department successful';
        } else {
            $error = "Add department failed, ID Department already exists";
        }
        $conn->close();
      }
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
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
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Internal Website<small></small></h1>
        </div>
      </div>
    </div>
  </header>

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="index.php">Dashboard</a></li>
        <li class="active">Add Department</li> 
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
                  <h3 class="panel-title">Add Department</h3>
                </div>
                <div class="panel-body">
                  <form method="POST">
                    <div class="form-group">
                      <label for="id">Department's ID:</label>
                      <input value="<?= $id_d ?>" type="text" class="form-control" id="id" placeholder="Enter department's ID" name="id">
                    </div>
                    <div class="form-group">
                      <label for="name">Department's Name:</label>
                      <input value="<?= $name ?>" type="text" class="form-control" id="name" placeholder="Enter department's Name" name="name">
                    </div>
                    <?php
                      if (!empty($error)) {
                          echo "<div class='errorMessage alert alert-danger'>$error</div>";
                      }else if(!empty($mess)){
                        echo "<div class='errorMessage alert alert-success'>$mess</div>";
                      } 
                    ?>
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