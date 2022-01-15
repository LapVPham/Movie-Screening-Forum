// This file holds a function used to toggle the visibility of UI elements on the movie_details.php page.

// Depending on if the argument is 1 or 0, this function will hide the My Review div on the movie_details.php page that
// shows the user their review if they have left one for this movie and replaces it with a form to create/edit their review, or vice versa.
// If toggleOn = 1, show the review form.
// If toggleOn = 0, show the completed review.
function toggleEditReview(toggleOn) {

    // get references to the UI elements to toggle
    var myReviewDiv = document.getElementById('myReview');
    var editReviewBtn = document.getElementById('editReviewBtn');

    var reviewForm = document.getElementById('reviewForm');
    var cancelEditBtn = document.getElementById('cancelEditBtn');
    var errorBox = document.getElementById('reviewErrorBox');

    // if we want to show the form to create/edit a review...
    if (toggleOn == 1) {

        // hide the div that shows a completed review
        myReviewDiv.classList.add('displayNone');
        editReviewBtn.classList.add('displayNone');

        // show the form to let the user create/edit a review
        reviewForm.classList.remove('displayNone');
        cancelEditBtn.classList.remove('displayNone');
    }

    // otherwise we want to hide the review form and show the completed review
    else {
        // hide the form
        reviewForm.classList.add('displayNone');
        cancelEditBtn.classList.add('displayNone');
        errorBox.style.display = 'none';
        errorBox.innerHTML = '';

        // show the div that holds the completed review
        myReviewDiv.classList.remove('displayNone');
        editReviewBtn.classList.remove('displayNone');
    }
}
