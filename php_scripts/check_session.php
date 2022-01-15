<?php
    // Since session variables are set when a user successfully logs in, this
    // function checks if a user is logged in or not by checking if the sesion variables are set.
    // If cookies exist, then cookies may be used to initialize a new session so that the user
    // stays logged in.
    function isLoggedIn() {

        // check if the user is logged in by checking if the username session variable is set
        if (isset($_SESSION['username'])) {
            return true;
        }

        // if the user is not logged in, they can bypass the login if the 'Remember me' cookies
        // that remember their user information are set
        if (isset($_COOKIE['userIdCookie'])) {

            // initalize the session variables since the user is starting a new session
            $_SESSION['userId'] = $_COOKIE['userIdCookie'];
            $_SESSION['username'] = $_COOKIE['usernameCookie'];
            $_SESSION['favoriteGenreId'] = $_COOKIE['favoriteGenreIdCookie'];
            $_SESSION['favoriteMovieId'] = $_COOKIE['favoriteMovieIdCookie'];

            return true;
        }

        //  return false if the user is not logged in and there are no cookies that remember their login info
        return false;
    }
?>
