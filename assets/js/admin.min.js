;(function ($){
	$('#imcm-setting-tabs').tabs();

	$(document).on("click",".imcm-setting-save-button",function(e) {
		e.preventDefault();
		$('.ui-tabs-panel[aria-hidden="false"] .imcm-setting, .imcm-checkout-fields-panel .imcm-setting').submit();
	});
	
	$('.imcm-setting').submit(function(e) {
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
					setTimeout(function() {
						location.reload()
					}, 2000);
				}
				else {
					setTimeout(function() {
						$('.cx-response-message').hide();
					}, 2000);
				}
			},
			error: function( $xhr, $sts, $err ) {
				console.log($err);
			}
		});
	});

	$(document).on("click",".imcm-setting-reset-button",function(e) {
		e.preventDefault();

		$.ajax({
			url: IMCM.ajaxurl,
			data: { 'action':'reset-checkout-fields', 'nonce' : IMCM.nonce },
			type: 'POST',
			dataType: 'JSON',
			success: function(resp){
				$('.cx-response-message').html( resp.message ).show();

				if ( resp.status == 1 ) {
					setTimeout(function() {
						location.reload()
					}, 2000);
				}
			}
		});
	});

	$('.woocm-tab-btn').on('click', function(e) {
		e.preventDefault();
		var $tab = $(this).attr('data-tab');
		$('.woocm-tab-content').hide();
		$('.woocm-tab-btn').removeClass('active');
		$(this).addClass('active');
		$('#'+$tab).show();
	});

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
	});
	
	$('.woocm-modal-toggle').on('click', function(e) {
		e.preventDefault();

		var type 		= $(this).attr('data-type');
		var id 			= Math.random().toString(36).substring(7);

		$('.woocm-input-field.woocm-id').val('new_field_' + id)
		
		// console.log(type)
		$('.woocm-modal').toggleClass('is-visible');
	});

	$(document).on('click','.woocm-clone-item-btn-panel .woocm-clone-item',function( e ) {
		e.preventDefault();
		var type 		= $(this).attr('data-type');
		// var id 		= Math.random().toString(36).substring(7);
		var field_name 	= $('.woocm-input-field.woocm-id').val();
		var clone_field = $("#woocm-clone-"+ type +"-item").clone();
		var rep_name 	= clone_field.html().replace(/%attrname%/g, 'name');
		var new_field 	= rep_name.replace(/%%%/g, field_name);

		$("#woocm-"+ type +"-list-wrap").append( new_field );
		
		$('.woocm-input-field.woocm-id').val(field_name)
		$('.woocm-modal').removeClass('is-visible');

	});

	$(document).on('keyup','.woocm-item-input-field.woocm-label',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		$(this).attr('value', value);
		var parent 	= $(this).closest('.woocm-list-item');
		$('.woocm-item-heading', parent).html(value);
	});

	$(document).on('change','.woocm-input-field.woocm-id',function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		var oldid 	= $(this).data('oldid');
		var parent 	= $(this).closest('.woocm-accordion');
		var heading = $('.woocm-item-heading');

		console.log(heading.data('name'))

		if ( oldid ) {
			var $replace = $(this).attr('data-oldid');
		}
		else {
			var $replace = 'new_field';
		}

		heading.data('name', heading.data('name').replace($replace,value));

		$('input, select, textarea', parent).each(function($i) {
			$(this).attr('data-oldid', value);
			$(this).attr('name', $(this).attr('name').replace($replace,value));
		});

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

	$(document).on('change','.woocm-clone-item-panel .woocm-input-field.woocm-type', function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		console.log(value)

		$('.woocm-clone-item-panel .woocm-input-field.woocm-type > option[selected="selected"]').removeAttr('selected');

		// $('.woocm-input-field.woocm-type option').each(function() {
		//     $(this).removeAttr('selected');
		// });

		$(this).find('option[value='+ value +']').attr('selected',true);
	});

	$(document).on('change','.woocm-clone-item-panel .woocm-input-field.woocm-class', function(e) {
		e.preventDefault();
		var value 	= $(this).val();
		console.log(value)

		$('.woocm-clone-item-panel .woocm-input-field.woocm-class > option[selected="selected"]').removeAttr('selected');

		// $('.woocm-input-field.woocm-type option').each(function() {
		//     $(this).removeAttr('selected');
		// });

		$(this).find('option[value='+ value +']').attr('selected',true);
	});

	$(document).on("click",".woocm-action-panel .woocm-item-remove", function(e){
		e.preventDefault()
		var parent 	= $(this).closest('.woocm-action-panel').parent();
		parent.remove();
		// alert('fffff')
	});

	if ( localStorage.getItem("woocm-active-tab") ) {
		$('a.ui-tabs-anchor[href="'+ localStorage.getItem("woocm-active-tab") +'"]').click();
	}

	$("a.ui-tabs-anchor").click(function (e) {
        e.preventDefault();

        var target = $(this).attr("href");
        localStorage.setItem("woocm-active-tab", target);
    });

	$('.woocm-sortable').sortable({axis: 'y'});

	// =========================================================
	// Conditional Logic: show/hide "Value" field based on operator
	// =========================================================
	$(document).on('change', '.woocm-item-condition-operator', function() {
		var op 			= $(this).val();
		var $parent 	= $(this).closest('.woocm-item-wrap, .woocm-clone-item-panel');
		var $valueRow 	= $parent.find('.woocm-item-field-condition-value');
		if ( op === 'empty' || op === 'not_empty' ) {
			$valueRow.slideUp();
		} else {
			$valueRow.slideDown();
		}
	});

	// =========================================================
	// Validation: show/hide regex field based on validation type
	// =========================================================
	$(document).on('change', '.woocm-item-validation-select', function() {
		var val 		= $(this).val();
		var $parent 	= $(this).closest('.woocm-item-wrap, .woocm-clone-item-panel');
		var $regexRow 	= $parent.find('.woocm-item-field-validation-regex');
		if ( val === 'regex' ) {
			$regexRow.slideDown();
		} else {
			$regexRow.slideUp();
		}
	});

	// =========================================================
	// Import / Export
	// =========================================================
	$(document).on('click', '#imcm-export-btn', function(e) {
		e.preventDefault();
		var $btn = $(this);
		$btn.text('Exporting...').prop('disabled', true);

		$.ajax({
			url: IMCM.ajaxurl,
			data: { action: 'imcm-export-settings', nonce: IMCM.nonce },
			type: 'POST',
			dataType: 'JSON',
			success: function(resp) {
				$btn.text('Export Settings').prop('disabled', false);
				if ( resp.success ) {
					var json = JSON.stringify(resp.data.data, null, 2);
					var blob = new Blob([json], { type: 'application/json' });
					var url  = URL.createObjectURL(blob);
					var a    = document.createElement('a');
					a.href     = url;
					a.download = 'checkout-manager-settings.json';
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
					URL.revokeObjectURL(url);
				} else {
					alert(resp.data ? resp.data.message : 'Export failed.');
				}
			},
			error: function() {
				$btn.text('Export Settings').prop('disabled', false);
				alert('Export request failed. Please try again.');
			}
		});
	});

	$(document).on('click', '#imcm-import-btn', function(e) {
		e.preventDefault();
		var import_data = $('#imcm-import-data').val().trim();
		if ( ! import_data ) {
			alert('Please paste your exported JSON first.');
			return;
		}
		if ( ! confirm('This will overwrite your current settings. Continue?') ) {
			return;
		}

		var $btn = $(this);
		$btn.text('Importing...').prop('disabled', true);

		$.ajax({
			url: IMCM.ajaxurl,
			data: { action: 'imcm-import-settings', nonce: IMCM.nonce, import_data: import_data },
			type: 'POST',
			dataType: 'JSON',
			success: function(resp) {
				$btn.text('Import Settings').prop('disabled', false);
				if ( resp.success ) {
					$('#imcm-import-data').closest('.imcm-setting-content').find('.cx-response-message')
						.html(resp.data.message).show();
					if ( resp.data.reload ) {
						setTimeout(function() { location.reload(); }, 1500);
					}
				} else {
					alert(resp.data ? resp.data.message : 'Import failed.');
				}
			},
			error: function() {
				$btn.text('Import Settings').prop('disabled', false);
				alert('Import request failed. Please try again.');
			}
		});
	});

	// $('#imcm-display-position-form').submit(function(e) {
	// 	e.preventDefault();

	// 	$('.cx-response-message').hide();

	// 	var $form = $(this);
	// 	var $data = $form.serialize();

	// 	$.ajax({
	// 		url: IMCM.ajaxurl,
	// 		data: $data,
	// 		type: 'POST',
	// 		dataType: 'JSON',
	// 		success: function(resp) {
	// 			$('.cx-response-message').html( resp.message ).show();
	// 			console.log(resp);
	// 		},
	// 		error: function( $xhr, $sts, $err ) {
	// 			console.log($err);
	// 		}
	// 	});
	// });

	$('.imcm-style-color').minicolors({

	  // hue, brightness, saturation, or wheel
	  control: 'hue',

	  // default color
	  defaultValue: '',

	  // hex or rgb
	  format: 'rgb',

	  // show/hide speed
	  showSpeed: 100,
	  hideSpeed: 100,

	  // is inline mode?
	  inline: false,

	  // uppercase or lowercase
	  letterCase: 'lowercase',

	  // enables opacity slider
	  opacity: false,

	  // custom position
	  position: 'bottom left',
	  
	  // additional theme class
	  theme: 'default',

	  // an array of colors that will show up under the main color <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a>
	  swatches: [ 'swatches', 'opacity']
	  
	});

	// $('#imcm-style-options-form').submit(function(e) {
	// 	e.preventDefault();

	// 	$('.cx-response-message').hide();

	// 	var $form = $(this);
	// 	var $data = $form.serialize();

	// 	$.ajax({
	// 		url: IMCM.ajaxurl,
	// 		data: $data,
	// 		type: 'POST',
	// 		dataType: 'JSON',
	// 		success: function(resp) {
	// 			$('.cx-response-message').html( resp.message ).show();
	// 			console.log(resp);
	// 		},
	// 		error: function( $xhr, $sts, $err ) {
	// 			console.log($err);
	// 		}
	// 	});
	// });

	$('#imcm-display-position-form').submit(function(e) {
		e.preventDefault();

		// $('.cx-response-message').hide();

		// var $form = $(this);
		// var $data = $form.serialize();

		// $.ajax({
		// 	url: IMCM.ajaxurl,
		// 	data: $data,
		// 	type: 'POST',
		// 	dataType: 'JSON',
		// 	success: function(resp) {
		// 		$('.cx-response-message').html( resp.message ).show();
		// 		console.log(resp);

		// 		// if ( resp.page_load == 'yes' ) {
		// 		// 	setTimeout(function() {
		// 		// 		location.reload()
		// 		// 	}, 2000);
		// 		// }
		// 	},
		// 	error: function( $xhr, $sts, $err ) {
		// 		console.log($err);
		// 	}
		// });
	});

})(jQuery);