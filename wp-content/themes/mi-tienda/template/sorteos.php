<?php 
/**
 * Template Name: Sorteos
 *
 */
get_header();
defined('ABSPATH') || exit;

global $post;
$post_slug = $post->post_name;

include get_theme_file_path('/includes/slidershow.php');

$header = get_field( 'sorteo_header' );
$sorteos = get_field( 'sorteo' );

?>
<div id="ky1-nrf">
	<div class="rff-hdr">
        <div class="kyr-o11-wrp">
            <div class="swiffy-slider slider-item-show2  slider-nav-chevron slider-nav-dark slider-nav-autoplay slider-nav-autopause slider-nav-outside slider-nav-visible" data-slider-nav-autoplay-interval="3500" id="swiffy-animation">
				<ul class="slider-container">
					<?php 
					$first = true;
					foreach ( $sorteos as $sorteo):
						$principal = $sorteo['principal'];
						if ( $principal['visible'] ):
							?>
							<li class="rff-box <?= $first ? 'rff-act' : '' ?>" data-slug="<?= $principal['slug'] ?>">
								<div class="box-img"><img src="<?= $principal['imagen'] ?>"/></div>
								<div>
									<span><?= $principal['fecha'] ?></span>
									<h2 style="padding-right: 40px;"><?= $principal['titulo'] ?></h2>
									<p><?= $principal['texto'] ?></p>
									<div class="rff-ky1">Participar</div>
								</div>
							</li>
							<?php
						$first = false;
						endif;
					endforeach;					  
					?>
                </ul>
				<button type="button" class="slider-nav" aria-label="Go to previous"></button>
    			<button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>
            </div>
        </div>
    </div>
	<?php 
	$init = true;
	foreach ( $sorteos as $sorteo ):
		$principal = $sorteo['principal'];
	
		if ( $principal['visible'] ):
			$sec_pas = $sorteo['seccion_pasos'];
			$pasos = $sec_pas['pasos'];

			$sec_prz = $sorteo['seccion_premios'];
			$premios = $sec_prz['premios'];

			$frm = $sorteo['formulario'];
			?>
			<div class="rff-unq" id="<?= $principal['slug'] ?>" <?= $init ? '' : 'style="display: none;"' ?>>
				<div class="rff-prz">
					 <div class="kyr-o11-wrp">
						<h1 style="white-space: nowrap;"><?= $principal['titulo'] ?></h1>
						 <p><?= $principal['texto'] ?></p>
						<ul>
							<?php 
							foreach ( $premios as $premio ):
								$prz_prd = $premio['producto'];
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $prz_prd->ID ), array('300','300'), true );
								$link = get_permalink( $prz_prd->ID );

								$brands = wp_get_post_terms( $prz_prd->ID, 'pwb-brand' );
								$brand = $brands[0];
								$brand_id = get_term_meta( $brand->term_id, 'pwb_brand_image',1 );
								$brand_src = wp_get_attachment_image_src( $brand_id, 'wc_pwb_admin_tab_brand_logo_size', true );

								?>
								<li>
									<?php if ($link === 'https://tiendakrear3d.com/?post_type=product&p=21600' || $link === 'https://tiendakrear3d.com/?post_type=product&p=21604'): ?>
        <a href="#" class="prz-lnk"> <!-- Si $link es uno de los enlaces que deseas anular, establece el href como '#' -->
    <?php else: ?>
        <a href="<?= $link ?>" class="prz-lnk"> <!-- Si no es uno de esos enlaces, usa el valor normal de $link -->
    <?php endif; ?>
										<div class="prz-box">
											<img height="32" class="prz-brd" src="<?= $brand_src[0] ?>"/>
											<img width="192" height="192" class="prz-img" src="<?= $image[0] ?>"/>
										</div>
									</a>
									<h2><a href="<?= $link ?>"><?= $premio['titulo'] ?></a></h2>
									<p><?= $premio['texto'] ?></p>
								</li>
								<?php
							endforeach;
							?>
						</ul>
					</div>
				</div>
				<div class="rff-stp">
					 <div class="kyr-o11-wrp">
						<h1><?= $sec_pas['titulo'] ?></h1>
						<ul>
							<?php 
							foreach ( $pasos as $paso ):
								?>
								<li>
									<img src="<?= $paso['icono'] ?>"/>
									<div>
										<h2><?= $paso['titulo'] ?></h2>
										<p><?= $paso['parrafo'] ?></p>
									</div>
								</li>
								<?php
							endforeach;
							?>
						</ul>
					</div>
				</div>
				<?php
				if ( $frm != '' ):
				?>
					<div class="rff-frm">
						<div class="kyr-o11-wrp">
							<div class="frm-lft">
								<div>
									<p>Confirma</p>
									<span>AQUÍ</span>
								</div>
							</div>
							<div class="frm-rgt"><?php echo do_shortcode($frm); ?></div>
						</div>
					</div>
				<?php 
				endif;
				?>
			</div>
			<?php
			$init = false;
		endif;
	endforeach;
	?>

	<div class="rff-bar">
        <div class="bar-img"><img class="bar-img" src="/wp-content/uploads/2023/10/plane.webp"/></div>
        <div class="rff-bar-txt"><img src="/wp-content/uploads/2023/10/ct1.webp"/><span>Llegamos a toda Latinoamérica y España</span><img src="/wp-content/uploads/2023/10/ct2.webp"/></div>
        <div class="bar-img"><img class="bar-img" src="/wp-content/uploads/2023/10/plane.webp"/></div>
    </div>
	<div class="rff-tyc">
		<div class="kyr-o11-wrp">
			<div class="rff-crd">
				<h1><strong>TÉRMINOS Y CONDICIONES DE SORTEOS</strong></h1>
				<p>Krear 3D es una marca registrada de FABRICACIONES DIGITALES DEL PERU SA (en adelante “Krear 3D”), identificada con RUC 20556316890, domiciliada en Calle Javier Fernandez 262 Miraflores, Lima es la empresa organizadora de sorteos; cuyas redes sociales y páginas web asociadas (en adelante “Plataformas”) serán utilizadas para la realización de los mismos a plena discreción de sus representantes legales.</p>
				<p>Los términos y condiciones que serán explicados a continuación, son aplicables para todas las relaciones contractuales que surjan entre Krear 3D y los Participantes.</p>
				<p>En tal sentido, los Participantes declaran haber leído, entendido y aceptado los presentes Términos y Condiciones. Caso contrario, no podrá establecer ninguna relación contractual con Krear 3D.</p>
				<ol>
					<li><strong>SOBRE LOS PARTICIPANTES</strong></li>
				</ol>
				<p style="padding-left: 40px;">Los Participantes son personas naturales mayores de 18 años, identificadas con información veraz y completa.</p>
				<ol start="2">
					<li><strong>SOBRE LA INFORMACIÓN PROPORCIONADA POR LOS PARTICIPANTES</strong></li>
				</ol>
				<p style="padding-left: 40px;">Los Participantes se comprometen a brindar información de su documento nacional de identidad, nombres y apellidos, email, correo y nacionalidad de acuerdo a documentación oficial.</p>
				<p style="padding-left: 40px;">En el caso de los Participantes, Krear 3D se reserva el derecho a bloquear, suspender o eliminar la postulación del Participante a los sorteos, en el caso de que se haya comprobado que el Participante llevó a cabo una de las siguientes acciones:</p>
				<ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
							<li>Creación de varias cuentas.</li>
							<li>Suplantación de identidad.</li>
							<li>Otorgamiento de información incorrecta y/o falsa.</li>
						</ul>
					</li>
				</ul>
				<p style="padding-left: 40px;">Krear 3D se reserva el derecho de bloquear, suspender o eliminar a cualquier Participante que incumpla los Términos y Condiciones. Asimismo, Krear 3D tendrá este derecho en caso el Participante viole o vaya en contra de las leyes, la buena costumbre y/o el orden público. Asimismo, Krear 3D podrá iniciar las acciones legales que considere pertinentes.</p>
				<ol start="3">
					<li><strong>SOBRE LOS SORTEOS</strong></li>
				</ol>
				<p style="padding-left: 40px;">Los sorteos serán publicados mediante las Plataformas. A través de la misma, se indicará la siguiente información:</p>
				<ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
							<li>Fecha del sorteo.</li>
							<li>Información relativa al premio(s).</li>
							<li>Cantidad de premio(s) del sorteo.</li>
							<li>Condiciones y restricciones particulares aplicables (en el caso de que hubieren).</li>
						</ul>
					</li>
				</ul>
				<ol start="4">
					<li><strong>SOBRE LA PROTECCIÓN DE DATOS PERSONALES</strong></li>
				</ol>
				<p style="padding-left: 40px;">Los Participantes brindan su consentimiento de manera libre, expresa, previa, informada e inequívoca, para que toda la información personal proporcionada sea almacenada, recopilada, utilizada y en general, tratada por el Krear 3D.</p>
				<p style="padding-left: 40px;">Las finalidades del tratamiento de los datos personales son para la participación en los sorteos y acciones de marketing mediante llamadas, correos, mensajes SMS, mensajes por Whatsapp, mensajes por las Plataformas para promocionar las actividades de Krear 3D. Se asegurará la confidencialidad de los datos personales que sean recopilados, además de la implementación de medidas de seguridad para llevar a cabo un tratamiento adecuado.</p>
				<p style="padding-left: 40px;">El almacenamiento de los datos personales se llevará a cabo hasta que el titular de la información personal solicite la cancelación de los mismos. De conformidad con lo establecido en la Ley N° 29733, Ley de Protección de Datos Personales, y su Reglamento, los titulares de los datos personales podrán ejercitar sus derechos ARCO (acceso, rectificación, cancelación y oposición) a través de la siguiente dirección de correo electrónico: administracion@krear3d.com. El trámite para dar respuesta a la solicitud formulada se dará respetando las condiciones y plazos legales establecidos para ello, a través del medio de contacto proporcionado por el titular.</p>
				<p style="padding-left: 40px;">Para tener mayor información sobre el tratamiento de datos personales efectuados por el organizador, puede comunicarse a través del correo electrónico previamente señalado.</p>
				<ol start="5">
					<li><strong>SOBRE LA LEGISLACIÓN APLICABLE</strong></li>
				</ol>
				<p style="padding-left: 40px;">Las relaciones contractuales establecidas con Krear 3D, se regirán bajo la legislación vigente aplicable de la República del Perú. Asimismo, cualquier controversia que surja entre las partes, será sometida a la competencia y jurisdicción peruana.</p>
				<ol start="6">
					<li><strong>SOBRE LA VIGENCIA</strong></li>
				</ol>
				<p style="padding-left: 40px;">Los presentes términos y condiciones pueden ser actualizados y/o modificados de forma constante, por lo que es responsabilidad de los participantes revisar la versión vigente.</p>
				<h1><strong>REGLAMENTO DE SORTEOS</strong></h1>
				<ol>
					<li><strong>SOBRE LAS CONDICIONES DE PARTICIPACIÓN EN EL SORTEO</strong></li>
				</ol>
				<p style="padding-left: 40px;">Para participar del sorteo, las personas deben ser naturales, mayores de edad, no estar restringidas por capacidad legal limitada, no actuar en interés y/o nombre de terceros y contar con una de las siguientes nacionalidades: peruana, argentina, boliviana, chilena, colombiana, ecuatoriana, española y mexicana.</p>
				<ol start="2">
					<li><strong>SOBRE LOS TÉRMINOS DEL SORTEO</strong></li>
				</ol>
				<p style="padding-left: 40px;">Al publicar un sorteo, Krear 3D indicará la siguiente información:</p>
				<ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
							<li>Fecha en la cual se llevará a cabo el sorteo.</li>
							<li>Datos y especificaciones sobre el(los) premio(s) ofrecido.</li>
							<li>Cantidad de stock de los premios ofrecidos (en el caso de que sea más de un premio por sorteo).</li>
							<li>Condiciones y restricciones particulares aplicables (en el caso de que hubieren).</li>
						</ul>
					</li>
				</ul>
				<ol start="3">
					<li><strong>SOBRE LA PARTICIPACIÓN EN EL SORTEO</strong></li>
				</ol>
				<p style="padding-left: 40px;">Todas las personas que actúen a título personal y cumplan con lo estipulado en el numeral 1 del presente Reglamento y con nacionalidad de acuerdo a lo indicado de manera particular en el sorteo.</p>
				<ol start="4">
					<li><strong>SOBRE LA DINÁMICA DEL SORTEO Y SELECCIÓN DEL GANADOR</strong></li>
				</ol>
				<p style="padding-left: 40px;">La elección del participante ganador se realizará siguiendo los pasos a continuación:</p>
				<ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
							<li>El Participante debe haber enviado sus datos a través del formulario de la página web, sección sorteos, hasta las 23:59 del día anterior a la fecha del sorteo, cuya información será descargada por Krear 3D en una base de datos. </li>
							<li>Se realizará una transmisión en vivo por una de las Plataformas de Krear 3D en la fecha y horario indicado en el sorteo.</li>
							<li>Se utilizará un software de elección aleatoria para seleccionar a un Participante de la base de datos descargada por Krear 3D.</li>
							<li>Se verificará que dicho Participante haya cumplido los siguientes requisitos y cualquier otro que Krear 3D informe en el sorteo respectivo, previo a notificarlo como Ganador:</li>
							<li>
								<ul style="list-style-type: disc;">
									<li>Seguir como mínimo una de nuestras redes sociales.</li>
									<li>Darle me gusta a la publicación (en cualquiera de las redes sociales).</li>
									<li>Etiquetar a un contacto en los comentarios (en cualquiera de las redes sociales).</li>
									<li>Estar presente en la transmisión en vivo informada en los horarios del sorteo, cuando será anunciado al ganador.</li>
								</ul>
							</li>
							<li>En caso el Participante no haya cumplido con los requisitos, se repetirá el proceso hasta notificar al Ganador.</li>
							<li>Krear 3D tendrá un plazo de 10 días calendarios para hacer el envío del premio o proporcionar una fecha de recojo del premio. La elección del ganador se efectúa al azar, por lo que no existe la posibilidad de reclamo posterior por parte de otros usuarios.</li>
						</ul>
					</li>
				</ul>
				<ol start="5">
					<li><strong>SOBRE LA ENTREGA DEL PREMIO</strong></li>
				</ol>
				<p style="padding-left: 40px;">La entrega del premio se efectuará previa coordinación con el ganador. Se coordinará con el ganador vía correo electrónico, el participante ganador deberá presentar un documento que permita verificar su identidad y firmar un documento que confirme la entrega del premio o, a través de otro medio, declarar que ha quedado conforme con la entrega del premio. En caso el ganador desea algún otro método de envío/recojo distinto al ofrecido por Krear 3D, tendrá que pagarlo previo al envío/entrega del premio. </p>
				<ol start="6">
					<li><strong>SOBRE LAS CONDICIONES Y RESTRICCIONES APLICABLES</strong></li>
				</ol>
				<p style="padding-left: 40px;">La realización del presente sorteo se encuentra sujeto a las siguientes condiciones y restricciones:</p>
				<ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
							<li>El premio no es transferible a terceros, ni canjeable por productos o servicios.</li>
							<li>No se reemplazará, ni repondrá el premio que haya sido sustraído, hurtado, robado, o que se haya deteriorado, perdido o extraviado después de que esté haya sido entregado al participante.</li>
							<li>Cantidad de stock de los premios ofrecidos (en el caso de que sea más de un premio por sorteo).</li>
							<li>Los participantes deberán abstenerse de realizar cualquier conducta con fines o efectos ilícitos, ilegales, fraudulentos, contrarios a lo establecido en el presente documento, a la buena fe y al orden público, lesivos de los derechos e intereses de terceros. Si llevan a cabo dichas conductas, serán excluidos y/o descalificados inmediatamente del sorteo que se esté realizando, y de todos los sorteos que vayan a realizarse en el futuro. Sin perjuicio de ello, se podrán ejercer todas las acciones legales que pudieran corresponder.</li>
						</ul>
					</li>
				</ul>
				<ol start="7">
					<li><strong>SOBRE EL CONSENTIMIENTO DE USO DE IMAGEN Y/O VOZ</strong></li>
				</ol>
				<p style="padding-left: 40px;">El participante ganador otorga su consentimiento para el registro y fijación de su imagen y/o voz en medios sonoros, fotográficos y/o audiovisuales, así como las demás características asociadas a su imagen al momento de la entrega del premio.
				Aunado a ello, autoriza la difusión de las imágenes fotográficas y/o audiovisuales tomadas o grabadas durante la entrega del premio y en las que aparezca su imagen, a través de las de las Plataformas de Krear 3D medios de comunicación físicos o digitales.
				Cabe señalar que el participante ganador renuncia expresamente a exigir cualquier tipo de regalía o compensación por el uso de su imagen y/o voz dentro de los alcances establecidos en este documento.
				</p>
			</div>
			<div class="rff-exp">
				<span>
					<p>Ver más</p>
					<img src="/wp-content/uploads/kyro11/svg/arw.svg" width="10" height="10" alt="Arrow">
				</span>
			</div>
	
		</div>
	</div>
	<script>
		
		$( '.wpcf7' ).on( 'submit.wpcf', function(){
		  if ( $( ".ajax-loader" ).hasClass( "is-active" )) {
			$( 'input[type="submit"]' ).attr( 'disabled', 'disabled' );
			setTimeout( function() {
			  $( 'input[type="submit"]' ).removeAttr( 'disabled' );
			},5000);
		  }
		});
    

		$( ".rff-exp" ).click(function() {
			$( this ).prev().toggleClass( "exp-act" );

			if ($( this ).children().children().first().text() == "Ver menos")
				$( this ).children().children().first().text("Ver más");
			else
				$( this ).children().children().first().text("Ver menos");
		});
		
		$( ".rff-box" ).click(function() {
			$( '.rff-box' ).removeClass('rff-act');
			$( this ).addClass('rff-act');
			
			$( '.rff-unq' ).hide();
			var unq = $( this ).data('slug');
			$( '#'+unq ).show();
			 $('html, body').animate({
				scrollTop: $('#'+unq).offset().top
			}, 200);
		});
	</script>
</div>



<?php get_footer();?>