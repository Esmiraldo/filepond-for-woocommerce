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
  
  // Get all orders that contain uploaded files
  $args = array(
    'post_type' => 'shop_order',
    'meta_query' => array(
      array(
        'key' => 'wc_filepond_file_id',
        'compare' => 'EXISTS',
      ),
    ),
  );
  $orders = get_posts( $args );
  
  // Display table of orders with uploaded files
  echo '<table class="wp-list-table widefat striped">';
  echo '<thead>';
  echo '<tr>';
  echo '<th scope="col">Order ID</th>';
  echo '<th scope="col">Uploaded File</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  foreach ( $orders as $order ) {
    $order_id = $order->ID;
    $file_id = get_post_meta( $order_id, 'wc_filepond_file_id', true );
    $file_url = get_post_meta( $order_id, 'wc_filepond_file_url', true );
    echo '<tr>';
    echo '<td>' . $order_id . '</td>';
    echo '<td><a href="' . $file_url . '">' . $file_url . '</a></td>';
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
}

// Display custom settings page for file uploads
function wc_filepond_display_settings_page() {
  // Check if current user has access to the settings page
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }

// Get current max file size and type settings
$max_file_size = get_option( 'wc_filepond_max_file_size' );
$allowed_file_types = get_option( 'wc_filepond_allowed_file_types' );

// Display form for updating max file size and type settings (not sure if its working)
echo '<form method="post" action="">';
echo '<table class="form-table">';
echo '<tbody>';
echo '<tr>';
echo '<th scope="row">Max File Size (in MB)</th>';
echo '<td><input type="number" name="wc_filepond_max_file_size" value="' . $max_file_size . '"></td>';
echo '</tr>';
echo '<tr>';
echo '<th scope="row">Allowed File Types</th>';
echo '<td><input type="text" name="wc_filepond_allowed_file_types" value="' . $allowed_file_types . '"></td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>';
echo '</form>';

// Handle form submission
if ( isset( $_POST['submit'] ) ) {
update_option( 'wc_filepond_max_file_size', sanitize_text_field( $_POST['wc_filepond_max_file_size'] ) );
update_option( 'wc_filepond_allowed_file_types', sanitize_text_field( $_POST['wc_filepond_allowed_file_types'] ) );
echo '<div class="notice notice-success is-dismissible"><p>Settings updated successfully.</p></div>';
}
}

?>
