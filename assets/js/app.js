/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

require('../images/favicon.ico');
require('../images/imageHome.jpg');
require('../images/accessoires-bijoux.jpg');
require('../images/arts.jpg');
require('../images/animaux.jpg');
require('../images/bricolage.jpg');
require('../images/cosmetiques-beaute-et-soins.jpg');
require('../images/decorations.jpg');
require('../images/hygiene-corporelle.jpg');
require('../images/jardin-jardinage.jpg');
require('../images/jeux.jpg');
require('../images/linge-de-maison.jpg');
require('../images/menage-hygiene-maison.jpg');
require('../images/recyclage.jpg');
require('../images/vetements.jpg');
require('../images/tiphaine.jpeg');
require('../images/maeva.jpg');
require('../images/logoLinkedin.jpg');
require('../images/iconparam.png');
require('../images/articlesFlag.jpg');
require('../images/iconUser.png');


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//import $ from 'jquery';

var $ = require('jquery');




var app = {
    init:function() 
    {

        $(document).ready(function()
        {
            $("#sideOpenbtn").on("click", function(){
                app.openSideNav(); 
            });

            $(".closebtn").on("click", function(){
                app.closeSideNav(); 
            });

        })
    },

    openSideNav:function() 
    {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("mySidebar").style.display = "absolute";
    document.getElementById("overlay").style.display = "block";
    },
            
    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    closeSideNav:function() 
    {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("overlay").style.display = "none";
    },

        
}

$(app.init);
