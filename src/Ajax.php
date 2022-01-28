<?php
/**
 * All admin facing functions
 */
namespace WPPlugines\Checkout_Manager;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Ajax
 * @author IM <im@gmail.com>
 */
class Ajax {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'wp_ajax_callback-name', [ $this, 'callback_name' ] );
        add_action( 'wp_ajax_nopriv_callback-name', [ $this, 'callback_name' ] );
    }

    public function callback_name() {
        $response = [];

        if( !wp_verify_nonce( $_POST['_wpnonce'], 'im-plugin' ) ) {
            $response['status']     = 0;
            $response['message']    = __( 'Unauthorized!', 'im-plugin' );
            wp_send_json( $response );
        }
        
        $response['message']    = __( 'Rquest send Successfully!', 'im-plugin' );
        $response['status']     = 1;
        wp_send_json( $response );
    }
}