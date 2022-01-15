<?php
    // This page shows the details and reviews of the movie whose movieId is appended to the end of the url,
    // like movie_details.php?movie_id=15
    // Users can use this page to write a review for the movie and add the movie to their queue or watch history.
    // Each review also includes a link to the profile of the username that wrote it.

    session_start();
    require 'php_scripts/check_session.php';

    // use the function in php_scripts/check_session.php to check if a user is logged in
    if (!isLoggedIn()) {

        // if they are not logged in, redirect back to the login page
        header("Location: login.php");
    }

    // database connection is performed in another file
    require_once('php_scripts/connectDB.php');

    // if the internal variable $movieId is not already set...
    if (!isset($movieId)) {

        // get the movieId from the url, if it exists
        $movieId = filter_input(INPUT_GET, 'movie_id', FILTER_VALIDATE_INT);

        // if no movieId was specified in url
        if ($movieId == null || $movieId == FALSE) {
            $movieId = 1;   // show details for movie with movieId = 1
        }

        // else if movieId is out of the range of available movies
        else if ($movieId < 0 || $movieId > 70) {
            $movieId = 1;  // show details for movie with movieId = 1
        }
    }

    // query the movie details corresponding to the selected movieId
    // "name" in this query refers the the name of the genre
    $queryMovie = 'SELECT movieId, title, averageScore, posterFile, movie.genreId,
                    synopsis, `year`, maturityRating, genre.name FROM movie
                    INNER JOIN genre on movie.genreId = genre.genreId WHERE movieId = :movieId';
    $statement1 = $db->prepare($queryMovie);
    $statement1->bindValue(':movieId', $movieId);
    $statement1->execute();
    $movie = $statement1->fetch();
    $statement1->closeCursor();

    // get the averageScore of the movie
    $averageScore = $movie['averageScore'];

    // if this movie has not been reviewed yet, use '-' as a placeholder score
    if ($averageScore == -1) {
        $averageScore = '-- ';
    }

    // get the reviews for this movie
    $getReviews = 'SELECT * FROM review WHERE movieId = :movieId ORDER BY reviewId DESC';
    $statement2 = $db->prepare($getReviews);
    $statement2->bindValue(':movieId', $movieId);
    $statement2->execute();
    $numOfReviews = $statement2->rowCount();
    $reviews = $statement2->fetchAll();
    $statement2->closeCursor();

    // determine if this user has already left a review for this movie
    $getMyReview = 'SELECT * FROM review WHERE movieId = :movieId AND userId = :userId';
    $statement4 = $db->prepare($getMyReview);
    $statement4->bindValue(':movieId', $movieId);
    $statement4->bindValue(':userId', $_SESSION['userId']);
    $statement4->execute();

    // these variables keep track of if the user is creating a new review or
    // editing a previous review in the writeReviewDiv
    $alreadyReviewed = false;
    $myComment = '';
    $myScore = -1;
    $updateOrPost = 'post';
    $updateOrPostBtnTxt = 'Post Review';

    // if this user has left a review...
    if ($statement4->rowCount() == 1) {
        $alreadyReviewed = true;
        $myReview = $statement4->fetch();
        $statement4->closeCursor();

        // show them their review and offer them a way to update it
        $myComment = $myReview['comment'];
        $myScore = $myReview['score'];
        $updateOrPost = 'update';
        $updateOrPostBtnTxt = 'Update Review';
    }

    // check if this movie is in the user's queue
    $checkIfQueued = 'SELECT * FROM queueItem WHERE userId = :userId AND movieId = :movieId';
    $statement5 = $db->prepare($checkIfQueued);
    $statement5->bindValue(':userId', $_SESSION['userId']);
    $statement5->bindValue(':movieId', $movieId);
    $statement5->execute();
    $isQueued = $statement5->rowCount();

    // set the queue button attributes when the movie is not currently in the queue
    $queueBtnText = '+ Add to queue';
    $queueBtnColor = 'blueButton';

    // change the queue button attributes if the movie is already in the queue
    if ($isQueued == 1) {
        $queueBtnText = '- Remove from queue';
        $queueBtnColor = 'redButton';
    }

    // check if this movie is in the user's watch history
    $checkIfWatched = 'SELECT * FROM historyItem WHERE userId = :userId AND movieId = :movieId';
    $statement6 = $db->prepare($checkIfWatched);
    $statement6->bindValue(':userId', $_SESSION['userId']);
    $statement6->bindValue(':movieId', $movieId);
    $statement6->execute();
    $isWatched = $statement6->rowCount();

    // set the history button attributes when the movie is not currently in the history
    $historyBtnText = '+ Add to watch history';
    $historyBtnColor = 'blueButton';

    // change the history button attributes if the movie is already in the watch history
    if ($isWatched == 1) {
        $historyBtnText = '- Remove from watch history';
        $historyBtnColor = 'redButton';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Spotlight</title>
    <link rel="shortcut icon" href="images/spotlight.ico">
    <link rel="stylesheet" href="css/header_style.css">
    <link rel="stylesheet" href="css/movie_details_style.css">
    <script src="javascript/uiToggling.js"></script>
    <script src="javascript/validateInput.js"></script>
</head>

<body>

    <!-- get the html for the navigation bar from php_scripts/header.php -->
    <?php require_once 'php_scripts/header.php';?>

    <!-- div containing the movie title, poster, synopsis, details, score, and queue/history buttons -->
    <div id="movieContent">
        <h2 id="movieTitle"> <?php echo $movie['title']; ?></h2>
        <img id="poster" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"'; ?>>

        <div id="movieDetails">
            <div id="synopsis">
                <h3>Synopsis</h3>

                <!-- get the synopsis from the $movie that was retrieved according to $movieId -->
                <p id="overview">
                    <?php echo $movie['synopsis']; ?>
                </p>
            </div>

            <div id="scoreDiv">
                <h3>Review Score</h3>
                <p id="score"><?php echo $averageScore . '/10.00';?></p>
            </div>

            <h3>Details</h3>

            <!-- fill in the movie's details using the info retrieved for the movie from the database -->
            <span class="detailLabel">Year released:</span>     <span id="year"> <?php echo $movie['year']; ?> </span><br><br>
            <span class="detailLabel">Genre:</span>             <span id="genre"> <?php echo $movie['name']; ?> </span><br><br>
            <span class="detailLabel">MPAA rating:</span>       <span id="mpaaRating"> <?php echo $movie['maturityRating']; ?></span><br><br>


            <!-- contains the queue and history buttons -->
            <div id="buttonContainer">

                <!-- form for the Add/Remove from queue button; the button and its function will
                     change depending on if this movie is already in the user's queue -->
                <form action="php_scripts/edit_queue.php" method="post">

                    <!-- hidden field to pass the movieId -->
                    <input type="hidden" name="movieId" <?php echo 'value="' . $movieId . '"'; ?>>

                    <!-- hidden field that determines if the queue item should be added or deleted -->
                    <input type="hidden" name="isQueued" <?php echo 'value="' . $isQueued . '"';?>>

                    <!-- hidden field to tell edit_queue.php to redirect to movie_details.php when finished -->
                    <input type="hidden" name="goToPage" <?php echo 'value="movie_details.php?movie_id=' . $movieId . '"'?>>

                    <input <?php echo 'class="' . $queueBtnColor .'"';?> id="queueBtn" type="submit" <?php echo 'value="' . $queueBtnText . '"'?>>

                </form>

                <!-- form for the Add/Remove from watch history button; the button and its function will
                     change dependign on if this movie is already in the user's history -->
                <form action="php_scripts/edit_history.php" method="post">

                    <!-- hidden field to pass the movieId -->
                    <input type="hidden" name="movieId" <?php echo 'value="' . $movieId . '"'; ?>>

                    <!-- hidden field that determines if the queue item should be added or deleted -->
                    <input type="hidden" name="isInHistory" <?php echo 'value="' . $isWatched . '"';?>>

                    <!-- hidden field to tell edit_queue.php to redirect to movie_details.php when finished -->
                    <input type="hidden" name="goToPage" <?php echo 'value="movie_details.php?movie_id=' . $movieId . '"'?>>

                    <input <?php echo 'class="' . $historyBtnColor . '"';?> id="addToWatchHistoryBtn" type="submit" <?php echo 'value="' . $historyBtnText . '"';?>>
                </form>
            </div>
        </div>
    </div>

        <!-- Holds the form for a user to write a review, or user's completed review if they already wrote one -->
        <div id="writeReviewDiv">

            <?php
                // if the user has left a review for this movie already...
                if ($alreadyReviewed) {
                    echo '<h3>My Review</h3>';

                    echo '<p class="invalidReview" id="reviewErrorBox" style="display:none"></p>';

                    // display the user's review
                    echo '<div class="userReview" id="myReview">';
                        echo '<span class="username">User: <a class="reviewLink" href="user.php?username=' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</a></span>';
                        echo '<span class="score">Review score: ' . $myScore . '/10</span>';
                        echo '<p>' . $myComment . '</p>';
                        echo '<p class="date">' . $myReview['timeStamp'] . '</p>';
                    echo '</div>';
                    echo '<span class="reviewBtnSpan"><button class="reviewBtn blueButton" id="editReviewBtn" onclick="toggleEditReview(1)">Edit Review</button></span>';
                }

                // otherwise, show the empty review form to let them create a new review
                else {
                    echo '<h3>Write a Review</h3>';
                    echo '<p class="invalidReview" id="reviewErrorBox" style="display:none"></p>';
                }
            ?>

            <!-- This form is used to insert, update, or delete a review -->
            <!-- This form's data is only sent to post_review.php if the function validateReview() returns true -->
            <form action="php_scripts/post_review.php" id="reviewForm" method="post" <?php if ($alreadyReviewed) echo 'class="displayNone"';?> onsubmit="return validateReview(this.submitted);">
                <textarea id="reviewTextArea" rows="4" placeholder="Write your review here..." name="reviewText"><?php echo $myComment; ?></textarea>
                <label for="reviewScore">Review score:</label>
                <select id="reviewScore" name="reviewScore">
                    <option <?php if ($myScore == 1) echo 'selected';?>>1</option>
                    <option <?php if ($myScore == 2) echo 'selected';?>>2</option>
                    <option <?php if ($myScore == 3) echo 'selected';?>>3</option>
                    <option <?php if ($myScore == 4) echo 'selected';?>>4</option>
                    <option <?php if ($myScore == 5) echo 'selected';?>>5</option>
                    <option <?php if ($myScore == 6) echo 'selected';?>>6</option>
                    <option <?php if ($myScore == 7) echo 'selected';?>>7</option>
                    <option <?php if ($myScore == 8) echo 'selected';?>>8</option>
                    <option <?php if ($myScore == 9) echo 'selected';?>>9</option>
                    <option <?php if ($myScore == 10) echo 'selected';?>>10</option>
                </select>

                <!-- hidden field to send the movieId to post_review.php -->
                <input type="hidden" name="movieId" <?php echo 'value="'.$movieId.'"';?>>

                <!-- hidden field to discern if post_review.php should create a new review or update a review -->
                <input type="hidden" name="updateOrPost" <?php echo 'value="' . $updateOrPost . '"';?>>

                <!-- holds Update/Post and Cancel and Delete buttons when applicable -->
                <span class="reviewBtnSpan">
                    <input type="button" value="Cancel" id="cancelEditBtn" onclick="toggleEditReview(0)" class="reviewBtn whiteButton <?php if(!$alreadyReviewed) echo 'displayNone';?>">

                    <!-- post or update button; the onclick is used to tell validateReview() that it needs to validate this input -->
                    <input class="reviewBtn blueButton" type="submit" id="postButton" <?php echo 'value="' . $updateOrPostBtnTxt . '"';?> onclick="this.form.submitted='post'">

                    <!-- delete review button; the onclick is used to tell validateReview() that it does not need to validate this input since the review will be deleted -->
                    <input class="reviewBtn redButton <?php if (!$alreadyReviewed) echo 'displayNone';?>" type="submit" name="deleteBtn" value="Delete" onclick="this.form.submitted='delete'">
                </span>
            </form>
        </div><br>

    <!-- this div holds the list of all user reviews for this movie -->
    <div id="userReviewsDiv">

        <?php

            // display the number of reviews for this movie
            echo '<h3>User Reviews (' . $numOfReviews . ')</h3>';

            // if there are no reviews, show a message
            if ($numOfReviews == 0) {
                echo '<p id="noReviews">This movie does not have any reviews.</p>';
            }
        ?>

        <!-- for every review that this movie has... -->
        <?php foreach ($reviews as $review) : ?>

            <?php
                // get the username of the user that left the review
                $getUsername = 'SELECT username FROM user WHERE userId = :userId';
                $statement3 = $db->prepare($getUsername);
                $statement3->bindValue(':userId', $review['userId']);
                $statement3->execute();
                $userRow = $statement3->fetch();
                $statement3->closeCursor();
            ?>

            <!-- create a div to hold the user's review -->
            <div class="userReview">
                <span class="username">User: <?php echo '<a class="reviewLink" href = "user.php?username=' . $userRow['username'] . '">' . $userRow['username'] . '</a>';?></span>
                <span class="score">Review score: <?php echo $review['score'] . '/10';?></span>
                <p>
                    <?php echo $review['comment'];?>
                </p>
                <p class="date"><?php echo $review['timeStamp'];?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
