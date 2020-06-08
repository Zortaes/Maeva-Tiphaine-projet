import '../css/profil.scss';

import 'cropperjs/dist/cropper.min';
import 'jquery-cropper/dist/jquery-cropper.min.js';
import 'bootstrap/js/dist/modal';
import * as Cropper from '../../vendor/presta/image-bundle/Resources/public/js/cropper.js';

$(".cropper-local").removeClass('col-4').addClass('col-8 col-sm-6');

$(".close").addClass('col-2 col-lg-1');

$('.modal-footer').addClass('d-flex flex-nowrap justify-content-around');

$('.w-25').addClass('showUpload');

if($('.cropper-canvas-container').children().attr('src') == "/uploads/user/avatar/defaultAvatar.jpg")
{
    $('.cropper-canvas-container').hide();
}

(function(w, $) {

    'use strict';

    $(function() {
        $('.cropper').each(function() {
            new Cropper($(this));
        });
        $('.showUpload').click(function()
        {
        $('.cropper-canvas-container').show();
        $('.avatarUserdefault').hide();
        })

    });
  

})(window, jQuery);