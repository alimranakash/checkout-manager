<?php wp_enqueue_style( 'admin-style' ) ?>
<div class="wrap">
	<div id="imch-settings">
		<div class="imch-setting-panel">
			<form action="">
				<p>
					<label for=""><?php _e( 'Checkout Fields Editor', 'checkout-manager' ); ?></label>
					<label class="switch">
					  	<input type="checkbox">
					  	<span class="slider"></span>
					</label>
					<input type="submit" value="<?php _e( 'Save Settings', 'checkout-manager' ); ?>">
				</p>
			</form>
		</div>
	</div>
</div>