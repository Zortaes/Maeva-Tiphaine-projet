

import '../css/homepage.scss';


  

var homepage = {

   // property for matchMedia min-width:575.98px
   breakSmall: window.matchMedia("(min-width: 767.98px)"),

   // property for matchMedia min-width:575.98px
   breakExtraLarge: window.matchMedia("(min-width: 1600px)"),


    /**
     * init homepage
     */
    init:function() { 

      console.log('init homepage');
 
      
      if (homepage.breakSmall.matches) 
      { 
      console.log('match small'); 
        
      $('#mobile-slide').remove(); 
      $('#mobile-slide-2').remove();  
 
      }

      if (homepage.breakExtraLarge.matches) 
      { 
        console.log('match extra large'); 
          
        $('.container-paragraph-xxl').addClass('col-xl-12'); 
       
      }
  


    } 



}

$(homepage.init);

