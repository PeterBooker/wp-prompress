<?php
/**
 * Plugin Name: PromPress
 * Plugin URI: https://github.com/PeterBooker/prompress/
 * Description: Prometheus client for WordPress specific metrics.
 * Version: 0.1.0
 * Author: Peter Booker
 *
 * @package prompress
 */

// Useful global constants
define( 'PP_VERSION', '0.7.0' );
define( 'PP_URL', plugin_dir_url(__FILE__) );
define( 'PP_PATH', plugin_dir_path(__FILE__) );
define( 'PP_FILE', plugin_basename(__FILE__) );

prompress_pre_init();

/**
 * Verify that we can initialize the PromPress, then load it.
 * 
 * @since 0.1.0
 */
function prompress_pre_init() {

    // Check WP Version
    // Get unmodified $wp_version.
	include ABSPATH . WPINC . '/version.php';
	// Strip '-src' from the version string. Messes up version_compare().
	$version = str_replace( '-src', '', $wp_version );
	if ( version_compare( $version, '4.8', '<' ) ) {
        add_action( 'admin_notices', 'prompress_wordpress_version_notice' );
        return;
	}
    
    // Check PHP Version
    if ( version_compare( PHP_VERSION, '7.1', '<' ) ) {
        add_action( 'admin_notices', 'prompress_php_version_notice' );
        return;
    }

    /**
     * Load plugin initialisation file.
     */
    require plugin_dir_path( __FILE__ ) . '/init.php';
	
}

/**
 * Display a WP version notice and deactivate the PromPress plugin.
 *
 * @since 0.1.0
 */
function prompress_wordpress_version_notice() {
	echo '<div class="error"><p>';
	echo 'PromPress requires WordPress 4.8 or later to function properly. Please upgrade WordPress before activating PromPress.';
	echo '</p></div>';
	deactivate_plugins( array( 'prompress/prompress.php' ) );
}

/**
 * Display a PHP version notice and deactivate the PromPress plugin.
 *
 * @since 0.1.0
 */
function prompress_php_version_notice() {
	echo '<div class="error"><p>';
	echo 'PromPress requires PHP 7.1 or later to function properly. Please upgrade PHP before activating PromPress.';
	echo '</p></div>';
	deactivate_plugins( array( 'prompress/prompress.php' ) );
}