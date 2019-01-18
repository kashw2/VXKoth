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

// Generate random hash
//$HASH = bin2hex(random_bytes(32));

// Require
require_once('mysql.php');

?>
<html>
    <head>
        
        <link rel="stylesheet" href="css/index.css">
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
                                
                                // Check session userid and cookie set
                                if(!$_SESSION['USERID'] && $_COOKIE['USERNAME']) {
                                    
                                    header('Location: index.php');
                                    
                                } else {

                                    echo '

                                        <div id="grid-account-options">

                                            <p id="grid-register" class="grid-account-managment"><a href="register.php">Register</a></p>

                                        </div>

                                    ';

                                }
                                    
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
                        
                        // User is an admin and ip matches as well as account id for extra security
                        if(
                            $RESULT_ALL_USERS[3] == 1 
                            && $RESULT_ALL_USERS[2] == $_SERVER['REMOTE_ADDR']
                            && $_SESSION['USERID'] == $RESULT_ALL_USERS[0]
                        ) {
                            
                            echo '
                            
                                <p class="grid-user-display">Logged in as: ' . $_COOKIE['USERNAME'] . ' <a href="admin.php">(Admin)</a></p>
                                
                            ';
                            
                        } else {
                        
                            // User is not an admin
                        
                            // Check the user
                            if(
                                $RESULT_ALL_USERS[1] == $_COOKIE['USERNAME'] 
                                && $_SESSION['USERID'] == $RESULT_ALL_USERS[0]
                              )
                            
                            echo '

                                <p class="grid-user-display">Logged in as: ' . $_COOKIE['USERNAME'] . '</p>

                            ';
                            
                        }
                            
                    } else {
                        
                        // Cookie either doesnt exist or isnt set
                        
                    }
                    
                ?>
                    
                </div>
                    
                <?php

                // Query
                $QUERY_ALL_USERS = mysqli_query($conn, "

                SELECT 
                vx.accounts.id,
                vx.accounts.username,
                vx.accounts.ip,
                vx.accounts.salt
                FROM vx.accounts
                WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                ");

                // Fetch the results
                $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);
                
                // Check post values are set
                if(
                    isset($_COOKIE['USERNAME'])
                    && isset($_COOKIE['319f4d26e3c536b5dd871bb2c52e3178']) 
                    && !isset($_SESSION['USERID'])
                )   {
                    
                        // Query
                        $QUERY_SESSIONID = mysqli_query($conn, "

                        SELECT 
                        vx.accounts.id
                        FROM vx.accounts
                        WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "'
                        AND vx.accounts.password = '" . str_replace($RESULT_ALL_USERS[3], " ", $_COOKIE['319f4d26e3c536b5dd871bb2c52e3178']) . "';

                        ");

                        // Fetch the results
                        $RESULT_SESSIONID = mysqli_fetch_array($QUERY_SESSIONID);
                        
                        // Set the session value
                        $_SESSION['USERID'] = $RESULT_SESSIONID[0];
                        
                }
                
                if(
                    !isset($_COOKIE['USERNAME']) 
                    || $RESULT_ALL_USERS[0] != $_SESSION['USERID']
                  ) {
                    
                    echo '

                        <!-- Account Login -->
                        <div id="grid-account-login">

                            <form id="grid-form-login" method="post" action="index.php"></form>

                            <input id="grid-login-username" type="text" name="USERNAME" placeholder="Username" form="grid-form-login">
                            <input id="grid-login-password" type="password" name="PASSWORD" placeholder="Password" form="grid-form-login">

                        </div>

                    ';    

                    // Make sure post fields arent empty
                    if(!empty($_POST['USERNAME']) && !empty($_POST['PASSWORD'])) {

                        // Make sure both post fields are set
                        if(isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])) {

                            // Query accounts
                            $QUERY_ALL_USERS = mysqli_query($conn, "

                            SELECT
                            vx.accounts.id,
                            vx.accounts.username,
                            vx.accounts.email,
                            vx.accounts.password,
                            vx.accounts.salt
                            FROM vx.accounts

                            ");

                            // Fetch the results
                            $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);

                            // Check account actually exists
                            if(
                                $RESULT_ALL_USERS[1] == $_POST['USERNAME']
                                || $RESULT_ALL_USERS[2] == $_POST['USERNAME']
                                && $RESULT_ALL_USERS[3] == md5($_POST['PASSWORD'])
                            ) {
                                
                                // Account exists
                                
                                // Add salt to password
                                $PASSWORD = md5($_POST['PASSWORD']) . $RESULT_ALL_USERS[4];
                                
                                // If post username was email
                                if($_POST['USERNAME'] == $RESULT_ALL_USERS[2]) {
                                    
                                    // Set the cookie
                                    setcookie("USERNAME", $RESULT_ALL_USERS[1], time() + (86400 * 30), "/");
                                    
                                    // Set password cookie
                                    setcookie(md5("PASSWORD"), $PASSWORD , time() + (86400 * 30), "/");
                                    
                                    // Set session user id
                                    $_SESSION['USERID'] = $RESULT_ALL_USERS[0];
                                    
                                } else if($RESULT_ALL_USERS[1] == $_POST['USERNAME']) {
                                    
                                    // Set the cookie
                                    setcookie("USERNAME", $RESULT_ALL_USERS[1], time() + (86400 * 30), "/");      
                                    
                                    // Set password cookie
                                    setcookie(md5("PASSWORD"), $PASSWORD, time() + (86400 * 30), "/");
                                    
                                    // Set session user id
                                    $_SESSION['USERID'] = $RESULT_ALL_USERS[0];
                                    
                                }
                                
                                // Redirect to make sure the cookie is loaded to the client
                                header('Location: index.php');
                                
                            } else {
                                
                                // Account doesnt exist
                                
                            }

                        } else {
                            
                            // Fields arent set
                            
                        }

                    } else {
                        
                        // Posts are empty
                        
                    }

                }

                ?>
                
            </div>
            
            <!-- Content -->
            <div id="grid-content">
                
                <!-- Headings -->
                <h1 id="grid-welcome">Welcome</h1>
                <h1 id="grid-heading-area1">Heading 1</h1>
                <h1 id="grid-heading-area2">Heading 2</h1>
                
                <!-- Paragraphs -->
                <p id="grid-text-area1" class="grid-landing-text">First and foremost, Welcome to VX Gaming. This is our user player panel. This serves as the place where you can get all the information regarding to your time at VX Gaming. All your information that we've gathered over the course of your gaming time spent on VX servers whether it be VX Labs KotH, VX Labs Escape From Tanoa, VX Labs Escape From Altis or any other mission that we offer or provide. At VX we aim and we strive to bring you the best player and user experience we can. We do so by offering quality servers, quality staff assistance and overall just a quality user experience.  </p>
                <p id="grid-text-area2" class="grid-landing-text">Mauris semper velit eu mattis bibendum. Aenean eu est non neque lobortis tincidunt id eu odio. Donec interdum efficitur semper. Duis urna dui, condimentum sed accumsan nec, egestas id neque. Cras tincidunt dapibus faucibus. Etiam sit amet tellus a enim consequat interdum. Cras bibendum elit ante, vel luctus eros luctus a. Vestibulum felis elit, tempus non arcu nec, tempus dapibus est. Aenean vitae laoreet felis. Suspendisse euismod ut felis vel hendrerit. Etiam tristique libero eget pellentesque bibendum. Donec euismod vel sapien a blandit. Ut eleifend dolor eget lectus pretium elementum. Cras faucibus nulla ac dapibus cursus. Integer velit lorem, finibus ut pellentesque et, sollicitudin quis ante. Suspendisse vehicula neque vitae magna porttitor tincidunt. Cras justo nisi, cursus sit amet nisi vitae, vehicula blandit risus. Nullam finibus tincidunt odio, vel varius nisl. Phasellus pellentesque leo sed varius tempus. Ut eu lorem elit. Pellentesque ut nulla malesuada, dapibus lacus vel, mattis massa. In hac habitasse platea dictumst. Curabitur interdum elit nec tincidunt commodo. Cras dictum ligula vitae augue eleifend pellentesque. Morbi eu diam et felis suscipit efficitur in a massa.</p>
                <p id="grid-text-area3" class="grid-landing-text">Quisque eu libero eget ligula interdum vestibulum sit amet ac tellus. Etiam fringilla laoreet augue, eu tincidunt est accumsan quis. Aliquam hendrerit lacus a augue euismod pretium. Proin ac nisl quis elit ornare vulputate ac elementum purus. Donec non dignissim orci. Praesent ultrices mauris risus, non porttitor dui convallis nec. Proin et eleifend nibh. Phasellus commodo pellentesque viverra. Donec ut nunc erat. Donec ipsum erat, sodales vel mi non, maximus consectetur magna. Aliquam ac leo ipsum. Nullam nec pellentesque ligula. Cras semper sollicitudin eros quis sagittis. Sed ultrices fermentum mattis. Curabitur quis pretium nibh. Curabitur auctor ultrices mauris. Nam fermentum faucibus nibh vel auctor. Curabitur suscipit venenatis eros. Phasellus interdum luctus augue eu congue. Praesent nec consectetur tortor. Integer convallis ut dui in volutpat. Aenean sed augue eu tellus fringilla egestas. Aliquam et purus et libero finibus accumsan. Integer urna sem, scelerisque ut hendrerit non, venenatis sed leo. Vivamus mi est, convallis sit amet lacus a, molestie ultrices mi. Donec malesuada lacinia ipsum id aliquet. Aenean consectetur sollicitudin mi, pellentesque pretium enim fermentum quis.</p>
                
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