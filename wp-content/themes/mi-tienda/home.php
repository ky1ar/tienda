<?php 
get_header("other");
include get_theme_file_path('/includes/slidershow.php'); 

$page = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$args = array(
	'posts_per_page'  => 9,
	'paged'          => $page,
	'post_status'    => 'publish',  
	'order' => 'DESC'  
);
$query = new WP_Query( $args ); 
$posts = $query->posts;
$counter = 0;
?>

<div class="k11-sec-blg">
	<div class="kyr-o11-wrp kyr-o11-flx-wrp">
		<h1><?php echo single_post_title(); ?></h1>

		<section class="k11-blg-cnt">
		<?php 
		while ($query->have_posts()) : $query->the_post();
			$categories = get_the_category( $post_id ,array( 'fields' => 'names' ) );
			$category_class = "";
			foreach ($categories as $key => $category): 
				$category_class .= " " . $category->slug;
			endforeach; 
			?>
			<div class="blg-cnt-pad">
				<article class="post-<?php echo get_the_ID() ?> <?php echo $category_class ?> <?php echo $class ?>">
					<div class="blg-cnt-img">
						<a href="<?php echo get_permalink( $post, false ); ?>">
							<picture class="position-relative">
								<source media="(max-width: 799px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium ") ?>">
								<source media="(min-width: 800px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>">
								<img  data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(  ); ?>" class="swiper-lazy w-full lazyload" loading="lazy" width="auto" height="100%" style="object-fit: cover;">
							</picture>
						</a>
					</div>
					<div class="blg-cnt-dtl">
						<span><img width="16" height="16" src="/wp-content/uploads/kyro11/svg/src.svg" alt="clock"><?php echo get_the_date("d F, Y"); ?></span>
						<a href="<?php echo get_permalink( $post, false ); ?>"><h4><?php echo get_the_title(  ); ?></h4></a>
						<?php if (!$hideDetail): ?>
							<p><?php echo wp_trim_words(wp_strip_all_tags( get_the_excerpt(), true ), 20, ""); ?>...</p>
						<?php endif; ?>
						<?php if ( !$hideButtonGo ): ?>
							<div class="blg-cnt-btn">
								<a href="<?php echo get_permalink(); ?>">Leer más</a>
							</div>
						<?php endif ?>
					</div>
				</article>
			</div>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

			<div class="blg-cnt-pag">
			<?php 
				$total_pages = $query->max_num_pages;
				if ($total_pages > 1){

					$current_page = max(1, get_query_var('paged'));

					echo paginate_links(array(
						'base' 			=> preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
						'format' 		=> '?paged=%#%',
						'current' 		=> $current_page,
						'total' 		=> $total_pages,
						'prev_text' => '&larr;',
						'next_text' => '&rarr;',
					));
				}    
				?>
			</div>
		</section>

		<aside class="k11-blg-asd">
			<div class="blg-asd-cat">
				<h4>Categorías</h4>
				<?php 
				$categories = get_categories( array(
					'taxonomy' 			=> 'category',
					'orderby' 			=> 'name',
					'parent'  			=> 0,
					'hide_empty'      	=> true,
					'exclude' 			=> [93]
				) );

				if (count($categories) > 0): ?>
				<ul>
					<?php foreach ($categories as $key => $category): ?>
					<li>
						<a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name ?></a>
					</li>
					<?php endforeach ?>
				</ul>
				<?php endif ?> 
			</div>
		</aside>
	</div>
</div>

<?php include get_theme_file_path('includes/bloques.php');?>

<?php get_footer();?>