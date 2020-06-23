import '../css/formArticle.scss';
// import 'cropperjs/dist/cropper.min';
// import 'jquery-cropper/dist/jquery-cropper.min.js';
// import 'bootstrap/js/dist/modal';
// import * as Cropper from '../../vendor/presta/image-bundle/Resources/public/js/cropper.js';

/*************************
 Form new Article and edit
 ************************/
var $collectionHolder;

/* setup an "add a Ingredient" link */ 
var $addIngredientButton = $('<button type="button" class="add_ingredient_link">ajouter un ingrédient</button>').addClass('btn btn-primary button-add-ingredient');
var $newLinkDiv = $('<div></div>').append($addIngredientButton);


jQuery(document).ready(function() {

    /************
    EDIT ARTICLE
    ************/

   console.log($(".existingIngredients").find('input').length); 

    /* if 1 input left remove delete button*/
    if($(".existingIngredients").find('input').length == 3)
    {
        $('.deleteExistingIngredient').remove("button");
    }

    /* delete existing article*/
    $(".deleteExistingIngredient").on('click', function(e) {

        /* Remove the last ingredient of the existing ingredient's list */
        $('.existingIngredients').children().last().remove();

            /* if 1 input left remove delete button*/
        if($(".existingIngredients").find('input').length == 3)
        {
            $('.deleteExistingIngredient').remove("button");
        }

    });


    /*********************
    ADD NEW INGREDIENT DIV
    *********************/
    
    /* Get the div that holds the collection of Ingredients */ 
    $collectionHolder = $('div.ingredients');


    /* Add a delete link to all of the existing Ingredient added */ 
    $collectionHolder.find('div .ingredients').each(function() {
        addIngredientFormDeleteLink($(this));
    });


    /* Add the "add a Ingredient" anchor and div to the Ingredients div */ 
    $collectionHolder.append($newLinkDiv);


    /* Count the current form inputs we have (e.g. 2), use that as the new
     index when inserting a new item (e.g. 2) */
    $collectionHolder.data('index', $collectionHolder.find('input').length);


    $addIngredientButton.on('click', function(e) {

        /* Add a new Ingredient form (see next code block) */ 
        addIngredientForm($collectionHolder, $newLinkDiv);

    });


});

function addIngredientForm($collectionHolder, $newLinkDiv) {


    /* Get the data-prototype */ 
    var prototype = $collectionHolder.data('prototype');

    /* Get the new index */
    var index = $collectionHolder.data('index');

    var newForm = prototype;
   
    /* Replace '__name__' in the prototype's HTML to
    instead be a number based on how many items we have */
    newForm = newForm.replace(/__name__/g, index);
     
    

    /* Increase the index with one for the next item */
    $collectionHolder.data('index', index + 1);

   
    /* Display the form in the page in an div, before the "Add a Ingredient" link div */
    var $newFormIngredient = $('<div></div>').append(newForm).addClass('other-ingredient');
    $newLinkDiv.before($newFormIngredient);

  
    /* Add a delete link to the new form */
    addIngredientFormDeleteLink($newFormIngredient);
}

function addIngredientFormDeleteLink($ingredientForm) {

    var $removeFormButton = $('<button type="button">supprimer l\'ingrédient</button>').addClass('btn btn-primary  button-delete-ingredient');
    $ingredientForm.append($removeFormButton);

    $removeFormButton.on('click', function(e) {

        /* Remove the div for the Ingredient form */
        $ingredientForm.remove();

    });
}


    /*********************
     ADD ARTICLE IMAGE
    *********************/

    // $(".cropper-local").removeClass('col-4').addClass('col-8 col-sm-6');

    // $(".close").addClass('col-2 col-lg-1');

    // $('.modal-footer').addClass('d-flex flex-nowrap justify-content-around');


    // (function(w, $) {

    //     'use strict';

    //     $(function() {
    //         $('.cropper').each(function() {
    //             new Cropper($(this));
    //         });
    //     });

    // })(window, jQuery);




