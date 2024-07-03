<?php 
wp_reset_query();
$seo = get_field('contenido_de_seo');

if (is_product_category() || is_category()) {
	$term = get_queried_object();
    $seo      = get_field('contenido_de_seo', $term);
}

if (is_home()) {
	$page_for_posts = get_option( 'page_for_posts' );
	 $seo      = get_field('contenido_de_seo', $page_for_posts);
}
$term = get_queried_object();
$tax = $term->taxonomy;	
if ( $tax == 'pwb-brand' ) {
	$seo = get_field('contenido_de_seo', $term);
}

if ($seo): 
?>
<section id="k11-seo">
	<div class="kyr-o11-wrp seo-arr-act">
	<?php echo $seo ?>
	</div>
	<div class="k11-seo-arr">
		<span>
			<p>Ver más</p>
			<img src="/wp-content/uploads/kyro11/svg/arw.svg" width="10" height="10" alt="Arrow">
		</span>
	</div>
</section>

	<script>
	$( ".k11-seo-arr" ).click(function() {

	  $( this ).prev().toggleClass( "seo-arr-act" );

		if ($( this ).children().children().first().text() == "Ver más")
		   $( this ).children().children().first().text("Ver menos");
		else
		   $( this ).children().children().first().text("Ver más");
	});
	</script>
<?php 
	
endif;

$page_option = get_options_page_id('ajustes-generales');
$footer = get_field('footer', $page_option);

if (false): ?>
	<div class="boton-flotante">
		<div class="chat_virtualdent"> 
			<a href="<?php echo $footer['enlaces']['messenger'] ?>" target="_blank" class="messenger">
				<div class="boton-messenger"> 
					<i class="fab fa-facebook-messenger"></i> 
					<span>Facebook</span>
				</div> 
			</a> 
			<a href="<?php echo $footer['enlaces']['whatsapp'] ?>" target="_blank" class="whatsapp">
				<div class="boton-whatsapp"> 
					<i class="fab fa-whatsapp"></i> 
					<span>Whatsapp</span>
				</div> 
			</a>
		</div>
		<div class="boton-chats"> 
			<i class="far fa-comments"></i> 
			<span>Mensajes</span>
		</div>
	</div>
	
<?php endif ?>

<a href="<?php echo $footer['enlaces']['whatsapp'] ?>" target="_blank" id="k11-wsp-btn">
	<img alt="Whatsapp" width="80" height="80" src="<?php echo home_url() . "/wp-content/uploads/2023/03/wsp2.webp"; ?>">
</a>

<button onclick='window.scrollTo({top: 0, behavior: "smooth"});' id="leslie"><img alt="Whatsapp" width="64" height="64" src="<?php echo home_url() . "/wp-content/uploads/2023/09/totop.webp"; ?>"></button>

<div class="loading-effect">
	<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>
