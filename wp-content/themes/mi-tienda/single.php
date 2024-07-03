<?php 
get_header(); 
?>
<div class="<?php echo $post_slug; ?>">
	<div class="kyr-o11-wrp kyr-o11-flx-wrp">
		<section class="k11-pag-cnt">
			<div class="pag-cnt-hdr">
				<?php if (has_post_thumbnail()): ?>
					<div class="pag-hdr-img">
						<a href="<?php echo get_permalink( $post, false ); ?>">
							<picture class="position-relative">
								<source media="(max-width: 799px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium ") ?>">
								<source media="(min-width: 800px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>">
								<img  data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(  ); ?>" class="swiper-lazy w-full lazyload" loading="lazy" width="auto" height="100%" style="object-fit: cover;">
							</picture>
						</a>

					</div>
				<?php endif ?>

				<div class="pag-cnt-hdr-url">
					<span><img width="16" height="16" src="/wp-content/uploads/kyro11/svg/src.svg" alt="clock"><?php echo get_the_date("d F, Y"); ?></span>
					<?php $categories = get_the_category( $post_id ,array( 'fields' => 'names' ) ); ?>
					<?php $categories_array = array(); ?>
					<?php if (count($categories) > 0): ?>
						<span>
							<img width="16" height="16" src="/wp-content/uploads/kyro11/svg/src.svg" alt="clock">
							<?php foreach ($categories as $key => $category): ?>
								<a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name ?></a>
								<?php array_push($categories_array, $category->term_id) ?>
							<?php endforeach ?>
						</span>
					<?php endif ?>
				</div>

				<h1><?php echo the_title(); ?></h1>
				<?php echo do_shortcode( "[ez-toc]" ); ?>						
			</div>
			
			<div class="pag-cnt-pst">
				<?php the_content(); ?>
				
				
			</div>
			<div class="pag-cnt-pst-rrs">
				<a href="https://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>', 'newwindow', 'width=400,height=350');return false;"><img src="/wp-content/uploads/kyro11/svg/wsp.svg"></a>

				<a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>', 'newwindow', 'width=400,height=350');return false;"><img src="/wp-content/uploads/kyro11/svg/wsp.svg"></a>

				<a href="https://www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url(); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url(); ?>', 'newwindow', 'width=400,height=350');return false;"><img src="/wp-content/uploads/kyro11/svg/wsp.svg"></a>

				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_permalink(); ?>" target="_blank" rel="noopener noreferrer" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_permalink(); ?>', 'newwindow', 'width=400,height=350');return false;"><img src="/wp-content/uploads/kyro11/svg/wsp.svg"></a>
			</div>

			<a href="/blog" title="Regresar al blog" class="pag-cnt-bck">&laquo; Regresar al blog</a>
		</section>

		<aside class="k11-pag-asd">
			<div class="pag-asd-cat">
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
					<li><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name ?></a></li>
					<?php endforeach ?>
				</ul>
				<?php endif; ?> 
			</div>
			<?php wp_reset_query(); ?>

			<div class="pag-asd-rel">
				<h4>Relacionados</h4>
				<?php 
					$page = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
					$args = array(
						'posts_per_page'  => 3,
						'post_status'    => 'publish',  
						'order' => 'DESC',
						'tax_query'      => array(
							array(
								'taxonomy'     => 'category',
								'field'        => 'id',
								'terms'        => $categories_array,
								'operator'     => 'IN'
							)
						),
					);
					$query = new WP_Query( $args ); 
					$posts = $query->posts;
				?>

				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<?php $categories = get_the_category( $post_id ,array( 'fields' => 'names' ) ); ?>
					<?php 
						$category_class = "";
						foreach ($categories as $key => $category): 
							$category_class .= " " . $category->slug;
						endforeach 
					?>
					<article class="post-<?php echo get_the_ID() ?> <?php echo $category_class ?> <?php echo $class ?>">
						<div class="asd-rel-img">
							<a href="<?php echo get_permalink( $post, false ); ?>">
								<picture class="position-relative">
									<source media="(max-width: 799px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), "medium ") ?>">
									<source media="(min-width: 800px)" srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>">
									<img  data-src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), array(400,400)) ?>" data-id="<?php echo get_the_ID(); ?>" alt="<?php echo get_the_title(  ); ?>" class="swiper-lazy w-full lazyload" loading="lazy" width="auto" height="100%" style="object-fit: cover;">
								</picture>
							</a>
						</div>
						<div class="asd-rel-dtl">
							<span><img width="16" height="16" src="/wp-content/uploads/kyro11/svg/src.svg" alt="clock"> <?php echo get_the_date("d F, Y"); ?></span>
							<a href="<?php echo get_permalink( $post, false ); ?>"><h4 class="text-2xl font-bold text-freeway-red alter"><?php echo get_the_title(  ); ?></h4></a>
							<?php if ( !$hideButtonGo ): ?>
							<div class="asd-rel-btn">
								<a href="<?php echo get_permalink(); ?>">Leer más</a>
							</div>
							<?php endif ?>
						</div>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_query() ?>
			</div>
		</aside>
	</div>
</div>

<?php get_footer(); ?>