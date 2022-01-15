<?php
    // This script executes when a user completes the form on movie_details.php
    // to post, update, or delete a movie review to/from the review table.

    session_start();

    // database connection is performed in another file
    require_once('connectDB.php');

    $userId = $_SESSION['userId'];          // id of the user making/deleting the review
    $movieId = $_POST['movieId'];           // id of the movie the review is about
    $reviewScore = $_POST['reviewScore'];   // the score given in the review
    $reviewText = $_POST['reviewText'];     // the comment entered in the form's textarea

    // get timestamp after setting timezone
    date_default_timezone_set('EST');
    $dateTime = date('h:ia') . ' on ' . date('m/d/Y');

    $updateOrPost = $_POST['updateOrPost']; // determines if the user is updating a review or posting a new one

    // if the user hit the delete review button...
    if (isset($_POST['deleteBtn'])) {

        // delete the review
        $deleteReview = 'DELETE FROM review WHERE userId = :userId AND movieId = :movieId';
        $statement5 = $db->prepare($deleteReview);
        $statement5->bindValue(':userId', $userId);
        $statement5->bindValue(':movieId', $movieId);
        $statement5->execute();

        // if this movie is in the user's history, update the historyItem's isReviewed status
        $updateHistory = 'UPDATE historyItem SET isReviewed = 0 WHERE userId = :userId AND movieId = :movieId';
        $statement6 = $db->prepare($updateHistory);
        $statement6->bindValue(':userId', $userId);
        $statement6->bindValue(':movieId', $movieId);
        $statement6->execute();
    }

    // else if the user made a new review...
    else if ($updateOrPost == 'post') {

        // insert the review
        $insertReview = 'INSERT INTO review VALUES (0, :userId, :movieId, :score, :comment, :tStamp)';
        $statement1 = $db->prepare($insertReview);
        $statement1->bindValue(':userId', $userId);
        $statement1->bindValue(':movieId', $movieId);
        $statement1->bindValue(':score', $reviewScore);
        $statement1->bindValue(':comment', $reviewText);
        $statement1->bindValue(':tStamp', $dateTime);
        $statement1->execute();

        // if this movie is in the user's history, update the historyItem's isReviewed status
        $updateHistory = 'UPDATE historyItem SET isReviewed = 1 WHERE userId = :userId AND movieId = :movieId';
        $statement5 = $db->prepare($updateHistory);
        $statement5->bindValue(':userId', $userId);
        $statement5->bindValue(':movieId', $movieId);
        $statement5->execute();
    }

    // otherwise if the user edited a previous review...
    else if ($updateOrPost == 'update') {

        // update the review with a new timestamp and the new data from the form
        $updateReview = 'UPDATE review SET score = :score, comment = :comment, `timeStamp` = :tStamp WHERE movieId = :movieId AND userId = :userId';
        $statement3 = $db->prepare($updateReview);
        $statement3->bindValue(':score', $reviewScore);
        $statement3->bindValue(':comment', $reviewText);
        $statement3->bindValue(':tStamp', $dateTime);
        $statement3->bindValue(':movieId', $movieId);
        $statement3->bindValue(':userId', $userId);
        $statement3->execute();
    }

    // get the average score from all individual reviews of this movie
    $getAvgScore = 'SELECT AVG(score) AS avgScore FROM review WHERE movieId = :movieId';
    $statement2 = $db->prepare($getAvgScore);
    $statement2->bindValue(':movieId', $movieId);
    $statement2->execute();
    $avgScoreRow = $statement2->fetch();
    $statement2->closeCursor();
    $avgScore = $avgScoreRow['avgScore'];

    // if there are not any reviews for this movie, set its average score to -1 as a placeholder
    if ($avgScore == null) {
        $avgScore = -1.0;
    }

    // convert avgScore to string because you cannot pass floats via a PDO
    $avgScoreStr = strval($avgScore);

    // update the movie's average score
    $updateScore = 'UPDATE movie SET averageScore = :avgScore WHERE movieId = :movieId';
    $statement4 = $db->prepare($updateScore);
    $statement4->bindValue(':avgScore', $avgScoreStr);
    $statement4->bindValue(':movieId', $movieId);
    $statement4->execute();

    // redirect back to the movie_details.php page showing the movie that this review was for
    header("Location: ../movie_details.php?movie_id=" . $movieId);
?>
