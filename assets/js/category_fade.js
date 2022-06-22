$(function(){

    $('.parent_cat').each(
        function(){
            var $child_cat = $(this).find('.child_cat');
            $(this).hover(
                function(){$child_cat.fadeIn();},
                function(){$child_cat.fadeOut();}
            );
        }
    )
});