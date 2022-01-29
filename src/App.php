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
 * @subpackage App
 * @author IM <im@gmail.com>
 */
class App {

    public $apps;

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
        $this->apps = [ 'Checkout' ];
	}

    private function hooks() {
        add_action( 'plugins_loaded', [ $this, 'load' ], 11 );
    }

    public function load() {
        $options = get_option( 'imch-setting-general' );
        if ( isset( $options['fields-editor'] ) && $options['fields-editor'] == 'on' ) {
            App\Checkout::instance();
        }
    }
}