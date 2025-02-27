<?php
/**
 * Copyright © Lyra Network and contributors.
 * This file is part of Izipay plugin for WooCommerce. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @author    Geoffrey Crofte, Alsacréations (https://www.alsacreations.fr/)
 * @copyright Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Lyranetwork\Micuentaweb\Sdk\Form\Api as MicuentawebApi;

class WC_Gateway_MicuentawebOther extends WC_Gateway_MicuentawebStd
{
    protected $payment_code;
    protected $payment_title;
    protected $regrouped_other_payments;

    public function __construct($payment_code, $payment_title)
    {
        $this->payment_code = $payment_code;
        $this->payment_title = $payment_title;

        // To use common methods.
        $this->regrouped_other_payments = new WC_Gateway_MicuentawebRegroupedOther();

        $code = strtolower($this->payment_code);
        $this->id = 'micuentawebother_' . $code;
        $this->icon = apply_filters('woocommerce_' . $this->id . '_icon', self::LOGO_URL . $code . '.png');

        $this->has_fields = true;
        $this->method_title = self::GATEWAY_NAME . ' - ' . $this->payment_title;

        // Init common vars.
        $this->micuentaweb_init();

        // Load the module settings.
        $this->init_settings();

        // Define user set variables.
        $this->title = $this->get_title();
        $this->description = $this->get_description();
        $this->testmode = ($this->get_general_option('ctx_mode') == 'TEST');
        $this->debug = ($this->get_general_option('debug') == 'yes') ? true : false;

        // Generate payment form action.
        add_action('woocommerce_receipt_' . $this->id, array($this, 'micuentaweb_generate_form'));
    }

    protected function get_rest_fields()
    {
        // REST API fields are not available for this payment.
    }

    /**
     * Check if this gateway is enabled and available for the current cart.
     */
    public function is_available()
    {
        return $this->regrouped_other_payments->is_available_ignoring_regroup();
    }

    /**
     * Get title function.
     *
     * @access public
     * @return string
     */
    public function get_title()
    {
        $title = $this->payment_title;

        if (! $title) {
            $cards = MicuentawebApi::getSupportedCardTypes();
            $title = sprintf(__('Payment with %s', 'woo-micuentaweb-payment'), $cards[$this->payment_code]);
        }

        return apply_filters('woocommerce_gateway_title', $title, $this->id);
    }

    /**
     * Get description function.
     *
     * @access public
     * @return string
     */
    public function get_description()
    {
        return $this->regrouped_other_payments->get_description();
    }

    /**
     * Prepare form params to send to payment gateway.
     **/
    protected function micuentaweb_fill_request($order)
    {
        parent::micuentaweb_fill_request($order);

        // Set payment card.
        $this->micuentaweb_request->set('payment_cards', $this->payment_code);

        $option = $this->regrouped_other_payments->get_mean($this->payment_code);

        // Check if capture_delay and validation_mode are overriden.
        if (is_numeric($option['capture_delay'])) {
            $this->micuentaweb_request->set('capture_delay', $option['capture_delay']);
        }

        if ($option['validation_mode'] !== '-1') {
            $this->micuentaweb_request->set('validation_mode', $option['validation_mode']);
        }

        // Add cart data.
        if ($option['send_cart_data'] === 'y') {
            $this->send_cart_data($order);
        }
    }
}
