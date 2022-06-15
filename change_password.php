<?php
  require_once('db/db.php');

	session_start();
	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  $username = $_SESSION["username"];
  $cur_pass = '';
  $newpass= '';
  $c_newpass='';
  $error='';
  $mess ='';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["cur_pass"]) && isset($_POST["newpass"]) && isset($_POST["c_newpass"])){
      $cur_pass = $_POST['cur_pass'];
      $newpass=$_POST["newpass"];
      $c_newpass=$_POST["c_newpass"];

      $slqi = "SELECT password FROM account WHERE username = '$username'";
      $result = $conn->query($slqi);
      
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $old_pass = $row['password'];
        }
      }

      if(empty($cur_pass)){
        $error = 'please enter current password';
      }
      else if($old_pass != $cur_pass){
        $error = 'password invalid';
      }
      else if(empty($newpass)){
        $error = 'please enter new password';
      }
      else if($newpass === $username){
        $error= 'new password must not same username';
      }
      else if($cur_pass === $newpass){
        $error = 'current password must not same as new password';
      }
      else if(empty($c_newpass)){
        $error = 'please enter new password again';
      }
      else if($newpass !== $c_newpass){
        $error = 'new password is not same as confirm password';
      }
      else if(!empty($username)){
        $sql = "UPDATE account SET password ='$newpass' WHERE username ='$username' ";
        if ($conn->query($sql) === TRUE) {
          $mess = 'Change password successful';
        } else {
          $error = "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Change Password</title>
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
				</button>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="manage_myTask.php">Dashboard</a></li>
					<li><a href="inf_user.php">Personal Information</a></li>
					<li><a href="leave_history.php">Leaves History</a></li>
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
        <li><a href="manage_myTask.php">Dashboard</a></li>
        <li class="active">Change Password</li> 
			</ol>
		</div>
	</section>

    <section id="main">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="list-group">
                <a href="manage_myTask.php" class="list-group-item active main-color-bg">
                  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Control Panel
                </a>
                <a href="inf_user.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Personal Information</a>
                <a href="leave_history.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Leave History</a>
              </div>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading main-color-bg">
                  <h3 class="panel-title">Change Password</h3>
                </div>
                <div class="panel-body">
                  <form method="POST">
                    <div class="form-group">
                        <label for="cur_pass">Current Password:</label>
                        <input value="<?= $cur_pass ?>" type="password" class="form-control" id="cur_pass" placeholder="Enter Current Password" name="cur_pass">
                    </div>
                    <div class="form-group">
                        <label for="newpass">New Password:</label>
                        <input value="<?= $newpass ?>" type="password" class="form-control" id="newpass" placeholder="Enter new password" name="newpass">
                    </div>
                    <div class="form-group">
                        <label for="c_newpass">Confirm New Password:</label>
                        <input value="<?= $c_newpass ?>" type="password" class="form-control" id="c_newpass" placeholder="Enter new password again" name="c_newpass">
                    </div>
                    <?php
                      if (!empty($error)) {
                          echo "<div class='errorMessage alert alert-danger'>$error</div>";
                      }else if(!empty($mess)){
                        echo "<div class='errorMessage alert alert-success'>$mess</div>";
                      } 
                    ?>
                    <button class="submit btn btn-primary " type="submit" class="btn btn-default">Submit</button>
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