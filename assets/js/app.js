/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//import $ from 'jquery';

var $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


var app = {
    init:function() 
    {
        console.log('init');

        $(document).ready(function()
        {
            $(".navbar-toggler").on("click", function(){
                app.openNav(); 
            });

            $(".closebtn").on("click", function(){
                app.closeNav(); 
            });
        })
    },

    openNav:function() 
    {
    document.getElementById("mySidebar").style.width = "300px";
    document.getElementById("mySidebar").style.display = "absolute";
    },
            
    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    closeNav:function() 
    {
    document.getElementById("mySidebar").style.width = "0";
    }
        
}

$(app.init);
