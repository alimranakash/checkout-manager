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
 * @subpackage Assets
 * @author IM <im@gmail.com>
 */
class Assets {

	/**
	 * Constructor function
	 */
	public function __construct() {
        $this->hooks();
	}

    private function hooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    /**
     * Styles get function
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_styles() {
        $min = defined( 'IMCM_DEBUG_MODE' ) && IMCM_DEBUG_MODE ? '' : '.min';

        return [
            'front-style' => [
                'src'     => IMCM_ASSETS . "/css/front{$min}.css",
                'version' => filemtime( IMCM_PATH . "/assets/css/front{$min}.css" ),
            ],
            'admin-style' => [
                'src'     => IMCM_ASSETS . "/css/admin{$min}.css",
                'version' => filemtime( IMCM_PATH . "/assets/css/admin{$min}.css" ),
            ]
        ];
    }

    /**
     * Scripts get function
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_scripts() {
        $min = defined( 'IMCM_DEBUG_MODE' ) && IMCM_DEBUG_MODE ? '' : '.min';

        return [
            'front-script' => [
                'src'     => IMCM_ASSETS . "/js/front{$min}.js",
                'version' => filemtime( IMCM_PATH . "/assets/js/front{$min}.js" ),
                'deps'    => [ 'jquery', 'wp-util' ],
            ],
            'admin-script' => [
                'src'     => IMCM_ASSETS . "/js/admin{$min}.js",
                'version' => filemtime( IMCM_PATH . "/assets/js/admin{$min}.js" ),
                'deps'    => [ 'jquery', 'wp-util' ],
            ]
        ];
    }
    
    /**
     * Assets enqueue function
     * 
     * @since 1.0.0
     * 
     * @return mixed
     */
    public function enqueue_assets() {

        //Styles register 
        $styles = $this->get_styles();
        foreach ( $styles as $handale => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            wp_register_style( $handale, $style['src'], $deps, $style['version'] );
        }
        
        //Scripts register
        $scripts = $this->get_scripts();
        foreach ( $scripts as $handale => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            wp_register_script( $handale, $script['src'], $deps, $script['version'], true );
        }

        //scripts localize function
        wp_localize_script( 'front-script', 'IMCM', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'checkout-manager' ),
        ] );

        //scripts localize function
        wp_localize_script( 'admin-script', 'IMCM', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'checkout-manager' ),
        ] );
    }
}