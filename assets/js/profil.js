import '../css/profil.scss';

import 'cropperjs/dist/cropper.min';
import 'jquery-cropper/dist/jquery-cropper.min.js';
import 'bootstrap/js/dist/modal';
import * as Cropper from '../../vendor/presta/image-bundle/Resources/public/js/cropper.js';

$(".cropper-local").removeClass('col-4').addClass('col-12 col-xl-7 cropper-local-custum');

$(".close").addClass('col-2 col-lg-1');

$('.modal-footer').addClass('d-flex flex-nowrap justify-content-around');

$('.w-25').addClass('showUpload');

/* If the user have a default avatar */
if($('.cropper-canvas-container').children().attr('src') == "/uploads/user/avatar/defaultAvatar.jpg")
{
    $('.cropper-canvas-container').hide();

    $('.delete').removeClass('delete'); 
    
    $(".cropper-local").removeClass('cropper-local-custum').addClass("mb-4 mt-3 col-sm-6"); 
}


/* add btn "supprimer" prepend to btn "importer" */
var $btnParent = $(".cropper-local").parent(".row");
var $btnDelete = $(".delete"); 

$(".btn-delete").addClass("w-75"); 
$btnDelete.addClass('col-12 col-xl-7 mx-auto'); 

$btnDelete.prependTo($btnParent); 


/* Pluging cropper */
(function(w, $) {

    'use strict';

    $(function() {
        $('.cropper').each(function() {
            new Cropper($(this));
        });
        $('.showUpload').click(function()
        {
            $('.cropper-canvas-container').show();
            $('.avatarUser').hide();
        })

    });
  

})(window, jQuery);