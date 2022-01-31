<?php 

if( !function_exists( 'pri' ) ) :
function pri( $data ) {
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
                'label'         => __( 'First name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   =>  '',
                'class'         => 'form-row-first',
            ],
            'billing_last_name'     => [
                'id'            => 'billing_last_name',
                'label'         => __( 'Last name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-last',
            ],
            'billing_company'       => [
                'id'            => 'billing_company',
                'label'         => __( 'Company name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_country'       => [
                'id'            => 'billing_country',
                'label'         => __( 'Country / Region', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_address_1'     => [
                'id'            => 'billing_address_1',
                'label'         => __( 'Street address', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => __( 'House number and street name', 'woocheckout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'billing_address_2'     => [
                'id'            => 'billing_address_2',
                'label'         => __( 'Address 2', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => __( 'Apartment, suite, unit, etc. (optional)', 'woocheckout-manager' ),
                'class'         => 'form-row-wide',
            ],
            'billing_city'          => [
                'id'            => 'billing_city',
                'label'         => __( 'Town / City', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_state'         => [
                'id'            => 'billing_state',
                'label'         => __( 'State', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'text',
                'class'         => 'form-row-wide',
            ],
            'billing_postcode'      => [
                'id'            => 'billing_postcode',
                'label'         => __( 'ZIP', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'text',
                'class'         => 'form-row-wide',
            ],
            'billing_phone'         => [
                'id'            => 'billing_phone',
                'label'         => __( 'Phone', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'billing_email'         => [
                'id'            => 'billing_email',
                'label'         => __( 'Email address', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
        ],

        'shipping' => [ 
            'shipping_first_name'   => [
                'id'            =>  'shipping_first_name',
                'label'         => __( 'First name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-first',
            ],
            'shipping_last_name'    => [
                'id'            =>  'shipping_last_name',
                'label'         => __( 'Last name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-last',
            ],
            'shipping_company'      => [
                'id'            =>  'shipping_company',
                'label'         => __( 'Company name', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_country'      => [
                'id'            =>  'shipping_country',
                'label'         => __( 'Country / Region', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_address_1'    => [
                'id'            =>  'shipping_address_1',
                'label'         => __( 'Street address', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'House number and street name',
                'class'         => 'form-row-wide',
            ],
            'shipping_address_2'    => [
                'id'            =>  'shipping_address_2',
                'label'         => __( 'address 2', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => 'Apartment, suite, unit, etc. (optional)',
                'class'         => 'form-row-wide',
            ],
            'shipping_city'         => [
                'id'            =>  'shipping_city',
                'label'         => __( 'Town / City', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_state'        => [
                'id'            =>  'shipping_state',
                'label'         => __( 'State', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
            'shipping_postcode'     => [
                'id'            =>  'shipping_postcode',
                'label'         => __( 'ZIP', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => true,
                'placeholder'   => '',
                'class'         => 'form-row-wide',
            ],
        ],

        'order' => [ 
            'order_comments'    => [
                'id'            =>  'order_comments',
                'label'         => __( 'Order Notes', 'woocheckout-manager' ),
                'enabled'       => 'on',
                'required'      => false,
                'placeholder'   => 'Notes about your order, e.g. special notes for delivery.',
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
if( !function_exists( 'woocm_is_default_field' ) ) :
function woocm_is_default_field( $field_id ) {

    $default_fields = imcm_wc_fields();
    foreach ( $default_fields as $key => $fields ) {
        if ( array_key_exists( $field_id, $fields ) ) {
            return true;
        }
    }
}
endif;