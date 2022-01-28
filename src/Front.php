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
 * @subpackage Front
 * @author IM <im@gmail.com>
 */
class Front {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'wp_head', [ $this, 'head' ] );
    }

    public function head() {
        // wp_enqueue_style( 'front-style' );
        // wp_enqueue_script( 'front-script' );
    }
}