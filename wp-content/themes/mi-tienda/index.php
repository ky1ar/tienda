<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        // Mostrar contenido genérico
    }
}

get_footer();
