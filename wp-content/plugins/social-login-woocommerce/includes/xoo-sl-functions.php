<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Internationalization
if( !function_exists( 'xoo_sl_load_plugin_textdomain' ) ):
		function xoo_sl_load_plugin_textdomain() {
			$domain = 'social-login-woocommerce';
			$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR . '/'.$domain.'-' . $locale . '.mo' ); //wp-content languages
			load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' ); // Plugin Languages
		}   
        add_action('plugins_loaded','xoo_sl_load_plugin_textdomain',100);
endif;


//Get tempalte
if( !function_exists( 'xoo_get_template' ) ){
	function xoo_get_template ( $template_name, $path = '', $args = array(), $return = false ) {

	    $located = xoo_locate_template ( $template_name, $path );

	    if ( $args && is_array ( $args ) ) {
	        extract ( $args );
	    }

	    if ( $return ) {
	        ob_start ();
	    }

	    // include file located
	    if ( file_exists ( $located ) ) {
	        include ( $located );
	    }

	    if ( $return ) {
	        return ob_get_clean ();
	    }
	}
}


//Locate template
if( !function_exists( 'xoo_locate_template' ) ){
	function xoo_locate_template ( $template_name, $template_path ) {

	    // Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				'templates/' . $template_name,
				$template_name,
			)
		);

		//Check woocommerce directory for older version
		if( !$template && class_exists( 'woocommerce' ) ){
			if( file_exists( WC()->plugin_path() . '/templates/' . $template_name ) ){
				$template = WC()->plugin_path() . '/templates/' . $template_name;
			}
		}

	    if ( ! $template ) {
	        $template = trailingslashit( $template_path ) . $template_name;
	    }

	    return $template;
	}
}



function xoo_sl_add_notice( $message, $notice_type = 'success' ){

	if( $notice_type === "success" ){
		$notice_class 	= 'xoo-sl-notice-success';
		$icon_class 	= 'xoo-sl-icon-check_circle';
	}
	else{
		$notice_class 	= 'xoo-sl-notice-error';
		$icon_class 	= 'xoo-sl-icon-error';
	}

	$html  = '<div class="xoo-sl-notice '.$notice_class.'">';
	$html .= '<span class="xoo-sl-notice-icon '.$icon_class.'"></span>';
	$html .= '<span class="xoo-sl-notice-text">'.$message.'</span>';
	$html .= '</div>';

	return apply_filters( 'xoo_sl_notice_html', $html, $message, $notice_type );
}


?>