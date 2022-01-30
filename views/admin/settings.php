<?php 
	wp_enqueue_style( 'admin-style' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'admin-script' );

	$options = get_option( 'imch-setting-general' );
	if ( ! isset( $options['fields-editor'] ) ) {
	    $options['fields-editor'] = 0;
	}
?>
<div class="wrap">
	<div id="imch-settings">
		<div id="imch-setting-tabs">
			<div class="imch-setting-tabs-panel">
				<ul>
				    <li class=""><a href="#general"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'General', 'checkout-manager' ); ?></a></li>
				    <li><a href="#display"><span class="dashicons dashicons-admin-appearance"></span> <?php _e( 'Display', 'checkout-manager' ); ?></a></li>
				  </ul>
			</div>
		  
		  	<div class="imch-setting-tabs-content">
				<div class="imch-setting-heading">
					<h4><?php _e( 'Settings', 'checkout-manager' ); ?></h4>
					<button class="imch-setting-save-button"><?php _e( 'Save Change', 'checkout-manager' ); ?></button>
				</div>
		  		<div id="general">
		  			<div class="imch-setting-content">
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
				<div id="display">
					Lorem ipsum dolor sit, amet, consectetur adipisicing elit. Ullam fugiat iure exercitationem nesciunt eum odit perferendis minus quas error! Unde est assumenda ad earum excepturi libero neque illo ducimus quo.
				</div>
		  	</div>
		</div>
	</div>
</div>