<?php
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
