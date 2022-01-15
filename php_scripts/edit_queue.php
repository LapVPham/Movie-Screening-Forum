<?php
    // This script is used by forms found on profile.php and movie_details.php to insert or delete a record
    // to/from the queueItem table.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    $userId = $_SESSION['userId'];      // userId of the user making this request
    $movieId = $_POST['movieId'];       // the movie to insert/delete
    $isQueued = $_POST['isQueued'];     // states if this movie is already in this user's queue
    $redirectPage = $_POST['goToPage']; // page to redirect to when this script finishes

    // if this item is not already in the user's queue, insert it
    if ($isQueued == 0) {

        // get the current date
        date_default_timezone_set('EST');
        $date = date('m/d/Y');

        // insert record into queueItem
        $insertQueueItem = 'INSERT INTO queueItem VALUES (0, :userId, :movieId, :dateStr)';
        $statement1 = $db->prepare($insertQueueItem);
        $statement1->bindValue(':userId', $userId);
        $statement1->bindValue(':movieId', $movieId);
        $statement1->bindValue(':dateStr', $date);
        $statement1->execute();
    }

    // if this item is already in the user's queue, delete it
    else if ($isQueued == 1) {

        $deleteQueueItem = 'DELETE FROM queueItem WHERE userId = :userId AND movieId = :movieId';
        $statement2 = $db->prepare($deleteQueueItem);
        $statement2->bindValue(':userId', $userId);
        $statement2->bindValue(':movieId', $movieId);
        $statement2->execute();
    }

    // redirect to the page that executed this file
    header("Location: ../" . $redirectPage);
?>
