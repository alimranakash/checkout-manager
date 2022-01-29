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
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
class Template {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'imcm_settings', [ $this, 'settings' ] );
        add_action( 'imcm_fields_editor', [ $this, 'fields_editor' ] );
    }

    public function settings() {
        echo Helper::get_template( 'settings', 'views/admin' );
    }

    public function fields_editor() {
        echo Helper::get_template( 'fields-editor', 'views/admin/fields-editor' );
    }
}