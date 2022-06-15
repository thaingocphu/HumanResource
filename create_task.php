<?php
  require_once('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}
  $username = $_SESSION["username"];
  $tname = '';
  $deadline ='';
  $ename ='';
  $detail ='';
  $error = '';
  $message ='';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if( isset($_POST['tname']) && isset($_POST['deadline'])){
      $tname = $_POST['tname'];
      $deadline = $_POST['deadline'];
    }
    if(isset($_POST['ename']) && isset($_POST['detail'])){
      $ename = $_POST['ename'];
      $detail = $_POST['detail'];
    }
    
    $db_ename= '';
    $slqi = "SELECT * FROM account WHERE fname = '$ename' and role = '0' ";
		$result = $conn->query($slqi);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
			  $db_ename = $row['fname'];

			}
		}
    

    if (empty($tname)){
      $error = 'please enter task name';
    }
    else if(empty($deadline)){
      $error = 'please choose deadline';
    }
    else if(empty($ename)){
      $error = 'please enter employee name';
    }
    else if($db_ename != $ename){
      $error = 'emloyee not exists or people is a head';
    }
    else if(empty($detail)){
      $error = 'please enter detail of task';
    }
    else{
      $sql = "INSERT INTO task ( username, tname, deadline, ename, detail ) VALUES ('$username', '$tname', '$deadline','$ename', '$detail')";
      if ($conn -> query($sql)  === TRUE){
        $mess = 'Create task successful';
      }
      else{
        $error = "ERROR: Can not create task";
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
    <title>Create Task</title>
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
        <li class="active">Create Task</li>
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
                  <h3 class="panel-title">Create Task</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <form method="post">
                        <div class="form-group">
                            <label for="tname">Task Name:</label>
                            <input Value="<?= $tname ?>" type="text" class="form-control" id="tname" placeholder="Enter task name" name="tname">
                        </div>
                        <div class="form-group">
                          <label for="deadline">Deadline</label>
                          <input Value="<?= $deadline ?>" type="date" class="form-control" id="deadline" placeholder="Enter Deadline" name="deadline">
                      </div>
                        <div class="form-group">
                            <label for="ename">Employee Name:</label>
                            <input Value="<?= $ename ?>" type="text" class="form-control" id="ename" placeholder="Enter Employee name to do this task" name="ename">
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail:</label>
                            <textarea Value="<?= $detail ?>" rows="4" type="text" class="form-control" id="detail" placeholder="Enter detail of task" name="detail"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="uploadfile" id="file"/>
                        </div>
                        <?php
                          if (!empty($error)) {
                              echo "<div class='errorMessage alert alert-danger'>$error</div>";
                          }else if(!empty($mess)){
                            echo "<div class='errorMessage alert alert-success'>$mess</div>";
                          } 
                        ?>
                        <button class="btn btn-primary" type="submit" class="btn btn-default">Submit</button>
                    </form>
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