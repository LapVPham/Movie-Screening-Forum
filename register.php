<?php

    // This page hosts our site's registration form for a new user to create an account.
    // User input is validated by javascript before PHP makes an attempt at creating a new
    // record in the User table.

    $errorDisplay = 'style="display:none;"';    // style determining if error message should be displayed
    $errorMessage = '';

    // check if the url contains the parameter signalling that the last registration attempt failed
    // because of a duplicate username
    if (isset($_GET['retry'])) {

        $errorDisplay = 'style="display:block;"';
        $errorMessage = 'This username is already taken. Please choose a different username.';
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title> Register </title>
        <link rel="shortcut icon" href="images/spotlight.ico">
        <link rel="stylesheet" href="css/login_style.css">
        <script src="javascript/validateInput.js"></script>
    </head>

    <body>
        <img src="images/login.png">

        <!-- this is the red box that contains the error message that is only shown when the user's last attempt failed -->
        <p class='invalidLogin' id="registrationError" <?php echo $errorDisplay; ?>><?php echo $errorMessage;?></p>

        <div id="formContainer">
            <h2>Create New Account</h2>

            <!-- registration form -->
            <!-- this form's data will only be sent to register_script.php if validateRegistration() returns true -->
            <form action="php_scripts/register_script.php" method="post" id="loginForm" onsubmit="return validateRegistration();">

                <label for="username">Username:</label><br>
                <input type="text" size="30" id="username" name="username"><br><br>

                <label for="password">Password:</label><br>
                <input type="password" size="30" id="password" name="password"><br><br>

                <label for="confirmPassword">Confirm Password:</label><br>
                <input type="password" size="30" id="confirmPassword" name="confirmPassword"><br><br>

                <input class="loginBtn" type="submit" value="Register"><br><br>

                <a href="login.php">Already have an account?</a>
            </form>
        </div>
    </body>

    <footer>
        <p id="bottomOfPage"> © 2021 MovieSite </p>
    </footer>
</html>
