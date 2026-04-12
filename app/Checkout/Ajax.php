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
 * @subpackage Ajax
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
class Ajax {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'wp_ajax_checkout-fields', [ $this, 'save_checkout_fields' ] );
        add_action( 'wp_ajax_reset-checkout-fields', [ $this, 'reset_checkout_fields' ] );
        add_action( 'wp_ajax_display-position', [ $this, 'display_position' ] );
        add_action( 'wp_ajax_style-options', [ $this, 'style_options' ] );
        add_action( 'wp_ajax_imcm-export-settings', [ $this, 'export_settings' ] );
        add_action( 'wp_ajax_imcm-import-settings', [ $this, 'import_settings' ] );
    }

    public function save_checkout_fields() {
        $response = [];

        if( ! wp_verify_nonce( $_POST['_wpnonce'], 'checkout-manager' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'checkout-manager' );
            wp_send_json( $response );
        }

        $option_name    = isset( $_POST['option_name'] ) ? sanitize_text_field( $_POST['option_name'] ) : '';
        $page_load      = isset( $_POST['page_load'] ) ? sanitize_text_field( $_POST['page_load'] ) : '';

        unset( $_POST['action'] );
        unset( $_POST['option_name'] );
        unset( $_POST['_wpnonce'] );
        unset( $_POST['_wp_http_referer'] );

        $custom_billing_fields = [];
        if ( isset( $_POST['woocm_fields']['billing'] ) ) {
            foreach ( $_POST['woocm_fields']['billing'] as $key => $billing ) {
                $custom_billing_fields[ $key ] = imcm_sanitize_field( $billing );
            }
        }

        $custom_shipping_fields = [];
        if ( isset( $_POST['woocm_fields']['shipping'] ) ) {
            foreach ( $_POST['woocm_fields']['shipping'] as $key => $shipping ) {
                $custom_shipping_fields[ $key ] = imcm_sanitize_field( $shipping );
            }
        }

        $custom_order_fields = [];
        if ( isset( $_POST['woocm_fields']['order'] ) ) {
            foreach ( $_POST['woocm_fields']['order'] as $key => $order ) {
                $custom_order_fields[ $key ] = imcm_sanitize_field( $order );
            }
        }

        $woocm_fields = [
            'woocm_fields'  => [
                'billing'   => $custom_billing_fields,
                'shipping'  => $custom_shipping_fields,
                'order'     => $custom_order_fields,
            ]
        ];

        update_option( $option_name, $woocm_fields );
        do_action( 'imch-checkout-fields', $option_name, $woocm_fields );
        
        $response['status']     = 1;
        $response['page_load']  = $page_load;
        $response['message']    = __( 'Settings Saved!', 'checkout-manager' );
        wp_send_json( $response );
    }

    public function reset_checkout_fields() {
        $response = [];

        if( ! wp_verify_nonce( $_POST['nonce'], 'checkout-manager' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'checkout-manager' );
            wp_send_json( $response );
        }

        delete_option( 'imcm-checkout-fields' );
        
        $response['status']     = 1;
        $response['message']    = __( 'Reset Settings!', 'checkout-manager' );
        wp_send_json( $response );
    }

    public function display_position() {
        $response = [];

        if( ! wp_verify_nonce( $_POST['_wpnonce'], 'checkout-manager' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'checkout-manager' );
            wp_send_json( $response );
        }

        $display_position = [];
        if ( isset( $_POST['display_position'] ) ) {
            foreach ( $_POST['display_position'] as $key => $hook ) {
                $display_position[ $key ] = imcm_sanitize_field( $hook );
            }
        }

        update_option( 'imcm-display-position', $display_position );

        $response['status']     = 1;
        $response['message']    = __( 'Save Settings!', 'checkout-manager' );
        wp_send_json( $response );
    }

    public function style_options() {
        $response = [];

        if( ! wp_verify_nonce( $_POST['_wpnonce'], 'checkout-manager' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'checkout-manager' );
            wp_send_json( $response );
        }

        $imcm_style_options = [];
        if ( isset( $_POST['imcm_style_options'] ) ) {
            foreach ( $_POST['imcm_style_options'] as $name => $style ) {
                $imcm_style_options[ $name ] = imcm_sanitize_field( $style );
            }
        }

        update_option( 'imcm-style-options', $imcm_style_options );

        $response['status']     = 1;
        $response['message']    = __( 'Save Settings!', 'checkout-manager' );
        wp_send_json( $response );
    }

    /**
     * Export all plugin settings as JSON.
     *
     * @since 1.1.0
     */
    public function export_settings() {
        if ( ! wp_verify_nonce( isset( $_POST['nonce'] ) ? $_POST['nonce'] : '', 'checkout-manager' ) || ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => __( 'Unauthorized!', 'checkout-manager' ) ] );
        }

        $option_keys = [
            'imcm-setting-general',
            'imcm-setting-troubleshoot',
            'imcm-checkout-fields',
            'imcm-display-position',
            'imcm-style-options',
        ];

        $export_data = [];
        foreach ( $option_keys as $key ) {
            $export_data[ $key ] = get_option( $key );
        }

        wp_send_json_success( [
            'data'    => $export_data,
            'message' => __( 'Settings exported successfully!', 'checkout-manager' ),
        ] );
    }

    /**
     * Import plugin settings from JSON.
     *
     * @since 1.1.0
     */
    public function import_settings() {
        if ( ! wp_verify_nonce( isset( $_POST['nonce'] ) ? $_POST['nonce'] : '', 'checkout-manager' ) || ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => __( 'Unauthorized!', 'checkout-manager' ) ] );
        }

        $raw = isset( $_POST['import_data'] ) ? wp_unslash( $_POST['import_data'] ) : '';
        $data = json_decode( $raw, true );

        if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $data ) ) {
            wp_send_json_error( [ 'message' => __( 'Invalid JSON data. Please paste a valid export file.', 'checkout-manager' ) ] );
        }

        $allowed_keys = [
            'imcm-setting-general',
            'imcm-setting-troubleshoot',
            'imcm-checkout-fields',
            'imcm-display-position',
            'imcm-style-options',
        ];

        foreach ( $data as $key => $value ) {
            if ( in_array( $key, $allowed_keys, true ) ) {
                update_option( sanitize_key( $key ), $value );
            }
        }

        wp_send_json_success( [
            'message' => __( 'Settings imported successfully! Reloading...', 'checkout-manager' ),
            'reload'  => true,
        ] );
    }
}