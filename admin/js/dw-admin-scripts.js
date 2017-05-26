/**
 * The plugin admin sscripts 
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

});
