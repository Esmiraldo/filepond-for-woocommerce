<?php
// In this example, the filepond-functions.php file includes functions for enqueueing the FilePond scripts and styles, displaying the FilePond form field, and processing the uploaded image. The wc_filepond_functions_init function initializes these functions by hooking into various WooCommerce actions, such as wp_enqueue_scripts and woocommerce_before_add_to_cart_button.
//The wc_filepond_enqueue_scripts function enqueues the FilePond library and styles using the wp_enqueue_script and wp_enqueue_style functions. The wc_filepond_form_field function displays the FilePond form field using the echo function. And the wc_filepond_process_image function processes the uploaded image, moving it to a permanent location and adding the file path as order meta using the `move_uploaded_file

// Initialize FilePond Functions
function wc_filepond_functions_init() {
  add_action( 'wp_enqueue_scripts', 'wc_filepond_enqueue_scripts' );
  add_action( 'woocommerce_before_add_to_cart_button', 'wc_filepond_form_field' );
  add_action( 'woocommerce_checkout_update_order_meta', 'wc_filepond_process_image' );
}

// Enqueue FilePond Scripts and Styles
function wc_filepond_enqueue_scripts() {
  wp_enqueue_script( 'filepond', "https://unpkg.com/filepond/dist/filepond.min.js", array(), '5.13.0', true );
  wp_enqueue_style( 'filepond', "https://unpkg.com/filepond/dist/filepond.min.css", array(), '5.13.0' );
}

// Display FilePond Form Field
// function wc_filepond_form_field() {
  // echo '<input type="file" name="wc_filepond_upload" class="filepond" required>';
// }

// Process Uploaded Image
function wc_filepond_process_image( $order_id ) {
  // Get the uploaded file from $_FILES
  $uploaded_file = $_FILES['wc_filepond_upload'];
  
  // Check if the file was uploaded successfully
  if ( $uploaded_file['error'] === UPLOAD_ERR_OK ) {
    // Move the uploaded file to a permanent location
    $file_path = wp_upload_dir()['path'] . '/' . $uploaded_file['name'];
    move_uploaded_file( $uploaded_file['tmp_name'], $file_path );
    
    // Add the file path as order meta
    add_post_meta( $order_id, '_wc_filepond_upload', $file_path );
  }
}
