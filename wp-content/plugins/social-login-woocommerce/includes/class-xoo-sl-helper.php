<?php

class Xoo_Sl_Helper extends Xoo_Helper{

	protected static $_instance = null;

	public static function get_instance( $slug, $path ){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $slug, $path );
		}
		return self::$_instance;
	}

	public function get_general_option( $subkey = '' ){
		return $this->get_option( 'xoo-sl-gl-options', $subkey );
	}

	public function get_google_option( $subkey = '' ){
		return $this->get_option( 'xoo-sl-goo-options', $subkey );
	}

	public function get_fb_option( $subkey = '' ){
		return $this->get_option( 'xoo-sl-fb-options', $subkey );
	}


}

function xoo_sl_helper(){
	return Xoo_Sl_Helper::get_instance( 'social-login-woocommerce', XOO_SL_PATH );
}
xoo_sl_helper();

?>