<?php

// Verify nonce
if ( ! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'filepond_image_load' ) ) {
  wp_send_json_error( array( 'message' => 'Invalid nonce.' ) );
}

// Check if a file name was provided
if ( empty( $_REQUEST['file'] ) ) {
  wp_send_json_error( array( 'message' => 'No file name was provided.' ) );
}

// Get the file path
$upload_dir = wp_upload_dir();
$file_path = $upload_dir['path'] . '/' . $_REQUEST['file'];

// Check if the file exists
if ( ! file_exists( $file_path ) ) {
  wp_send_json_error( array( 'message' => 'The file does not exist.' ) );
}

// Get the file data
$file_data = file_get_contents( $file_path );

// Return the file data
wp_send_json_success( array( 'file' => base64_encode( $file_data ) ) );
