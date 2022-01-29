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
 * @author IM <im@gmail.com>
 */
class Admin {

    /**
     * Constructor function
     */
    public function __construct() {
        $this->hooks();
    }

    private function hooks() {
        add_action( 'admin_menu', [ $this, 'submenu' ] );
    }

    public function submenu() {
        add_submenu_page(
            'checkout-manager',
            __( 'Checkout Fields Editor', 'checkout-manager' ),
            __( 'Checkout Fields Editor', 'checkout-manager' ),
            'manage_options',
            'checkout-fields-editor',
            [ $this, 'checkout_fields_editor_callback' ] 
        );
    }

    public function checkout_fields_editor_callback() {
        echo "TTTTTTTTTTTTT";
    }
}