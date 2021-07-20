<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();
	session_cache_expire();

	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) { // o voi migra la welcome.php
		setcookie("user", "");
		echo "<br>GET<br>";
	}
?>

<!DOCTYPE html>
<html>
	<head>

	 <style>
	body {
	  background-image: url('imagini/backgr.jpeg');
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size: cover;
	}

	.form-group {
		margin: auto;
		display: flex;
  		justify-content: center;
  		align-content: center;
	}
	</style> 


	<title> Piese de teatru </title>
	<link rel="icon" 
      type="image/png" 
      href="imagini/icon.png">

	</head>

	<body>

		<?php

				if (isset($_SESSION['destroy'])) {
					session_cache_expire();
					session_destroy();
					session_start();
					$_POST = array();
				}

				if (isset($_COOKIE["user"])) {

					$_POST = array();
					$_COOKIE["user"] = "";
					unset($_COOKIE["user"]); 
				}

	
				echo '
					<form action="login.php" method="POST">
					<br> <br> <br> <br> <br>
					<div class="form-group">
                    <label for="email">Utilizator &nbsp</label>
                    <input class="input input-borders" type="text" name="utilizator" placeholder="utilizator" id="password" required>
                    </div>
                    <br>
                    <div class="form-group">
                    <label for="password">Parola &nbsp; &nbsp; &nbsp; &nbsp;</label>
                    <input class="input input-borders" type="password" name="parola" placeholder="parola" id="password" required>
                    </div>
                    <br>
                    <div>
                    <input class="form-group""   type="submit"  Value="Login">
                    </div>
                    <br>
				
                    </form>

                    <div>
                    <a href = "register.php"> <input class="form-group""   type="submit"  Value="Register"> </a>
                    </div>
					';
		?>
	</body>

</html>

<?php
	
	session_destroy();
?>