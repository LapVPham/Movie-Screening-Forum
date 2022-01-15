<?php
    // This script executes when a user hits the Save button on profile.php to save
    // the changes they made to their favorite movie and genre selections, which are stored
    // in their record in the User table of the database.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    $userId = $_SESSION['userId'];      // the id of the logged in user

    // get the new profile details of favorite movie/genre
    $favoriteMovieId = $_POST['favoriteMovieId'];
    $favoriteGenreId = $_POST['favoriteGenreId'];

    // update these values in the user's database record
    $updateUser = 'UPDATE user SET favoriteGenreId = :favoriteGenreId, favoriteMovieId = :favoriteMovieId WHERE userId = :userId';
    $statement1 = $db->prepare($updateUser);
    $statement1->bindValue(':favoriteGenreId', $favoriteGenreId);
    $statement1->bindValue(':favoriteMovieId', $favoriteMovieId);
    $statement1->bindValue(':userId', $userId);
    $statement1->execute();

    // update the session variables so that the new changes are immediately displayed
    $_SESSION['favoriteGenreId'] = $favoriteGenreId;
    $_SESSION['favoriteMovieId'] = $favoriteMovieId;

    // change the cookies too if they are set since they might be used later to create
    // a new session that needs to have these newly updated values
    if (isset($_COOKIE['userIdCookie'])) {

        setcookie('favoriteGenreIdCookie', $favoriteGenreId, strtotime('+1 year'), '/');
        setcookie('favoriteMovieIdCookie', $favoriteMovieId, strtotime('+1 year'), '/');
    }

    header("Location: ../profile.php");
?>
