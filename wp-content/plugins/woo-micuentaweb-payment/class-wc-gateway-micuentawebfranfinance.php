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

class WC_Gateway_MicuentawebFranfinance extends WC_Gateway_MicuentawebStd
{
    protected $micuentaweb_countries = array('FR', 'GP', 'MQ', 'GF', 'RE', 'YT'); // France and DOM.
    protected $micuentaweb_currencies = array('EUR');

    public function __construct()
    {
        $this->id = 'micuentawebfranfinance';
        $this->icon = apply_filters('woocommerce_micuentawebfranfinance_icon', WC_MICUENTAWEB_PLUGIN_URL . 'assets/images/franfinance.png');
        $this->has_fields = true;
        $this->method_title = self::GATEWAY_NAME. ' - ' . __('Franfinance payment', 'woo-micuentaweb-payment');

        // Init common vars.
        $this->micuentaweb_init();

        // Load the form fields.
        $this->init_form_fields();

        // Load the module settings.
        $this->init_settings();

        // Define user set variables.
        $this->title = $this->get_title();
        $this->description = $this->get_description();
        $this->testmode = ($this->get_general_option('ctx_mode') == 'TEST');
        $this->debug = ($this->get_general_option('debug') == 'yes') ? true : false;

        if ($this->micuentaweb_is_section_loaded()) {
            // Reset Franfinance payment admin form action.
            add_action('woocommerce_settings_start', array($this, 'micuentaweb_reset_admin_options'));

            // Update Franfinance payment admin form action.
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

            // Adding style to admin form action.
            add_action('admin_head-woocommerce_page_' . $this->admin_page, array($this, 'micuentaweb_admin_head_style'));

            // Adding JS to admin form action.
            add_action('admin_head-woocommerce_page_' . $this->admin_page, array($this, 'micuentaweb_admin_head_script'));
        }

        // Generate Franfinance payment form action.
        add_action('woocommerce_receipt_' . $this->id, array($this, 'micuentaweb_generate_form'));
    }

    /**
     * Initialise gateway settings form fields.
     */
    public function init_form_fields()
    {
        parent::init_form_fields();

        unset($this->form_fields['capture_delay']);
        unset($this->form_fields['validation_mode']);
        unset($this->form_fields['payment_cards']);
        unset($this->form_fields['advanced_options']);
        unset($this->form_fields['card_data_mode']);
        unset($this->form_fields['payment_by_token']);

        // By default, disable Franfinance payment submodule.
        $this->form_fields['enabled']['default'] = 'no';
        $this->form_fields['enabled']['description'] = __('Enables / disables Franfinance payment.', 'woo-micuentaweb-payment');

        $this->form_fields['title']['default'] = __('Payment with Franfinance', 'woo-micuentaweb-payment');

        // If WooCommecre Multilingual is not available (or installed version not allow gateways UI translation).
        // Let's suggest our translation feature.
        if (! class_exists('WCML_WC_Gateways')) {
            $this->form_fields['title']['default'] = array(
                'en_US' => 'Payment with Franfinance',
                'en_GB' => 'Payment with Franfinance',
                'fr_FR' => 'Paiement avec Franfinance',
                'de_DE' => 'Zahlung mit Franfinance',
                'es_ES' => 'Pago con Franfinance',
                'pt_BR' => 'Pagamento com Franfinance'
            );
        }

        $this->form_fields['payment_options'] = array(
            'title' => __('FRANFINANCE PAYMENT OPTIONS', 'woo-micuentaweb-payment'),
            'type' => 'title'
        );

        $columns = array();
        $columns['label'] = array(
            'title' => __('Label', 'woo-micuentaweb-payment'),
            'width' => '154px'
        );

        $columns['count'] = array(
            'title' => __('Count', 'woo-micuentaweb-payment'),
            'width' => '72px'
        );

        $columns['fees'] = array(
            'title' => __('Fees', 'woo-micuentaweb-payment'),
            'default' => '-1',
            'width' => '125px'
        );

        $columns['amount_min'] = array(
            'title' => __('Min amount', 'woo-micuentaweb-payment'),
            'width' => '92px'
        );

        $columns['amount_max'] = array(
            'title' => __('Max amount', 'woo-micuentaweb-payment'),
            'width' => '92px'
        );

        $this->form_fields['payment_options'] = array(
            'title' => __('Payment options', 'woo-micuentaweb-payment'),
            'type' => 'table',
            'columns' => $columns,
            'default' => array (
                '3x' => array('label' => sprintf(__('Payment in %s times', 'woo-micuentaweb-payment'), '3'), 'count' => '3', 'fees' => '-1', 'amount_min' => '100', 'amount_max' => '3000'),
                '4x' => array('label' => sprintf(__('Payment in %s times', 'woo-micuentaweb-payment'), '4'), 'count' => '4', 'fees' => '-1', 'amount_min' => '100', 'amount_max' => '4000'),
            ),
            'description' => __('Click on « Add » button to configure one or more payment options.<br /><b>Label: </b>The option label to display on the frontend (the %c pattern will be replaced by payments count).<br /><b>Count: </b>Total number of payments.<br /><b>Fees: </b>Choose whether or not to apply fees.<br /><b>Min. amount: </b>Minimum amount to enable the payment option.<br /><b>Max. amount: </b>Maximum amount to enable the payment option.<br /><b>Do not forget to click on « Save » button to save your modifications.</b>',
                'woo-micuentaweb-payment')
        );
    }

