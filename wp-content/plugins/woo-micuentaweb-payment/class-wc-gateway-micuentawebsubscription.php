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
use Lyranetwork\Micuentaweb\Sdk\Rest\Api as MicuentawebRest;

class WC_Gateway_MicuentawebSubscription extends WC_Gateway_MicuentawebStd
{
    const SUBSCRIPTIONS_HANDLER = 'wc-subscriptions';
    protected $subscriptions_handler;

    public function __construct()
    {
        $this->id = 'micuentawebsubscription';
        $this->icon = apply_filters('woocommerce_micuentawebsubscription_icon', WC_MICUENTAWEB_PLUGIN_URL . 'assets/images/micuentaweb.png');
        $this->has_fields = true;
        $this->method_title = self::GATEWAY_NAME. ' - ' . __('Subscription payment', 'woo-micuentaweb-payment');

        $this->supports = array(
            'subscriptions',
            'subscription_cancellation',
            'subscription_payment_method_change',
            'subscription_amount_changes',
            'subscription_date_changes',
            'subscription_payment_method_change_customer',
            'gateway_scheduled_payments',
            'subscription_suspension',
            'subscription_reactivation'
        );

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

        // Use the selected susbscriptions handler.
        $handler = $this->get_option('subscriptions') ? $this->get_option('subscriptions') : self::SUBSCRIPTIONS_HANDLER;
        $this->subscriptions_handler = Micuentaweb_Subscriptions_Loader::getInstance($handler);

        if ($this->micuentaweb_is_section_loaded()) {
            // Reset subscription payment admin form action.
            add_action('woocommerce_settings_start', array($this, 'micuentaweb_reset_admin_options'));

            // Update subscription payment admin form action.
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

            // Adding style to admin form action.
            add_action('admin_head-woocommerce_page_' . $this->admin_page, array($this, 'micuentaweb_admin_head_style'));

            // Adding JS to admin form action.
            add_action('admin_head-woocommerce_page_' . $this->admin_page, array($this, 'micuentaweb_admin_head_script'));
        }

        // Generate subscription payment form action.
        add_action('woocommerce_receipt_' . $this->id, array($this, 'micuentaweb_generate_form'));

        // Iframe payment endpoint action.
        add_action('woocommerce_api_wc_gateway_' . $this->id, array($this, 'micuentaweb_generate_iframe_form'));

        // Order needs payment filter.
        add_filter('woocommerce_order_needs_payment', array($this, 'micuentaweb_order_needs_payment'), 10, 2);

        add_action('manage_shop_subscription_posts_custom_column', array($this, 'micuentaweb_display_subscription_error_msg'), 2);

        if ($this->subscriptions_handler) {
            $this->subscriptions_handler->init_hooks();
        }
    }

    /**
     * Initialise gateway settings form fields.
     */
    public function init_form_fields()
    {
        parent::init_form_fields();

        unset($this->form_fields['payment_cards']);
        unset($this->form_fields['card_data_mode']);
        unset($this->form_fields['payment_by_token']);

        // By default, disable Subscription payment submodule.
        $this->form_fields['enabled']['default'] = 'no';
        $this->form_fields['enabled']['description'] = __('Enables / disables payment by Subscription.', 'woo-micuentaweb-payment');

        // Add subscription payment fields.
        $this->form_fields['subscriptions'] = array(
            'custom_attributes' => array(
                'onchange' => 'micuentawebShowSubscriptionsWarningMessage()'
            ),
            'title' => __('Subscriptions management', 'woo-micuentaweb-payment'),
            'type' => 'select',
            'default' => 'wc-subscriptions',
            'options' => array(
                'wc-subscriptions' => 'WooCommerce Subscriptions',
                'subscriptio' => 'Subscriptio 2.x',
                'custom' => __('Custom', 'woo-micuentaweb-payment')
            ),
            'description' => __('If you buy subscriptions on your site, choose the solution you use to manage them. If you choose "Custom", your developper may develop a subscriptions adapter for our plugin.', 'woo-micuentaweb-payment'),
            'class' => 'wc-enhanced-select'
       );
    }

