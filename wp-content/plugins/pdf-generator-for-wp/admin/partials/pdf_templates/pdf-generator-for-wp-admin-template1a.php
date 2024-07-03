<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wpswings.com/
 * @since      1.0.0
 *
 * @package    Pdf_Generator_For_Wp
 * @subpackage Pdf_Generator_For_Wp/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {

	exit(); // Exit if accessed directly.
}
/**
 * Function contains html for template 1;
 *
 * @param int    $post_id post id.
 * @param string $template_name template name to be used.
 * @since 1.0.0
 *
 * @return string
 */
function return_ob_html( $post_id, $template_name = '' ) {
	
	$post = get_post( $post_id );
	if ( is_object( $post ) ) {
		$html .= '<head>
    <style>
        body {
            margin: 0;
            width: 794px;
            height: 1123px;
        }
        @page  {
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            font-family: sans-serif;
            line-height: 22px;
            font-size: 15px;
        }
        .k11-pdf-hdr img {
            width: 220px;
            height: 74px;
            padding: 8px 0;
        }
        .k11-pdf-hdr td {
            width: 50%;
            background-color: #3e4b51;
        }
        .k11-pdf-hdr td+td {
            font-size: 32px;
            text-transform: uppercase;
            font-weight: 400;
            background-color: #f6f6f6;
            color: #3e4b51;
        }
        .k11-pdf-clr {
            background-color: #3e4b51;
            color: #fff;
            font-weight: 400;
            text-align: left;
        }
        .k11-pdf-gry {
            text-align: center;
            line-height: 26px;
            background-color: #f6f6f6;
            margin-top: 8px;
            font-size: 14px;
        }
        .k11-pdf-bim{
            height: 68px;
            width: 188px;
            padding: 8px 0;
        }
        .k11-pdf-mnm{
            font-size: 44px;
            font-weight: 400;
            color: #fff;
            background-color: #3e4b51;
            line-height: 72px;
        }
        .k11-pdf-dsc{
            text-align: justify;
            color: #3e4b51;
            margin: 0;
            padding: 24px;
        }
        .k11-pdf-mni td{
            color: #fff;
            font-weight: 400;
            border-left: 40px solid #fff;
            border-bottom: 8px solid #fff;
            padding: 2px;
        }
        .k11-pdf-mni td+td{
            border-left: 0;
            color: #c2ced1;
            border-right: 40px solid #fff;
        }
        .k11-pdf-dtl{
            margin-top: 20px;
            line-height: 16px;
            font-size: 13px;
        }
        .k11-pdf-dtl td{
            width: 25%;
            border: 12px solid #fff;
            padding: 4px 8px;
        }
        .k11-pdf-dtl span{
            display: block;
        }
        .k11-pdf-dtl span+span{
            color: #c2ced1;
            font-weight: 400;
        }
    </style>
</head>

<body>
     
<table>
    <tbody>
        <tr class="k11-pdf-hdr">
            <td><img src="https://tiendakrear3d.com/wp-content/uploads/2022/08/Mesa-de-trabajo-1.png"></td>
            <td>Ficha Técnica</td>
        </tr>
        <tr>
            <td rowspan="4"><img class="k11-pdf-pim" src="https://tiendakrear3d.com/wp-content/uploads/2021/11/7637af081e.jpg.640x640-e1644959139595.jpg" style="height: 460px;"></td>
            <td><img class="k11-pdf-bim" src="https://www.klarna.com/sac/images/logos/252311-1386241243.png"></td>
        </tr>
        <tr>
            <td class="k11-pdf-mnm">GENIUS PRO</td>
        </tr>
        <tr>
            <td>
                <p class="k11-pdf-dsc"><b>Artillery Genius Pro</b> una de las impresoras más vendidas en el mercado ahora se actualiza, incluye sensor de auto nivelado. Esta imprsora 3D de gama media con voluimen de impresión de <b>220x220x250mm,</b> muy completa y con una relación calidad-precio magnífica. Tiene un montaje fácil, placa silenciosa y detector de filamento.</p>
            </td>
        </tr>
        <tr>
            <td>
                <table class="k11-pdf-mni">
                    <tbody class="k11-pdf-clr">
                        <tr>
                            <td>Tecnologia</td>
                            <td>FDM</td>
                        </tr>
                        <tr>
                            <td>Volumen de imp.:</td>
                            <td>220 x 220 x 250 MM</td>
                        </tr>
                        <tr>
                            <td>Resolución de capa:</td>
                            <td>0.1 - 0.35 MM</td>
                        </tr>
                        <tr>
                            <td>Velocidad Máx.:</td>
                            <td>150 MM/S</td>
                        </tr>
                        <tr>
                            <td>Tipo de Extrusor:</td>
                            <td>Directo</td>
  
                         </tr>
                         <tr>
                            <td>Diámetro de boquilla:</td>
                            <td>0.4 MM</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<table class="k11-pdf-dtl">
    <tbody class="k11-pdf-clr">
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
        <tr>
            <td><span>Tecnología</span><span>FDM</span></td>
            <td><span>Tipo de impresora</span><span>Cartesiana Tipo Puente</span></td><td><span>Volumen de Impresíon</span><span>220 x 220 x 250 mm</span></td>
            <td><span>Resolución de capa</span><span>0.1 - 0.35 mm</span></td>
        </tr>
    </tbody>
</table>

<table>
    <tbody class="k11-pdf-gry">
        <tr>
            <td colspan="2" style="padding: 8px;">Fabricaciones Digitales del Peru SA (C)</td>
        </tr>
        <tr>
            <td style="padding: 4px;">WWW.TIENDAKREAR3D.COM</td>
            <td style="padding: 4px;">C.JAVIER FERNANDEZ 262 MIRAFLORES - LIMA</td>
        </tr>
        <tr>
            <td style="padding: 4px;">+51 934 760 404 +51 934 760 244 +51 982 001 288</td>
            <td style="padding: 4px;">@KREAR3D @KREAR3D _PERU @KREAR3D _PERU</td>
        </tr>
    </tbody>
</table>

</body>';

    
	}

	return $html;
}
