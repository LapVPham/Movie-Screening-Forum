<?php
    // This page shows the profile of the user whose username is specified in the url,
    // like user.php?username=DrewP
    // The user's profile will show their favorite movie and genre, and their queue and
    // watch history. Unlike profile.php, the user can not change any profile details because
    // this page is only used to view the profiles of other users. If the user tries to view
    // their own profile using this page, they will be redirected to profile.php, where they
    // can edit their profile.

    session_start();
    require 'php_scripts/check_session.php';

    // redirect to login page if user is not logged in
    if (!isLoggedIn()) {
        header("Location: login.php");
    }

    // database connection is performed in another file
    require_once('php_scripts/connectDB.php');

    $username = ''; // the username of the user we want to view the profile of
    $getUserRow;    // sql query
    $statement1;    // statement to execute sql query

    // if we have a proper username parameter in the url...
    if (isset($_GET['username'])) {

        $username = $_GET['username'];

        // if the user is trying to access their own profile...
        if (strcasecmp($username, $_SESSION['username']) == 0) {

            // redirect them to the profile page that they can edit
            header("Location: profile.php");
        }

        // prepare sql query to get user info
        $getUserRow = "SELECT * FROM user WHERE username = :username";
        $statement1 = $db->prepare($getUserRow);
        $statement1->bindValue(':username', $username);

    } else {
        // otherwise if no username was passed via url, redirect to the users.php page to browse users
        header("Location: users.php");
    }

    $statement1->execute();

    // if no user with this username exists...
    if ($statement1->rowCount() == 0) {

        // redirect to browse users page
        header("Location: users.php");
    }

    // save the user record with this username
    $userRow = $statement1->fetch();
    $statement1->closeCursor();
    $userId = $userRow['userId'];
    $username = $userRow['username'];
    $favoriteGenreId = $userRow['favoriteGenreId'];
    $favoriteMovieId = $userRow['favoriteMovieId'];

    // get the movies in this user's queue
    $getQueueItems = 'SELECT * FROM queueItem WHERE userId = :userId';
    $statement2 = $db->prepare($getQueueItems);
    $statement2->bindValue(':userId', $userId);
    $statement2->execute();
    $sizeOfQueue = $statement2->rowCount();
    $queueItems = $statement2->fetchAll();
    $statement2->closeCursor();

    // get the movies in this user's watch history
    $getHistoryItems = 'SELECT * FROM historyItem WHERE userId = :userId';
    $statement3 = $db->prepare($getHistoryItems);
    $statement3->bindValue(':userId', $userId);
    $statement3->execute();
    $sizeOfHistory = $statement3->rowCount();
    $historyItems = $statement3->fetchAll();
    $statement3->closeCursor();

    $favoriteMovieTitle = 'None';

    if ($favoriteMovieId != 0) {

        // get the title of this user's favorite movie
        $getFavoriteMovie = 'SELECT * FROM movie WHERE movieId = :favoriteMovieId';
        $statement4 = $db->prepare($getFavoriteMovie);
        $statement4->bindValue(':favoriteMovieId', $favoriteMovieId);
        $statement4->execute();
        $favoriteMovie = $statement4->fetch();
        $favoriteMovieTitle = $favoriteMovie['title'];
        $statement4->closeCursor();
    }

    // get the name of this user's favorite genre
    $getFavoriteGenre = 'SELECT * FROM genre WHERE genreId = :favoriteGenreId';
    $statement5 = $db->prepare($getFavoriteGenre);
    $statement5->bindValue(':favoriteGenreId', $favoriteGenreId);
    $statement5->execute();
    $favoriteGenre = $statement5->fetch();
    $statement5->closeCursor();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Movie Spotlight</title>
    <link rel="shortcut icon" href="images/spotlight.ico">
    <link rel="stylesheet" href="css/header_style.css">
    <link rel="stylesheet" href="css/profile_style.css">
</head>

