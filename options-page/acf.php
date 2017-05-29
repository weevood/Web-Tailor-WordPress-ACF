<?php

////////////////////////////////////////////////////////////////////////////////
// ! Advanced Custom Fields
////////////////////////////////////////////////////////////////////////////////

// Register custom get_field function
function ws_get_field( $field, $id = NULL, $format = NULL ) {
	return class_exists('acf') ? get_field( $field, $id, $format ) : false;
}

// Check if ACF Pro plugin is installed and activated
if ( !class_exists('acf') ) :

  add_action( 'admin_notices', function() {
  	echo (
			'<div class="notice notice-error">' .
				'<p>' . __( 'Please install and activate the <b>ACF Pro</b> plugin! ', 'ws-starter' ) .
					'<a href="https://www.advancedcustomfields.com/pro/" target="_blank">www.advancedcustomfields.com</a>' .
				'</p>' .
			'</div>'
		);
  });

	if ( !is_admin() )
		wp_die( __( 'Please install and activate the <b>ACF Pro</b> plugin!', 'ws-starter' ) );

endif;

// Resgister options pages
if( function_exists('acf_add_options_page') ) {

	$parent = acf_add_options_page(array(
    'page_title' => 'Theme Options',
  	'menu_slug'  => 'ws-starter-options',
  	'position'   => 63.3,
  	'icon_url'   => 'dashicons-admin-customizer',
	));

	acf_add_options_sub_page( array(
		'page_title'  => 'General',
		'parent_slug' => $parent['menu_slug'],
	));

	acf_add_options_sub_page( array(
    'page_title'  => 'Restricted Access',
		'parent_slug' => $parent['menu_slug'],
	));

}
