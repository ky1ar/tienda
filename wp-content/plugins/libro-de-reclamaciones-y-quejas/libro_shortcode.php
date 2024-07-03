<?php
add_filter( 'template_include', 'rt_libro_lrq_reclamacion_template' );

// Page template filter callback
function rt_libro_lrq_reclamacion_template( $template ) {
    $page_libro_id = get_option('libro_setting_page');
    if (is_page($page_libro_id)) {
        $template = WP_PLUGIN_DIR . '/libro-de-reclamaciones-y-quejas/template/rt-libro-lrq-full-template.php';
    }
    return $template;
}

function rt_libro_lrq_grabar_libro_reclamacion( $libro_data ) {
    $libro_data['departamento'] = rt_libro_lrq_get_departamento_por_id_one($libro_data['departamento']);
    $libro_data['provincia'] = rt_libro_lrq_get_provincia_por_id_one($libro_data['provincia']);
    $libro_data['distrito'] = rt_libro_lrq_get_distrito_por_id_one($libro_data['distrito']);

    global $wpdb;
    $table_name = $wpdb->prefix . "rt_libro";
    $wpdb->insert($table_name, $libro_data);
    $libro_id = $wpdb->insert_id;

    if ($libro_id) {
        rt_libro_lrq_enviar_mail_libro_reclamacion($libro_data);
    } else {
        $libro_id = 0;
    }
    return $libro_id;
}

function rt_libro_lrq_get_type_doc($tipo_doc)
{
    $nombre_tipo_doc = '';
    switch ($tipo_doc){
        case 1:
            $nombre_tipo_doc = "DNI";
            break;
        case 2:
            $nombre_tipo_doc = "CE";
            break;
        case 3:
            $nombre_tipo_doc = "Passport";
            break;
        case 4:
            $nombre_tipo_doc = "RUC";
            break;
    }
    return $nombre_tipo_doc;
}

