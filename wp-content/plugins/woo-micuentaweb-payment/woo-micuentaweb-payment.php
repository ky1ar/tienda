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

/**
 * Plugin Name: Izipay for WooCommerce
 * Description: This plugin links your WordPress WooCommerce shop to the payment gateway.
 * Author: Lyra Network
 * Contributors: Alsacréations (Geoffrey Crofte http://alsacreations.fr/a-propos#geoffrey)
 * Version: 1.10.8
 * Author URI: https://www.lyra.com/
 * License: GPLv2 or later
 * Requires at least: 3.5
 * Tested up to: 6.2
 * WC requires at least: 2.0
 * WC tested up to: 7.6
 *
 * Text Domain: woo-micuentaweb-payment
 * Domain Path: /languages/
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry;
use Lyranetwork\Micuentaweb\Sdk\Refund\Api as MicuentawebRefundApi;
use Lyranetwork\Micuentaweb\Sdk\Refund\OrderInfo as MicuentawebOrderInfo;

define('WC_MICUENTAWEB_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WC_MICUENTAWEB_PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

/* A global var to easily enable/disable features. */
global $micuentaweb_plugin_features;

$micuentaweb_plugin_features = array(
    'qualif' => false,
    'prodfaq' => true,
    'restrictmulti' => false,
    'shatwo' => true,
    'embedded' => true,
    'subscr' => true,
    'support' => true,

    'multi' => false,
    'choozeo' => false,
    'klarna' => false,
    'franfinance' => false
);

