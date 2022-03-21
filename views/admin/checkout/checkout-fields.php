<?php 
	wp_enqueue_style( 'admin-style' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'admin-script' );

	$options = get_option( 'imcm-setting-general' );
	if ( ! isset( $options['fields-editor'] ) ) {
	    $options['fields-editor'] = 0;
	}

	$_woocm_fields = get_option( 'imcm-checkout-fields' ) ? : '';

	if ( isset( $_woocm_fields['woocm_fields'] ) ) {
		$types = $_woocm_fields['woocm_fields'];
	}
	else {
		$types = imcm_wc_fields();
	}

	$enabled_text 		= __( 'Field Enabled/Disabled', 'checkout-manager' );
	$label_text 		= __( 'Label', 'checkout-manager' );
	$name_text 			= __( 'Name', 'checkout-manager' );
	$placeholder_text	= __( 'Placeholder', 'checkout-manager' );
	$required_text 		= __( 'Required', 'checkout-manager' );
	$class_name_text 	= __( 'Class Name', 'checkout-manager' );
	$type_text 			= __( 'Type', 'checkout-manager' );
	$option_text		= __( 'Option', 'checkout-manager' );
	$newfield_text		= __( 'New Field', 'checkout-manager' );
	$newfield_id		= __( 'new_field', 'checkout-manager' );

	$classes = [ 
		'form-row-first' 	=>  __( 'Left', 'checkout-manager' ),
		'form-row-last' 	=>  __( 'Right', 'checkout-manager' ),
		'form-row-wide' 	=>  __( 'Wide', 'checkout-manager' ),
	];

	$_field_types = [ 
		'text'			=> __( 'Text', 'checkout-manager' ),
		'state'			=> __( 'State', 'checkout-manager' ),
		'textarea'		=> __( 'Textarea', 'checkout-manager' ),
		'checkbox'		=> __( 'Checkbox', 'checkout-manager' ),
		'password'		=> __( 'Password', 'checkout-manager' ),
		'datetime'		=> __( 'Datetime', 'checkout-manager' ),
		'datetime-local'=> __( 'Datetime Local', 'checkout-manager' ),
		'date'			=> __( 'Date', 'checkout-manager' ),
		'month'			=> __( 'Month', 'checkout-manager' ),
		'time'			=> __( 'Time', 'checkout-manager' ),
		'week'			=> __( 'Week', 'checkout-manager' ),
		'number'		=> __( 'Number', 'checkout-manager' ),
		'email'			=> __( 'Email', 'checkout-manager' ),
		'url'			=> __( 'Url', 'checkout-manager' ),
		'tel'			=> __( 'Tel', 'checkout-manager' ),
		'country'		=> __( 'Country', 'checkout-manager' ),
		'select'		=> __( 'Select', 'checkout-manager' ),
		'radio'			=> __( 'Radio', 'checkout-manager' ),
		'file'			=> __( 'Upload File', 'checkout-manager' ),
	];
