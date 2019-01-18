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

// Redirect if logged in
if(isset($_COOKIE['USERNAME'])) {
    
    // Redirect to landing page
    header('Location: index.php');
    
}

?>
<html>
    <head>

        <link rel="stylesheet" href="css/register.css">
        <link rel="stylesheet" href="css/globals.css">

        <script src="javascript/script.js"></script>

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

                    <?php

                    // If cookie exists and is set
                    if($_COOKIE['USERNAME']) {

                        // User exists

                        // Query
                        $QUERY_ALL_USERS = mysqli_query($conn, "

                        SELECT 
                        accounts.id,
                        accounts.username,
                        accounts.ip,
                        accounts.admin,
                        accounts.permissionArray
                        FROM vx.accounts
                        WHERE accounts.username = '" . $_COOKIE['USERNAME'] . "';

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

                <h1 id="grid-heading-welcome">WELCOME</h1>
              
               <!-- Registration -->
               <div id="grid-register-container">
                   
                   <!-- Registration Information -->
                   <div id="grid-registration-informative">
                       
                       <p>* Mark Required Fields</p>
                       
                   </div>
                    
                   <form id="grid-registration-form" method="post"></form>
                    
                   <input id="grid-input-email" class="grid-register-form" type="email" name="EMAIL" form="grid-registration-form" placeholder="Email *" maxlength="50">
                   <input id="grid-input-username" class="grid-register-form" type="text" name="USERNAME" form="grid-registration-form" placeholder="Username *" maxlength="32">
                   <input id="grid-input-password" class="grid-register-form" type="password" name="PASSWORD" form="grid-registration-form" placeholder="Password *" maxlength="32">
                    
                    <h1 id="grid-heading-register">REGISTER!</h1>
                    
                    <?php
                   
                    // Registration
                   
                    // Make sure post fields arent empty
                   if(!empty($_POST['EMAIL']) && !empty($_POST['USERNAME']) && !empty($_POST['PASSWORD'])) {
                            
                        // Post fields arent empty

                        // Query list of current users
                        $QUERY_ALL_USERS = mysqli_query($conn, "

                        SELECT
                        vx.accounts.id,
                        vx.accounts.username,
                        vx.accounts.email,
                        vx.accounts.salt
                        FROM vx.accounts
                        WHERE vx.accounts.username = '" . $_POST['USERNAME'] . "'
                        OR vx.accounts.email = '" . $_POST['EMAIL'] . "';

                        ");

                        // Fetch the results
                        $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);

                        // Check to make sure the account doesnt already exist
                        if($RESULT_ALL_USERS[1] == $_POST['USERNAME']) {

                            // Username is taken

                            echo '

                                <p class="grid-registration-response-error">The Username "' . $_POST['USERNAME'] . '" is already in use</p>

                            ';

                        } else if($RESULT_ALL_USERS[2] == $_POST['EMAIL']) {

                            // Email is already in use
                            
                            echo '

                                <p class="grid-registration-response-error">The Email "' . $_POST['EMAIL'] . '" is already in use</p>

                            ';

                        } else {

                            // Proceed to account creation

                            // Create the account
                            $QUERY_INSERT_ACCOUNT = mysqli_query($conn, "

                            INSERT INTO vx.accounts (

                            vx.accounts.id,
                            vx.accounts.username,
                            vx.accounts.email,
                            vx.accounts.password,
                            vx.accounts.salt,
                            vx.accounts.ip,
                            vx.accounts.membershipLevelID,
                            vx.accounts.registered,
                            vx.accounts.lastUpdate

                            ) VALUES (

                            DEFAULT, 
                            '" . $_POST['USERNAME'] . "',
                            '" . $_POST['EMAIL'] . "',
                            '" . md5($_POST['PASSWORD']) . "',
                            '" . $conn->escape_string(md5($_POST['EMAIL'])) . "',
                            '" . $_SERVER['REMOTE_ADDR'] . "',
                            1,
                            DEFAULT,
                            DEFAULT

                            );

                            ");
                            
                            if($QUERY_INSERT_ACCOUNT == TRUE) {
                                
                                // Account created
                                
                                echo '

                                    <p class="grid-registration-response-success">Account created successfully</p>

                                ';
                                
                                // Set the cookie so the user stays logged in on redirect
                                setcookie("USERNAME", $_POST['USERNAME'], time() + (86400 * 30), "/");
                                
                                // Set session user id
                                $_SESSION['USERID'] = $RESULT_ALL_USERS[0];
                                
                            } else {
                                
                                // Error creating account
                                
                                echo '

                                    <p class="grid-registration-response-error">Account creation error!</p>

                                ';                            
                                
                            }

                        }

                    } else {

                        // Post fields are empty

                        echo '

                                <p class="grid-registration-response-error">Fields marked with * are required</p>

                            ';

                    }
                   
                   ?>
                    
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