<?php 

class Response {

    function index(){
     
      // if ( ! defined( 'ABSPATH' ) ) { exit; }
error_reporting(0);
require('../../../wp-load.php');
// require('woocommerce-gateway-payme.php');
add_action('plugins_loaded', 'woocommerce_payme_init', 0);
add_filter('show_admin_bar', '__return_false');
get_header( 'home' );

$payme  = new WC_payme();


$authorizationResult = trim($_POST['authorizationResult']) == "" ? "-" : $_POST['authorizationResult'];
$authorizationCode = trim($_POST['authorizationCode']) == "" ? "-" : $_POST['authorizationCode'];
$errorCode = trim($_POST['errorCode']) == "" ? "-" : $_POST['errorCode'];
$errorMessage = trim($_POST['errorMessage']) == "" ? "-" : $_POST['errorMessage'];
$bin = trim($_POST['bin']) == "" ? "-" : $_POST['bin'];
$brand = trim($_POST['brand']) == "" ? "-" : $_POST['brand'];
$paymentReferenceCode = trim($_POST['paymentReferenceCode']) == "" ? "-" : $_POST['paymentReferenceCode'];
$reserved1 = trim($_POST['reserved1']) == "" ? "-" : $_POST['reserved1'];
$reserved3 = trim($_POST['reserved3']) == "" ? "-" : $_POST['reserved3'];
$reserved4 = trim($_POST['reserved4']) == "" ? "-" : $_POST['reserved4'];
$reserved10 = trim($_POST['reserved10']) == "" ? "-" : $_POST['reserved10'];
$purchaseCurrencyCode = trim($_POST['purchaseCurrencyCode']) == "" ? "-" : $_POST['purchaseCurrencyCode'];

if ($purchaseCurrencyCode == '840') {
  $keywallet = $payme->settings['ALIGNET_KEYWALLET_DOLARES'];
  $acquirerId = $payme->settings['ALIGNET_IDACQUIRER_DOLARES'];
  $idCommerce = $payme->settings['ALIGNET_IDCOMMERCE_DOLARES'];
  $key = $payme->settings['ALIGNET_KEY_DOLARES'];
}
else
{
  $keywallet = $payme->settings['ALIGNET_KEYWALLET'];
  $acquirerId = $payme->settings['ALIGNET_IDACQUIRER'];
  $idCommerce = $payme->settings['ALIGNET_IDCOMMERCE'];
  $key = $payme->settings['ALIGNET_KEY'];

}


        $currName = '';
        $iso_code = $purchaseCurrencyCode ;
        switch ($iso_code) {
            case '840':
                 $currName= 'USD ';
                break;
            case '604':
                 $currName= ' S/ ';
                break;
             case '068':
                 $currName= ' BS ';
                break;
             case '188':
                 $currName= 'CRC ';
                break;
            default:
                 $currName= 'USD';
                break;
        }


$fechaHora = date("d/m/Y");

$purchaseOperationNumber = $_POST['purchaseOperationNumber'];
// $purchaseOperationNumber = str_pad($purchaseOperationNumber, 5, "0", STR_PAD_LEFT);
$purchaseAmount = $_POST['purchaseAmount'];
$purchaseCurrencyCode = $_POST['purchaseCurrencyCode'];
$purchaseVerification = $_POST['purchaseVerification'];
if (isset($_POST['plan'])){
  $plan = $_POST['plan'];  
}else{
    $plan = "";
}

if (isset($_POST['cuota'])){
 $cuota = $_POST['cuota'];
}else{
   $cuota = "";
}


if (isset($_POST['montoAproxCuota'])){
$montoAproxCuota = $_POST['montoAproxCuota'];
}else{
  $montoAproxCuota ="";
}


 if ($authorizationResult == "00") {
$resultadoOperacion = "Transacción Autorizada.";

}else if ($authorizationResult == '03'){
 $resultadoOperacion = "Transacción Autorizada.";

}else if ($authorizationResult == '04'){

 $resultadoOperacion = "Transacción Autorizada.";
}else if ($authorizationResult == '05'){
  $resultadoOperacion = "Operación Rechazada.";
}
else if ($authorizationResult == '01'){
  $resultadoOperacion = "Operación Denegada.";
}
else{
  $resultadoOperacion = "Error de Comunicación - Operación Cancelada.";
}



$numeroCip  = trim($_POST['numeroCip']) == "" ? "-" : $_POST['numeroCip'];
$messageOperacion = "";

$generedPurchaseVerification = '';
if (phpversion() >= 5.3) {
    $generedPurchaseVerification = openssl_digest(
    $acquirerId.$idCommerce.$purchaseOperationNumber.$purchaseAmount.$purchaseCurrencyCode
    .$_POST['authorizationResult'].$key,
    'sha512'
    );
} else {
    $generedPurchaseVerification = hash(
    'sha512',
    $acquirerId.$idCommerce.$purchaseOperationNumber.$purchaseAmount.$purchaseCurrencyCode
    .$_POST['authorizationResult'].$key
    );
}



?>



<?php



// echo "<div class='content-area'>";


    $id  = $_POST['purchaseOperationNumber'];
    $order = new WC_Order($id);
    // $address    = $order->get_billing_address();
    $customer_id = get_current_user_id();


    global $wpdb;



      $wpdb->insert($wpdb->prefix .'payme_response', array(
        
                'id_order' => $_POST['purchaseOperationNumber'],
                'authorizationResult' => $_POST['authorizationResult'],
                'authorizationCode' => $_POST['authorizationCode'],
                'errorCode' => $_POST['errorCode'],
                'errorMessage' => $_POST['errorMessage'],
                'bin' => $_POST['bin'],
                'brand' => $_POST['brand'],
                'paymentReferenceCode' => $_POST['paymentReferenceCode'],
                'purchaseOperationNumber' => $_POST['purchaseOperationNumber'],
                'purchaseAmount' => $_POST['purchaseAmount'],
                'purchaseCurrencyCode' => $_POST['purchaseCurrencyCode'],
                'purchaseVerification' => $_POST['purchaseVerification'],
                'plan' => $_POST['plan'],
                'cuota' => $_POST['cuota'],
                'montoAproxCuota' => $_POST['montoAproxCuota'],
                'resultadoOperacion' => $_POST['resultadoOperacion'],
                'paymethod' => $_POST['paymethod'],
                'fechaHora' => $_POST['fechaHora'],
                'reserved1' => $_POST['reserved1'],
                'reserved2' => $_POST['reserved2'],
                'reserved3' => $_POST['reserved3'],
                'reserved4' => $_POST['reserved4'],
                'reserved5' => $_POST['reserved5'],
                'reserved6' => $_POST['reserved6'],
                'reserved7' => $_POST['reserved7'],
                'reserved8' => $_POST['reserved8'],
                'reserved9' => $_POST['reserved9'],
                'reserved10' => $_POST['reserved10'],
                'numeroCip' =>  $_POST['numeroCip'],
                
      ));

    add_action( 'woocommerce_email_before_order_table', array( $order, 'email_instructions' ), 10, 3 );

  
    $result = $this->process_payment($id,$generedPurchaseVerification,$purchaseVerification,$authorizationResult);


    ?>

    <div class="woocommerce" style="width: 70%;margin-right:auto;margin-left:auto">
<div class="woocommerce-order">

  
    
      <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Resultado de la Operación : <strong> <?php echo $resultadoOperacion; ?> </strong></p>

      <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

        <li class="woocommerce-order-overview__order order">
          Número del pedido:          <strong><?=$purchaseOperationNumber; ?></strong>
        </li>

        <li class="woocommerce-order-overview__date date">
          Fecha:          <strong><?=$fechaHora; ?></strong>
        </li>

                  <li class="woocommerce-order-overview__email email">
            Email:            <strong><?php echo $_POST['shippingEmail'] ?></strong>
          </li>
        
        <li class="woocommerce-order-overview__total total">
          Total:          <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo  $currName; ?></span><?php echo number_format(($purchaseAmount/100),2); ?></span></strong>
        </li>

                  <li class="woocommerce-order-overview__payment-method method">
           Tarjeta           <strong><?php echo $brand; ?></strong>
          </li>
          <li class="woocommerce-order-overview__payment-method method">
           Número Tarjeta           <strong><?php echo $paymentReferenceCode; ?></strong>
          </li>
        
      </ul>

    
        <section class="woocommerce-order-details">
  
  <h2 class="woocommerce-order-details__title">Detalles del pedido</h2>

  <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

    <thead>
      <tr>
        <th class="woocommerce-table__product-name product-name">Producto</th>
        <th class="woocommerce-table__product-table product-total">Total</th>
      </tr>
    </thead>

    <tbody>
      <tr class="woocommerce-table__line-item order_item">

  <td class="woocommerce-table__product-name product-name">
     <strong class="product-quantity"><?php echo $_POST['descriptionProducts'] ?></strong>  </td>

  <td class="woocommerce-table__product-total product-total">
    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo  $currName; ?></span><?php echo number_format(($purchaseAmount/100),2); ?></span>  </td>

</tr>

    </tbody>

    <tfoot>

                    <tr>
            <th scope="row">Total:</th>
            <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?php echo  $currName; ?></span><?php echo number_format(($purchaseAmount/100),2); ?></span></td>
          </tr>
                    </tfoot>
  </table>

  </section>

<section class="woocommerce-customer-details">

  
  <h2 class="woocommerce-column__title">Dirección de facturación</h2>

  <address>
    <?php echo $_POST['billingFirstName'].' '.$_POST['billingLastName']  ?><br><?php  echo $_POST['billingAddress'].'<br>'.$_POST['billingCity'].'<br>'.$_POST['billingState'].'<br>'.$_POST['billingZip'].'<br>'.$_POST['billingCountry'];?>
          <p class="woocommerce-customer-details--phone"><?php echo $_POST['billingPhone']; ?></p>
    
          <p class="woocommerce-customer-details--email"><?php echo $_POST['billingEmail'] ?></p>
      </address>

  
  
</section>

  
</div>
</div>



    <p class="return-to-shop">
        <a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
            <?php _e( 'Return To Shop', 'woocommerce' ) ?>
        </a>
    </p>

    <?php
    get_footer();
    }

