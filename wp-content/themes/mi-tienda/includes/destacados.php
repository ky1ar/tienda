<?php
$orderby    = 'name';
$order      = 'asc';
$hide_empty = false;

// The query
$query = new WP_Query(array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => 6,
    'orderby'             => $orderby,
    'order'               => $order == 'asc' ? 'asc' : 'desc',
    'meta_query'          => array(
        array(
            'key'   => 'destacar_producto',
            'value' => '1',
        ),
    ),
));
?>

<?php $count = $query->found_posts; ?>

<section class="section productos-destacados <?php if($count == 0) {echo 'd-none';} ?>" id="productos-destacados">

	<div class="container container--section">

		<div class="titulo--principal">

			<h1>
				Productos destacados
			</h1>

		</div>

		<div class="row">

			<?php if ($query->have_posts()) {?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-6 col-md-3 mb-3">
						<?php  global $product; ?>
		          		<?php include get_theme_file_path('/includes/tienda/producto.php');?>

		          	</div>
				 <?php endwhile; ?>
			<?php } else {?>
		      <div class="__empty_text uk-text-center">
		      	 	<?php echo __('No hay productos destacados por el momento'); ?>
		      </div>

		<?php }?>

		</div>

	</div>
</section>
<?php wp_reset_query(); ?>