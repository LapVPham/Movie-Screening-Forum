<?php
    // This page contains our login form. The username and password that the user enters
    // is validated by a javascript function, and if there are no problems with the input,
    // then php_scripts/login_script.php checks if the username and password matches a user record in
    // the database to determine if the login is successful.

    session_start();

    $errorDisplay = 'style="display:none;"';    // style determining if error message should be displayed or hidden
    $errorMessage = '';

    // check if the user previously had a failed incorrect login attempt via the retry parameter passed in the url
    if (isset($_GET['retry'])) {

        // if so, show error message
        $errorDisplay = 'style="display:block;"';
        $errorMessage = 'Invalid login credentials. Check your information and try again.';
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title> Login </title>
        <link rel="shortcut icon" href="images/spotlight.ico">
        <link rel="stylesheet" href="css/login_style.css">
        <script src="javascript/validateInput.js"></script>
    </head>

    <body>

        <img src="images/login.png">

        <!-- this <p> is only shown if user made an incorrect login attempt -->
        <p class="invalidLogin" id="errorBox" <?php echo $errorDisplay;?>><?php echo $errorMessage?></p>

        <div id="formContainer">
            <h2>Log In</h2>

            <!-- Login form -->
            <!-- This form's data is only sent to login_script.php if the function validateLogin() returns true -->
            <form action="php_scripts/login_script.php" method="post" id="loginForm" onsubmit="return validateLogin();">

                <label for="username">Username:</label><br>
                <input type="text" size="30" id="username" name="username">
                <br><br>

                <label for="password">Password:</label><br>
                <input type="password" size="30" id="password" name="password">
                <br><br>

                <input type="checkbox" id="rememberMe" name="rememberMe" value="true">
                <label for="rememberMe">Remember me</label><br><br>
                <input class="loginBtn" type="submit" value="Log In"><br><br>

                <a href="register.php">Don't have an account?</a>
            </form>
        </div>
    </body>

    <footer>
        <p id="bottomOfPage"> © 2021 MovieSite </p>
    </footer>
</html>
