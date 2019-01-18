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

// Reset include path
set_include_path($_SERVER['DOCUMENT_ROOT'] . '/VX_Koth_v3/');

// Require
require_once('mysql.php');
require_once('funcs/client/BMEp.php');

// Check the post value
if($_POST['Selection'] = "Servers") {
    
    // Query
    $QUERY_SERVERS = mysqli_query($conn, "
    
    SELECT
    vx.servers.id,
    vx.servers.name,
    vx.servers.ip,
    vx.servers.port,
    vx.servers.clanID
    FROM vx.servers
    WHERE vx.servers.clanID = (
    
    SELECT
    vx.clans.id
    FROM vx.clans
    WHERE vx.clans.id = (
    
        SELECT
        vx.accounts.clanID
        FROM vx.accounts
        WHERE vx.accounts.id = '" . $_SESSION['USERID'] . "'
        AND vx.accounts.username = '" . $_COOKIE['USERNAME'] . "'
    
        )
    
    );
    
    ");
    
    // Fetch results
    $RESULT_SERVERS = mysqli_fetch_array($QUERY_SERVERS);
    
    // Query
    $QUERY_COMMUNITY = mysqli_query($conn, "
    
    SELECT
    vx.clans.name,
    vx.clans.abbreviation
    FROM vx.clans
    WHERE vx.clans.id = '" . $RESULT_SERVERS[4] . "';
    
    ");
    
    // Fetch results
    $RESULT_COMMUNITY = mysqli_fetch_array($QUERY_COMMUNITY);
    
    echo '
    
        <!-- Server Table Container -->
        <div id="grid-server-table-container">
            
            <!-- Servers Table -->
            <table id="grid-servers-table">
            
            <tr id="table-servers-headings">
                <td>Server ID <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>    
                <td>Server Name <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>    
                <td></td>    
                <td>Server IP <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>    
                <td>Server Port <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>
                <td>Players <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>
                <td>Ping <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>
                <td>Registered Community <i style="cursor: pointer;" class="fas fa-angle-down"></i></td>
                <td>Search: 
                    <input id="table-server-search" type="text" placeholder="Search.." onkeyup="tableSearch();">
                </td>
            </tr>';
    
    while($RESULT_SERVERS = mysqli_fetch_array($QUERY_SERVERS)) {
        
        // Ping the servers
        exec('ping ' . $RESULT_SERVERS[2] . ' -n 1', $RESULT_PING, $RAW_OUTPUT);
        
        echo '
        
            <tr id="table-servers-data">
                <td id="table-servers-id" class="table-servers-id-hook">' . $RESULT_SERVERS[0] . '</td>
                <td id="table-servers-name">' . $RESULT_SERVERS[1] . '</td>
                <td id="table-servers-info">
                    <i class="fab fa-windows" title="Windows"></i>

        ';
            
        // Request ipinfo
        $IPINFO = json_decode(file_get_contents("http://ipinfo.io/{$RESULT_SERVERS[2]}/json"));
        
        // Check ip info
        
        // Check if host is in USA
        if($IPINFO->country == "US") {
            
            // Host is in US
            
            echo '

                <img class="table-icon-flag" src="img/flags/united_states_of_america_usa.png" title="United States of America (US)">

            ';
            
        } else if($IPINFO->country == "AU") {
            
            // Host is in AU
            
            echo '

                <img class="table-icon-flag" src="img/flags/australia.png" title="Australia (AU)">

            ';
            
        } else if($IPINFO->country == "JP") {

            // Host is in JP
            
            echo '

                <img class="table-icon-flag" src="img/flags/japan.png" title="Japan (JP)">

            ';

        } else if($IPINFO->country == "GB") {

            // Host is in GB
            
            echo '

                <img class="table-icon-flag" src="img/flags/united_kingdom_great_britain.png" title="United Kingdom (GB)">

            ';

        } else if($IPINFO->country == "CA") {

            // Host is in CA
            
            echo '

                <img class="table-icon-flag" src="img/flags/canada.png" title="Canada (CA)">

            ';

        } else if($IPINFO->country == "EU") {

            // Host is in EU
            
            echo '

                <img class="table-icon-flag" src="img/flags/canada.png" title="Canada (CA)">

            ';

        } else if($IPINFO->country == "RU") {

            // Host is in RU
            
            echo '

                <img class="table-icon-flag" src="img/flags/russian_federation.png" title="Russia (RU)">

            ';

        } else if($IPINFO->country == "DE") {

            // Host is in DE
            
            echo '

                <img class="table-icon-flag" src="img/flags/germany.png" title="Germany (DE)">

            ';

        }
                        
        echo '
        
                </td>
                <td>' . $RESULT_SERVERS[2] . '</td>
                <td id="table-servers-port">' . $RESULT_SERVERS[3] . '</td>
                <td>' . GetOnlinePlayers(GetServerIdByName($RESULT_SERVERS[1])) . '/' . GetMaxPlayers(GetServerIdByName($RESULT_SERVERS[1])) . '</td>      
                
        ';
        
        // Check if server is online or not
        if(GetServerStatus(GetServerIdByName($RESULT_SERVERS[1])) == "online") {

            // Server is online

            // Check the result isnt empty (if it is the server was unable to ping the ip)
            if(!empty($RESULT_PIMG[0])) {
            
                // Pinged the server and returned a value
                
                echo '

                    <td id="table-servers-ping">' . $RESULT_PING[0] . '</td>

                ';
                
            } else {
                
                // Request timeout
                
                echo '

                    <td id="table-servers-ping">Timeout</td>

                ';
                
            }


        } else {

            // Server is offline

            echo '

                <td id="table-servers-ping">Offline</td>

            ';

        }
        
            echo '
            
                <td id="table-servers-registeredcommunity">' . $RESULT_COMMUNITY[0] . ' [' . $RESULT_COMMUNITY[1] . ']</td>
                <td>
                    <i style="font-size: 1.5em; padding: 0px 3px 0px 3px; margin-left: 3px; cursor: pointer;" class="far fa-chart-bar" title="Metrics"></i>
                    <i style="font-size: 1.5em; padding: 0px 3px 0px 3px; cursor: pointer; color: #00FF00;" class="fas fa-redo" title="Restart"></i>
                    <i style="font-size: 1.5em; padding: 0px 3px 0px 3px; cursor: pointer;" class="far fa-edit" title="Edit"></i>
                </td>
            </tr>
        
        ';
        
    }
    
    echo '
            
            </table>
            
        </div>
        
        <script>

            // Weird, cant add event listener

            // Function prototype
            function tableSearch() {

              // Declare variables   
              var searchInput = document.getElementById("table-server-search");
              var searchfilter = searchInput.value.toUpperCase();
              var table = document.getElementById("grid-servers-table");
              var tr = table.getElementsByTagName("tr");
              var td;

                // Loop through the rows
                for (var i = 0; i < tr.length; i++) {
                
                    // Loop through data
                    td = tr[i].getElementsByTagName("td")[1];

                    // Data check
                    if (td) {

                        // If data is present and its what was searched
                        if (td.innerHTML.toUpperCase().indexOf(searchfilter) > -1) {

                            // Make sure we dont delete the first row (headings)
                            if(i == 0) {
                                
                                // If we are on the first row, increment
                                i++;
                                
                            }

                            // Set display
                            tr[i].style.display = "";

                        } else {

                            // Make sure we dont delete the first row (headings)
                            if(i == 0) {
                                
                                // Increment
                                i++;

                            }

                            // Set the display property to none if its not the right result
                            tr[i].style.display = "none";

                        }

                    }

                }

            }

        </script>
    
    ';
    
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
    
    // NOTE: Server modifications are done via a script in admin.php

}

?>