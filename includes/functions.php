<?php

namespace mfi;

/*
 * 
 * 1- get all active post types ☺
 * 2- create the metabox for the more featured images and add it to all the active post types
 * 3- create the functionality of the metabox ( help from bilal )
 * 4- create shortcode & function for frontend output
 * 
 */

// callback function
// hook
/**
 * Returns list of all active post types
 * @since 1.0.0
 */
function get_all_post_types(){
        $args = array(
       'public'   => true,
       '_builtin' => false
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'

    $post_types = get_post_types( $args, $output, $operator ); 

    $all_post_types = array('page', 'post');
    
    foreach ( $post_types  as $post_type ) {

        array_push($all_post_types, $post_type);
        
    }
    return $all_post_types;
}

add_action( 'init', 'mfi\get_all_post_types', 0, 99 );

class mfi_metabox {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

            $all_post_types = get_all_post_types();
            
            foreach ( $all_post_types as $post_type ) {
                
                add_meta_box(
                    'mfi_image_upload',
                    __( 'Upload Image', 'mfi' ),
                    array( $this, 'render_mfi_metabox' ),
                    $post_type,
                    'normal',
                    'default'
                ); 
                                
            }  
            
	}
        
        public function render_mfi_metabox( $post ) {
            // Add nonce for security and authentication.
            wp_nonce_field( 'mfi_images_nonce_action', 'mfi_images_nonce' );

            // Retrieve an existing value from the database.
            $mfi_images = get_post_meta( $post->ID, 'mfi_image', true );
            var_dump($mfi_images);
            
            // Form fields.
            echo '<table class="form-table">';
           
            echo '  <div class="form-group smartcat-uploader">
                
                        <label for="logo">Selected Logo</label>';
            
            
                echo    '<div>';
                echo        '<ul id="mfi_images">';

                            foreach ( $mfi_images as $mfi_image ){

                                echo '<li class="mfi_image_item" >
                                        <input type="hidden" name="mfi_image[]" value="' . $mfi_image . '" /> 
                                        <img src = "' . $mfi_image . '" style="padding: 5px; heigth:auto; width:200px;  />
                                        <span class="remove_mfi_image">Close</span>
                                </li>';

                            }
                echo        '</ul>';
                echo '</div>';
                            
            echo '</div>';

            

            echo '</table>';
        }
                
	public function save_metabox( $post_id, $post ) {       
            
		$nonce_name   = isset( $_POST['mfi_images_nonce'] ) ? $_POST['mfi_images_nonce'] : '';
		$nonce_action = 'mfi_images_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

//		 Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;
                
		// Sanitize user input.
                $mfi_images_new = isset( $_POST[ 'mfi_images' ] ) ?  $_POST[ 'mfi_images' ] : '';

		// Update the meta field in the database.
                update_post_meta( $post_id, 'mfi_images', $mfi_images_new );

	}

}
new mfi_metabox;


