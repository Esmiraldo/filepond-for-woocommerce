<?php
require_once( plugin_dir_path( __FILE__ ) . 'filepond-script.php' );
?>
<div class="filepond-upload-form-field">
  <label for="wc_filepond_upload">Upload Image</label>
  <input type="file" id="wc_filepond_upload" name="wc_filepond_upload" class="filepond" required>
</div>
<!-- FilePond Initialization Script -->
<script>
  // Register FilePond plugins
  FilePond.registerPlugin(
    FilePondPluginImagePreview,
	FilePondPluginFileValidateType,
    FilePondPluginFileEncode,
    FilePondPluginImageTransform,
	FilePondPluginFileValidateSize
  );

  // Initialize FilePond on the form field
  FilePond.create( document.getElementById('wc_filepond_upload'), {
    server: {
      process: '<?php echo plugins_url( 'form-action/process.php', __FILE__ ); ?>',
      revert: '<?php echo plugins_url( 'form-action/revert.php', __FILE__ ); ?>',
      load: '<?php echo plugins_url( 'form-action/load.php', __FILE__ ); ?>'
    },
    imageCropAspectRatio: '1:1',
	// general
	required: '<?php echo esc_attr( get_option( 'wc_filepond_enable_required' ) ); ?>',
	disabled: '<?php echo esc_attr( get_option( 'wc_filepond_enable_disabled' ) ); ?>',
	allowDrop: '<?php echo esc_attr( get_option( 'wc_filepond_enable_drop' ) ); ?>',
	// preview
	allowImagePreview: '<?php echo esc_attr( get_option( 'wc_filepond_enable_preview' ) ); ?>',
	imagePreviewMinHeight: '<?php echo esc_attr( get_option( 'imagePreviewMinHeight' ) ); ?>',
	imagePreviewMaxHeight: '<?php echo esc_attr( get_option( 'imagePreviewMaxHeight' ) ); ?>',
	imagePreviewHeight: '<?php echo esc_attr( get_option( 'imagePreviewHeight' ) ); ?>',
	// multiple
	allowMultiple: '<?php echo esc_attr( get_option( 'wc_filepond_allow_multiple' ) ); ?>',
	maxFiles: '<?php echo esc_attr( get_option( 'wc_filepond_max_files_handle' ) ); ?>',
	// size validation
	allowFileSizeValidation: '<?php echo esc_attr( get_option( 'wc_filepond_file_size_val' ) ); ?>',
	minFileSize: '<?php echo esc_attr( get_option( 'wc_filepond_file_size_val_min' ) ); ?>',
	maxFileSize: '<?php echo esc_attr( get_option( 'wc_filepond_max_upload_size' ) ); ?>',
	maxTotalFileSize: '<?php echo esc_attr( get_option( 'wc_filepond_max_total_size' ) ); ?>',
	// file validation
	allowFileTypeValidation: '<?php echo esc_attr( get_option( 'allowFileTypeValidation' ) ); ?>',
	acceptedFileTypes: ['image/png', 'image/jpeg'],
    allowImageTransform: false,
    imageTransformOutputQuality: 80,
    imageTransformOutputMimeType: 'image/jpeg',
    labelIdle: 'Drag & Drop your image or <span class="filepond--label-action">Browse</span>',
    headers: {
      'X-CSRF-TOKEN': '<?php echo wp_create_nonce( 'filepond_image_upload' ); ?>'
    }
  });
</script>