    function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
        
            if ( $this->instructions && ! $sent_to_admin && $this->id === $order->payment_method && $order->has_status( 'on-hold' ) ) {
                echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
            }
        }

     function process_payment( $order_id,$generedPurchaseVerification,$purchaseVerification,$authorizationResult ) {

            $order = wc_get_order( $order_id );

            $status = 'wc-' === substr( $order->order_status, 0, 3 ) ? substr( $order->order_status, 3 ) : $order->order_status;

           
            if ($generedPurchaseVerification == $purchaseVerification) {
            
                    if ($authorizationResult == "00") {
                        
                        $order->update_status( 'wc-completed', __(  'Transacción Completada', $order->domain ) );
                        $order->reduce_order_stock();
                        $resultadoOperacion = "Transacción Autorizada.";

                    }else if ($authorizationResult == '03'){
                         $resultadoOperacion = "Transacción Autorizada.";

                    }else if ($authorizationResult == '04'){

                         $resultadoOperacion = "Transacción Autorizada.";
                    }else if ($authorizationResult == '05'){
                         $order->update_status( 'cancelled', __( 'La Transacción fue rechazada.', $order->domain ) );
                         $resultadoOperacion = "Operación Rechazada.";
                    }
                    else if ($authorizationResult == '01'){
                         $order->update_status( 'cancelled', __( 'La Transacción fue denegada.', $order->domain ) );
                          $resultadoOperacion = "Operación Denegada.";
                    }
                    else {

                    }
          
                 
            }

            else if($purchaseVerification == '')

            {

                   if ($authorizationResult == '03'){
                         $resultadoOperacion = "Transacción Autorizada.";

                    }else if ($authorizationResult == '04'){

                         $resultadoOperacion = "Transacción Autorizada.";
                    }else if ($authorizationResult == '05'){
                         $order->update_status( 'cancelled', __( 'La Transacción fue rechazada.', $order->domain ) );
                         $resultadoOperacion = "Operación Rechazada.";
                    }
                    else if ($authorizationResult == '01'){
                         $order->update_status( 'cancelled', __( 'La Transacción fue denegada.', $order->domain ) );
                          $resultadoOperacion = "Operación Denegada.";
                    }
                    else {

                    }

            }
            else{

                 $order->update_status( 'Failed', __( 'Transacción Invalida. Los datos fueron alterados en el proceso de respuesta. Contactarse con el comercio.', $order->domain ) );
    
            }

            WC()->cart->empty_cart();
            // $order->get_return_url( $order );
        }

   

}

 $response = new response();
 $response->index();

 ?>
