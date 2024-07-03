<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Xoo_Sl_Frontend{

	protected static $_instance = null;

	public $settings = array();

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function __construct(){

		$this->settings 	= xoo_sl_helper()->get_general_option();
		$this->gooSettings 	= xoo_sl_helper()->get_google_option();
		$this->fbSettings 	= xoo_sl_helper()->get_fb_option();

		$this->hooks();
		
	}

	public function hooks(){
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		add_action( 'wp_footer', array( $this, 'notice_markup' ) );
		add_action( 'login_footer', array( $this, 'notice_markup' ) );

		add_action( 'woocommerce_login_form_end', array( $this, 'social_buttons_on_wc_login' ) );
		add_action( 'woocommerce_register_form_end', array( $this, 'social_buttons_on_wc_register' ) );

		add_action( 'login_form', array( $this, 'social_buttons_on_wp_login' ) );

	}

	//Enqueue stylesheets
	public function enqueue_styles(){
		wp_enqueue_style( 'xoo-sl-style', XOO_SL_URL.'/assets/css/xoo-sl-style.css', array(), XOO_SL_VERSION );
		ob_start();
		xoo_sl_helper()->get_template( 'inline-style.php' );
		wp_add_inline_style( 'xoo-sl-style', ob_get_clean() );
	}

	//Enqueue javascript
	public function enqueue_scripts(){

		if( $this->fbSettings['gl-enable'] === "yes" ){
			$locale = $this->fbSettings['btn-locale'] ? esc_html( $this->fbSettings['btn-locale'] ) : get_locale();
			wp_enqueue_script( 'xoo-sl-fb-sdk', 'https://connect.facebook.net/'.$locale.'/sdk.js' ); //Facebook SDK
		}

		if( $this->gooSettings['gl-enable'] === "yes" ){
			wp_enqueue_script( 'xoo-sl-google-sdk', 'https://accounts.google.com/gsi/client' );
		}
		
		wp_enqueue_script( 'xoo-sl-js', XOO_SL_URL.'/assets/js/xoo-sl-js.js', array( 'jquery' ), XOO_SL_VERSION, true );

		if( class_exists( 'woocommmerce' ) && is_checkout() ){
			$redirect_to = $_SERVER['REQUEST_URI'];
		}
		elseif( !empty( $this->settings['gl-red-url']) ){
			$redirect_to = $this->settings['gl-red-url'];
		}
		elseif( $GLOBALS['pagenow'] === 'wp-login.php' ){
			$redirect_to = get_site_url();
		}
		else{
			$redirect_to = $_SERVER['REQUEST_URI'];
		}

		wp_localize_script( 'xoo-sl-js', 'xoo_sl_localize', array(
			'adminurl' 			=> admin_url().'admin-ajax.php',
			'redirect_to'		=> $redirect_to,
			'google' 			=> array(
				'enable' 	=> $this->gooSettings['gl-enable'],
				'client_id' => $this->gooSettings['gl-clientid'],
				'button' 	=> array(
					'type' 				=> $this->gooSettings['btn-type'],
					'theme' 			=> $this->gooSettings['btn-theme'],
					'size' 				=> $this->gooSettings['btn-size'],
					'text' 				=> $this->gooSettings['btn-text'],
					'shape' 			=> $this->gooSettings['btn-shape'],
					'logo_alignment' 	=> $this->gooSettings['btn-logoalign'],
					'width' 			=> $this->gooSettings['btn-width'],
					'locale' 			=> $this->gooSettings['btn-locale'],
				)
			),
			'facebook' 		=> array(
				'enable' 	=> $this->fbSettings['gl-enable'],
				'app_id' 	=> $this->fbSettings['gl-appid'],
			),
			'fillFieldsNotice' 	=> defined( 'XOO_EL' ) ? xoo_el_add_notice( 'success', __( 'Please fill the below fields', 'social-login-woocommerce' ) ) : ''
			//'force_register' 	=> $this->settings['gl-force-reg']
		));
	}

	//Logging in notice
	public function notice_markup(){
		?>
		<div class="xoo-sl-notice-container"></div>
		<?php
	}

	public function social_buttons_on_wc_login(){

		if( !in_array( 'login', $this->settings['gl-m-show-form'] ) ) return;

		if( ( is_checkout() && in_array( 'checkout', $this->settings['gl-m-show'] ) ) || ( in_array( 'myaccount', $this->settings['gl-m-show'] ) ) ){
			echo xoo_sl_buttons()->get_html();
		}
	}


	public function social_buttons_on_wc_register(){

		if( !in_array( 'register', $this->settings['gl-m-show-form'] ) ) return;

		if( ( is_checkout() && in_array( 'checkout', $this->settings['gl-m-show'] ) ) || ( in_array( 'myaccount', $this->settings['gl-m-show'] ) ) ){
			echo xoo_sl_buttons()->get_html();
		}
	}

	public function social_buttons_on_wp_login(){
		if( in_array( 'wplogin', $this->settings['gl-m-show'] ) ){
			echo xoo_sl_buttons()->get_html();
		}
	}
}


function xoo_sl_frontend(){
	return Xoo_Sl_Frontend::get_instance();
}

xoo_sl_frontend();
?>