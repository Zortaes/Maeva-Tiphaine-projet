import '../css/form.scss';


$('form button').css({"background-color":"#212529", "border-color":"#212529"})


/********************
 Form Add a Article 
 *********************/
var $collectionHolder;

/* setup an "add a Ingredient" link */ 
var $addIngredientButton = $('<button type="button" class="add_ingredient_link">+</button>');
var $newLinkDiv = $('<div></div>').append($addIngredientButton);



jQuery(document).ready(function() {

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
    var $newFormIngredient = $('<div></div>').append(newForm);
    $newLinkDiv.before($newFormIngredient);

  
    /* Add a delete link to the new form */
    addIngredientFormDeleteLink($newFormIngredient);
}

function addIngredientFormDeleteLink($ingredientForm) {

    var $removeFormButton = $('<button type="button">Delete this Ingredient</button>');
    $ingredientForm.append($removeFormButton);

    $removeFormButton.on('click', function(e) {

        /* Remove the div for the Ingredient form */
        $ingredientForm.remove();

    });
}