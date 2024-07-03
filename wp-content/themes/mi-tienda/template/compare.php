<?php
/**
 * Template Name: Comparar
 *
 */
get_header();?>

<?php
global $post;
$post_slug = $post->post_name;
?>

<?php
$products = false;
if ($_GET['items']) {
    $products = explode(',', $_GET['items']);
} else {
    $products = false;
}
?>


<?php if (count($products) > 1): ?>


<?php

$args = array(
    'post_type' => 'product',
    'post__in'  => $products,
);
$query = new WP_Query($args);
?>

<?php $array_products = array();?>

<?php if ($query->have_posts()): ?>

        <?php while ($query->have_posts()): $query->the_post();?>
                        <?php global $product;?>
                        <?php
    $datos_comparacion = get_field('datos_de_comparacion');
    $product_image     = wp_get_attachment_image_src($product->get_image_id(), 'large');
    $temp_array        = array(
        'id'                            => $product->get_id(),
        'nombre'                        => $product->get_name(),
        'imagen'                        => ($product_image) ? $product_image[0] : null,
        'url'                           => get_permalink($product->get_id()),
        'add_cart'                      => $product->add_to_cart_url(),
        'price'                         => 's/ ' . $product->get_price(),
        'tecnologia'                    => (!empty($datos_comparacion['tecnologia']) ? $datos_comparacion['tecnologia'] : '-'),
        'volumen_de_impresion'          => (!empty($datos_comparacion['volumen_de_impresion']) ? $datos_comparacion['volumen_de_impresion'] : '-'),
        'resolucion'                    => (!empty($datos_comparacion['resolucion_de_capa']) ? $datos_comparacion['resolucion_de_capa'] : '-'),
        'velocidad_max'                 => (!empty($datos_comparacion['velocidad_max']) ? $datos_comparacion['velocidad_max'] : '-'),
        'tipo_de_extrusor'              => (!empty($datos_comparacion['tipo_de_extrusor']) ? $datos_comparacion['tipo_de_extrusor'] : '-'),
        'diametro_de_boquilla'          => (!empty($datos_comparacion['diametro_de_boquilla']) ? $datos_comparacion['diametro_de_boquilla'] : '-'),
        'temperatura_max_de_extrusor'   => (!empty($datos_comparacion['temperatura_max_de_extrusor']) ? $datos_comparacion['temperatura_max_de_extrusor'] : '-'),
        'temperatura_max_de_plataforma' => (!empty($datos_comparacion['temperatura_max_de_plataforma']) ? $datos_comparacion['temperatura_max_de_plataforma'] : '-'),
        'materiales_compatibles'        => (!empty($datos_comparacion['materiales_compatibles']) ? $datos_comparacion['materiales_compatibles'] : '-'),
        'diametro_de_filamento'         => (!empty($datos_comparacion['diametro_de_filamento']) ? $datos_comparacion['diametro_de_filamento'] : '-'),
        'conectividad'                  => (!empty($datos_comparacion['conectividad']) ? $datos_comparacion['conectividad'] : '-'),
        'software_compatibles'          => (!empty($datos_comparacion['software_compatibles']) ? $datos_comparacion['software_compatibles'] : '-'),
        'formatos_compatibles'          => (!empty($datos_comparacion['formatos_compatibles']) ? $datos_comparacion['formatos_compatibles'] : '-'),
        'dimensiones_del_producto'      => (!empty($datos_comparacion['dimensiones_del_producto']) ? $datos_comparacion['dimensiones_del_producto'] : '-'),
        'peso_del_producto'             => (!empty($datos_comparacion['peso_del_producto']) ? $datos_comparacion['peso_del_producto'] : '-'),
        'tipo_de_pantalla'             => (!empty($datos_comparacion['tipo_de_pantalla']) ? $datos_comparacion['tipo_de_pantalla'] : '-'),
        'consumo_electrico'             => (!empty($datos_comparacion['consumo_electrico']) ? $datos_comparacion['consumo_electrico'] : '-'),
        'dimensiones_de_la_caja'        => (!empty($datos_comparacion['dimensiones_de_la_caja']) ? $datos_comparacion['dimensiones_de_la_caja'] : '-'),
        'peso_del_producto'             => (!empty($datos_comparacion['peso_del_producto']) ? $datos_comparacion['peso_del_producto'] : '-'),
        'tipo_de_impresora'             => (!empty($datos_comparacion['tipo_de_impresora']) ? $datos_comparacion['tipo_de_impresora'] : '-'),
        'retomar_impresion'             => (!empty($datos_comparacion['retomar_impresion']) ? $datos_comparacion['retomar_impresion'] : '-'),
        'sensor_de_filamento'           => (!empty($datos_comparacion['sensor_de_filamento']) ? $datos_comparacion['sensor_de_filamento'] : '-'),
        'tipo_de_plataforma'            => (!empty($datos_comparacion['tipo_de_plataforma']) ? $datos_comparacion['tipo_de_plataforma'] : '-'),
        'cantidad_de_extrusores'        => (!empty($datos_comparacion['cantidad_de_extrusores']) ? $datos_comparacion['cantidad_de_extrusores'] : '-'),
        'fuente_de_luz'        => (!empty($datos_comparacion['fuente_de_luz']) ? $datos_comparacion['fuente_de_luz'] : '-'),
    );

    array_push($array_products, $temp_array);
    ?>

                    <?php endwhile;?>

