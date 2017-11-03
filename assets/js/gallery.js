jQuery( document ).ready( function ( $ ) {

    $(window).load( function(){   
        
        $('.mfi-image-gallery').masonry({
            itemSelector: '.mfi-image-gallery-item',
            columnWidth: 200,
            gutter: 5,
            isFitWidth: true
        });
        
    });
    
});