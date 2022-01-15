// This file contains functions that perform input validation for the Login and Registration forms on login.php and register.php
// and the Review form on movie_details.php to catch any invalid input before any form data is sent to the server.

// This function validates the input from the Registration form in register.php before it is processed by the server.
// The input is validated by using a regular expression to make sure that special characters are not included in the username,
// the username and password are at least 4 characters long, and the user correctly confirmed their password.
// If this function returns false, the form data will not be sent to the server.
function validateRegistration() {

    // get the values entered from the form
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    // get a reference to the HTML element that will display any error messages
    var errorBox = document.getElementById('registrationError');

    // show error message if username is too short or too long
    if (username.length < 4 || username.length > 25) {
        errorBox.innerHTML = "Your username should be between 4 and 25 characters long.";
        errorBox.style.display = 'block';
        return false;
    }

    // regular expression for username
    // a string that matches this expression starts with a letter followed by any amount of letters, numbers, or underscores
    const usernameRegEx = /^[a-zA-Z][a-zA-Z0-9_]*$/;

    // show error message if the username does not match this regular expression
    if (usernameRegEx.test(username) == false) {
        errorBox.innerHTML = "Username must start with a letter and can consist only of letters, numbers, and underscores."
        errorBox.style.display = 'block';
        return false;
    }

    // show error message if password is too short or too long
    if (password.length < 4 || password.length > 25) {
        errorBox.innerHTML = "Please make sure your password is between 4 and 25 characters long.";
        errorBox.style.display = 'block';
        return false;
    }

    // show error message if passwords don't match
    if (password !== confirmPassword) {

        errorBox.innerHTML = 'Please make sure your passwords match.';
        errorBox.style.display = 'block';
        return false;
    }

    // otherwise there were no problems with the input and it is ready to be sent to server
    errorBox.style.display = 'none';
    return true;
}

// This function validates the username and password input from the login form on login.php
// before it is sent to the server. If this function returns false, the form data
// will not be sent to the server.
function validateLogin() {

    // get the username and password entered from the login form
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // HTML element that will show error message
    var errorBox = document.getElementById('errorBox');

    // show error message if username is too short or too long
    if (username.length < 4 || username.length > 25) {

        errorBox.innerHTML = "Your username should be between 4 and 25 characters long.";
        errorBox.style.display = 'block';
        return false;
    }

    // a string that matches this regular expression starts with a letter followed by any amount of letters, numbers, or underscores
    const usernameRegEx = /^[a-zA-Z][a-zA-Z0-9_]*$/;

    // show error if the username does not match this regular expression
    if (usernameRegEx.test(username) == false) {

        errorBox.innerHTML = "Username must start with a letter and can consist only of letters, numbers, and underscores.";
        errorBox.style.display = 'block';
        return false;
    }

    // show error message if password is too short or too long
    if (password.length < 4 || password.length > 25) {

        errorBox.innerHTML = "Please make sure your password is between 4 and 25 characters long.";
        errorBox.style.display = 'block';
        return false;
    }

    // otherwise there were no problems with the input and it is ready to be sent to server
    errorBox.style.display = 'none';
    return true;
}

// This function validates the user input of the Review form on movie_details.php.
// It ensures that the user has written a comment and that the comment is less than or equal to
// 1000 characters long. If this function returns false, the review will not be processed by the server.
// The button parameter is the button that was pressed to invoke this function.
function validateReview(button) {

    // if the Delete review button was pressed, we do not need to validate input since we are
    // deleteing the review
    if (button === 'delete') {
        return true;
    }

    // otherwise, a review is being created or updated, so input needs to be validated

    var reviewComment = document.getElementById('reviewTextArea').value;    // the user's comment
    var errorBox = document.getElementById('reviewErrorBox');               // the box used to show error messages

    // show error if user has not written a comment
    if (reviewComment.length == 0) {
        errorBox.innerHTML = "Please write a brief comment about your thoughts on this movie before submitting your review.";
        errorBox.style.display = 'block';
        return false;
    }

    // show error if the user's comment is greater than 1000 characters long
    if (reviewComment.length > 1000) {
        errorBox.innerHTML = "The maximum character limit for a review comment is 1000 characters. The comment you tried to submit is " + reviewComment.length + " characters long.";
        errorBox.style.display = 'block';
        return false;
    }

    // otherwise there were no problems with the input and it is ready to be sent to server
    return true;
}
