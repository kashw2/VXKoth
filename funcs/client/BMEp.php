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

// Functions here all utilize the BattleMetrics API. A failure may be caused by a failure or downtime on their side.

// Main and important functions that are requirements for other functions will be listed first

// *** SERVER FUNCTIONS *** \\

// Server functions will return information available from battlemetrics related to the server
// Server functions are in order from the Server Info endpoint

function GetServerId($ServerIP, $ServerName) {
    
    // Servers are all on the same box which makes this function useless for the time being
    // Problem with this function is that it's a guessing game on what the api will return even with the exact ip it may
    // return the wrong json table for a different server. It's weird.
    
    // Battlemetrics Function
    
    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers?filter[search]={$ServerIP}&fields[server]=name,ip,port&filter[game]=arma3"), true);
    
    // Check to make sure there isnt a mismatch
    if(GetServerIdByName($ServerName) != $SERVERINFO['data']['0']['id']) {
        
        // Different, api issue
        return 'API Error';
        
    } else {
    
        // Return the server id
        return $SERVERINFO['data']['0']['id'];
        
    }
    
    // Depreciated function
        
}

function GetServerIdByName($ServerName) {

    // Servers are all on the same box which makes this function useless for the time being
    // Problem with this function is that it's a guessing game on what the api will return even with the exact ip it may
    // return the wrong json table for a different server. It's weird.
    
    // Getting server id by name seems to be more accurate than getting it by ip and port

    // Battlemetrics Function

    // HTTP Requrest ready string
    $HTTPServerName = preg_replace("/ /", "%20", $ServerName);
    
    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers?filter[search]={$HTTPServerName}&fields[server]=name,ip,port&filter[game]=arma3"), true);

    // Make sure theres something to return
    if(!empty($SERVERINFO)) {
    
        // Return the server id
        return $SERVERINFO['data']['0']['id'];

    } else {
        
        // Empty table
        
        return 'API Error';
        
    }
        
}

function GetOnlinePlayers($ServerId) {
    
    // Battlemetrics Function
    
    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);
    
    // Make sure there's something to return
    if(!empty($SERVERINFO)) {
    
        // Return the players
        return $SERVERINFO['data']['attributes']['players'];
    
    } else {
        
        return 'API Error';
        
    }
        
}

function GetMaxPlayers($ServerId) {
    
    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the max players
        return $SERVERINFO['data']['attributes']['maxPlayers'];

    } else {

        return 'API Error';

    }
    
}

function GetServerStatus($ServerId) {
    
    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the max players
        return $SERVERINFO['data']['attributes']['status'];

    } else {

        return 'API Error';

    }
    
}

function GetServerName($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server name
        return $SERVERINFO['data']['attributes']['name'];

    } else {

        return 'API Error';

    }

}

function GetServerIP($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server ip
        return $SERVERINFO['data']['attributes']['ip'];

    } else {

        return 'API Error';

    }

}

function GetServerPort($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server port
        return $SERVERINFO['data']['attributes']['port'];

    } else {

        return 'API Error';

    }

}

function GetServerQueryPort($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server query port
        return $SERVERINFO['data']['attributes']['portQuery'];

    } else {

        return 'API Error';

    }

}

function GetServerRank($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server battlemetrics rank
        return $SERVERINFO['data']['attributes']['rank'];

    } else {

        return 'API Error';

    }

}

function GetServerCreationDate($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server creation date according to battlemetrics
        return $SERVERINFO['data']['attributes']['createdAt'];

    } else {

        return 'API Error';

    }

}

function GetServerUpdatedDate($ServerId) {

    // Battlemetrics Function

    // Request and decode the returned json table
    $SERVERINFO = json_decode(file_get_contents("https://api.battlemetrics.com/servers/{$ServerId}"), true);

    // Make sure there's something to return
    if(!empty($SERVERINFO)) {

        // Return the server last update date according to battlemetrics
        return $SERVERINFO['data']['attributes']['updatedAt'];

    } else {

        return 'API Error';

    }

}

?>