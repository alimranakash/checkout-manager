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
 * @subpackage Admin
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
class Admin {

    /**
     * Constructor function
     */
    public function __construct() {
        $this->hooks();
    }

    private function hooks() {

        $display_position   = get_option( 'imcm-display-position' );
        $billing_hooks      = isset( $display_position['order_billing_hooks'] ) ? $display_position['order_billing_hooks'] : '';
        $shipping_hooks     = isset( $display_position['order_shipping_hooks'] ) ? $display_position['order_shipping_hooks'] : '';

        $display_position   = get_option( 'display_position' );
        $billing_hooks      = isset( $display_position['order_billing_hooks'] ) ? $display_position['order_billing_hooks'] : '';
        $shipping_hooks     = isset( $display_position['order_shipping_hooks'] ) ? $display_position['order_shipping_hooks'] : '';

        add_action( 'admin_menu', [ $this, 'submenu' ] );
        add_action( 'admin_menu', [ $this, 'admin_init' ], 20 );
        add_action( $billing_hooks, [ $this, 'custom_billing_fields' ] );
        add_action( $shipping_hooks, [ $this, 'custom_shipping_fields' ] );
    }

    /**
     * Hook for Pro plugin and extensions to register admin pages.
     *
     * @since 1.1.0
     */
    public function admin_init() {
        do_action( 'imcm_admin_menu' );
    }

    public function submenu() {
        add_submenu_page(
            'checkout-manager',
            __( 'Checkout Fields', 'checkout-manager' ),
            __( 'Checkout Fields', 'checkout-manager' ),
            'manage_options',
            'checkout-fields',
            [ $this, 'checkout_fields_callback' ] 
        );

        add_submenu_page(
            'checkout-manager',
            __( 'Premium Features', 'checkout-manager' ),
            __( 'Premium Features', 'checkout-manager' ),
            'manage_options',
            'checkout-manager-pro',
            [ $this, 'premium_features_callback' ] 
        );
    }

    public function checkout_fields_callback() {
        do_action( 'imcm_checkout_fields' );
    }

    public function premium_features_callback() {
        include_once IMCM_PATH . '/views/admin/premium-features.php';
    }

    public function custom_billing_fields( $order ) {
        do_action( 'imcm_custom_billing_fields', $order );
    }

    public function custom_shipping_fields( $order ) {
        do_action( 'imcm_custom_shipping_fields', $order );
    }
}