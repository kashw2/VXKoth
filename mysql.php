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

// MySQL

/////////////////////////////////////////////////////////////////////////////

// Connection for player stats

$VX_KOTH_RC = "";
$VX_KOTH_USER = "";
$VX_KOTH_PASS = "";
$VX_KOTH_DB = "";

$conn = new mysqli($VX_KOTH_RC, $VX_KOTH_USER, $VX_KOTH_PASS, $VX_KOTH_DB);

if($conn->connect_error)
	die("MySQL Connection Error:". mysqli_connect_error());

/////////////////////////////////////////////////////////////////////////////

?>