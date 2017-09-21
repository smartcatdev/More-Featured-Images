<?php
/**
 * 
 * @param String $atts  The name of the template to be used
 */
function get_more_featured_images( $atts = 'grid' ) {
    
    $args = array( 'template' => $atts );
    
    mfi\do_shortcode_output( $args );
    
}
