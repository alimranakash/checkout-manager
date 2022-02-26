<?php 
extract( $args );

$custom_fields 	= imcm_custom_checkout_fields( $order );
if ( empty( $custom_fields['billing'] ) ) return;

$billing_fields	= $custom_fields['billing'];
echo '<h3>'. __( 'Custom Billing Fields', 'wc-one-pager' ) .'</h3>';
echo '<div class="address">';

foreach ( $billing_fields as $label => $value ) {
	echo "<p><strong>". esc_html( $label ) .":</strong> ". esc_html( $value ) ."</p>";
}

echo '</div>';