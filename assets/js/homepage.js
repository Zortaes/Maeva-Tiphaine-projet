

import '../css/homepage.scss';


  

var homepage = {

   // property for matchMedia min-width:575.98px
   breakSmall: window.matchMedia("(min-width: 767.98px)"),


    /**
     * init homepage
     */
    init:function() { 

      console.log('init homepage');
 
    
      if (homepage.breakSmall.matches) { 
      console.log('match small'); 
        
      $('#mobile-slide').remove(); 
      $('#mobile-slide-2').remove(); 

      
 
      }


    } 



}

$(homepage.init);

