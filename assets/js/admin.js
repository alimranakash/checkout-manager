;(function ($){
	$('#imch-setting-tabs').tabs();

	$(document).on("click",".imch-setting-save-button",function(e) {
		e.preventDefault();
		$('.imch-setting').submit();
	})
	
	$('.imch-setting').submit(function(e) {
		e.preventDefault();
		console.log('ffffffffff')

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
					setTimeout(function(){
						location.reload()
					}, 2000);
				}
			},
			error: function( $xhr, $sts, $err ) {
				console.log($err);
			}
		})
	})


	$('.woocm-tab-btn').on('click', function(e){
		e.preventDefault();
		var $tab = $(this).attr('data-tab');
		$('.woocm-tab-content').hide();
		$('.woocm-tab-btn').removeClass('active');
		$(this).addClass('active');
		$('#'+$tab).show();
	});

	$('.woocm-sortable').sortable({axis: 'y'});

	$('.woocm-item-wrap.woocm-accordion').hide();
	$(document).on('click','.woocm-list-wrap li.woocm-list-item h4',function() {
		var name = $(this).attr('data-name');
	    $('.woocm-item-wrap.woocm-accordion').slideUp();
	    $('.woocm-item-wrap.woocm-accordion' +'.'+name).stop().slideToggle();
	});

	$('.woocm-item-wrap .woocm-item-field-options').hide();
	$(document).on("change",".woocm-item-wrap .woocm-item-field-type select",function(e){
		if ( this.value == 'select' || this.value == 'radio' ) {
			$('.woocm-item-wrap .woocm-item-field-options').slideDown();
		}
		else {
			$('.woocm-item-wrap .woocm-item-field-options').slideUp();
		}
	})
	
	$('.woocm-modal-toggle').on('click', function(e) {
		e.preventDefault();
		$('.woocm-modal').toggleClass('is-visible');
	});

	$(document).on('click','.woocm-modal-toggle.woocm-clone-item',function( e ) {
		e.preventDefault();
		var type 		= $(this).attr('data-type');
		var clone_field = $("#woocm-clone-"+ type +"-item").clone();
		var rep_name 	= clone_field.html().replace(/%attrname%/g, 'name');
		var new_field 	= rep_name.replace(/%%%/g, 'new_field');
		$("#woocm-"+ type +"-list-wrap").append( new_field );
	});

	$(document).on('keyup','.woocm-item-input-field.woocm-label',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		$(this).attr('value', value);
		var parent 	= $(this).closest('.woocm-list-item');
		$('.woocm-item-heading', parent).html(value);
	});

	$(document).on('keyup','.woocm-input-field.woocm-label',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		$(this).attr('value', value);
		var parent 	= $(this).closest('.woocm-list-item');
		$('.woocm-item-heading', parent).html(value);
	});

	$(document).on('keyup','.woocm-input-field.woocm-placeholder',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		$(this).attr('value', value);
	});

	$(document).on('change','.woocm-input-field.woocm-type, .woocm-input-field.woocm-class',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		
		$('option', this).each(function() {
		    $(this).removeAttr('selected');
		});

		$(this).find('option[value='+ value +']').attr('selected',true);
	});

	$(document).on("click",".woocm-action-panel .woocm-item-remove", function(e){
		e.preventDefault()
		var parent 	= $(this).closest('.woocm-action-panel').parent();
		parent.remove();
		// alert('fffff')
	})
})(jQuery);