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
 * @subpackage Template
 * @author IM <im@gmail.com>
 */
class Template {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'imcm_menu_callback', [ $this, 'settings' ] );
    }

    public function settings() {
        echo Helper::get_template( 'settings', 'views/admin' );
    }
}