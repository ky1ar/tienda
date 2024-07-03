<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>" >
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		 <?php 
    if ( preg_match( '/Culqi/', $gateway->get_title() ) === 1 ) {
        echo 'Culqi: Tarjetas de Crédito / Débito ';
        // Agregar la primera imagen al lado del texto para Culqi
        echo '<img src="https://tiendakrear3d.com/wp-content/uploads/2024/03/list-cards.svg" alt="Medios de pago">';
    } else {
        echo $gateway->get_title();
        echo $gateway->get_icon(); // Mostrar el icono solo si no es Culqi
    }
    ?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
	<?php if ( preg_match( '/Mercado Pago/', $gateway->get_title() ) === 1 ){
				echo '<p style="margin: 0">Cuando realices eI pedido se abrirá una ventana emergente donde podrás verificar el total de tu compra y podrás ingresar los datos de tu tarjeta como invitado o iniciando sesión con tu cuenta de Mercado Pago. Si utilizas una tarjeta de crédito tendrás la opción de seleccionar las cuotas que desees luego de digitar los datos respectivos.</p>
<p style="margin-top: 0.5rem"><img style="margin-right: 0.5rem" src="https://tiendakrear3d.com/wp-content/uploads/2024/03/switch.png" height="20" width="20">Recuerda activar tu tarjeta para compras por internet desde la plataforma de tu banco.</p>';
			} elseif ( preg_match( '/Culqi/', $gateway->get_title() ) === 1 ){
						echo '<p style="margin: 0">Revisa el monto total de tu compra en el recuadro anterior e ingresa luego todos los datos de tu tarjeta. Si utilizas una tarjeta de crédito tendrás la opción de seleccionar las cuotas que desees luego de digitar los datos respectivos.</p>
		<p style="margin-top: 0.5rem"><img style="margin-right: 0.5rem" src="https://tiendakrear3d.com/wp-content/uploads/2024/03/switch.png" height="20" width="20">Recuerda activar tu tarjeta para compras por internet desde la plataforma de tu banco.</p>'; 
	} elseif ( preg_match( '/Yape/', $gateway->get_title() ) === 1 ){
						echo '<p style="height: 310px;"> 
<img src="https://tiendakrear3d.com/wp-content/uploads/2024/04/yapelog_24.webp" width="280px" height="400px" align="right" style="margin-top: -30px;"> Escanea el código QR con la billetera virtual de tu preferencia o ingresa el número <strong>996201441</strong> a nombre de Fabricaciones Digitales del Perú SA, digita el monto exacto a transferir y una vez completado el pago, envía la constancia a nuestros asesores por WhatsApp. No olvides darle clic a realizar pedido para finalizar tu compra.<br><br> 
<img src="https://tiendakrear3d.com/wp-content/uploads/2024/04/info_24.png" width="20px" height="20px" style="vertical-align: middle; margin-right: 4px; margin-left: 0;"> Los celulares de nuestros asesores y el número del pedido los podrás visualizar en la siguiente página.
</p>';
			} elseif ( preg_match( '/Izipay/', $gateway->get_title() ) === 1 ){
				echo '<p style="margin: 0">Revisa el monto total de tu compra en el recuadro anterior e ingresa luego todos los datos de tu tarjeta. Si utilizas una tarjeta de crédito tendrás la opción de seleccionar las cuotas que desees luego de digitar los datos respectivos.</p>
<p style="margin-top: 0.5rem"><img style="margin-right: 0.5rem" src="https://tiendakrear3d.com/wp-content/uploads/2024/03/switch.png" height="20" width="20">Recuerda activar tu tarjeta para compras por internet desde la plataforma de tu banco.</p>
'; 
				$gateway->payment_fields(); 
			} else $gateway->payment_fields(); 
			?>
		</div>
	<?php endif; ?>
</li>
<!--<split-payment-decision subscription-key="1bc471a425514f32878506da4a08cb9d" amount="1200" logo-url="https://ky1aruser.tiendakrear3d.com/wp-content/uploads/2021/01/LOGO-300x90.jpg" currency="PEN"></split-payment-decision>-->
