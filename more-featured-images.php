<?php
/*
 * Plugin Name: More Featured Images
 * Plugin URI: https://smartcatdesign.net/articles/add-extra-featured-images-wordpress-post-page-custom-post/
 * Description: Add more featured images to your Posts, Pages and Custom Post Types. Bulk upload, Drag & drop re-order.
 * Version: 1.0.0
 * Author: Smartcat
 * Author URI: https://smartcatdesign.net
 * License: GPL2
*/

namespace mfi;

/**
 * Include constants and Options definitions
 */
include_once dirname( __FILE__ ) . '/constants.php';

/**
 * Includes required files and initializes the plugin.
 *
 * @since 1.0.0
 */
function init() {

    if ( PHP_VERSION >= Defaults::MIN_PHP_VERSION ) {

        include_once dirname( __FILE__ ) . '/includes/functions.php';
        include_once dirname( __FILE__ ) . '/includes/settings.php';
        include_once dirname( __FILE__ ) . '/includes/images_view.php';
        include_once dirname( __FILE__ ) . '/includes/public_functions.php';
                
    } else {
        
        make_admin_notice( __( 'Your version of PHP (' . PHP_VERSION . ') does not meet the minimum required version (5.4+) to run More featured images' ) );
        
    }

}

add_action( 'plugins_loaded', 'mfi\init' );

function make_admin_notice( $message, $type = 'error', $dismissible = true ) {

    add_action( 'admin_notices', function () use ( $message, $type, $dismissible ) {

        echo '<div class="notice notice-' . esc_attr( $type ) . ' ' . ( $dismissible ? 'is-dismissible' : '' ) . '">';
        echo '<p>' . $message . '</p>';
        echo '</div>';

    } );

}

/**
 * Runs on plugin activation.
 *
 * @since 1.0.0
 */
function activate() {

    init();

}

register_activation_hook( __FILE__, 'mfi\activate' );

function register_admin_scripts() {

        wp_enqueue_style( 'mfi-common', asset( 'css/common.css' ), null, VERSION );
                
	wp_enqueue_script( 'wp_media_uploader', asset( 'js/wp_media_uploader.js' ), array( 'jquery' ), VERSION );
	wp_enqueue_script( 'mfi_admin_script', asset( 'js/script.js' ), array( 'jquery', 'jquery-ui-sortable', 'wp_media_uploader' ), VERSION );

}

add_action( 'admin_enqueue_scripts', 'mfi\register_admin_scripts' );

function register_scripts() {

	wp_enqueue_style( 'mfi-style', asset( 'css/style.css' ), null, VERSION );

}

add_action( 'init', 'mfi\register_scripts' );


/**
 * Get the URL of an asset from the assets folder.
 *
 * @param string $path
 * @return string
 * @since 1.0.0
 */
function asset( $path = '', $url = true ) {

    if( $url ) {
        $file = trailingslashit( plugin_dir_url( __FILE__ ) );
    } else {
        $file =  trailingslashit( plugin_dir_path( __FILE__ ) );
    }

    return $file . 'assets/' . ltrim( $path, '/' );

}
/**
 * Get the path of a template file.
 *
 * @param  string      $template The file name in the format of file.php.
 * @return bool|string           False if the file does not exist, the path if it does.
 */
function template_path( $template ) {

    $template = trim( $template, '/' );
    $template = rtrim( $template, '.php' );

    $base = trailingslashit( dirname( __FILE__ ) . '/templates' );

    $file = $base . $template . '.php';

    if( file_exists( $file ) ) {
        return $file;
    }

    return false;

}