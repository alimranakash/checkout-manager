<?php 
extract( $args );

$custom_fields 	= imcm_custom_checkout_fields( $order );
if ( empty( $custom_fields['shipping'] ) ) return;

$billing_fields	= $custom_fields['shipping'];
echo '<h3>'. __( 'Custom Shipping Fields', 'checkout-manager' ) .'</h3>';
echo '<div class="address">';

foreach ( $billing_fields as $label => $value ) {
	echo "<p><strong>". esc_html( $label ) .":</strong> ". esc_html( $value ) ."</p>";
}

echo '</div>';