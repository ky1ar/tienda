<?php 
/**
 * Template Name: Beneficios
 *
 */
get_header();
defined('ABSPATH') || exit;

global $post;
$post_slug = $post->post_name;

include get_theme_file_path('/includes/slidershow.php');

?>
<diV id="ky1-bnf">
	<div class="bnf-one">
		<div class="kyr-o11-wrp">
			<div class="one-flx">
				<img width="240" src="/wp-content/uploads/2023/10/k3dbenf.webp"/>
				<div>
					<p>Tus compras se convierten en puntos para acceder a distintos niveles de experiencia y así obtener más descuentos. Iniciarás siendo un Novato y te esperarán muchos retos para subir de nivel.</p>
					<p>¡Qué esperas para a ser un Máster!</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="bnf-two">
		<div class="two-ttl"><h2>NIVELES DE EXPERIENCIA</h2></div>
		<div class="kyr-o11-wrp">
			<div class="two-bar">
				<div class="two-dot dot-act" data-wdt="100" data-cnt="novato">
					<div class="dot-inn"></div>
					<div class="dot-top"><div class="top-one"><div class="top-two"></div></div></div>
					<div class="dot-box">
						<img src="/wp-content/uploads/2023/10/s0.svg" alt="SVG"/>
						<span>Novato</span>
					</div>
					<div class="dot-arr"></div>
				</div>
				<div class="two-dot" data-wdt="66.66" data-cnt="maker">
					<div class="dot-inn"></div>
					<div class="dot-top"><div class="top-one"><div class="top-two"></div></div></div>
					<div class="dot-box">
						<img src="/wp-content/uploads/2023/10/s2.svg" alt="SVG"/>
						<span>Maker</span>
					</div>
					<div class="dot-arr"></div>
				</div>
				<div class="two-dot" data-wdt="33.33" data-cnt="pro">
					<div class="dot-inn"></div>
					<div class="dot-top"><div class="top-one"><div class="top-two"></div></div></div>
					<div class="dot-box">
						<img src="/wp-content/uploads/2023/10/s3.svg" alt="SVG"/>
						<span>Pro</span>
					</div>
					<div class="dot-arr"></div>
				</div>
				<div class="two-dot" data-wdt="0" data-cnt="master">
					<div class="dot-inn"></div>
					<div class="dot-top"><div class="top-one"><div class="top-two"></div></div></div>
					<div class="dot-box">
						<img src="/wp-content/uploads/2023/10/s4.svg" alt="SVG"/>
						<span>Máster</span>
					</div>
					<div class="dot-arr"></div>
				</div>
				<div class="two-dot-bcg"><span></span><span class="dot-lne"></span></div>
			</div>
		</div>
	</div>
	
	<div class="bnf-thr">
		<div class="kyr-o11-wrp">
			<div id="novato" class="thr-cnt thr-act">
				<div class="one-lft">
					<span>1 - 2000 puntos</span>
					<b>Novato</b>	
				</div>
				<div class="one-rgt">
					<ul>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 5.00</b> en Filamentos o Resinas.</p>
						</li>
					</ul>
				</div>
			</div>

			<div id="maker" class="thr-cnt">
				<div class="one-lft">
					<span>2001 - 5000 puntos</span>
					<b>Maker</b>
				</div>
				<div class="one-rgt">
					<ul>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 5.00</b> en Filamentos o Resinas.</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 20.00</b> en equipos.<br> (Impresoras 3D, Laser, CNC y Escaner 3D)</p>
						</li>
					</ul>
				</div>
			</div>

			<div id="pro" class="thr-cnt">
				<div class="one-lft">
					<span>5001 - 10000 puntos</span>
					<b>Pro</b>
				</div>
				<div class="one-rgt">
					<ul>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 10.00</b> en Filamentos o Resinas.</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 30.00</b> en equipos. <br>(Impresoras 3D, Laser, CNC y Escaner 3D)</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/serv.svg" alt="SVG"/>
							<p><b>01</b> Servicio de armado gratuito en equipos.</p>
						</li>
					</ul>
				</div>
			</div>

			<div id="master" class="thr-cnt">
				<div class="one-lft">
					<span>Más de 10 000 puntos</span>
					<b>Máster</b>
				</div>
				<div class="one-rgt">
					<ul>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 10.00</b> en Filamentos o Resinas.</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 10.00</b> en Upgrades y Repuestos.</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/coup.svg" alt="SVG"/>
							<p>Cupón de descuento de <b>S/ 50.00</b> en equipos. <br>(Impresoras 3D, Laser, CNC y Escaner 3D)</p>
						</li>
						<li>
							<img src="/wp-content/uploads/2023/10/serv.svg" alt="SVG"/>
							<p><b>01</b> Servicio de armado gratuito en equipos.<br><b>01</b> Servicio de mantenimiento preventivo gratuito.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="bnf-for">
		<div class="kyr-o11-wrp">
			<div class="one-flx">
				<div class="one-lft">
					<p>Desbloquea más beneficios siendo parte de</p>
					<h3>KREAR 3D <b>PRIME</b></h3>
				</div>
				<div class="one-rgt">
					<span>Próximamente</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="bnf-fiv">
		<div class="kyr-o11-wrp">
			<div class="fiv-flx">
				<div class="fiv-cnt">
					<span><i>1</i></span>
					<div>
						<h3>Regístrate</h3>
						<p>en nuestra página y forma parte del programa.</p>
					</div>
				</div>
				<div class="fiv-cnt">
					<span><i>2</i></span>
					<div>
						<h3>Acumula</h3>
						<p>puntos con todas tus compras a Krear 3D.</p>
					</div>
				</div>
				<div class="fiv-cnt">
					<span><i>3</i></span>
					<div>
						<h3>Consigue</h3>
						<p>increíbles descuentos y beneficios exclusivos.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="ky1-nrf">
		<div class="rff-frm">
			<div class="kyr-o11-wrp">
				<div class="frm-lft">
					<div>
						<p>Regístrate</p>
						<span>AQUÍ</span>
					</div>
				</div>
				<div class="frm-rgt"><?php echo do_shortcode('[contact-form-7 id="17992" title="Beneficios"]'); ?></div>
			</div>
		</div>
		<div class="rff-img">
			<div class="rff-tt2"><h2>PUNTOS EXTRA</h2></div>
			<ul class="kyr-o11-wrp">
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/facebook.webp" width="32" height="32" alt="Arrow">                          
					<p>Síguenos en Facebook<br><b>100 puntos</b></p>
					<span>Krear 3D</span>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/instagram.webp" width="32" height="32" alt="Arrow">
					<p>Síguenos en Instagram<br><b>100 puntos</b></p>
					<span>@krear3d_peru</span>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/tiktok.webp" width="32" height="32" alt="Arrow">
					<p>Síguenos en Tik Tok<br><b>100 puntos</b></p>
					<span>@krear3d_peru</span>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/04/threads-logo1.png" width="32" height="32" alt="Arrow">
					<p>Síguenos en Threads<br><b>100 puntos</b></p>
					<span>@krear3d_peru</span>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/iconox.webp" width="32" height="32" alt="Arrow">
					<p>Síguenos en X<br><b>100 puntos</b></p>
					<span>@krear3d_peru</span>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/facebook.webp" width="32" height="32" alt="Arrow">
					<p>Síguenos en nuestro grupo de Facebook<br><b>100 puntos</b></p>
					<span>Impresoras 3D Perú</span>
				</li>
			</ul>
			<ul class="kyr-o11-wrp">
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/whatsapp.webp" width="32" height="32" alt="Arrow">
					<p>Únete a nuestro canal de Whatsapp<br><b>100 puntos</b></p>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/resena.webp" width="32" height="32" alt="Arrow">
					<p>Deja una reseña en nuestra Web<br><b>100 puntos</b></p>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/google.webp" width="32" height="32" alt="Arrow">
					<p>Deja una reseña en Google<br><b>200 puntos</b></p>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/torta.webp" width="32" height="32" alt="Arrow">
					<p>Cumpleaños<br><b>200 puntos</b></p>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/estudio.webp" width="32" height="32" alt="Arrow">
					<p>Bono para estudiantes<br><b>200 puntos</b></p>
				</li>
				<li>
					<img class="qst-arr" src="https://tiendakrear3d.com/wp-content/uploads/2024/02/amigo.webp" width="32" height="32" alt="Arrow">
					<p>Refiere a un amigo +1<br><b>300 puntos</b></p>
				</li>
			</ul>
		</div>
		<div class="bnf-qst">
			<div class="kyr-o11-wrp">
				<div class="qst-cnt">
					<h3>Preguntas Frecuentes</h3>
					<ul>
						<li>
							<div class="qst-itm">
								<h4>¿Cómo funcionan los puntos?</h4>
								<p>Tus compras se convierten en puntos para acceder a distintos niveles y así obtener más descuentos. ¡Conforme vayas ganando más experiencia hasta el nivel Master, podrás acceder a más beneficios y descuentos!</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Cuántos puntos me dan las compras?</h4>
								<p>El monto de tus compras se convertirá en puntos, cada Sol de compra es igual a un punto (1 Sol = 1punto).</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Cuáles son los beneficios?</h4>
								<p>Existen diferentes beneficios en cada nivel de experiencia que vas alcanzando. Puedes tener desde descuentos de 50 soles hasta servicios de mantenimiento y armado gratis.</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Los puntos tienen fecha de vencimiento?</h4>
								<p>Sí tienen una fecha límite y puedes revisar todos los detalles en los Términos y Condiciones del Programa de Beneficios Krear 3D.</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Cómo referir a un amigo? </h4>
								<p>¡Lo bueno se comparte! Para referir a un amigo, deberás ser un cliente previo de Krear3D y parte del Programa de Beneficios. Asegúrate de brindarle a tu amigo tu nombre completo y tu DNI. Con ello, podrá acercarse a nuestra tienda, hacer su compra y brindar tus datos. Así, te asignaremos los puntos correspondientes como recompensa por recomendarnos.</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Cómo obtener el bono de estudiante?</h4>
								<p>Si eres estudiante, puedes acceder automáticamente a 200 puntos dentro del Programa de Beneficios. Para ello, nos deberás enviar una constancia de estudios como un carné de educación superior, un reporte de notas, una constancia de matrícula, etc.</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
						</li>
						<li>
							<div class="qst-itm">
								<h4>¿Cómo obtener puntos por mi cumpleaños?</h4>
								<p>¡Krear3D te regala 200 puntos durante el mes de tu cumpleaños! Para poder acceder a ellos, solo deberás hacer una compra y envíar una foto de tu DNI a alguno de nuestros representantes comerciales. Recuerda que los puntos tienen fecha de caducidad.</p>
								<img class="qst-arr" src="/wp-content/uploads/2023/10/arw1.svg" width="16" height="16" alt="Arrow">
							</div>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="rff-tyc">
			<div class="kyr-o11-wrp">
				<div class="rff-crd">
				  <h1><strong>TÉRMINOS Y CONDICIONES PROGRAMA BENEFICIOS KREAR 3D</strong></h1>

				  <ol>
					<li><strong>SOBRE EL PROGRAMA BENEFICIOS KREAR 3D</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">El Programa de Beneficios Krear 3D (en adelante, el “Programa”) es propiedad de Fabricaciones Digitales del Perú S.A. (en adelante, “Krear 3D”); a quienes en adelante se les podrá denominar indistintamente “Administrador del Programa”.</p>
				  <p style="padding-left: 40px;">El Programa ha sido creado con la finalidad de beneficiar a sus clientes, quienes podrán acumular Puntos bajo las condiciones que se indican en este documento, para luego ser canjeados por diversos productos ofrecidos por Krear 3D.</p>

				  <ol start="2">
					<li><strong>FORMAS DE ACCEDER AL PROGRAMA</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Para formar parte del Programa, los clientes de Krear 3D deberán inscribirse en el mismo.</p>
				  <p style="padding-left: 40px;">La inscripción en el Programa se efectúa mediante el registro en nuestra página web, sección beneficios: https://desarrollo.tiendakrear3d.com/beneficios/ o a través de cualquiera de los mecanismos que defina en adelante el Administrador del Programa, los cuales serán informados oportunamente.</p>

				  <ol start="3">
					<li><strong>PARTICIPANTES DEL PROGRAMA</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Serán Beneficiarios del Programa las personas naturales mayores de edad que residan en el territorio peruano, que se hubieren inscrito en el Programa a través de cualquiera de los medios indicados en el Título 2 anterior, y que cumplan con al menos una de las siguientes condiciones:</p>
				  <ul>
					<li style="list-style-type: none;">
					  <ul style="list-style-type: disc;">
						<li>Contar con DNI o RUC 10.</li>
						<li>Realizar comprar al menos 1 vez al mes.</li>
					  </ul>
					</li>
				  </ul>

				  <ol start="4">
					<li><strong>ACUMULACIÓN DE PUNTOS, SU VIGENCIA E INFORMACIÓN</strong></li>
				  </ol>
				  <p style="padding-left: 80px;"><b>4.1 Acumulación de Puntos</b></p>
				  <p style="padding-left: 100px;">Los Beneficiarios generarán y acumularán Puntos del modo y en la forma establecidos en el presente documento.</p>
				  <p style="padding-left: 100px;">La bonificación o acumulación de Puntos se efectuará de acuerdo con las siguientes reglas: </p>
				  <ol>
					<li style="list-style-type: none; margin-left: 2rem;">
					  <ol>
						<li style="list-style-type: none;">
						  <ol style="list-style-type: lower-alpha;" data-mce-style="list-style-type: lower-alpha;">
							<li>Aplica previa inscripción</li>
							<li>
							  <p>Aplica para clientes con DNI o RUC 10.</p>
							  <p>Los puntos serán registrados a la cuenta asociada al número de DNI o RUC 10, el cual deberá estar inscrito en el Programa.</p>
							  <p>En caso la compra se realice y no se indique el DNI o RUC 10 asociado al Programa para emitir la boleta o factura electrónica respectiva, no se registrarán los Puntos generados en la operación respectiva.</p>
							  <p>El registro de los puntos, producto de compras en nuestra web www.desarrollo.tiendakrear3d.com, canales de WhatsApp canales de redes sociales, de manera presencial en nuestra tienda ubicada en Calle Javier Fernandez 262 - Miraflores o cualquier otro medio, se realizará en un periodo máximo de 7 días calendario.</p>
							</li>
							<li>Los Beneficiarios podrán acumular 1 punto por cada sol de compra que realicen.</li>
							<li>Para no perder los puntos se requiere que mínimo el beneficiario realice una compra mensual. Por cada mes que no se realice alguna compra se procederá a descontar 100 puntos.</li>
							<li>En caso el beneficiario no llegue a realizar alguna compra por 6 meses todos los puntos serán eliminados de manera automática sin lugar a reclamo.</li>
							<li>La aplicación de los beneficios se realizará 7 días calendario después de haber realizado la compra.</li>
						  </ol>
						</li>
					  </ol>
					</li>
				  </ol>
				  <p style="padding-left: 80px; margin-left: 1rem;"><b>4.1.1 Procedimiento para validar puntos por compras</b></p>
				  <p style="padding-left: 100px; margin-left: 2rem;">La equivalencia de puntos por compra es un punto por cada sol (s/1). Por ejemplo, el cliente que haga una compra por el importe de s/ 500 ganará 500 puntos.</p>
				  <p style="padding-left: 100px; margin-left: 2rem;">Para hacer efectiva la entrega de sus puntos, el cliente deberá hacer una compra mediante cualquiera de nuestros canales de venta (tienda física, web o vía WhatsApp). Una vez realizado el pago, el comercial verificará que el cliente esté inscrito en el Programa de Beneficios, así como su fecha de inscripción. Con ello, el comercial procederá a la asignación de la cantidad de puntos correspondiente por cada compra que realice el cliente.</p>
				  <p style="padding-left: 100px; margin-left: 2rem;">En caso de que el cliente no se encuentre inscrito en el Programa de Beneficios al momento de hacer la compra, el comercial le comentará la existencia del mismo y motivará que se inscriba.</p>
                  <p style="padding-left: 100px; margin-left: 2rem;">Los puntos se registran por cada compra realizada después de la inscripción.</p>
					
				  <p style="padding-left: 80px; margin-left: 1rem;"><b>4.1.2 Procedimiento para validar puntos extra</b></p>
					
				  <p style="padding-left: 80px; margin-left: 3.2rem;"><b>4.1.2.1 Validar los puntos adquiridos mediante redes sociales</b></p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">1) El usuario que cumpla con seguir las distintas cuentas de Krear3D en Facebook (Krear 3D - Impresoras 3D), Instagram (@krear3d_peru), X (krear3d_peru), Threads (@krear3d_peru), TikTok (krear3d_peru), deberá enviar una captura de pantalla de cada red social donde se evidencie que sigue la página, a uno de los representantes comerciales de la empresa.</p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">2) El comercial validará la información enviada por el cliente con el área de marketing, para corroborar que el usuario si esté en la lista de seguidores. Una vez validada la información, el comercial asignará los puntos correspondientes al usuario.</p>					
				  <p style="padding-left: 100px; margin-left:4.1rem;">3) El mismo procedimiento se seguirá para verificar las reseñas de Google en Tienda Krear3D - Impresoras 3D (https://bit.ly/474zISD)  y las reseñas que dejen los usuarios en la web de la empresa (www.tiendakrear3d.com)</p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">4) En el caso de canales de WhatsApp, el comercial asignará los puntos correspondientes cuando reciba la captura de pantalla del cliente.</p>
					
				  <p style="padding-left: 80px; margin-left: 3.2rem;"><b>4.1.2.2  Cómo referir a un amigo</b></p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">Para acceder a los puntos de recompensa por referir a un amigo, el referendo deberá ser un cliente previo de Krear3D y parte del Programa de Beneficios como requisito obligatorio. El referido se acercará a la tienda y realizará una compra. El referido deberá ser un cliente nuevo de Krear3D, que no haya realizado una compra con anterioridad. Al final de la transacción, el referido indicará al comercial que viene por recomendación de un referendo. El comercial le preguntará el nombre y el DNI del referendo y validará que sea cliente previo de la empresa y que esté inscrito en el Programa de Beneficios.</p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">Validada la información, el comercial asignará los puntos correspondientes a manera de recompensa al que recomendó.</p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">En caso de que ni el referendo, como el referido estén inscritos al programa, el comercial comentará acerca del programa y les invitará a inscribirse.</p>
					
				  <p style="padding-left: 80px; margin-left: 3.2rem;"><b>4.1.2.3  Bono para estudiantes</b></p>
				  <p style="padding-left: 100px; margin-left: 4.1rem;">En caso el inscrito en el Programa de Beneficios sea estudiante, deberá enviar a algún representante comercial un documento que verifique su condición de alumno. El documento podría ser: carné universitario o técnico emitido por SUNEDU, un reporte de notas, constancia de matrícula, etc. Todos los documentos deberán ser vigentes, es decir, corresponder al año en curso en caso de carné, o corresponder al ciclo lectivo correspondiente, al momento de ser enviados para su validación.</p>

				  <p style="padding-left: 80px; margin-left: 3.2rem;"><b>4.1.2.4 Puntos por mes de cumpleaños</b></p>
				  <p style="padding-left: 100px; margin-left: 4.1rem; ">El bono de puntos por cumpleaños se otorgará solo durante el mes de cumpleaños del beneficiario del programa. Para poder hacer efectiva la entrega de los puntos, el beneficiario deberá hacer una compra durante el mes de su cumpleaños y enviar a alguno de nuestros representantes comerciales un documento donde sea visible su fecha de nacimiento, como DNI, pasaporte, carné de extranjería o licencia de conducir. Con ello, el comercial validará los datos y entregará los puntos que corresponden. Estos puntos se añadirán al acumulado del beneficiario. La fecha de caducidad de los puntos ya acumulados no cambiará con la adición de los puntos de cumpleaños, por lo que estos vencerán en la fecha que corresponda.</p>
					
				  <p style="padding-left: 80px;"><b>4.2 Vigencia de Puntos</b></p>
				  <p style="padding-left: 100px; margin-left: 6px">La vigencia de los Puntos será de 12 (doce) meses calendario contados desde la fecha en que se generaron.</p>
				  <p style="padding-left: 100px; margin-left: 6px">Expirado este plazo sin que los Puntos fueran canjeados, éstos caducarán, salvo que Krear 3D hubieran determinado una vigencia distinta para clientes con algún segmento especial o aquellos Puntos generados en promociones especiales, lo que será debidamente informado a los Beneficiarios por los medios idóneos.</p>
				  <p style="padding-left: 100px; margin-left: 6px">Asimismo, caducarán los Puntos por renuncia del Beneficiario al Programa o por fallecimiento de éste.</p>
					
				  <p style="padding-left: 80px;"><b>4.3 Transferencia de Puntos</b></p>
				  <p style="padding-left: 100px; margin-left: 6px">Los Puntos acumulados por los Beneficiarios no son transferibles ni heredables.</p>

				  <p style="padding-left: 80px;"><b>4.4 Exclusiones de acumulación de Puntos</b></p>
				  <p style="padding-left: 100px; margin-left: 6px">No acumularán Puntos ninguna de las siguientes operaciones:</p>
				  <ol>
					<li style="list-style-type: none;">
					  <ol>
						<li style="list-style-type: none; margin-left: 2.6rem;">
						  <ol style="list-style-type: lower-alpha;" data-mce-style="list-style-type: lower-alpha;">
							<li>Compras fraudulentas, uso de tarjetas clonadas, billetes falsos, uso indebido de tarjetas de crédito o débito o cualquier otro método ilícito para recibir el comprobante de pago electrónico.</li>
							<li>Y, en cualquier otro caso que el Administrador del Programa determine en el futuro, lo que será comunicado oportunamente a los Beneficiarios, al menos mediante una publicación en el sitio web www.desarrollo.tiendakrear3d.com/.</li>
						  </ol>
						</li>
					  </ol>
					</li>
				  </ol>

				  <p style="padding-left: 80px;"><b>4.5 Información de Puntos acumulados</b></p>
				  <p style="padding-left: 100px;margin-left: 6px">Los Beneficiaros podrán informarse acerca de la cantidad de Puntos acumulados por medio de cualquiera de nuestros asesores comerciales vía whatsapp, llamada telefónica y presencialmente en nuestra tienda. Cualquier otro medio será informado a los Beneficiarios oportunamente y a través de los medios que el Banco considere oportuno.</p>

				  <ol start="5">
					<li><strong>CANJE DE PUNTOS</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Los Puntos acumulados no representan dinero en efectivo, sin embargo, le permiten al Beneficiario, la posibilidad de recibir cupones de descuentos y beneficios (que será actualizado frecuentemente por el Administrador del Programa), de acuerdo a la Tabla de Beneficios en el Anexo.</p>

				  <p style="padding-left: 40px;">Los canjes solo podrán ser realizados por el cliente titular de la cuenta registrada.</p>

				  <p style="padding-left: 40px;"><b>Canales de canje:</b></p>
				  <ul>
					<li style="list-style-type: none;">
						<ul style="list-style-type: disc;">
						  <li>Mediante nuestra web: www.desarrollo.tiendakrear3d.com</li>
						  <li>De manera presencial en nuestra tienda ubicada en: Caller Javier Fernandez 262 - Miraflores.</li>
						  <li>Por medio de los canales de WhastApp oficiales de Krear 3D.</li>
						  <li>Por medio de las redes sociales oficiales de Krear 3D.</li>
						</ul>
					</li>
				  </ul>
				  <p style="padding-left: 40px;">Krear 3D se reserva el derecho de determinar los productos y/o servicios que podrán ser canjeados en cada canal, así como, el periodo de tiempo para canje.</p>
				  <p style="padding-left: 40px;">Los Puntos canjeados se imputarán a los Puntos acumulados más antiguos.</p>

				  <ol start="6">
					<li><strong>DESCUENTOS DE PUNTOS</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Krear 3D está facultado para descontar todos aquellos Puntos que se hubiesen bonificado a la cuenta de los Beneficiarios, respecto de los cuales concurra alguna de las siguientes circunstancias:</p>
				  <ul>
					<li style="list-style-type: none;">
					  <ul style="list-style-type: disc;">
						<li>Puntos bonificados por compras o transacciones que sean posteriormente anuladas o que tuvieren una nota de crédito parcial o total.</li>
						<li>Puntos bonificados por operaciones que de conformidad con el título 4.4. de del programa no acumulan puntos.</li>
					  </ul>
					</li>
				  </ul>

				  <ol start="7">
					<li><strong>CONSIDERACIONES GENERALES</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Krear 3D se reserva el derecho de bloquear para el canje o de cancelar su participación en el Programa, a cualquier Beneficiario que a su juicio y discreción haya realizado o intentado realizar cualquier engaño, fraude, transacción indebida, abuso, simulación o cualquier delito, falta o conducta inapropiada para tomar ventaja inadecuada del Programa.</p>
				  <p style="padding-left: 40px;">En tales casos, el Beneficiario pierde automáticamente todos sus derechos y beneficios del Programa, incluyendo la totalidad de Puntos acumulados hasta la fecha por el Beneficiario titular y adicional o por acumular, sin perjuicio de las acciones administrativas o legales que Krear 3D pudiera ejercer en su contra. Asimismo, Krear 3D se reserva el derecho de revisar en cualquier momento los saldos de Puntos acumulados por los Beneficiarios y eliminar los generados erróneamente.</p>

				  <ol start="8">
					<li><strong>DATOS PERSONALES</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Los datos personales ingresados en el formulario y/o utilizados para la afiliación al Programa, así como los datos relacionados a las transacciones que se efectúen para la ejecución del Programa, serán tratados de manera conjunta por Krear 3D para las siguientes finalidades:</p>
				  <ul>
					<li style="list-style-type: none;">
					  <ul style="list-style-type: disc;">
						<li>Habilitar la participación del Socio en el Programa.</li>
						<li>Crear la cuenta del Programa y gestión de la misma.</li>
						<li>Realizar el abono de puntos.</li>
						<li>Enviar los reportes de los puntos acumulados y productos disponibles para el canje.</li>
						<li>Identificar al Cliente para el canje de Puntos.</li>
						<li>Acciones de marketing mediante llamadas, correos, mensajes SMS, mensajes por Whatsapp, mensajes por las redes sociales oficiales para promocionar las actividades de Krear 3D.</li>
						<li>Revisión de las causales de exclusión señaladas en el numeral 4.4. y 7. del presente Reglamento.</li>
					  </ul>
					</li>
				  </ul>

				  <ol start="9">
					<li><strong>VIGENCIA DEL PROGRAMA PUNTOS</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">El plazo de vigencia del Programa es indefinido. Sin embargo, Krear 3D podrá suspenderlo temporal o definitivamente, decisión que será comunicada de manera previa a los Beneficiarios. </p>
				  <p style="padding-left: 40px;">En caso Krear 3D decida cancelar o suspender el Programa, el Beneficiarios podrá efectuar el canje de sus Puntos por productos y/o servicios dentro del plazo que Krear 3D informe en la mencionada comunicación. Una vez vencido este plazo, se eliminará la totalidad de los Puntos acumulados por el Beneficiario.</p>

				  <ol start="10">
					<li><strong>MODIFICACIONES</strong></li>
				  </ol>
				  <p style="padding-left: 40px;">Los presentes términos y condiciones pueden ser actualizados y/o modificados de forma constante, por lo que es responsabilidad de los Beneficiarios revisar la versión vigente.</p>
					<div class="rff-tbl">
					<table>
						<tr>
						  <th>PUNTOS</th>
						  <th>DETALLE</th>
						</tr>

						<tr>
						  <td>1 A 2000 PUNTOS</td>
						  <td>Cupon de descuento de S/.5 en filamentos o resinas.</td>
						</tr>

						<tr>
						  <td>2001 A 5000 PUNTOS</td>
						  <td>
							<p>Cupón de descuento de S/.5 en filamentos o resinas.</p>
							<p>Cupón de descuento de S/.20 en equipos 	(impresoras 3D, láser, CNC, escáner 3D).</p>
						  </td>
						</tr>

						<tr>
						  <td>5001 A 10000 PUNTOS</td>
						  <td>
							<p>Cupón de descuento de S/.10 en filamentos o resinas.</p>
							<p>Cupón de descuento de S/.30 en equipos (impresoras 3D, láser, CNC, escáner 3D).</p>
							<p>01 servicio gratuito de armado en equipos.</p>
						  </td>
						</tr>

						<tr>
						  <td>MÁS DE 10 000 PUNTOS</td>
						  <td>
							<p>Cupón de descuento de S/.10 en filamentos o resinas.</p>
							<p>Cupón de descuento de S/.10 en upgrades y repuestos.</p>
							<p>Cupón de descuento de S/.50 en equipos (impresoras 3D, láser, CNC, escáner 3D).</p>
							<p>01 servicio gratuito de armado en equipos.</p>
							<p>01 servicio gratuito de mantenimiento preventivo.</p>
						  </td>
						</tr>
					  </table>
					</div>
				</div>
				
				
				<div class="rff-exp">
					<span>
						<p>Ver más</p>
						<img src="/wp-content/uploads/kyro11/svg/arw.svg" width="10" height="10" alt="Arrow">
					</span>
				</div>

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
		
		$( "#bnf-lnk" ).click(function() {
			 $('html, body').animate({
				scrollTop: $('#ky1-nrf').offset().top
			}, 500);
		});
		
		$( ".two-dot" ).click(function() {
			$( '.two-dot' ).removeClass('dot-act');
			$( '.thr-cnt' ).removeClass('thr-act'); 
			
			$( this ).addClass('dot-act');
			var lng = $( this ).data("wdt");
			var cnt = $( this ).data("cnt");
			
			$( '#' + cnt ).addClass('thr-act');
			$( '.dot-lne' ).css("right", lng + '%');
		});
		
		$( ".qst-itm" ).click(function() {
			$( this ).find("p").slideToggle( "normal", function() {});
		});
		
	</script>
</diV>


<?php get_footer();?>