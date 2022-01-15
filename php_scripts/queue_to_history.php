<?php
    // This script executes when the user hits the 'Mark as watched' button for a movie
    // in their queue on the profile.php page. This script deletes that movie's record from
    // the queueItem table and inserts a record for that movie in the historyItem table.
    // In other words, it moves a movie from the user's queue to their watch history.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    $userId = $_SESSION['userId'];  // the id of the user making this request
    $movieId = $_POST['movieId'];   // the movie that will be removed from the user's queue and moved to their watch history

    // remove movie from the user's queue
    $deleteQueueItem = 'DELETE FROM queueItem WHERE userId = :userId AND movieId = :movieId';
    $statement1 = $db->prepare($deleteQueueItem);
    $statement1->bindValue(':userId', $userId);
    $statement1->bindValue(':movieId', $movieId);
    $statement1->execute();

    // check if the movie has already been reviewed by this user
    $getReview = 'SELECT * FROM review WHERE userId = :userId AND movieId = :movieId';
    $statement2 = $db->prepare($getReview);
    $statement2->bindValue(':userId', $userId);
    $statement2->bindValue(':movieId', $movieId);
    $statement2->execute();

    // 1 if there is a review, 0 if there is no review
    $isReviewed = $statement2->rowCount();

    // attempt to delete the same movie from the user's history to ensure that the movie will not be duplicated in their history
    // this statement only deletes anything if this movie is already in the user's watch history
    $deleteHistoryItem = 'DELETE FROM historyItem WHERE userId = :userId AND movieId = :movieId';
    $statement4 = $db->prepare($deleteHistoryItem);
    $statement4->bindValue(':userId', $userId);
    $statement4->bindValue('movieId', $movieId);
    $statement4->execute();

    // add movie to history
    $insertHistoryItem = 'INSERT INTO historyItem VALUES (0, :userId, :movieId, :isReviewed, :dateStr)';
    $statement3 = $db->prepare($insertHistoryItem);
    $statement3->bindValue(':userId', $userId);
    $statement3->bindValue(':movieId', $movieId);
    $statement3->bindValue(':isReviewed', $isReviewed);
    date_default_timezone_set('EST');
    $date = date('m/d/Y');  // get the current date
    $statement3->bindValue(':dateStr', $date);
    $statement3->execute();

    header("Location: ../profile.php");
?>
