<?php
// Add custom order meta data for uploaded file
function wc_filepond_add_order_meta( $order_id ) {
  $file_id = get_post_meta( $order_id, 'wc_filepond_upload', true );
  
  if ( $file_id ) {
    // Get uploaded file URL
    $file_url = wp_get_attachment_url( $file_id );
    
    update_post_meta( $order_id, 'wc_filepond_file_url', $file_url );
    
    update_post_meta( $order_id, 'wc_filepond_file_id', $file_id );
  }
}
add_action( 'woocommerce_checkout_update_order_meta', 'wc_filepond_add_order_meta' );

// Display uploaded file URL in order meta data on order page
function wc_filepond_display_order_meta( $order ) {
  // Get uploaded file URL from order meta data
  $file_url = get_post_meta( $order->get_id(), 'wc_filepond_file_url', true );
  
  if ( $file_url ) {
    echo '<p><strong>Uploaded File:</strong> <a href="' . $file_url . '">' . $file_url . '</a></p>';
  }
}
add_action( 'woocommerce_order_details_after_order_table', 'wc_filepond_display_order_meta' );

?>
