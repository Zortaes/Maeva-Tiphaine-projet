import '../css/feedback.scss';

$(document).ready(function(){
    var maxLength = 150;
    readMore();

    function readMore()
    {
        $(".feedback").each(function(){
            var myStr = $(this).text();
            if($.trim(myStr).length > maxLength){
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more">lire la suite...</a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
                
                
            }
        });

        $(".read-more").click(function(){
            $(this).siblings(".more-text").contents().unwrap();
            $(".read-more").remove();
            readLess();
    
        });
    }


    function readLess()
    {
        $(".feedback").each(function(){
            var myStr = $(this).text();
            if($.trim(myStr).length > maxLength)
            {
                $(this).append(' <a href="javascript:void(0);" class="read-less">refermer...</a>');
            }  
        });

        $(".read-less").click(function(){
            var myStr = $(this).text();
            $(".read-less").remove();
            readMore();

        });
    }
    
});

