<?php
/**
In this example, the order-meta.php file adds custom order meta data for the uploaded file, and displays the uploaded file URL in the order meta data on the order page.

The file contains two functions: wc_filepond_add_order_meta and wc_filepond_display_order_meta. The wc_filepond_add_order_meta function is hooked to the woocommerce_checkout_update_order_meta action, and it retrieves the uploaded file ID from the order meta data using the get_post_meta function, and adds the uploaded file URL and ID to the order meta data using the update_post_meta function.

The wc_filepond_display_order_meta function is hooked to the woocommerce_order_details_after_order_table action, and it retrieves the uploaded file URL from the order meta data using the get_post_meta function, and displays it in the order meta data using an echo statement.

This is just one example of how the order-meta.php file could be implemented, and it may need to be adapted based on your specific requirements and setup.
 **/
// Add custom order meta data for uploaded file
function wc_filepond_add_order_meta( $order_id ) {
  // Get uploaded file ID from order meta data
  $file_id = get_post_meta( $order_id, 'wc_filepond_upload', true );
  
  // Check if uploaded file ID exists
  if ( $file_id ) {
    // Get uploaded file URL
    $file_url = wp_get_attachment_url( $file_id );
    
    // Add uploaded file URL to order meta data
    update_post_meta( $order_id, 'wc_filepond_file_url', $file_url );
    
    // Add uploaded file ID to order meta data
    update_post_meta( $order_id, 'wc_filepond_file_id', $file_id );
  }
}
add_action( 'woocommerce_checkout_update_order_meta', 'wc_filepond_add_order_meta' );

// Display uploaded file URL in order meta data on order page
function wc_filepond_display_order_meta( $order ) {
  // Get uploaded file URL from order meta data
  $file_url = get_post_meta( $order->get_id(), 'wc_filepond_file_url', true );
  
  // Check if uploaded file URL exists
  if ( $file_url ) {
    // Display uploaded file URL in order meta data
    echo '<p><strong>Uploaded File:</strong> <a href="' . $file_url . '">' . $file_url . '</a></p>';
  }
}
add_action( 'woocommerce_order_details_after_order_table', 'wc_filepond_display_order_meta' );

?>