    protected function get_rest_fields()
    {
        // REST API fields are not available for this payment.
    }

    protected function is_available_for_subscriptions()
    {
        global $woocommerce;

        if (! $this->subscriptions_handler) {
            return false;
        }

        // In case of changing payment method of an existing subscription.
        // At this stage all conditions of is_available_for_subscriptions are guaranteed so we return true.
        if ($this->subscriptions_handler->is_subscription_update()) {
            return true;
        }

        $cust_id = self::get_customer_property($woocommerce->customer, 'id');

        // Allow subscription when no client is connected and "Allow customers to create an account during checkout" is enabled.
        if (! $cust_id && (get_option('woocommerce_enable_signup_and_login_from_checkout') !== 'yes')
            && (get_option('woocommerce_enable_signup_from_checkout_for_subscriptions') !== 'yes')) {
            return false;
        }

        if ($this->subscriptions_handler->cart_contains_multiple_subscriptions($woocommerce->cart)
                || ! $this->subscriptions_handler->cart_contains_subscription($woocommerce->cart)) {
            return false;
        }

        return true;
    }

    public function payment_fields()
    {
        parent::payment_fields();

        if ($this->subscriptions_handler && $this->subscriptions_handler->is_subscription_update()) {
            $order_id = get_query_var('order-pay');
            $order = new WC_Order((int) $order_id);
            $method = self::get_order_property($order, 'payment_method');
            echo '<input type="hidden" id="micuentawebsubscription_old_pm" name="micuentawebsubscription_old_pm" value="' . $method . '">';
        }
    }

    protected function payment_by_alias_view($html, $force_redir = true)
    {
        global $woocommerce;

        $cust_id = self::get_customer_property($woocommerce->customer, 'id');
        $saved_subsc_masked_pan = get_user_meta((int) $cust_id, $this->id . '_masked_pan', true);

        // Recover card brand if saved with masked pan and check if logo exists.
        $card_brand = '';
        $card_brand_logo = '';
        if (strpos($saved_subsc_masked_pan, '|')) {
            $card_brand = substr($saved_subsc_masked_pan, 0, strpos($saved_subsc_masked_pan, '|'));
            $remote_logo = self::LOGO_URL . strtolower($card_brand) . '.png';
            if ($card_brand) {
                $card_brand_logo = '<img src="' . $remote_logo . '"
                       alt="' . $card_brand . '"
                       title="' . $card_brand . '"
                       style="vertical-align: middle; margin: 0 10px 0 5px; max-height: 20px; display: unset;">';
            }
        }

        $saved_subsc_masked_pan = $card_brand_logo ? $card_brand_logo . '<b style="vertical-align: middle;">' . substr($saved_subsc_masked_pan, strpos($saved_subsc_masked_pan, '|') + 1) . '</b>'
            : ' <b>' . str_replace('|',' ', $saved_subsc_masked_pan) . '</b>';

        echo '<div id="' . $this->id . '_payment_by_token_description">
                  <ul>
                      <li>
                          <span>' .
                              sprintf(__('You will pay with your stored means of payment %s', 'woo-micuentaweb-payment'), $saved_subsc_masked_pan)
                              . ' (<a href="' . esc_url(wc_get_account_endpoint_url($this->get_option('woocommerce_saved_cards_endpoint', 'ly_saved_cards'))) . '">' . __('manage your payment means', 'woo-micuentaweb-payment') . '</a>).
                          </span>
                      </li>
                  </ul>
              </div>';
    }

    protected function can_use_alias($cust_id, $verify_identifier = false)
    {
        global $woocommerce;

        if (! $cust_id) {
            return false;
        }

        $amount = $woocommerce->cart ? $woocommerce->cart->total : 0;
        if (($amount <= 0) && (! $verify_identifier || (! empty($_GET['wc-ajax']) && $this->check_identifier($cust_id, $this->id)))) {
            return true;
        }

        return false;
    }

