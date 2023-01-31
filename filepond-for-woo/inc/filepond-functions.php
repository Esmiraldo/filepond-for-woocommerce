<?php

// Initialize FilePond Functions
function wc_filepond_functions_init() {
  add_action( 'wp_enqueue_scripts', 'wc_filepond_enqueue_scripts' );
  add_action( 'woocommerce_before_add_to_cart_button', 'wc_filepond_form_field' );
  add_action( 'woocommerce_checkout_update_order_meta', 'wc_filepond_process_image' );
}
function upload_file_callback() {
  $file = $_FILES['filepond'];
  // Process uploaded file
}
// Enqueue but i am not sure why, it works, keep it this way
function wc_filepond_enqueue_scripts() {
  wp_enqueue_script( 'filepond', "https://unpkg.com/filepond/dist/filepond.min.js", array(), '5.13.0', true );
  wp_enqueue_style( 'filepond', "https://unpkg.com/filepond/dist/filepond.min.css", array(), '5.13.0' );
}

// Process Uploaded Image ??? for sure is not working
// Process Uploaded Image
function wc_filepond_process_image( $order_id ) {
  // Get the uploaded file from $_FILES
  $uploaded_files = $_FILES;
add_post_meta( $order_id, '_wc_filepond_upload', $file_path );

// Debugging line
error_log('Uploaded file path: ' . $file_path);
  // Check if the key 'wc_filepond_upload' exists in the $_FILES array
  if (array_key_exists('wc_filepond_upload', $uploaded_files)) {
    $uploaded_file = $uploaded_files['wc_filepond_upload'];
    
    // Check if the file was uploaded successfully
    if ( $uploaded_file['error'] === UPLOAD_ERR_OK ) {
      // Define the desired folder location
      $upload_dir = wp_upload_dir()['path'];
      
      // Check if the folder exists, if not create it
      if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
      }
      
      // Move the uploaded file to the desired location
      $file_path = $upload_dir . '/' . $uploaded_file['name'];
      move_uploaded_file( $uploaded_file['tmp_name'], $file_path );
      
      // Add the file path as order meta
      add_post_meta( $order_id, '_wc_filepond_upload', $file_path );
    }
  }
}


