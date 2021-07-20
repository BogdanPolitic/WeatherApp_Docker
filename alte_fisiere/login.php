<?php
	$_SERVER['destroy'] = true;
	//print_r($_SERVER);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$user=$_POST["utilizator"];
		$pass=$_POST["parola"];
		//echo $_POST["utilizator"];
		$json = file_get_contents('http://server/auth/'.$user.'/'.$pass);
	    $obj = json_decode($json);

	    if (strcmp($obj[0][1], $pass) !== 0) {
   			echo '<i> <h4> Utilizator neinregistrat sau parola gresita<a href="index.php"> autentificare </a> </i> <h4>';
   			exit();
		}else {
			$cookie_name = "user";
			setcookie($cookie_name, $user, time() + (86400 * 30), "/"); // 86400 = 1 day
			header("Refresh:0");
		}

		if (strcmp($user, "admin") === 0) {
			include "admin.php";
	    	exit();
	    }
	}

	if (isset($_COOKIE["user"]) && strcmp($_COOKIE["user"], "admin") === 0) {

		#echo $_COOKIE["user"];

		if (!empty($_GET['spectacol'])) {
			#echo "Adauga spectacol";
			$sql = "INSERT INTO SPECTACOLE (NUME, DESCRIERE, NR_BILETE_DISPONIBILE, PRET_BILET, DATA_SPECTACOL, LOCATIE) VALUES ('".$_GET["spectacol"]."','".$_GET["descriere"]."',".$_GET["nr_locuri"].",".$_GET["pret"].",'".$_GET["data_spectacol"]."','".$_GET["locatie"]."')";

	        #echo $sql;
	        #echo "<br>";
			$sql = str_ireplace(" ", "+", $sql);
			#echo $sql;
			$json = file_get_contents('http://admin/add_spectacle/'.$sql.'/'.$_GET['spectacol']);
		    $obj = json_decode($json);
		    print_r($obj);
		    echo "<br>";
			
		}

		if (!empty($_GET['utilizator_nou'])) {
			#echo "add user";
			#echo $_GET['utilizator_nou'];
			$json = file_get_contents('http://admin/add_user/'.$_GET['utilizator_nou'].'/'.$_GET['parola']);
		    $obj = json_decode($json);
		    print_r($obj);
		    echo "<br>";
		}

		include "admin.php";
		exit();

	}

	if(!empty($_COOKIE["user"])) {
	
		echo "Bine ai venit ". $_COOKIE["user"];
		echo "<br>";
		//echo "<a href='index.php'>Logout</a>";
		echo "
			<form action='index.php' action='GET'>
				<input type='submit' Value='Logout'>
			</form>
		";

		echo '
				<form action="login.php" method="GET">
				<br>
				<div class="form-group">
	            <input class="input input-borders" type="text" name="nume_spectacol" placeholder="Introdu nume spectacol"
	             id="password" required>
	            <input class="form-group""   type="submit"  Value="Cauta spectacol">
	            </div>
	            </form>
			';

		if (isset($_GET['nume_spectacol'])) {

			$nume = $_GET['nume_spectacol'];
			$nume = str_ireplace(" ", "+", $nume);
			$json = file_get_contents('http://server/search/'."$nume");
		    $obj = json_decode($json);


		    echo "<table border='0'>
				<tr>
				<th>Id</th>
				<th>Nume</th>
				<th>Descriere</th>
				<th>Pret bilet</th>
				<th>Locatie</th>
				<th>Data & ora</th>
				<th>Nr locuri disponibile</th>
				</tr>";

	    foreach ($obj as $spectacol) {
	        echo "<tr>";
			echo "<td>" . $spectacol[0] . "</td>";
			echo "<td>" . $spectacol[1] . "</td>";
			echo "<td>" . $spectacol[2] . "</td>";
			echo "<td>" . $spectacol[4] . "</td>";
			echo "<td>" . $spectacol[6] . "</td>";
			echo "<td>" . $spectacol[5] . "</td>";
			echo "<td>" . $spectacol[3] . "</td>";
			echo "</tr>";
		}

		echo "</table>";
		}

		echo '
					<form action="login.php" method="GET">
					<br>
					<div class="form-group">
	                <input class="input input-borders" type="text" name="id_spectacol" placeholder="Introdu id spectacol"
	                 id="password" required>
	                </div>
	                <div class="form-group">
	                <input class="input input-borders" type="number" name="nr_bilete" min="1" max="5" placeholder="Introdu nr bilete"
	                 id="password" required>
	                </div>
	                <div>
	                <input class="form-group""   type="submit"  Value="Rezerva bilete">
	                </div>
	                </form>
					';

		if (isset($_GET['id_spectacol']) && isset($_GET['nr_bilete'])) {

			$id = $_GET['id_spectacol'];
			$nr = $_GET['nr_bilete'];
			$json = file_get_contents('http://server/buy/'.$id.'/'.$nr);
	   		$obj = json_decode($json);
	   		print_r($obj);
	   		echo "<br><br>";
		}

		echo "<div class=\"lista_spectacole\"><i><u>Lista spectacole de teatru</u></i></div> <br>";

		$json = file_get_contents('http://server/get/lista_spectacole');
	    $obj = json_decode($json);

	    // print_r($obj);
	    echo "<table border='1'>
				<tr>
				<th>Id</th>
				<th>Nume</th>
				<th>Descriere</th>
				<th>Pret bilet</th>
				<th>Locatie</th>
				<th>Data & ora</th>
				<th>Nr locuri disponibile</th>
				</tr>";

	    foreach ($obj as $spectacol) {
	        echo "<tr>";
			echo "<td>" . $spectacol[0] . "</td>";
			echo "<td>" . $spectacol[1] . "</td>";
			echo "<td>" . $spectacol[2] . "</td>";
			echo "<td>" . $spectacol[4] . "</td>";
			echo "<td>" . $spectacol[6] . "</td>";
			echo "<td>" . $spectacol[5] . "</td>";
			echo "<td>" . $spectacol[3] . "</td>";
			echo "</tr>";
		}

		echo "</table>";
	}

?>


<!DOCTYPE html>
<html>
	<head>

	 <style>
	body {
	  background-image: url('imagini/teatre-online.jpg');
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-size: cover;
	  color: white;
	}

	table {
		color: white;
		font-family: Arial, Helvetica, sans-serif;
		margin: auto;
  		width: 85%;
  		padding: 10px;
	}

	th, td {
		background-color: red;
	}

	div.lista_spectacole {
		text-align: center;
		font-size: 25px;
		color: white;
		font-weight: bold;
		background-color: blue;

	}

	div.adauga_utilizator {
		align-self: right;
	}

	</style> 


	<title> Piese de teatru </title>
	<link rel="icon" 
      type="image/png" 
      href="imagini/icon.png">

	</head>

</html>