<?php endif;?>

<div class="container py-5 <?php echo $post_slug; ?>">

    <div class="container--krear">

        <div class="table-responsive">

            <table class="table comparator-table " style="width:100%;">

                <tbody>

                    <tr>
                        <td></td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                                <h3 class="nombre">
                                    <?php echo $product['nombre'] ?>
                                </h3>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td></td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="imagen">
                                   <img class="mini_photo" src="<?php echo $product['imagen'] ?>">
                               </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td></td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td class="p-3 text-center">
                                 <div class="price">
                                   <span>
                                       <?php echo $product['price'] ?>
                                   </span>
                               </div>
                               <div class="p-3 d-flex justify-content-center">
                                   <a href="<?php echo $product['add_cart']; ?>" class="btn btn--commerce primary outline add-cart-product" data-product="<?php echo $product['id'] ?>">
                                        Agregar al carrito
                                    </a>
                               </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Tecnología de impresión

                                </span>

                            </div>
                        </td>

                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['tecnologia']) ? $product['tecnologia'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                 Tipo de impresora


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['tipo_de_impresora']) ? $product['tipo_de_impresora'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    
                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Volumen de impresión

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['volumen_de_impresion']) ? $product['volumen_de_impresion'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Resolución de capa

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['resolucion']) ? $product['resolucion'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Velocidad máxima

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['velocidad_max']) ? $product['velocidad_max'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Tipo de extrusor

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['tipo_de_extrusor']) ? $product['tipo_de_extrusor'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                              Cantidad de extrusores


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['cantidad_de_extrusores']) ? $product['cantidad_de_extrusores'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                    Diámetro de boquilla

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['diametro_de_boquilla']) ? $product['diametro_de_boquilla'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                   Diámetro de filamento

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['diametro_de_filamento']) ? $product['diametro_de_filamento'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                   Temperatura máx. de extrusor

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['temperatura_max_de_extrusor']) ? $product['temperatura_max_de_extrusor'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                              Tipo de plataforma


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['tipo_de_plataforma']) ? $product['tipo_de_plataforma'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>

                      <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                   Temperatura máx. de plataforma

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['temperatura_max_de_plataforma']) ? $product['temperatura_max_de_plataforma'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                   Materiales compatibles

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description" uk-tooltip="<?php echo $product['materiales_compatibles'] ?>">

                        <?php echo (!empty($product['materiales_compatibles']) ?  wp_trim_words( $product['materiales_compatibles'], 5, '...' ) : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                Retomar impresión


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['retomar_impresion']) ? $product['retomar_impresion'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                               Sensor de filamento


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['sensor_de_filamento']) ? $product['sensor_de_filamento'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Tipo de pantalla

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['tipo_de_pantalla']) ? $product['tipo_de_pantalla'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


 <tr>


    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Conectividad

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description" uk-tooltip="<?php echo $product['conectividad'] ?>">

 <?php echo (!empty($product['conectividad']) ?  wp_trim_words( $product['conectividad'], 3, '...' ) : '-') ?>
                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Software compatibles

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['formatos_compatibles']) ? $product['formatos_compatibles'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Formatos compatibles

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['formatos_compatibles']) ? $product['formatos_compatibles'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                    <td>
                            <div class="list-descricion">

                                <span class="description">

                                 Consumo eléctrico

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['consumo_electrico']) ? $product['consumo_electrico'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



<tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Dimensiones del producto

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['dimensiones_del_producto']) ? $product['dimensiones_del_producto'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                    <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                  Peso del producto

                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['peso_del_producto']) ? $product['peso_del_producto'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                 Dimensiones de la caja


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['dimensiones_de_la_caja']) ? $product['dimensiones_de_la_caja'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>



                     <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                 Peso de la caja


                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['peso_de_la_caja']) ? $product['peso_de_la_caja'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr>


                   <!--  <tr>
                        <td>
                            <div class="list-descricion">

                                <span class="description">

                                 Fuente de luz
                                </span>

                            </div>
                        </td>
                        <?php foreach ($array_products as $key => $product): ?>
                            <td>
                               <div class="list-descricion gray">

                                    <span class="description">

                        <?php echo (!empty($product['fuente_de_luz']) ? $product['fuente_de_luz'] : '-') ?>

                                    </span>

                                </div>
                            </td>
                        <?php endforeach?>

                    </tr> -->


                </tbody>

            </table>



        </div>

<div class="buttons--back">

                <div class="buttons--group">

                    <button onclick="window.history.back()" class="btn btn--commerce primary">
                        Regresar
                    </button>


                </div>

            </div>

    </div>

</div>


<?php else: ?>

    <div class="container py-5 <?php echo $post_slug; ?>">

        <div class="container--krear">

             <div class="error-pa">

                <span>404</span>

                <p>Creo que no logramos encontrar lo que buscabas</p>

            </div>

        </div>

    </div>

<?php endif;?>


<?php get_footer();?>

