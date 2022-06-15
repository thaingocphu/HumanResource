<?php
  require_once('db/db.php');
	session_start();
  
	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}
  
  $username = $_SESSION["username"];
  $dayoff ='';
  $reason = '';
  $error='';
  $mess ='';
  $tdayoff='';
  $total='';

  if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if( isset($_POST["dayoff"]) && isset($_POST["reason"])){
      $dayoff = $_POST["dayoff"];
      $reason = $_POST["reason"];

      if(empty($dayoff)){
        $error = 'Please enter number day off';
      }
      else if(empty($reason)){
        $error = 'Please write your reason';
      } 
      else if (check_have_leave_processing()) {
        $error = 'You already have a pending application';
      }
      else{
        $sql = "INSERT INTO leave_app ( username, num_off, reason) VALUES ('$username', '$dayoff', '$reason')";
        if ($conn->query($sql) === TRUE) {
          $mess = 'create leave application successful';
        } else {
          $error = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
      }
    }
  }

  function check_have_leave_processing() {
    $username = $_SESSION["username"];
    $sql = "SELECT * FROM leave_app WHERE username = '$username' and status ==== '0' ";
    $conn = create_connection();
    $result = $conn->query($sql);
    $is_have = false;
    if($result){
			$is_have = true;
		}
    return $is_have; 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
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
        <li class="active">Create Leave Application</li> 			
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
                  <h3 class="panel-title">Leave Application</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <form method="post">
                        <div class="form-group">
                            <label for="dayoff">Number Day Off</label>
                            <input value= "<?= $dayoff ?>" type="text" class="form-control" id="dayoff" placeholder="Enter number day off" name="dayoff">
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <textarea value= "<?= $reason ?>" rows="4" type="text" class="form-control" id="reason" placeholder="Enter your reason" name="reason"></textarea>
                        </div>
                        <div class="form-group mt-5">
                            <input type="file" name="uploadfile" id="file"/>
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