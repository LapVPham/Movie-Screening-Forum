<?php
    // This script is used by forms found on profile.php and movie_details.php
    // to insert or delete a row into/from the historyItem table.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    $userId = $_SESSION['userId'];          // id of the user making the request
    $movieId = $_POST['movieId'];           // id of the movie to insert/delete
    $isInHistory = $_POST['isInHistory'];   // states if this movie is already in this user's history
    $redirectPage = $_POST['goToPage'];     // the page to redirect to once this script finishes

    // check if the movie has already been reviewed by this user
    $getReview = 'SELECT * FROM review WHERE userId = :userId AND movieId = :movieId';
    $statement2 = $db->prepare($getReview);
    $statement2->bindValue(':userId', $userId);
    $statement2->bindValue(':movieId', $movieId);
    $statement2->execute();

    // 1 if there is a review, 0 if there is no review
    $isReviewed = $statement2->rowCount();

    // if this movie is not already in history, insert it
    if ($isInHistory == 0) {

        // get the current date
        date_default_timezone_set('EST');
        $date = date('m/d/Y');

        // insert historyItem record
        $insertHistoryItem = 'INSERT INTO historyItem VALUES (0, :userId, :movieId, :isReviewed, :dateStr)';
        $statement1 = $db->prepare($insertHistoryItem);
        $statement1->bindValue(':userId', $userId);
        $statement1->bindValue(':movieId', $movieId);
        $statement1->bindValue(':isReviewed', $isReviewed);
        $statement1->bindValue(':dateStr', $date);

        $statement1->execute();
    }

    // if this movie is already in the user's history, delete its row
    else if ($isInHistory == 1) {

        $deleteHistoryItem = 'DELETE FROM historyItem WHERE userId = :userId AND movieId = :movieId';
        $statement3 = $db->prepare($deleteHistoryItem);
        $statement3->bindValue(':userId', $userId);
        $statement3->bindValue(':movieId', $movieId);
        $statement3->execute();
    }

    // redirect to the page that executed this file
    header("Location: ../" . $redirectPage);
?>
