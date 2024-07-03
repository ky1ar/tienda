<!DOCTYPE html>
<html lang="<?php echo bloginfo('language'); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="theme-color" content="#F08043">
	<?php
	$sep  = ' | ';
	$name = get_bloginfo('name');

	if (is_single() || is_page()) {
		$title = wp_title($sep, false, 'right') . $name;
	}

	if (is_product_category()) {
		$tax   = $wp_query->get_queried_object();
		$title = $tax->name . $sep . $name;
	}

	if (is_category()) {
		$title = single_cat_title('', false) . $sep . $name;
	}

	if (is_post_type_archive()) {
		$title = post_type_archive_title('', false) . $sep . $name;
	}

	if (is_day()) {
		$title = 'Post for the day ' . get_the_date('j F, Y') . $sep . $name;
	}

	if (is_month()) {
		$title = 'Post for the month ' . get_the_date('F, Y') . $sep . $name;
	}

	if (is_year()) {
		$title = 'Post for the year ' . get_the_date('Y') . $sep . $name;
	}

	if (is_shop()) {
		$title = post_type_archive_title('', false) . ' - ' . get_bloginfo('name');
	}

	if (is_home() || is_front_page()) {
		$name_page = get_bloginfo('name');

	   // $title = $name_page . $sep . get_bloginfo('description');
		$title = wp_title($sep, false, 'right');
	}
	$page_option = get_options_page_id('ajustes-generales');
	$header = get_field('cabecera', $page_option);
	?>
	<link rel="icon" href="<?php echo  $header['favicon'] ?>">
	<meta name="google-site-verification" content="E5_YFtPb5vlor2njTWhWv41HONgIxgnJIcZbg5lhxlQ">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="/wp-content/themes/mi-tienda/library/js/jquery.min.js"></script>
	<?php wp_head();?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-FLK8NWFK4T"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-FLK8NWFK4T');
	</script>
</head>
<body <?php body_class();?>>

<?php include get_theme_file_path('/includes/header.php');?>
