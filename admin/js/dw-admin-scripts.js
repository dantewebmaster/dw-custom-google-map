/**
 * The plugin admin sscripts.
 */
jQuery(document).ready(function ($) {
	/* Show/hide the address textarea */
	if ($("#activate-address").prop('checked')) {
		$(".option-address").show();
	} else {
		$(".option-address").hide();
	}
	$("#activate-address").bind("change", function () {
		if ($(this).prop('checked')) {
			$(".option-address").show();
		} else {
			$(".option-address").hide();
		}
	});

	/* Add Color Picker to all inputs that have 'color-field' class */
    $(function() {
        $('.dw-color-picker').wpColorPicker();
	});
	
	/* Deal with the media uploader */
	$("#upload-custom-marker").click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
			
			title: $(this).data('uploader_title'),
			button: {
				text: $(this).data('uploader_button_text'),
			},
		
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            
			// We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
        	
			// Let's assign the url value to the input field
			$('#custom-marker-url').val(image_url);
        });
    });

});
