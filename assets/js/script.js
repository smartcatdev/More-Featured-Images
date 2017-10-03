jQuery( document ).ready( function ( $ ) {

    $.mfiMediaUploader({

        target : '.smartcat-multiple-uploader', // The class wrapping the textbox
        uploaderTitle : 'Select or upload image', // The title of the media upload popup
        uploaderButton : 'Set image', // the text of the button in the media upload popup
        multiple : true, // Allow the user to select multiple images
        buttonText : 'Upload image', // The text of the upload button
        buttonClass : '.smartcat-multiple-upload', // the class of the upload button
        previewSize : '200px', // The preview image size
        modal : false, // is the upload button within a bootstrap modal ?
        buttonStyle : { // style the button
            color : '#fff',
            background : '#3bafda',
            fontSize : '16px',                
            padding : '10px 8px',                
        },

    });
    

    $( "#mfi_images" ).sortable();
    
    $( "#mfi_images" ).disableSelection();
    
    $( '#mfi_images' ).on( 'click', 'li.mfi_image_item .remove_mfi_image', function() {
       
       $( this ).parent().hide( 'slow', function(){  $( this ).remove(); });
       
    });

});