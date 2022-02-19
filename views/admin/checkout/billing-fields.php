<?php 
extract( $args );

$custom_fields 	= imcm_custom_checkout_fields( $order );
if ( empty( $custom_fields['billing'] ) ) return;

$billing_fields	= $custom_fields['billing'];
echo '<h3>'. __( 'Additional Billing Fields', 'wc-one-pager' ) .'</h3>';
echo '<div class="address">';

foreach ( $billing_fields as $label => $value ) {
	echo "<p><strong>{$label}:</strong> {$value}</p>";
}

echo '</div>';