<?php get_header(''); ?>

		<?php include dirname(__FILE__) . '/includes/home/slidershow.php'; ?>
		<?php include dirname(__FILE__) . '/includes/home/enlaces.php'; ?>

		<?php include get_theme_file_path('includes/bloques.php');?>

		<?php

			while (have_posts()): the_post();
			    the_content();
			endwhile;

		?>
<?php get_footer(); ?>