/* Check requirements. */
function woocommerce_micuentaweb_activation()
{
    $all_active_plugins = get_option('active_plugins');
    if (is_multisite()) {
        $all_active_plugins = array_merge($all_active_plugins, wp_get_active_network_plugins());
    }

    $all_active_plugins = apply_filters('active_plugins', $all_active_plugins);

    if (! stripos(implode('', $all_active_plugins), '/woocommerce.php')) {
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate ourself.

        // Load translation files.
        load_plugin_textdomain('woo-micuentaweb-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

        $message = sprintf(__('Sorry ! In order to use WooCommerce %s Payment plugin, you need to install and activate the WooCommerce plugin.', 'woo-micuentaweb-payment'), 'Izipay');
        wp_die($message, 'Izipay for WooCommerce', array('back_link' => true));
    }
}
register_activation_hook(__FILE__, 'woocommerce_micuentaweb_activation');

/* Delete all data when uninstalling plugin. */
function woocommerce_micuentaweb_uninstallation()
{
    delete_option('woocommerce_micuentaweb_settings');
    delete_option('woocommerce_micuentawebstd_settings');
    delete_option('woocommerce_micuentawebmulti_settings');
    delete_option('woocommerce_micuentawebchoozeo_settings');
    delete_option('woocommerce_micuentawebklarna_settings');
    delete_option('woocommerce_micuentawebfranfinance_settings');
    delete_option('woocommerce_micuentawebregroupedother_settings');
    delete_option('woocommerce_micuentawebsubscription_settings');
}
register_uninstall_hook(__FILE__, 'woocommerce_micuentaweb_uninstallation');

/* Include gateway classes. */
function woocommerce_micuentaweb_init()
{
    global $micuentaweb_plugin_features;

    // Load translation files.
    load_plugin_textdomain('woo-micuentaweb-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

    if (! class_exists('Micuentaweb_Subscriptions_Loader')) { // Load subscriptions processing mecanism.
        require_once 'includes/subscriptions/micuentaweb-subscriptions-loader.php';
    }

    if (! class_exists('WC_Gateway_Micuentaweb')) {
        require_once 'class-wc-gateway-micuentaweb.php';
    }

    if (! class_exists('WC_Gateway_MicuentawebStd')) {
        require_once 'class-wc-gateway-micuentawebstd.php';
    }

    if ($micuentaweb_plugin_features['multi'] && ! class_exists('WC_Gateway_MicuentawebMulti')) {
        require_once 'class-wc-gateway-micuentawebmulti.php';
    }

    if ($micuentaweb_plugin_features['choozeo'] && ! class_exists('WC_Gateway_MicuentawebChoozeo')) {
        require_once 'class-wc-gateway-micuentawebchoozeo.php';
    }

    if ($micuentaweb_plugin_features['klarna'] && ! class_exists('WC_Gateway_MicuentawebKlarna')) {
        require_once 'class-wc-gateway-micuentawebklarna.php';
    }

    if ($micuentaweb_plugin_features['franfinance'] && ! class_exists('WC_Gateway_MicuentawebFranfinance')) {
        require_once 'class-wc-gateway-micuentawebfranfinance.php';
    }

    if (! class_exists('WC_Gateway_MicuentawebRegroupedOther')) {
        require_once 'class-wc-gateway-micuentawebregroupedother.php';
    }

    if (! class_exists('WC_Gateway_MicuentawebOther')) {
        require_once 'class-wc-gateway-micuentawebother.php';
    }

    if ($micuentaweb_plugin_features['subscr'] && ! class_exists('WC_Gateway_MicuentawebSubscription')) {
        require_once 'class-wc-gateway-micuentawebsubscription.php';
    }

    require_once 'includes/sdk-autoload.php';
    require_once 'includes/MicuentawebRestTools.php';
    require_once 'includes/MicuentawebTools.php';

    // Restore WC notices in case of IFRAME or POST as return mode.
    WC_Gateway_Micuentaweb::restore_wc_notices();
}
add_action('woocommerce_init', 'woocommerce_micuentaweb_init');

function woocommerce_micuentaweb_woocommerce_block_support()
{
    if (class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
        require_once 'includes/MicuentawebTools.php';
        if (! MicuentawebTools::has_checkout_block()) {
            return;
        }

        if (! class_exists('WC_Gateway_Micuentaweb_Blocks_Support')) {
            require_once 'includes/class-wc-gateway-micuentaweb-blocks-support.php';
        }

        add_action(
            'woocommerce_blocks_payment_method_type_registration',
            function(PaymentMethodRegistry $payment_method_registry) {
                $payment_method_registry->register(new WC_Gateway_Micuentaweb_Blocks_Support('micuentawebstd'));
            }
        );
    }
}
add_action('woocommerce_blocks_loaded', 'woocommerce_micuentaweb_woocommerce_block_support');

/* Add our payment methods to WooCommerce methods. */
function woocommerce_micuentaweb_add_method($methods)
{
    global $micuentaweb_plugin_features, $woocommerce;

    $methods[] = 'WC_Gateway_Micuentaweb';
    $methods[] = 'WC_Gateway_MicuentawebStd';

    if ($micuentaweb_plugin_features['multi']) {
        $methods[] = 'WC_Gateway_MicuentawebMulti';
    }

    if ($micuentaweb_plugin_features['choozeo']) {
        $methods[] = 'WC_Gateway_MicuentawebChoozeo';
    }

    if ($micuentaweb_plugin_features['klarna']) {
        $methods[] = 'WC_Gateway_MicuentawebKlarna';
    }

    if ($micuentaweb_plugin_features['franfinance']) {
        $methods[] = 'WC_Gateway_MicuentawebFranfinance';
    }

    if ($micuentaweb_plugin_features['subscr']) {
        $methods[] = 'WC_Gateway_MicuentawebSubscription';
    }

    $methods[] = 'WC_Gateway_MicuentawebRegroupedOther';

    // Since 2.3.0, we can display other payment means as submodules.
    if (version_compare($woocommerce->version, '2.3.0', '>=') && $woocommerce->cart) {
        $regrouped_other_payments = new WC_Gateway_MicuentawebRegroupedOther();

        if (! $regrouped_other_payments->regroup_other_payment_means()) {
            $payment_means = $regrouped_other_payments->get_available_options();
            if (is_array($payment_means) && ! empty($payment_means)) {
                foreach ($payment_means as $option) {
                    $methods[] = new WC_Gateway_MicuentawebOther($option['payment_mean'], $option['label']);
                }
            }
        }
    }

    return $methods;
}
add_filter('woocommerce_payment_gateways', 'woocommerce_micuentaweb_add_method');

/* Add a link to plugin settings page from plugins list. */
function woocommerce_micuentaweb_add_link($links, $file)
{
    global $micuentaweb_plugin_features;

    $links[] = '<a href="' . micuentaweb_admin_url('Micuentaweb') . '">' . __('General configuration', 'woo-micuentaweb-payment') . '</a>';
    $links[] = '<a href="' . micuentaweb_admin_url('MicuentawebStd') . '">' . __('Standard payment', 'woo-micuentaweb-payment') . '</a>';

    if ($micuentaweb_plugin_features['multi']) {
        $links[] = '<a href="' . micuentaweb_admin_url('MicuentawebMulti') . '">' . __('Payment in installments', 'woo-micuentaweb-payment')
            . '</a>';
    }

    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'woocommerce_micuentaweb_add_link', 10, 2);

function micuentaweb_admin_url($id)
{
    global $woocommerce;

    $base_url = 'admin.php?page=wc-settings&tab=checkout&section=';
    $section = strtolower($id); // Method id in lower case.

    // Backward compatibility.
    if (version_compare($woocommerce->version, '2.1.0', '<')) {
        $base_url = 'admin.php?page=woocommerce_settings&tab=payment_gateways&section=';
        $section = 'WC_Gateway_' . $id; // Class name as it is.
    } elseif (version_compare($woocommerce->version, '2.6.2', '<')) {
        $section = 'wc_gateway_' . $section; // Class name in lower case.
    }

    return admin_url($base_url . $section);
}

function woocommerce_micuentaweb_order_payment_gateways($available_gateways)
{
    global $woocommerce;
    $index_other_not_grouped_gateways_ids = array();
    $index_other_grouped_gateway_id = null;
    $gateways_ids = array();
    $index_gateways_ids = 0;
    foreach ($woocommerce->payment_gateways()->payment_gateways as $gateway) {
        if ($gateway->id === 'micuentawebregroupedother') {
            $index_other_grouped_gateway_id = $index_gateways_ids;
        } elseif (strpos($gateway->id, 'micuentawebother_') === 0) {
            $index_other_not_grouped_gateways_ids[] = $index_gateways_ids;
        }

        $gateways_ids[] = $gateway->id;
        $index_gateways_ids ++;
    }

    // Reorder custom Izipay non-grouped other payment means as they appear in WooCommerce backend.
    // And if only they are not already in last position.
    if (! empty($index_other_not_grouped_gateways_ids) && ($index_other_grouped_gateway_id !== reset($index_other_not_grouped_gateways_ids) - 1)) {
        $ordered_gateways_ids = array();
        for ($i = 0; $i < $index_other_grouped_gateway_id; $i++) {
            $ordered_gateways_ids[] = $gateways_ids[$i];
        }

        foreach ($index_other_not_grouped_gateways_ids as $index_not_grouped_other_id) {
            $ordered_gateways_ids[] = $gateways_ids[$index_not_grouped_other_id];
        }

        for ($i = $index_other_grouped_gateway_id + 1; $i < count($gateways_ids); $i++) {
            if (! in_array($i, $index_other_not_grouped_gateways_ids)) {
                $ordered_gateways_ids[] = $gateways_ids[$i];
            }
        }

        $ordered_gateways = array();
        foreach ($ordered_gateways_ids as $gateway_id) {
            if (isset($available_gateways[$gateway_id])) {
                $ordered_gateways[$gateway_id] = $available_gateways[$gateway_id];
            }
        }

        return $ordered_gateways;
    }

    return $available_gateways;
}
add_filter('woocommerce_available_payment_gateways', 'woocommerce_micuentaweb_order_payment_gateways');

if (! function_exists('ly_saved_cards_link')) {
    function ly_saved_cards_link($menu_links)
    {
        // Add "My payment means".
        $menu_links = array_slice($menu_links, 0, count($menu_links) - 1, true)
        + array('ly_saved_cards' => __('My payment means', 'woo-micuentaweb-payment'))
        + array_slice($menu_links, count($menu_links) - 1, NULL, true);

        return $menu_links;
    }
    add_filter('woocommerce_account_menu_items', 'ly_saved_cards_link', 40);
}

if (! function_exists('ly_add_saved_cards_endpoint_query_vars')) {
    function ly_add_saved_cards_endpoint_query_vars($query_vars)
    {
        $query_vars['ly_saved_cards'] = 'ly_saved_cards';

        return $query_vars;
    }
    add_filter('woocommerce_get_query_vars', 'ly_add_saved_cards_endpoint_query_vars');
}

if (! function_exists('ly_change_saved_cards_title')) {
    function ly_change_saved_cards_title($title)
    {
        return __('My payment means', 'woo-micuentaweb-payment');
    }
    add_filter('woocommerce_endpoint_ly_saved_cards_title', 'ly_change_saved_cards_title');
}

if (! function_exists('ly_add_saved_cards_endpoint')) {
    function ly_add_saved_cards_endpoint()
    {
        // Add "ly_saved_cards" endpoint.
        add_rewrite_endpoint('ly_saved_cards', EP_ROOT | EP_PAGES);
    }
    add_action('init', 'ly_add_saved_cards_endpoint');
}

function micuentaweb_my_account_endpoint_content()
{
    global $woocommerce;

    $cust_id = WC_Gateway_Micuentaweb::get_customer_property($woocommerce->customer, 'id');

    $sub_module_saving_cards_ids = array('micuentawebstd', 'micuentawebsubscription');

    $customer_saved_cards = array();
    $column_card_brand =  false;
    foreach ($sub_module_saving_cards_ids as $id) {
        $saved_masked_pan = get_user_meta((int) $cust_id, $id.'_masked_pan', true);
        if ($saved_masked_pan) {
            $card_brand_pos = strpos($saved_masked_pan, '|');
            if ($card_brand_pos) {
                $column_card_brand = true;
                $customer_saved_cards[$id]['card_brand'] = substr($saved_masked_pan, 0, strpos($saved_masked_pan, '|'));
            }

            $expiry_start_pos = strpos($saved_masked_pan, '(');
            $expiry_end_pos = strpos($saved_masked_pan, ')');
            $customer_saved_cards[$id]['card_number'] = substr($saved_masked_pan, $card_brand_pos + 1, $expiry_start_pos - $card_brand_pos - 2);
            $customer_saved_cards[$id]['expiry'] = substr($saved_masked_pan, $expiry_start_pos + 1, $expiry_end_pos - $expiry_start_pos -1);
        }
    }

    if (! empty($customer_saved_cards)) {
        wp_register_style('micuentaweb', WC_MICUENTAWEB_PLUGIN_URL . 'assets/css/micuentaweb.css', array(), WC_Gateway_Micuentaweb::PLUGIN_VERSION);
        wp_enqueue_style('micuentaweb');

        echo '<table id="ly_cards_table" class="shop_table" id ="micuentaweb-customer-card" style="display:none">
                <thead>
                  <tr>';
        if ($column_card_brand) {
            echo '<th>' . __('Type', 'woo-micuentaweb-payment') . '</th>';
        }

        echo      '<th>' . __('Means of payment', 'woo-micuentaweb-payment') . '</th>
                  <th>' . __('Action', 'woo-micuentaweb-payment') . '</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>';

        $table_body = '';
        foreach ($customer_saved_cards as $id => $card) {
            $table_body .= '<tr>';
            if ($column_card_brand) {
                $card_brand_logo = $card['card_brand'];
                $remote_logo = WC_Gateway_Micuentaweb::LOGO_URL . strtolower($card['card_brand']) . '.png';
                if ($card['card_brand']) {
                    $card_brand_logo = '<img src=\"' . $remote_logo. '\""
                           + "alt=\"' . $card['card_brand'] . '\""
                           + "title=\"' . $card['card_brand'] . '\""
                           + "style=\"vertical-align: middle; margin: 0 10px 0 5px; max-height: 30px; display: unset;\">';
                }

                $table_body .= '<td>' . $card_brand_logo . '</td>';
            }

            $table_body .= '<td>' . $card['card_number'] . ' - ' . $card['expiry'] . '</td>';
            $table_body .= '<td><a href=\"javascript: void(0);\" onclick=\"micuentawebConfirmDelete(\'' . $id . '\')\">' . __('Delete', 'woo-micuentaweb-payment') . '</a></td></tr>';
        }

        $delete_card_url = add_query_arg('wc-api', 'WC_Gateway_Micuentaweb_Delete_Saved_Card', home_url('/'));

        echo '<script>
                  jQuery(document).ready(function(){
                      if (jQuery("table[id=\'ly_cards_table\']").length == 2) {
                          jQuery("table[id=\'ly_cards_table\']:last").remove();
                      }

                      if (jQuery("#ly_empty_cards_message").length) {
                          jQuery("#ly_empty_cards_message").remove();
                      }

                      jQuery("#ly_cards_table > tbody:last").append("' . $table_body . '");
                      jQuery("#ly_cards_table").show();
                  });

                  function micuentawebConfirmDelete(id) {
                      if (confirm("' . __('Are you sure you want to delete your saved means of payment? This action is not reversible!', 'woo-micuentaweb-payment') . '")) {
                          jQuery("body").block({
                             message: null,
                             overlayCSS: {
                                 background: "#fff",
                                 opacity: 0.5
                             }
                          });

                          jQuery("div.blockUI.blockOverlay").css("cursor", "default");

                          jQuery.ajax({
                              method: "POST",
                              url: "' . $delete_card_url . '",
                              data: { "id": id },
                              success: function() {
                                  location.reload();
                              }
                          });
                      }
                  }
              </script>';
    } else {
        echo '<div id="ly_empty_cards_message" class="woocommerce-Message woocommerce-Message--info woocommerce-info" style="display:none">'
                  . __('You have no stored payment means.', 'woo-micuentaweb-payment') .
             '</div>
             <script>
                 jQuery(document).ready(function(){
                     if (jQuery("#ly_cards_table").length || jQuery("div[id=\'ly_empty_cards_message\']").length == 2) {
                         jQuery("#ly_empty_cards_message").remove();
                     }

                     if (! jQuery("#ly_cards_table").length) {
                         jQuery("#ly_empty_cards_message").show();
                     }
                 });
             </script>';
    }
}
add_action('woocommerce_account_ly_saved_cards_endpoint', 'micuentaweb_my_account_endpoint_content');

function micuentaweb_send_support_email_on_order($order)
{
    global $micuentaweb_plugin_features;

    $std_payment_method = new WC_Gateway_MicuentawebStd();
    if (substr(WC_Gateway_MicuentawebStd::get_order_property($order, 'payment_method'), 0, strlen('micuentaweb')) === 'micuentaweb') {
        $user_info = get_userdata(1);
        $send_email_url = add_query_arg('wc-api', 'WC_Gateway_Micuentaweb_Send_Email', home_url('/'));

        $micuentaweb_email_send_msg = get_transient('micuentaweb_email_send_msg');
        if ($micuentaweb_email_send_msg) {
            echo $micuentaweb_email_send_msg;

            delete_transient('micuentaweb_email_send_msg');
        }

        $micuentaweb_update_subscription_error_msg = get_transient('micuentaweb_update_subscription_error_msg');

        if ($micuentaweb_plugin_features['support']) {
        ?>
        <script type="text/javascript" src="<?php echo WC_MICUENTAWEB_PLUGIN_URL; ?>assets/js/support.js"></script>
        <contact-support
            shop-id="<?php echo $std_payment_method->get_general_option('site_id'); ?>"
            context-mode="<?php echo $std_payment_method->get_general_option('ctx_mode'); ?>"
            sign-algo="<?php echo $std_payment_method->get_general_option('sign_algo'); ?>"
            contrib="<?php echo MicuentawebTools::get_contrib(); ?>"
            integration-mode="<?php echo MicuentawebTools::get_integration_mode(); ?>"
            plugins="<?php echo MicuentawebTools::get_active_plugins(); ?>"
            title=""
            first-name="<?php echo $user_info->first_name; ?>"
            last-name="<?php echo $user_info->last_name; ?>"
            from-email="<?php echo get_option('admin_email'); ?>"
            to-email="<?php echo WC_Gateway_Micuentaweb::SUPPORT_EMAIL; ?>"
            cc-emails=""
            phone-number=""
            language="<?php echo MicuentawebTools::get_support_component_language(); ?>"
            is-order="true"
            transaction-uuid="<?php echo MicuentawebTools::get_transaction_uuid($order); ?>"
            order-id="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'id'); ?>"
            order-number="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'id'); ?>"
            order-status=<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'status'); ?>
            order-date="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'date_created'); ?>"
            order-amount="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'total') . ' ' . WC_Gateway_MicuentawebStd::get_order_property($order, 'currency'); ?>"
            cart-amount=""
            shipping-fees="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'shipping_total') . ' ' . WC_Gateway_MicuentawebStd::get_order_property($order, 'currency'); ?>"
            order-discounts="<?php echo MicuentawebTools::get_used_discounts($order); ?>"
            order-carrier="<?php echo WC_Gateway_MicuentawebStd::get_order_property($order, 'shipping_method'); ?>"></contact-support>
        <?php
            // Load css and add spinner.
            wp_register_style('micuentaweb', WC_MICUENTAWEB_PLUGIN_URL . 'assets/css/micuentaweb.css', array(),  WC_Gateway_Micuentaweb::PLUGIN_VERSION);
            wp_enqueue_style('micuentaweb');
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
              <?php if ($micuentaweb_plugin_features['support']) { ?>
                jQuery('contact-support').on('sendmail', function(e) {
                    jQuery('body').block({
                        message: null,
                        overlayCSS: {
                            background: '#fff',
                            opacity: 0.5
                        }
                    });

                    jQuery('div.blockUI.blockOverlay').css('cursor', 'default');

                    jQuery.ajax({
                        method: 'POST',
                        url: '<?php echo $send_email_url; ?>',
                        data: e.originalEvent.detail,
                        success: function(data) {
                            location.reload();
                        }
                    });
                });
        <?php
            }

            if ($micuentaweb_update_subscription_error_msg) {
                delete_transient('micuentaweb_update_subscription_error_msg');
        ?>
                jQuery('#lost-connection-notice').after('<div class="error notice is-dismissible"><p><?php echo addslashes($micuentaweb_update_subscription_error_msg); ?></p><button type="button" class="notice-dismiss" onclick="this.parentElement.remove()"><span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', 'woocommerce')  ?></span></button></div>');
        <?php } ?>
            });
        </script>
        <?php
    }
}
// Add contact support link to order details page.
add_action('woocommerce_admin_order_data_after_billing_address', 'micuentaweb_send_support_email_on_order');

