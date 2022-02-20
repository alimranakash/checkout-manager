<?php 
extract( $args );

if ( is_int( $order ) || is_numeric( $order ) ) {
    $order = wc_get_order( $order );
}

$custom_fields = imcm_custom_checkout_fields( $order );

if ( empty( $custom_fields['billing'] ) && empty( $custom_fields['shipping'] ) ) return;

wp_enqueue_style( 'front-style' );

echo '<section class="imcm-additional-fields-details woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">';
echo '<h2 class="woocommerce-column__title">'. __( 'Custom Fields', 'wc-one-pager' ) .'</h2>';

$count = 1;
foreach ( $custom_fields as $key => $custom_field ) {
    if ( !empty( $custom_field ) ) {
        echo "<div class='woocommerce-column woocommerce-column--{$count} woocommerce-column--{$key}-address col-{$count}'>";
        echo '<h4 class="imcm-custom-fields-title woocommerce-">'. ucwords( $key ) .'</h4>';
            echo '<address>';
                foreach ( $custom_field as $key => $field ) {
                    echo "<p><strong>{$key}:</strong> {$field}</p>";
                }
            echo '</address>';
        echo '</div>';
        $count++;
    }   
}
echo '</section>';