    protected function get_rest_fields()
    {
        // REST API fields are not available for this payment.
    }

    public function micuentaweb_admin_head_script()
    {
        parent::micuentaweb_admin_head_script();
        ?>
        <script type="text/javascript">
        //<!--
            function micuentawebAddOption(fieldName, record, key) {
                if (jQuery('#' + fieldName + '_table tbody tr').length == 1) {
                    jQuery('#' + fieldName + '_btn').css('display', 'none');
                    jQuery('#' + fieldName + '_table').css('display', '');
                }

                if (! key) {
                    // New line, generate key.
                    key = new Date().getTime();
                }

                var optionLine = '<tr id="' + fieldName + '_line_' + key + '">';

                // Reorder record elements.
                var orderedRecord = {
                    'label': record.label,
                    'count': record.count,
                    'fees': record.fees,
                    'amount_min': record.amount_min,
                    'amount_max': record.amount_max
                };

                jQuery.each(orderedRecord, function(attr, value) {
                    var width = jQuery('#' + fieldName + '_table thead tr th.' + attr).width() - 8;
                    var inputName = fieldName + '[' + key + '][' + attr + ']';

                    optionLine += '<td style="padding: 0px;">';

                    switch (attr) {
                        case 'count':
                            optionLine += '<select style="width: ' + width + 'px;" name="' + inputName + '" id="' + inputName + '">';
                            optionLine += '<?php $options = array('3' => '3x', '4' => '4x');
                                                foreach ($options as $key => $value) {
                                                    echo '<option value="' . $key . '">' . $value . '</option>';
                                                } ?>';
                            optionLine = optionLine.replace('<option value="'+value+'"', '<option value="'+value+'" selected');
                            break;

                        case 'fees':
                            optionLine += '<select style="width: ' + width + 'px;" name="' + inputName + '" id="' + inputName + '">';
                            optionLine += '<?php $options = array('-1' => sprintf(__('%s Back Office configuration', 'woo-micuentaweb-payment'), self::BACKOFFICE_NAME), 'N' => __('Without fees', 'woo-micuentaweb-payment'), 'Y' => __('With fees', 'woo-micuentaweb-payment'));
                                                foreach ($options as $key => $value) {
                                                    echo '<option value="' . $key . '">' . $value . '</option>';
                                                } ?>';

                            optionLine = optionLine.replace('<option value="'+value+'"', '<option value="'+value+'" selected');
                            break;

                        default:
                            optionLine += '<input class="input-text regular-input" style="width: ' + width + 'px;" name="' + inputName + '" id="' + inputName + '" type="text" value="' + value + '">';
                    }

                    optionLine += '</td>';
                });

                optionLine += '<td style="padding: 0px;"><input type="button" value="<?php echo __('Delete', 'woo-micuentaweb-payment')?>" onclick="javascript: micuentawebDeleteOption(\'' + fieldName + '\', \'' + key + '\');"></td>';
                optionLine += '</tr>';

                jQuery(optionLine).insertBefore('#' + fieldName + '_add');
            }

            function micuentawebDeleteOption(fieldName, key) {
                jQuery('#' + fieldName + '_line_' + key).remove();

                if (jQuery('#' + fieldName + '_table tbody tr').length == 1) {
                    jQuery('#' + fieldName + '_btn').css('display', '');
                    jQuery('#' + fieldName + '_table').css('display', 'none');
                }
            }
        //-->
        </script>
<?php
    }

    public function validate_payment_options_field($key, $value = null)
    {
        $name = $this->plugin_id . $this->id . '_' . $key;
        $value = $value ? $value : (key_exists($name, $_POST) ? $_POST[$name] : array());

        $old_value = $this->get_option($key);
        $min = $this->get_option('amount_min');
        $max = $this->get_option('amount_max');

        foreach ($value as $code => $option) {
            // Clean strings.
            $fnc = function_exists('wc_clean') ? 'wc_clean' : 'woocommerce_clean';
            $value[$code] = array_map('esc_attr', array_map($fnc, (array) $option));

            if ($option['amount_min'] && (! is_numeric($option['amount_min']) || $option['amount_min'] < 0 || (is_numeric($min) && $option['amount_min'] < $min))) {
                $value[$code]['amount_min'] = $old_value[$code]['amount_min']; // Restore old value.
            }

            if ($option['amount_max'] && (! is_numeric($option['amount_max']) || $option['amount_max'] < 0 || (is_numeric($max) && $option['amount_max'] > $max))) {
                $value[$code]['amount_max'] = $old_value[$code]['amount_max']; // Restore old value.
            }

            if (! $option['label']) {
                $value[$code]['label'] = sprintf(__('Payment in %s times', 'woo-micuentaweb-payment'), $option['count']);
            }
        }

        return $value;
    }

