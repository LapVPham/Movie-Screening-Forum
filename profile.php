<?php
    // This web page shows the profile of the user that is currently logged in.
    // It shows all the movies that are in the user's queue and watch history.
    // The user is able to change their profile by choosing their favorite movie/genre, or
    // by editing the movies in their queue and watch history.

    session_start();
    require 'php_scripts/check_session.php';

    // use function from php_scripts/check_session.php to check if a user is logged in
    if (!isLoggedIn()) {

        // if they are not logged in, redirect them to the login page
        header("Location: login.php");
    }

    // database connection is performed in another file
    require_once('php_scripts/connectDB.php');

    $userId = $_SESSION['userId'];  // id of the logged in user

    // get movies in user's queue
    $getQueueItems = 'SELECT * FROM queueItem WHERE userId = :userId';
    $statement1 = $db->prepare($getQueueItems);
    $statement1->bindValue(':userId', $userId);
    $statement1->execute();
    $sizeOfQueue = $statement1->rowCount();
    $queueItems = $statement1->fetchAll();
    $statement1->closeCursor();

    // get movies in user's watch history
    $getHistoryItems = 'SELECT * FROM historyItem WHERE userId = :userId';
    $statement4 = $db->prepare($getHistoryItems);
    $statement4->bindValue(':userId', $userId);
    $statement4->execute();
    $sizeOfHistory = $statement4->rowCount();
    $historyItems = $statement4->fetchAll();
    $statement4->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
<title>Movie Spotlight</title>
<link rel="shortcut icon" href="images/spotlight.ico">
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/header_style.css">
<link rel="stylesheet" href="css/profile_style.css">
</head>

