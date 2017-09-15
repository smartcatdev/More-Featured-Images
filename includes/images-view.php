<?php

namespace mfi;

function do_shortcode_output( $atts ) {
    
    $args = shortcode_atts( array(
        'template' => 'grid'
    ), $atts );
    
    if ( $args ) {
        include template_path( $args['template'] );
    }
    
}

add_shortcode( 'featured-images', 'mfi\do_shortcode_output' );