<?php

$settings = array(


	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Enable',
		'id' 			=> 'gl-enable',
		'section_id' 	=> 'gl',
		'default' 		=> 'yes',
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Client ID',
		'id' 			=> 'gl-clientid',
		'section_id' 	=> 'gl',
		'default' 		=> '',
	),


	/*array(
		'callback' 		=> 'select',
		'title' 		=> 'UI Type',
		'id' 			=> 'gl-ui',
		'section_id' 	=> 'gl',
		'args'			=> array(
			'options' => array(
				'popup' 		=> 'Popup',
				'redirect' 		=> 'Same Window',
			)
		),
		'default' 		=> 'popup',
		'desc' 			=> 'Google login window should open in a popup or in the same window.'
	),*/


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Type',
		'id' 			=> 'btn-type',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'standard' 		=> 'Standard ( Icon with text )',
				'icon' 			=> 'Icon',
			)
		),
		'default' 		=> 'standard'
	),

	array(
		'callback' 		=> 'select',
		'title' 		=> 'Theme',
		'id' 			=> 'btn-theme',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'outline' 		=> 'White',
				'filled_blue' 	=> 'Blue',
				'filled_black' 	=> 'Black',

			)
		),
		'default' 		=> 'black'
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Size',
		'id' 			=> 'btn-size',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'large' 		=> 'Large',
				'medium' 		=> 'Medium',
				'small' 		=> 'Small',

			)
		),
		'default' 		=> 'large'
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Shape',
		'id' 			=> 'btn-shape',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'rectangular' 	=> 'Rectangular',
				'pill' 			=> 'Pill',
				'circle' 		=> 'Circle',
				'square' 		=> 'Square',

			)
		),
		'default' 		=> 'pill'
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Logo Alignment',
		'id' 			=> 'btn-logoalign',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'left' 			=> 'Left',
				'center' 		=> 'Center',
			)
		),
		'default' 		=> 'left'
	),


	array(
		'callback' 		=> 'select',
		'title' 		=> 'Text',
		'id' 			=> 'btn-text',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'signin_with' 	=> 'Sign in with Google',
				'signup_with' 	=> 'Sign up with Google',
				'continue_with' => 'Continue with Google',
				'signin' 		=> 'Sign in',
			)
		),
		'default' 		=> 'signin_with'
	),


	array(
		'callback' 		=> 'text',
		'title' 		=> 'Locale',
		'id' 			=> 'btn-locale',
		'section_id' 	=> 'btn',
		'default' 		=> get_locale(),
		'desc' 			=> "For eg: fr_FR.
		If it's not set, the browser's default locale or the Google session user’s preference is used. Therefore, different users might see different versions of localized buttons, and possibly with different sizes."
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Button Width',
		'id' 			=> 'btn-width',
		'section_id' 	=> 'btn',
		'default' 		=> '',
		'desc' 			=> '(Optional) The minimum button width, in pixels. The maximum width is 400 pixels.'
	),





);

return apply_filters( 'xoo_sl_admin_settings', $settings, 'google' );