    /**
     * Prepare form params to send to payment gateway.
     **/
    protected function micuentaweb_fill_request($order)
    {
        parent::micuentaweb_fill_request($order);

        $cust_id = self::get_order_property($order, 'user_id');
        $saved_identifier = $this->get_cust_identifier($cust_id);
        $is_identifier_active = $this->is_cust_identifier_active($cust_id);

        $info = $this->subscriptions_handler ? $this->subscriptions_handler->subscription_info($order) : null;

        if (is_array($info) && ! empty($info)) {
            $currency = MicuentawebApi::findCurrencyByAlphaCode(get_woocommerce_currency());

            $this->micuentaweb_request->set('sub_amount', $currency->convertAmountToInteger($info['amount']));
            $this->micuentaweb_request->set('sub_currency', $currency->getNum()); // Same as general order currency.

            $this->micuentaweb_request->set('sub_desc', $this->get_rrule($info));

            $this->micuentaweb_request->set('sub_effect_date', $info['effect_date']);

            // Initial amount.
            if (isset($info['init_amount']) && $info['init_amount'] && isset($info['init_number']) && $info['init_number']) {
                $this->micuentaweb_request->set('sub_init_amount', $currency->convertAmountToInteger($info['init_amount']));
                $this->micuentaweb_request->set('sub_init_amount_number', $info['init_number']);
            }

            $order_amount = $order->get_total();
            if ($order_amount > 0) {
                $this->micuentaweb_request->set('page_action', 'REGISTER_PAY_SUBSCRIBE');
                $this->micuentaweb_request->set('identifier', null);
            } else {
                // Only subscriptions.
                if ($saved_identifier && $is_identifier_active) {
                    $this->micuentaweb_request->set('identifier', $saved_identifier);
                    $this->micuentaweb_request->set('page_action', 'SUBSCRIBE');
                } else {
                    $this->micuentaweb_request->set('page_action', 'REGISTER_SUBSCRIBE');
                }
            }
        } elseif ($saved_identifier) {
            // Called from change payment action.
            $this->micuentaweb_request->set('amount', 0);
            $this->micuentaweb_request->set('identifier', $saved_identifier);
            $this->micuentaweb_request->set('page_action', 'REGISTER_UPDATE');
        }

        // $order_id is an id of a subscription.
        $order_id = self::get_order_property($order, 'id');
        if ($this->subscriptions_handler && ($parent_order = $this->subscriptions_handler->get_parent_order($order_id))) {
            $this->micuentaweb_request->set('order_id', self::get_order_property($parent_order, 'id'));
            $this->micuentaweb_request->addExtInfo('order_key', self::get_order_property($parent_order, 'order_key'));
            $this->micuentaweb_request->addExtInfo('subsc_id', $order_id);
        }
    }

