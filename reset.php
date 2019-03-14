<?php

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

if(session_id() != $_COOKIE['PHPSESSID'] || !$_COOKIE['PHPSESSID']) {

    session_start();

}

// Require
require_once('mysql.php');

?>
<html>
    <head>

        <link rel="stylesheet" href="css/globals.css">
        <link rel="stylesheet" href="css/reset.css">

        <script src="javascript/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>VX KotH</title>

    </head>
    <body>

        <!-- Container -->
        <div id="grid-container">

            <!-- Header -->
            <div id="grid-header">

                <!-- Top Header -->
                <div id="grid-header-top">

                    <!-- VX KOTH Container -->
                    <div id="grid-vxkoth-container">
                       
                        <a href="index.php">
                            <h3 id="grid-vx">VX</h3>
                            <h3 id="grid-koth">KOTH</h3>
                        </a>

                    </div>

                </div>

                <!-- News -->
                <div id="grid-header-news">
                    <marquee>Latest News From VX</marquee>
                </div>

                <!-- Bottom Header -->
                <div id="grid-header-bottom">

                </div>

            </div>

            <!-- Content -->
            <div id="grid-content">

           <?php
            
                // Check to make sure the token is valid
                if(isset($_GET['Session'])) {
                    
                    // Token is set
                    
                    // Check to make sure session cookie is set
                    if(isset($_COOKIE['PHPSESSID'])) {
                        
                        // Session id cookie is set
                        
                        // Check that they're both the same
                        if(md5($_GET['Session']) == md5($_COOKIE['PHPSESSID'])) {
                            
                            // They're the same, token check complete
                            
                            // Check what they're trying to change
                            if($_GET['Type'] == 'Username') {
                            
                                // User is trying to change username
                                
                                echo '

                                    <div id="grid-reset-container">

                                        <h1 id="grid-reset-heading">New ' . $_GET['Type'] . '</h1>

                                        <form id="grid-reset-form" method="post"></form>

                                        <input id="grid-reset-input" type="text" placeholder="New Username" name="Username" form="grid-reset-form">
                                        <input id="grid-reset-submit" type="submit" value="Ok" form="grid-reset-form">

                                ';
                                
                                // Check if post is empty
                                if(!empty($_POST['Username'])) {
                                    
                                    // Not empty
                                    
                                    // Query 
                                    $QUERY_UPDATE_USERNAME = mysqli_query($conn, "
                                    
                                    UPDATE vx.accounts
                                    SET vx.accounts.username = '" . $_POST['Username'] . "'
                                    WHERE vx.accounts.username = '" . $_GET['Username'] . "';
                                    
                                    ");
                                    
                                    // Unset these variables so the user has to login again
                                    unset($_SESSION);
                                    unset($_COOKIE['USERNAME']);
                                    unset($_COOKIE['PHPSESSID']);
                                    
                                    // Redirect
                                    header('Location: index.php');
                                    
                                } else {
                                    
                                    // Empty
                                    
                                    echo '
                                    
                                        <p class="grid-field-alert">Field can not be empty</p>
                                    
                                    ';
                                    
                                }
                                
                                echo '</div>';
                                
                            }
                            
                            // Check what they're trying to change
                            if($_GET['Type'] == 'Password') {

                                // User is trying to change password

                                echo '

                                    <div id="grid-reset-container">

                                        <h1 id="grid-reset-heading">New ' . $_GET['Type'] . '</h1>

                                        <form id="grid-reset-form" method="post"></form>

                                        <input id="grid-reset-input" type="text" placeholder="New Password" name="Password" form="grid-reset-form">
                                        <input id="grid-reset-submit" type="submit" value="Ok" form="grid-reset-form">

                                ';

                                // Check if post is empty
                                if(!empty($_POST['Password'])) {

                                    // Not empty

                                    // Query 
                                    $QUERY_UPDATE_PASSWORD = mysqli_query($conn, "

                                    UPDATE vx.accounts
                                    SET vx.accounts.password = '" . md5($_POST['Password']) . "'
                                    WHERE vx.accounts.username = '" . $_GET['Username'] . "';

                                    ");

                                    // Unset these variables so the user has to login again
                                    unset($_SESSION);
                                    unset($_COOKIE['USERNAME']);
                                    unset($_COOKIE['PHPSESSID']);
                                    
                                    // Redirect
                                    header('Location: index.php');

                                } else {
                                    
                                    // Empty
                                    
                                    echo '

                                        <p class="grid-field-alert">Field can not be empty</p>

                                    ';
                                    
                                }
                                
                                echo '</div>';
                                
                            }
                            
                            // Check what they're trying to change
                            if($_GET['Type'] == 'Email') {

                                // User is trying to change email

                                echo '

                                    <div id="grid-reset-container">

                                        <h1 id="grid-reset-heading">New ' . $_GET['Type'] . '</h1>

                                        <form id="grid-reset-form" method="post"></form>

                                        <input id="grid-reset-input" type="text" placeholder="New Email" name="Email" form="grid-reset-form">
                                        <input id="grid-reset-submit" type="submit" value="Ok" form="grid-reset-form">

                                ';

                                // Check if post is empty
                                if(!empty($_POST['Email'])) {

                                    // Not empty
                                    
                                    // Query 
                                    $QUERY_UPDATE_EMAIL = mysqli_query($conn, "

                                    UPDATE vx.accounts
                                    SET vx.accounts.email = '" . $_POST['Email'] . "'
                                    WHERE vx.accounts.username = '" . $_GET['Username'] . "';

                                    ");

                                    // Unset these variables so the user has to login again
                                    unset($_SESSION);
                                    unset($_COOKIE['USERNAME']);
                                    unset($_COOKIE['PHPSESSID']);
                                    
                                    // Redirect
                                    header('Location: index.php');


                                } else {
                                    
                                    // Empty
                                    
                                    echo '

                                        <p class="grid-field-alert">Field can not be empty</p>

                                    ';
                                    
                                }
                                
                                echo '</div>';
                                
                            }
                            
                        } else {
                            
                            // Not the same, token check complete
                            
                            echo '<h1 class="grid-alert">Invalid Token</h1>';
                            
                        }
                        
                    } else {
                        
                        // No token 
                        
                        echo '<h1 class="grid-alert">Invalid Token</h1>';
                        
                    }
                    
                } else {
                    
                    // No token
                    
                    echo '<h1 class="grid-alert">Invalid Token</h1>';
                    
                }
                
                // Check why the user is here
                
            ?>
           
            </div>

            <!-- Footer -->
            <div id="grid-footer">

                <!-- Logos and Association-->
                <img id="grid-footer-vx-logo" src="img/VXLogo.png">
                <img id="grid-footer-armahosts-logo" src="img/ArmaHosts.png">

                <!-- General Information -->
                <div id="grid-footer-information">

                    <!-- Headings -->
                    <h3 id="grid-footer-heading-general" class="grid-footer-headings">GENERAL</h3>
                    <h3 id="grid-footer-heading-misc" class="grid-footer-headings">MISC</h3>
                    <h3 id="grid-footer-heading-break" class="grid-footer-headings">LEGAL</h3>

                    <!-- General -->
                    <p id="grid-footer-general-home" class="grid-footer-links"><a href="index.php">Home</a></p>
                    <p id="grid-footer-general-player" class="grid-footer-links"><a href="player.php">Player Panel</a></p>

                    <!-- Legal -->
                    <p id="grid-footer-legal-contact" class="grid-footer-links"><a href="legal.php?part=Contact">Contact</a></p>
                    <p id="grid-footer-legal-copyright" class="grid-footer-links"><a href="legal.php?part=Copyright">Copyright</a></p>
                    <p id="grid-footer-legal-privacy" class="grid-footer-links"><a href="legal.php?part=Privacy">Privacy</a></p>

                    <!-- Misc -->
                    <p id="grid-footer-misc-vxgaming" class="grid-footer-links"><a href="https://www.vxkoth.com/">VX KOTH</a></p>
                    <p id="grid-footer-misc-faq" class="grid-footer-links"><a href="https://www.vxkoth.com/faqs">FAQ</a></p>
                    <p id="grid-footer-misc-sitrep" class="grid-footer-links"><a href="https://www.vxkoth.com/blog">Sitreps</a></p>

                </div>

                <!-- Social Media -->
                <div id="grid-footer-media">

                    <img id="grid-footer-facebook-logo" class="grid-footer-logos" src="img/FacebookLogo.png">
                    <img id="grid-footer-twitter-logo" class="grid-footer-logos" src="img/TwitterLogo.png">
                    <img id="grid-footer-youtube-logo" class="grid-footer-logos" src="img/YoutubeLogo.png">
                    <img id="grid-footer-discord-logo" class="grid-footer-logos" src="img/DiscordLogo.png">

                    <p id="grid-footer-misc-disclaimer">This website is not affiliated or authorized by Bohemia Interactive. Bohemia Interactive, ARMA, DAYZ and all associated logos and designs are trademarks of Bohemia Interactive</p>

                </div>

            </div>

        </div>
       
        <?php

        // Nightmode settings

        // Check cookie value

        if($_COOKIE['NIGHTMODE'] == 'true') {

            echo '

                <script>

                    // Set to nightmode

                    // Check container exists
                    if(document.getElementById("grid-container")) {

                        // Element exists

                        // Change background colour
                        document.getElementById("grid-container").style.backgroundColor = "#3e3e3e";

                        // Change heading colour
                        for(var i = 0; i < document.getElementsByTagName("h1").length; i++) {

                            document.getElementsByTagName("h1")[i].style.color = "#FFFFFF";

                        } 

                        // Change text colour
                        for(var i = 0; i < document.getElementsByTagName("p").length; i++) {

                            document.getElementsByTagName("p")[i].style.color = "#FFFFFF";

                        } 

                        // Check element exists
                        if(document.getElementById("grid-file-upload")) {

                            // Change file upload colour;
                            document.getElementById("grid-file-upload").style.color = "#FFFFFF";

                        }

                        // Check element exists
                        if(document.getElementById("grid-reset-heading")) {

                            document.getElementById("grid-reset-heading").style.color = "#067906";

                        }

                        document.getElementsByClassName("grid-alert")[0].style.color = "#FF0000";

                    }

                </script>

            ';

        } else if($_COOKIE['NIGHTMODE'] == 'false') {

            echo '

                <script>

                    // Set to nightmode

                    // Check container exists
                    if(document.getElementById("grid-container")) {

                        // Element exists

                        // Change background colour
                        document.getElementById("grid-container").style.backgroundColor = "#FFFFFF";

                        // Change heading colour
                        for(var i = 0; i < document.getElementsByTagName("h1").length; i++) {

                            document.getElementsByTagName("h1")[i].style.color = "#000000";

                        } 

                        // Change text colour
                        for(var i = 0; i < document.getElementsByTagName("p").length; i++) {

                            document.getElementsByTagName("p")[i].style.color = "#000000";

                        } 

                        // Check element exists
                        if(document.getElementById("grid-file-upload")) {

                            // Change file upload colour;
                            document.getElementById("grid-file-upload").style.color = "#000000";

                        }

                        // Check element exists
                        if(document.getElementById("grid-reset-heading")) {

                            document.getElementById("grid-reset-heading").style.color = "#067906";

                        }

                        document.getElementsByClassName("grid-alert")[0].style.color = "#FF0000";

                    }

                </script>

            ';

        }

        ?>

    </body>
</html>