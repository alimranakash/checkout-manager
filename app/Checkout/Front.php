<?php
/**
 * All admin facing functions
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
 * @subpackage Front
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
class Front {

    /**
     * Constructor function
     */
    public function __construct() {
        $this->hooks();
    }

    private function hooks() {
        $display_position   = get_option( 'imcm-display-position' );
        $hook_name          = isset( $display_position['thankyou_hooks'] ) ? $display_position['thankyou_hooks'] : '';

        add_filter( 'woocommerce_checkout_fields', [ $this, 'checkout_fields' ] );
        add_action( $hook_name, [ $this, 'render_custom_fields' ], 20 );
    }

    public function checkout_fields( $wc_fields ) {
        wp_enqueue_style( 'front-style' );
        wp_enqueue_script( 'front-script' );

        $_woocm_fields = get_option( 'imcm-checkout-fields' ) ? : [];

        if ( ! isset( $_woocm_fields['woocm_fields'] ) || empty( $_woocm_fields['woocm_fields'] ) ) {
            return $wc_fields;
        }

        $config_fields = $_woocm_fields['woocm_fields'];
        $_fields = [];

        foreach ( $config_fields as $type => $fields ) {
            // Initialize the type in $_fields with WooCommerce's original fields
            if ( isset( $wc_fields[ $type ] ) ) {
                $_fields[ $type ] = $wc_fields[ $type ];
            } else {
                $_fields[ $type ] = [];
            }

            $priority = 10;
            foreach ( $fields as $name => $field ) {

                // Skip fields that are NOT enabled
                if ( ! isset( $field['enabled'] ) || ! $field['enabled'] ) {
                    // Remove disabled fields from output
                    unset( $_fields[ $type ][ $name ] );
                    $priority++;
                    continue;
                }

                // Field is enabled - apply configuration
                // Preserve WooCommerce's own field type for default fields
                if ( isset( $wc_fields[ $type ][ $name ]['type'] ) ) {
                    $_fields[ $type ][ $name ]['type'] = $wc_fields[ $type ][ $name ]['type'];
                }

                if ( ! imcm_is_default_field( $name ) ) {
                    $_fields[ $type ][ $name ]['type'] = isset( $field['type'] ) ? $field['type'] : 'text';
                }

                if ( isset( $field['type'] ) && in_array( $field['type'], [ 'select', 'radio' ] ) ) {
                    $_options = explode( PHP_EOL, $field['options'] );
                    $options  = [];
                    foreach ( $_options as $_option ) {
                        $_option           = trim( $_option );
                        $options[ $_option ] = $_option;
                    }
                    $_fields[ $type ][ $name ]['options'] = $options;
                }

                $_fields[ $type ][ $name ]['label']       = isset( $field['label'] ) ? $field['label'] : $name;
                $_fields[ $type ][ $name ]['required']    = isset( $field['required'] ) && $field['required'];
                $_fields[ $type ][ $name ]['priority']    = $priority;
                $_fields[ $type ][ $name ]['placeholder'] = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
                
                // Set class - initialize as array if not already
                if ( ! isset( $_fields[ $type ][ $name ]['class'] ) ) {
                    $_fields[ $type ][ $name ]['class'] = [];
                }
                if ( ! is_array( $_fields[ $type ][ $name ]['class'] ) ) {
                    $_fields[ $type ][ $name ]['class'] = [ $_fields[ $type ][ $name ]['class'] ];
                }
                $_fields[ $type ][ $name ]['class'][] = isset( $field['class'] ) ? $field['class'] : 'form-row-wide';

                // Preserve WooCommerce's validate rules for default fields; clear for custom ones
                if ( imcm_is_default_field( $name ) && isset( $wc_fields[ $type ][ $name ]['validate'] ) ) {
                    $_fields[ $type ][ $name ]['validate'] = $wc_fields[ $type ][ $name ]['validate'];
                } else {
                    $_fields[ $type ][ $name ]['validate'] = [];
                }

                // Conditional logic — pass condition data as custom HTML attributes
                if ( ! imcm_is_default_field( $name ) && ! empty( $field['condition_field'] ) ) {
                    $_fields[ $type ][ $name ]['custom_attributes']['data-condition-field']    = esc_attr( $field['condition_field'] );
                    $_fields[ $type ][ $name ]['custom_attributes']['data-condition-operator'] = esc_attr( isset( $field['condition_operator'] ) ? $field['condition_operator'] : 'equals' );
                    $_fields[ $type ][ $name ]['custom_attributes']['data-condition-value']    = esc_attr( isset( $field['condition_value'] ) ? $field['condition_value'] : '' );
                }

                $priority++;
            }
        }

        /**
         * Filter checkout fields before returning.
         * Pro plugin can use this hook to modify or extend checkout fields.
         *
         * @since 1.1.0
         *
         * @param array $_fields      Checkout fields array
         * @param array $wc_fields    WooCommerce original fields
         * @param array $config_fields Config fields from plugin settings
         */
        $_fields = apply_filters( 'imcm_checkout_fields_output', $_fields, $wc_fields, $config_fields );

        return $_fields;
    }

    public function render_custom_fields( $order ) {
        do_action( 'imcm_custom_fields', $order );
    }
}