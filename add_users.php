<?php
  require_once('db/db.php');
  session_start();
  
	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  $username = '';
  $fname = '';
  $id = '';
  $idd='';
  $position = '';
  $error ='';
  $mess = '';
  $password = '';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['fname']) && isset($_POST['id']) ){
      $fname = $_POST['fname'];
      $id = $_POST['id'];
    }
    if( isset($_POST['username']) && isset($_POST['idd'])){
      $idd= $_POST['idd'];
      $username = $_POST['username'];
      $password = $username;
    }
    if ( isset($_POST['position']) ){
      $position = $_POST['position'];
    }


    $db_u= '';
    $db_id = '';
    $slqi = "SELECT * FROM account WHERE username = '$username' or id_user = '$id' ";
		$result = $conn->query($slqi);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
			  $db_u = $row['username'];
        $db_id = $row['id_user'];
			}
		}   
  
       if(empty($fname)){
         $error = 'Please enter full name';
       } 
       else if(empty($id)){
         $error = 'Please enter id employee';
       }
       else if($db_id == $id){
         $error = 'id already exists';
       }
       else if(empty($username)){
         $error = 'Please enter username';
       }
       else if($db_u == $username){
         $error = 'username already exist';
       }
       else if(empty($idd)){
         $error = 'Please enter ID department';
       }
       else if(empty($position)){
         $error = 'Please choose employee position';
       }
       else{
         if($position === "head"){
          $sql = "INSERT INTO account ( username, password, role, id_user, fname, id_department, position) VALUES ('$username', '$password', '1', '$id','$fname', '$idd', '$position')";
          if ($conn -> query($sql)  === TRUE){
            $mess = 'add employee successful';
          }
          else{
            $error = "Department invalid";
          }
         } 
         else{
          $sql = "INSERT INTO account ( username, password, role, id_user, fname, id_department, position) VALUES ('$username', '$password', '0', '$id','$fname', '$idd', '$position')";
          if ($conn -> query($sql)  === TRUE){
            $mess = 'add employee successful';
          }
          else{
            $error = "Department invalid";
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
    <title>Add Employee</title>
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
        <li class="active">Add Employee</li> 
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
                  <h3 class="panel-title">Add Employee</h3>
                </div>
                <div class="panel-body">
                  <form method="POST">
                    <div class="form-group">
                      <label for="fname">Full name:</label>
                      <input value= "<?= $fname ?>"  type="text" class="form-control" id="fname" placeholder="Enter employee's ID" name="fname">
                    </div>
                    <div class="form-group">
                      <label for="id">ID</label>
                      <input value= "<?= $id ?>"   type="text" class="form-control" id="id" placeholder="Enter employee's ID" name="id">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value= "<?= $username ?>"   type="text" class="form-control" id="username" placeholder="Enter employee's username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="idd">ID Department:</label>
                        <input value= "<?= $idd ?>"   type="text" class="form-control" id="idd" placeholder="Enter id department" name="idd">
                    </div>
                    <div class="form-group">
                            <input class="form-check-input" type="radio" value="head" id="head" name="position">
                            <label class="form-check-label" for="head">
                              Head of Department
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="emloyee" id="emloyee" name = "position">
                            <label class="form-check-label" for="emloyee">
                              Employee
                            </label>
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