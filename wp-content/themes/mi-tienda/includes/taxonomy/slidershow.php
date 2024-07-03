<?php
$term = get_queried_object(); 
$term_id = $term->term_id;	
$term_slug = $term->slug;	

$parent = $term->parent;	

//echo $term_id . ' ' .$term_slug . ' | ';
if ( $parent != 0 ) {
    $term_id = $term->parent;
    $tmp_term = get_term_by( 'id', $term_id, 'product_cat' );
    $term_slug = $tmp_term->slug;
} 
if ( $term_slug == 'caracteristicas' ) {
    $tmp_term = get_term_by( 'slug', 'impresoras3d', 'product_cat' );
    $term_id = $tmp_term->term_id;
    $term_slug = $tmp_term->slug;
}
if ( $term_slug == 'aplicaciones' ) {
    $tmp_term = get_term_by( 'slug', 'resinas', 'product_cat' );
    $term_id = $tmp_term->term_id;
    $term_slug = $tmp_term->slug;
}
//echo $term_id . ' ' .$term_slug;

$sliders = get_field( 'sliders','product_cat'.'_'.$term_id );

if ( $sliders ): ?>
    <div class="swiffy-slider slider-nav-chevron slider-item-nogap slider-nav-autoplay slider-nav-autopause" data-slider-nav-autoplay-interval="3500" id="swiffy-animation">
        <ul class="slider-container leslie">
        <?php foreach ( $sliders as $key => $slider ): ?>
            <li style="text-align: center;">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?php echo $slider['imagen_movil'] ?>">
                    <source media="(min-width: 769px)" srcset="<?php echo $slider['imagen_desktop'] ?>">
                    <img width="1920px" height="630px" src="<?php echo $slider['imagen_desktop'] ?>" alt="<?php echo "Slider " . $key ?>">
                </picture>
            </li>
        <?php endforeach ?>
        </ul>
        <button type="button" class="slider-nav"></button>
        <button type="button" class="slider-nav slider-nav-next"></button>
    </div>
<?php endif ?>

<section id="kyr-o11-tax">
	<h2>Compra por Categorías</h2>
	<div class="kyr-o11-wrp kyr-o11-flx-wrp">
	
<?php
	
$args = array( 'child_of' => $term_id, 'taxonomy' => 'product_cat', 'hide_empty' => true );  
$categories = get_categories( $args );
							
foreach ( $categories as $category ){
	$tmp_slg = $category->slug;

	if ( !( $tmp_slg == 'flexible-resinas' || $tmp_slg == 'medica' ) ) {
		$term_image_id = get_term_meta( $category->term_id, 'thumbnail_id', true ); 
		$term_image = wp_get_attachment_image_src( $term_image_id, 'thumbnail' ); 

		echo '<a href="/productos/'. $category->slug . '">';
		
		if ( $term_slug == 'filamentos' ) {
			if ( $category->slug == 'policarbonato' ) echo '<div class="tax-flm">PC</div>';
			else echo '<div class="tax-flm">' .$category->name. '</div>';
        }
		else {
            echo '<img src="' . $term_image[0] . '" alt="' . $category->name . '" />'.
			'<span>'. $category->name . '</span>';
        }
		echo '</a>';
		
	}
}


if ( $term_slug == 'impresoras3d' ) {
    $ext_term = get_term_by( 'slug', 'caracteristicas', 'product_cat' );

    $ext_arg = array( 'orderby' => 'name', 'order' => 'ASC', 'child_of' => $ext_term->term_id, 'taxonomy' => 'product_cat', 'hide_empty' => true );
    $ext_cat = get_categories( $ext_arg );

    foreach ( $ext_cat as $category_ext ){
        $tmp_slg = $category_ext->slug;
        if ( $tmp_slg == 'alta-velocidad' || $tmp_slg == 'gran-formato' || $tmp_slg == 'delta' || $tmp_slg == 'doble-extrusor' ) {
            $term_image_id = get_term_meta( $category_ext->term_id, 'thumbnail_id', true ); 
            $term_image = wp_get_attachment_image_src( $term_image_id, 'thumbnail' ); 
    
            echo '<a href="/productos/'. $category_ext->slug . '">
            <img src="' . $term_image[0] . '" alt="' . $category_ext->name . '" />
            <span>'. $category_ext->name . '</span></a>';
        }
    }

} elseif ( $term_slug == 'resinas' ) {
    $ext_term = get_term_by( 'slug', 'aplicaciones', 'product_cat' );

    $ext_arg = array( 'orderby' => 'name', 'order' => 'ASC', 'child_of' => $ext_term->term_id, 'taxonomy' => 'product_cat', 'hide_empty' => true );
    $ext_cat = get_categories( $ext_arg );

    foreach ( $ext_cat as $category_ext ){
        $term_image_id = get_term_meta( $category_ext->term_id, 'thumbnail_id', true ); 
        $term_image = wp_get_attachment_image_src( $term_image_id, 'thumbnail' ); 

        echo '<a href="/productos/'. $category_ext->slug . '">
        <img src="' . $term_image[0] . '" alt="' . $category_ext->name . '" />
        <span>'. $category_ext->name . '</span></a>';
    }
} 

/*$user = wp_get_current_user();
echo json_encode($user);*/

?>
		</div>
</section>
