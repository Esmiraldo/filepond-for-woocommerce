<?php
/*
Plugin Name: Filepond For woo
Description: Product Upload
Version: 1.0
Author: idyl ltd
*/
require_once( ABSPATH . 'wp-admin/includes/admin.php' );
require_once( ABSPATH . 'wp-admin/includes/ajax-actions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/filepond-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/session-handling.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/order-meta.php' );
require_once( plugin_dir_path( __FILE__ ) . 'dashboard/dashboard.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/tabs.php' );
add_action( 'wp_ajax_upload_file', 'upload_file_callback' );
add_action( 'wp_ajax_nopriv_upload_file', 'upload_file_callback' );

//require_once( plugin_dir_path( __FILE__ ) . 'inc/filepond-init.php' );
function wc_filepond_form_field_init() {
  // Register the filepond form field
  add_filter( 'woocommerce_form_field_filepond', 'wc_filepond_form_field', 10, 4 );
}
function wc_filepond_session_handling_init() {
	$file_path = plugin_dir_path( __FILE__ ) . 'inc/session-handling.php';
	
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	} else {
		error_log( 'WC Filepond Error: Failed to load session handling file.' );
	}
}
// Initialize FilePond Tab Functions
add_action( 'admin_init', 'wc_filepond_tab_init' );
function wc_filepond_order_meta_init() {
  // Add action to save uploaded file ID as order meta data
  add_action( 'woocommerce_checkout_update_order_meta', 'wc_filepond_add_order_meta' );
  add_action( 'woocommerce_order_details_after_order_table', 'wc_filepond_display_order_meta' );
}
function wc_filepond_dashboard_init() {
  // Add action to save uploaded file ID as order meta data
	add_action( 'admin_menu', 'wc_filepond_create_dashboard_page' );
}

function wc_filepond_form_field() {
	$file_path = plugin_dir_path( __FILE__ ) . 'front-end/form-field.php';
	
	if ( file_exists( $file_path ) ) {
		include $file_path;
	} else {
		error_log( 'WC Filepond Error: Failed to load form field template.' );
	}
}
// Activation and Deactivation Hooks
// register_activation_hook( __FILE__, 'wc_filepond_activate' );
// register_deactivation_hook( __FILE__, 'wc_filepond_deactivate' );

// Initialize plugin
add_action( 'plugins_loaded', 'wc_filepond_init' );
function wc_filepond_init() {
  // Initialize functions
  wc_filepond_functions_init();
  wc_filepond_form_field_init();
  wc_filepond_session_handling_init();
  wc_filepond_order_meta_init();
  wc_filepond_dashboard_init();
  
}
