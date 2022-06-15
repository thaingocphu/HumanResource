<?php
    require_once('db/account_db.php');
	
    $error = '';
    $username = '';
    $password = '';

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $error = 'Please enter your username';
        }
        else if (empty($password)) {
            $error = 'Please enter your password';
        }
        else if(login($username, $password)){
            $_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			if($_SESSION['username'] == $_SESSION['password'] ){
				header('Location: fchange_password.php');	
				exit();
			}
			else if($_SESSION['permisson'] == 2){
				header('Location: index.php');
				exit();
			}
			else if($_SESSION['permisson'] == 1){
				header('Location: manage_Task.php');
				exit();
			}
			elseif ($_SESSION['permisson'] == 0){
				header('Location: manage_myTask.php');
				exit();
			}
            exit();
        }
        else{   
            $error = 'Invalid username or password';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>

<title>Đăng nhập</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/login_style.css" type="text/css" media="all">
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
</head>

<body>

	<h1>INTERNAL WEBSITE</h1>

	<div class="w3layoutscontaineragileits">
	<h2>Login here</h2>
		<form method="POST">
			<input value="<?= $username ?>" type="text" name="username" placeholder="USERNAME" id="username">
			<input value="<?= $password ?>" type="password" name="password" placeholder="PASSWORD" id="password">
			<ul class="agileinfotickwthree">
				<li>
					<input type="checkbox" id="brand1" value="">
					<label for="brand1"><span></span>Remember me</label>
				</li>
			</ul>
			<div class="aitssendbuttonw3ls">
				<?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-dnager'>$error</div>";
                    }
                ?>
				<!-- <input type="submit" value="LOGIN"> -->
				<button class="btnLogin" Type="submit" name="submit">LOGIN</button>				
			</div>
		</form>
	</div>
	
	

	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
	</script>

</body>
</html>