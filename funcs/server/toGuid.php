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

// Query
$QUERY_STEAMID = mysqli_query($conn, "

SELECT
vx.players.pid,
vx.players.guid
FROM vx.players
WHERE vx.players.guid NOT LIKE('%_%')
LIMIT 1;

");

// Fetch the results
$RESULT_STEAMID = mysqli_fetch_array($QUERY_STEAMID);

// Check to see if there is a post value
if(isset($_POST['guid']) && !empty($_POST['guid'])) {
    
    $QUERY_UPDATE = mysqli_query($conn, "
    
    UPDATE vx.players
    SET vx.players.guid = '" . $_POST['guid'] . "'
    WHERE vx.players.pid = '" . $RESULT_STEAMID[0] . "';
    
    ");
    
    // Refresh if there is data
    header('Refresh:0');
    
} else {

    // No post value
    
    if(true) {

        // Script
        echo '

            <html> 
            <head>

                <title>toGuid</title>

            </head>
            <body>

                <form id="form" method="post">
                    <input id="input" type="text" form="form" name="guid">
                </form>
    
                <script src="jquery.min.js"></script>
    
                <script src="require/core.js"></script>
                <script src="require/md5.js"></script>
                <script src="require/lib-typedarrays.js"></script>
                <script src="require/BigInteger.min.js"></script>

                <script>
    
                var uid2guid = function(uid) {
                    if (!uid) {
    
                    return;
    
                    }
    
                    var steamId = bigInt(uid);
    
                    var parts = [0x42,0x45,0,0,0,0,0,0,0,0];
    
                    for (var i = 2; i < 10; i++) {
    
                    var res = steamId.divmod(256);
    
                    steamId = res.quotient; 
    
                    parts[i] = res.remainder.toJSNumber();
    
                    }
    
                    var wordArray = CryptoJS.lib.WordArray.create(new Uint8Array(parts));
    
                    var hash = CryptoJS.MD5(wordArray);
    
                    return hash.toString();
    
                    };
    
                    $(document).ready(function() {
    
                    var uid = "' . $RESULT_STEAMID[0] . '";
    
                    $("#input").val(uid2guid(uid));
    
                    document.getElementById("form").submit();
    
                    });
    
                </script>

            </body>
            </html>

        ';
        
    }
    
}

?>