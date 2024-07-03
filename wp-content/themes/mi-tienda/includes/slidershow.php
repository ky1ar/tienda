<?php $sliders = get_field('sliders') ?>
<?php $id = randomString(); ?>

<?php if ($sliders): ?>

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
    
<?php endif ?>