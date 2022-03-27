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
    }

    public function save_checkout_fields() {
        $response = [];

        if( !wp_verify_nonce( $_POST['_wpnonce'], 'checkout-manager' ) ) {
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
            foreach ( $_POST['woocm_fields']['billing'] as $billing ) {
                $custom_billing_fields[ $billing['id'] ] = imcm_sanitize_field( $billing );
            }
        }

        $custom_shipping_fields = [];
        if ( isset( $_POST['woocm_fields']['shipping'] ) ) {
            foreach ( $_POST['woocm_fields']['shipping'] as $shipping ) {
                $custom_shipping_fields[ $shipping['id'] ] = imcm_sanitize_field( $shipping );
            }
        }

        $custom_order_fields = [];
        if ( isset( $_POST['woocm_fields']['order'] ) ) {
            foreach ( $_POST['woocm_fields']['order'] as $order ) {
                $custom_order_fields[ $order['id'] ] = imcm_sanitize_field( $order );
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

        if( !wp_verify_nonce( $_POST['nonce'], 'checkout-manager' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'checkout-manager' );
            wp_send_json( $response );
        }

        delete_option( 'imcm-checkout-fields' );
        
        $response['status']     = 1;
        $response['message']    = __( 'Reset Settings!', 'checkout-manager' );
        wp_send_json( $response );
    }
}