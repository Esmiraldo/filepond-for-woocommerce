<?php
require_once( plugin_dir_path( __FILE__ ) . 'filepond-script.php' );
?>
<div class="filepond-upload-form-field">
  <label for="wc_filepond_upload">Upload Image</label>
  <input type="file" id="wc_filepond_upload" name="wc_filepond_upload" class="filepond" required>
</div>

<script>
  // In this example, the form-field.php file includes a form field for uploading an image using the FilePond library. The form field includes a label and an input field with the class filepond. The accompanying JavaScript initializes the FilePond library, sets options such as allowing only one file to be uploaded, and sets up the server processing logic.
// The server processing logic uses the XMLHttpRequest (XHR) API to send the uploaded file to the server via a POST request. The response from the server is expected to be a JSON object with a file_id property, which will be loaded into the FilePond instance. If the response from the server is not successful, an error message will be displayed.
// This is just one example of how the form-field.php file could be implemented, and it may need to be adapted based on your specific requirements and setup.
  FilePond.registerPlugin(
	  FilePondPluginImagePreview
	);
  
  FilePond.create( document.querySelector( '.filepond' ), {
    allowMultiple: false,
	imagePreviewHeight: 370,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    labelIdle: 'Drag & Drop your image or <span class="filepond--label-action"> Browse </span>',
    server: {
      process: function( fieldName, file, metadata, load, error, progress, abort ) {
        // Get form data
        var formData = new FormData();
        formData.append( fieldName, file, file.name );
        
        // Send file to server
        var xhr = new XMLHttpRequest();
        xhr.open( 'POST', '<?php echo admin_url( 'admin-ajax.php' ); ?>' );
        xhr.setRequestHeader( 'X-Requested-With', 'XMLHttpRequest' );
        xhr.send( formData );
        
        // Handle server response
        xhr.onreadystatechange = function() {
          if ( xhr.readyState == 4 && xhr.status == 200 ) {
            // Get server response
            var response = JSON.parse( xhr.responseText );
            
            // Load file id
            load( response.file_id );
          } else if ( xhr.readyState == 4 && xhr.status != 200 ) {
            // Handle error
            error( 'Upload Failed' );
          }
        };
        
        // Handle cancel
        return function() {
          xhr.abort();
        };
      }
    }
  } );
</script>