?>
<div class="wrap">
	<div id="imcm-settings">
		<div id="imcm-setting-tabs">
			<div class="imcm-setting-tabs-panel">
				<ul>
				    <li class=""><a href="#checkout-fields"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Checkout Fields', 'checkout-manager' ); ?></a></li>
				    <!-- <li class=""><a href="#fields-style"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Fields Style', 'checkout-manager' ); ?></a></li> -->
				  </ul>
			</div>
		  
		  	<div class="imcm-setting-tabs-content imcm-checkout-fields-panel">
				<div class="imcm-setting-heading">
					<h4><?php _e( 'Settings', 'checkout-manager' ); ?></h4>
					<button class="imcm-setting-button imcm-setting-save-button"><?php _e( 'Save Change', 'checkout-manager' ); ?></button>
				</div>
				<form action="" id="imcm-setting-form" class="imcm-setting">
					<?php wp_nonce_field( 'checkout-manager' ); ?>
					<input type="hidden" name="action" value="checkout-fields">
					<input type="hidden" name="option_name" value="imcm-checkout-fields">
					<input type="hidden" name="page_load" value="0">
					<div id="checkout-fields">
			  			<div class="imcm-setting-content">
			  				<div id="woocm-checkout-panel">
								<div class="woocm-checkout-panel-tabs">
									<div class="woocm-checkout-panel-tabs-nav">
										<ul>
											<li><a href="#woocm-billing" class="woocm-tab-btn active" data-tab="woocm-billing"><?php _e( 'Billing', 'checkout-manager' ); ?></a></li>
											<li><a href="#woocm-shipping" class="woocm-tab-btn" data-tab="woocm-shipping"><?php _e( 'Shipping', 'checkout-manager' ); ?></a></li>
											<li><a href="#woocm-order" class="woocm-tab-btn" data-tab="woocm-order"><?php _e( 'Order', 'checkout-manager' ); ?></a></li>
										</ul>
									</div>
									<div class="woocm-checkout-panel-tabs-content">
										<?php foreach ( $types as $type => $fields ): ?>
											<div id="woocm-<?php echo esc_attr( $type ); ?>" class="woocm-tab-content">
												<ul id="woocm-<?php echo esc_attr( $type ); ?>-list-wrap" class="woocm-list-wrap woocm-sortable">
														
													<?php 
													foreach ( $fields as $name => $field ): 
														// woocm_pri($field);

														$disabled 		= '';
														$readonly 		= '';
														$hide 			= '';

														if ( woocm_is_default_field( $name ) ) {
															$disabled 	= 'disabled';
															$readonly 	= 'readonly';
															$hide 		= 'woocm-hide';
														}

														if ( isset( $field['enabled'] ) && $field['enabled'] == true ) {
															$enabled 	= 'checked';
														}
														else{
															$enabled 	= '';
														}

														if ( isset( $field['required'] ) && $field['required'] == true ) {
															$required 	= 'checked';
														}
														else{
															$required 	= '';
														}

														$class_options = '';
														foreach ( $classes as $value => $class ) {
															$class_options .= "<option value='{$value}' ". selected( $value, $field['class'], false ) .">{$class}</option>";
														}

														$set_type = isset( $field['type'] ) ? $field['type'] : '';
														$field_types = '';
														foreach ( $_field_types as $value => $field_type ) {
															$field_types .= "<option value='{$value}' ". selected( $value, $set_type, false ) .">{$field_type}</option>";
														}

														$show = '';
														if ( $set_type == 'select' || $set_type == 'radio' ) {
															$show 		= 'wcop-show';
														}

														$set_options 	= isset( $field['options'] ) ? $field['options'] : '';
														$label 			= esc_attr( $field['label'] );

														echo "<li class='woocm-list-item'>
															<h4 data-name='woocm-{$name}'>
																<span class='dashicons dashicons-menu-alt2'></span>
																<span>{$field['label']}</span>
															</h4>

															<div class='woocm-action-panel {$disabled}' title='{$enabled_text}'>
																<label class='woocm-item-switch'>
																  	<input type='checkbox' name='woocm_fields[{$type}][{$name}][enabled]' {$enabled}>
																  	<span class='woocm-item-slider woocm-item-round'></span>
																</label>
																<button class='woocm-item-remove' {$disabled}><span class='dashicons dashicons-dismiss'></span></button>
															</div>
															
															<div class='woocm-item-wrap woocm-accordion woocm-{$name} {$hide} {$show}'>

																<p class='woocm-item-field-label'>
																	<label class='woocm-item-label' for='{$label}'>{$label_text}</label>
																	<input class='woocm-item-input-field' id='{$label}' type='text' name='woocm_fields[{$type}][{$name}][label]' value='{$label}' placeholder='New Field'>
																</p>

																<p class='woocm-item-field-id'>
																	<label class='woocm-item-label' for='{$field['id']}'>{$name_text}</label>
																	<input class='woocm-input-id' id='{$field['id']}' data-oldid='{$field['id']}' type='text' name='woocm_fields[{$type}][{$name}][id]' value='{$field['id']}'>
																</p>

																<p class='woocm-item-field-placeholder'>
																	<label class='woocm-item-label' for='pls_{$field['id']}'>{$placeholder_text}</label>
																	<input class='woocm-input-id' id='pls_{$field['id']}' data-oldid='{$field['placeholder']}' type='text' name='woocm_fields[{$type}][{$name}][placeholder]' value='{$field['placeholder']}'>
																</p>

																<p class='woocm-item-field-type'>
																	<label class='woocm-item-label' for=''>{$type_text}</label>
																	<select name='woocm_fields[{$type}][{$name}][type]'>
																		{$field_types}
																	</select>
																</p>

																<p class='woocm-item-field-options'>
																	<label class='woocm-item-label' for='{$option_text}'>{$option_text}</label>
																	<textarea id='{$option_text}' class='woocm-input-options' name='woocm_fields[{$type}][{$name}][options]' rows='4'>{$set_options}</textarea>
																</p>
																
																<p class='woocm-item-field-required'>
																	<label for='{$required_text}'>{$required_text}</label>
																	<label class='woocm-item-switch'>
																	  	<input id='{$required_text}' type='checkbox' name='woocm_fields[{$type}][{$name}][required]' {$required}>
																	  	<span class='woocm-item-slider woocm-item-round'></span>
																	</label>
																</p>
																<p class='woocm-item-field-class'>
																	<label class='woocm-item-label' for='cls_{$field['id']}'>{$class_name_text}</label>
																	<select id='cls_{$field['id']}' name='woocm_fields[{$type}][{$name}][class]'>
																		{$class_options}
																	</select>
																</p>
															</div>
														</li>";
													endforeach; 
													?>

												</ul>

												<div class="woocm-toggle-button-wrap">
													<?php 
													printf( '<button class="woocm-modal-toggle" data-type="%s" title="%s">%s %s</button>',
														$type,
														__( 'Add ' . esc_html( ucwords( $type ) ) . ' Field' , 'checkout-manager' ),
														'<span class="dashicons dashicons-plus"></span>',
														__( 'Add Field' , 'checkout-manager' )
													);
													?>
												</div>
												<div class="woocm-modal">
													<div class="woocm-modal-overlay woocm-modal-toggle"></div>
													<div class="woocm-modal-wrapper woocm-modal-transition">
														<div class="woocm-modal-header">
															<button class="woocm-modal-close woocm-modal-toggle"><span class="dashicons dashicons-no-alt"></span></button>
															<h2 class="woocm-modal-heading"><?php _e( 'Add ' . esc_html( ucwords( $type ) ) . ' Field' , 'checkout-manager' ); ?></h2>
														</div>

														<div class="woocm-modal-body">
															<?php 
															echo "<div class='woocm-modal-content'>
																<div id='woocm-clone-{$type}-item' class='woocm-clone-item-panel'>
																	<li class='woocm-list-item ui-sortable-handle'>

																		<h4 class='woocm-item-heading' data-name='woocm-{$type}_%%%'><span class='dashicons dashicons-menu-alt2'></span> New Field</h4>

																		<div class='woocm-action-panel'>
																			<label class='woocm-item-switch'>
																			  	<input type='checkbox' %attrname%='woocm_fields[{$type}][{$type}_%%%][enabled]' {$enabled}>
																			  	<span class='woocm-item-slider woocm-item-round'></span>
																			</label>
																			<button class='woocm-item-remove'><span class='dashicons dashicons-dismiss'></span></button>
																		</div>

																		<div class='woocm-item-wrap woocm-accordion woocm-{$type}_%%%'>
																			<p class='woocm-item-field-label'>
																				<label class='woocm-item-label' for=''>{$label_text}</label>
																				<input class='woocm-input-field woocm-label' id='' type='text' %attrname%='woocm_fields[{$type}][{$type}_%%%][label]' value='{$newfield_text}' placeholder='{$newfield_text}'>
																			</p>

																			<p class='woocm-item-field-id'>
																				<label class='woocm-item-label' for=''>{$name_text}</label>
																				<input class='woocm-input-field woocm-id' id='' data-oldid='' type='text' %attrname%='woocm_fields[{$type}][{$type}_%%%][id]' value='{$newfield_id}'>
																			</p>

																			<p class='woocm-item-field-placeholder'>
																				<label class='woocm-item-label' for=''>{$placeholder_text}</label>
																				<input class='woocm-input-field woocm-placeholder' id='' data-oldid='' type='text' %attrname%='woocm_fields[{$type}][{$type}_%%%][placeholder]' value='{$newfield_text}'>
																			</p>

																			<p class='woocm-item-field-type'>
																				<label class='woocm-item-label' for=''>{$type_text}</label>
																				<select class='woocm-input-field woocm-type' %attrname%='woocm_fields[{$type}][{$type}_%%%][type]'>
																					{$field_types}
																				</select>
																			</p>

																			<p class='woocm-item-field-options'>
																				<label class='woocm-item-label' for=''>{$option_text}</label>
																				<textarea class='woocm-input-options' %attrname%='woocm_fields[{$type}][{$type}_%%%][options]' rows='4'>{$set_options}</textarea>
																			</p>
																			
																			<p class='woocm-item-field-required'>
																				<label for=''>{$required_text}</label>
																				<label class='woocm-item-switch'>
																				  	<input id='' type='checkbox' %attrname%='woocm_fields[{$type}][{$type}_%%%][required]' {$required}>
																				  	<span class='woocm-item-slider woocm-item-round'></span>
																				</label>
																			</p>
																			<p class='woocm-item-field-class'>
																				<label class='woocm-item-label' for=''>{$class_name_text}</label>
																				<select class='woocm-input-field woocm-class' %attrname%='woocm_fields[{$type}][{$type}_%%%][class]'>
																					{$class_options}
																				</select>
																			</p>
																		</div>
																	</li>
																</div>
																<div class='woocm-clone-item-btn-panel'>
																	<button class='woocm-clone-item' data-type='{$type}'>Insert Field</button>
																</div>
															</div>";
															?>
														</div>
													</div>
												</div>

											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="cx-response-message" style="display: none;"></div>
				<!-- <div id="fields-style">
					Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Quia iure cumque quam eum consectetur vero animi provident numquam, ratione temporibus. Eaque accusantium, inventore architecto. Vel nesciunt, facere ab iure nobis.
				</div> -->
				<div class="imcm-setting-footer">
					<button class="imcm-setting-button imcm-setting-reset-button"><?php _e( 'Reset', 'checkout-manager' ); ?></button>
					<button class="imcm-setting-button imcm-setting-save-button"><?php _e( 'Save Change', 'checkout-manager' ); ?></button>
				</div>
		  	</div>
		</div>
	</div>
</div>