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

if($_POST['Selection'] == "Seasons") {

    // Seasons selected

    $_SESSION['LIMIT'] = $_POST['Limit'];

    // Check that the limit has set
    if(isset($_SESSION['LIMIT'])) {

        $LIMIT = $_SESSION['LIMIT'];
        $LIMITED = $LIMIT - 25;

        // Query
        $QUERY_PLAYERS_SEASONS = mysqli_query($conn, "

        SELECT DISTINCT
        vx.seasons.id,
        vx.seasons.nickname,
        vx.seasons.seasonStart,
        vx.seasons.seasonEnd
        FROM vx.seasons
        ORDER BY vx.seasons.id DESC
        LIMIT 25 OFFSET $LIMITED;

        ");

    } else {

        // Unset the count
        unset($_SESSION['COUNT']);

        // Query
        $QUERY_PLAYERS_SEASONS = mysqli_query($conn, "

        SELECT DISTINCT
        vx.seasons.id,
        vx.seasons.nickname,
        vx.seasons.seasonStart,
        vx.seasons.seasonEnd
        FROM vx.seasons
        ORDER BY vx.seasons.id DESC
        LIMIT 25;

        ");

    }

    // Fetch Results
    $RESULT_PLAYERS_SEASONS = mysqli_fetch_array($QUERY_PLAYERS_SEASONS);

    // Create the fields

    echo '

        <div id="grid-data-career" class="grid-data-subcontainer">

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

    if($RESULT_MEMBERSHIP_CHECK[1] <= 8) { 

        echo '

                <table>

                    <tr id="table-headings">
                        <td id="table-seasons-seasonid">Season ID</td>
                        <td id="table-seasons-seasonnickname">Season Nickname</td>
                        <td>Start</td>
                        <td>End</td>
                    </tr>

                    ';

        while($RESULT_PLAYERS_SEASONS = mysqli_fetch_array($QUERY_PLAYERS_SEASONS)) {

            echo '

                        <tr id="table-data">
                            <td>' . $RESULT_PLAYERS_SEASONS[0] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[1] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[2] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[3] . '</td>
                        </tr>

                    ';

        }

        echo '

                </table>

                ';

    } 

    if($RESULT_MEMBERSHIP_CHECK[1] >= 9) {

        echo '

                <table>

                    <tr id="table-headings">
                        <td id="table-seasons-seasonid">Season ID</td>
                        <td id="table-seasons-seasonnickname">Season Nickname</td>
                        <td>Start</td>
                        <td>End</td>
                    </tr>

                ';

        while($RESULT_PLAYERS_SEASONS = mysqli_fetch_array($QUERY_PLAYERS_SEASONS)) {

            echo '

                        <tr id="table-data">
                            <td>' . $RESULT_PLAYERS_SEASONS[0] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[1] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[2] . '</td>
                            <td>' . $RESULT_PLAYERS_SEASONS[3] . '</td>
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

                $("#grid-data").load("ajax/inc/player.inc.seasons.php", {
                    Selection: "Seasons",
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

                $("#grid-data").load("ajax/inc/player.inc.seasons.php", {
                    Selection: "Seasons",
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