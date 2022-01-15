MovieSite

1. HOW TO START THE PROJECT

Place the entire "MovieSite" folder into XAMPP's htdocs folder.

Import the database contained in "OTHER_DELIVERABLES/movie_site.sql" to your localhost database
server.

NOTE: The name of the server should be "localhost", the username for the database
should be "root", and the database password should be the empty string "". If you
are using a database server that uses a different name, username, or password,
then you will need to modify lines 11, 12, or 13 of php_scripts/connectDB.php.

Start XAMPP's Apache Web Server and MySQL Database server.


2. ENTRY POINT

In a web browser, navigate to localhost/MovieSite/login.php in the URL bar to access
our Login page.

To be able to access the site's pages other than login.php and register.php, you must
either login to an existing account or create a new account using the registration
page. You can navigate to the registration page by clicking the link below the
login form that says "Don't have an account?".

We suggest that you start by creating your own account using the registration page, but we have also
provided the username and passwords of two existing user accounts that you can log into instead.

Username: DrewP         Password: 123456
Username: MovieMan02    Password: user02


3. FUNCTIONALITIES

Once you are logged in, you can access the rest of the site's pages. If you try to
navigate to pages like index.php through the URL bar without logging in first, you
will be redirected to the login page. If you check the "Remember me" box when logging
in, then you will still be able to navigate to all of the site's pages even after your
current session ends by timing out or if you close the web browser. When you click
the "Log Out" button, you will have to complete the login process again to access
the site's main pages.

Click the Movies tab to browse our collection of 70 movies. Movies can be filtered
according to their genre or searched for by their title. Upon clicking on a movie,
you will be presented with its details and all of its user reviews.

If you want a reminder to watch a movie later, add it to your queue. After
watching it, move the movie to your watch history to keep track of the movies you
have seen, and write a review to let other users know what you thought about this film.
You can update or delete your review at any time.

You can view and manage your queue and watch history under your user profile. You
can also customize your favorite movie and favorite genre to personalize your profile
since it can be viewed by other users.

Click on the username of another user to view their profile. The usernames of
other users are shown in the reviews they write for movies, or you can find a
list of all users by clicking the Users tab in the navigation bar.

Not all movies have been reviewed by a user yet.
Some movies that have already been reviewed by multiple users include:
- Spider Man 2
- Star Wars Episode IV - A New Hope
- Anchorman: The Legend of Ron Burgandy


4. TESTED BROWSERS + OPERATING SYSTEMS

Our website was tested on Google Chrome 96.0, Firefox 95.0, and Safari 13.1 on
macOS Catalina 10.15.

It was also tested on Google Chrome 96.0 on a machine running Windows 10.


5. EXTERNAL LIBRARIES/FRAMEWORKS

We did not use any external libraries or frameworks.


6. STARTER CODE

We did not use any starter code. We wrote all of the code for this project ourselves.
None of it was generated automatically.


7. CHANGED CODE

As mentioned above, we wrote all of the code for this project ourselves.


8. OTHER DELIVERABLES

The other deliverables like the Project Summary, how the work was divided,
Use-Case Diagram, ER-Diagram, Navigational Chart, CRUD Matrix, the list of
problems we faced and how we resolved them, lessons learned, etc. are provided
in the file "OTHER_DELIVERABLES/WRITTEN_DELIVERABLES.pdf".


9. DISCLAIMER

The plot synopses of the movies on our site were obtained from the website Rotten Tomatoes.
