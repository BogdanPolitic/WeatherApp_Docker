<?php
    echo "
        <div id='upper-bar'>
            <div id='back-button'>
                <form action='dashboard.php' method='GET' style='margin:auto; width:fit-content;'>
                    <input type='submit' Value='Back to dashboard' style='font-size: 200%;'>
                </form>
            </div>
            <div id='title'>
                USER'S MENU
            </div>
        </div>

        <br><br><br>

        <div style='margin:auto; width: fit-content; font-size: 300%; font-weight: 900;'>
            You are currently logged in as 
            <div style='color: red; display: inline-block;'>
                ".$_COOKIE['current_user']."
            </div>
            .
        </div>

        <br><br>

        <div id='user-settings-table'>
            <div id='left-container'>
                <div id='change-default-location'>
                    <div class='form-element'>
                        <form action='user_menu' method='GET'>
                            <label for='change-location'>Choose a location as your new default location:</label>
                            <br><br>
                            <input type='text' name='change-location' size='17'>
                        </form>
                    </div>
                </div>
            </div>

            <div id='right-container'>
                <div id='logout'>
                    <div class='form-element'>
                        <form action='welcome.php' method='POST'>
                            <label style='font-size:75%;'>By logging out, you will be redirected to the Welcome page and you will be able to change your user.</label>
                            <br><br>
                            <input type='submit' Value='Logout' style='font-size:175%; margin-left: 5vh;'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    ";
?>

<!DOCTYPE html>
<html>
	<head>
        <style>
            body {
                width: 100vw;
                background-image: url('imagini/sky-wallpaper.jpg');
                margin: 0;
            }

            #back-button {
                grid-area: back-button;
                padding-top: 80px;
            }

            #title {
                grid-area: title;

                width: fit-content;
                height: fit-content;
                margin: auto;
                font-size: 500%;
                font-weight: 900;
                text-shadow: 1px 1px 1px white,
                            2px 2px 1px white;
            }

            #left-container {
                grid-area: change-default-location;
                border-right: solid #000;
                border-width: 5px;
                border-color: black;
                width: 100%;
                height: 100%;
            }

            #left-container input[type="text"]
            {
                font-size:24px;
            }

            #change-default-location {
                margin-top: 15vh;
            }

            #right-container {
                grid-area: logout;
                border-left: solid #000;
                border-width: 5px;
                border-color: black;
                width: 100%;
                height: 100%;
            }

            #logout {
                //margin-top: 12vh;
                margin: 12vh 4vh;
            }

            #user-settings-table {
                background-color: rgba(255, 255, 255, 0.6);
                margin: auto;
                border-radius: 20px;
                width: 40vw;
                height: 45vh;
                padding: 30px;

                display: grid;
                grid-template-columns: 50% 50%;
                grid-template-rows: auto;
                grid-template-areas:
                    'change-default-location logout';
            }

            #upper-bar {
                margin: 0;
                width: 100vw;
                height: 200px;
                background-color:rgba(0, 0, 255, 0.3);

                display: grid;
                grid-template-columns: 20% 60% 20%;
                grid-template-rows: auto;
                grid-template-areas:
                    'back-button title .';
            }

            .form-element {
                width: fit-content;
                margin: auto;
                font-size: 150%;
                font-weight: 900;
            }
        </style> 

        <title> My weather </title>
        <link rel="icon" 
        type="image/jpg" 
        href="imagini/site-icon.png">
	</head>

</html>