function micuentaweb_send_email()
{
    if (isset($_POST['submitter']) && $_POST['submitter'] === 'micuentaweb_send_support') {
        $msg = '';
        if (isset($_POST['sender']) && isset($_POST['subject']) && isset($_POST['message'])) {
            $recipient = WC_Gateway_Micuentaweb::SUPPORT_EMAIL;
            $subject = $_POST['subject'];
            $content = $_POST['message'];
            $headers = array('Content-Type: text/html; charset=UTF-8');

            if (wp_mail($recipient, $subject, $content, $headers)) {
                $msg = '<div class="inline updated"><p><strong>' . __('Thank you for contacting us. Your email has been successfully sent.', 'woo-micuentaweb-payment') . '</strong></p></div>';
            } else {
                $msg = '<div class="inline error"><p><strong>' . __('An error has occurred. Your email was not sent.', 'woo-micuentaweb-payment') . '</strong></p></div>';
            }
        } else {
            $msg = '<div class="inline error"><p><strong>' . __('Please make sure to configure all required fields.', 'woo-micuentaweb-payment') . '</strong></p></div>';
        }

        set_transient('micuentaweb_email_send_msg', $msg);
    }

    echo json_encode(array('success' => true));
    die();
}
// Send support email.
add_action('woocommerce_api_wc_gateway_micuentaweb_send_email', 'micuentaweb_send_email');

