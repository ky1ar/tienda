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
		'title' 		=> 'APP ID',
		'id' 			=> 'gl-appid',
		'section_id' 	=> 'gl',
		'default' 		=> '',
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'APP Secret',
		'id' 			=> 'gl-appSecret',
		'section_id' 	=> 'gl',
		'default' 		=> '',
	),


	array(
		'callback' 		=> 'checkbox',
		'title' 		=> 'Show name & picture',
		'id' 			=> 'btn-name',
		'section_id' 	=> 'btn',
		'default' 		=> 'yes',
	),

	array(
		'callback' 		=> 'select',
		'title' 		=> 'Size',
		'id' 			=> 'btn-size',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'small' 		=> 'Small',
				'medium' 		=> 'Medium',
				'large' 		=> 'Large'
			)
		),
		'default' 		=> 'large'
	),


	array(
		'callback' 		=> 'number',
		'title' 		=> 'Width',
		'id' 			=> 'btn-width',
		'section_id' 	=> 'btn',
		'default' 		=> '240',
		'desc' 			=> "Possible values based on button size. ( Small: 200 , Medium: 200-320, Large: 240-400 )"
	),

	array(
		'callback' 		=> 'select',
		'title' 		=> 'Layout',
		'id' 			=> 'btn-layout',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'default' 		=> 'Rectangular',
				'rounded' 		=> 'Rounded',
			)
		),
		'default' 		=> 'rounded'
	),



	array(
		'callback' 		=> 'select',
		'title' 		=> 'Text',
		'id' 			=> 'btn-text',
		'section_id' 	=> 'btn',
		'args'			=> array(
			'options' => array(
				'login_with' 	=> 'Login With',
				'continue_with' => 'Continue With',

			)
		),
		'default' 		=> 'login_with'
	),

	array(
		'callback' 		=> 'text',
		'title' 		=> 'Locale',
		'id' 			=> 'btn-locale',
		'section_id' 	=> 'btn',
		'default' 		=> get_locale(),
		'desc' 			=> "For eg: fr_FR."
	),


);

return apply_filters( 'xoo_sl_admin_settings', $settings, 'facebook' );