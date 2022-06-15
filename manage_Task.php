<?php
  require_once('db/db.php');
  session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}
  function get_task(){
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM task Where username = '$username' ";
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
    <title>Manage Task</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>
<?php $task = get_task(); ?>
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
					<li class="active"><a href="manage_Task.php">Dashboard</a></li>
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
        <div class="col-md-2">
          <div class="dropdown create">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Options
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="create_task.php">Create Task</a></li>
            </ul>
          </div>
        </div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li class="active">Dashboard</li>
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
                  <h3 class="panel-title">Task</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <div class="row">
                    <?php
                    $i=0;
                    foreach ($task as $t){
                      $tname = $t['tname'];
                      $ename = $t['ename'];
                      $progress = $t['progress'];
                      $idtask = $t['id'];
                      $i++;
                    ?> 
                      <div class="col-lg-4">
                        <div class="card card-margin">
                            <div class="card-header no-border">
                              <h4 class="card-title col-md-10"><?= $tname ?></h4>
                              <button type="delete" class="btn btn-secondary btn-sm col-md-2">X</button>
                            </div>
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <ul class="widget-49-meeting-points">
                                        <li class="widget-49-meeting-item"><span>Done by: <?= $ename ?></span></li>
                                        <li class="widget-49-meeting-item"><span>Progress: <?= $progress ?></span></li>
                                    </ul>
                                    <div class="widget-49-meeting-action">
                                        <a href="H_view_task.php?id='<?=$idtask ?>'" class="btn btn-sm btn-flash-border-primary">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
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