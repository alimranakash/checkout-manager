<?php
/**
 * Save and validate custom checkout field data in order meta.
 */
namespace WPPlugines\Checkout_Manager\App\Checkout;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage OrderMeta
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 * @since 1.1.0
 */
class OrderMeta {

	/**
	 * Constructor function
	 */
	public function __construct() {
		$this->hooks();
	}

	private function hooks() {
		add_action( 'woocommerce_checkout_update_order_meta', [ $this, 'save_custom_fields' ] );
		add_action( 'woocommerce_checkout_process', [ $this, 'validate_custom_fields' ] );
	}

	/**
	 * Save all enabled custom (non-default) field values to order meta.
	 *
	 * @param int $order_id
	 */
	public function save_custom_fields( $order_id ) {
		$_woocm_fields = get_option( 'imcm-checkout-fields', [] );

		if ( empty( $_woocm_fields['woocm_fields'] ) ) {
			return;
		}

		foreach ( $_woocm_fields['woocm_fields'] as $type => $fields ) {
			foreach ( $fields as $name => $field ) {

				if ( imcm_is_default_field( $name ) ) {
					continue;
				}

				if ( ! isset( $field['enabled'] ) || ! $field['enabled'] ) {
					continue;
				}

				// Skip field if its condition is not met
				if ( ! $this->evaluate_condition( $field ) ) {
					continue;
				}

				if ( isset( $_POST[ $name ] ) ) {
					$value = sanitize_text_field( wp_unslash( $_POST[ $name ] ) );
					update_post_meta( $order_id, '_' . $name, $value );
				}
			}
		}
	}

	/**
	 * Validate required and format rules for custom checkout fields.
	 */
	public function validate_custom_fields() {
		$_woocm_fields = get_option( 'imcm-checkout-fields', [] );

		if ( empty( $_woocm_fields['woocm_fields'] ) ) {
			return;
		}

		foreach ( $_woocm_fields['woocm_fields'] as $type => $fields ) {
			foreach ( $fields as $name => $field ) {

				if ( imcm_is_default_field( $name ) ) {
					continue;
				}

				if ( ! isset( $field['enabled'] ) || ! $field['enabled'] ) {
					continue;
				}

				// Skip if conditional logic says this field should be hidden
				if ( ! $this->evaluate_condition( $field ) ) {
					continue;
				}

				$label = ! empty( $field['label'] ) ? $field['label'] : $name;
				$value = isset( $_POST[ $name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $name ] ) ) : '';

				// Required check
				if ( isset( $field['required'] ) && empty( $value ) ) {
					wc_add_notice(
						sprintf(
							/* translators: %s: field label */
							__( '%s is a required field.', 'checkout-manager' ),
							'<strong>' . esc_html( $label ) . '</strong>'
						),
						'error'
					);
				}

				// Format validation (only if a value was provided)
				if ( ! empty( $value ) ) {
					$this->validate_field_format( $name, $field, $label, $value );
				}
			}
		}
	}

	/**
	 * Validate a field's value against its configured validation type.
	 *
	 * @param string $name
	 * @param array  $field
	 * @param string $label
	 * @param string $value
	 */
	private function validate_field_format( $name, $field, $label, $value ) {
		$validation = isset( $field['validation'] ) ? $field['validation'] : '';

		if ( empty( $validation ) ) {
			return;
		}

		$error = '';

		switch ( $validation ) {
			case 'phone':
				if ( ! preg_match( '/^[+]?[0-9\s\-\(\)]{7,20}$/', $value ) ) {
					$error = sprintf(
						/* translators: %s: field label */
						__( '%s is not a valid phone number.', 'checkout-manager' ),
						'<strong>' . esc_html( $label ) . '</strong>'
					);
				}
				break;

			case 'numeric':
				if ( ! is_numeric( $value ) ) {
					$error = sprintf(
						/* translators: %s: field label */
						__( '%s must contain numbers only.', 'checkout-manager' ),
						'<strong>' . esc_html( $label ) . '</strong>'
					);
				}
				break;

			case 'alpha':
				if ( ! preg_match( '/^[a-zA-Z\s]+$/', $value ) ) {
					$error = sprintf(
						/* translators: %s: field label */
						__( '%s must contain letters only.', 'checkout-manager' ),
						'<strong>' . esc_html( $label ) . '</strong>'
					);
				}
				break;

			case 'alphanumeric':
				if ( ! preg_match( '/^[a-zA-Z0-9\s]+$/', $value ) ) {
					$error = sprintf(
						/* translators: %s: field label */
						__( '%s must contain letters and numbers only.', 'checkout-manager' ),
						'<strong>' . esc_html( $label ) . '</strong>'
					);
				}
				break;

			case 'regex':
				$regex = ! empty( $field['validation_regex'] ) ? $field['validation_regex'] : '';
				if ( ! empty( $regex ) && @preg_match( $regex, '' ) !== false && ! preg_match( $regex, $value ) ) {
					$error = sprintf(
						/* translators: %s: field label */
						__( '%s format is invalid.', 'checkout-manager' ),
						'<strong>' . esc_html( $label ) . '</strong>'
					);
				}
				break;
		}

		if ( ! empty( $error ) ) {
			wc_add_notice( $error, 'error' );
		}
	}

	/**
	 * Evaluate a field's conditional logic rule against $_POST data.
	 * Returns true if field should be shown/saved, false if hidden.
	 *
	 * @param array $field
	 * @return bool
	 */
	private function evaluate_condition( $field ) {
		$condition_field    = isset( $field['condition_field'] ) ? $field['condition_field'] : '';
		$condition_operator = isset( $field['condition_operator'] ) ? $field['condition_operator'] : 'equals';
		$condition_value    = isset( $field['condition_value'] ) ? $field['condition_value'] : '';

		// No condition configured — always show
		if ( empty( $condition_field ) ) {
			return true;
		}

		$posted_value = isset( $_POST[ $condition_field ] )
			? sanitize_text_field( wp_unslash( $_POST[ $condition_field ] ) )
			: '';

		switch ( $condition_operator ) {
			case 'equals':
				return ( $posted_value === $condition_value );
			case 'not_equals':
				return ( $posted_value !== $condition_value );
			case 'contains':
				return ( strpos( $posted_value, $condition_value ) !== false );
			case 'not_empty':
				return ( ! empty( $posted_value ) );
			case 'empty':
				return ( empty( $posted_value ) );
			default:
				return true;
		}
	}
}
