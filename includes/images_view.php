<?php

namespace mfi;

function do_shortcode_output( $atts ) {
  
    $post_types = get_option( Options::ACTIVE_POST_TYPES );
    
    if ( in_array( get_post_type(), $post_types ) ) {
            
        $args = shortcode_atts( array(
            'template' => 'grid'
        ), $atts );
        
        if ( template_path( $args['template'] ) ) {
            
            include template_path( $args['template'] );
            
        }
        
    }   
    
}

add_shortcode( 'featured-images', 'mfi\do_shortcode_output' );
