<?php
    // This script inserts a new user in the User table of the database using information
    // entered from the form on the registration.php page.
    // The entered username and password would have already been validated by our javascript function
    // by this point. Since usernames have to be unique, we must also check that the entered
    // username for a new account does not already exist in the database.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    // get the matching username from the database, if it exists
    $queryUsername = 'SELECT * FROM user WHERE username = :username';
    $statement1 = $db->prepare($queryUsername);
    $statement1->bindValue(':username', $_POST['username']);
    $statement1->execute();

    // if the username is already taken by another user...
    if ($statement1->rowCount() == 1) {

        // redirect to the registration page with a parameter in the url signalling the error
        header("Location: ../register.php?retry=true");
    }

    // otherwise the entered username is unique and registration will be successful
    else {

        // add the user to the database
        $addUser = 'INSERT INTO user VALUES (0, :username, :password, 8, 0)';   // 8 = favoriteGenre (None), 0 = favoriteMovie (None)
        $statement2 = $db->prepare($addUser);
        $statement2->bindValue(':username', $_POST['username']);
        $statement2->bindValue(':password', $_POST['password']);
        $statement2->execute();

        // retrieve this new user's information to get their auto-incremented userId
        $queryUser = 'SELECT * FROM user WHERE username = :username';
        $statement3 = $db->prepare($queryUser);
        $statement3->bindValue(':username', $_POST['username']);
        $statement3->execute();
        $userRow = $statement3->fetch();
        $statement3->closeCursor();

        // initialize a new session for the newly created user
        $_SESSION['userId'] = $userRow['userId'];
        $_SESSION['username'] = $userRow['username'];
        $_SESSION['favoriteGenreId'] = $userRow['favorieGenreId'];
        $_SESSION['favoriteMovieId'] = $userRow['favoriteMovieId'];

        // clear cookies in case they exist for a previous logged-in user
        $expire = strtotime('-1 year');
        setcookie('userIdCookie', '', $expire, '/');
        setcookie('usernameCookie', '', $expire, '/');
        setcookie('favoriteGenreIdCookie', '', $expire, '/');
        setcookie('favoriteMovieIdCookie', '', $expire, '/');

        // redirect new user to the landing page
        header("Location: ../index.php");
    }
 ?>
