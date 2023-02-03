//is okay

<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// Verify nonce
if ( ! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'filepond_image_upload' ) ) {
  wp_send_json_error( array( 'message' => 'Invalid nonce.' ) );
}

// Check if a file was uploaded
if ( empty( $_FILES['filepond']['tmp_name'] ) ) {
  wp_send_json_error( array( 'message' => 'No file was uploaded.' ) );
}

// Validate uploaded file
$file = $_FILES['filepond'];
$file_size = filesize( $file['tmp_name'] );


// Generate unique file name
$file_extension = 'webp' 
$new_file_name = uniqid() . '.' . $file_extension;
wp_send_json_success( array( 'file' => $new_file_name ) );
// Upload the file
$upload_dir = wp_upload_dir();
$file_path = $upload_dir['path'] . '/' . $new_file_name;
if ( ! move_uploaded_file( $file['tmp_name'], $file_path ) ) {
  wp_send_json_error( array( 'message' => 'Failed to upload the file.' ) );
}else{

   Wp_send_json_error( array('message' => 'uploaded  '))

}
