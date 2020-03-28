

import '../css/homepage.scss';


  

var homepage = {

   // property for matchMedia min-width:575.98px
   breakSmall: window.matchMedia("(min-width: 575.98px)"),


    /**
     * init homepage
     */
    init:function() { 
      console.log('init homepage');


      let $firstElement = $('carousel-item:first	').addClass('active'); 
      console.log($firstElement); 


      //$(document).ready(function() {
      //  $("#myCarousel").on("slide.bs.carousel", function(e) {
      //    var $e = $(e.relatedTarget);
      //    var idx = $e.index();
      //    var itemsPerSlide = 3;
      //    var totalItems = $(".carousel-item").length;
      //
      //    if (idx >= totalItems - (itemsPerSlide - 1)) {
      //      var it = itemsPerSlide - (totalItems - idx);
      //      for (var i = 0; i < it; i++) {
      //        // append slides to end
      //        if (e.direction == "left") {
      //          $(".carousel-item")
      //            .eq(i)
      //            .appendTo(".carousel-inner");
      //        } else {
      //          $(".carousel-item")
      //            .eq(0)
      //            .appendTo($(this).find(".carousel-inner"));
      //        }
      //      }
      //    }
      //  });
      //});
     //
    //

    
      if (homepage.breakSmall.matches) { 
      console.log('match small'); 
      let $elements = $('.carousel-item').length; 
      let $secondElement = $('.carousel-item').next(); 
     console.log($secondElement); 
      
      //$secondElement.addClass('active'); 
      }


    } 



}

$(homepage.init);

console.log('ta soeur')