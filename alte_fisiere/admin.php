<?php

	echo "Admin";
    echo "<br>";
    echo "<a href='index.php'>Logout</a>";
	echo '<br><br>';
	echo '
	<form  action="login.php" method="get"> 
    <label id="first">Nume spectacol </label><br/>
    <input type="text" name="spectacol"><br/>

    <label id="first">Descriere</label><br/>
    <input type="text" name="descriere"><br/>

    <label id="first">Locatie</label><br/>
    <input type="text" name="locatie"><br/>

    <label id="first">Pret</label><br/>
    <input type="number" name="pret" step="0.01"><br/>
  
    <label id="first">Data spectacol</label><br/>
    <input type="datetime" name="data_spectacol"><br/>

    <label id="first">Nr locuri disponibile </label><br/>
    <input type="number" name="nr_locuri"><br/>

    <br>
    <button type="submit" name="save">Adauga spectacol</button>';

    echo '<br><br><br>';

    echo '
    <div class ="adauga_utilizator">
    <form  action="login.php" method="get"> 
    <label id="first">Nume utilizator </label><br/>
    <input type="text" name="utilizator_nou"><br/>

    <label id="first">Parola</label><br/>
    <input type="password" name="parola"><br/>

    <br>
    <button type="submit" name="save">Adauga utilizator</button>

    </div>';
?>
