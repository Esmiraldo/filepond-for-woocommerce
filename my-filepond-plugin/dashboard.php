<?php

// Create custom dashboard page for uploaded files
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

?>
