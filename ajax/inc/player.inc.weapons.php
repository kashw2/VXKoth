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

// Reset include path
set_include_path($_SERVER['DOCUMENT_ROOT'] . '/VX_Koth_v3/');

// Require
require_once('mysql.php');
require_once('funcs/client/playerCheck.php');

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

if($_POST['Selection'] == "Weapons") {

    // Weapons selected

    $_SESSION['LIMIT'] = $_POST['Limit'];

    // Check that the limit has set
    if(isset($_SESSION['LIMIT'])) {

        $LIMIT = $_SESSION['LIMIT'];
        $LIMITED = $LIMIT - 25;

        // Query
        $QUERY_PLAYERS_WEAPONS = mysqli_query($conn, "

        SELECT DISTINCT
        vx.players.name, 
        vx.players.pid, 
        vx.players.guid,
        vx.gunStats.gunName,
        vx.gunStats.kills,
        vx.gunStats.shotsFired,
        vx.gunStats.shotsHit
        FROM vx.players
        INNER JOIN vx.gunStats ON vx.players.id = vx.gunStats.playerID 
        WHERE vx.players.guid != ''
        AND vx.players.pid != ''
        ORDER BY vx.gunStats.kills DESC
        LIMIT 20 OFFSET $LIMITED;

        ");

    } else {

        // Unset the count
        unset($_SESSION['COUNT']);

        // Query
        $QUERY_PLAYERS_WEAPONS = mysqli_query($conn, "

        SELECT DISTINCT
        vx.players.name, 
        vx.players.pid, 
        vx.players.guid,
        vx.gunStats.gunName,
        vx.gunStats.kills,
        vx.gunStats.shotsFired,
        vx.gunStats.shotsHit
        FROM vx.players
        INNER JOIN vx.gunStats ON vx.players.id = vx.gunStats.playerID 
        WHERE vx.players.guid != ''
        AND vx.players.pid != ''
        ORDER BY vx.gunStats.kills DESC
        LIMIT 20;

        ");

    }

    // Fetch Results
    $RESULT_PLAYERS_WEAPONS = mysqli_fetch_array($QUERY_PLAYERS_WEAPONS);
    
    echo '

        <div id="grid-data-weapons" class="grid-data-subcontainer">

            <div id="grid-form-container">

                <form id="grid-form-search-uid" method="get"></form>
                <form id="grid-form-search-guid" method="get"></form>

                <input id="grid-search-uid-after" class="grid-input" type="text" name="PLAYER_STEAMID" placeholder="Steam ID64" form="grid-form-search-uid">
                <input id="grid-search-guid-after" class="grid-input" type="text" name="PLAYER_GUID" placeholder="BE ID / GUID" form="grid-form-search-guid">
                <input class="grid-search-submit" type="submit" value="Ok" form="grid-form-search-uid">
                <input class="grid-search-submit" type="submit" value="Ok" form="grid-form-search-guid">  

            </div>

                    <!-- Navigate Left -->
                <div id="grid-nav-left" class="grid-table-nav">
                    <p>&laquo;</p>
                </div>

                <!-- Navigate Right -->
                <div id="grid-nav-right" class="grid-table-nav">
                    <p>&raquo;</p>
                </div>

                <!-- Table Container -->
                <div id="grid-table-career-container">

            ';

    // Membership level checks

    if($RESULT_MEMBERSHIP_CHECK[1] <= 2) { 

        echo '

                <table>

                    <tr id="table-headings">
                        <td>Name</td>
                        <td>SteamID</td>
                        <td>GUID</td>
                        <td>Favourite Weapons</td>
                        <td>Kills</td>
                    </tr>

                    ';

        while($RESULT_PLAYERS_CAREER = mysqli_fetch_array($QUERY_PLAYERS_CAREER)) {

            echo '

                    <tr id="table-data">
                        <td>' . $RESULT_PLAYERS_WEAPONS[0] . '</td>
                        <td style="text-decoration: underline;"><a href="//www.steamcommunity.com/profiles/' . $RESULT_PLAYERS_WEAPONS[1] . '">' . $RESULT_PLAYERS_WEAPONS[1] . '</a></td>
                        <td>' . $RESULT_PLAYERS_WEAPONS[2] . '</td>
                        <td>' . $RESULT_PLAYERS_WEAPONS[3] . '</td>
                        <td>' . $RESULT_PLAYERS_WEAPONS[4] . '</td>
                    </tr>

                ';

        }

        echo '

                </table>

                ';

    } 

    if($RESULT_MEMBERSHIP_CHECK[1] >= 3) {

        echo '

                <table>

                    <tr id="table-headings">
                        <td>Name</td>
                        <td>SteamID</td>
                        <td>GUID</td>
                        <td>Favourite Weapons</td>
                        <td></td>
                        <td>Kills</td>
                        <td>Shots Fired</td>
                        <td>Shots Hit</td>
                        <td>Accuracy</td>
                    </tr>

                ';

        while($RESULT_PLAYERS_WEAPONS = mysqli_fetch_array($QUERY_PLAYERS_WEAPONS)) {

            echo '

                        <tr id="table-data">
                            <td>' . $RESULT_PLAYERS_WEAPONS[0] . '</td>
                            <td style="text-decoration: underline;"><a href="//www.steamcommunity.com/profiles/' . $RESULT_PLAYERS_WEAPONS[1] . '">' . $RESULT_PLAYERS_WEAPONS[1] . '</a></td>
                            <td>' . $RESULT_PLAYERS_WEAPONS[2] . '</td>
                            <td>' . $RESULT_PLAYERS_WEAPONS[3] . '</td>
                            <td><img src="img/weapons/' . preg_replace("/\"/", "", $RESULT_PLAYERS_WEAPONS[3]) . '.png" style="height:24px; width:100px;"><p style="display: inline; padding-left: 5px;"></p></td>
                            <td>' . $RESULT_PLAYERS_WEAPONS[4] . '</td>
                            <td>' . $RESULT_PLAYERS_WEAPONS[5] . '</td>
                            <td>' . $RESULT_PLAYERS_WEAPONS[6] . '</td>
                            <td>' . sprintf('%0.0f',$RESULT_PLAYERS_WEAPONS[6] / $RESULT_PLAYERS_WEAPONS[5] * 100) . '%</td>

                        </tr>

                    ';

        }

        echo '

                </table>

                ';

    }

    echo '

            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>

            var textLimit = "' . $_SESSION['LIMIT'] . '";    

            var currentLimit = Number(textLimit);    

            // Decrement the limit
            $("#grid-nav-left").on("click", function() {

                // Decrement the limit
                currentLimit -= 25;

                // Check to make sure limit isnt under 25
                if(currentLimit < 25) {

                    currentLimit = 25;

                }

                $("#grid-data").load("ajax/inc/player.inc.weapons.php", {
                    Selection: "Weapons",
                    User: document.getElementById("grid-data").getAttribute("value"),
                    Limit: currentLimit,
                    Type: "Decrement"},
                        function(responseTxt, statusTxt, xhr) {

                });

            });  

            // Increment the limit
            $("#grid-nav-right").on("click", function() {

                // Increment the limit
                currentLimit += 25;

                $("#grid-data").load("ajax/inc/player.inc.weapons.php", {
                    Selection: "Weapons",
                    User: document.getElementById("grid-data").getAttribute("value"),
                    Limit: currentLimit,
                    Type: "Increment"},
                                     function(responseTxt, statusTxt, xhr) {

                });

            });    

        </script>

    ';

}

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

                var td = document.getElementsByTagName("td");

                for(var i = 0; i < td.length; i++) {

                    td[i].style.color = "#FFFFFF";

                }

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

                var td = document.getElementsByTagName("td");

                for(var i = 0; i < td.length; i++) {

                    td[i].style.color = "#000000";

                }

            }

        </script>

    ';

}

?>