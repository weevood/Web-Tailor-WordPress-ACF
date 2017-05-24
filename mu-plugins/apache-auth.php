<?php
/*
 * Plugin Name: Apache Authentification
 * Description: Enable the user Apache Authentification via .htacess file.
 * Version: 1.0
 * Author: Thibaud
 * Author URI: mailto:thibaud@we-studio.ch
*/

// Encrypt password on save
add_filter('acf/update_value', function( $value, $post_id, $field ) {

	$passwords 		= array();
	$repeatField 	= 'apache_authentification_users';
	$passField 		= 'apache_authentification_users_password';
	$passFieldKey = 'field_59229bff31988';

	if( $field['name'] != $repeatField )
		return $value;

	if( have_rows( $repeatField, 'option' ) ):
		while ( have_rows( $repeatField, 'option' ) ) : the_row();
			array_push( $passwords, get_sub_field( $passField, 'option' ) );
		endwhile;
	endif;

	foreach ( $value as $key => &$user )
		if ( $user[$passFieldKey] != $passwords[$key] )
			$user[$passFieldKey] = base64_encode( sha1( $user[$passFieldKey], true ) );

	return $value;

}, 10, 3);

// Add new users to .htpasswd
add_action('acf/save_post', function() {

	$htpasswd 		= ABSPATH . '.htpasswd';
	$page 				= 'acf-options-restricted-access';
	$enabled		 	= 'apache_authentification_enabled';
	$repeatField 	= 'apache_authentification_users';
	$nameField 		= 'apache_authentification_users_name';
	$passField 		= 'apache_authentification_users_password';

	if ( !strpos( get_current_screen()->id, $page ) )
		return;

	$file = @fopen( $htpasswd, 'w' );

	if ( !$file || !is_writeable( $htpasswd ) || !file_exists( $htpasswd ) ) :
		update_field( $enabled, false, 'option' );
		flush_rewrite_rules();
		return;
	endif;

	if ( have_rows( $repeatField, 'option' ) ) :
    while ( have_rows( $repeatField, 'option' ) ) : the_row();

	    $username = trim( get_sub_field( $nameField, 'option' ) );
	    $password = trim( get_sub_field( $passField, 'option' ) );

			if ( $username && $password && current_user_can( 'manage_options' ) ):
				$content .= $username . ':{SHA}' . $password . PHP_EOL;

			endif;
    endwhile;
	endif;

	fwrite( $file, $content );
	fclose( $file );

	flush_rewrite_rules();

}, 20);

// Enable / Disable mode by rewrite .htaccess
add_filter('mod_rewrite_rules', function( $rules ) {

	$htpasswd = ABSPATH . '.htpasswd';
	$enabled 	= 'apache_authentification_enabled';

	if ( !get_field( $enabled, 'option' ) )
		return $rules;

	$content  = PHP_EOL;
	$content .= '# Apache Authentification' . PHP_EOL;
	$content .= 'AuthType Basic' . PHP_EOL;
	$content .= 'AuthName "Password Protected Area"' . PHP_EOL;
	$content .= 'AuthUserFile ' . $htpasswd . PHP_EOL;
	$content .= 'Require valid-user' . PHP_EOL;
	$content .= '# END Apache Authentification' . PHP_EOL;
	$content .= PHP_EOL;

	return $content . $rules;

});
