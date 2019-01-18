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

function CheckRank($CurrentXP) {

    // Check player rank

    if($CurrentXP < 25000) {

        $CUR_RANK = "Private";

    }
    else if($CurrentXP >= 25000 && $CurrentXP < 54000) {

        $CUR_RANK = "Private Second Class";

    }
    else if($CurrentXP >= 54000 && $CurrentXP < 88000) {

        $CUR_RANK = "Private First Class";

    }
    else if($CurrentXP >= 88000 && $CurrentXP < 128000) {

        $CUR_RANK = "Specialist";

    }
    else if($CurrentXP >= 128000 && $CurrentXP < 175000) {

        $CUR_RANK = "Corporal";

    }
    else if($CurrentXP >= 175000 && $CurrentXP < 230000) {

        $CUR_RANK = "Sergeant";

    }
    else if($CurrentXP >= 230000 && $CurrentXP < 294000) {

        $CUR_RANK = "Staff Sergeant";

    }
    else if($CurrentXP >= 365000 && $CurrentXP < 444000) {

        $CUR_RANK = "Sergeant First Class";

    }
    else if($CurrentXP >= 444000 && $CurrentXP < 532000) {

        $CUR_RANK = "Master Sergeant";

    }
    else if($CurrentXP >= 532000 && $CurrentXP < 630000) {

        $CUR_RANK = "First Sergeant";

    }
    else if($CurrentXP >= 630000 && $CurrentXP < 739000) {

        $CUR_RANK = "First Sergeant";

    }
    else if($CurrentXP >= 739000 && $CurrentXP < 860000) {

        $CUR_RANK = "Sergeant Major";

    }
    else if($CurrentXP >= 860000 && $CurrentXP < 994000) {

        $CUR_RANK = "Sergeant Major";

    }
    else if($CurrentXP >= 994000 && $CurrentXP < 1142000) {

        $CUR_RANK = "Command Sergeant Major";

    }
    else if($CurrentXP >= 1142000 && $CurrentXP < 1306000) {

        $CUR_RANK = "Command Sergeant Major";

    }
    else if($CurrentXP >= 1306000 && $CurrentXP < 1487000) {

        $CUR_RANK = "Sergeant Major of the Army";

    }
    else if($CurrentXP >= 1487000 && $CurrentXP < 1687000) {

        $CUR_RANK = "Sergeant Major of the Army";

    }
    else if($CurrentXP >= 1687000 && $CurrentXP < 1908000) {

        $CUR_RANK = "Warrant Officer 1";

    }
    else if($CurrentXP >= 1908000 && $CurrentXP < 2152000) {

        $CUR_RANK = "Warrant Officer 1";

    }
    else if($CurrentXP >= 2152000 && $CurrentXP < 2422000) {

        $CUR_RANK = "Chief Warrant Officer 2";

    }
    else if($CurrentXP >= 2422000 && $CurrentXP < 2720000) {

        $CUR_RANK = "Chief Warrant Officer 2";

    }
    else if($CurrentXP >= 2720000 && $CurrentXP < 3049000) {

        $CUR_RANK = "Chief Warrant Officer 3";

    }
    else if($CurrentXP >= 3049000 && $CurrentXP < 3412000) {

        $CUR_RANK = "Chief Warrant Officer 3";

    }
    else if($CurrentXP >= 3412000 && $CurrentXP < 3813000) {

        $CUR_RANK = "Chief Warrant Officer 4";

    }
    else if($CurrentXP >= 3813000) {

        $CUR_RANK = "Chief Warrant Officer 4";

    }

    return $CUR_RANK;
    
}

function CheckLevel($CurrentXP) {

    // Check player level below

    if($CurrentXP < 25000) {

        $CUR_LEVEL = 1;

    }
    else if($CurrentXP >= 25000 && $CurrentXP < 54000) {

        $CUR_LEVEL = 2;

    }
    else if($CurrentXP >= 54000 && $CurrentXP < 88000) {

        $CUR_LEVEL = 3;

    }
    else if($CurrentXP >= 88000 && $CurrentXP < 128000) {

        $CUR_LEVEL = 4;

    }
    else if($CurrentXP >= 128000 && $CurrentXP < 175000) {

        $CUR_LEVEL = 5;

    }
    else if($CurrentXP >= 175000 && $CurrentXP < 230000) {

        $CUR_LEVEL = 6;

    }
    else if($CurrentXP >= 230000 && $CurrentXP < 294000) {

        $CUR_LEVEL = 7;

    }
    else if($CurrentXP >= 365000 && $CurrentXP < 444000) {

        $CUR_LEVEL = 8;

    }
    else if($CurrentXP >= 444000 && $CurrentXP < 532000) {

        $CUR_LEVEL = 9;

    }
    else if($CurrentXP >= 532000 && $CurrentXP < 630000) {

        $CUR_LEVEL = 10;

    }
    else if($CurrentXP >= 630000 && $CurrentXP < 739000) {

        $CUR_LEVEL = 11;

    }
    else if($CurrentXP >= 739000 && $CurrentXP < 860000) {

        $CUR_LEVEL = 12;

    }
    else if($CurrentXP >= 860000 && $CurrentXP < 994000) {

        $CUR_LEVEL = 13;

    }
    else if($CurrentXP >= 994000 && $CurrentXP < 1142000) {

        $CUR_LEVEL = 14;

    }
    else if($CurrentXP >= 1142000 && $CurrentXP < 1306000) {

        $CUR_LEVEL = 15;

    }
    else if($CurrentXP >= 1306000 && $CurrentXP < 1487000) {

        $CUR_LEVEL = 16;

    }
    else if($CurrentXP >= 1487000 && $CurrentXP < 1687000) {

        $CUR_LEVEL = 17;

    }
    else if($CurrentXP >= 1687000 && $CurrentXP < 1908000) {

        $CUR_LEVEL = 18;

    }
    else if($CurrentXP >= 1908000 && $CurrentXP < 2152000) {

        $CUR_LEVEL = 19;

    }
    else if($CurrentXP >= 2152000 && $CurrentXP < 2422000) {

        $CUR_LEVEL = 20;

    }
    else if($CurrentXP >= 2422000 && $CurrentXP < 2720000) {

        $CUR_LEVEL = 21;        

    }
    else if($CurrentXP >= 2720000 && $CurrentXP < 3049000) {

        $CUR_LEVEL = 22;

    }
    else if($CurrentXP >= 3049000 && $CurrentXP < 3412000) {

        $CUR_LEVEL = 23;

    }
    else if($CurrentXP >= 3412000 && $CurrentXP < 3813000) {

        $CUR_LEVEL = 24;

    }
    else if($CurrentXP >= 3813000) {

        $CUR_LEVEL = 25;

    }
    
    return $CUR_LEVEL;

}

?>