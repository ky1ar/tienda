<?php 
$page_option = get_options_page_id( 'ajustes-generales' );

$header = get_field( 'cabecera', $page_option );
$banner = get_field( 'banner', $page_option );
$svg_pth = '/wp-content/uploads/kyro11/svg/';

//echo "<script>console.log( '" . $banner[ 'mensaje' ] . "' );</script>";
//echo "<script>console.log( '" . $banner[ 'icono' ] . "' );</script>";
?>
<!-- 
<div id="k11-hdr-bnr"> 
    <div class="kyr-o11-wrp kyr-o11-flx">
		<img src="<?php echo $banner[ 'icono' ] ?>" alt="Tienda" width="32" height="32">
        <span class="kyr-o11-flx"><?php echo $banner[ 'mensaje' ]  ?></span>
		<img src="<?php echo $banner[ 'icono' ] ?>" alt="Tienda" width="32" height="32">
    </div>
</div> -->
<div class="cont-menuw">
	<div class="menu-webs">
		<ul>
		  <li><a href="https://tiendakrear3d.com/">TIENDA</a></li>
		  <li><a href="https://krear3d.com/">INDUSTRIA</a></li>
		  <li><a href="https://krear3dental.com/">DENTAL</a></li>
		  <li><a href="https://soporte.krear3d.com/">SOPORTE</a></li>
		</ul>
	</div>
</div>
<?php $links = $header['enlaces_de_contacto'] ?>
<header id="k11-hdr">
	<div class="hdr-rel kyr-o11-wrp">
		<form class="hdr-frm" name="keywordsearch" method="get" action="<?php echo get_permalink( wc_get_page_id( 'shop' ) ) ?>">
			<input name="s" id="keywordsearch-q" placeholder="<?php echo $header[ 'texto_buscar' ] ?>" type="text" value="">
			<input name="post_type" id="post_type" placeholder="<?php echo $header[ 'texto_buscar' ] ?>" type="hidden" value="product">
			<button type="submit" value="" title="<?php echo $header[ 'texto_buscar' ] ?>"><img src="<?php echo $header[ 'icono_buscar' ] ?>" alt="Icono" width="16" height="16"></button>                        
		</form>
	</div>

	<div class="hdr-top kyr-o11-wrp kyr-o11-flx">
		<div class="hdr-top-dta">
            <?php $evn = 0;
            foreach ( $links as $key => $link ) { 
                if ( $evn % 2 == 0 ) echo '<div class="top-dta-div">';	
                echo '<a href="'.$link['url'].'" target="_blank" rel="nofollow"><img src="'.$link['icono'].'" width="16" height="16" alt="ico"> '.$link['texto'].'</a>';
                if ( !( $evn % 2 == 0 ) ) echo '</div>';
                $evn++; 
            } ?>
		</div>
	</div>

	<div style="background-color: #fff;">
		<div class="hdr-bot kyr-o11-wrp kyr-o11-flx">
		<a class="hdr-bot-lgo" href="<?php echo home_url( '', null ); ?>">
			<img width="215" height="73" src="<?php echo $header['logo'] ?>" alt="Logo" class="logo--image">
		</a>
		<?php wp_nav_menu( array( 'theme_location' => 'navegation', 'menu_class' => 'menu__', 'menu_id' => 'menu-principal', ) );?>
		<div class="hdr-bot-crt">
			<?php 
			if ( is_user_logged_in() ) {
				echo '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><img src="/wp-content/uploads/2023/09/acc2.svg" alt ="SVG" width="24" height="24"></a>';
			} else echo '<a href="'.home_url().'/mi-cuenta"><img src="/wp-content/uploads/2023/09/acc2.svg" alt ="SVG" width="24" height="24"></a>';
			?>
			
			<a href="<?php echo wc_get_cart_url(); ?>" class="bot-crt-cnt">
				<img src="<?php echo $header[ 'icono_carrito' ] ?>" alt ="Cart SVG" width="24" height="24">
				<div class="bot-crt-bbb"><?php $count = count( WC()->cart->get_cart() ); ?>0</div>
			</a>
		</div>
	</div>
</div>
</header>

<div id="k11-ovr-mnu"></div>

<div id="k11-mvl-blc">
	<div class="mvl-blc-cls">
		<div id="k11-mvl-cls">
			<img src="<?php echo $svg_pth ?>cls.svg" alt="Cerrar" width="16" height="16">
		</div>
	</div>
	<?php wp_nav_menu( array( 'theme_location' => 'navegation', 'menu_class' => 'menu__', 'menu_id' => 'menu-principal', ) );?>
	<ul>
		<?php 
			   
		$links =  $header['enlaces_de_contacto'];

        $evn = 0;
        foreach ( $links as $key => $link ) { 
            switch ( $evn )	{
                case 2: $img = 'eml'; break;
                case 3: $img = 'map'; break;
                default: $img = 'wsp';
            } 
            echo '<li> <a href="'.$link['url'].'" target="_blank" rel="nofollow"><img src="'.$svg_pth.$img.'.svg" width="32" height="32" alt="ico"> '.$link['texto'].'</a></li>';
            $evn++; 
        }
		?>
	</ul>
</div>