    /**
     * Check if this gateway is enabled and available for the current cart.
     */
    public function is_available()
    {
        global $woocommerce;

        if (! parent::is_available()) {
            return false;
        }

        $order_id = get_query_var('order-pay');
        if ($order_id || $woocommerce->cart) {
            // Check Franfinance payment options.
            $available_options = $this->get_available_options();
            if (empty($available_options)) {
                return false;
            }
        }

        return true;
    }

    private function get_available_options()
    {
        global $woocommerce;

        // Recover total amount either from order or from current cart if any.
        $amount = self::get_total_amount();

        $options = $this->get_option('payment_options');
        $enabled_options = array();

        if (isset($options) && is_array($options) && ! empty($options)) {
            foreach ($options as $code => $option) {
                if ((! $option['amount_min'] || $amount >= $option['amount_min']) && (! $option['amount_max'] || $amount <= $option['amount_max'])) {
                    // Label to display on payment page.
                    $c = is_numeric($option['count']) ? $option['count'] : 1;
                    $search = array('%c');
                    $replace = array($c);
                    $option['label'] = str_replace($search, $replace, $option['label']);

                    $enabled_options[$code] = $option;
                }
            }
        }

        return $enabled_options;
    }

    /**
     * Display payment fields and show method description if set.
     *
     * @access public
     * @return void
     */
    public function payment_fields()
    {
        parent::payment_fields();

        $options = $this->get_available_options();

        if (empty($options)) {
            // Should not happens for Franfinance payment.
            return;
        }

        echo '<ul>';

        if (count($options) == 1) {
            $option = reset($options); // The option itself.
            $key = key($options); // The option key in options array.
            echo '<span style="font-weight: bold;">' . __('Your payment option', 'woo-micuentaweb-payment') . '</span>';
            echo '<li style="list-style-type: none;">
                    <input type="hidden" id="micuentawebfranfinance_option_' . $key . '" value="' . $key . '" name="micuentawebfranfinance_option">
                    <label style="display: inline;">' . $option['label'] . '</label>
                  </li>';
        } else {
            $first = true;
            echo '<span style="font-weight: bold;">' . __('Choose your payment option', 'woo-micuentaweb-payment') . '</span>';
            foreach ($options as $key => $option) {
                echo '<li style="list-style-type: none;">
                        <input class="radio" type="radio"'. ($first == true ? ' checked="checked"' : '') . ' id="micuentawebfranfinance_option_' . $key . '" value="' . $key . '" name="micuentawebfranfinance_option">
                        <label for="micuentawebfranfinance_option_' . $key . '" style="display: inline;">' . $option['label'] . '</label>
                      </li>';
                $first = false;
            }
        }

        echo '</ul>';
    }

    /**
     * Process the payment and return the result.
     **/
    public function process_payment($order_id)
    {
        global $woocommerce;

        $options = $this->get_available_options();
        $option = $options[$_POST['micuentawebfranfinance_option']];

        // Save selected payment option into session...
        set_transient('micuentawebfranfinance_option_' . $order_id, $option);

        // ... and into DB.
        $order = new WC_Order($order_id);
        update_post_meta(self::get_order_property($order, 'id'), '_payment_method_title', self::get_order_property($order, 'payment_method_title') . " ({$option['label']})");

        if (version_compare($woocommerce->version, '2.1.0', '<')) {
            $pay_url = add_query_arg('order', self::get_order_property($order, 'id'), add_query_arg('key', self::get_order_property($order, 'order_key'), get_permalink(woocommerce_get_page_id('pay'))));
        } else {
            $pay_url = $order->get_checkout_payment_url(true);
        }

        return array(
            'result' => 'success',
            'redirect' => $pay_url
        );
    }

    /**
     * Prepare form params to send to payment gateway.
     **/
    protected function micuentaweb_fill_request($order)
    {
        parent::micuentaweb_fill_request($order);
        $this->send_cart_data($order);
        $this->send_shipping_data($order);

        // Override with Franfinance specific params.
        $this->micuentaweb_request->set('validation_mode', '0');
        $this->micuentaweb_request->set('capture_delay', '0');

        $option = get_transient('micuentawebfranfinance_option_' . self::get_order_property($order, 'id'));
        $this->micuentaweb_request->set('payment_cards', 'FRANFINANCE_' . $option['count'] . 'X');

        if ($option['fees'] !== '-1') {
            $fees = $option['fees'] ? 'Y' : 'N';
            $this->micuentaweb_request->set('acquirer_transient_data', '{"FRANFINANCE":{"FEES_' . $option['count'] . 'X":"' . $fees . '"}}');
        }

        delete_transient('micuentawebfranfinance_option_' . self::get_order_property($order, 'id'));
    }
}