<body>

    <!-- get the html for the navbar from header.php -->
    <?php require_once 'php_scripts/header.php';?>

    <main>
        <div class="profileDetailsDiv">
            <h1>My Profile: <?php echo $_SESSION['username'];?></h1>

            <h2 class="favoritesH2">My Favorites</h2>

            <!-- form for a user to change their favorite movie/genre -->
            <form action="php_scripts/save_profile.php" method="post">

                <?php
                    // get the movies to display in the selection box used to pick a favorite movie
                    $getAllMovies = 'SELECT * FROM movie ORDER BY title';
                    $statement8 = $db->prepare($getAllMovies);
                    $statement8->execute();
                    $allMovies = $statement8->fetchAll();
                    $statement8->closeCursor();

                    // setthe user's favorites using their info saved in session variables when they logged in
                    $favoriteGenreId = $_SESSION['favoriteGenreId'];
                    $favoriteMovieId = $_SESSION['favoriteMovieId'];
                ?>

                <label for="favoriteMovie">Favorite movie:</label>
                <select id="favoriteMovie" name="favoriteMovieId">

                    <!-- list every movie in database and set the selection box to show the user's saved choice -->
                    <option value="0" <?php if ($favoriteMovieId == 0 ) echo 'selected';?>>None</option>
                    <?php foreach ($allMovies as $movie) : ?>
                        <?php
                            echo '<option value="' . $movie['movieId'] . '" ';

                            // show this option is selected if it is saved in the database as the user's favorite
                            if ($favoriteMovieId == $movie['movieId']) echo 'selected';

                            echo '>' . $movie['title'] . '</option>';
                        ?>
                    <?php endforeach; ?>

                </select><br><br>

                <label for="favoriteGenre">Favorite genre:</label>
                <select id="favorteGenre" name="favoriteGenreId">

                    <!-- select the user's favorite genre stored in their database record -->
                    <option value="8" <?php if ($favoriteGenreId == 8) echo 'selected';?>>None</option>
                    <option value="1" <?php if ($favoriteGenreId == 1) echo 'selected';?>>Action</option>
                    <option value="2" <?php if ($favoriteGenreId == 2) echo 'selected';?>>Comedy</option>
                    <option value="3" <?php if ($favoriteGenreId == 3) echo 'selected';?>>Drama</option>
                    <option value="4" <?php if ($favoriteGenreId == 4) echo 'selected';?>>Fantasy</option>
                    <option value="5" <?php if ($favoriteGenreId == 5) echo 'selected';?>>Science Fiction</option>
                    <option value="6" <?php if ($favoriteGenreId == 6) echo 'selected';?>>Thriller</option>
                    <option value="7" <?php if ($favoriteGenreId == 7) echo 'selected';?>>Family</option>

                </select>

                <input type="submit" id="profileSubmitBtn" value="Save">
            </form>
        </div>

        <div class="queueDiv">

            <h2>My Queue <?php echo '(' . $sizeOfQueue . ')';?></h2>

            <table class="profileTable">
                <tr>
                    <th class="posterCol">Poster</th>
                    <th class="titleCol">Title</th>
                    <th class="genreCol">Genre</th>
                    <th class="dateCol">Date Queued</th>
                    <th class="manageCol">Manage Item</th>
                </tr>

                <!-- add every movie in the user's queue to the queue table -->
                <?php foreach ($queueItems as $queueItem) : ?>

                    <?php

                    // get the movie that each queueItem refers to
                    $getMovie = 'SELECT * FROM movie WHERE movieId = :movieId';
                    $statement2 = $db->prepare($getMovie);
                    $movieId = $queueItem['movieId'];
                    $statement2->bindValue(':movieId', $movieId);
                    $statement2->execute();
                    $movie = $statement2->fetch();
                    $statement2->closeCursor();

                    // get the genre that this movie belongs to
                    $getGenre = 'SELECT * FROM genre WHERE genreId = :genreId';
                    $statement3 = $db->prepare($getGenre);
                    $genreId = $movie['genreId'];
                    $statement3->bindValue(':genreId', $genreId);
                    $statement3->execute();
                    $genre = $statement3->fetch();
                    $statement3->closeCursor();

                    ?>

                    <!-- make a row for the queueItem in the table -->
                    <tr class="queueEntry">
                        <td><img class="posterThumbnail" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"';?>></td>
                        <td><a class="movieTitleLink" <?php echo 'href="movie_details.php?movie_id=' . $movieId . '"'; ?>><?php echo $movie['title'];?></a></td>
                        <td><?php echo $genre['name'];?></td>
                        <td><?php echo $queueItem['date'];?></td>

                        <td>
                            <!-- form to move the queued movie to the user's watch history -->
                            <form action='php_scripts/queue_to_history.php' method='post'>

                                <!-- hidden field to pass the movieId of the movie to move -->
                                <input type="hidden" name="movieId" value="<?php echo $movieId;?>">

                                <input class="manageProfileBtn blueButton" type="submit" value="Mark as watched">
                            </form>

                            <!-- form for the user to remove the queued movie from their queue -->
                            <form action="php_scripts/edit_queue.php" method="post">
                                <input type="hidden" name="movieId" <?php echo 'value="' . $movieId . '"'; ?>>
                                <input type="hidden" name="isQueued" value="1">
                                <input type="hidden" name="goToPage" value="profile.php">
                                <input class="manageProfileBtn redButton" type="submit" value="Remove from queue">
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>

        <div class="historyDiv">
            <h2>Watch History <?php echo '(' . $sizeOfHistory . ')';?></h2>

            <table class="profileTable">
                <tr>
                    <th class="posterCol">Poster</th>
                    <th class="titleCol">Title</th>
                    <th class="genreColH">Genre</th>
                    <th class="dateColH">Date Watched</th>
                    <th class="scoreColH">Your Score</th>
                    <th class="manageCol">Manage Item</th>
                </tr>

                <!-- add every movie in this user's watch history to the watch history table -->
                <?php foreach ($historyItems as $historyItem) : ?>

                    <?php
                    // get the movie that each history item refers to
                    $getMovie = 'SELECT * FROM movie WHERE movieId = :movieId';
                    $statement5 = $db->prepare($getMovie);
                    $movieId = $historyItem['movieId'];
                    $statement5->bindValue(':movieId', $movieId);
                    $statement5->execute();
                    $movie = $statement5->fetch();
                    $statement5->closeCursor();

                    // get the genre of this movie
                    $getGenre = 'SELECT * FROM genre WHERE genreId = :genreId';
                    $statement6 = $db->prepare($getGenre);
                    $genreId = $movie['genreId'];
                    $statement6->bindValue(':genreId', $genreId);
                    $statement6->execute();
                    $genre = $statement6->fetch();
                    $statement6->closeCursor();

                    // attributes of the review button if this movie is not reviewed
                    $reviewBtnText = '+ Write a review';
                    $reviewBtnColor = 'greenButton';

                    $score = '----';

                    // if this movie is already reviewed...
                    if ($historyItem['isReviewed'] == 1) {

                        // change the attributes of the review button
                        $reviewBtnText = 'Edit your review';
                        $reviewBtnColor = 'blueButton';

                        // get the score the user gave the movie in their review
                        $getReview = 'SELECT * FROM review WHERE userId = :userId AND movieId = :movieId';
                        $statement7 = $db->prepare($getReview);
                        $statement7->bindValue(':userId', $userId);
                        $statement7->bindValue(':movieId', $movieId);
                        $statement7->execute();
                        $review = $statement7->fetch();
                        $statement7->closeCursor();
                        $score = $review['score'] . '/10';
                    }
                    ?>

                    <!-- make a row to hold this movie in the watch history table -->
                    <tr class="historyEntry">
                        <td><img class="posterThumbnail" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"';?>></td>
                        <td><a class="movieTitleLink" <?php echo 'href="movie_details.php?movie_id=' . $historyItem['movieId'] . '"';?>><?php echo $movie['title'];?></a></td>
                        <td><?php echo $genre['name'];?></td>
                        <td><?php echo $historyItem['date'];?></td>
                        <td><?php echo $score;?></td>

                        <td>
                            <!-- button linking to this movie's movie_details.php page -->
                            <button class="manageProfileBtn <?php echo $reviewBtnColor;?>" onclick="window.location.href='movie_details.php?movie_id=<?php echo $historyItem['movieId'];?>'"><?php echo $reviewBtnText?></button>

                            <!-- form to remove this movie from the user's watch history -->
                            <form action="php_scripts/edit_history.php" method="post">

                                <!-- hidden field to tell edit_history.php which movie to work with -->
                                <input type="hidden" name="movieId" value="<?php echo $historyItem['movieId'];?>">

                                <!-- hidden field to tell edit_history.php to delete the movie from history -->
                                <input type="hidden" name="isInHistory" value="1">

                                <!-- hidden field to tell edit_history.php to redirect back to the profile page -->
                                <input type="hidden" name="goToPage" value="profile.php">

                                <input class="manageProfileBtn redButton" type="submit" value="Mark as unwatched">
                            </form>

                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>
</html>
