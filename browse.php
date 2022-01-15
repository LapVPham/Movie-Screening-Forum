<?php
    // This web page contains the grid of movies that a user can browse. The movies that
    // are displayed can be filtered via genre or by title, which is accomplished by adding
    // a WHERE clause to the SQL query that retrieves the movie posters and titles.

    session_start();
    require 'php_scripts/check_session.php';

    // use the function in check_session.php to check if the user is logged in
    if (!isLoggedIn()) {

        // redirect to the login page if the user is not logged in
        header("Location: login.php");
    }

    // database connection is performed in another file
    require_once('php_scripts/connectDB.php');

    $searched = false;  // boolean telling us if the user is searching movies by title
    $searchWords = '';  // the text the user entered in the search bar
    $genre_id;          // the genre that the user is filtering movies by

    // if the user searched for a movie by name...
    if(isset($_GET['search'])) {

        $searched = true;
        $searchWords = $_GET['search'];
        $genre_id = 0;
    }

    // get genre id from url to filter by genre
    if (!isset($genre_id)) {
        $genre_id = filter_input(INPUT_GET, 'genre_id', FILTER_VALIDATE_INT);

        if ($genre_id == null || $genre_id == FALSE) {
            $genre_id = 0;   // will filter by ALL genres
        }
    }

    $genreName = '';

    // get name of the selected genre
    if ($genre_id == 0) {
        $genreName = 'All';
    } else {

        // use the genreId to find the name for the corresponding genre in the database
        $queryGenre = 'SELECT * FROM genre WHERE genreId = :genre_id';
        $statement1 = $db->prepare($queryGenre);
        $statement1->bindValue(':genre_id', $genre_id);
        $statement1->execute();
        $genreRow = $statement1->fetch();
        $genreName = $genreRow['name'];
        $statement1->closeCursor();
    }

    // prepare to retrieve movies from database
    $queryMovies = '';  // sql statement to retrieve movies matching our criteria
    $movies;            // will hold the movies retrieved from the sql query
    $movieCount = 0;

    // if browsing by all genres...
    if ($genre_id == 0) {

        // get the movies that have $searchWords appear in their title
        $queryMovies = 'SELECT * FROM movie WHERE title LIKE CONCAT("%", :searchWords, "%") ORDER BY title';
        $statement4 = $db->prepare($queryMovies);
        $statement4->bindValue(':searchWords', $searchWords);
        $statement4->execute();
        $movieCount = $statement4->rowCount();
        $movies = $statement4->fetchAll();
        $statement4->closeCursor();

    } else {

        // else if browsing a specific genre, get the movies that belong to this genre
        $queryMovies = 'SELECT * FROM movie WHERE genreId = :genre_id ORDER BY title';
        $statement5 = $db->prepare($queryMovies);
        $statement5->bindValue(':genre_id', $genre_id);
        $statement5->execute();
        $movieCount = $statement5->rowCount();
        $movies = $statement5->fetchAll();
        $statement5->closeCursor();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Spotlight</title>
    <link rel="shortcut icon" href="images/spotlight.ico">
    <link rel="stylesheet" href="css/header_style.css">
    <link rel="stylesheet" href="css/browse_style.css">
</head>

<body>

    <?php require_once 'php_scripts/header.php';?>

    <div class="grid-header">

        <?php

            // swap out the grid header depending on if user searched by name or filtered by genre
            $filterText = '';
            if ($searched) {
                // user searched for a movie by name
                $filterText = 'Showing results for "' . $searchWords . '" (' . $movieCount . ')';
            } else {
                // user filtered by genre
                $filterText = 'Browse ' . $genreName . ' Movies (' . $movieCount . ')';
            }
        ?>

        <h2 id="searchFilter"><?php echo $filterText;?></h2>

        <div id="filterDiv">

            <label for="genreFilter" <?php if ($searched) echo 'style="display:none"';?>>Browse by genre:</label>

            <!-- when this dropdown menu is changed, append the selected genre_id to the url and reload the page-->
            <select name="genreFilter" id="genreFilter" onchange="window.location='browse.php?genre_id='+this.value;" <?php if ($searched) echo 'style="display:none"';?>>
                <option <?php if ($genre_id == 0) echo 'selected';?> value="0">All</option>
                <option <?php if ($genre_id == 1) echo 'selected';?> value="1">Action</option>
                <option <?php if ($genre_id == 2) echo 'selected';?> value="2">Comedy</option>
                <option <?php if ($genre_id == 3) echo 'selected';?> value="3">Drama</option>
                <option <?php if ($genre_id == 4) echo 'selected';?> value="4">Fantasy</option>
                <option <?php if ($genre_id == 5) echo 'selected';?> value="5">Science Fiction</option>
                <option <?php if ($genre_id == 6) echo 'selected';?> value="6">Thriller</option>
                <option <?php if ($genre_id == 7) echo 'selected';?> value="7">Family</option>
            </select>

            <?php
                // if the user searched by title, show an 'X' button to clear the results of the search
                if ($searched) {
                    echo '<form id="clearSearchForm" action="browse.php"><input class="closeBtn" type="Submit" value="&#x2715;"></form>';
                }
            ?>
        </div>
    </div>

    <div class="grid-container">

        <!-- for every movie in this genre/search, show it in the grid -->
        <?php foreach ($movies as $movie) : ?>

            <div class="grid-item">
                <img class="poster" <?php echo 'src="images/posters/' . $movie['posterFile'] . '"'; ?>>

                <!-- this link appends the movie_id to the url of the movie_details page-->
                <div class="title"><a <?php echo 'href="movie_details.php?movie_id=' . $movie['movieId'] . '"'; ?>> <?php echo $movie['title']; ?></a></div>
            </div>

        <?php endforeach; ?>
    </div>
</body>
</html>
