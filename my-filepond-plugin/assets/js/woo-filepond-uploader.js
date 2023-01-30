(function($) {
	$(document).ready(function() {
		// Initialize the FilePond library.
		FilePond.setOptions({
			server: {
				process: {
					url: '/wp-admin/admin-ajax.php',
					method: 'POST',
					withCredentials: false,
					headers: {},
					timeout: 7000,
					onload: function() {
						console.log('FilePond process complete.');
					},
					onerror: function() {
						console.log('FilePond process failed.');
					}
				}
			}
		});
		
		// Create a new FilePond instance for each .woo-filepond-uploader element.
		$('.woo-filepond-uploader').each(function() {
			var inputElement = this;
			var pond = FilePond.create(inputElement);
		});
	});
})(jQuery);
