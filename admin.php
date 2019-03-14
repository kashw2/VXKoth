<?php

//   ___      ___ ___  ___      ___           __      _______   ________  
//  |"  \    /"  |"  \/"  |    |"  |         /""\    |   _  "\ /"       ) 
//   \   \  //  / \   \  /     ||  |        /    \   (. |_)  :(:   \___/  
//    \\  \/. ./   \\  \/      |:  |       /' /\  \  |:     \/ \___  \    
//     \.    //    /\.  \       \  |___   //  __'  \ (|  _  \\  __/  \\   
//      \\   /    /  \   \     ( \_|:  \ /   /  \\  \|: |_)  :)/" \   :)  
//       \__/    |___/\___|     \_______(___/    \___(_______/(_______/  
//
// Unapproved use, modification and redistribution of this code and respective product is strictly prohibited.
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

        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/globals.css">
       
        <script src="javascript/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        
        <script src="ajax/adminLoad.js"></script>

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
                            if($RESULT_ALL_USERS[1] == $_COOKIE['USERNAME'] && $_SESSION['USERID'] == $RESULT_ALL_USERS[0]) {

                                // Redirect
                                header('Location: index.php');
                                
                            }

                        }

                    } else {

                        // Cookie either doesnt exist or isnt set
                        
                        // Redirect
                        header('Location: index.php');

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

                    // Redirect to index.php
                    header('Location: index.php');

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
                
                // Query
                
                $QUERY_USER_CLAN = mysqli_query($conn, "
                
                SELECT
                vx.accounts.username,
                vx.accounts.clanID,
                vx.accounts.clanRankID,
                vx.clans.name,
                vx.clans.abbreviation,
                vx.clanRanks.name
                FROM vx.accounts
                INNER JOIN vx.clans ON vx.accounts.clanID = (

                SELECT
                vx.accounts.clanID
                FROM vx.accounts
                WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "'
                AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "'

                )
                INNER JOIN vx.clanRanks ON vx.accounts.clanRankID = (

                SELECT DISTINCT
                vx.accounts.clanRankID
                FROM vx.accounts
                WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "'
                AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "'
                AND vx.accounts.clanRankID = vx.clanRanks.id

                )
                LIMIT 1;
                
                ");
                
                // Fetch results
                $RESULT_USER_CLAN = mysqli_fetch_array($QUERY_USER_CLAN);
                
                // If they have a clan
                if(isset($RESULT_USER_CLAN[1])) {
                
                    // They are part of a community
                    
                    // Check to make sure they're not just a member
                    if(
                        $RESULT_USER_CLAN[2] <= 1
                        || $RESULT_USER_CLAN[5] == "Member"
                    ) {
                        
                        // Redirect
                        header('Location: index.php');
                        
                    }
                    
                    echo '

                        <h3 id="grid-welcome">Welcome ' . $RESULT_USER_CLAN[0] . ' [' . $RESULT_USER_CLAN[4] . ']</h3>
                        <h3 id="grid-clanrank">' . $RESULT_USER_CLAN[5] . 's Panel</h3>

                        <!-- Headings -->
                        <div id="grid-heading-options">';

                    // Community staff checks
                    
                    if($RESULT_USER_CLAN[2] == 2) {
                        
                        // Recruiter
                        
                        echo '
                        
                            <p id="grid-heading-memberships" class="grid-headings">Memberships</p>
                            <p id="grid-heading-events" class="grid-headings">Events</p>
                        
                            <div id="grid-heading-underline"></div>
                        
                        ';
                        
                    }
                    
                    if($RESULT_USER_CLAN[2] == 3) {
                        
                        // Game Admin
                        
                        echo '

                            <p id="grid-heading-memberships" class="grid-headings">Memberships</p>
                            <p id="grid-heading-events" class="grid-headings">Events</p>
                            <p id="grid-heading-vxbans" class="grid-headings">VX Bans</p>

                            <div id="grid-heading-underline"></div>

                        ';
                        
                    }
                    
                    if($RESULT_USER_CLAN[2] == 4) {
                        
                        // Server Admin
                        
                        echo '

                            <p id="grid-heading-memberships" class="grid-headings">Memberships</p>
                            <p id="grid-heading-events" class="grid-headings">Events</p>
                            <p id="grid-heading-vxbans" class="grid-headings">VX Bans</p>
                            <p id="grid-heading-servers" class="grid-headings">Servers</p>

                            <div id="grid-heading-underline"></div>

                        ';                        
                        
                    }
                    
                    if($RESULT_USER_CLAN[2] == 5) {
                        
                        // Senior Admin
                        
                        echo '

                            <p id="grid-heading-memberships" class="grid-headings">Memberships</p>
                            <p id="grid-heading-events" class="grid-headings">Events</p>
                            <p id="grid-heading-vxbans" class="grid-headings">VX Bans</p>
                            <p id="grid-heading-servers" class="grid-headings">Servers</p>
                            <p id="grid-heading-administration" class="grid-headings">Administration</p>

                            <div id="grid-heading-underline"></div>

                        ';
                        
                    }
                    
                    if($RESULT_USER_CLAN[2] == 6) {
                        
                        // Owner
                        
                        echo '

                            <p id="grid-heading-memberships" class="grid-headings">Memberships</p>
                            <p id="grid-heading-events" class="grid-headings">Events</p>
                            <p id="grid-heading-vxbans" class="grid-headings">VX Bans</p>
                            <p id="grid-heading-servers" class="grid-headings">Servers</p>
                            <p id="grid-heading-administration" class="grid-headings">Administration</p>
                            
                            <div id="grid-heading-underline"></div>

                        ';
                        
                    }

                    echo '

                        </div>

                    <div id="grid-data"></div>

                    ';
                    
                }
                
                ?>
           
            </div>
            
            <?php
            
            // Server/Database modifications are done in here.
            
            // jQuery .load only returns html not php so unable to do database and table alterations unless a result is found in that script
            
            // Alter server name
            
            ?>

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

                <script src="javascript/clientNightmode.js"></script>

            ';

        } else if($_COOKIE['NIGHTMODE'] == 'false') {

            echo '

                <script src="javascript/clientLightmode.js"></script>

            ';

        }

        ?>

    </body>
</html>