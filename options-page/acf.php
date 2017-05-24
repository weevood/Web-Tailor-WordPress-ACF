<?php

////////////////////////////////////////////////////////////////////////////////
// ! Advanced Custom Fields
////////////////////////////////////////////////////////////////////////////////

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
