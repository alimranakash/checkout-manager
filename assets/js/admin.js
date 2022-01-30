;(function ($){
	$('#imch-setting-tabs').tabs();
	
	$('.imch-setting').submit(function(e){
		e.preventDefault();

		$('.cx-response-message').hide();

		var $form = $(this);
		var $data = $form.serialize();
		$.ajax({
			url: IMCM.ajaxurl,
			data: $data,
			type: 'POST',
			dataType: 'JSON',
			success: function(resp) {
				$('.cx-response-message').html( resp.message ).show();
				console.log(resp);
				if ( resp.page_load == 'yes' ) {
					location.reload();
				}
			},
			error: function( $xhr, $sts, $err ) {
				console.log($err);
			}
		})
	})
})(jQuery);