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

        $("#grid-heading-memberships").click(function() {

            // Attempt to load Membership data

            // Create the preloader container
            var gridPreloader = $("#grid-heading-options").append("<div id='grid-preloader'></div>");

            // Create the preloader
            var preloader = $("#grid-preloader").append("<img id='grid-preloader-svg' src='img/preloader.gif'>");
            
            // Load data
            $("#grid-data").load("ajax/inc/admin.inc.memberships.php",{
                Selection: "Memberships"
            },
                function(responseTxt, statusTxt, xhr) {



            });

        });
        
        $("#grid-heading-events").click(function() {

            // Attempt to load Events data

            // Create the preloader container
            var gridPreloader = $("#grid-heading-options").append("<div id='grid-preloader'></div>");

            // Create the preloader
            var preloader = $("#grid-preloader").append("<img id='grid-preloader-svg' src='img/preloader.gif'>");
            
            // Load data
            $("#grid-data").load("ajax/inc/admin.inc.events.php", {
                Selection: "Events"
            },
                function(responseTxt, statusTxt, xhr) {



            });

        });
        
        $("#grid-heading-vxbans").click(function() {

            // Attempt to load VX Bans data

            // Create the preloader container
            var gridPreloader = $("#grid-heading-options").append("<div id='grid-preloader'></div>");

            // Create the preloader
            var preloader = $("#grid-preloader").append("<img id='grid-preloader-svg' src='img/preloader.gif'>");
            
            // Load data
            $("#grid-data").load("ajax/inc/admin.inc.vxbans.php", {
                Selection: "VXBans"
            },
                function(responseTxt, statusTxt, xhr) {



            });

        });
        
        $("#grid-heading-servers").click(function() {

            // Attempt to load Server data
            
            // Create the preloader container
            var gridPreloader = $("#grid-heading-options").append("<div id='grid-preloader'></div>");

            // Create the preloader
            var preloader = $("#grid-preloader").append("<img id='grid-preloader-svg' src='img/preloader.gif'>");

            // Load data
            $("#grid-data").load("ajax/inc/admin.inc.servers.php", {
                Selection: "Servers"
            },
                function(responseTxt, statusTxt, xhr) {



            });

        });
        
        $("#grid-heading-administration").click(function() {

            // Attempt to load Administrator data
            
            // Create the preloader container
            var gridPreloader = $("#grid-heading-options").append("<div id='grid-preloader'></div>");

            // Create the preloader
            var preloader = $("#grid-preloader").append("<img id='grid-preloader-svg' src='img/preloader.gif'>");

            // Load data
            $("#grid-data").load("ajax/inc/admin.inc.administration.php", {
                Selection: "Administration"
            },
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

});