function rt_libro_lrq_enviar_mail_libro_reclamacion($libro_data)
{
    // Email para el administradora
    $subject = __('Claim sent from', 'rt-libro') .' ' . get_option('blogname');
    $subject = __('Claims Book Registry', 'rt-libro');
    
    //EDIT KYRO11 - 07/02/2023
    $message = 'Se ha registrado una nueva queja:';
    $message .= "\r\n\r\n".__('Name', 'rt-libro') .": ". $libro_data['nombre'];
    $message .= "\r\n".__('First Lastname', 'rt-libro') .": ". $libro_data['apellido_paterno'];
    $message .= "\r\n".__('Second Lastname', 'rt-libro') .": ". $libro_data['apellido_materno'];
    $message .= "\r\n\r\n".__('Type of documentation', 'rt-libro') .": ". rt_libro_lrq_get_type_doc($libro_data['tipo_doc']);
    $message .= "\r\n".__('Documentation number', 'rt-libro') .": ". $libro_data['nro_documento'];
    $message .= "\r\n\r\n".__('Celphone', 'rt-libro') .": ". $libro_data['fono'];
    $message .= "\r\n\r\n".__('Department', 'rt-libro') .": ". $libro_data['departamento'];
    $message .= "\r\n".__('Province', 'rt-libro') .": ". $libro_data['provincia'];
    $message .= "\r\n".__('District', 'rt-libro') .": ". $libro_data['distrito'];
    $message .= "\r\n".__('Address', 'rt-libro') .": ". $libro_data['direccion'];
    $message .= "\r\n".__('Reference', 'rt-libro') .": ". $libro_data['referencia'];
    $message .= "\r\n\r\n".__('Email', 'rt-libro') .": ". $libro_data['email'];
    $message .= "\r\n\r\n".__('Are you a minor?', 'rt-libro') .": ". ($libro_data['flag_menor'] == '1' ? __('Yes', 'rt-libro') : __('No', 'rt-libro'));
    if($libro_data['flag_menor']){
        $message .= "\r\n".__('Name of tutor', 'rt-libro') .": ". $libro_data['nombre_tutor'];
        $message .= "\r\n".__('Email of tutor', 'rt-libro') .": ". $libro_data['email_tutor'];
        $message .= "\r\n".__('Type of documentation of tutor', 'rt-libro') .": ". rt_libro_lrq_get_type_doc($libro_data['tipo_doc_tutor']);
        $message .= "\r\n".__('Number of document of tutor', 'rt-libro') .": ". $libro_data['numero_documento_tutor'];
    }
    $message .= "\r\n\r\n".__('Claim Type', 'rt-libro') .": ". ($libro_data['tipo_reclamacion'] == 1 ? __('Claim', 'rt-libro') : __('Complain', 'rt-libro'));
    $message .= "\r\n".__('Type of consumption', 'rt-libro') .": ". ($libro_data['tipo_consumo']==1 ? __('Product', 'rt-libro') : __('Service', 'rt-libro'));
    $message .= "\r\n".__('Order No.', 'rt-libro') .": ". $libro_data['nro_pedido'];
    $message .= "\r\n".__('Claim / complaint date', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_reclamo']));
    $message .= "\r\n\r\n".__('Provider', 'rt-libro') .": ". $libro_data['proveedor'];
    $message .= "\r\n".__('Reclaimed amount', 'rt-libro') .": ". $libro_data['monto_reclamado'];
    $message .= "\r\n\r\n".__('Description of the product or service', 'rt-libro') .": ". $libro_data['descripcion'];
    $message .= "\r\n\r\n".__('Date of purchase', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_compra']));
    $message .= "\r\n".__('Date of Consumption', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_consumo']));
    $message .= "\r\n".__('Expiration date', 'rt-libro') .": " . date("d/m/Y", strtotime($libro_data['fch_vencimiento']));
    $message .= "\r\n\r\n".__('Detail of the Claim / Complaint, as indicated by the client', 'rt-libro') .": ". $libro_data['detalle'];
    $message .= "\r\n\r\n".__('Client order', 'rt-libro') .": ". $libro_data['pedido_cliente'];
    
    $headers = array(
        'From: '. $libro_data['nombre'] . ' <' . $libro_data['email'] . '>', 
        'CC: Brenda Zamora <administracion2@krear3d.com>'
    );
    $mailResult = wp_mail('Leslie Gallegos <administracion@krear3d.com>', $subject, $message, $headers);
    
    //$message = __('A new complaint / complaint was registered.', 'rt-libro');
    //$headers = __('From: ', 'rt-libro') .' '. $libro_data['nombre'] . ' <' . $libro_data['email'] . '>' . "\r\n";
    //$mailResult = wp_mail(get_option('admin_email'), $subject, $message, $headers);
    
    
    
    // Email para el usuario
    $message_user = __('Dear:', 'rt-libro') . " " ." {$libro_data['nombre']}  {$libro_data['apellido_paterno']} ,\r\n\r\n".__('Thank you very much for leaving us your opinion about our services.', 'rt-libro')."\r\n\r\n".__('Your claim has been successfully received.', 'rt-libro');
    $message_user .= "\r\n\r\n".__('Name', 'rt-libro') .": ". $libro_data['nombre'];
    $message_user .= "\r\n".__('First Lastname', 'rt-libro') .": ". $libro_data['apellido_paterno'];
    $message_user .= "\r\n".__('Second Lastname', 'rt-libro') .": ". $libro_data['apellido_materno'];
    $message_user .= "\r\n\r\n".__('Type of documentation', 'rt-libro') .": ". rt_libro_lrq_get_type_doc($libro_data['tipo_doc']);
    $message_user .= "\r\n".__('Documentation number', 'rt-libro') .": ". $libro_data['nro_documento'];
    $message_user .= "\r\n\r\n".__('Celphone', 'rt-libro') .": ". $libro_data['fono'];
    $message_user .= "\r\n\r\n".__('Department', 'rt-libro') .": ". $libro_data['departamento'];
    $message_user .= "\r\n".__('Province', 'rt-libro') .": ". $libro_data['provincia'];
    $message_user .= "\r\n".__('District', 'rt-libro') .": ". $libro_data['distrito'];
    $message_user .= "\r\n".__('Address', 'rt-libro') .": ". $libro_data['direccion'];
    $message_user .= "\r\n".__('Reference', 'rt-libro') .": ". $libro_data['referencia'];
    $message_user .= "\r\n\r\n".__('Email', 'rt-libro') .": ". $libro_data['email'];
    $message_user .= "\r\n\r\n".__('Are you a minor?', 'rt-libro') .": ". ($libro_data['flag_menor'] == '1' ? __('Yes', 'rt-libro') : __('No', 'rt-libro'));
    if($libro_data['flag_menor']){
        $message_user .= "\r\n\r\n".__('Name of tutor', 'rt-libro') .": ". $libro_data['nombre_tutor'];
        $message_user .= "\r\n\r\n".__('Email of tutor', 'rt-libro') .": ". $libro_data['email_tutor'];
        $message_user .= "\r\n\r\n".__('Type of documentation of tutor', 'rt-libro') .": ". rt_libro_lrq_get_type_doc($libro_data['tipo_doc_tutor']);
        $message_user .= "\r\n\r\n".__('Number of document of tutor', 'rt-libro') .": ". $libro_data['numero_documento_tutor'];
    }
    $message_user .= "\r\n\r\n".__('Claim Type', 'rt-libro') .": ". ($libro_data['tipo_reclamacion'] == 1 ? __('Claim', 'rt-libro') : __('Complain', 'rt-libro'));
    $message_user .= "\r\n".__('Type of consumption', 'rt-libro') .": ". ($libro_data['tipo_consumo']==1 ? __('Product', 'rt-libro') : __('Service', 'rt-libro'));
    $message_user .= "\r\n".__('Order No.', 'rt-libro') .": ". $libro_data['nro_pedido'];
    $message_user .= "\r\n".__('Claim / complaint date', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_reclamo']));
    $message_user .= "\r\n\r\n".__('Provider', 'rt-libro') .": ". $libro_data['proveedor'];
    $message_user .= "\r\n".__('Reclaimed amount', 'rt-libro') .": ". $libro_data['monto_reclamado'];
    $message_user .= "\r\n\r\n".__('Description of the product or service', 'rt-libro') .": ". $libro_data['descripcion'];
    $message_user .= "\r\n\r\n".__('Date of purchase', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_compra']));
    $message_user .= "\r\n".__('Date of Consumption', 'rt-libro') .": ". date("d/m/Y", strtotime($libro_data['fch_consumo']));
    $message_user .= "\r\n".__('Expiration date', 'rt-libro') .": " . date("d/m/Y", strtotime($libro_data['fch_vencimiento']));
    $message_user .= "\r\n\r\n".__('Detail of the Claim / Complaint, as indicated by the client', 'rt-libro') .": ". $libro_data['detalle'];
    $message_user .= "\r\n\r\n".__('Client order', 'rt-libro') .": ". $libro_data['pedido_cliente'];

    $message_user .= "\r\n\r\n".__('Atte.', 'rt-libro')." \r\n\r\n". get_option('blogname');
    $headers = __('From: ', 'rt-libro') .' '. get_option('blogname') . ' <'.get_option('admin_email').'>' . "\r\n";
    wp_mail($libro_data['email'], __('We have received your claim', 'rt-libro'), $message_user, $headers);
}

function rt_libro_lrq_view_page()
{
    $html = '';
    if (!is_admin()) {
        wp_register_script('libro_script_validate', plugins_url('js/jquery.validate.min.js', __FILE__), array('jquery'), '1.10', true);
        wp_enqueue_script('libro_script_validate');
        wp_register_style('libro_script_admin', plugins_url('css/libro_admin.css', __FILE__), array(), '0.0.4');
        wp_enqueue_style('libro_script_admin');
        wp_register_script('libro_script_admin', plugins_url('js/libro_script_admin.js', __FILE__), array(), '0.0.2');
        wp_enqueue_script('libro_script_admin');

        global $rpt;
        global $libro_id;
        $rpt = 3;
        if (isset($_POST['guardar_libro_reclamacion'])) {
            $libro_data = array(
                'nombre' => sanitize_text_field($_POST['nombres']),
                'apellido_paterno' => sanitize_text_field($_POST['paterno']),
                'apellido_materno' => sanitize_text_field($_POST['materno']),
                'tipo_doc' => sanitize_text_field($_POST['tipo_doc']),
                'nro_documento' => sanitize_text_field($_POST['nro_doc']),
                'fono' => sanitize_text_field($_POST['cel']),
                'email' => sanitize_email($_POST['correo']),
                'direccion' => sanitize_text_field($_POST['direccion']),
                'referencia' => sanitize_text_field($_POST['referencia']),
                'departamento' => sanitize_text_field($_POST['dep']),
                'provincia' => sanitize_text_field($_POST['prov']),
                'distrito' => sanitize_text_field($_POST['dist']),
                'flag_menor' => sanitize_text_field($_POST['flag_menor']),
                'nombre_tutor' => sanitize_text_field($_POST['nombre_tutor']),
                'email_tutor' => sanitize_text_field($_POST['correo_tutor']),
                'tipo_doc_tutor' => sanitize_text_field($_POST['tipo_doc_tutor']),
                'numero_documento_tutor' => sanitize_text_field($_POST['nro_doc_tutor']),
                'tipo_reclamacion' => sanitize_text_field($_POST['tipo_reclamo']),
                'tipo_consumo' => sanitize_text_field($_POST['tipo_consumo']),
                'nro_pedido' => sanitize_text_field($_POST['nro_pedido']),
                'fch_reclamo' => sanitize_text_field($today = date("Y-m-d", time())),
                'descripcion' => sanitize_text_field($_POST['descripcion']),
                'proveedor' => sanitize_text_field($_POST['proveedor']),
                'fch_compra' => sanitize_text_field($_POST['fch_compra']),
                'fch_consumo' => sanitize_text_field($_POST['fch_consumo']),
                'fch_vencimiento' => sanitize_text_field($_POST['fch_vencimiento']),
                'detalle' => sanitize_text_field($_POST['detalle_reclamo']),
                'pedido_cliente' => sanitize_text_field($_POST['pedido_cliente']),
                'monto_reclamado' => sanitize_text_field($_POST['monto_reclamado']),
                'acepta_contenido' => sanitize_text_field($_POST['acepto']),
                'acepta_politica' => sanitize_text_field($_POST['politica']),
                'estado' => 1,
            );
            $libro_id = rt_libro_lrq_grabar_libro_reclamacion($libro_data);
        }
        $html .= '
        <section id="kyr-o11-ldr" class="kyr-o11-wrp">';
        $html .= rt_libro_lrq_html_form_libro_reclamacion();
        $html .= '</section>';
    }
    return $html;
}

add_shortcode('libro_page', 'rt_libro_lrq_view_page');

function rt_libro_lrq_html_form_libro_reclamacion()
{
    $departamentos = rt_libro_lrq_get_departamento_front();
    $page_libro_url = ( get_option( 'libro_setting_url' ) == '' ? '#' : get_option( 'libro_setting_url' ) );
    $html = '';
    $today = date("d/m/Y", time());

    $html = 
	'<form id="rt_form_libro" action="" method="post">
        <div id="responsive-form">';

    if ( $GLOBALS['libro_id'] ) {
        $html .= 
			'<ul>
				<li>'.__('Your claim / complaint was registered:', 'rt-libro').'</li>
				<li>N°: 00'.$GLOBALS['libro_id'].'</li>
			</ul>
                    ';
    } elseif ($GLOBALS['rpt'] == 0) {
        $html .= 
			'<ul>
				<li>'.__('Your claim / complaint was NOT registered', 'rt-libro').'</li>
			</ul>';
    }

	//<h2 class="title">Identificación del consumidor reclamante <b class="alert">* Datos requeridos</b></h2>
    $html .= '
			<ul class="k11-ldr-cnt">
				<h2 class="title"><i>1</i>Datos de la persona que presenta el reclamo <b class="alert">* Datos requeridos</b></h2>
				

				<li>Tipo de Documento <b class="alert">*</b>
					<select id="tipo_doc" name="tipo_doc" tabindex="-1" aria-hidden="true" class="required">
						<option value="">Seleccione</option>
						<option value="1">DNI</option>
						<option value="2">CE</option>
						<option value="3">Pasaporte</option>
						<option value="4">RUC</option>
					</select>
				</li>
				<li>Número de Documento <b class="alert">*</b>
					<input type="text" name="nro_doc" value="" placeholder="Número de Documento " class="required">
				</li>


				<li>Nombres <b class="alert">*</b>
					<input type="text" name="nombres" value="" class="required" placeholder="Nombres">
				</li>
				<li>Primer Apellido <b class="alert">*</b>
					<input type="text" name="paterno" value="" class="required" placeholder="Primer Apellido">
				</li>
				<li>Segundo Apellido <b class="alert">*</b>
					<input type="text" name="materno" value="" class="required" placeholder="Segundo Apellido">
				</li>


				<li>Departamento <b class="alert">*</b>
					<select id="dep" name="dep" tabindex="-1" aria-hidden="true" class="required">
						<option value="">Seleccionar Departamento</option>';
						foreach ($departamentos as $depa) { $html .= '<option value="' . $depa[ 'idDepa' ] . '">' . $depa[ 'departamento' ] . '</option>'; }
					$html .=  '</select>
				</li>
				<li>Provincia  <b class="alert">*</b>
					<select id="prov" name="prov" tabindex="-1" aria-hidden="true" class="required">
						<option value="">Seleccionar Provincia</option>
					</select>
				</li>
				<li>Distrito <b class="alert">*</b>
					<select id="dist" name="dist" tabindex="-1" aria-hidden="true" class="required">
						<option value="">Seleccionar Distrito</option>
					</select>
				</li>
				

				<li>Dirección <b class="alert">*</b>
					<input type="text" name="direccion" value="" placeholder="Dirección" class="required">
				</li>
				<li>Referencia
					<input type="text" name="referencia" value="" id="referencia" placeholder="Referencia">
				</li>


				<li>Celular <b class="alert">*</b>
					<input type="text" name="cel" value="" placeholder="Número de Celular" class="required">
				</li>
				<li>Correo Electrónico <b class="alert">*</b>
					<input type="text" name="correo" value="" placeholder="Correo Electrónico" class="required">
				</li>


				<ul class="k11-ldr-mnr">
					<li>Menor de edad</li>
					<li>Sí <input type="radio" id="si" class="edad" name="flag_menor" value="1"></li>
					<li>No <input type="radio" id="no" class="edad" name="flag_menor" value="0"></li>
				</ul>

				<ul id="datos_tutor" class="k11-ldr-ttr" style="display: none;">
					<h2 class="title">Padre / Madre / Tutor</h2>
					<li>Nombre 
						<input type="text" name="nombre_tutor" value="" placeholder="Nombre" >
					</li>
					<li>Correo Electrónico 
						<input type="text" name="correo_tutor" value="" placeholder="Correo Electrónico">
					</li>
					<li>Tipo de Documento 
						<select id="tipo_doc_tutor" name="tipo_doc_tutor" tabindex="-1" aria-hidden="true">
							<option value="">Seleccione</option>
							<option value="1">DNI</option>
							<option value="2">CE</option>
							<option value="3">Pasaporte</option>
							<option value="4">RUC</option>
						</select>
					</li>
					<li>Número de Documento <b class="alert">*</b>
						<input type="text" name="nro_doc" value="" placeholder="Número de Documento " class="required">
					</li>
				</ul>
			</ul>


            <ul class="k11-ldr-cnt">
				<h2 class="title"><i>2</i>Información general <b class="alert">* Datos requeridos</b></h2>


				<li style="display:none">Proveedor
                    <input type="text" name="proveedor" value="" placeholder="Proveedor">
                </li>
				<li>Número de Pedido <b class="alert">*</b>
                    <input type="text" name="nro_pedido" value="" placeholder="Nº Pedido" class="required">
                </li>
				<li>Tipo de Consumo <b class="alert">*</b>
					<select id="tipo_consumo" name="tipo_consumo" tabindex="-1" aria-hidden="true" class="required">
						<option value="">Tipo de Consumo</option>
						<option value="1">Producto</option>
						<option value="2">Servicio</option>
					</select>
				</li>
				<li>Monto reclamado ( S/ ) 
                    <input type="text" name="monto_reclamado" value="" placeholder="Monto reclamado">
                </li>
				<li>Fecha de Compra
					<input type="date" name="fch_compra" value="" placeholder="00/00/0000" >
				</li>
				<li style="display:none">Fecha de Consumo
                    <input type="date" name="fch_consumo" value="" placeholder="00/00/0000" >
                </li>
                <li style="display:none">Fecha de vencimiento
                    <input type="date" name="fch_vencimiento" value="" placeholder="00/00/0000" >
                </li>
				<li>Descripción ( Nombre del <span id="k11-cons">Consumo</span> ) <b class="alert">*</b>
                    <textarea name="descripcion" class="required"></textarea>
                </li>
			</ul>


			<ul class="k11-ldr-cnt">
				<h2 class="title"><i>3</i>Detalle de su reclamo <b class="alert">* Datos requeridos</b></h2>

				<li><span id="k11-date">Fecha de Reclamo</span>
                    <input type="text" name="fch_reclamo" value="'.$today.'" readonly>
                </li>
                <li>Tipo de Reclamo <b class="alert">*</b>
                    <select id="tipo_reclamo" name="tipo_reclamo" tabindex="-1" aria-hidden="true" class="required">
                        <option value="">Tipo de Reclamo</option>
                        <option value="1">Reclamación (1)</option>
                        <option value="2">Queja (2)</option>
                    </select>
                </li>
                <li>Detalle <span id="k11-deta">del Reclamo</span>, según lo indicado por el cliente <b class="alert">*</b>
                    <textarea name="detalle_reclamo" class="required" ></textarea>
                </li>
                <li>Pedido del Cliente <b class="alert">*</b>
                    <textarea name="pedido_cliente"  class="required"></textarea>
                </li>
				<ul class="k11-ldr-ftr">
					<li><b class="alert">(1)</b>Reclamación: <span>Desacuerdo relacionado con productos y / o servicios.</span></li>
					<li><b class="alert">(2)</b>Queja: <span>Desacuerdo no relacionado con productos y / o servicios; o, malestar o insatisfacción con la atención al público.</span></li>
				</ul>
				<ul class="k11-ldr-ftr">	
					<li> <input type="checkbox" name="acepto" value="1">Declaro que soy el dueño del <span id="k11-decl">bien</span> contratado y declaro bajo juramento la veracidad de los hechos descritos en este formulario.</li>
				</ul>
				<ul class="k11-ldr-ftr k11-ldr-msg">
				                             
					<li><b class="alert">*</b> La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.</li>
					<li><b class="alert">*</b> El proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles, el cual es improrrogable.</li>
				</ul>
				<input type="submit" id="guardar_libro_reclamacion" name="guardar_libro_reclamacion" value="Enviar">
			</ul>
           
        </div>
    </form>

    <div id="demo"></div>
    <script>
        $( "#tipo_reclamo" ).on("change",function() {
        
            if ( $(this).find(":selected").text() == "Reclamación (1)") {
                $( "#k11-date" ).text("Fecha de Reclamación");
                $( "#k11-deta" ).text("de la Reclamación");
            } else if ( $(this).find(":selected").text() == "Queja (2)") {
                $( "#k11-date" ).text("Fecha de Queja");
                $( "#k11-deta" ).text("de la Queja");
            } else {
                $( "#k11-date" ).text("Fecha de Reclamo");
                $( "#k11-deta" ).text("del Reclamo");
            }

        });
        
        $( "#tipo_consumo" ).on("change",function() {
        
            if ( $(this).find(":selected").text() == "Producto") {
                $( "#k11-cons" ).text("Producto");
                $( "#k11-decl" ).text("producto");
            } else if ( $(this).find(":selected").text() == "Servicio") {
                $( "#k11-cons" ).text("Servicio");
                $( "#k11-decl" ).text("servicio");
            } else { 
                $( "#k11-cons" ).text("Consumo");
                $( "#k11-decl" ).text("bien");
            }

        });
        
    </script>';
    
    return $html;
}

