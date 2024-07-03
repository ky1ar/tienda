<?php
/*
Plugin Name: WooCommerce - Pay-me
Plugin URI: https://www.alignet.com/
Description: La forma segura de pagar en linea
Version: 4.1.1
Author: Alignet
Author URI: https://www.alignet.com/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
add_action('plugins_loaded', 'woocommerce_payme_init', 0);
define('PAYME_ASSETS', WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/assets');

function woocommerce_payme_init()
	{
	if (!class_exists('WC_Payment_Gateway')) return;
	if (isset($_GET['msg']) && !empty($_GET['msg']))
		{
		add_action('the_content', 'showpaymeMessages');
		}

	function showpaymeMessages($content)
		{
		return '<div class="' . htmlentities($_GET['type']) . '">' . htmlentities(urldecode($_GET['msg'])) . '</div>' . $content;
		}

	/**
	 *
	 *
	 * @access public
	 * @param
	 * @return
	 */
	class WC_payme extends WC_Payment_Gateway

		{
		public

		function __construct()
			{
			global $woocommerce;
			$this->load_plugin_textdomain();

			// add_action('init', array($this, 'load_plugin_textdomain'));

			$this->id = 'paymecheckout';
			$this->hooks();
			$this->icon_default = $this->get_country_icon(false);
			$this->method_title = __('Pay-me - Checkout', 'payme-checkout-woocommerce');
			$this->method_description = __("Pay-me es el sistema integral de pagos en linea ofrecido por ALIGNET. Provee una plataforma de pagos para los comercios online. Pay-me interacion con los componentes principales, los cuales aseguran el funcionamiento de la plataforma.", 'payme-checkout-woocommerce');
			$this->has_fields = false;
			$this->init_form_fields();
			$this->init_settings();
			$this->language = get_bloginfo('language');
			$this->urltpv = "https://test2.alignetsac.com/VPOS2/faces/pages/startPayme.xhtml";
			$this->env = $this->settings['ALIGNET_URLTPV'];
			$this->testmode = "no";
			$this->merchant_id = "";
			$this->account_id = ($this->testmode == 'yes') ? $this->testaccount_id : "";
			$this->apikey = ($this->testmode == 'yes') ? $this->testapikey : "";
			$this->redirect_page_id = "default";
			$this->endpoint = "";
			$this->payme_language = "ES";
			$this->taxes = 0;
			$this->tax_return_base = 0;
			$this->currency = ($this->is_valid_currency()) ? get_woocommerce_currency() : 'USD';
			$this->textactive = 0;
			$this->form_method = 'POST';
			$this->idacquirer = $this->settings['ALIGNET_IDACQUIRER'];
			$this->idcommerce = $this->settings['ALIGNET_IDCOMMERCE'];
			$this->key = $this->settings['ALIGNET_KEY'];
			$this->debug = $this->settings['ALIGNET_DEBUG'];
			$this->redir = $this->settings['ALIGNET_URLRPTA'];
			$this->idWallet = $this->settings['ALIGNET_IDENTCOMMERCE_WALLET'];
			$this->keywallet = $this->settings['ALIGNET_KEYWALLET'];
			$this->testmerchant_id = '508029';
			$this->testaccount_id = '512321';
			$this->testapikey = '4Vj8eK4rloUd272L48hsrarnUA';
			$this->debug = "no";
			$this->esquema = $this->settings['ALIGNET_ESQUEMA'];
			$this->tipomodal = $this->settings['ALIGNET_MODALTIPO'];
			$this->wsdl = "";
			$this->modalVPOS2 = "";
			$this->wsdomain = "";

			// $this->show_methods		= $this->settings['show_methods'];
			// $this->icon_checkout 	= $this->settings['icon_checkout'];

			$ALIGNET_IDACQUIRER = $this->settings['ALIGNET_IDACQUIRER'];
			if ($ALIGNET_IDACQUIRER == 29 || $ALIGNET_IDACQUIRER == 144 || $ALIGNET_IDACQUIRER == 84 || $ALIGNET_IDACQUIRER == 10)
				{
				$logourl = WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/assets/img/banner_payme_peru.png';
				}
			  else
				{
				$logourl = WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/assets/img/banner_payme_peru.png';
				}

			$this->title = "Pay-me  Checkout";
			$this->description = '<img style="float:none !important;    max-height: none;" src="' . $logourl . '">';
			$this->currency = ($this->is_valid_currency()) ? get_woocommerce_currency() : 'USD';
			$this->textactive = 0;
			$this->liveurl = 'https://gateway.payme.com/ppp-web-gateway/';
			$this->testurl = 'https://test2.alignetsac.com/VPOS2/faces/pages/startPayme.xhtml';
			$this->setting['ALIGNET_URLRPTA'] = get_site_url() . '/wp-content/plugins/woocommerce-payme-gateway/response.php';
			if ($this->testmode == "yes") $this->debug = "yes";
			add_filter('woocommerce_currencies', 'add_all_currency_payme');
			add_filter('woocommerce_currency_symbol', 'add_all_symbol_payme', 10, 2);
			$this->msg['message'] = "";
			$this->msg['class'] = "";

			// Logs

			if (version_compare(WOOCOMMERCE_VERSION, '2.1', '>='))
				{
				$this->log = new WC_Logger();
				}
			  else
				{
				$this->log = $woocommerce->logger();
				}

			add_action('payme_init', array(
				$this,
				'payme_successful_request'
			));
			add_action('woocommerce_receipt_paymecheckout', array(
				$this,
				'receipt_page'
			));

			// update for woocommerce >2.0

			add_action('woocommerce_api_' . strtolower(get_class($this)) , array(
				$this,
				'check_payme_response'
			));
			if (version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>='))
				{
				/* 2.0.0 */
				add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(&$this,
					'process_admin_options'
				));
				}
			  else
				{
				/* 1.6.6 */
				add_action('woocommerce_update_options_payment_gateways', array(&$this,
					'process_admin_options'
				));
				}
			}

		function hooks() {
			add_action( 'woocommerce_admin_order_data_after_order_details', array( $this, 'request_meta_box' ) );
			add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'response_meta_box' ) );

		}

		public function request_meta_box( WC_Order $order ) {
			global $wpdb;

			$results = $wpdb->get_results( "SELECT purchaseOperationNumber,
								purchaseAmount,
								purchaseCurrencyCode,
								language,
								billingFirstName,
								billingLastName,
								billingEmail,
								billingAddress,
								billingZip,
								billingCity,
								billingState,
								billingCountry,
								billingPhone,
								shippingFirstName,
								shippingLastName,
								shippingEmail,
								shippingAddress,
								shippingZip,
								shippingCity,
								shippingState,
								shippingCountry,
								shippingPhone,
								programmingLanguage,
								userCommerce,
								userCodePayme,
								descriptionProducts,
								reserved1,
								reserved2,
								reserved3,
								reserved4,
								reserved5

							FROM ". $wpdb->prefix ."payme_request WHERE purchaseOperationNumber = $order->id LIMIT 1"); 
			echo '<div style="padding-bottom: 200px;"></div><h3>
							Request Pay-me							
							
						</h3>
						<pre>
						';
				if ($results) {
					echo "<br>";
					foreach ($results[0] as $key => $value) {


						echo $key."=>".$value."<br>";
					}
					
				}
			
			echo '</pre>';
		}



		public function response_meta_box( WC_Order $order ) {
			global $wpdb;

			$results = $wpdb->get_results( "SELECT id_order,
					    authorizationResult,
					    authorizationCode,
					    errorCode,
					    errorMessage,
					    bin,
					    brand,
					    paymentReferenceCode,
					    purchaseOperationNumber,
					    purchaseAmount,
					    purchaseCurrencyCode,
					    purchaseVerification,
					    plan,
					    cuota,
					    montoAproxCuota,
					    resultadoOperacion,
					    paymethod,
					    fechaHora,
					    reserved1,
					    reserved2,
					    reserved3,
					    reserved4,
					    reserved5,
					    numeroCip

							FROM ". $wpdb->prefix ."payme_response WHERE purchaseOperationNumber = $order->id LIMIT 1"); 
			echo '<p></p><h3>
							Response Pay-me							
							
						</h3>
						<pre>
						';
				if ($results) {
					echo "<br>";
					foreach ($results[0] as $key => $value) {


						echo $key."=>".$value."<br>";
					}
					
				}
			
			echo '</pre>';
		}


		public

		function load_plugin_textdomain()
			{
			load_plugin_textdomain('payme-checkout-woocommerce', false, dirname(plugin_basename(__FILE__)) . "/languages");
			}

		/**
		 * Show payment metods by country
		 */
		public

		function get_country_icon($default = true)
			{
			$country = '';
			if (!$default) $country = WC()->countries->get_base_country();
			$icon = PAYME_ASSETS . '/img/logo.png';
			return $icon;
			}

		/**
		 * Check if Gateway can be display
		 *
		 * @access public
		 * @return void
		 */
		function is_available()
			{
			global $woocommerce;
			if ($this->enabled == "yes"):

				// if ( !$this->is_valid_currency()) return false;

				if ($woocommerce->version < '1.5.8') return false;

				// if ($this->testmode!='yes'&&(!$this->merchant_id || !$this->account_id || !$this->apikey )) return false;

				return true;
			endif;
			return false;
			}

		/**
		 * Settings Options
		 *
		 * @access public
		 * @return void
		 */
		public

		function init_form_fields()
			{
			$this->form_fields = array(
				'enabled' => array(
					'title' => __('Enable/Disable', 'payme-checkout-woocommerce') ,
					'label' => __('Enable Payme', 'payme-checkout-woocommerce') ,
					'type' => 'checkbox',
					'description' => __('Activar el modulo de pagos Payme') ,
					'default' => 'yes',
					'desc_tip' => true,
				) ,

				// El combobox del ambiente

				'ALIGNET_URLTPV' => array(
					'title' => __('Ambiente', 'payme-checkout-woocommerce') ,
					'label' => __('Selecciona el tipo de entorno de la pasarela.', 'payme-checkout-woocommerce') ,
					'type' => 'select',
					'class' => 'wc-enhanced-select',
					'desc_tip' => __('Selecciona el tipo de entorno de la pasarela.', 'payme-checkout-woocommerce') ,
					'options' => array(
						'Testing' => __('Testing ', 'payme-checkout-woocommerce') ,
						'Integracion' => __('Integracion ', 'payme-checkout-woocommerce') ,
						'Produccion' => __('Producción', 'payme-checkout-woocommerce')
					)
				) ,
				'ALIGNET_ESQUEMA' => array(
					'title' => __('Esquema de Integración', 'payme-checkout-woocommerce') ,
					'label' => __('Esquema de Integración.', 'payme-checkout-woocommerce') ,
					'type' => 'select',
					'class' => 'wc-enhanced-select',
					'id' => "esquema",
					'options' => array(
						'Modal' => __('Modal ', 'payme-checkout-woocommerce') ,
						'Redirect' => __('Redirect', 'payme-checkout-woocommerce')
					)
				) ,
				'ALIGNET_MODALTIPO' => array(
					'title' => __('Diseño de Modal', 'payme-checkout-woocommerce') ,
					'label' => __('Diseño de Modal.', 'payme-checkout-woocommerce') ,
					'type' => 'select',
					'class' => 'wc-enhanced-select',
					'id' => "esquema",
					'options' => array(
						'1' => __('Etiqueta ', 'payme-checkout-woocommerce') ,
						'2' => __('Circulo', 'payme-checkout-woocommerce') ,
						'3' => __('Rectangulo', 'payme-checkout-woocommerce')
					)
				) ,
				'ALIGNET_DEBUG' => array(
					'title' => __('Activar Depuración', 'payme-checkout-woocommerce') ,
					'label' => __('Modo Depuración', 'payme-checkout-woocommerce') ,
					'type' => 'checkbox',
					'description' => __('Activar esta funcionalidad para realizar pruebas. Cuando se activa, se muestran los valores enviados a la pasarela de pagos.', 'payme-checkout-woocommerce') ,
					'default' => 'no'
				) ,
				'ALIGNET_URLRPTA' => array(
					'title' => __('URL de Respuesta:', 'payme-checkout-woocommerce') ,
					'type' => 'url',
					'desc_tip' => __('URL de respuesta para el proceso de pago.', 'payme-checkout-woocommerce') ,
					'default' => __(get_site_url() . '/wp-content/plugins/woocommerce-payme-gateway/response.php', 'payme-checkout-woocommerce'),
					'css' => "width:600px;cursor-events: none;",
					'class'=> "urlrpt"
				) ,

				// datos configuracion de wallet

				'FIELDSET_WALLET' => array(
					'title' => __('CONFIGURACION - MONEDA LOCAL', 'payme-checkout-woocommerce') ,
					'type' => 'title',
					'description' => '',
					'default' => ''
				) ,
				'ALIGNET_IDACQUIRER' => array(
					'title' => __('ID Adquiriente :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_IDCOMMERCE' => array(
					'title' => __('ID Comercio:', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_KEY' => array(
					'title' => __('Clave V-POS2 :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_IDENTCOMMERCE_WALLET' => array(
					'title' => __('ID Wallet :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_KEYWALLET' => array(
					'title' => __('Clave Wallet :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,

				// datos configuracion de wallet

				'FIELDSET_DOLARES' => array(
					'title' => __('CONFIGURACION - MONEDA DOLARES', 'payme-checkout-woocommerce') ,
					'type' => 'title',
					'description' => '',
					'default' => ''
				) ,
				'ALIGNET_IDACQUIRER_DOLARES' => array(
					'title' => __('ID Adquiriente :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_IDCOMMERCE_DOLARES' => array(
					'title' => __('ID Comercio:', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_KEY_DOLARES' => array(
					'title' => __('Clave V-POS2 :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_IDENTCOMMERCE_WALLET_DOLARES' => array(
					'title' => __('ID Wallet :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
				'ALIGNET_KEYWALLET_DOLARES' => array(
					'title' => __('Clave Wallet :', 'payme-checkout-woocommerce') ,
					'type' => 'text',
					'desc_tip' => __('Parametro proporcionado por Alignet.', 'payme-checkout-woocommerce') ,
					'default' => __('', 'payme-checkout-woocommerce')
				) ,
			);
			}

		/**
		 * Generate Admin Panel Options
		 *
		 * @access public
		 * @return string
		 *
		 */
		public

		function admin_options()
			{
			echo '<img src="' . $this->get_country_icon() . '" alt="PAYME" width="80"><h3>' . __('Payme', 'payme-checkout-woocommerce') . '</h3>';
			echo '<p>' . __('Pay-me es el sistema integral de pagos en linea ofrecido por ALIGNET. Provee una plataforma de pagos para los comercios online. Pay-me interactua con los componentes principales, los cuales aseguran el funcionamiento de la plataforma.', 'payme-checkout-woocommerce') . '</p>';
			echo '<table class="form-table">';

			// Generate the HTML For the settings form.

			$this->generate_settings_html();
			echo "</table>

			<script>
				document.getElementById('woocommerce_paymecheckout_ALIGNET_URLRPTA').disabled = true;
				var base_url = '".get_site_url() . '/wp-content/plugins/woocommerce-payme-gateway/response.php'."';
				document.getElementById('woocommerce_paymecheckout_ALIGNET_URLRPTA').value = base_url;
				

				</script>
			";
			}

		/**
		 * Generate the payme Payment Fields
		 *
		 * @access public
		 * @return string
		 */
		function payment_fields()
			{
			if ($this->description) echo wpautop(wptexturize($this->description));
			}

		/**
		 * Generate the payme Form for checkout
		 *
		 * @access public
		 * @param mixed $order
		 * @return string
		 *
		 */





		function receipt_page($order)
			{
			echo '<p>' . __('Usted está comprando vía Pay-me Checkout') . '</p>';
			echo $this->generate_payme_form($order);
			}

		/**
		 * Generate  POST arguments
		 *
		 * @access public
		 * @param mixed $order_id
		 * @return string
		 *
		 */
		function get_payme_args($order_id)
			{
			global $woocommerce;
			$order = new WC_Order($order_id);
			$billingData = $order->get_address();

			$txnid = $order->order_key . '-' . time();
			$redirect_url = ($this->redirect_page_id == "" || $this->redirect_page_id == 0) ? get_site_url() . "/" : get_permalink($this->redirect_page_id);

			// For wooCoomerce 2.0

			$redirect_url = add_query_arg('wc-api', get_class($this) , $redirect_url);
			$redirect_url = add_query_arg('order_id', $order_id, $redirect_url);
			$redirect_url = add_query_arg('', $this->endpoint, $redirect_url);

	
   			$items = $woocommerce->cart->get_cart();
   			$productinfo = [];
   		
	        foreach($items as $item => $values) { 
	            $_product =  wc_get_product( $values['data']->get_id()); 
	            $productinfo[] = $_product->get_title();
	        }

			$str = "12547854";
			$hash = strtolower(md5($str));
			if ($this->idacquirer == 144 || $this->idacquirer == 29)
				{
				$long = 5;
				}
			elseif ($this->idacquirer == 84 || $this->idacquirer == 10 || $this->idacquirer == 123 || $this->idacquirer == 23 || $this->idacquirer == 205 || $this->idacquirer == 35)
				{
				$long = 9;
				}

			$purchaseOperationNumber = str_pad($order_id, $long, "0", STR_PAD_LEFT);
			$purchaseOperationNumber = $purchaseOperationNumber;
			$purchaseAmount = floatval(str_replace('.', '', number_format($order->order_total, 2, '.', '')));
			$purchaseAmountFormat = number_format(floatval($order->order_total) , 2, '.', '');
			$commerceAssociated = '';
			if ($this->idacquirer == 144 || $this->idacquirer == 29)
				{
				switch ($this->currency)
					{
				case "PEN":
					$commerceAssociated = 'MALL ALIGNET-PSP SOLES';
					break;

				case "USD":
					$commerceAssociated = 'MALL ALIGNET-PSP DOLARES';
					break;

				case "068":
					$commerceAssociated = '';
					break;

				default:
					$commerceAssociated = 'MALL ALIGNET-PSP';
					break;
					}
				}

			// Asignar el  iso equivalente a la moneda ctual

			$isoCurrency = 0;
			switch ($this->currency)
				{
			case 'PEN':
				$isoCurrency = '604';
				break;

			case 'USD':
				$isoCurrency = '840';
				break;

			case 'BOB':
				$isoCurrency = '068';
				break;

			case 'CRC':
				$isoCurrency = '188';
				break;
				}

			



			if ($isoCurrency == '840') {
		          

		            $this->idCommerce = $this->settings['ALIGNET_IDCOMMERCE_DOLARES'];
		            $this->idacquirer = $this->settings['ALIGNET_IDACQUIRER_DOLARES'];
		            $this->keywallet = $this->settings['ALIGNET_KEYWALLET_DOLARES'];
		            $this->idWallet = $this->settings['ALIGNET_IDENTCOMMERCE_WALLET_DOLARES'];
		            $this->key = $this->settings['ALIGNET_KEY_DOLARES'];
            // $this->currency_iso = 840;
		        }
		        else
		        {
		           
		              $this->idCommerce = $this->settings['ALIGNET_IDCOMMERCE'];
		            $this->idacquirer = $this->settings['ALIGNET_IDACQUIRER'];
		            $this->keywallet = $this->settings['ALIGNET_KEYWALLET'];
		            $this->idWallet = $this->settings['ALIGNET_IDENTCOMMERCE_WALLET'];
		            $this->key = $this->settings['ALIGNET_KEY'];
		        }

		
			$concatRegister = $this->idWallet.(string)$order->get_user_id().$billingData['email'].$this->keywallet;
			$registerVerification = (phpversion() >= 5.3) ? openssl_digest($concatRegister, 'sha512') : hash('sha512', $concatRegister);


				$params = array(
				'idEntCommerce' => $this->idWallet,
				'codCardHolderCommerce' => (string)$order->get_user_id(),
				'names' => $billingData['first_name'],
				'lastNames' => $billingData['last_name'],
				'mail' => $billingData['email'],
				'reserved1' => $_reserved1,
				'reserved2' => $_reserved2,
				'reserved3' => $_reserved3,
				'registerVerification' => $registerVerification
			);


			$_reserved1 = '';
			$_reserved2 = '';
			$_reserved3 = '';
			$_reserved4 = '';
			$_reserved5 = '';
			$_reserved6 = '';
			$_reserved7 = '';
			$_reserved8 = '';
			$_reserved9 = '';
			$_reserved10 = '';
			$_reserved11 = '';
			$_reserved12 = '';


			if ($this->esquema == 'Modal')
				{
				switch ($this->env)
					{
				case 'Testing':
					$this->wsdomain = 'https://test2.alignetsac.com';
					$this->wsdl = $this->wsdomain . '/WALLETWS/services/WalletCommerce?wsdl';
					$this->modalVPOS2 = "javascript:AlignetVPOS2.openModal('https://test2.alignetsac.com/','" . $this->tipomodal . "')";
					break;

				case 'Integracion':
					$this->wsdomain = 'https://integracion.alignetsac.com';
					$this->wsdl = $this->wsdomain . '/WALLETWS/services/WalletCommerce?wsdl';
					$this->modalVPOS2 = "javascript:AlignetVPOS2.openModal('https://integracion.alignetsac.com/','" . $this->tipomodal . "')";
					break;

				case 'Produccion':
					$this->wsdomain = 'https://vpayment.verifika.com';
					$this->wsdl = "https://www.pay-me.pe/WALLETWS/services/WalletCommerce?wsdl";
					$this->modalVPOS2 = "javascript:AlignetVPOS2.openModal('https://vpayment.verifika.com/','" . $this->tipomodal . "')";
					break;
					}
				}
			  else
				{
				switch ($this->env)
					{
				case 'Testing':
					$this->wsdomain = 'https://test2.alignetsac.com';
					$this->wsdl = $this->wsdomain . '/WALLETWS/services/WalletCommerce?wsdl';
					$this->modalVPOS2 = "https://test2.alignetsac.com/VPOS2/faces/pages/startPayme.xhtml";
					break;

				case 'Integracion':
					$this->wsdomain = 'https://integracion.alignetsac.com';
					$this->wsdl = $this->wsdomain . '/WALLETWS/services/WalletCommerce?wsdl';
					$this->modalVPOS2 = "https://integracion.alignetsac.com/VPOS2/faces/pages/startPayme.xhtml";
					break;

				case 'Produccion':
					$this->wsdomain = 'https://vpayment.verifika.com';
					$this->wsdl = "https://www.pay-me.pe/WALLETWS/services/WalletCommerce?wsdl";
					$this->modalVPOS2 = "https://vpayment.verifika.com/VPOS2/faces/pages/startPayme.xhtml";
					break;
					}
				}


			$codAsoCardHolderWallet = $this->userCodePayme($params);
			$payme_args = array(
					'acquirerId' => $this->idacquirer,
					'idCommerce' =>$this->idCommerce,
					'purchaseOperationNumber' => $purchaseOperationNumber,
					'purchaseAmount' => $purchaseAmount,
					'purchaseCurrencyCode' => $isoCurrency,
					'language' => $this->payme_language,
					'shippingFirstName' => ($billingData['first_name']) ? $billingData['first_name'] : 'Nombre',
					'shippingLastName' => ($billingData['last_name']) ? $billingData['last_name'] : 'Apellido',
					'shippingEmail' =>  ($billingData['email']) ? $billingData['email'] : '-',
					'shippingAddress' => ($order->billing_address_1 . ' ' . $order->billing_address_2) ? $order->billing_address_1 . ' ' . $order->billing_address_2 : '-',
					'shippingZIP' => ($order->shipping_postcode) ? $order->shipping_postcode : '20058',
					'shippingCity' => ($order->shipping_city) ? $order->shipping_city : 'Lima',
					'shippingState' => ($order->shipping_state) ? $order->shipping_state : 'Lima',
					'shippingCountry' => ($order->shipping_country) ? $order->shipping_country : 'Lima',
					'billingFirstName' => ($billingData['first_name']) ? $billingData['first_name'] : 'Nombre',
					'billingLastName' =>($billingData['last_name']) ? $billingData['last_name'] : 'Apellido',
					'billingEmail' =>  ($billingData['email']) ? $billingData['email'] : '-',
					'billingAddress' => ($order->billing_address_1 . ' ' . $order->billing_address_2) ? $order->billing_address_1 . ' ' . $order->billing_address_2 : '-',
					'billingZIP' => ($order->billing_postcode) ? $order->billing_postcode : '-',
					'billingCity' => ($order->billing_city) ? $order->billing_city : '-',
					'billingState' => ($order->shipping_state) ? $order->shipping_state : 'Lima',
					'billingCountry' => ($order->billing_country) ? $order->billing_country : '-',
					'billingPhone' => ($order->billing_phone) ? $order->billing_phone : '-',
					'userCommerce' => ($order->get_user_id() != 0 ) ? $order->get_user_id() : '' ,
					'userCodePayme' => $codAsoCardHolderWallet,
					'descriptionProducts' => $this->cleanText(count($productinfo) > 1 ? 'Productos Varios' : $productinfo[0]),
					'programmingLanguage' => "ALG-WP-v4.1.1",
					'reserved1' => '',
					'reserved2' =>'',
					'reserved3' => '',
					'reserved4' => '',
					'reserved5' => $_reserved5,
					'reserved6' => $_reserved6,
					'reserved7' => $_reserved7,
					'reserved8' => $_reserved8,
					'reserved9' => $_reserved9,
					'reserved10' => $_reserved10,
					'reserved11' => $_reserved11,
					'reserved12' => $_reserved12,
					'purchaseVerification' =>$this->purchaseVerification($purchaseOperationNumber, $purchaseAmount, $isoCurrency,$this->idacquirer,$this->idCommerce),
				);

			// print_r($payme_args);
				return $payme_args;
			}


			public function cleanText($cad)
    {
        $cadStr= array (
            "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™",
            "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ",
            "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹"
        );
            
        $cadPermit= array (
            "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E"
        );
        $value = str_replace($cadStr, $cadPermit, $cad);
        return $value;
    }
    

		/**
		 * Generate the payme button link
		 *
		 * @access public
		 * @param mixed ($order_i)? $order_i : '-'d
		 * @return string
		 */
		function generate_payme_form($order_id)
			{
			global $woocommerce;
			$order = new WC_Order($order_id);
			$payme_args = $this->get_payme_args($order_id);
			$payme_args_array = array();

			
			global $wpdb;


			$wpdb->insert($wpdb->prefix .'payme_request', array(
				'purchaseOperationNumber'=> $payme_args['purchaseOperationNumber'],
                'purchaseAmount'=> $payme_args['purchaseAmount'],
                'purchaseCurrencyCode'=> $payme_args['purchaseCurrencyCode'],
                'language'=> $payme_args['language'],
                'billingFirstName'=> $payme_args['billingFirstName'],
                'billingLastName'=> $payme_args['billingLastName'],
                'billingEmail'=> $payme_args['billingEmail'],
                'billingAddress'=> $payme_args['billingAddress'],
                'billingZip'=> $payme_args['billingZip'],
                'billingState'=> $payme_args['billingState'],
                'billingCountry'=> $payme_args['billingCountry'],
                'billingPhone'=> $payme_args['billingPhone'],
                'shippingFirstName'=> $payme_args['shippingFirstName'],
                'shippingLastName'=> $payme_args['shippingLastName'],
                'shippingEmail'=> $payme_args['shippingEmail'],
                'shippingAddress'=> $payme_args['shippingAddress'],
                'shippingZip'=> $payme_args['shippingZip'],
                'shippingCity'=> $payme_args['shippingCity'],
                'shippingState'=> $payme_args['shippingState'],
                'shippingCountry'=> $payme_args['shippingCountry'],
                'shippingPhone'=> $payme_args['shippingPhone'],
                'programmingLanguage'=> $payme_args['programmingLanguage'],
                'userCommerce'=> $payme_args['userCommerce'],
                'userCodePayme'=> $payme_args['userCodePayme'],
                'descriptionProducts'=> $payme_args['descriptionProducts'],
                'purchaseVerification' =>$payme_args['purchaseVerification'] 
			));

			foreach($payme_args as $key => $value)
				{
					$payme_args_array[] = '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" />';
				}

			wp_enqueue_style('style-name', $this->wsdomain . '/VPOS2/css/modalcomercio.css');
			wp_enqueue_script('custom-script', $this->wsdomain . '/VPOS2/js/modalcomercio.js', array(
				'jquery'
			));


			if ($this->esquema=="Modal") {
					return '<form action="" method="POST" id="payme_payment_form" target="_top" class="alignet-form-vpos2">
					' . implode('', $payme_args_array) . '
					<input type="submit" class="button alt" onclick="' . $this->modalVPOS2 . '" id="submit_payme_payment_form" value="' . __('Pagar Via Payme', 'payme-checkout-woocommerce') . '" /> <a class="button cancel" href="' . esc_url($order->get_cancel_order_url()) . '">' . __('Cancelar &amp; Orden', 'woocommerce') . '</a>
						</form>';
			}

			else
			{
					return '<form action="'. $this->modalVPOS2.'" method="POST" id="payme_payment_form" target="_top" class="alignet-form-vpos2">
					' . implode('', $payme_args_array) . '
					<input type="submit" class="button alt" id="submit_payme_payment_form" value="' . __('Pagar Via Payme', 'payme-checkout-woocommerce') . '" /> <a class="button cancel" href="' . esc_url($order->get_cancel_order_url()) . '">' . __('Cancelar &amp; Orden', 'woocommerce') . '</a>
				</form>';
			}
			}
		

		 public function purchaseVerification($purchOperNum, $purchAmo, $purchCurrCod, $idacquirer,$idcommerce, $authRes = null)
		    {
		        $concatPurchase = $idacquirer.$idcommerce.$purchOperNum.$purchAmo.$purchCurrCod.$this->key; 
		        return (phpversion() >= 5.3) ? openssl_digest($concatPurchase, 'sha512') : hash('sha512', $concatPurchase);
		    }



		public

		function userCodePayme($params)
			{

			$codAsoCardHolder = "";

			global $wpdb;

			$results = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."payme_usercode where usercode = ".(string)$params['codCardHolderCommerce']." and currency ='".$this->currency."' LIMIT 1");


			if ($results) 
			{

				$codAsoCardHolder = $results[0]->userCodePayme;
			}
			else
			{
				if ($params['codCardHolderCommerce'] != 0) {

					try
						{
							$clientWallet = new SoapClient($this->wsdl);
							$resultWallet = $clientWallet->RegisterCardHolder($params);
							$codAsoCardHolder = $resultWallet->codAsoCardHolderWallet;

							$wpdb->insert($wpdb->prefix .'payme_usercode', array(
							'usercode' =>(string)$params['codCardHolderCommerce'],
							'currency' => $this->currency,
							'userCodePayme' => $codAsoCardHolder));
					
						}

						catch(Exception $e)
							{
							
							}
					}		

			}
		

			return $codAsoCardHolder;
			}

		/**
		 * Process the payment and return the result
		 *
		 * @access public
		 * @param int $order_id
		 * @return array
		 */
		function process_payment($order_id)
			{
			$order = new WC_Order($order_id);
			$form_method = 'POST';
			if ($form_method == 'GET')
				{
				$payme_args = $this->get_payme_args($order_id);
				$payme_args = http_build_query($payme_args, '', '&');

				// if ( $this->testmode == 'yes' ):
				// 	$payme_adr = $this->urltpv . '&';
				// else :
				// 	$payme_adr = $this->urltpv . '?';
				// endif;

				return array(
					'result' => 'success',
					'redirect' => $payme_adr . $payme_args
				);
				}
			  else
				{
				if (version_compare(WOOCOMMERCE_VERSION, '2.1', '>='))
					{
					return array(
						'result' => 'success',
						'redirect' => add_query_arg('order-pay', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay'))))
					);
					}
				  else
					{
					return array(
						'result' => 'success',
						'redirect' => add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay'))))
					);
					}
				}
			}

		/**
		 * Check for valid PAYME server callback
		 *
		 * @access public
		 * @return void
		 *
		 */
		function check_payme_response()
			{
			@ob_clean();
			if (!empty($_REQUEST))
				{
				header('HTTP/1.1 200 OK');
				do_action("payme_init", $_REQUEST);
				}
			  else
				{
				wp_die(__("payme Request Failure", 'payme-checkout-woocommerce'));
				}
			}

		/**
		 * Process PAYME Response and update the order information
		 *
		 * @access public
		 * @param array $posted
		 * @return void
		 */
		function payme_successful_request($posted)
			{
			global $woocommerce;

			// print_r($posted);

			if (!empty($posted['transactionState']) && !empty($posted['referenceCode']))
				{
				echo "return";
				$this->payme_return_process($posted);
				}

			if (!empty($posted['state_pol']) && !empty($posted['reference_sale']))
				{
				$this->payme_confirmation_process($posted);
				}

			$redirect_url = $woocommerce->cart->get_checkout_url();

			// For wooCoomerce 2.0

			$redirect_url = add_query_arg(array(
				'msg' => urlencode(__('There was an error on the request. please contact the website administrator.', 'payme')) ,
				'type' => $this->msg['class']
			) , $redirect_url);

			// wp_redirect( $redirect_url );

			exit;
			}

		/*
		* Procesar pagina de respuesta
		*
		*
		*/
		function payme_return_process($posted)
			{
			global $woocommerce;
			$order = $this->get_payme_order($posted);
			$codes = array(
				'4' => 'APPROVED',
				'6' => 'DECLINED',
				'104' => 'ERROR',
				'5' => 'EXPIRED',
				'7' => 'PENDING'
			);
			if ('yes' == $this->debug) $this->log->add('payme', 'Payme Found order #' . $order->id);
			if ('yes' == $this->debug) $this->log->add('payme', 'Payme Transaction state: ' . $posted['transactionState']);
			$state = $posted['transactionState'];

			// We are here so lets check status and do actions

			switch ($codes[$state])
				{
			case 'APPROVED':
			case 'PENDING':

				// Check order not already completed

				if ($order->status == 'completed')
					{
					if ('yes' == $this->debug) $this->log->add('payme', __('Aborting, Order #' . $order->id . ' is already complete.', 'payme-checkout-woocommerce'));
					exit;
					}

				// Validate Amount

				if ($order->get_total() != $posted['TX_VALUE'])
					{
					$order->update_status('on-hold', sprintf(__('Validation error: payme amounts do not match (gross %s).', 'payme-checkout-woocommerce') , $posted['TX_VALUE']));
					$this->msg['message'] = sprintf(__('Validation error: payme amounts do not match (gross %s).', 'payme-checkout-woocommerce') , $posted['TX_VALUE']);
					$this->msg['class'] = 'woocommerce-error';
					}

				// Validate Merchand id

				if (strcasecmp(trim($posted['merchantId']) , trim($this->merchant_id)) != 0)
					{
					$order->update_status('on-hold', sprintf(__('Validation error: Payment in payme comes from another id (%s).', 'payme-checkout-woocommerce') , $posted['merchantId']));
					$this->msg['message'] = sprintf(__('Validation error: Payment in payme comes from another id (%s).', 'payme-checkout-woocommerce') , $posted['merchantId']);
					$this->msg['class'] = 'woocommerce-error';
					}

				// Payment Details

				if (!empty($posted['buyerEmail'])) update_post_meta($order->id, __('Payer payme email', 'payme-checkout-woocommerce') , $posted['buyerEmail']);
				if (!empty($posted['transactionId'])) update_post_meta($order->id, __('Transaction ID', 'payme-checkout-woocommerce') , $posted['transactionId']);
				if (!empty($posted['trazabilityCode'])) update_post_meta($order->id, __('Trasability Code', 'payme-checkout-woocommerce') , $posted['trazabilityCode']);
				/*if ( ! empty( $posted['last_name'] ) )
				update_post_meta( $order->id, 'Payer last name', $posted['last_name'] );*/
				if (!empty($posted['lapPaymentMethodType'])) update_post_meta($order->id, __('Payment type', 'payme-checkout-woocommerce') , $posted['lapPaymentMethodType']);
				if ($codes[$state] == 'APPROVED')
					{
					$order->add_order_note(__('payme payment approved', 'payme-checkout-woocommerce'));
					$this->msg['message'] = $this->msg_approved;
					$this->msg['class'] = 'woocommerce-message';
					$order->payment_complete();
					}
				  else
					{
					$order->update_status('on-hold', sprintf(__('Payment pending: %s', 'payme-checkout-woocommerce') , $codes[$state]));
					$this->msg['message'] = $this->msg_pending;
					$this->msg['class'] = 'woocommerce-info';
					}

				break;

			case 'DECLINED':
			case 'EXPIRED':
			case 'ERROR':

				// Order failed

				$order->update_status('failed', sprintf(__('Payment rejected via PAYME Latam. Error type: %s', 'payme-checkout-woocommerce') , ($codes[$state])));
				$this->msg['message'] = $this->msg_declined;
				$this->msg['class'] = 'woocommerce-error';
				break;

			default:
				$order->update_status('failed', sprintf(__('Payment rejected via PAYME Latam.', 'payme-checkout-woocommerce') , ($codes[$state])));
				$this->msg['message'] = $this->msg_cancel;
				$this->msg['class'] = 'woocommerce-error';
				break;
				}

			$redirect_url = ($this->redirect_page_id == 'default' || $this->redirect_page_id == "" || $this->redirect_page_id == 0) ? $order->get_checkout_order_received_url() : get_permalink($this->redirect_page_id);

			// For wooCoomerce 2.0

			$redirect_url = add_query_arg(array(
				'msg' => urlencode($this->msg['message']) ,
				'type' => $this->msg['class']
			) , $redirect_url);
			wp_redirect($redirect_url);
			exit;
			}

		/*
		* Procesar pagina de confirmacion
		*
		*
		*/
		function payme_confirmation_process($posted)
			{
			global $woocommerce;
			$order = $this->get_payme_order($posted);
			$codes = array(
				'1' => 'CAPTURING_DATA',
				'2' => 'NEW',
				'101' => 'FX_CONVERTED',
				'102' => 'VERIFIED',
				'103' => 'SUBMITTED',
				'4' => 'APPROVED',
				'6' => 'DECLINED',
				'104' => 'ERROR',
				'7' => 'PENDING',
				'5' => 'EXPIRED'
			);
			if ('yes' == $this->debug) $this->log->add('payme', 'Found order #' . $order->id);
			$state = $posted['state_pol'];
			if ('yes' == $this->debug) $this->log->add('payme', 'Payment status: ' . $codes[$state]);

			// We are here so lets check status and do actions

			switch ($codes[$state])
				{
			case 'APPROVED':
			case 'PENDING':

				// Check order not already completed

				if ($order->status == 'completed')
					{
					if ('yes' == $this->debug) $this->log->add('payme', __('Aborting, Order #' . $order->id . ' is already complete.', 'payme-checkout-woocommerce'));
					exit;
					}

				// Validate Amount

				if ($order->get_total() != $posted['value'])
					{
					$order->update_status('on-hold', sprintf(__('Validation error: payme amounts do not match (gross %s).', 'payme-checkout-woocommerce') , $posted['value']));
					$this->msg['message'] = sprintf(__('Validation error: payme amounts do not match (gross %s).', 'payme-checkout-woocommerce') , $posted['value']);
					$this->msg['class'] = 'woocommerce-error';
					}

				// Validate Merchand id

				if (strcasecmp(trim($posted['merchant_id']) , trim($this->merchant_id)) != 0)
					{
					$order->update_status('on-hold', sprintf(__('Validation error: Payment in payme comes from another id (%s).', 'payme-checkout-woocommerce') , $posted['merchant_id']));
					$this->msg['message'] = sprintf(__('Validation error: Payment in payme comes from another id (%s).', 'payme-checkout-woocommerce') , $posted['merchant_id']);
					$this->msg['class'] = 'woocommerce-error';
					}

				// Payment details

				if (!empty($posted['email_buyer'])) update_post_meta($order->id, __('payme Client email', 'payme-checkout-woocommerce') , $posted['email_buyer']);
				if (!empty($posted['transaction_id'])) update_post_meta($order->id, __('Transaction ID', 'payme-checkout-woocommerce') , $posted['transaction_id']);
				if (!empty($posted['reference_pol'])) update_post_meta($order->id, __('Trasability Code', 'payme-checkout-woocommerce') , $posted['reference_pol']);
				if (!empty($posted['sign'])) update_post_meta($order->id, __('Tash Code', 'payme-checkout-woocommerce') , $posted['sign']);
				if (!empty($posted['ip'])) update_post_meta($order->id, __('Transaction IP', 'payme-checkout-woocommerce') , $posted['ip']);
				update_post_meta($order->id, __('Extra Data', 'payme-checkout-woocommerce') , 'response_code_pol: ' . $posted['response_code_pol'] . ' - ' . 'state_pol: ' . $posted['state_pol'] . ' - ' . 'payment_method: ' . $posted['payment_method'] . ' - ' . 'transaction_date: ' . $posted['transaction_date'] . ' - ' . 'currency: ' . $posted['currency']);
				if (!empty($posted['payment_method_type'])) update_post_meta($order->id, __('Payment type', 'payme-checkout-woocommerce') , $posted['payment_method_type']);
				if ($codes[$state] == 'APPROVED')
					{
					$order->add_order_note(__('payme payment approved', 'payme-checkout-woocommerce'));
					$this->msg['message'] = $this->msg_approved;
					$this->msg['class'] = 'woocommerce-message';
					$order->payment_complete();
					if ('yes' == $this->debug)
						{
						$this->log->add('payme', __('Payment complete.', 'payme-checkout-woocommerce'));
						}
					}
				  else
					{
					$order->update_status('on-hold', sprintf(__('Payment pending: %s', 'payme-checkout-woocommerce') , $codes[$state]));
					$this->msg['message'] = $this->msg_pending;
					$this->msg['class'] = 'woocommerce-info';
					}

				break;

			case 'DECLINED':
			case 'EXPIRED':
			case 'ERROR':
			case 'ABANDONED_TRANSACTION':

				// Order failed

				$order->update_status('failed', sprintf(__('Payment rejected via PAYME Latam. Error type: %s', 'payme-checkout-woocommerce') , ($codes[$state])));
				$this->msg['message'] = $this->msg_declined;
				$this->msg['class'] = 'woocommerce-error';
				break;

			default:
				$order->update_status('failed', sprintf(__('Payment rejected via PAYME Latam.', 'payme-checkout-woocommerce') , ($codes[$state])));
				$this->msg['message'] = $this->msg_cancel;
				$this->msg['class'] = 'woocommerce-error';
				break;
				}
			}

		/**
		 *  Get order information
		 *
		 * @access public
		 * @param mixed $posted
		 * @return void
		 */
		function get_payme_order($posted)
			{
			$custom = $posted['order_id'];

			// Backwards comp for IPN requests

			$order_id = (int)$custom;
			$reference_code = ($posted['referenceCode']) ? $posted['referenceCode'] : $posted['reference_sale'];
			$order_key = explode('-', $reference_code);
			$order_key = ($order_key[0]) ? $order_key[0] : $order_key;
			$order = new WC_Order($order_id);
			if (!isset($order->id))
				{
				$order_id = woocommerce_get_order_id_by_order_key($order_key);
				$order = new WC_Order($order_id);
				}

			// Validate key

			if ($order->order_key !== $order_key)
				{
				if ($this->debug == 'yes') $this->log->add('payme', __('Error: Order Key does not match invoice.', 'payme-checkout-woocommerce'));
				exit;
				}

			return $order;
			}

		/**
		 * Check if current currency is valid for PAYME Latam
		 *
		 * @access public
		 * @return bool
		 */
		function is_valid_currency()
			{
			if (!in_array(get_woocommerce_currency() , apply_filters('woocommerce_payme_supported_currencies', array(
				'CLP',
				'ARS',
				'BRL',
				'COP',
				'MXN',
				'PEN',
				'USD',
				'CRC'
			)))) return false;
			return true;
			}

		/**
		 * Get pages for return page setting
		 *
		 * @access public
		 * @return bool
		 */
		function get_pages($title = false, $indent = true)
			{
			$wp_pages = get_pages('sort_column=menu_order');
			$page_list = array(
				'default' => __('Default Page', 'payme-checkout-woocommerce')
			);
			if ($title) $page_list[] = $title;
			foreach($wp_pages as $page)
				{
				$prefix = '';

				// show indented child pages?

				if ($indent)
					{
					$has_parent = $page->post_parent;
					while ($has_parent)
						{
						$prefix.= ' - ';
						$next_page = get_page($has_parent);
						$has_parent = $next_page->post_parent;
						}
					}

				// add to page list array array

				$page_list[$page->ID] = $prefix . $page->post_title;
				}

			return $page_list;
			}
		}

	/**
	 * Add all currencys supported by PAYME Latem so it can be display
	 * in the woocommerce settings
	 *
	 * @access public
	 * @return bool
	 */
	function add_all_currency_payme($currencies)
		{
		$currencies['ARS'] = __('Argentine Peso', 'payme-checkout-woocommerce');
		$currencies['BRL'] = __('Brasilian Real', 'payme-checkout-woocommerce');
		$currencies['COP'] = __('Colombian Peso', 'payme-checkout-woocommerce');
		$currencies['MXN'] = __('Mexican Peso', 'payme-checkout-woocommerce');
		$currencies['CLP'] = __('Chile Peso', 'payme-checkout-woocommerce');
		$currencies['PEN'] = __('Perubian New Sol', 'payme-checkout-woocommerce');
		return $currencies;
		}

	/**
	 * funciión que retorna el equivalente iso de una moneda
	 * in the woocommerce settings
	 *
	 * @access public
	 * @return string
	 */
	function get_isoCurrency($currency)
		{
		switch ($currency)
			{
		case "PEN":
			$isoCurrency = 604;
			break;

		case "USD":
			$isoCurrency = 840;
			break;
			}

		return $isoCurrency;
		}

	/**
	 * Add simbols for all currencys in payme so it can be display
	 * in the woocommerce settings
	 *
	 * @access public
	 * @return bool
	 */
	function add_all_symbol_payme($currency_symbol, $currency)
		{
		switch ($currency)
			{
		case 'ARS':
			$currency_symbol = '$';
			break;

		case 'CLP':
			$currency_symbol = '$';
			break;

		case 'BRL':
			$currency_symbol = 'R$';
			break;

		case 'COP':
			$currency_symbol = '$';
			break;

		case 'MXN':
			$currency_symbol = '$';
			break;

		case 'PEN':
			$currency_symbol = 'S/.';
			break;
			}

		return $currency_symbol;
		}

	/**
	 * Add the Gateway to WooCommerce
	 *
	 */
	function woocommerce_add_payme_gateway($methods)
		{
		$methods[] = 'WC_payme';
		return $methods;
		}

	add_filter('woocommerce_payment_gateways', 'woocommerce_add_payme_gateway');
	}

/**
 * Filter simbol for currency currently active so it can be display
 * in the front end
 *
 * @access public
 * @param (string) $currency_symbol, (string) $currency
 * @return (string) filtered currency simbol
 */

function frontend_filter_currency_sim($currency_symbol, $currency)
	{
	switch ($currency)
		{
	case 'ARS':
		$currency_symbol = '$';
		break;

	case 'CLP':
		$currency_symbol = '$';
		break;

	case 'BRL':
		$currency_symbol = 'R$';
		break;

	case 'COP':
		$currency_symbol = '$';
		break;

	case 'MXN':
		$currency_symbol = '$';
		break;

	case 'PEN':
		$currency_symbol = 'S/.';
		break;
		}

	return $currency_symbol;
	}


register_activation_hook( __FILE__, 'create_table_paymeresponse' );
function create_table_paymeresponse() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'payme_response';
    $pf_parts_db_version = '1.0.0';
    $charset_collate = $wpdb->get_charset_collate();

    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

        $sql = "CREATE TABLE $table_name (
                        id_log int(11) NOT NULL AUTO_INCREMENT,
					    id_order int(11),
					    authorizationResult VARCHAR(50),
					    authorizationCode VARCHAR(50),
					    errorCode VARCHAR(50),
					    errorMessage VARCHAR(50),
					    bin VARCHAR(50),
					    brand VARCHAR(50),
					    paymentReferenceCode VARCHAR(50),
					    purchaseOperationNumber VARCHAR(50),
					    purchaseAmount VARCHAR(50),
					    purchaseCurrencyCode VARCHAR(50),
					    purchaseVerification VARCHAR(200),
					    plan VARCHAR(50),
					    cuota VARCHAR(50),
					    montoAproxCuota VARCHAR(50),
					    resultadoOperacion VARCHAR(50),
					    paymethod VARCHAR(20),
					    fechaHora VARCHAR(50),
					    reserved1 VARCHAR(50),
					    reserved2 VARCHAR(50),
					    reserved3 VARCHAR(50),
					    reserved4 VARCHAR(50),
					    reserved5 VARCHAR(50),
					    reserved6 VARCHAR(50),
					    reserved7 VARCHAR(50),
					    reserved8 VARCHAR(50),
					    reserved9 VARCHAR(50),
					    reserved10 VARCHAR(50),
					    numeroCip VARCHAR(50),
					    PRIMARY KEY  (id_log)
                        ) $charset_collate; 
                        ALTER TABLE payme_response MODIFY purchaseVerification VARCHAR(200);
                        ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'pf_parts_db_version', $pf_parts_db_version );
    }
}


register_activation_hook( __FILE__, 'create_table_paymelog' );
function create_table_paymelog() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'payme_request';
    $pf_parts_db_version = '1.0.0';
    $charset_collate = $wpdb->get_charset_collate();

    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

        $sql = "CREATE TABLE $table_name (
                        id_log int(11) NOT NULL AUTO_INCREMENT,
			            reserved1 VARCHAR(50),
			            reserved2 VARCHAR(50),
			            reserved3 VARCHAR(50),
			            reserved4 VARCHAR(50),
			            reserved5 VARCHAR(50),
			            purchaseOperationNumber VARCHAR(50),
			            purchaseAmount VARCHAR(50),
			            purchaseCurrencyCode VARCHAR(50),
			            language VARCHAR(50),
			            billingFirstName VARCHAR(50),
			            billingLastName VARCHAR(50),
			            billingEmail VARCHAR(50),
			            billingAddress VARCHAR(50),
			            billingZip VARCHAR(50),
			            billingCity VARCHAR(50),
			            billingState VARCHAR(50),
			            billingCountry VARCHAR(50),
			            billingPhone VARCHAR(50),
			            shippingFirstName VARCHAR(50),
			            shippingLastName VARCHAR(50),
			            shippingEmail VARCHAR(50),
			            shippingAddress VARCHAR(50),
			            shippingZip VARCHAR(50),
			            shippingCity VARCHAR(50),
			            shippingState VARCHAR(50),
			            shippingCountry VARCHAR(50),
			            shippingPhone VARCHAR(50),
			            programmingLanguage VARCHAR(50),
			            userCommerce VARCHAR(50),
			            userCodePayme VARCHAR(50),
			            descriptionProducts VARCHAR(100),
			            purchaseVerification VARCHAR(200),
			            PRIMARY KEY  (id_log)
                        ) $charset_collate;


                        ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'pf_parts_db_version', $pf_parts_db_version );
    }
}

register_activation_hook( __FILE__, 'create_table_paymeusercode' );
function create_table_paymeusercode() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'payme_usercode';
    $pf_parts_db_version = '1.0.0';
    $charset_collate = $wpdb->get_charset_collate();

    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

        $sql = "CREATE TABLE $table_name (
                        id int(11) NOT NULL AUTO_INCREMENT,
			             usercode VARCHAR(50),
			             currency VARCHAR(50),
			             userCodePayme VARCHAR(50),
					    PRIMARY KEY  (id)
                        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'pf_parts_db_version', $pf_parts_db_version );
    }
}

add_filter('woocommerce_currency_symbol', 'frontend_filter_currency_sim', 1, 2);

