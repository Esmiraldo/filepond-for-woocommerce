<?php

// Create custom dashboard page for uploaded files and settings
function wc_filepond_create_dashboard_page() {
  add_menu_page(
    'File Upload Dashboard',
    'File Upload Dashboard',
    'manage_options',
    'file-upload-dashboard',
    'wc_filepond_display_dashboard_page',
    'dashicons-media-default',
    99
  );
  add_submenu_page(
    'file-upload-dashboard',
    'File Upload Settings',
    'Settings',
    'manage_options',
    'file-upload-settings',
    'wc_filepond_display_settings_page'
  );
}
add_action( 'admin_menu', 'wc_filepond_create_dashboard_page' );

// Display custom dashboard page for uploaded files
function wc_filepond_display_dashboard_page() {
  // Check if current user has access to the dashboard page
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }
  
  $filename = plugin_dir_path( __FILE__ ) . 'front-dash.php';
  
	if ( file_exists( $filename ) ) {
		require $filename;
	} else {
		echo "file not found. bzn.gr";
	}
}
function wc_filepond_register_settings() {
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_allowed_file_types' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_enable_required' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_enable_disabled' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_enable_drop' );
  /// rest
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_allow_multiple' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_max_files_handle' );
  // sizehand
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_file_size_val' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_file_size_val_min' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_max_upload_size' );
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_max_total_size' );
  // preview
  register_setting( 'wc_filepond_settings_group', 'wc_filepond_enable_preview' );
  register_setting( 'wc_filepond_settings_group', 'imagePreviewMinHeight' );
  register_setting( 'wc_filepond_settings_group', 'imagePreviewMaxHeight' );
  register_setting( 'wc_filepond_settings_group', 'imagePreviewHeight' );
  // size valid
  register_setting( 'wc_filepond_settings_group', 'allowFileTypeValidation' );
}
add_action( 'admin_init', 'wc_filepond_register_settings' );

// Display custom settings page for file uploads
function wc_filepond_display_settings_page() {
  // Check if current user has access to the settings page
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }

  $filename = plugin_dir_path( __FILE__ ) . 'front-settings.php';
  
	if ( file_exists( $filename ) ) {
		require $filename;
	} else {
		echo "file not found. bzn.gr";
	}
}

?>
