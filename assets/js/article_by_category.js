import '../css/article_by_category.scss';



/* 1 */
var $firstItemPagination = $('.pagination span:first-child'); 

/* 1 */
$firstItemPagination.css({
    borderTopLeftRadius : '12px 12px', 
    borderBottomLeftRadius : '12px 12px'
   
});

/* 2 */
var $lastItemPagination = $('.pagination span:last-child');

/* 2 */
$lastItemPagination.css({
    borderTopRightRadius : '12px 12px', 
    borderBottomRightRadius : '12px 12px', 
    borderRight : 'none'
   
});

