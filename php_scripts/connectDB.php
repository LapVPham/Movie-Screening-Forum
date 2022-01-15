<?php
    // This file is used across many of the site's pages to create a connection with the database.
    // Database username and password variables are declared here so that they are
    // not hard coded into all of the php files that need to connect to the database.

    // ************* PLEASE NOTICE  *********************
    // The database should by running on localhost, the database schema name should be movie_site,
    // the database username should be root, and the database password should be an empty string.
    // The below variables could be changed to connect to a different database server that has a different
    // username or password.
    $dsn = 'mysql:host=localhost;dbname=movie_site';
    $dbUsername = 'root';
    $dbPassword = '';

    // create a new PDO that will be used to prepare and execute SQL statements
    try {
        $db = new PDO($dsn, $dbUsername, $dbPassword);
        // echo '<p>PHP successfully connected to the database!</p>';
    } catch (PDOException $e) {
        // exception if the connection to the database server could not be established
        echo '<p>Error connecting to database: Please check the php_scripts/connectDB.php file to make sure you are using the right credentials for the database server.</p>';
        exit();
    }
?>
