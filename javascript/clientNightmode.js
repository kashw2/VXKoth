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

'use strict';

// Set to nightmode

// Check container exists
if(document.getElementById("grid-container")) {

    // Element exists

    // Change background color
    document.getElementById("grid-container").style.backgroundColor = "#3e3e3e";

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h1").length; i++) {

        document.getElementsByTagName("h1")[i].style.color = "#FFFFFF";

    } 

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h2").length; i++) {

        document.getElementsByTagName("h2")[i].style.color = "#FFFFFF";

    }

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h3").length; i++) {

        document.getElementsByTagName("h3")[i].style.color = "#FFFFFF";

    }

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h4").length; i++) {

        document.getElementsByTagName("h4")[i].style.color = "#FFFFFF";

    }

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h5").length; i++) {

        document.getElementsByTagName("h5")[i].style.color = "#FFFFFF";

    }

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("h6").length; i++) {

        document.getElementsByTagName("h6")[i].style.color = "#FFFFFF";

    }

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("tr").length; i++) {

        document.getElementsByTagName("tr")[i].style.color = "#FFFFFF";

    } 

    // Change heading color
    for(var i = 0; i < document.getElementsByTagName("td").length; i++) {

        document.getElementsByTagName("td")[i].style.color = "#FFFFFF";

    } 

    // Change text color
    for(var i = 0; i < document.getElementsByTagName("p").length; i++) {

        document.getElementsByTagName("p")[i].style.color = "#FFFFFF";

    }

    // Change top border color to match the new color scheme
    document.getElementById("grid-data").style.borderTop = "1px solid #FFFFFF";

    // Set header color in case it was changed
    document.getElementsByClassName("grid-user-display")[0].style.color = "#FFFFFF";
    document.getElementsByClassName("grid-account-managment")[1].style.color = "#FFFFFF";
    document.getElementsByClassName("grid-account-managment")[0].style.color = "#FFFFFF";

    // Set vx headings color in case it was changed
    document.getElementById("grid-vx").style.color = "#CF000F";
    document.getElementById("grid-koth").style.color = "#FFFFFF";

    // Set footer colors in case they were changed
    for(var i = 0; i < document.getElementsByClassName("grid-footer-headings").length; i++) {

        // Change the colors

        document.getElementsByClassName("grid-footer-headings")[i].style.color = "#FFFFFF";

    }
    
    // Check exists
    
    if(document.getElementById("table-servers-id")) {

        // Loop through the elements
        for(var i = 0; i < document.getElementsByClassName("table-servers-id-hook").length; i++) {

            // Add the event listener
            document.getElementsByClassName("table-servers-id-hook")[i].addEventListener("hover", function() {

                // Change the color of the element
                document.getElementsByClassName("table-servers-id")[i].style.color = "#0000FF";

            }, false);


        }

    }

}