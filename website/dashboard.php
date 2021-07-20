<?php
    $my_location_id = 0;
    $my_location_string = 'Bucuresti';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["username-login"] != "" && $_POST["password-login"] != "") {
            $username = $_POST["username-login"];
            $password = $_POST["password-login"];

            //$_COOKIE['current_user'] = $username;
            setcookie('current_user', $username);

            $response = file_get_contents('http://server/login_user/'.$username.'/'.$password);

            if ($response < 0) {
                echo "Login failed: Incorrect username or password!";
                exit();
            }

            $my_location_id = (int) $response;
        }

        else if ($_POST["username-register"] != "" && $_POST["password-register"] != "" && $_POST["confirm-password-register"] != "") {
            if ($_POST["password-register"] != $_POST["confirm-password-register"]) {
                echo "Passwords don't match!";
                exit();
            }

            $username = $_POST["username-register"];
            $password = $_POST["password-register"];

            $response = file_get_contents('http://server/register_user/'.$username.'/'.$password);

            if ($response != 0) {
                echo "Registration failed: This username is already taken!";
                exit();
            }
        }
    }

    echo "
        <div id='upper-bar'>
            <div id='choose-location'>
                <form action='dashboard.php' method='GET' style='margin:auto;width:fit-content;'>
                    <label for='your-location' style='font-size: 225%; font-weight: 900; margin-left: 1vw;'>Type your location:</label>
                    <br>
                    <input type='text' name='your-location' style='width:fit-content; margin:auto; font-size: 150%;'>
                    <input type='submit' Value='OK' style='font-size: 150%;'>
                </form>
            </div>

            <div id='title'>
                WEATHER
            </div>

            <div id='user-menu'>
                <form action='user_menu.php' method='GET' style='margin:auto;width:fit-content;'>
                    <input type='submit' Value='User settings' style='font-size:200%;'>
                </form>
            </div>
        </div>

        <div id='navbar'>
            <div class='tab-class' id='weather-history-tab-container' onmouseover='weatherHistoryHover()' onclick='showTab(0)'>
                <div class='tab-text'>
                    WEATHER HISTORY
                </div>
            </div>
            <div class='tab-class' id='weather-now-tab-container' onclick='showTab(1)'>
                <div class='tab-text'>
                    WEATHER NOW
                </div>
            </div>
            <div class='tab-class' id='weather-future-tab-container' onclick='showTab(2)'>
                <div class='tab-text'>
                    WEATHER PREDICTION
                </div>
            </div>
        </div>

        <br>

        <div id='select-year-month'>
            <div style='font-weight: 900; font-size: 150%;'>
                SELECT YEAR AND MONTH:
            </div>
            <br>
            <form action='dashboard.php' method='GET' style='width: 20vw; margin-left: 4vw;'>
                <label for='select-year'>Year:</label>
                <input type='text' name='select-year' placeholder='YYYY'>
                <br>
                <label for='select-month'>Month:</label>
                <input type='text' name='select-month' placeholder='MM' size='18'>
                <br>
                <br>
                <input type='submit' Value='Go' style='width: fit-content; margin-left: 5vw; font-size: 200%;'>
            </form>
        </div>

        <br>
    ";

    $month_map = array('_', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $month = 5;
    $year = 2020;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['select-year']) && isset($_GET['select-month'])) {
            $year = $_GET['select-year'];
            $month = $_GET['select-month'];
        }

        if (isset($_GET['your-location'])) {
            $my_location_string = $_GET['your-location'];
            $my_location_id = file_get_contents('http://server/update_user_location/'.$_COOKIE['current_user'].'/'.$my_location_string);
            if ($my_location_id == -1) {
                echo "Error: The location you've entered does not exist in our database!";
            }
            $my_location_id = (int) $my_location_id;
        }
    }

    $json = file_get_contents('http://server/show_weather_history/'.$my_location_id.'/'.$month.'/'.$year);
    $obj = json_decode($json);

    $table_body = "
        <div style='width: fit-content; margin: auto; font-size: 200%; font-weight: 900;'>
            Showing weather history from ".$month_map[$month]." ".$year." in ".$my_location_string.":
        </div>
        <br>
    ";

    $table_body = $table_body. "
        <table border='0'>
        <tr>
            <th>Day</th>
            <th>Month</th>
            <th>Year</th>
            <th>High</th>
            <th>Low</th>
            <th>Average</th>
            <th>Humidity</th>
            <th>Pressure</th>
            <th>Condition</th>
        </tr>
    ";
        
    foreach ($obj as $parameter) {
        $id = (int) $parameter[8];
        $json = file_get_contents('http://server/get_weather_condition/'.$id);
        $obj = json_decode($json);
        $current_condition = [];
        foreach ($obj as $o) {
            $current_condition[0] = $o[1];
            $current_condition[1] = $o[2];
        }

        $condition_container = "
            <div id='condition_container' style='width: 125px; height: 125px;'>
                <image src='".$current_condition[1]."' style='max-width: 100%; max-height: 70%; margin-left: 25px;'>
                <div style='margin-left: 25px;'>
                    ".$current_condition[0]."
                </div>
            </div>
        ";

        $table_body = $table_body. "<tr>";
        $table_body = $table_body. "<td>" . $parameter[1] . "</td>";
        $table_body = $table_body. "<td>" . $parameter[2] . "</td>";
        $table_body = $table_body. "<td>" . $parameter[3] . "</td>";
        $table_body = $table_body. "<td>" . $parameter[4] . "</td>";
        $table_body = $table_body. "<td>" . $parameter[5] . "</td>";
        $table_body = $table_body. "<td>" . (($parameter[4] + $parameter[5]) / 2) . "</td>";
        $table_body = $table_body. "<td>" . $parameter[6] . "</td>";
        $table_body = $table_body. "<td>" . $parameter[7] . "</td>";
        $table_body = $table_body. "<td>" . $condition_container . "</td>";
        $table_body = $table_body. "</tr>";
    }

    if (isset($table_body)) {
        echo "
            <div id='content'>
                <div id='weather-history-content'>
                    ".$table_body."
                </div>

                <div id='weather-now-content'>
                    WEATHER NOWWWWW
                </div>

                <div id='weather-prediction-content'>
                    WEATHER PREDICTIONNNN
                </div>
            </div>
        ";
    }
