<?php

$sections = array(

	/* General TAB Sections */
	array(
		'title' => 'Main',
		'id' 	=> 'gl_main',
		'tab' 	=> 'general',
	),


	array(
		'title' => 'Texts',
		'id' 	=> 'gl_texts',
		'tab' 	=> 'general',
		'desc' 	=> 'Leave text empty to remove element'
	),


	array(
		'title' => 'General',
		'id' 	=> 'gl',
		'tab' 	=> 'google',
		'desc' 	=> '<a href="https://docs.xootix.com/easy-login-for-woocommerce/#setup-social" target="_blank">Documentation</a>'
	),


	array(
		'title' => 'Button',
		'id' 	=> 'btn',
		'tab' 	=> 'google',
		'desc' 	=> '<a href="https://developers.google.com/identity/gsi/web/tools/configurator" target="_blank">Button Generator</a>'
	),


	array(
		'title' => 'General',
		'id' 	=> 'gl',
		'tab' 	=> 'facebook',
		'desc' 	=> '<a href="https://docs.xootix.com/easy-login-for-woocommerce/#setup-social" target="_blank">Documentation</a>'
	),


	array(
		'title' => 'Button',
		'id' 	=> 'btn',
		'tab' 	=> 'facebook',
		'desc' 	=> '<a href="https://developers.facebook.com/docs/facebook-login/web/login-button" target="_blank">Button Generator</a>'
	),


);

return apply_filters( 'xoo_sl_admin_settings_sections', $sections );