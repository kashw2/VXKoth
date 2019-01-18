//   ___      ___ ___  ___      ___           __      _______   ________  
//  |"  \    /"  |"  \/"  |    |"  |         /""\    |   _  "\ /"       ) 
//   \   \  //  / \   \  /     ||  |        /    \   (. |_)  :(:   \___/  
//    \\  \/. ./   \\  \/      |:  |       /' /\  \  |:     \/ \___  \    
//     \.    //    /\.  \       \  |___   //  __'  \ (|  _  \\  __/  \\   
//      \\   /    /  \   \     ( \_|:  \ /   /  \\  \|: |_)  :)/" \   :)  
//       \__/    |___/\___|     \_______(___/    \___(_______/(_______/  
//
// Unapproved use and redistribution of this code and respective product is strictly prohibited.
// Copyright© 2017 Keanu Ashwell all rights are reserved to the author, creator, registered 
// and licensed owners of this product and it's content

"use strict";

// Add DOM content load event
document.addEventListener('DOMContentLoaded', function() {

    // Login form submit
    
    // Check to make sure they exist
    if(document.getElementById('grid-login-username') && document.getElementById('grid-login-password')) {

        // Add the key press event listner
        document.getElementById('grid-login-username').addEventListener('keypress', function(Event) {

            // Check for key press
            if(Event.key == 'Enter') {                    

                document.getElementById('grid-form-login').submit();

            } else {

            }

        }, false);

    }
        
    // Check to make sure they exist
    if(document.getElementById('grid-login-username') && document.getElementById('grid-login-password')) {

        // Add the key press event listner
        document.getElementById('grid-login-password').addEventListener('keypress', function(Event) {

            // Check for key press
            if(Event.key == 'Enter') {                    

                document.getElementById('grid-form-login').submit();

            } else {

            }

        }, false);

    }
    
    // Logout cookie delete
    
    // Check to make sure the element exists
    if(document.getElementById('grid-logout')) {
        
        // Add the event listner
        document.getElementById('grid-logout').addEventListener('click', function() {
            
            // Delete the cookie
            document.cookie = "USERNAME= ;expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
            document.cookie = "319f4d26e3c536b5dd871bb2c52e3178= ;expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
            
            // Reload the page this way to clear all post fields on server
            window.open('index.php', '_self');
            
        }, false);
        
    }
    
    // Registration form submit
    
    // Check to make sure the element exists
    if(document.getElementById('grid-heading-register')) {
        
        // Element exists
        
        document.getElementById('grid-heading-register').addEventListener('click', function() {
            
            // Submit the registration form
            document.getElementById('grid-registration-form').submit();
            
        }, false);
        
    }
    
    // Legal scroll to element
    
    // Check to make sure the element exist
    if(document.getElementById('grid-legal-basic')) {
        
        // For whatever reason some browsers reset scrollTop to 0 on load this is a bandaid fix for that
        setTimeout(function() {
            
            // Element exists

            // Check elements for data-part attribute

            if(document.getElementById('grid-legal-basic').getAttribute('data-part') == 'true') {

                // Has data-part attribute

                // Scroll to its position
                window.scrollTo(0, document.getElementById('grid-legal-basic').offsetTop);

            } else if(document.getElementById('grid-legal-copyright').getAttribute('data-part') == 'true') {

                // Has data-part attribute

                // Scroll to its position
                window.scrollTo(0, document.getElementById('grid-legal-copyright').offsetTop);

            } else if(document.getElementById('grid-legal-contact').getAttribute('data-part') == 'true') {

                // Has data-part attribute

                // Scroll to its position
                window.scrollTo(0, document.getElementById('grid-legal-contact').offsetTop);

            } else if(document.getElementById('grid-legal-privacy').getAttribute('data-part') == 'true') {

                // Has data-part attribute

                // Scroll to its position
                window.scrollTo(0, document.getElementById('grid-legal-privacy').offsetTop);

            }
            
        }, 100);
        
    }
    
    // Change username
    
    // Check that element exists
    if(document.getElementById('grid-account-settings-username-text')) {
     
        // Count variable
        var creationCount_Username = 0;
        
        // Add the event listner
        document.getElementById('grid-account-settings-username-text').addEventListener('click', function() {
            
            // Increment creation count
            creationCount_Username++;
            
            // Check that 1 or less has already been created
            if(creationCount_Username <= 1) {
                
                // Less than or only 1 created
                
                // Create elements
                var inputUsername = document.createElement('input');
                
                // Set element attributes
                inputUsername.setAttribute('id', 'grid-input-username');
                inputUsername.setAttribute('class', 'grid-input');
                inputUsername.setAttribute('type', 'text');
                inputUsername.setAttribute('maxlength', '32');
                inputUsername.setAttribute('name', 'NEW_USERNAME');
                inputUsername.setAttribute('form', 'grid-form-account-settings-username');
                inputUsername.setAttribute('placeholder', 'New Username');
                
                // Append child
                document.getElementById('grid-settings').appendChild(inputUsername);
                
                // Create the submit button
                
                // Create element
                var submitButton_Username = document.createElement('input');
                
                // Set element attributes
                submitButton_Username.setAttribute('id', 'grid-username-button');
                submitButton_Username.setAttribute('class', 'grid-button');
                submitButton_Username.setAttribute('type', 'submit');
                submitButton_Username.setAttribute('form', 'grid-form-account-settings-username');
                submitButton_Username.setAttribute('value', 'Ok');
                
                // Append the child
                document.getElementById('grid-settings').appendChild(submitButton_Username);
                
            }
            
        }, false);
        
    }
    
    // Change password

    // Check that element exists
    if(document.getElementById('grid-account-settings-password-text')) {

        // Count variable
        var creationCount_Password = 0;

        // Add the event listner
        document.getElementById('grid-account-settings-password-text').addEventListener('click', function() {

            // Increment creation count
            creationCount_Password++;

            // Check that 1 or less has already been created
            if(creationCount_Password <= 1) {

                // Less than or only 1 created

                // Create elements
                var inputPassword = document.createElement('input');

                // Set element attributes
                inputPassword.setAttribute('id', 'grid-input-password');
                inputPassword.setAttribute('class', 'grid-input');
                inputPassword.setAttribute('type', 'password');
                inputPassword.setAttribute('maxlength', '32');
                inputPassword.setAttribute('name', 'NEW_PASSWORD');
                inputPassword.setAttribute('form', 'grid-form-account-settings-password');
                inputPassword.setAttribute('placeholder', 'New Password');

                // Append child
                document.getElementById('grid-settings').appendChild(inputPassword);

                // Create the submit button

                // Create element
                var submitButton_Password = document.createElement('input');

                // Set element attributes
                submitButton_Password.setAttribute('id', 'grid-password-button');
                submitButton_Password.setAttribute('class', 'grid-button');
                submitButton_Password.setAttribute('type', 'submit');
                submitButton_Password.setAttribute('form', 'grid-form-account-settings-password');
                submitButton_Password.setAttribute('value', 'Ok');

                // Append the child
                document.getElementById('grid-settings').appendChild(submitButton_Password);
                
            }

        }, false);

    }
    
    // Change nickname

    // Check that element exists
    if(document.getElementById('grid-account-settings-nickname-text')) {

        // Count variable
        var creationCount_Nickname = 0;

        // Add the event listner
        document.getElementById('grid-account-settings-nickname-text').addEventListener('click', function() {

            // Increment creation count
            creationCount_Nickname++;

            // Check that 1 or less has already been created
            if(creationCount_Nickname <= 1) {

                // Less than or only 1 created

                // Create elements
                var inputNickname = document.createElement('input');

                // Set element attributes
                inputNickname.setAttribute('id', 'grid-input-nickname');
                inputNickname.setAttribute('class', 'grid-input');
                inputNickname.setAttribute('type', 'text');
                inputNickname.setAttribute('maxlength', '20');
                inputNickname.setAttribute('name', 'NEW_NICKNAME');
                inputNickname.setAttribute('form', 'grid-form-account-settings-nickname');
                inputNickname.setAttribute('placeholder', 'New Nickname');

                // Append child
                document.getElementById('grid-settings').appendChild(inputNickname);

                // Create the submit button

                // Create element
                var submitButton_Nickname = document.createElement('input');

                // Set element attributes
                submitButton_Nickname.setAttribute('id', 'grid-nickname-button');
                submitButton_Nickname.setAttribute('class', 'grid-button');
                submitButton_Nickname.setAttribute('type', 'submit');
                submitButton_Nickname.setAttribute('form', 'grid-form-account-settings-nickname');
                submitButton_Nickname.setAttribute('value', 'Ok');

                // Append the child
                document.getElementById('grid-settings').appendChild(submitButton_Nickname);
                
            }

        }, false);

    }
    
    // Change email

    // Check that element exists
    if(document.getElementById('grid-account-settings-email-text')) {

        // Count variable
        var creationCount_Email = 0;

        // Add the event listner
        document.getElementById('grid-account-settings-email-text').addEventListener('click', function() {

            // Increment creation count
            creationCount_Email++;

            // Check that 1 or less has already been created
            if(creationCount_Email <= 1) {

                // Less than or only 1 created

                // Create elements
                var inputEmail = document.createElement('input');

                // Set element attributes
                inputEmail.setAttribute('id', 'grid-input-email');
                inputEmail.setAttribute('class', 'grid-input');
                inputEmail.setAttribute('type', 'text');
                inputEmail.setAttribute('maxlength', '50');
                inputEmail.setAttribute('name', 'NEW_EMAIL');
                inputEmail.setAttribute('form', 'grid-form-account-settings-email');
                inputEmail.setAttribute('placeholder', 'New Email');

                // Append child
                document.getElementById('grid-settings').appendChild(inputEmail);

                // Create the submit button

                // Create element
                var submitButton_Email = document.createElement('input');

                // Set element attributes
                submitButton_Email.setAttribute('id', 'grid-email-button');
                submitButton_Email.setAttribute('class', 'grid-button');
                submitButton_Email.setAttribute('type', 'submit');
                submitButton_Email.setAttribute('form', 'grid-form-account-settings-email');
                submitButton_Email.setAttribute('value', 'Ok');

                // Append the child
                document.getElementById('grid-settings').appendChild(submitButton_Email);
                
            }

        }, false);

    }
    
    // Admin panel text transformation
    
    // Check to make sure the element exists
    if(document.getElementById('grid-heading-underline')) {
        
        // Element exists
        
        // Check that the element exists
        if(document.getElementById('grid-heading-memberships')) {
        
            // Element exists
            
            document.getElementById('grid-heading-memberships').addEventListener('click', function() {

                var offset = document.getElementById('grid-heading-memberships').offsetLeft;
                var newOffest = offset - 10;
                
                document.getElementById('grid-heading-underline').style.transition = 'transform 1s ease-in-out';
                document.getElementById('grid-heading-underline').style.transform = 'translateX(' + newOffest + '.px)';
                
                setTimeout(function() {

                    document.getElementById('grid-heading-underline').style.width = document.getElementById('grid-heading-memberships').offsetWidth + 'px';

                }, 700);
                
            }, false);
            
        }
        
        // Check that the element exists
        if(document.getElementById('grid-heading-events')) {

            // Element exists
        
            document.getElementById('grid-heading-events').addEventListener('click', function() {

                var offset = document.getElementById('grid-heading-events').offsetLeft;
                var newOffest = offset - 10;
                
                document.getElementById('grid-heading-underline').style.transition = 'transform 1s ease-in-out';
                document.getElementById('grid-heading-underline').style.transform = 'translateX(' + newOffest + '.px)';
                
                setTimeout(function() {
                    
                    document.getElementById('grid-heading-underline').style.width = document.getElementById('grid-heading-events').offsetWidth + 'px';
                    
                }, 700);
                
            }, false);
            
        }
        
        // Check that the element exists
        if(document.getElementById('grid-heading-vxbans')) {

            // Element exists
        
            document.getElementById('grid-heading-vxbans').addEventListener('click', function() {
                
                var offset = document.getElementById('grid-heading-vxbans').offsetLeft;
                var newOffest = offset - 10;

                document.getElementById('grid-heading-underline').style.transition = 'transform 1s ease-in-out';
                document.getElementById('grid-heading-underline').style.transform = 'translateX(' + newOffest + '.px)';

                setTimeout(function() {

                    document.getElementById('grid-heading-underline').style.width = document.getElementById('grid-heading-vxbans').offsetWidth + 'px';

                }, 700);
                
            }, false);
            
        }
        
        // Check that the element exists
        if(document.getElementById('grid-heading-servers')) {

            // Element exists
        
            document.getElementById('grid-heading-servers').addEventListener('click', function() {

                var offset = document.getElementById('grid-heading-servers').offsetLeft;
                var newOffest = offset - 10;
                
                document.getElementById('grid-heading-underline').style.transition = 'transform 1s ease-in-out';
                document.getElementById('grid-heading-underline').style.transform = 'translateX(' + newOffest + '.px)';
                
                setTimeout(function() {

                    document.getElementById('grid-heading-underline').style.width = document.getElementById('grid-heading-servers').offsetWidth + 'px';

                }, 700);
                
            }, false);
            
        }
        
        // Check that the element exists
        if(document.getElementById('grid-heading-administration')) {

            // Element exists
        
            document.getElementById('grid-heading-administration').addEventListener('click', function() {

                var offset = document.getElementById('grid-heading-administration').offsetLeft;
                var newOffest = offset - 10;

                document.getElementById('grid-heading-underline').style.transition = 'transform 1s ease-in-out';
                document.getElementById('grid-heading-underline').style.transform = 'translateX(' + newOffest + '.px)';
                
                setTimeout(function() {

                    document.getElementById('grid-heading-underline').style.width = document.getElementById('grid-heading-administration').offsetWidth + 'px';

                }, 700);
                
            }, false);
            
        }
        
    }
    
}, false);