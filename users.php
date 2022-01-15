<?php
    // This page shows a table of all of the sites registered users. When you click
    // on one of the usernames, you are redirected to that user's profile (user.php).
    // You can also use a search bar to search for a specific user.

    session_start();
    require 'php_scripts/check_session.php';

    // use a method defined in check_session.php to check if the user is logged in
    if (!isLoggedIn()) {

        // if user is not logged in, redirect to the login page
        header("Location: login.php");
    }

    // database connection is performed in another file
    require_once('php_scripts/connectDB.php');

    // these variables change if the user searches a specific username using the search bar
    $searchTerm = '';
    $columnName = 'All Users';

    // if the user used the search bar to search for a specific username...
    if(isset($_GET['searchTerm'])) {

        $searchTerm = $_GET['searchTerm'];                          // save the name they searched for
        $columnName = 'Showing results for "' . $searchTerm . '"';  // change the title of the table's column
    }

    // get the list of all users that have $searchTerm in their username
    $getUsers = 'SELECT * FROM user WHERE username LIKE CONCAT("%", :searchTerm, "%") ORDER BY username';
    $statement1 = $db->prepare($getUsers);
    $statement1->bindValue(':searchTerm', $searchTerm);
    $statement1->execute();
    $numberOfUsers = $statement1->rowCount();
    $users = $statement1->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Spotlight</title>
    <link rel="shortcut icon" href="images/spotlight.ico">
    <link rel="stylesheet" href="css/header_style.css">
    <link rel="stylesheet" href="css/users.css">
</head>

<body>

    <!-- get the html for the navbar from header.php -->
    <?php require_once 'php_scripts/header.php';?>

    <main>
            <div class="usersHeader">
                <h2 id="usersH2">Browse Users</h2>

                <!-- form holding the searchbar to let users search for a specific username -->
                <!-- the username will be passed to this page's url as a GET parameter-->
                <form action="users.php" id="usersSearchForm" class="searchForm" method="get">
                    <input type="text" class="searchBar" placeholder="Search by username" name="searchTerm">
                    <input type="submit" class="searchButton" value="Search">
                </form>
            </div>

            <table class="usersTable">
                <tr>
                    <th>
                        <?php
                            // show the 'X' button to clear search results only if the user used the search bar
                            if (isset($_GET['searchTerm'])) {

                                echo '<button class="smallCloseBtn" onclick="window.location.href=\'users.php\'">&#x2715;</button>';
                            }

                            echo $columnName . ' (' . $numberOfUsers . ')';
                        ?>
                    </th>
                </tr>

                <!-- display all the users that were retrieved from the query in their own row -->
                <?php foreach ($users as $user) : ?>

                    <tr>
                        <td><a <?php echo 'href="user.php?username=' . $user['username'] . '"';?> class="userLink"><?php echo $user['username'];?></a></td>
                    </tr>

                <?php endforeach; ?>
            </table>
    </main>
</body>
</html>
