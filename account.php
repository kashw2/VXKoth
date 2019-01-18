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
require_once('steam.php');

// Security checks

// Check if cookie is set
if(isset($_COOKIE['USERNAME'])) {

    // Cookie is set
    
    // Query
    $QUERY_ALL_USERS = mysqli_query($conn, "

    SELECT 
    vx.accounts.id,
    vx.accounts.username,
    vx.accounts.ip,
    vx.accounts.admin,
    vx.accounts.permissionArray
    FROM vx.accounts
    WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

    ");

    // Fetch the results
    $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);
    
    // If session id different from user id
    if($RESULT_ALL_USERS[0] != $_SESSION['USERID']) {
    
        // Redirect to landing page
        header('Location: index.php');
        
    }

} else {
    
    // Redirect
    header('Location: index.php');
    
}

?>
<html>
    <head>

        <link rel="stylesheet" href="css/globals.css">
        <link rel="stylesheet" href="css/account.css">

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

                <?php

                // If cookie exists and is set
                if(isset($_COOKIE['USERNAME'])) {

                    // Query
                    $QUERY_ALL_USERS = mysqli_query($conn, "

                        SELECT 
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.ip
                        FROM vx.accounts
                        WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                        ");

                    // Fetch the results
                    $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);

                    if($RESULT_ALL_USERS[0] == $_SESSION['USERID']) {

                        echo '

                                <div id="grid-account-options">

                                    <p id="grid-myaccount" class="grid-account-managment"><a href="account.php">My Account</a></p>
                                    <p id="grid-logout" class="grid-account-managment">Logout</p>

                                </div>

                                ';

                    } else {

                        // No session userid set

                        echo '

                                <div id="grid-account-options">

                                    <p id="grid-register" class="grid-account-managment"><a href="register.php">Register</a></p>

                                </div>

                            ';

                    }

                } else {

                    // Cookie either doesnt exist or isnt set

                    echo '

                                <div id="grid-account-options">

                                    <p id="grid-register" class="grid-account-managment"><a href="register.php">Register</a></p>

                                </div>

                            ';

                }

                ?>

                </div>

                <!-- News -->
                <div id="grid-header-news">
                    <marquee>Latest News From VX</marquee>
                </div>

                <!-- Bottom Header -->
                <div id="grid-header-bottom">

                    <?php

                    // If cookie exists and is set
                    if($_COOKIE['USERNAME']) {

                        // User exists

                        // Query
                        $QUERY_ALL_USERS = mysqli_query($conn, "

                        SELECT 
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.ip,
                        vx.accounts.admin,
                        vx.accounts.permissionArray
                        FROM vx.accounts
                        WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                        ");

                        // Fetch the results
                        $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);

                        // User is an admin and ip matches
                        if($RESULT_ALL_USERS[3] == 1 && $RESULTS_ALL_USERS[2] = $_SERVER['REMOTE_ADDR']) {

                            echo '

                                <p class="grid-user-display">Logged in as: ' . $_COOKIE['USERNAME'] . ' <a href="admin.php">(Admin)</a></p>

                            ';

                        } else {

                            // User is not an admin

                            echo '

                                <p class="grid-user-display">Logged in as: ' . $_COOKIE['USERNAME'] . '</p>

                            ';

                        }

                    } else {

                        // Cookie either doesnt exist or isnt set

                    }

                    ?>

                </div>

            </div>

            <!-- Content -->
            <div id="grid-content">
            
                <h1 id="grid-heading-account"><?php echo $_COOKIE['USERNAME']; ?>'s Account</h1>
                
                <!-- Profile Image Container-->
                <div id="grid-image-container">
                    
                    <?php
                    
                    // Change directory
                    chdir('img/userimg/' . $_SESSION['USERID'] . '/');

                    // Glob file check
                    $GLOB_FILE_CHECK = glob("*.jpg");
                    
                    // Back to user directory
                    chdir('..');
                    
                    // Check directory exists
                    if(!file_exists('img/userimg/' . $_SESSION['USERID'] . '' . $GLOB_FILE_CHECK[0])) {

                        echo '

                            <!-- Profile Picture -->
                            <img id="grid-account-image" src="img/userimg/' . $_SESSION['USERID'] . '/' . $GLOB_FILE_CHECK[0] . '">

                        ';
                        
                    }
                    
                    ?>
                        
                </div>
                
                <!-- Image Upload -->
                <form id="grid-image-upload" method="post" enctype="multipart/form-data"></form>
                
                <div id="grid-image-upload-container">
                
                    <input id="grid-file-upload" type="file" name="FILE" form="grid-image-upload">
                    <input id="grid-file-submit" type="submit" name="SUBMIT" form="grid-image-upload">
                
                </div>
                
                <?php
                
                // Make sure the post field isnt empty
                if(!empty($_POST['SUBMIT'])) {     
                    
                    // Set up remote addresses for file upload
                    $REMOTE_DIR = "img\userimg\'" . $_SESSION['USERID'] . "'";
                    $REMOTE_FILE = basename($_FILES['FILE']["name"]);

                    // Set up the upload
                    $IMAGE_FILE = strtolower(pathinfo($REMOTE_DIR, PATHINFO_EXTENSION));
                
                    // Post field isnt empty
                    
                    // Make sure the post field is set
                    if(isset($_POST['SUBMIT'])) {

                        // Post field is set
                        
                        // Check the file size
                        $CHECK = getimagesize($_FILES['FILE']["tmp_name"]);
                        
                        // Make sure the file is an image
                        if($CHECK !== FALSE) {
                        
                            // Is image file
                            
                            if($_FILES['FILE']["size"] < 1000000) {
                                
                                // File size is within bounds
                                
                                // Upload file
                                
                                // Check directory exists
                                if(!file_exists('img/userimg/' . $_SESSION['USERID'] . '')) {
                                    
                                    chdir('img/userimg/');
                                    
                                    echo getcwd();
                                    
                                    // Create the directory if not already exists
                                    mkdir($_SESSION['USERID'] , 0077, false);
                                    
                                    chdir($_SESSION['USERID']);

                                    $GLOB_FILE_CHECK = glob("*.jpg");

                                    // Check file exists
                                    if($GLOB_FILE_CHECK[0] != $REMOTE_FILE) {

                                        // File exists

                                        // Delete the file
                                        unlink($GLOB_FILE_CHECK[0]);

                                        // Redirect so that the page updates and loads the image
                                        header('Location: account.php');
                                        

                                    }
                                    
                                    // Check if file was uploaded
                                    if(move_uploaded_file($_FILES['FILE']["tmp_name"], $REMOTE_FILE)) {

                                        // File uploaded

                                        $ERROR = FALSE;

                                        echo '

                                            <p id="grid-image-inform">File uploaded!</p>

                                        ';

                                    } else {

                                        $ERROR = TRUE;

                                        echo '

                                            <p id="grid-image-inform">Error uploading file</p>

                                        ';

                                    }
                                    
                                } else {
                                    
                                    $ERROR = TRUE;

                                    echo '

                                        <p id="grid-image-inform">File directory already exists</p>

                                    ';

                                }
                                
                            } else {
                                
                                // File size is out of bounts
                                
                                $ERROR = TRUE;

                                echo '

                                    <p id="grid-image-inform">File is too big</p>

                                ';
                                
                            }
                        
                        } else {
                            
                            // Not image file
                            
                            $ERROR = TRUE;
                            
                            echo '

                                <p id="grid-image-inform">File isnt a valid image file</p>

                            ';
                            
                        }
                        

                    } else {
                        
                        // Post field isnt set
                        
                        $ERROR = TRUE;

                        echo '

                                <p id="grid-image-inform">Select an image to upload</p>

                            ';
                        
                    }
                    
                } else {
                    
                    // Post field is empty
                    
                    $ERROR = TRUE;

                    echo '

                            <p id="grid-image-inform">Select an image to upload</p>

                        ';
                    
                }
                
                // Check for error
                if($ERROR == FALSE) {
                
                    echo '

                        <p id="grid-image-inform">Max dimensions: 150x150, 1MB</p>

                    ';
                
                }
                
                ?>

                <!-- Headings -->
                <h1 id="grid-heading-settings">Settings</h1>
                <h1 id="grid-heading-controls">Controls</h1>
                <h1 id="grid-heading-other">Other</h1>
                
                <!-- Account Settings -->
                <div id="grid-settings">
                    
                    <!-- Form -->
                    <form id="grid-form-account-settings-username" method="post"></form>
                    <form id="grid-form-account-settings-password" method="post"></form>
                    <form id="grid-form-account-settings-nickname" method="post"></form>
                    <form id="grid-form-account-settings-email" method="post"></form>
                    
                    <!-- Options -->
                    <p id="grid-account-settings-username-text" class="grid-account-paragraph">Change Username</p>
                    <p id="grid-account-settings-password-text" class="grid-account-paragraph">Change Password</p>
                    <p id="grid-account-settings-nickname-text" class="grid-account-paragraph">Change Nickname</p>
                    <p id="grid-account-settings-email-text" class="grid-account-paragraph">Change Email</p>     
