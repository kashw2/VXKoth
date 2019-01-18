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

        <link rel="stylesheet" href="css/player.css">
        <link rel="stylesheet" href="css/globals.css">

        <script src="javascript/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="ajax/playerLoad.js"></script>
       
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

                        // User is an admin and ip matches as well as account id for extra security
                        if($RESULT_ALL_USERS[3] == 1 && $RESULTS_ALL_USERS[2] = $_SERVER['REMOTE_ADDR'] && $_SESSION['USERID'] == $RESULT_ALL_USERS[0]) {

                            echo '

                                <p class="grid-user-display">Logged in as: ' . $_COOKIE['USERNAME'] . ' <a href="admin.php">(Admin)</a></p>

                            ';

                        } else {

                            // User is not an admin

                            // Check the user
                            if($RESULT_ALL_USERS[1] == $_COOKIE['USERNAME'] && $_SESSION['USERID'] == $RESULT_ALL_USERS[0])

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
                vx.accounts.ip
                FROM vx.accounts
                WHERE vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';

                ");

                // Fetch the results
                $RESULT_ALL_USERS = mysqli_fetch_array($QUERY_ALL_USERS);

                if(!isset($_COOKIE['USERNAME']) || $RESULT_ALL_USERS[0] != $_SESSION['USERID']) {

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
                            vx.accounts.password
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

                                // If post username was email
                                if($_POST['USERNAME'] == $RESULT_ALL_USERS[2]) {

                                    // Set the cookie
                                    setcookie("USERNAME", $RESULT_ALL_USERS[1], time() + (86400 * 30), "/");

                                    // Set session user id
                                    $_SESSION['USERID'] = $RESULT_ALL_USERS[0];

                                } else if($RESULT_ALL_USERS[1] == $_POST['USERNAME']) {

                                    // Set the cookie
                                    setcookie("USERNAME", $RESULT_ALL_USERS[1], time() + (86400 * 30), "/");        

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
                
                <?php
               
//                if(isset($_GET['PLAYER_STEAMID']) || isset($_GET['PLAYER_GUID'])) {
                
                    // Get request set and info requested
                    
                    // Query
                    $QUERY_MEMBERSHIP_CHECK = mysqli_query($conn, "
                    
                    SELECT
                    vx.accounts.id,
                    vx.accounts.membershipLevelID
                    FROM vx.accounts
                    WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "' AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "';
                    
                    ");
                    
                    // Fetch the results
                    $RESULT_MEMBERSHIP_CHECK = mysqli_fetch_array($QUERY_MEMBERSHIP_CHECK);
                    
//                    if(isset($_GET['PLAYER_STEAMID']) && empty($_GET['PLAYER_GUID'])) {
                    
                        echo '

                                <!-- Heading Container -->
                                <div id="grid-content-headings">

                            ';
                        
                        // Control membership level requirements here                        
                        if($RESULT_MEMBERSHIP_CHECK[1] > 1) {

                            echo '
                                
                                <p id="grid-heading-career" class="grid-headings">CAREER</p>

                            ';

                        }

                        if($RESULT_MEMBERSHIP_CHECK[1] > 2) {

                            echo '

                                <p id="grid-heading-weapons" class="grid-headings">WEAPONS</p>

                            ';

                        }

                        if($RESULT_MEMBERSHIP_CHECK[1] > 3) {

                            echo '

                                <p id="grid-heading-squads" class="grid-headings">SQUADS</p>
                                <p id="grid-heading-clans" class="grid-headings">CLANS</p>

                            ';

                        }

                        if($RESULT_MEMBERSHIP_CHECK[1] > 4) {

                            echo '

                                <p id="grid-heading-seasons" class="grid-headings">SEASONS</p>

                            ';

                        }

                        if($RESULT_MEMBERSHIP_CHECK[1] > 5) {

                            echo '

                            ';

                        }


                        // Create the data container
                        echo '
                            
                            </div>

                            <!-- Data Container -->
                            <div id="grid-data" value="' . $_GET['PLAYER_STEAMID'] . '">
                                
                                <form id="grid-form-search-uid" method="get"></form>
                                <form id="grid-form-search-guid" method="get"></form>

                                <input id="grid-search-uid" class="grid-input" type="text" name="PLAYER_STEAMID" placeholder="Steam ID64" form="grid-form-search-uid">
                                <input id="grid-search-guid" class="grid-input" type="text" name="PLAYER_GUID" placeholder="BE ID / GUID" form="grid-form-search-guid">
                                <input class="grid-search-submit" type="submit" value="Ok" form="grid-form-search-uid">
                                <input class="grid-search-submit" type="submit" value="Ok" form="grid-form-search-guid">
                            
                            </div>

                        ';
                
//                    }
                
                ?>
           
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