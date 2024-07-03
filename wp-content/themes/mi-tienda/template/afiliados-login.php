<?php 
/**
 * Template Name: Portal Afiliados
 *
 */
get_header();
defined('ABSPATH') || exit;


// Imprimir el shortcode usando do_shortcode()
//echo do_shortcode('[yith_wcaf_registration_form]');
echo do_shortcode('[yith_wcaf_affiliate_dashboard]');
get_footer();
