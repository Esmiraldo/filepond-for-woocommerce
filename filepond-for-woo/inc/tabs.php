<?php
// Add FilePond Tab to Product Data
function wc_filepond_add_product_tab( $tabs ) {
  $tabs['filepond'] = array(
    'label'    => __( 'FilePond', 'woocommerce' ),
    'target'   => 'filepond_product_data',
    'class'    => array( 'show_if_simple', 'show_if_variable' ),
    'icon'     => 'dashicons-upload',
    'priority' => 60,
  );
  return $tabs;
}

// Display FilePond Tab Content
function wc_filepond_product_tab_content() {
  global $post;
  $enable_filepond = get_post_meta( $post->ID, '_wc_filepond_enable', true );
  ?>
  <div id='filepond_product_data' class='panel woocommerce_options_panel'>
    <div class='options_group'>
      <p class='form-field'>
        <label for='wc_filepond_enable'>
          <?php _e( 'Enable FilePond for this product', 'woocommerce' ); ?>
        </label>
        <input type='checkbox' id='wc_filepond_enable' name='wc_filepond_enable' value='yes' <?php checked( $enable_filepond, 'yes' ); ?>>
      </p>
    </div>
  </div>
  <?php
}

// Save FilePond Tab Data
function wc_filepond_save_product_tab_data( $post_id ) {
  $enable_filepond = isset( $_POST['wc_filepond_enable'] ) ? 'yes' : 'no';
  update_post_meta( $post_id, '_wc_filepond_enable', $enable_filepond );
}

// Initialize FilePond Tab Functions
function wc_filepond_tab_init() {
  add_filter( 'woocommerce_product_data_tabs', 'wc_filepond_add_product_tab' );
  add_action( 'woocommerce_product_data_panels', 'wc_filepond_product_tab_content' );
  add_action( 'woocommerce_process_product_meta', 'wc_filepond_save_product_tab_data' );
}