/* Retrieve blog_id from POST when this is an IPN URL call. */
require_once 'includes/sdk-autoload.php';
require_once 'includes/MicuentawebRestTools.php';

if (MicuentawebRestTools::checkResponse($_POST)) {
    $answer = json_decode($_POST['kr-answer'], true);
    $data = MicuentawebRestTools::convertRestResult($answer);
    $is_valid_ipn = key_exists('vads_ext_info_blog_id', $data) && $data['vads_ext_info_blog_id'];
} else {
    $is_valid_ipn = key_exists('vads_hash', $_POST) && $_POST['vads_hash'] && key_exists('vads_ext_info_blog_id', $_POST) && $_POST['vads_ext_info_blog_id'];
}

if (is_multisite() && $is_valid_ipn) {
    global $wpdb, $current_blog, $current_site;

    $blog = isset($_POST['vads_ext_info_blog_id']) ? $_POST['vads_ext_info_blog_id'] : $data['vads_ext_info_blog_id'];
    switch_to_blog((int) $blog);

    // Set current_blog global var.
    $current_blog = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $wpdb->blogs WHERE blog_id = %s", $blog)
    );

    // Set current_site global var.
    $network_fnc = function_exists('get_network') ? 'get_network' : 'wp_get_network';
    $current_site = $network_fnc($current_blog->site_id);
    $current_site->blog_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT blog_id FROM $wpdb->blogs WHERE domain = %s AND path = %s",
            $current_site->domain,
            $current_site->path
        )
    );

    $current_site->site_name = get_site_option('site_name');
    if (! $current_site->site_name) {
        $current_site->site_name = ucfirst($current_site->domain);
    }
}

