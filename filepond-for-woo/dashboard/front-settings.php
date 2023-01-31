<link rel="stylesheet" href="../wp-content/plugins/filepond-for-woo/front-end/css/bzn.css">
<form method="post" action="options.php">
  <?php settings_fields( 'wc_filepond_settings_group' ); ?>
  <?php do_settings_sections( 'wc_filepond_settings_group' ); ?>
  <main class="faq">
        
  <div class="faq__logo__holder">
  <div class="faq__logo">
  <h1>Wordpress Filepond</h1>
  <p>You can modify the inputs only with True or False</p> <br>
  <p>Leave empty for default(on first installation)</p>
  </div>
  </div>
  
  <div class="faq__holder">
  <h1 class="faq__heading">Settings</h1>
	<!-- Upload size -->
  <details class="faq__detail">
      <summary  class="faq__summary"><span class="faq__question">Configuration</span></summary>
    <tr valign="top">
      <th scope="row">Is Filepond required for checkout?</th><br>
      <td><input type="text" name="wc_filepond_enable_required" value="<?php echo esc_attr( get_option( 'wc_filepond_enable_required' ) ); ?>" placeholder="Default: False"/></td>
	</tr>
	<br>
    <tr valign="top">
      <th scope="row">Is Filepond disabled?</th><br>
      <td><input type="text" name="wc_filepond_enable_disabled" value="<?php echo esc_attr( get_option( 'wc_filepond_enable_disabled' ) ); ?>" placeholder="Default: False"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Enable or disable drag n' drop</th><br>
      <td><input type="text" name="wc_filepond_enable_drop" value="<?php echo esc_attr( get_option( 'wc_filepond_enable_drop' ) ); ?>" placeholder="Default: True"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Enable adding multiple files</th><br>
      <td><input type="text" name="wc_filepond_allow_multiple" value="<?php echo esc_attr( get_option( 'wc_filepond_allow_multiple' ) ); ?>" placeholder="Default: False"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Set maximum number of files that the pond can handle</th><br>
      <td><input type="text" name="wc_filepond_max_files_handle" value="<?php echo esc_attr( get_option( 'wc_filepond_max_files_handle' ) ); ?>" placeholder="for example: 5"/></td>
    </tr>
  </details>

  <details class="faq__detail">
      <summary  class="faq__summary"><span class="faq__question">File Size Validation</span></summary>
    <tr valign="top">
      <th scope="row">Do you want to <b>validate size</b> ?</th><br>
      <td><input type="text" name="wc_filepond_file_size_val" value="<?php echo esc_attr( get_option( 'wc_filepond_file_size_val' ) ); ?>" placeholder="Default: True"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">What is the <b>minimum</b> file size ?</th><br>
      <td><input type="text" name="wc_filepond_file_size_val_min" value="<?php echo esc_attr( get_option( 'wc_filepond_file_size_val_min' ) ); ?>" placeholder="for example: 5MB or 100KB"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">What is the <b>maximum</b> file size ?</th><br>
      <td><input type="text" name="wc_filepond_max_upload_size" value="<?php echo esc_attr( get_option( 'wc_filepond_max_upload_size' ) ); ?>" placeholder="for example: 5MB or 100KB"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">What is the <b>minimum TOTAL</b> file size ?</th><br>
      <td><input type="text" name="wc_filepond_max_total_size" value="<?php echo esc_attr( get_option( 'wc_filepond_max_total_size' ) ); ?>" placeholder="for example: 5MB or 100KB"/></td>
    </tr>
	<br>
  </details>  

  <details class="faq__detail">
      <summary  class="faq__summary"><span class="faq__question">Preview Image</span></summary>
    <tr valign="top">
      <th scope="row">Do you want to enable <b>image preview</b> ?</th><br>
      <td><input type="text" name="wc_filepond_enable_preview" value="<?php echo esc_attr( get_option( 'wc_filepond_enable_preview' ) ); ?>" placeholder="Default: True"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Minimum image preview height</th><br>
      <td><input type="text" name="imagePreviewMinHeight" value="<?php echo esc_attr( get_option( 'imagePreviewMinHeight' ) ); ?>" placeholder="for example: 200"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Maximum image preview height</th><br>
      <td><input type="text" name="imagePreviewMaxHeight" value="<?php echo esc_attr( get_option( 'imagePreviewMaxHeight' ) ); ?>" placeholder="for example: 500"/></td>
    </tr>
	<br>
    <tr valign="top">
      <th scope="row">Fixed image preview height, overrides min and max preview height</th><br>
      <td><input type="text" name="imagePreviewHeight" value="<?php echo esc_attr( get_option( 'imagePreviewHeight' ) ); ?>" placeholder="for example: 300"/></td>
    </tr>
	<br>
  </details>  
  
  <details class="faq__detail">
   <summary  class="faq__summary"><span class="faq__question">File Type Validation</span></summary>
	<br>
    <tr valign="top">
      <th scope="row">Do you want to enable <b>File Type Validation</b> ?</th><br>
      <td><input type="text" name="allowFileTypeValidation" value="<?php echo esc_attr( get_option( 'allowFileTypeValidation' ) ); ?>" placeholder="Default: True"/></td>
       <p>When activated only png and jpeg files are allowed.</p>
	</tr>
	<br>
	<br>
  </details>  

</div>
<?php submit_button(); ?>
</main>
</form>