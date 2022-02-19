<?php 
extract( $args );

$custom_fields 	= imcm_custom_checkout_fields( $order );
if ( empty( $custom_fields['shipping'] ) ) return;

$billing_fields	= $custom_fields['shipping'];
echo '<h3>'. __( 'Additional Shipping Fields', 'wc-one-pager' ) .'</h3>';
echo '<div class="address">';

foreach ( $billing_fields as $label => $value ) {
	echo "<p><strong>{$label}:</strong> {$value}</p>";
}

echo '</div>';