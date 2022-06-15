<?php
require_once ('db/db.php');
	session_start();

	if(!isset($_SESSION["username"])){
		header('location: login.php');
	}

  $username = $_SESSION["username"];
  $id = '';
  $fname = '';
  $department = '';
  $position ='';
  $imagedefault = "./images/avatar.jpg";

  if (isset($_POST['submit'])) {
    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        $sql = "UPDATE account SET images='$target_file' WHERE username = '$username' ";
        if(mysqli_query($conn, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
    }
  }


  $sql = "SELECT * FROM account, department WHERE username = '$username' and account.id_department = department.id_department";
  $result = $conn->query($sql);
  
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      //var_dump($row);
      $id = $row['id_user'];
      $fname = $row['fname'];
      $department =  $row['name'];
      $position = $row['position'];

      if (!empty($row["images"])){
        $imagedefault = $row["images"];
      }
    }

  //var_dump($imagedefault);

  $conn->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information User</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>

    <style>
      #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
    </style>
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
					<li class="active"><a href="inf_user.php">Personal Information</a></li>
					<li><a href="leave_history.php">Leaves History</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
        <li><a href="#">Hello, <?= $username ?></a></li>
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
              <li><a href="change_password.php">Change Password</a></li>
            </ul>
          </div>
        </div>
			</div>
		</div>
	</header>

	<section id="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
        <li><a href="manage_myTask.php">Dashboard</a></li>
        <li class="active">Personal Information</li>
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
                  <h3 class="panel-title">Personal Information</h3>
                </div>
                <div class="panel-body">
                    <div class="container emp-profile col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                 <!--avatar-->
                                <div class="profile-img">
                                    <img src="<?= $imagedefault ?>" alt="" id="profileDisplay" onClick="triggerClick()" />
                                    <div class="file btn  btn-primary">
                                        
                                          <form action="inf_user.php" enctype="multipart/form-data" method="POST">
                                          <input type="file" name="profileImage" id="profileImage"  onChange="displayImage(this)"    />
                                          <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit">Change Photo</button>
                                          </form>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-8">     
                                <table class="table">
                                    <h3 class="text-center text-primary">Personal Profile</h3>
                                    <tr>
                                      <th>ID:</th>
                                      <td><?= $id ?></td>
                                    </tr>
                                    <tr>
                                        <th>User name:</th>
                                        <td><?= $username ?></td>
                                      </tr>
                                    <tr>
                                      <th>Full Name:</th>
                                      <td><?=  $fname   ?></td>
                                    </tr>
                                    <tr>
                                      <th>Department:</th>
                                      <td><?= $department ?></td>
                                    </tr>
                                    <tr>
                                      <th>Position:</th>:</th>
                                      <td><?= $position ?></td>
                                    </tr>  
                                  </table>
                            </div>
                        </div>
                    </div>
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

    <script>

      function triggerClick(e) {
        document.querySelector('#profileImage').click();
      }

      function displayImage(e) {
        if (e.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e){
            document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
          }
          reader.readAsDataURL(e.files[0]);
        }
      }

    </script>
</body>
</html>