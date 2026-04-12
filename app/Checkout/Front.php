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

        if ( isset( $_woocm_fields['woocm_fields'] ) ) {
            $types = $_woocm_fields['woocm_fields'];
        }

        if ( empty( $types ) ) return $wc_fields;

        $_fields = [];

        foreach ( $types as $type => $fields ) {
            $priority = 10;
            foreach ( $fields as $name => $field ) {

                if ( isset( $field['enabled'] ) ) {

                    // Preserve WooCommerce's own field type for default fields
                    if ( isset( $wc_fields[ $type ][ $name ]['type'] ) ) {
                        $_fields[ $type ][ $name ]['type'] = $wc_fields[ $type ][ $name ]['type'];
                    }

                    if ( ! imcm_is_default_field( $name ) ) {
                        $_fields[ $type ][ $name ]['type'] = $field['type'];
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

                    $_fields[ $type ][ $name ]['label']       = $field['label'];
                    $_fields[ $type ][ $name ]['required']    = isset( $field['required'] );
                    $_fields[ $type ][ $name ]['priority']    = $priority;
                    $_fields[ $type ][ $name ]['placeholder'] = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
                    $_fields[ $type ][ $name ]['class'][]     = isset( $field['class'] ) ? $field['class'] : 'form-row-wide';

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
                }
                $priority++;
            }
        }

        return $_fields;
    }

    public function render_custom_fields( $order ) {
        do_action( 'imcm_custom_fields', $order );
    }
}