<?php

get_header();

global $post;
$post_slug = $post->post_name;

?>

<div class="<?php echo $post_slug; ?>">
	<?php $location = get_field('ubicacion');?>
	<input type="hidden" value="<?php echo $location['lat']; ?>" id="lati_map">
    <input type="hidden" value="<?php echo $location['lng']; ?>" id="long_map">
	<div id="map_cont" class="mappp" data-lati="<?php echo $location['lat'] ?>" data-long="<?php echo $location['lng'] ?>"></div>
</div>
<div id="k11-con-pag" class="kyr-o11-wrp">
	<?php
	while (have_posts()): the_post();
		 the_content();
	endwhile;
	?>
</div>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyAyPrqZb9nl5EJhvnxMhnZ1Y0lLIUbKe8I&amp;ver=false"></script>
<script>
//
// Google Map
//

jQuery(document).ready(function($) {
    var la = document.getElementById("lati_map").value;
    var lo = document.getElementById("long_map").value;
    var long_valor = la;
    var lati_valor = lo;
    var centerPosition = new google.maps.LatLng(long_valor, lati_valor, 18);
    var position_reference = new google.maps.LatLng(long_valor, lati_valor, 17);
    var style = [
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#838383"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#c4c4c4"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#aaaaaa"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 21
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#6e6e6e"
            },
            {
                "lightness": "0"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#575757"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#2c2c2c"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#999999"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            }
        ]
    }
]
    var options = {
        scrollwheel: false,
        zoom: 16,
        center: centerPosition,
        draggable: true, //Desactiva los gestos con el raton
        keyboardShortcuts: false, //Desactiva  el zoom con el + y -
        navigationControl: false,
        streetViewControl: false, //Define al hombrecito del Streep
        mapTypeControlOptions: false,
        disableDefaultUI: true, //Desactiva la escala
        fullscreenControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map_cont'), options);
    // map.setOptions({
    //     styles: style
    // });
    var image = {
        url: 'https://static.lennox.com/img/icons/flood-search-pin.svg',
        anchor: new google.maps.Point(30, 30.26),
        size: new google.maps.Size(60, 30.26),
        draggable: false,
    };
    var shadow = {
        url: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKms9GAp1BAL5LThlUEEDeW15b7knda8l_hVetewuEckaQfDBwUleozmk',
        origin: new google.maps.Point(0, 0),
    };
    var marker = new SVGMarker({
        position: position_reference,
        map: map,
        icon: image,
        shadow: shadow
    });
    // var marker = new google.maps.Marker({
    //     position: position_reference,
    //     map: map,
    //     // icon: image,
    //     shadow: shadow,
    //     title: 'Click to zoom'
    // });
    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });



});
</script>

<?php get_footer();?>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/library/js/SVGMaker/SVGMarker.min.js' ?>"></script>
<script>
	jQuery(document).ready(function($) {
		var par_pass_line_cont = <?php echo "'" .  $_GET['producto'] ."'" ;?> ;
		$('.formulario_contacto input[name="producto"]').val(par_pass_line_cont)
        $('.url_get').val(<?php echo '"' . get_permalink() . '"'; ?>)
	});
</script>
