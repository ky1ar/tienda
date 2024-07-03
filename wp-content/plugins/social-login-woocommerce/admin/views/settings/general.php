<?php

if ( ! function_exists( 'get_editable_roles' ) ) {
	require_once ABSPATH . 'wp-admin/includes/user.php';
}

$editable_roles = array_reverse( get_editable_roles() );

foreach ( $editable_roles as $role_id => $role_data) {
	$user_roles[$role_id] = translate_user_role( $role_data['name'] );
}

$user_roles = apply_filters( 'xoo_sl_admin_user_roles', $user_roles );

$settings = array(

	/* Main Style */
	array(
		'callback' 		=> 'checkbox_list',
		'title' 		=> 'Show Buttons on page',
		'id' 			=> 'gl-m-show',
		'section_id' 	=> 'gl_main',
		'args'			=> array(
			'options' => array(
				'popup' 		=> 'Popup',
				'myaccount' 	=> 'WC MyAccount',
				'checkout' 		=> 'WC Checkout',
				'wplogin' 		=> 'WP Login'
			)
		),
		'default' 		=> array( 'popup' ,'myaccount', 'checkout', 'wplogin')
	),


	/* Main Style */
	array(
		'callback' 		=> 'checkbox_list',
		'title' 		=> 'Show Buttons on form',
		'id' 			=> 'gl-m-show-form',
		'section_id' 	=> 'gl_main',
		'args'			=> array(
			'options' => array(
				'register' 		=> 'Register',
				'login' 		=> 'Login',
			)
		),
		'default' 		=> array( 'register' ,'login' )
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'User Role',
		'id' 			=> 'gl-userrole',
		'section_id' 	=> 'gl_main',
		'args'			=> array(
			'options' => $user_roles
		),
		'default' 		=> class_exists( 'woocommerce' ) ? 'customer' : 'subscriber'
	),


	array(
		'callback' 		=> 'text',
		'title' 		=> 'Redirect URL',
		'id' 			=> 'gl-red-url',
		'section_id' 	=> 'gl_main',
		'default' 		=> '',
		'desc' 			=> 'Leave empty to redirect on the same page'
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Buttons Layout',
		'id' 			=> 'gl-btn-layout',
		'section_id' 	=> 'gl_main',
		'args'			=> array(
			'options' => array(
				'one_line' 		=> 'One line',
				'new_line' 		=> 'Separate lines',
			)
		),
		'default' 		=> 'new_line'
	),

	


	/** Texts **/
	array(
		'callback' 		=> 'text',
		'title' 		=> 'Heading',
		'id' 			=> 'gl-txt-heading',
		'section_id' 	=> 'gl_texts',
		'default' 		=> 'Or Login Using',
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Success Notice',
		'id' 			=> 'gl-txt-sucess',
		'section_id' 	=> 'gl_texts',
		'default' 		=> 'Login Successful',
	),


	array(
		'callback' 		=> 'text',
		'title' 		=> 'Waiting',
		'id' 			=> 'gl-txt-wait',
		'section_id' 	=> 'gl_texts',
		'default' 		=> 'Please wait. Signing you in...',
	),

);

if( defined( 'XOO_EL' ) ){
	$settings[] = array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Force Register',
		'id' 			=> 'gl-force-reg',
		'section_id' 	=> 'gl_main',
		'default' 		=> 'no',
		'desc' 			=> 'If enabled, user will be forced to fill form fields'
	);
}

return apply_filters( 'xoo_sl_admin_settings', $settings, 'general' );