<?php
/*
Plugin Name: WooCommerce FilePond Upload
Description: filepond-functions.php - This file contains the main functions for integrating FilePond with WooCommerce. It includes the necessary enqueues for the FilePond library and styles, as well as functions for displaying the FilePond field on the product page and processing the uploaded image.
form-field.php - This file contains the function for adding a custom form field to the WooCommerce product page. The function hooks into the WooCommerce checkout process and adds the FilePond field to the product page, allowing customers to upload an image.
session-handling.php - This file contains functions for managing the uploaded image in the session. It includes functions for storing the uploaded image in the session, retrieving the image from the session, and clearing the session data when necessary.
order-meta.php - This file contains functions for saving and retrieving the uploaded image from the order meta. It includes functions for adding the uploaded image as order meta when the order is placed, and retrieving the image from the order meta for display on the custom dashboard.
dashboard.php - This file contains the functions for creating and displaying the custom dashboard. It includes functions for adding a custom menu item to the WordPress dashboard, creating the custom dashboard page, and displaying the uploaded images and order details in a table.
Version: 1.0
Author: aldo
*/

// Include required files
require_once( plugin_dir_path( __FILE__ ) . 'filepond-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'session-handling.php' );
require_once( plugin_dir_path( __FILE__ ) . 'order-meta.php' );
require_once( plugin_dir_path( __FILE__ ) . 'dashboard.php' );
function wc_filepond_form_field_init() {
  // Register the filepond form field
  add_filter( 'woocommerce_form_field_filepond', 'wc_filepond_form_field', 10, 4 );
}
function wc_filepond_session_handling_init() {
include_once( 'session-handling.php' );
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
  // Output the filepond form field
	include 'form-field.php';
}

// Activation and Deactivation Hooks
register_activation_hook( __FILE__, 'wc_filepond_activate' );
register_deactivation_hook( __FILE__, 'wc_filepond_deactivate' );

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
