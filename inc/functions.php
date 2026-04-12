<?php 

if( !function_exists( 'imcm_pri' ) ) :
function imcm_pri( $data ) {
    echo '<pre>';
    if( is_object( $data ) || is_array( $data ) ) {
        print_r( $data );
    }
    else {
        var_dump( $data );
    }
    echo '</pre>';
}
endif;

/**
 * Default checkout fields
 *
 * @param string $section form section billing|shipping|order
 *
 * @since 1.0
 */
if( !function_exists( 'imcm_wc_fields' ) ) :
function imcm_wc_fields( $section = '' ) {
    $fields = [
        'billing' => [
            'billing_first_name'    => [
                'id'            => 'billing_first_name',
                'label'         => __( 'First name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   =>  '',
                'class'         => 'form-row-first',
            ],
            'billing_last_name'     => [
                'id'            => 'billing_last_name',
                'label'         => __( 'Last name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-last',
            ],
            'billing_company'       => [
                'id'            => 'billing_company',
                'label'         => __( 'Company name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_country'       => [
                'id'            => 'billing_country',
                'label'         => __( 'Country / Region', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_address_1'     => [
                'id'            => 'billing_address_1',
                'label'         => __( 'Street address', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => __( 'House number and street name', 'checkout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'billing_address_2'     => [
                'id'            => 'billing_address_2',
                'label'         => __( 'Address 2', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => __( 'Apartment, suite, unit, etc. (optional)', 'checkout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'billing_city'          => [
                'id'            => 'billing_city',
                'label'         => __( 'Town / City', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_state'         => [
                'id'            => 'billing_state',
                'label'         => __( 'State', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'text',
                'class'         => 'form-row-wide',
            ],
            'billing_postcode'      => [
                'id'            => 'billing_postcode',
                'label'         => __( 'ZIP', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'text',
                'class'         => 'form-row-wide',
            ],
            'billing_phone'         => [
                'id'            => 'billing_phone',
                'label'         => __( 'Phone', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_email'         => [
                'id'            => 'billing_email',
                'label'         => __( 'Email address', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
        ],

        'shipping' => [
            'shipping_first_name'   => [
                'id'            =>  'shipping_first_name',
                'label'         => __( 'First name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-first',
            ],
            'shipping_last_name'    => [
                'id'            =>  'shipping_last_name',
                'label'         => __( 'Last name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-last',
            ],
            'shipping_company'      => [
                'id'            =>  'shipping_company',
                'label'         => __( 'Company name', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_country'      => [
                'id'            =>  'shipping_country',
                'label'         => __( 'Country / Region', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_address_1'    => [
                'id'            =>  'shipping_address_1',
                'label'         => __( 'Street address', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => __( 'House number and street name', 'checkout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'shipping_address_2'    => [
                'id'            =>  'shipping_address_2',
                'label'         => __( 'Address 2', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => __( 'Apartment, suite, unit, etc. (optional)', 'checkout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'shipping_city'         => [
                'id'            =>  'shipping_city',
                'label'         => __( 'Town / City', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_state'        => [
                'id'            =>  'shipping_state',
                'label'         => __( 'State', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_postcode'     => [
                'id'            =>  'shipping_postcode',
                'label'         => __( 'ZIP', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
        ],

        'order' => [
            'order_comments'    => [
                'id'            =>  'order_comments',
                'label'         => __( 'Order Notes', 'checkout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => __( 'Notes about your order, e.g. special notes for delivery.', 'checkout-manager' ),
                'class'         => 'notes',
            ],
        ]
    ];

    if( $section != '' && isset( $fields[ $section ] ) ) {
        return apply_filters( 'woocm_wc_fields', $fields[ $section ] );
    }

    return apply_filters( 'woocm_wc_fields', $fields );
}
endif;

/**
 * Check Default Field
 *
 * @return boolean
 */
if( !function_exists( 'imcm_is_default_field' ) ) :
function imcm_is_default_field( $field_id ) {

    $default_fields = imcm_wc_fields();
    foreach ( $default_fields as $key => $fields ) {
        if ( array_key_exists( $field_id, $fields ) ) {
            return true;
        }
    }
}
endif;

if( !function_exists( 'imcm_custom_checkout_meta_data' ) ) :
function imcm_custom_checkout_meta_data( $order ) {
    $meta_datas = $order->get_meta_data();
    
    $metas = [];
    foreach ( $meta_datas as $meta_data ) {
        $metas[ $meta_data->get_data()['key'] ] = $meta_data->get_data()['value'];
    }
    return $metas;
}
endif;

if( !function_exists( 'imcm_custom_checkout_fields' ) ) :
function imcm_custom_checkout_fields( $order ) {
    $_woocm_fields = get_option( 'imcm-checkout-fields' ) ? : [];

    $meta_datas = imcm_custom_checkout_meta_data( $order );

    if ( isset( $_woocm_fields['woocm_fields'] ) ) {
        $types = $_woocm_fields['woocm_fields'];
    }
    else {
        $types = imcm_wc_fields();
    }

    $_custom_fields = [];
    foreach ( $types as $type => $fields ) {
        foreach ( $fields as $name => $field ) {
            // Only include non-default fields that are enabled
            if ( ! imcm_is_default_field( $name ) && isset( $field['enabled'] ) && $field['enabled'] ) {
                $_custom_fields[ $type ][ $name ] = $field['label'];
            }
        }
    }

    $custom_billing_fields = [];
    if ( isset( $_custom_fields['billing'] ) ) {
        foreach ( $_custom_fields['billing'] as $key => $label ) {
            if ( array_key_exists( '_'. $key, $meta_datas ) ) {
                // $custom_billing_fields[ $label ] = $meta_datas['_'. $key];
                $custom_billing_fields[ $key ][ $label ] = $meta_datas['_'. $key];
            }    
        }
    }

    $custom_shipping_fields = [];
    if ( isset( $_custom_fields['shipping'] ) ) {
        foreach ( $_custom_fields['shipping'] as $key => $label ) {
            if ( array_key_exists( '_'. $key, $meta_datas ) ) {
                // $custom_shipping_fields[ $label ] = $meta_datas['_'. $key];
                $custom_shipping_fields[ $key ][ $label ] = $meta_datas['_'. $key];
            }    
        }
    }

    $custom_fields = [
        'billing'   => $custom_billing_fields,
        'shipping'  => $custom_shipping_fields,
    ];
    return $custom_fields;
}
endif;

if( !function_exists( 'imcm_enable_debug' ) ) :
function imcm_enable_debug() {
    $troubleshoot = get_option( 'imcm-setting-troubleshoot', [] );

    $enable_debug = false;
    if ( ! empty( $troubleshoot['enable-debug'] ) && $troubleshoot['enable-debug'] == 'on' ) {
        $enable_debug = true;
    }
    return $enable_debug;
}
endif;

if( !function_exists( 'imcm_sanitize_field' ) ) :
function imcm_sanitize_field( $field ) {

    if( is_array( $field ) ) {
        $value = array_map( 'sanitize_text_field', $field );
    }
    else {
        $value = sanitize_text_field( $field );
    }

    return $value;
}
endif;

if( !function_exists( 'imcm_thankyou_hooks' ) ) :
function imcm_thankyou_hooks() {

    $hooks = [
        'woocommerce_before_thankyou'                       => __( 'Before Thankyou', 'checkout-manager' ),
        'woocommerce_order_details_before_order_table'      => __( 'Before Order Details', 'checkout-manager' ),
        'woocommerce_after_order_details'                   => __( 'After Order Details', 'checkout-manager' ),
        'woocommerce_order_details_after_customer_details'  => __( 'After All Details', 'checkout-manager' ),
    ];

    return apply_filters( 'imcm_thankyou_hooks', $hooks );
}
endif;

if( !function_exists( 'imcm_email_hooks' ) ) :
function imcm_email_hooks() {

    $hooks = [
        'woocommerce_email_order_details'       => __( 'Order Details', 'checkout-manager' ),
        'woocommerce_email_order_meta'          => __( 'Order Meta', 'checkout-manager' ),
        'woocommerce_email_customer_details'    => __( 'Customer Details', 'checkout-manager' ),
    ];

    return apply_filters( 'imcm_email_hooks', $hooks );
}
endif;

if( !function_exists( 'imcm_order_hooks' ) ) :
function imcm_order_hooks() {

    $hooks = [
        'woocommerce_admin_order_data_after_order_details'      => __( 'After Order Details', 'checkout-manager' ),
        'woocommerce_admin_order_data_after_billing_address'    => __( 'After Billing Details', 'checkout-manager' ),
        'woocommerce_admin_order_data_after_shipping_address'   => __( 'After Shipping Details', 'checkout-manager' ),
        'woocommerce_admin_order_items_after_shipping'          => __( 'Order Items After Shipping', 'checkout-manager' ),
        'woocommerce_admin_order_totals_after_tax'              => __( 'After Tax', 'checkout-manager' ),
        'woocommerce_admin_order_totals_after_total'            => __( 'After Order Total', 'checkout-manager' ),
        'woocommerce_order_item_add_action_buttons'             => __( 'After Action Buttons', 'checkout-manager' ),
    ];

    return apply_filters( 'imcm_order_hooks', $hooks );
}
endif;

if( !function_exists( 'imcm_get_style' ) ) :
function imcm_get_style( $name, $default ) {

    $_style = get_option( 'imcm-style-options' );

    $style  = isset( $_style[ $name ] ) ? $_style[ $name ] : $default;

    return apply_filters( 'imcm_get_style', $style );
}
endif;

/**
 * Returns available validation types for custom checkout fields.
 *
 * @since 1.1.0
 * @return array
 */
if( !function_exists( 'imcm_get_validation_types' ) ) :
function imcm_get_validation_types() {
    $types = [
        ''             => __( 'None', 'checkout-manager' ),
        'phone'        => __( 'Phone Number', 'checkout-manager' ),
        'numeric'      => __( 'Numeric Only', 'checkout-manager' ),
        'alpha'        => __( 'Letters Only', 'checkout-manager' ),
        'alphanumeric' => __( 'Alphanumeric', 'checkout-manager' ),
        'regex'        => __( 'Custom (Regex)', 'checkout-manager' ),
    ];
    return apply_filters( 'imcm_validation_types', $types );
}
endif;

/**
 * Returns available condition operators for conditional logic.
 *
 * @since 1.1.0
 * @return array
 */
if( !function_exists( 'imcm_get_condition_operators' ) ) :
function imcm_get_condition_operators() {
    $operators = [
        'equals'     => __( 'Equals', 'checkout-manager' ),
        'not_equals' => __( 'Not Equals', 'checkout-manager' ),
        'contains'   => __( 'Contains', 'checkout-manager' ),
        'not_empty'  => __( 'Is Not Empty', 'checkout-manager' ),
        'empty'      => __( 'Is Empty', 'checkout-manager' ),
    ];
    return apply_filters( 'imcm_condition_operators', $operators );
}
endif;