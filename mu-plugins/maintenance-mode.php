<?php
/*
 * Plugin Name: Maintenance Mode
 * Description: Displays a coming soon page for anyone who's not logged in. The login page gets excluded so that you can login if necessary.
 * Version: 1.0
 * Author: Thibaud
 * Author URI: mailto:thibaud@we-studio.ch
*/

add_action( 'wp_loaded', function() {

	global $pagenow;

	if ( !get_field( 'maintenance_mode_ednabled', 'option' ) )
		return;

	if ( $pagenow !== 'wp-login.php' && !current_user_can( 'manage_options' ) && !is_admin() ) :

    header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );

    if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) )
		  require_once( WP_CONTENT_DIR . '/maintenance.php' );

		die();

	endif;

});
