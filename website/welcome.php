<?php
    //header("Location: ./dashboard.php");
    $user = "guest";
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
    }

    $div_welcome_user = "
        <div class='welcome_user'>
            <h2>Welcome, ".$user."!</h2>
        </div>
    ";

    echo "
        <div id='title'>
            <h1>THE WEATHER APP</h1>
            ".$div_welcome_user."
        </div>
    ";

    echo "
        <div id='registration'>
            <div id='login'>
                <div class='form-element'>
                    <div style='width: fit-content; margin: auto; font-size: 150%;'>
                        Login
                    </div>

                    <br><br>

                    <form action='dashboard.php' method='POST'>
                        <label for='username-login'>Username:</label>
                        <br>
                        <input type='text' name='username-login'>

                        <br><br>

                        <label for='password-login'>Password:</label>
                        <br>
                        <input type='password' name='password-login'>
                        <br><br>
                        <input type='submit' Value='Login' style='margin-left: 3vw;'>
                    </form>
                </div>
            </div>
            <div id='register'>
                <div class='form-element'>
                    <div style='width: fit-content; margin: auto; font-size: 150%;'>
                        Register
                    </div>

                    <br>

                    <form action='dashboard.php' method='POST'>
                        <label for='username-register'>Username:</label>
                        <br>
                        <input type='text' name='username-register'>

                        <br><br>

                        <label for='password-register'>Password:</label>
                        <br>
                        <input type='password' name='password-register'>

                        <br><br>

                        <label for='confirm-password-register'>Confirm password:</label>
                        <br>
                        <input type='password' name='confirm-password-register'>
                        <br><br>
                        <input type='submit' Value='Register' style='margin-left: 3vw;'>
                    </form>
                </div>
            </div>
        </div>
    ";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // event-ul pt care s-a apasat logout din user_menu !
        $_COOKIE["current_user"] = "";
		unset($_COOKIE["current_user"]);
    }
?>

<!DOCTYPE html>
<html>
	<head>
        <style>
            body {
                width: 100vw;
                background-image: url('imagini/sky-wallpaper.jpg')
            }

            #title {
                width: 53vw;
                padding: 20px;
                margin: auto;
                font-family: "Times New Roman", Times, serif;
                font-size: 250%;
                text-shadow: 1px 1px 1px white,
                            2px 2px 1px white;
            }

            .welcome_user {
                margin: auto;
                width: fit-content;
                font-size: 75%;
                text-shadow: none;
            }

            #login {
                grid-area: login;
                border-right: solid #000;
                border-width: 5px;
                border-color: black;
            }

            #register {
                grid-area: register;
                border-left: solid #000;
                border-width: 5px;
                border-color: black;
            }

            #registration {
                background-color: white;
                margin: auto;
                border-radius: 20px;
                width: 40vw;
                height: 45vh;
                padding: 30px;

                display: grid;
                grid-template-columns: auto auto;
                grid-template-rows: auto;
                grid-template-areas:
                    'login register';
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