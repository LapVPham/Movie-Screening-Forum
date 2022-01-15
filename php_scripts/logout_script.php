<?php
    // This script executes when the user hits the Log Out button in the top right corner of the navigation bar.
    // It destroys the user's session variables and cookies so that they will have to go through the login process again
    // to access the site's pages that require them to be logged in.

    session_start();

    // remove the login cookies because the user is logging out
    $expire = strtotime('-1 year');
    setcookie('userIdCookie', '', $expire, '/');
    setcookie('usernameCookie', '', $expire, '/');
    setcookie('favoriteGenreIdCookie', '', $expire, '/');
    setcookie('favoriteMovieIdCookie', '', $expire, '/');

    $_SESSION = array();    // clear session data
    session_destroy();      // clean up the session id
    header("Location: ../login.php");
 ?>
