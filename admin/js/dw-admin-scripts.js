jQuery(document).ready(function ($) {

	var alert_type_input = $(".alert-type-input:checked");
	var toast_position_settings = $(".option-toast-position");
	
	if ( alert_type_input.val() == 'modal' ) {
		toast_position_settings.hide();
	}

	$(".alert-type-input").bind("change", function () {
		if ( $(this).val() == 'modal' ) {
			toast_position_settings.hide();
		} else if( $(this).val() == 'toast' ) {
			toast_position_settings.show();
		}
	});

});