function micuentaweb_online_refund($order_id, $refund_id)
{
    // Check if order was passed with one of micuentaweb submodules.
    $order = new WC_Order((int) $order_id);
    if (substr($order->get_payment_method(), 0, strlen('micuentaweb')) !== 'micuentaweb') {
        return;
    }

    $refund = new WC_Order_Refund((int) $refund_id);

    // Prepare order refund bean.
    require_once 'includes/sdk-autoload.php';
    require_once 'includes/MicuentawebRefundProcessor.php';

    $order_refund_bean = new MicuentawebOrderInfo();
    $order_refund_bean->setOrderRemoteId($order_id);
    $order_refund_bean->setOrderId($order_id);
    $order_refund_bean->setOrderReference($order->get_order_number());
    $order_refund_bean->setOrderCurrencyIsoCode($refund->get_currency());
    $order_refund_bean->setOrderCurrencySign(html_entity_decode(get_woocommerce_currency_symbol($refund->get_currency())));
    $order_refund_bean->setOrderUserInfo(MicuentawebTools::get_user_info());
    $refund_processor = new MicuentawebRefundProcessor();

    $std_payment_method = new WC_Gateway_MicuentawebStd();

    $test_mode = $std_payment_method->get_general_option('ctx_mode') == 'TEST';
    $key = $test_mode ? $std_payment_method->get_general_option('test_private_key') : $std_payment_method->get_general_option('prod_private_key');

    $refund_api = new MicuentawebRefundApi(
        $refund_processor,
        $key,
        $std_payment_method->get_general_option('rest_url'),
        $std_payment_method->get_general_option('site_id'),
        'WooCommerce'
    );

    // Do online refund.
    $refund_api->refund($order_refund_bean, $refund->get_amount());
}

// Do online refund after local refund.
add_action('woocommerce_order_refunded', 'micuentaweb_online_refund', 10 , 2);

function micuentaweb_display_refund_result_message($order_id)
{
    $micuentaweb_online_refund_result = get_transient('micuentaweb_online_refund_result');

    if ($micuentaweb_online_refund_result) {
        echo $micuentaweb_online_refund_result;

        delete_transient('micuentaweb_online_refund_result');
    }
}

// Display online refund result message.
add_action('woocommerce_admin_order_totals_after_discount', 'micuentaweb_display_refund_result_message', 10, 1);
