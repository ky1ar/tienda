<?php
get_header("other");?>
<?php defined('ABSPATH') || exit;?>

<?php include get_theme_file_path('/includes/slidershow.php'); ?>

<?php 
	$page = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
	$args = array(
		'posts_per_page'  => 8,
		'paged'          => $page,
		'post_status'    => 'publish',  
		 'tax_query'      => array(
	      array(
	        	'taxonomy'     => 'category',
	          	'field'        => 'id',
	          	'terms'        => array(get_queried_object_id()),
	          	'operator'     => 'IN'
	      )
	    ),
		'order' => 'DESC'  
	);
	$query = new WP_Query( $args ); 
	$posts = $query->posts;
	$counter = 0;
?>

<?php 
$body_classes = get_body_class();
$special_category_class = 'category-sala-de-prensa';
if (in_array($special_category_class, $body_classes)): ?>
<div class="k11-sec-cat">
        <div class="kyr-o11-wrp kyr-o11-flx-wrp">
            <h1>Sala de Prensa</h1>
			<p style="font-size: 0.9rem;
					max-width: 70rem;
					margin-top: -1rem;
					text-align: center;
					margin-bottom: 2rem;
					margin: -1rem auto 2rem auto;
					padding: 0 1rem;"
			   >¡Visita nuestra sala de prensa! Estamos presentes en los principales medios de comunicación, destacándonos con entrevistas, menciones y eventos importantes.<br>Sigue de cerca nuestras actualizaciones y descubre nuestras últimas noticias y éxitos.</p>
            <section class="k11-cat-cnt">
                <?php 
                while ($query->have_posts()): $query->the_post(); 
                    $categories = get_the_category($post_id, array('fields' => 'names'));
                    $category_class = "";
                    foreach ($categories as $key => $category): 
                        $category_class .= " " . $category->slug;
                    endforeach;
                    ?>
                    <div class="cat-cnt-pad">
                        <article id="sal-pren-x" style="border-radius: 1rem; box-shadow: 0 0.5rem 0.8rem 0.2rem #cfcfcf; padding: 0;" class="post-<?php echo get_the_ID() ?> <?php echo $category_class ?> <?php echo $class ?>">
							 <?php
                        // Obtener las etiquetas de la entrada
                        $tags = get_the_tags();
                        $image_src = ''; // valor predeterminado vacío
						
                        if ($tags) {
								foreach ($tags as $tag) {
									if ($tag->slug == 'ccl') {
										$image_src = 'https://tiendakrear3d.com/wp-content/uploads/2024/06/CCL-logo.svg';
										break;
									} elseif ($tag->slug == 'logo-epa') {
										$image_src = 'https://tiendakrear3d.com/wp-content/uploads/2024/06/Logo-EPA-azul.png';
										break;
									} elseif ($tag->slug == 'logo-mercado-libre') {
										$image_src = 'https://tiendakrear3d.com/wp-content/uploads/2024/06/Logo-de-mercado-libre-.png';
										break;
									} elseif ($tag->slug == 'logo-ccs') { 
										$image_src = 'https://tiendakrear3d.com/wp-content/uploads/2024/06/Logo-CCSP_Mesa-de-trabajo-1.png';
										break;
									}
								}
							}
                        ?>
							<div style="display: flex; align-items: center; padding: 0 1rem; height: 4rem;" class="fuente">
								<img style="margin: 1rem auto 1rem 0; width: 6rem;" src="https://tiendakrear3d.com/wp-content/uploads/2024/06/logo-negro.jpg" alt="" />
								<?php if ($image_src): ?>
									<img style="margin: 1rem 0 1rem auto; width: 6rem;" src="<?php echo esc_url($image_src); ?>" alt="" />
								<?php endif; ?>
							  </div>
                            <div class="cat-cnt-img">
                                <a href="<?php echo get_permalink($post, false); ?>">
                                    <picture>
                                        <source media="(max-width: 768px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium") ?>">
                                        <source media="(min-width: 769px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400, 400)) ?>">
                                        <img data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400, 400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(); ?>">
                                    </picture>
                                </a>
                            </div>
                            <div style="padding: 1rem; margin-top:0;" class="cat-cnt-dtl">
								 <a href="<?php echo get_permalink($post, false); ?>"><h4 style="min-height: auto; margin: 0;"><?php echo get_the_title(); ?></h4></a>
                                <?php if (!$hideDetail): ?>
                                    <p style="min-height: auto; margin: 0.5rem 0;"><?php echo wp_trim_words(wp_strip_all_tags(get_the_excerpt(), true), 20, ""); ?>...</p>
                                <?php endif ?>
                                <span><?php echo get_the_date("d F, Y"); ?></span>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>

                <div class="cat-cnt-pag">
                    <?php 
                    $total_pages = $query->max_num_pages;
                    if ($total_pages > 1){
                        $current_page = max(1, get_query_var('paged'));
                        echo paginate_links(array(
                            'base' => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
                            'format' => '?paged=%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text' => '&larr;',
                            'next_text' => '&rarr;',
                        ));
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
<?php else: ?>
<div class="k11-sec-cat">
	<div class="kyr-o11-wrp kyr-o11-flx-wrp">
		<h1>Categoría <?php echo single_cat_title(); ?></h1>
		<section class="k11-cat-cnt">
		<?php 
			while ($query->have_posts()) : $query->the_post(); 
				$categories = get_the_category( $post_id ,array( 'fields' => 'names' ) );
				$category_class = "";
				foreach ($categories as $key => $category): 
					$category_class .= " " . $category->slug;
				endforeach 
				?>
				<div class="cat-cnt-pad">
					<article class="post-<?php echo get_the_ID() ?> <?php echo $category_class ?> <?php echo $class ?>">
						<div class="cat-cnt-img">
							<a href="<?php echo get_permalink( $post, false ); ?>">
								<picture>
									<source media="(max-width: 768px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium ") ?>">
									<source media="(min-width: 769px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>">
									<img  data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(  ); ?>">
								</picture>
							</a>
						</div>
						<div class="cat-cnt-dtl">
							<span><img width="16" height="16" src="/wp-content/uploads/kyro11/svg/src.svg" alt="clock"><?php echo get_the_date("d F, Y"); ?></span>
							<a href="<?php echo get_permalink( $post, false ); ?>"><h4><?php echo get_the_title(  ); ?></h4></a>
							<?php if (!$hideDetail): ?>
								<p><?php echo wp_trim_words(wp_strip_all_tags( get_the_excerpt(), true ), 20, ""); ?>...</p>
							<?php endif ?>
							<?php if (!$hideButtonGo): ?>
								<div class="cat-cnt-btn">
									<a href="<?php echo get_permalink(); ?>">Leer más</a>
								</div>
							<?php endif ?>
						</div>
					</article>
				</div>
			<?php endwhile; ?>

			<div class="cat-cnt-pag">
				<?php 
				$total_pages = $query->max_num_pages;
				if ($total_pages > 1){
					$current_page = max(1, get_query_var('paged'));
					echo paginate_links(array(
						'base' 			=> preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
						'format' 		=> '?paged=%#%',
						'current' 		=> $current_page,
						'total' 		=> $total_pages,
						'prev_text'    	=> '&larr;',
						'next_text'    	=> '&rarr;',
					));
				}    
			?>
			</div>
		</section>
	</div>
</div>
<?php endif; ?>
<?php wp_reset_query() ?>
<?php include get_theme_file_path('includes/bloques.php');?>
<?php get_footer();?>