?>

<!DOCTYPE html>
<html>
	<head>
        <style>
            body {
                width: 100vw;
                background-image: url('imagini/sky-wallpaper.jpg');
                background-repeat: repeat-y;
                margin: 0 0 40px 0;
            }

            table {
                color: black;
                font-family: Arial, Helvetica, sans-serif;
                margin: auto;
                width: 60vw;
                padding: 0px;
                border: solid rgba(200, 200, 255, 1);
                border-width: 20px;
                border-radius: 15px;
            }

            th {
                background-color: rgba(175, 175, 255, 1);
                border: solid #000;
            }

            td {
                background-color: rgba(225, 225, 255, 1);
                height: 125px;
            }

            #choose-location {
                grid-area: choose-location;
                padding-top: 60px;
            }

            #title {
                grid-area: title;

                font-size: 500%;
                text-shadow: 1px 1px 1px white,
                            2px 2px 1px white;
                margin: auto;
                width: fit-content;
                height: fit-content;
                font-weight: 900;
            }

            #user-menu {
                grid-area: user-menu;
                padding-top: 80px;
            }

            #upper-bar {
                margin: 0;
                width: 100vw;
                height: 200px;
                background-color:rgba(0, 0, 255, 0.3);

                display: grid;
                grid-template-columns: 25% 50% 25%;
                grid-template-rows: auto;
                grid-template-areas:
                    'choose-location title user-menu';
            }

            .tab-class {
                width: 100%;
                height: 100%;
                border-width: 5px;
            }
            .tab-class:hover {
                background-color: rgba(0, 255, 0, 0.8);
            }

            .tab-text {
                width: fit-content;
                margin: 38px auto 0 auto;
                font-size: 225%;
                color: white;
                text-shadow: 1px 1px 1px black,
                            2px 2px 1px black;
            }

            #weather-history-tab-container {
                grid-area: weather-history-tab;
                border-right: solid #000;
            }

            #weather-now-tab-container {
                grid-area: weather-now-tab;
                border-left: solid #000;
            }

            #weather-future-tab-container {
                grid-area: weather-future-tab;
                border-left: solid #000;
            }

            #navbar {
                margin: 0;
                width: 100vw;
                height: 125px;
                background-color:rgba(0, 0, 255, 0.8);

                display: grid;
                grid-template-columns: auto auto auto;
                grid-template-rows: auto;
                grid-template-areas:
                    'weather-history-tab weather-now-tab weather-future-tab';
            }

            #weather-history-content {
                display: block;
            }

            #weather-now-content {
                display: none;
            }

            #weather-prediction-content {
                display: none;
            }

            #select-year-month {
                display: none;
                width: fit-content;
                margin: auto;
            }

            #content {
                background-color: rgba(255, 255, 255, 0.6);
                width: fit-content;
                height: fit-content;
                margin: auto;
                border-radius: 15px;
                padding: 25px;
            }
        </style> 

        <script type="text/javascript">
            function weatherHistoryHover(){
                //document.getElementById('weather-history-tab-container').style.backgroundColor = 'rgba(255, 0, 0, 0.8)';
            }
            function showTab(tab) {
                document.getElementById('weather-history-content').style.display = (tab == 0 ? 'block' : 'none');
                document.getElementById('select-year-month').style.display = (tab == 0 ? 'block' : 'none');

                document.getElementById('weather-now-content').style.display = (tab == 1 ? 'block' : 'none');

                document.getElementById('weather-prediction-content').style.display = (tab == 2 ? 'block' : 'none');
            }
        </script>

        <title> My weather </title>
        <link rel="icon" 
        type="image/jpg" 
        href="imagini/site-icon.png">
	</head>

</html>