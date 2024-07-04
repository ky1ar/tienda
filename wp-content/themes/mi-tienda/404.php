<?php 
get_header(); 
global $post;
$post_slug=$post->post_name;
?>

<div class="k11-emp-crt <?php echo $post_slug; ?>">
	 <div class="kyr-o11-wrp kyr-o11-flx">
		 <img src="/wp-content/uploads/kyro11/svg/404.svg">	
		 <p>Creo que no logramos encontrar lo que buscabas</p>
		 <a href="/">Ir al Home</a>
	</div>
</div>

<?php get_footer(); ?>