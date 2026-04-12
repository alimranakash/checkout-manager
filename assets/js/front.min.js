;(function ($) {

	'use strict';

	/**
	 * Evaluate all conditional logic rules and show/hide fields accordingly.
	 * Fields with a data-condition-field attribute are custom fields with a condition set.
	 */
	function imcm_evaluate_conditions() {
		$('[data-condition-field]').each(function() {
			var $input       = $(this);
			var condField    = $input.data('condition-field');
			var condOperator = $input.data('condition-operator') || 'equals';
			var condValue    = String($input.data('condition-value') || '');
			var $formRow     = $input.closest('p.form-row, .form-row');

			if ( ! condField ) {
				return;
			}

			// Find the source field — try by id and name
			var $source = $('#' + condField).first();
			if ( ! $source.length ) {
				$source = $('[name="' + condField + '"]').first();
			}

			var currentVal = '';
			if ( $source.is(':checkbox') ) {
				currentVal = $source.is(':checked') ? ( $source.val() || 'on' ) : '';
			} else if ( $source.is('select') ) {
				currentVal = $source.val() || '';
			} else {
				currentVal = $source.val() || '';
			}

			var show = false;
			switch ( condOperator ) {
				case 'equals':
					show = ( currentVal == condValue );
					break;
				case 'not_equals':
					show = ( currentVal != condValue );
					break;
				case 'contains':
					show = ( currentVal.indexOf( condValue ) !== -1 );
					break;
				case 'not_empty':
					show = ( currentVal !== '' );
					break;
				case 'empty':
					show = ( currentVal === '' );
					break;
				default:
					show = true;
			}

			if ( show ) {
				$formRow.show();
			} else {
				$formRow.hide();
				// Clear the hidden field value so it is not submitted
				$input.val('');
			}
		});
	}

	// Run on DOM ready
	$(document).ready(function() {
		imcm_evaluate_conditions();
	});

	// Re-run whenever any checkout field changes
	$(document.body).on(
		'change input keyup',
		'form.checkout input, form.checkout select, form.checkout textarea',
		function() {
			imcm_evaluate_conditions();
		}
	);

	// Re-run after WooCommerce updates the checkout (e.g. after address change)
	$(document.body).on('updated_checkout', function() {
		imcm_evaluate_conditions();
	});

	// Re-run after Select2 selection (WooCommerce country/state)
	$(document.body).on('select2:select select2:unselect', function() {
		imcm_evaluate_conditions();
	});

})(jQuery);
