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

// Set serverid to session so it can be used globally
$_SESSION['ServerID'] = $_POST['ServerID'];

// Query
$QUERY_SERVER = mysqli_query($conn, "

    SELECT
    vx.servers.name,
    vx.servers.ip,
    vx.servers.port
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

    )
    AND vx.servers.id = '" . $_POST['ServerID'] . "';

    ");

// Fetch results
$RESULT_SERVER = mysqli_fetch_array($QUERY_SERVER);

    // NOTE: Server modifications are done via a script in admin.php

?>