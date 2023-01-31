<?php
function wc_filepond_session_handling() {
  // Start session if not already started
  if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
  }

  // Check if form was submitted
  if ( isset( $_POST['wc_filepond_upload'] ) ) {
    // Store uploaded file ID in session
    $_SESSION['wc_filepond_upload'] = $_POST['wc_filepond_upload'];
  }

  // Check if session contains uploaded file ID
  if ( isset( $_SESSION['wc_filepond_upload'] ) ) {
    // Get uploaded file ID from session
    $file_id = $_SESSION['wc_filepond_upload'];
  
    // Add uploaded file ID to order meta data
    add_post_meta( $order_id, 'wc_filepond_upload', $file_id );
  
    // Remove uploaded file ID from session
    unset( $_SESSION['wc_filepond_upload'] );
  }
}


?>
