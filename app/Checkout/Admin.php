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

    public function submenu() {
        add_submenu_page(
            'checkout-manager',
            'My Custom Submenu Page',
            'My Custom Submenu Page',
            'manage_options',
            'my-custom-submenu-page',
            [ $this, 'wpdocs_my_custom_submenu_page_callback' ] 
        );
    }

    public function wpdocs_my_custom_submenu_page_callback() {
        echo "TTTTTTTTTTTTT";
    }
}