<body>

    <!-- get the html for the navbar from header.php -->
    <?php require_once 'php_scripts/header.php';?>

    <main>
        <div class="profileDetailsDiv">
            <h1>User Profile: <?php echo $username;?></h1>
            <h2 class="favoritesH2">Favorites</h2>

            <!-- fill in this user's favorite movie/genre with the information retrieved earlier -->
            <p><b>Favorite movie: </b><?php echo $favoriteMovieTitle;?></p>
            <p><b>Favorite genre: </b><?php echo $favoriteGenre['name'];?></p>
        </div>

        <!-- queue table -->
        <div class="queueDiv">
            <h2>Queue (<?php echo $sizeOfQueue;?>)</h2>
            <table class="profileTable">
                <tr>
                    <th class="posterColUQ">Poster</th>
                    <th class="titleColUQ">Title</th>
                    <th class="genreColUQ">Genre</th>
                    <th class="dateColUQ">Date Queued</th>
                </tr>

                <?php foreach ($queueItems as $queueItem) : ?>

                    <?php
                    // get the movie that each queueItem refers to
                    $getMovie = 'SELECT * FROM movie WHERE movieId = :movieId';
                    $statement6 = $db->prepare($getMovie);
                    $movieId = $queueItem['movieId'];
                    $statement6->bindValue(':movieId', $movieId);
                    $statement6->execute();
                    $movie = $statement6->fetch();
                    $statement6->closeCursor();

                    // get the genre that this movie belongs to
                    $getGenre = 'SELECT * FROM genre WHERE genreId = :genreId';
                    $statement7 = $db->prepare($getGenre);
                    $genreId = $movie['genreId'];
                    $statement7->bindValue(':genreId', $genreId);
                    $statement7->execute();
                    $genre = $statement7->fetch();
                    $statement7->closeCursor();

                    ?>

                    <!-- for each item in this user's queue, add its details to a row in the table -->
                    <tr>
                        <td><img class="posterThumbnail" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"';?>></td>
                        <td><a class="movieTitleLink" <?php echo 'href="movie_details.php?movie_id=' . $movieId . '"';?>><?php echo $movie['title'];?></a></td>
                        <td><?php echo $genre['name'];?></td>
                        <td><?php echo $queueItem['date'];?></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>

        <!-- history table -->
        <div class="historyDiv">
            <h2>Watch History (<?php echo $sizeOfHistory;?>)</h2>

            <table class="profileTable">
                <tr>
                    <th class="posterColUQ">Poster</th>
                    <th class="titleColUH">Title</th>
                    <th>Genre</th>
                    <th>Date Watched</th>
                    <th>User Score</th>
                </tr>

                <?php foreach ($historyItems as $historyItem) : ?>

                    <?php
                    // get the movie that each history item refers to
                    $getMovie = 'SELECT * FROM movie WHERE movieId = :movieId';
                    $statement8 = $db->prepare($getMovie);
                    $movieId = $historyItem['movieId'];
                    $statement8->bindValue(':movieId', $movieId);
                    $statement8->execute();
                    $movie = $statement8->fetch();
                    $statement8->closeCursor();

                    // get the genre of this movie
                    $getGenre = 'SELECT * FROM genre WHERE genreId = :genreId';
                    $statement9 = $db->prepare($getGenre);
                    $genreId = $movie['genreId'];
                    $statement9->bindValue(':genreId', $genreId);
                    $statement9->execute();
                    $genre = $statement9->fetch();
                    $statement9->closeCursor();

                    $score = '----';

                    // if this movie has been reviewed by this user...
                    if ($historyItem['isReviewed'] == 1) {

                        // get the score the user gave the movie
                        $getReview = 'SELECT * FROM review WHERE userId = :userId AND movieId = :movieId';
                        $statement10 = $db->prepare($getReview);
                        $statement10->bindValue(':userId', $userId);
                        $statement10->bindValue(':movieId', $movieId);
                        $statement10->execute();
                        $review = $statement10->fetch();
                        $statement10->closeCursor();
                        $score = $review['score'] . '/10';

                    }
                    ?>

                    <!-- for each movie in this user's watch history, add its details to a row in the table -->
                    <tr>
                        <td><img class="posterThumbnail" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"';?>></td>
                        <td><a class="movieTitleLink" <?php echo 'href="movie_details.php?movie_id=' . $movieId . '"';?>><?php echo $movie['title'];?></a></td>
                        <td><?php echo $genre['name'];?></td>
                        <td><?php echo $historyItem['date'];?></td>
                        <td><?php echo $score;?></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>
</html>
