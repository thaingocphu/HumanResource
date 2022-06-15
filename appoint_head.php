<?php
  require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  $ename = '';
  $error = '';
  $mess = '';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["ename"])){
      $ename = $_POST["ename"];      
      $db_ename = '';

      $slqi = "SELECT * FROM account WHERE fname = '$ename' and role = '0' ";
      $result = $conn->query($slqi);
      
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $db_ename = $row['fname'];
        }
      }

      if(empty($ename)){
        $error = 'please enter name of employee';
      }
      else if($db_ename != $ename){
        $error = 'employee name not exists or people is not an employee';
      }
      else {
        $sql = "UPDATE account SET position ='head', role = '1' WHERE fname ='$ename' ";
        if ($conn->query($sql) === TRUE) {
          $mess = 'Appoint head successful';
        } else {
          $error = "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Appoint head</title>
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
        <li class="active">Appoint head</li> 
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
                  <h3 class="panel-title">Appoint Head of Department</h3>
                </div>
                <div class="panel-body">
                  <form method="POST">
                    <div class="form-group">
                      <label for="ename">Employee name:</label>
                      <input value="<?= $ename ?>"type="text" class="form-control" id="ename" placeholder="Enter employee's name" name="ename">
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