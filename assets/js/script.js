jQuery( document ).ready( function ( $ ) {

    $.wpMediaUploader({

        target : '.smartcat-uploader', // The class wrapping the textbox
        uploaderTitle : 'Select or upload image', // The title of the media upload popup
        uploaderButton : 'Set image', // the text of the button in the media upload popup
        multiple : true, // Allow the user to select multiple images
        buttonText : 'Upload image', // The text of the upload button
        buttonClass : '.smartcat-upload', // the class of the upload button
        previewSize : '150px', // The preview image size
        modal : false, // is the upload button within a bootstrap modal ?
        buttonStyle : { // style the button
            color : '#fff',
            background : '#3bafda',
            fontSize : '16px',                
            padding : '10px 15px',                
        },

    });

});