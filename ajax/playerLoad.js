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

// jQuery

// If document is ready
$(document).ready(function() {
    
    // Check that our content container for the information parsed is ready
    if(document.getElementById('grid-data')) {
        
        // The element exists
        
        // Check what was clicked
        
        $("#grid-heading-career").click(function() {
            
            // Attempt to load user Career data
            
            // Load data
            $("#grid-data").load("ajax/inc/player.inc.career.php", {
                Selection: "Career",
                User: document.getElementById("grid-data").getAttribute("value")},
                                function(responseTxt, statusTxt, xhr) {   
                
            });
            
        });
        
        $("#grid-heading-weapons").click(function() {
            
            // Attempt to load user Weapons data
            
            // Load data
            $("#grid-data").load("ajax/inc/player.inc.weapons.php", {
                Selection: "Weapons",
                User: document.getElementById("grid-data").getAttribute("value")},
                                 function(responseTxt, statusTxt, xhr) {

            });
            
        });
        
        $("#grid-heading-clans").click(function() {

            // Attempt to load user Clans data

            // Load data
            $("#grid-data").load("ajax/inc/player.inc.clans.php", {
                Selection: "Clans",
                User: document.getElementById("grid-data").getAttribute("value")},
                                 function(responseTxt, statusTxt, xhr) {
                
            });
            
        });
        
        $("#grid-heading-squads").click(function() {

            // Attempt to load user Squads data

            // Load data
            $("#grid-data").load("ajax/inc/player.inc.squads.php", {
                Selection: "Squads",
                User: document.getElementById("grid-data").getAttribute("value")},
                                 function(responseTxt, statusTxt, xhr) {

            });
            
        });
        
        $("#grid-heading-seasons").click(function() {

            // Attempt to load user Seasons data

            // Load data
            $("#grid-data").load("ajax/inc/player.inc.seasons.php", {
                Selection: "Seasons",
                User: document.getElementById("grid-data").getAttribute("value")},
                                 function(responseTxt, statusTxt, xhr) {
    
            });
            
        });
        
    }
    
    // Preloader
    
    $("#grid-preloader").hide();
    $("#grid-preload-svg").hide();
    
    $(document).ajaxStart(function() {
        
        $("#grid-preloader").show();
        $("#grid-preload-svg").show();
        
    });

    $(document).ajaxStop(function() {
        
        $("#grid-preloader").remove();
        $("#grid-preload-svg").remove();
        
    });
    
    $(document).ajaxComplete(function() {

        $("#grid-preloader").remove();
        $("#grid-preload-svg").remove();

    });
    
    // SVG Preload Fix
//    function SVGPreloadFix() {
//
        // SVG Preloader Bug Fix
//        var svg = document.getElementsByTagName("svg");
//
//        for(var i = 0; i < svg.length; i++) {
//
//            svg[i].remove();  
//
//        }
//
//    }
    
});