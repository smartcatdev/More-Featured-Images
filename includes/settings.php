<?php

namespace mfi;

/**
 * Creates the options page under Settings in the dashboard
 */
add_action( 'admin_menu', function(){
    
    add_options_page( __( 'More featured images', 'mfi' ), __( 'More Featured Images', 'mfi' ), 'manage_options', 'mfi-settings', 'mfi\output_options_page' );
    
});

function output_options_page() { ?>

    <h2><?php _e( 'More Featured Images Options Page', 'mfi' ); ?></h2>
    
    <form action="options.php" method="POST">
    
        <?php settings_fields('mfi-settings'); ?>
        <?php do_settings_sections( 'mfi-settings' ); ?>
        <?php submit_button(); ?>
        
    </form>
    
<?php }

function register_settings() {
    
    register_setting( 'mfi-settings', Options::ACTIVE_POST_TYPES, array(
    'type'                  => 'string',
    'sanitize_callback'     => 'mfi\sanitize_active_post_types', //TODO make function to check if post types actually exist
    'default'               => get_all_post_types()
        
    ) );
        
}

add_action( 'init', 'mfi\register_settings' );

function create_settings_sections() {
    
    add_settings_section( 'mfi-settings', __( 'Select post types', 'mfi' ), '', 'mfi-settings' );
    
}

add_action( 'admin_init', 'mfi\create_settings_sections' );

function add_settings_fields() {
    
        add_settings_field(
            Options::ACTIVE_POST_TYPES,
            __( 'Post Types', 'mfi' ),
            'mfi\render_checkbox_field',
            'mfi-settings',
            'mfi-settings'
        );
        
}

add_action( 'admin_init', 'mfi\add_settings_fields' );

function render_checkbox_field() { ?>
    
    <?php $post_types = get_all_post_types(); ?>
    <?php $option = get_option( Options::ACTIVE_POST_TYPES ); ?>
    
    <feildset>
        
        <?php foreach ($post_types as $post_type ) {?>

            <?php $post = get_post_type_object($post_type); ?>

            <label>
            <input type="checkbox" 
                   value="<?php esc_attr_e($post_type); ?>"
                   name="<?php echo Options::ACTIVE_POST_TYPES ?>[]"
                   <?php checked( true, in_array( $post_type, $option ), true )?> />

            <?php echo $post->labels->name; ?></label></br>

        <?php } ?>
        
    </feildset>    
    
<?php }

function sanitize_active_post_types( $input ) {
    
    if ( is_array( $input ) ) {
        
        $all_types = get_all_post_types();        
        
        foreach ( $input as $single_input ) {
            
            if ( !in_array( $single_input, $all_types ) ) {
                
                unset( $input[ $single_input ] );
                
            }
            
        }
        
        return $input;

    }
       
    return array();
    
}