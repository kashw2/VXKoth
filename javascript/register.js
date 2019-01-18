document.addEventListener("DOMContentLoaded", function() {
    
    // Add the click event listner
    document.getElementById('input--body-register-username').addEventListener('click', function() {
    
        // Add the keydown event listener
        document.getElementById('input--body-register-username').addEventListener('keydown', function(event) {

            // Check for key press
            if(event.key == "Enter") {

                // Submit the form
                document.getElementById('form--registration-post').submit();

            }

        }, false);
    
    }, false);
        
    // Add the click event listner
    document.getElementById('input--body-register-username').addEventListener('click', function() {
    
        // Add the keydown event listener
        document.getElementById('input--body-register-password').addEventListener('keydown', function(event) {

            // Check for key press
            if(event.key == "Enter") {

                // Submit the form
                document.getElementById('form--registration-post').submit();

            }

        }, false);
        
    }, false);
    
    // Add the click event listner
    document.getElementById('input--body-register-email').addEventListener('click', function() {

        // Add the keydown event listener
        document.getElementById('input--body-register-email').addEventListener('keydown', function(event) {

            // Check for key press
            if(event.key == "Enter") {

                // Submit the form
                document.getElementById('form--registration-post').submit();

            }

        }, false);

    }, false);
    
}, false);