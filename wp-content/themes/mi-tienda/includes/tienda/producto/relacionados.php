<?php $id_p = $product->get_id();?>
<?php
$product       = wc_get_product($id_p);
$title         = $product->get_name();
$terms = $product->get_category_ids();
$related_posts = new WP_Query(array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'fields'         => 'ids',
    'posts_per_page' => 4,
    'exclude'        => array($id_p),
    'tax_query'             => array(
        array(
            'taxonomy'      => 'product_cat',
            'field' => 'term_id',
            'terms'         => $terms,
            'operator'      => 'IN'
        ),
    )
));

if (count($product->get_upsell_ids()) > 0) {
	$related_posts = new WP_Query(array(
	    'post_type'      => 'product',
	    'post_status'    => 'publish',
	    'fields'         => 'ids',
	    'posts_per_page' => 4,
	    'exclude'        => array($id_p),
	    'post__in' 		 => $product->get_upsell_ids(),
	));
}



?>
<?php $id_swiper = randomString(); ?>

<?php $page_option = get_options_page_id('ajustes-generales');?>
<?php $title      = get_field('titulo_de_productos_relacionados_en_detalle_del_producto', $page_option)?>

<section class="kyr-o11-sld">
	<div class="kyr-o11-wrp">
		<?php 
		echo $title;
		?>
		<div class="swiffy-slider slider-item-show4 slider-nav-square slider-nav-dark slider-nav-visible slider-nav-autohide" style="--swiffy-slider-nav-dark:#d16326;">
			<ul class="slider-container">
			<?php if ($related_posts->have_posts()): while ($related_posts->have_posts()): $related_posts->the_post();?>
				<li>
				<?php include get_theme_file_path('/includes/tienda/producto.php'); ?>
				</li>
			<?php endwhile; endif;?>
			<?php wp_reset_query(); ?>
			</ul>
			<button type="button" class="slider-nav" aria-label="Go to previous"></button>
    		<button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>
			
			
		</div>
	</div>
</section>

