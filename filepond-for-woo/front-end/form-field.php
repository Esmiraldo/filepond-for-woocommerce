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
    FilePondPluginFileEncode,
    FilePondPluginImageTransform
  );

  // Initialize FilePond on the form field
  FilePond.create( document.getElementById('wc_filepond_upload'), {
    server: {
      process: '<?php echo plugins_url( 'form-action/process.php', __FILE__ ); ?>',
      revert: '<?php echo plugins_url( 'form-action/revert.php', __FILE__ ); ?>',
      load: '<?php echo plugins_url( 'form-action/load.php', __FILE__ ); ?>'
    },
    imagePreviewHeight: 100,
    imageCropAspectRatio: '1:1',
    allowImageTransform: true,
    imageTransformOutputQuality: 80,
    imageTransformOutputMimeType: 'image/jpeg',
    labelIdle: 'Drag & Drop your image or <span class="filepond--label-action">Browse</span>',
    headers: {
      'X-CSRF-TOKEN': '<?php echo wp_create_nonce( 'filepond_image_upload' ); ?>'
    }
  });
</script>
