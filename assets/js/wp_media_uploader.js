/**
 * 
 * wpMediaUploader v1.0 2016-11-05
 * Copyright (c) 2016 Smartcat
 * 
 */
( function( $ ) {
    
    $.mfiMediaUploader = function( options ) {
        
        console.log( 'wp_media_uploader.js' )
        
        var settings = $.extend({
            
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
            
        }, options );
                
        $( ".smartcat-multiple-uploader" ).append( '<li class="not-sort">\n\
                                        <a href="#" class="' + settings.buttonClass.replace( '.', '' ) + '">' + settings.buttonText + '</a>\n\
                                           </li>' );
                
        $( settings.buttonClass ).css( settings.buttonStyle );
                
        $( 'body' ).on( 'click', settings.buttonClass, function( e ) {
            
            e.preventDefault();
            var selector = $( this ).parent( settings.target );
            var custom_uploader = wp.media({
                title: settings.uploaderTitle,
                button: {
                    text: settings.uploaderButton
                },
                multiple: settings.multiple
            })
            
            .on( 'select', function() {
                
                var attachment = custom_uploader.state().get( 'selection' ).toJSON();                           

                for ( var i = 0; i < attachment.length; i++ ) {
                                        
                    $( "#mfi_images" ).append('\
                        <li class="mfi_image_item" style="background-image: url(' + attachment[i].url + ');" >\n\
                            <input type="hidden" name="mfi_image[]" value="' + attachment[i].url + '" /> \n\
                            <span class="remove_mfi_image">X</span>\n\
                        </li>');                    
                                        
                }
                
                if( settings.modal ) {
                    $( '.modal' ).css( 'overflowY', 'auto' );
                }
                
            })
            .open();
        });
                
    };
    
})( jQuery );
