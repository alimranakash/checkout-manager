<?php 
	wp_enqueue_style( 'admin-style' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'admin-script' );

	$options = get_option( 'imch-setting-general' );
	if ( ! isset( $options['fields-editor'] ) ) {
	    $options['fields-editor'] = 0;
	}

	$_woocm_fields = get_option( 'woocheckout-manager_checkout' ) ? : [];

	if ( isset( $_woocm_fields['woocm_fields'] ) ) {
		$types = $_woocm_fields['woocm_fields'];
		// woocm_pri($types);
	}
	else {
		$types = imcm_wc_fields();
		// woocm_pri($types);
	}

	$label_text 		= __( 'Label', 'woocheckout-manager' );
	$name_text 			= __( 'Name', 'woocheckout-manager' );
	$placeholder_text	= __( 'Placeholder', 'woocheckout-manager' );
	$required_text 		= __( 'Required', 'woocheckout-manager' );
	$class_name_text 	= __( 'Class Name', 'woocheckout-manager' );
	$type_text 			= __( 'Type', 'woocheckout-manager' );
	$option_text		= __( 'Option', 'woocheckout-manager' );
	$newfield_text		= __( 'New Field', 'woocheckout-manager' );
	$newfield_id		= __( 'new_field', 'woocheckout-manager' );

	$classes = [ 
		'form-row-first' 	=>  __( 'Left', 'woocheckout-manager' ),
		'form-row-last' 	=>  __( 'Right', 'woocheckout-manager' ),
		'form-row-wide' 	=>  __( 'Wide', 'woocheckout-manager' ),
	];

	$_field_types = [ 
		'text'			=>	'Text',
		'state'			=>	'State',
		'textarea'		=>	'Textarea',
		'checkbox'		=>	'Checkbox',
		'password'		=>	'Password',
		'datetime'		=>	'Datetime',
		'datetime-local'=>	'Datetime-local',
		'date'			=>	'Date',
		'month'			=>	'Month',
		'time'			=>	'Time',
		'week'			=>	'Week',
		'number'		=>	'Number',
		'email'			=>	'Email',
		'url'			=>	'Url',
		'tel'			=>	'Tel',
		'country'		=>	'Country',
		'select'		=>	'Select',
		'radio'			=>	'Radio',
		'file'			=>	'Upload File',
	];
?>
<div class="wrap">
	<div id="imch-settings">
		<div id="imch-setting-tabs">
			<div class="imch-setting-tabs-panel">
				<ul>
				    <li class=""><a href="#checkout-fields"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Checkout Fields', 'checkout-manager' ); ?></a></li>
				    <li class=""><a href="#fields-style"><span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Fields Style', 'checkout-manager' ); ?></a></li>
				  </ul>
			</div>
		  
		  	<div class="imch-setting-tabs-content">
				<div class="imch-setting-heading">
					<h4><?php _e( 'Settings', 'checkout-manager' ); ?></h4>
					<button class="imch-setting-save-button"><?php _e( 'Save Change', 'checkout-manager' ); ?></button>
				</div>
		  		<div id="checkout-fields">
		  			<div class="imch-setting-content">
		  				<div id="woocm-checkout-panel">
							<div class="woocm-checkout-panel-tabs">
								<div class="woocm-checkout-panel-tabs-nav">
									<ul>
										<li><a href="#woocm-billing" class="woocm-tab-btn active" data-tab="woocm-billing"><?php _e( 'Billing', 'woocheckout-manager' ); ?></a></li>
										<li><a href="#woocm-shipping" class="woocm-tab-btn" data-tab="woocm-shipping"><?php _e( 'Shipping', 'woocheckout-manager' ); ?></a></li>
										<li><a href="#woocm-order" class="woocm-tab-btn" data-tab="woocm-order"><?php _e( 'Order', 'woocheckout-manager' ); ?></a></li>
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

													$html = "";
													$html .= "<li class='woocm-list-item'>
														<h4 data-name='woocm-{$name}'>
															<span class='dashicons dashicons-menu-alt2'></span>
															<span>{$field['label']}</span>
														</h4>

														<div class='woocm-action-panel {$disabled}'>
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
																<input id='{$required_text}' type='checkbox' name='woocm_fields[{$type}][{$name}][required]' {$required}>
															</p>
															<p class='woocm-item-field-class'>
																<label class='woocm-item-label' for='cls_{$field['id']}'>{$class_name_text}</label>
																<select id='cls_{$field['id']}' name='woocm_fields[{$type}][{$name}][class]'>
																	{$class_options}
																</select>
															</p>
														</div>
													</li>";
													echo $html;
												endforeach; 
												?>

											</ul>

											<div class="woocm-toggle-button-wrap">
												<?php 
												printf( '<button class="woocm-modal-toggle" data-type="%s" title="%s">%s</button>',
													$type,
													__( 'Add ' . ucwords( $type ) . ' Field' , 'wc-one-pager' ),
													'<span class="dashicons dashicons-plus"></span>'
												);
												?>
											</div>
											<div class="woocm-modal">
												<div class="woocm-modal-overlay woocm-modal-toggle"></div>
												<div class="woocm-modal-wrapper woocm-modal-transition">
													<div class="woocm-modal-header">
														<button class="woocm-modal-close woocm-modal-toggle"><span class="dashicons dashicons-no-alt"></span></button>
														<h2 class="woocm-modal-heading">This is a modal</h2>
													</div>

													<div class="woocm-modal-body">
														<?php 
														$html = "";
														$html .= "<div class='woocm-modal-content'>
															<div id='woocm-clone-{$type}-item' class='woocm-clone-item-panel'>
																<li class='woocm-list-item ui-sortable-handle'>
																	<h4 class='woocm-item-heading' data-name='woocm-{$type}_%%%'>New Field</h4>

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
																			<label for=''><?php echo $required_text; ?></label>
																			<input id='' type='checkbox' %attrname%='woocm_fields[{$type}][{$type}_%%%][required]' {$required}>
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
															<button class='woocm-modal-toggle woocm-clone-item' data-type='{$type}'>Insert Field</button>
														</div>";
														echo $html;
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
				<div id="fields-style">
					Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Quia iure cumque quam eum consectetur vero animi provident numquam, ratione temporibus. Eaque accusantium, inventore architecto. Vel nesciunt, facere ab iure nobis.
				</div>
				<div class="imch-setting-footer">
					<button class="imch-setting-save-button"><?php _e( 'Save Change', 'checkout-manager' ); ?></button>
				</div>
		  	</div>
		</div>
	</div>
</div>