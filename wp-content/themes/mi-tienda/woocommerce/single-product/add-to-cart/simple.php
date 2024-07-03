<?php
//
//ky1ar
//

defined( 'ABSPATH' ) || exit;
global $product;

$valid_show_aditions = get_field('ajustes_adicionales');
if ( ! $product->is_purchasable() ) { return; }

echo wc_get_stock_html( $product ); // WPCS: XSS ok.


if ( $product->is_in_stock() ) {
	
	do_action( 'woocommerce_before_add_to_cart_form' );
	echo '<form class="cart" action="' .esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ). '" method="post" enctype="multipart/form-data">';
		do_action( 'woocommerce_before_add_to_cart_button' );
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);
		do_action( 'woocommerce_after_add_to_cart_quantity' );
		echo '<div class="buttons--group woocommerce--buttons">';
			
			$blq = get_field( 'bloque_unico' );
			if ( $blq [ 'bloque' ] ) {
				echo '<a class="btn" id="k11-btn-add" href="/productos/impresoras3d/?add-to-cart=' .$product->get_id().'">Añadir al carrito</a>';
			} else {
				echo '<button type="submit" name="add-to-cart" value="' .esc_attr( $product->get_id() ). '" class="single_add_to_cart_button btn">Añadir al carrito</button>';
			}
			 
			echo '<a class="btn btn--only--text primary" href="//api.whatsapp.com/send?phone=51982001288" target="_blank">Comprar por Whatsapp</a>
		</div>';
	
		do_action( 'woocommerce_after_add_to_cart_button' );
	echo '</form>';
	do_action( 'woocommerce_after_add_to_cart_form' );
	
	
		echo '<div id="k11-met">
			<h4>Métodos de entrega</h4>
			<div class="met-cnt">';
			$met_ent = get_field('metodos_de_entrega');
			$met_dat = [ 
				['me1', 'Despacho Programado', 'Envíos a todo el Perú. Precios disponibles en el carrito.'],
				['me3', 'Retiro en Tienda', 'Disponible para recojo en tienda en 24 horas desde la compra.'],
				['me2', 'Compra en Tienda', 'Puedes comprar el producto en Calle Javier Fernandez 262 - Miraflores.'],
			];
			$key_dat = ['one', 'two', 'thr'];

			$key = 0;
			$fch = get_field('principal');
			foreach ( $met_ent as $value ) {
				if ( !$fch [ 'stock' ] ) $value = 0;
				echo '<div id="k11-met-' . $key_dat [ $key ] . '" class="met-itm ' .( $value == 1 ? '':'itm-off' ). '">
					<img src="http://tiendakrear3d.com/wp-content/uploads/kyro11/svg/' . $met_dat[ $key ][ 0 ] . '.svg">
					<div>
						<h5>' . $met_dat[ $key ][ 1 ] . '</h5>
						<p>' . ( $value == 1 ? $met_dat[ $key ][ 2 ] :'No disponible' ) . '</p>
					</div>
				</div>';
				$key++;
			}	
			echo '</div>
		</div>';
	
}

if (!$product->is_in_stock()) {
	if ($valid_show_aditions['mostrar_el_boton_de_cotiza']) {
		echo '<div class="buttons--group woocommerce--buttons">
			<a class="single_add_to_cart_button btn" href="' .home_url(). '/contacto?producto=' .$product->get_name(). '" data-product="' .$product->get_id(). '">Cotizar</a>
			<a class="btn btn--only--text primary" href="//api.whatsapp.com/send?phone=51982001288" target="_blank">Cotizar por Whatsapp</a>
		</div>';
	}
}
?>