jQuery( document ).ready( function ( $ ) {

    $( "#mfi_images" ).sortable();
    
    $( "#mfi_images" ).disableSelection();
    
    $( '#mfi_images' ).on( 'click', 'li.mfi_image_item .remove_mfi_image', function() {
       
       $( this ).parent().hide( 'slow', function(){  $( this ).remove(); });
       
    });

});