<?php 
extract( $args );

$custom_fields 	= imcm_custom_checkout_fields( $order );
if ( empty( $custom_fields['billing'] ) ) return;

$billing_fields	= $custom_fields['billing'];
echo '<h3>'. __( 'Custom Billing Fields', 'checkout-manager' ) .'</h3>';
echo '<div class="address">';

foreach ( $billing_fields as $label => $single_fields ) {
	foreach ( $single_fields as $key => $value ) {
        echo "<p><strong>". esc_attr( $key ) .":</strong> ". esc_html( $value ) ."</p>";
    }
	// echo "<p><strong>". esc_html( $label ) .":</strong> ". esc_html( $value ) ."</p>";
}

echo '</div>';