    public function cancel_online_subscription($subscription_id, $order_id)
    {
        $key = $this->testmode ? $this->get_general_option('test_private_key') : $this->get_general_option('prod_private_key');
        if (! $key) {
            if (is_admin()) { // Show error message only if it's made on backend.
                set_transient('micuentaweb_cancelled_subscription_error_msg', sprintf(__('Subscription is cancelled only in WooCommerce. Please, consider cancelling the subscription in %s Back Office.', 'woo-micuentaweb-payment'), 'Izipay'));
            } else {
                wc_add_notice( __('An error occurred during the cancellation of the subscription. Please contact customer support.', 'woo-micuentaweb-payment'), 'notice' );
            }

            $this->log("Subscription #{$subscription_id} cannot be cancelled on gateway for order #$order_id: private key is not configured.");
            return;
        }

        $this->log("Cancelling subscription #{$subscription_id} for order #$order_id.");

        $order = new WC_Order((int) $order_id);

        $cust_id = self::get_order_property($order, 'user_id');
        $saved_identifier = $this->get_cust_identifier($cust_id);

        $params = array(
            'subscriptionId' => get_post_meta($order_id, 'Subscription ID', true),
            'paymentMethodToken' => $saved_identifier
        );

        try {
            $client = new MicuentawebRest(
                $this->get_general_option('rest_url'),
                $this->get_general_option('site_id'),
                $key
            );

            $result = $client->post('V4/Subscription/Cancel', json_encode($params));
            MicuentawebRestTools::checkResult($result);

            // Subscription cancelled successfully.
            $this->log("Subscription #{$subscription_id} cancelled successfully for order #$order_id.");

            // Cancel running subscription transactions.
            $transactions = $this->get_order_details($order_id);

            foreach ($transactions as $transaction) {
                $this->cancel_transaction($transaction);
            }
        } catch (Exception $e) {
            if (is_admin()) { // Show error message only if it's made on backend.
                set_transient('micuentaweb_cancelled_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            } else {
                wc_add_notice( __('An error occurred during the cancellation of the subscription. Please contact customer support.', 'woo-micuentaweb-payment'), 'notice' );
            }

            $this->log("Subscription cancel exception for order #$order_id with code {$e->getCode()}: {$e->getMessage()}");
        }
    }

    private function cancel_transaction($transaction)
    {
        if ($transaction['status'] !== 'RUNNING' ) {
            return;
        }

        $order_id = $transaction['orderDetails']['orderId'];

        $this->log("Cancelling transaction with UUID #{$transaction['uuid']} for order #$order_id.");

        $key = $this->testmode ? $this->get_general_option('test_private_key') : $this->get_general_option('prod_private_key');

        try {
            $params = array(
                'uuid' => $transaction['uuid'],
                'resolutionMode' => 'CANCELLATION_ONLY'
            );

            $client = new MicuentawebRest(
                $this->get_general_option('rest_url'),
                $this->get_general_option('site_id'),
                $key
            );

            $result = $client->post('V4/Transaction/Cancel', json_encode($params));
            MicuentawebRestTools::checkResult($result, 'CANCELLED');
        } catch (Exception $e) {
            if (is_admin()) { // Show error message only if it's made on backend.
                set_transient('micuentaweb_cancelled_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            }  else {
                wc_add_notice( __('An error occurred during the cancellation of the subscription. Please contact customer support.', 'woo-micuentaweb-payment'), 'notice' );
            }

            $this->log("Transaction cancel exception for order #$order_id with code {$e->getCode()}: {$e->getMessage()}.");
        }
    }

    public function update_online_subscription($subscription_id, $order_id)
    {
        $key = $this->testmode ? $this->get_general_option('test_private_key') : $this->get_general_option('prod_private_key');
        if (! $key) {
            set_transient('micuentaweb_update_subscription_error_msg', sprintf(__('Subscription is updated only in WooCommerce. Please, consider making necessary changes in %s Back Office.', 'woo-micuentaweb-payment'), 'Izipay'));
            $this->log("Subscription #{$subscription_id} for order #$order_id cannot be updated on gateway: private key is not configured.");
            return;
        }

        $this->log("Updating subscription #{$subscription_id} for order #$order_id.");

        $order = new WC_Order((int) $order_id);

        $cust_id = self::get_order_property($order, 'user_id');
        $saved_identifier = $this->get_cust_identifier($cust_id);

        // Re-generate subscriptions data from updated order.
        $info = $this->subscriptions_handler ? $this->subscriptions_handler->subscription_info($order) : null;
        if (! is_array($info) || empty($info)) {
            set_transient('micuentaweb_update_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            $this->log("Empty subscription info returned for order #$order_id. Cannot update subscription #{$subscription_id}.");
            return;
        }

        // Get subscription effect date in ISO8601 format.
        $date_time = strtotime($info['effect_date']);
        if ($date_time < time()) {
            set_transient('micuentaweb_update_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            $this->log("Cannot update subscription #{$subscription_id} for order #$order_id. Effect date has passed.");
            return;
        }

        $currency = MicuentawebApi::findCurrencyByAlphaCode(get_woocommerce_currency());

        $params = array(
            'subscriptionId' => get_post_meta($order_id, 'Subscription ID', true),
            'paymentMethodToken' => $saved_identifier,
            'amount' => $currency->convertAmountToInteger($info['amount']),
            'currency' => $currency->getAlpha3(),
            'effectDate' => date(DateTime::ATOM, $date_time),
            'rrule' => $this->get_rrule($info)
        );

        // Initial amount.
        if (isset($info['init_amount']) && $info['init_amount'] && isset($info['init_number']) && $info['init_number']) {
            $params['initialAmount'] = $currency->convertAmountToInteger($info['init_amount']);
            $params['initialAmountNumber'] = $info['init_number'];
        }

        try {
            $client = new MicuentawebRest(
                $this->get_general_option('rest_url'),
                $this->get_general_option('site_id'),
                $key
            );

            $result = $client->post('V4/Subscription/Update', json_encode($params));
            MicuentawebRestTools::checkResult($result);

            //Subscription cancelled successfully.
            $this->log("Subscription #{$subscription_id} updated successfully for order #$order_id.");
        } catch (Exception $e) {
            set_transient('micuentaweb_update_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            $this->log("Subscription update exception for order #$order_id with code {$e->getCode()}: {$e->getMessage()}");
        }
    }

    private function get_order_details($order_id)
    {
        $key = $this->testmode ? $this->get_general_option('test_private_key') : $this->get_general_option('prod_private_key');
        $client = new MicuentawebRest(
            $this->get_general_option('rest_url'),
            $this->get_general_option('site_id'),
            $key
        );

        $params = array(
            'orderId' => $order_id,
            'operationType' => 'DEBIT'
        );

        try {
            $get_order_response = $client->post('V4/Order/Get', json_encode($params));
            MicuentawebRestTools::checkResult($get_order_response);

            // Order transactions organized by sequence numbers.
            $trans_by_sequence = array();
            foreach ($get_order_response['answer']['transactions'] as $transaction) {
                $sequence_number = $transaction['transactionDetails']['sequenceNumber'];
                // Unpaid transactions are not considered.
                if ($transaction['status'] !== 'UNPAID') {
                    $trans_by_sequence[$sequence_number] = $transaction;
                }
            }

            ksort($trans_by_sequence);
            return array_reverse($trans_by_sequence);
        } catch (Exception $e) {
            set_transient('micuentaweb_cancelled_subscription_error_msg', sprintf(__('An error has occurred during the cancellation or update of the subscription. Please consult the %s logs for more details.', 'woo-micuentaweb-payment'), 'Izipay'));
            $this->log("Order transactions processing exception for order #$order_id with code {$e->getCode()}: {$e->getMessage()}.");
        }
    }

    public function micuentaweb_order_needs_payment($is_active, $order)
    {
        global $woocommerce;

        if (($order->get_total() == 0) && (self::get_order_property($order, 'payment_method') === $this->id)) {
            return $this->subscriptions_handler && $this->subscriptions_handler->cart_contains_subscription($woocommerce->cart);
        }

        return $is_active;
    }

    public function micuentaweb_display_subscription_error_msg($column)
    {
        $micuentaweb_cancelled_subscription_error_msg = get_transient('micuentaweb_cancelled_subscription_error_msg');
        if ($micuentaweb_cancelled_subscription_error_msg) {
            delete_transient('micuentaweb_cancelled_subscription_error_msg');
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    if (! jQuery('#micuentaweb_cancelled_subscription_error').length) {
                        jQuery('a.page-title-action').after('<div id="micuentaweb_cancelled_subscription_error" class="error notice is-dismissible"><p><?php echo addslashes($micuentaweb_cancelled_subscription_error_msg); ?></p><button type="button" class="notice-dismiss" onclick="this.parentElement.remove()"><span class="screen-reader-text"><?php echo esc_html__( 'Dismiss this notice.', 'woocommerce' )  ?></span></button></div>');
                    }
                });
            </script>
            <?php
        }
    }

    public function micuentaweb_admin_head_script()
    {
        parent::micuentaweb_admin_head_script();
        ?>
        <script type="text/javascript">
            //<!--
            function micuentawebShowSubscriptionsWarningMessage() {
                var subscriptions = jQuery('#<?php echo esc_attr($this->get_field_key('subscriptions')); ?> option:selected').val();
                if ((<?php echo MicuentawebTools::is_plugin_not_active('woocommerce-subscriptions/woocommerce-subscriptions.php'); ?>) && (subscriptions === 'wc-subscriptions') &&
                    ! confirm('<?php echo sprintf(__('Warning! %s plugin must be installed and activated for the subscription payment method to work.', 'woo-micuentaweb-payment'), 'WooCommerce Subscriptions')?>')) {
                    micuentawebResetSubscriptionsField();
                } else if ((<?php echo MicuentawebTools::is_plugin_not_active('subscriptio/subscriptio.php'); ?>) && (subscriptions === 'subscriptio') &&
                    ! confirm('<?php echo sprintf(__('Warning! %s plugin must be installed and activated for the subscription payment method to work.', 'woo-micuentaweb-payment'), 'Subscriptio')?>')) {
                    micuentawebResetSubscriptionsField();
                } else if ((subscriptions === 'custom') &&
                    ! confirm('<?php echo __('Warning! You have to implement a subscriptions adapter for our plugin.', 'woo-micuentaweb-payment')?>')) {
                    micuentawebResetSubscriptionsField();
                }
            }

            function micuentawebResetSubscriptionsField() {
                jQuery('#<?php echo esc_attr($this->get_field_key('subscriptions')); ?>').val("<?php echo esc_attr($this->get_option('subscriptions')); ?>");
                jQuery('#<?php echo esc_attr($this->get_field_key('subscriptions')); ?>').trigger('change');
            }
             //-->
        </script>
<?php
    }

    /**
     * Admin panel options.
     */
    public function admin_options()
    {
        if ($this->get_option('subscriptions') === 'wc-subscriptions'
            && MicuentawebTools::is_plugin_not_active('woocommerce-subscriptions/woocommerce-subscriptions.php') === 'true') {
            echo '<div class="inline error"><p><strong>' . sprintf(__('Warning! %s plugin must be installed and activated for the subscription payment method to work.', 'woo-micuentaweb-payment'), 'WooCommerce Subscriptions') . '</strong></p></div>';
        }

        parent::admin_options();
    }

    /**
     * Process the payment and return the result.
     **/
    public function process_payment($order_id)
    {
        global $woocommerce;

        if (isset($_POST['micuentawebsubscription_old_pm'])) {
            set_transient($this->id . '_change_payment_' . $order_id, $_POST['micuentawebsubscription_old_pm']);
        }

        $order = new WC_Order($order_id);

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

    private function get_rrule($subscription_info) {
        $desc = 'RRULE:FREQ=' . $subscription_info['frequency'] . ';INTERVAL=' . $subscription_info['interval'];

        $date_time = strtotime($subscription_info['effect_date']);
        $array_date = getdate($date_time);
        if (in_array($subscription_info['frequency'], array('MONTHLY', 'YEARLY')) && ((int) $array_date['mday'] > 28)) {
            $desc .= ';BYMONTHDAY=28,29,30,31;BYSETPOS=-1';

            if ($subscription_info['frequency'] === 'YEARLY') {
                $desc .= ';BYMONTH=' . $array_date['mon'];
            }
        }

        if (isset($subscription_info['end_date']) && $subscription_info['end_date']) {
            $desc .= ';UNTIL=' . $subscription_info['end_date'];
        }

        return $desc;
    }
}
