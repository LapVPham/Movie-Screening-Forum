<?php
    // This is the welcome page that greets a user when they first log in. It explains
    // the main features of the site.

    session_start();

    require 'php_scripts/check_session.php';

    // use the method defined in check_session.php to check if the user is logged in
    if (!isLoggedIn()) {

        // if user is not logged in, redirect to the login page
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Movie Spotlight</title>
<link rel="shortcut icon" href="images/spotlight.ico">
<link rel="stylesheet" href="css/header_style.css">
</head>

<body>

    <!-- show the navigation bar whose html is defined in php_scripts/header.php -->
    <?php require_once 'php_scripts/header.php';?>

  <main id="welcomeBody">

    <!-- get username for welcome message from session variable -->
    <!-- this username was just read from the User table in php_scripts/login_script.php before the user was redirected to this page -->
    <h1> Welcome to Movie Spotlight, <?php echo $_SESSION['username']; ?>!</h1>

    <p>
      Movie Spotlight is a website designed to improve the movie-watching experience
      of its users by managing the details of their hobby. Unsure of what to watch? <a class="blueLink" href="browse.php">Browse</a> our vast collection of
      movies and read reviews written by other users to find a film that interests you.
      If you want to remember to watch a certain movie later, add it to your queue.
      After watching it, add the movie to your watch history to keep track of the movies you have seen
      and leave a review to let other users know what you thought about the film.
      View your movie queue and watch history under your <a class="blueLink" href="profile.php">user profile</a>.
    </p>

    <h2>Browsing Movies </h2>
    <p>
      Click on the <a class="blueLink" href="browse.php">Movies</a> tab in the navigation bar to view our entire collection of movies.
      Movies can be filtered by name or genre to limit the results. Click on a movie title to
      read details like a plot synopsis, its review score, and user reviews.
    </p>

    <h2>User Ratings and Reviews</h2>
    <p>
      The overall rating for a movie is determined by the ratings left by the users that have
      written a review for the movie. These reviews can be found on the associated movie's details page.
      Reviews are meant to help inform other users about whether or not they should watch a certain movie.
      Users are encouraged to leave a review after watching a movie. View individual user profiles by clicking
      on the username in their review or by visiting the <a class="blueLink" href="users.php">Users</a> tab in the navigation bar.
    </p>

    <h2>Queue</h2>
    <p>
      If you find a certain movie that catches your eye, but you can't find the time to watch it right
      away, add the movie to your queue as a reminder to watch it later. Your queue can be found
      in your <a class="blueLink" href="profile.php">user profile</a>, where you can then log the movie into your watch history once you have
      viewed it.
    </p>

    <h2>Watch History</h2>
    <p>
      To keep track of all the movies you have watched, add movies to your watch history upon
      finishing them. This can be done after selecting a movie from the <a class="blueLink" href="browse.php">browse</a> page, or if
      you want to log a movie that is curretly in your queue, this can be done directly from your <a class="blueLink" href="profile.php">user profile</a>.
    </p>

  </main>
</body>
</html>
