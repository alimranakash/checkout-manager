<?php 
	wp_enqueue_style( 'admin-style' );
	wp_enqueue_script( 'admin-script' );

	$options = get_option( 'imch-setting-general' );
	if ( ! isset( $options['fields-editor'] ) ) {
	    $options['fields-editor'] = 0;
	}
?>
<div class="wrap">
	<div id="imch-settings">
		<div class="imch-setting-panel">
			<form action="" id="imch-setting-form" class="imch-setting">
				<?php wp_nonce_field( 'checkout-manager' ); ?>
				<input type="hidden" name="action" value="imch-setting">
				<input type="hidden" name="option_name" value="imch-setting-general">
				<input type="hidden" name="page_load" value="yes">
				<p>
					<label for=""><?php _e( 'Checkout Fields Editor', 'checkout-manager' ); ?></label>
					<label class="switch">
					  	<input type="checkbox" name="fields-editor" <?php checked( $options['fields-editor'], 'on' ); ?>>
					  	<span class="slider"></span>
					</label>
					<input type="submit" value="<?php _e( 'Save Settings', 'checkout-manager' ); ?>">
				</p>
			</form>
			<div class="cx-response-message" style="display: none;"></div>
		</div>
	</div>
</div>