<!-- This file contains the HTML for the header/navigation bar used in 6 of the site's web pages. -->
<!-- Each of those pages include this file so that the header is consistent between all of them. -->
<header>
    <img id="logo" src="images/spotlight.jpg" onclick="window.location.href='index.php'">
    <div class="header">
        <h1 onclick="window.location.href='index.php'">Movie Spotlight</h1>

        <!-- navigation bar -->
        <span id="toolbar">

            <!-- nav buttons -->
            <a href="browse.php"><input class="navButton" type="button" value="Movies"></a>
            <a href="profile.php"><input class="navButton" type="button" value="My Profile"></a>
            <a href="users.php"><input class="navButton" type="button" value="Users"></a>

            <!-- search bar -->
            <form action="browse.php" method="get" class="searchForm">
                <input type="text" class="searchBar" placeholder="Enter movie title" name="search">
                <input type="submit" class="searchButton" value="Search">
            </form>

            <!-- logout button -->
            <form action="php_scripts/logout_script.php" method='post' id='logoutForm'>
                <input type="submit" value="Log Out" id="logoutBtn">
            </form>
        </span>
    </div>
</header>
