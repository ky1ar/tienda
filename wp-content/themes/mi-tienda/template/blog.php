<?php
/**
 * Template Name: Blog
 *
 */
get_header("other");?>
<?php defined('ABSPATH') || exit;?>

<?php include get_theme_file_path('/includes/slidershow.php'); ?>

<?php 
	$page = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
	$args = array(
		'posts_per_page'  => 8,
		'paged'          => $page,
		'post_status'    => 'publish',  
		'order' => 'DESC'  
	);
	$query = new WP_Query( $args ); 
	$posts = $query->posts;
	$counter = 0;
?>

<div class="container my-4">

	<div class="title--page">
		<h1><?php echo single_post_title(); ?></h1>
	</div>
	
	<div class="row a">

		<div class="col-12 col-md-9">
			<div class="row">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<?php $categories = get_the_category( $post_id ,array( 'fields' => 'names' ) ); ?>
					<?php 
						$category_class = "";
						foreach ($categories as $key => $category): 
							$category_class .= " " . $category->slug;
						endforeach 
					?>
					<article class="col-12 col-md-6 post post-<?php echo get_the_ID() ?> <?php echo $category_class ?> <?php echo $class ?> mb-4">

						<div class="post-content">

							<div class="post-picture">
								<a href="<?php echo get_permalink( $post, false ); ?>">
									<picture class="position-relative">
						                <source media="(max-width: 799px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium ") ?>">
						                <source media="(min-width: 800px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>">
						                <img  data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(  ); ?>" class="swiper-lazy w-full lazyload" loading="lazy" width="auto" height="100%" style="object-fit: cover;">
						            </picture>
						        </a>

							</div>


							<div class="post-detail">

								<div class="meta-data text-gray-500 text-sm block mb-3 flex gap-3">

									<span class="date inline-flex gap-1" tooltip="Fecha de publicación">
										<i class="far fa-clock"></i> <?php echo get_the_date("d F, Y"); ?>
									</span>
								</div>
					
								<div class="post-title">
									
									<a href="<?php echo get_permalink( $post, false ); ?>">
										<h4 class="text-2xl font-bold text-freeway-red"><?php echo get_the_title(  ); ?></h2>
									</a>

								</div>

								

								<?php if (!$hideDetail): ?>
									<div class="post-extract text-zinc-500 dark:text-zinc-400 mb-3">
										<?php echo wp_trim_words(wp_strip_all_tags( get_the_excerpt(), true ), 20, ""); ?>"			
									</div>
								<?php endif ?>

								<?php if (!$hideButtonGo): ?>
									<div class="post-go">
										
										<a href="<?php echo get_permalink(); ?>" class="text-lg text-freeway-red flex items-center gap-2">
											Leer más <i class="ri-arrow-right-line group-hover:translate-x-1 transition-all"></i>
										</a>

									</div>
								<?php endif ?>

							</div>

						</div>
						
					</article>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_query() ?>

			<div class="pagination-section flex justify-center">
				<div class="pagination--global">
				<?php 
				    $total_pages = $query->max_num_pages;
				    if ($total_pages > 1){

				        $current_page = max(1, get_query_var('paged'));

				        echo paginate_links(array(
				            'base' 			=> preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
				            'format' 		=> '?paged=%#%',
				            'current' 		=> $current_page,
				            'total' 		=> $total_pages,
				            'prev_text'    	=> '<i class="fas fa-arrow-left"></i>',
		            		'next_text'    	=> '<i class="fas fa-arrow-right"></i>',
				        ));
				    }    

				    
				 ?>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-3">
			<aside class="aside aside--blog position-relative">
				<div class="widget widget-popular-post mb-5">
					<h4 class="widget-title text-xl font-bold mb-3 text-black">
						Categorías
					</h4>

					<?php 

						$categories = get_categories( array(
							'taxonomy' 			=> 'category',
							'orderby' 			=> 'name',
							'parent'  			=> 0,
							'hide_empty'      	=> true,
							'exclude' 			=> [93]
						) );

					 ?>

					<?php if (count($categories) > 0): ?>
						
						<ul>
							 <?php foreach ($categories as $key => $category): ?>

							 	<li class="mb-2">
							 		
							 		<a href="<?php echo get_term_link( $category ); ?>" class="group <?php echo ($category->slug === $current_taxonomy->slug) ? "current text-freeway-red" : "" ?>">
							 			<span class="flex items-center  group-hover:translate-x-1 transition-all tracking-wide"><i class="ri-arrow-drop-right-line text-slate-300"></i><?php echo $category->name ?></span>
							 		</a>

							 	</li>
							 	
							 <?php endforeach ?>
							
						</ul>
					 	
					 <?php endif ?> 

				</div>
			</aside>
		</div>
	</div>


	

</div>

<?php include get_theme_file_path('includes/bloques.php');?>


<?php get_footer();?>