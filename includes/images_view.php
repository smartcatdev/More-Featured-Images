<?php

namespace mfi;

function do_shortcode_output( $atts ) {
  
    ob_start();
    
    $post_types = get_option( Options::ACTIVE_POST_TYPES );
    
    if ( in_array( get_post_type(), $post_types ) ) {
            
        $args = shortcode_atts( array(
            'template' => 'grid'
        ), $atts );
        
        if ( template_path( $args['template'] ) ) {
            
            include template_path( $args['template'] );
            
        }
        
    }   
    
    return ob_get_clean();
    
}

add_shortcode( 'featured-images', 'mfi\do_shortcode_output' );
