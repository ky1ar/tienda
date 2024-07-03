<?php $sliders = get_field('slider');

if ($sliders): ?>

<div class="swiffy-slider slider-nav-chevron slider-item-nogap slider-nav-autoplay slider-nav-autopause" data-slider-nav-autoplay-interval="3500" id="swiffy-animation">
    <ul class="slider-container">
	<?php foreach ($sliders as $key => $slider): ?>
        <li>
			<picture>
                <source media="(max-width: 768px)" srcset="<?php echo $slider['imagen_movil'] ?>">
                <source media="(min-width: 769px)" srcset="<?php echo $slider['imagen_desktop'] ?>">
                <img width="1920px" height="630px" src="<?php echo $slider['imagen_desktop'] ?>" alt="<?php echo "Slider-" . $key ?>">
            </picture>
		</li>
    <?php endforeach ?>
    </ul>
    <button type="button" class="slider-nav"></button>
    <button type="button" class="slider-nav slider-nav-next"></button>
</div>
<?php endif;
						
$banner_home = get_field( 'banner_home' );						
?>
<!--<split-payment-exploration subscription-key="1bc471a425514f32878506da4a08cb9d" amount="1200" logo-url="https://tiendakrear3d.com/wp-content/uploads/2021/01/LOGO-300x90.jpg" currency="PEN"></split-payment-exploration>-->

<div id="k11-hdr-bnr" class="k11-alt"> 
    <div class="hdr-bnr-wrp kyr-o11-wrp kyr-o11-flx">
		<img src="<?php echo $banner_home[ 'icono' ] ?>" alt="Tienda" width="32" height="32">
        <span class="kyr-o11-flx"><?php echo $banner_home[ 'mensaje' ]  ?></span>
		<img src="<?php echo $banner_home[ 'icono' ] ?>" alt="Tienda" width="32" height="32">
    </div>
</div>
