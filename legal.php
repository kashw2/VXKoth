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
        <link rel="stylesheet" href="css/legal.css">
       
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
                            accounts.id,
                            accounts.username,
                            accounts.ip
                            FROM vx.accounts
                            WHERE accounts.username = '" . $_COOKIE['USERNAME'] . "';

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

               <?php
                
                // URL part checks
               
                // Echo basic legal
                echo '
                
                    <!-- Basic -->
                    <div id="grid-legal-basic">

                        <h1 id="grid-legal-heading-basic">VX Labs Legal</h1>
                        <p class="grid-legal-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum elementum viverra orci, sed malesuada nisi volutpat vitae. Pellentesque vel eros egestas, dapibus arcu feugiat, venenatis nisl. Nam scelerisque purus eget lectus bibendum vestibulum. Donec posuere libero dui, a pretium arcu tempor non. Integer egestas nulla ac consectetur laoreet. Suspendisse imperdiet non sem quis aliquet. Quisque ut nulla orci. Donec eleifend lacinia orci, ac semper massa imperdiet at. Mauris id auctor lacus, ac tempus ante. Etiam egestas purus libero, at accumsan neque posuere a. In sit amet tortor quis erat consectetur blandit. Sed varius enim eu nulla bibendum, lobortis molestie urna molestie. Donec viverra augue urna, scelerisque consequat nunc molestie vel. Aenean vestibulum mi blandit enim viverra dignissim. Donec vehicula est a varius elementum..</p>

                    </div>
                
                ';
                
                // Check part
                if($_GET['part'] == 'Copyright') {
               
                // Part is copyright   
                 
                echo '
                    
                    <!-- Copyright -->
                    <div id="grid-legal-copyright" class="data-part" data-part="true">

                        <h1 id="grid-legal-heading-copyright">Copyright</h1>
                        <p class="grid-legal-paragraph">Sed placerat tempus posuere. Duis odio odio, facilisis nec faucibus in, efficitur et augue. Pellentesque consectetur dolor risus, quis eleifend lorem suscipit nec. Aliquam molestie est ac nisl vulputate posuere. Etiam et massa libero. Sed bibendum porta tempor. Etiam mollis tristique mattis. Sed mattis, tortor et luctus tempor, ante eros bibendum nibh, sit amet porttitor libero tortor ut nisi.</p>

                    </div>
                
                ';
                    
                } else {
                    
                    // Part isnt copyright
                    
                    echo '

                    <!-- Copyright -->
                    <div id="grid-legal-copyright">

                        <h1 id="grid-legal-heading-copyright">Copyright</h1>
                        <p class="grid-legal-paragraph">Sed placerat tempus posuere. Duis odio odio, facilisis nec faucibus in, efficitur et augue. Pellentesque consectetur dolor risus, quis eleifend lorem suscipit nec. Aliquam molestie est ac nisl vulputate posuere. Etiam et massa libero. Sed bibendum porta tempor. Etiam mollis tristique mattis. Sed mattis, tortor et luctus tempor, ante eros bibendum nibh, sit amet porttitor libero tortor ut nisi.</p>

                    </div>

                ';
                    
                } 
                
                // Check part
                if($_GET['part'] == 'Contact') {
                
                    // Part is contact
                    
                    echo '
                    
                        <!-- Contact -->
                        <div id="grid-legal-contact" class="data-part" data-part="true">

                            <h1 id="grid-legal-heading-contact">Contact</h1>
                            <p class="grid-legal-paragraph">In euismod at eros sit amet dictum. Morbi id metus pellentesque, blandit libero at, egestas lacus. Fusce fermentum sapien sed mauris sagittis elementum. Aenean consequat enim sed arcu porttitor, non ultrices nibh semper. Etiam id enim lobortis, eleifend justo id, finibus ante. Proin a urna eleifend, fringilla justo non, congue ligula. Vivamus in turpis iaculis, ultrices mi in, ornare urna. Curabitur quis pellentesque orci. In quis ligula fermentum, commodo purus ut, volutpat ante. Ut et tincidunt tellus, a hendrerit ante. Pellentesque massa libero, finibus et faucibus vitae, bibendum sed nibh. Nullam ac consectetur erat, eget ullamcorper tellus. Integer eu diam ac est mattis bibendum. In id hendrerit massa. Etiam ipsum lacus, aliquam vel facilisis non, tristique eu arcu.</p>

                        </div>
                    
                    ';
                    
                } else {
                    
                    // Part isnt contact
                    
                    echo '

                        <!-- Contact -->
                        <div id="grid-legal-contact">

                            <h1 id="grid-legal-heading-contact">Contact</h1>
                            <p class="grid-legal-paragraph">In euismod at eros sit amet dictum. Morbi id metus pellentesque, blandit libero at, egestas lacus. Fusce fermentum sapien sed mauris sagittis elementum. Aenean consequat enim sed arcu porttitor, non ultrices nibh semper. Etiam id enim lobortis, eleifend justo id, finibus ante. Proin a urna eleifend, fringilla justo non, congue ligula. Vivamus in turpis iaculis, ultrices mi in, ornare urna. Curabitur quis pellentesque orci. In quis ligula fermentum, commodo purus ut, volutpat ante. Ut et tincidunt tellus, a hendrerit ante. Pellentesque massa libero, finibus et faucibus vitae, bibendum sed nibh. Nullam ac consectetur erat, eget ullamcorper tellus. Integer eu diam ac est mattis bibendum. In id hendrerit massa. Etiam ipsum lacus, aliquam vel facilisis non, tristique eu arcu.</p>

                        </div>

                    ';
                    
                }
                
                if($_GET['part'] == 'Privacy') {
                    
                    // Part is privacy
                    
                    echo '
                    
                        <!-- Privacy -->
                        <div id="grid-legal-privacy" class="data-part" data-part="true">

                            <h1 id="grid-legal-heading-privacy">Privacy</h1>
                            <p class="grid-legal-paragraph">Pellentesque dapibus velit nec quam ullamcorper posuere. Sed id volutpat arcu. Nullam posuere odio congue dui feugiat feugiat. Nam placerat tempor ipsum, a ultricies felis luctus vitae. Sed a tellus at nisi pulvinar imperdiet eu ac leo. Quisque dapibus suscipit libero, aliquam sagittis justo condimentum a. Ut sed turpis ac elit tempor maximus ac nec diam. Nunc ac blandit ligula, eget interdum nulla. Donec et elementum risus. Morbi venenatis arcu eget ultrices condimentum.</p>

                        </div>
                    
                    ';
                    
                } else {
                    
                    // Part isnt privacy
                    
                    echo '

                        <!-- Privacy -->
                        <div id="grid-legal-privacy">

                            <h1 id="grid-legal-heading-privacy">Privacy</h1>
                            <p class="grid-legal-paragraph">Pellentesque dapibus velit nec quam ullamcorper posuere. Sed id volutpat arcu. Nullam posuere odio congue dui feugiat feugiat. Nam placerat tempor ipsum, a ultricies felis luctus vitae. Sed a tellus at nisi pulvinar imperdiet eu ac leo. Quisque dapibus suscipit libero, aliquam sagittis justo condimentum a. Ut sed turpis ac elit tempor maximus ac nec diam. Nunc ac blandit ligula, eget interdum nulla. Donec et elementum risus. Morbi venenatis arcu eget ultrices condimentum.</p>

                        </div>

                    ';
                    
                }
                
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