<script>
$(document).ready(function(){ 
	$(window).scroll(function(){

		if( $(window).scrollTop() > 1000 ){
			$('#leslie').css('display', 'block');
		} else {
			$('#leslie').css('display', 'none');
		}
	});
    
   /* $(window).resize(function(){ 
        if( $('body').height() < 980 )
            $('#leslie').css('display', 'none');
        else
            $('#leslie').css('display', 'block');
    });*/
});
</script>
<footer>
	<div class="kyr-o11-wrp">
		<div class="kyr-o11-flx">
			<div class="ftr-itm ftr-cnt">
				<?php 
				echo '<img class="ftr-lgo" src="/wp-content/uploads/2024/05/nlog3m.svg" alt="' . get_bloginfo('name') . '">';
				//echo '<img class="ftr-lgo" src="' . $footer["imagen_en_el_footer"] . '" alt="' . get_bloginfo('name') . '">'; 
				?>
				<b>EMPRESA</b>
				<ul>
					<li><a href="tel://014090748" target="_blank" rel="nofollow noopener"><img src="/wp-content/uploads/kyro11/svg/phn.svg" width="16" height="16" alt="Phone">&nbsp;409 0748</a></li>
					<li><a href="/empresa">NOSOTROS</a></li>
					<li><a href="/contacto">CONTACTO</a></li>
				</ul>
			</div>
			
			<div class="ftr-itm">
				<?php dynamic_sidebar( 'widget-footer-1' ); ?>
			</div>
			<div class="ftr-itm">
				<?php dynamic_sidebar( 'widget-footer-2' ); ?>
			</div>
			<div class="ftr-itm">
				<?php dynamic_sidebar( 'widget-footer-3' ); ?>
			</div>

			<div class="ftr-itm">
				<b>NOTICIAS</b>
				<a href="/blog/" style="margin-right: 0.5rem; margin-bottom: 0.5rem;" class="ftr-blg">BLOG</a>
				<a href="/sala-de-prensa/" class="ftr-blg">SALA DE PRENSA</a>
				<b style="padding-top: 1.5rem;">Siguenos en</b>
				<ul class="kyr-o11-flx"><?php
					$redes =  $footer['redes_sociales'];
					$cnt_id = 0;
					foreach ($redes as $key => $red) {
						switch ( $cnt_id )	{
							case 0: $img_rss = 'ins1'; break;
							case 1: $img_rss = 'tik1'; break;
							case 2: $img_rss = 'fbk1'; break;
							default: $img_rss = 'you1';
						}
						echo '<li><a href="'.$red['url'].'" target="_blank"><img src="/wp-content/uploads/kyro11/svg/'.$img_rss.'.svg" width="16" height="16" alt="ico"></a></li>';
						$cnt_id++; 
					}
				?></ul>
				<b style="padding-top: 1.5rem;">Medios de pago</b>
				<div class="ftr-pay">
					<img width="206" height="22" alt="Pagos aceptados" src="<?php echo home_url() . "/wp-content/uploads/2023/02/pagos.webp"; ?>">
				</div>
			</div>
		</div>
		<span class="ftr-cpy">Fabricaciones Digitales del Perú S.A. | RUC 20556316890 | Krear 3D © 2023. Todos los derechos reservados.</span>
	</div>
</footer>
<?php $barra_mobile = get_field('barra_mobile', $page_option)?>
<div id="k11-mvl-mnu">
	<ul>
		<li>
			<a href="<?php echo home_url() . '/mi-cuenta' ?>">
				<img src="/wp-content/uploads/kyro11/svg/usr.svg" width="20" height="20" alt="Usuario">
				<span>Iniciar sesión</span>
			</a>
		</li>
		<li>
			<a href="tel:<?php echo $barra_mobile["telefono"] ?>" target="_blank">
				<img src="/wp-content/uploads/kyro11/svg/phn.svg" width="20" height="20" alt="Phone">
				<span>Contacto</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $barra_mobile["mapa"] ?>" target="_blank">
				<img src="/wp-content/uploads/kyro11/svg/map2.svg" width="20" height="20" alt="Maps">
				<span>Tienda</span>
			</a>
		</li>
		<li>
			<a id="k11-mvl-btn" href="#">
				<img src="/wp-content/uploads/kyro11/svg/mnu.svg" width="20" height="20" alt="Menu">
			</a> 
		</li>
	</ul>
</div>
<script	type="module" src="https://uicomponent.interbank.pe/bindings/js/slice-payment-multiple@0.0.1/split-payment-multiple/split-payment-multiple.esm.js"></script>


<script type="text/javascript">
  _linkedin_partner_id = "5368266";
  window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
  window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
  (function(l) {
  if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
  window.lintrk.q=[]}
  var s = document.getElementsByTagName("script")[0];
  var b = document.createElement("script");
  b.type = "text/javascript";b.async = true;
  b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
  s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>

<noscript>
  <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=5368266&fmt=gif" />
</noscript>
  


<?php wp_footer(); ?>
</body>
</html>