<!--                    <p id="grid-account-settings-notifications-text" class="grid-account-paragraph">Email Notifications</p>-->
                    
                    <?php
                    
                    // Check to make sure post fields arent empty
                    if(!empty($_POST['NEW_USERNAME'])) {

                        // Query the users
                        $QUERY_USER = mysqli_query($conn, "
                        
                        SELECT
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.email
                        FROM vx.accounts
                        WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';
                        
                        ");
                        
                        // Fetch results
                        $RESULT_USER = mysqli_fetch_array($QUERY_USER);
                        
                        // Check to see if username is the same
                        if($_POST['NEW_USERNAME'] == $RESULT_USER[1]) {
                            
                            // Username is the same
                            
                            echo '
                            
                                <p class="grid-settings-alert">Username is the same!</p>
                            
                            ';
                            
                        } else {
                            
                            // Username isnt the same

                            // Send the email
                            $EMAIL = mail($RESULT_USER[2], "VX: Username Change Request", "
                            
                                Greetings '" . $RESULT_USER[1] . "'.
                                
                                A username change request was requested from '" . $_SERVER['REMOTE_ADDR'] . "'.
                                
                                If this was you, please follow the link to follow up on the username change process.
                                
                                If this was not you, consider changing your account details in order to secure it.
                                
                                Username change request link: http://www.vxlabs.us/VX_Koth_v3/reset.php?Type=Username&Username='" . $_COOKIE['USERNAME'] . "'&Session='" . $_COOKIE['PHPSESSID'] . "'
                                
                                - VX Admin Team
                            
                            ", "From: admin@vxlabs.com");
                            
                            if($EMAIL == true) {
                                
                                echo '
                                
                                    <p class="grid-settings-alert">Email sent!</p>
                                
                                ';
                                
                            } else {
                                
                                echo '
                                
                                    <p class="grid-settings-alert">Error sending email!</p>
                                
                                ';
                                
                            }
                            
                        }

                    }

                    // Check to make sure post field isnt empty
                    if(!empty($_POST['NEW_PASSWORD'])) {

                        // Query the users
                        $QUERY_PASSWORD = mysqli_query($conn, "

                        SELECT
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.email,
                        vx.accounts.password
                        FROM vx.accounts
                        WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                        ");

                        // Fetch results
                        $RESULT_PASSWORD = mysqli_fetch_array($QUERY_PASSWORD);

                        // Check to see if password is the same
                        if($_POST['NEW_PASSWORD'] == $RESULT_PASSWORD[3]) {

                            // Password is the same

                            echo '

                                <p class="grid-settings-alert">Password is the same!</p>

                            ';

                        } else {

                            // Password isnt the same

                            // Send the email
                            $EMAIL = mail($RESULT_PASSWORD[2], "VX: Password Change Request", "

                                Greetings '" . $RESULT_PASSWORD[1] . "'.

                                A password change request was requested from '" . $_SERVER['REMOTE_ADDR'] . "'.

                                If this was you, please follow the link to follow up on the password change process.

                                If this was not you, consider changing your account details in order to secure it.

                                Password change request link: http://www.vxlabs.us/VX_Koth_v3/reset.php?Type=Password&Username='" . $_COOKIE['USERNAME'] . "'&Session='" . $_COOKIE['PHPSESSID'] . "'

                                - VX Admin Team

                            ", "From: admin@vxlabs.com");

                            if($EMAIL == true) {

                                echo '

                                    <p class="grid-settings-alert">Email sent!</p>

                                ';

                            } else {

                                echo '

                                    <p class="grid-settings-alert">Error sending email!</p>

                                ';

                            }
                            
                        }

                    }

                    // Check to make sure post field isnt empty
                    if(!empty($_POST['NEW_NICKNAME'])) {

                        // No auth required for nickname change
                        
                        // Create the query
                        $QUERY_SELECT_NICKNAME = mysqli_query($conn, "
                        
                        SELECT 
                        vx.accounts.id,
                        vx.accounts.nickname
                        FROM vx.accounts
                        WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';
                        
                        ");
                        
                        // Fetch the results
                        $RESULT_SELECT_NICKNAME = mysqli_fetch_array($QUERY_SELECT_NICKNAME);
                        
                        // Check to see if nicknames are the same
                        if($_POST['NEW_NICKNAME'] = $RESULT_SELECT_NICKNAME[1]) {
                            
                            // Nicknames the same
                            
                            echo '

                                <p class="grid-settings-alert">Nickname is the same!</p>

                            ';
                            
                            
                        } else {

                            // Nicknames not the same
                            
                            // Create the query
                            $QUERY_UPDATE_NICKNAME = mysqli_query($conn, "

                            UPDATE vx.accounts
                            SET vx.accounts.nickname = '" . $_POST['NEW_NICKNAME'] . "'
                            WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                            ");
                            
                        }

                    }

                    // Check to make sure post field isnt empty
                    
                    if(!empty($_POST['NEW_EMAIL'])) {
                        
                        // Query the users
                        $QUERY_EMAIL = mysqli_query($conn, "

                        SELECT
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.email
                        FROM vx.accounts
                        WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                        ");

                        // Fetch results
                        $RESULT_EMAIL = mysqli_fetch_array($QUERY_EMAIL);

                        // Check to see if email is the same
                        if($_POST['NEW_EMAIL'] == $RESULT_EMAIL[2]) {

                            // Email is the same

                            echo '

                                <p class="grid-settings-alert">Email is the same!</p>

                            ';

                        } else {

                            // Email isnt the same

                            // Send the email
                            $EMAIL = mail($RESULT_EMAIL[2], "VX: Email Change Request", "

                                Greetings '" . $RESULT_EMAIL[1] . "'.

                                A email change request was requested from '" . $_SERVER['REMOTE_ADDR'] . "'.

                                If this was you, please follow the link to follow up on the email change process.

                                If this was not you, consider changing your account details in order to secure it.

                                Email change request link: http://www.vxlabs.us/VX_Koth_v3/reset.php?Type=Email&Username='" . $_COOKIE['USERNAME'] . "'&Session='" . $_COOKIE['PHPSESSID'] . "'

                                - VX Admin Team

                            ", "From: admin@vxlabs.com");

                            if($EMAIL == true) {

                                echo '

                                    <p class="grid-settings-alert">Email sent!</p>

                                ';

                            } else {

                                echo '

                                    <p class="grid-settings-alert">Error sending email!</p>

                                ';

                            }
                            
                        }
                        
                    }
                    
                    ?>
                    
                </div>
                
                <!-- Account Web Controls -->
                <div id="grid-controls">
                   
                    <!-- Form -->
                    <form id="grid-form-account-controls" method="post"></form>
                    
                    <?php
                    
                    // Cookie check
                    
                    if($_COOKIE['NIGHTMODE'] == 'false' || !$_COOKIE['NIGHTMODE']) {
                    
                        // If in lightmode
                        
                        echo '
                    
                            <!-- Options -->
                            <p id="grid-controls-nightmode-text" class="grid-account-paragraph">Nightmode</p>
                        
                        ';
                        
                    } else if($_COOKIE['NIGHTMODE'] == 'true') {
                        
                        // If in nightmode
                        
                        echo '
                        
                            <!-- Options -->
                            <p id="grid-controls-nightmode-text" class="grid-account-paragraph">Lightmode</p>
                        
                        ';
                        
                    }
                        
                    ?>
                    
                </div>
                <script>
                
                    // Nightmode element check and cookie setter

                    // If element exists
                    if(document.getElementById("grid-controls-nightmode-text")) {

                        // Element exists

                        // Add event listner
                        document.getElementById("grid-controls-nightmode-text").addEventListener("click", function() {

                            // Clicked

                            // enabled var
                            var enabled = false;

                            // Check the textcontext
                            if(document.getElementById("grid-controls-nightmode-text").textContent == "Nightmode") {

                                // If currently in lightmode

                                enabled = true;

                                // Set the cookie
                                document.cookie ="NIGHTMODE = true; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";

                                // Change text context
                                document.getElementById("grid-controls-nightmode-text").textContent = "Lightmode";
                                
                                // Redirect
                                window.open('account.php', '_self');

                            } else if(document.getElementById("grid-controls-nightmode-text").textContent == "Lightmode") {

                                // If currently in nightmode

                                enabled = false;

                                // Set the cookie
                                document.cookie = "NIGHTMODE = false; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";

                                // Change text context
                                document.getElementById("grid-controls-nightmode-text").textContent = "Nightmode";
                                
                                // Redirect
                                window.open('account.php', '_self');
                                
                            }

                        }, false);

                    }
                
                </script>
                
                <!-- Account Other Settings-->
                <div id="grid-other">

                    <!-- Form -->
                    <form id="grid-form-account-other" method="post"></form>

                   <?php
                    
                    // Check if steam is already linked
                    
                    // Query
                    $QUERY_PLAYERID = mysqli_query($conn, "
                    
                    SELECT vx.accounts.playerID
                    FROM vx.accounts
                    WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';
                    
                    ");
                    
                    // Fetch the results
                    $RESULT_PLAYERID = mysqli_fetch_array($QUERY_PLAYERID);
                    
                    // Check for player id
                    if(isset($RESULT_PLAYERID[0])) {
                        
                        // PlayerID is set
                        
                    } else {
                        
                        // PlayerID isnt set
                        
                        echo '

                            <!-- Options -->
                            <p id="grid-other-steam-text" class="grid-account-paragraph"><a id="grid-other-steam-link" href="?login">Link Steam</a></p>

                        ';
                        
                    }
                        
                        
                    ?>
                        
<!--
                    <p id="grid-other-vxcoin-text" class="grid-account-paragraph">Purchase VX Coin</p>
                    <p id="grid-other-membership-text" class="grid-account-paragraph">Purchase VX Membership</p>
-->
                    
                </div>
           
            </div>
            
            <!-- Footer -->
            <div id="grid-footer">

                <!-- Logos and Association-->
                <img id="grid-footer-vx-logo" src="http://vxlabs.us/VX_Koth_v3/img/VXLogo.png">
                <img id="grid-footer-armahosts-logo" src="http://vxlabs.us/VX_Koth_v3/img/ArmaHosts.png">

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

                    <img id="grid-footer-facebook-logo" class="grid-footer-logos" src="http://vxlabs.us/VX_Koth_v3/img/FacebookLogo.png">
                    <img id="grid-footer-twitter-logo" class="grid-footer-logos" src="http://vxlabs.us/VX_Koth_v3/img/TwitterLogo.png">
                    <img id="grid-footer-youtube-logo" class="grid-footer-logos" src="http://vxlabs.us/VX_Koth_v3/img/YoutubeLogo.png">
                    <img id="grid-footer-discord-logo" class="grid-footer-logos" src="http://vxlabs.us/VX_Koth_v3/img/DiscordLogo.png">

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
                        if(document.getElementById("grid-other-steam-link")) {

                            // Change colour
                            document.getElementById("grid-other-steam-link").style.color = "#FFFFFF";

                        }

                        // Set header colour incase it was changed
                        document.getElementsByClassName("grid-user-display")[0].style.color = "#FFFFFF";
                        document.getElementsByClassName("grid-account-managment")[1].style.color = "#FFFFFF";

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
                        if(document.getElementById("grid-other-steam-link")) {
                        
                            // Change colour
                            document.getElementById("grid-other-steam-link").style.color = "#000000";
                        
                        }

                        // Set header colour incase it was changed
                        document.getElementsByClassName("grid-user-display")[0].style.color = "#FFFFFF";
                        document.getElementsByClassName("grid-account-managment")[1].style.color = "#FFFFFF";

                    }

                </script>

            ';

        }

        ?>
   
    </body>
</html>