<?php

    // This script is invoked when the user submits the form on login.php. It checks if the
    // username and password they entered matches a user record in the database to see if their login should be successful.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    // get data entered in the login.php form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the entered username exists in the database
    // BINARY is used to make this query case-sensitive
    $queryUsername = 'SELECT * FROM user WHERE BINARY username = :username';
    $statement1 = $db->prepare($queryUsername);
    $statement1->bindValue(':username', $username);
    $statement1->execute();

    // the entered user name is not in the database
    if ($statement1->rowCount() == 0) {

        // redirect to login page, specifying the retry parameter to signal an error message
        header("Location: ../login.php?retry=true");
    }

    // if the username exists in database...
    else if ($statement1->rowCount() == 1) {

        // get the user's record from database
        $userRow = $statement1->fetch();
        $statement1->closeCursor();

        // check if the password is also correct
        if ($password === $userRow['password']) {    // password comparison is case sensitive

            // login was successful
            // save the user record from database as session variables because this user info will be reused on
            // many pages, so we do not want to have to query the database more times than we need to
            $_SESSION['userId'] = $userRow['userId'];
            $_SESSION['username'] = $userRow['username'];
            $_SESSION['favoriteGenreId'] = $userRow['favoriteGenreId'];
            $_SESSION['favoriteMovieId'] = $userRow['favoriteMovieId'];

            // if the user checked the 'Remember me' box when logging in...
            if (isset($_POST['rememberMe'])) {

                // create cookies to remember user info that can be used to initalize variables of a new session
                setcookie('userIdCookie', $userRow['userId'], strtotime('+1 year'), '/');
                setcookie('usernameCookie', $userRow['username'], strtotime('+1 year'), '/');
                setcookie('favoriteGenreIdCookie', $userRow['favoriteGenreId'], strtotime('+1 year'), '/');
                setcookie('favoriteMovieIdCookie', $userRow['favoriteMovieId'], strtotime('+1 year'), '/');
            }

            // else the user does not want to be remembered
            else {

                // remove the login cookies if they exist for a previous login
                $expire = strtotime('-1 year');
                setcookie('userIdCookie', '', $expire, '/');
                setcookie('usernameCookie', '', $expire, '/');
                setcookie('favoriteGenreIdCookie', '', $expire, '/');
                setcookie('favoriteMovieIdCookie', '', $expire, '/');
            }

            header("Location: ../index.php");   // redirect to landing page
        }

        // else the password for the given username was incorrect
        else {
            // redirect back to login page, specifying the retry parameter get an error message to show up
            header("Location: ../login.php?retry=true");
        }
    }
 ?>
