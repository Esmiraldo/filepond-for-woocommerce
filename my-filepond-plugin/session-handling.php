<?php
/** 
In this example, the session-handling.php file handles the storage and retrieval of the uploaded file ID between form submissions and order processing. The file starts the session if it is not already started, and checks if the form was submitted by checking if the wc_filepond_upload POST variable is set.
If the form was submitted, the uploaded file ID is stored in the session under the key wc_filepond_upload. During the order processing, the file checks if the session contains the uploaded file ID. If it does, the file retrieves the uploaded file ID, adds it to the order meta data using the add_post_meta function, and removes it from the session.
This is just one example of how the session-handling.php file could be implemented, and it may need to be adapted based on your specific requirements and setup.
**/
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
