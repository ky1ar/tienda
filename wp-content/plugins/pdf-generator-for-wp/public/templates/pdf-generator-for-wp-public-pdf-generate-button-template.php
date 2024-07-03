<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://wpswings.com/
 * @since      1.0.0
 *
 * @package    Pdf_Generator_For_Wp
 * @subpackage Pdf_Generator_For_Wp/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
/**
 * PDF Download button.
 *
 * @param string $url_here url to download PDF.
 * @param int    $id post id to generate PDF for.
 * @return string
 */
function pgfw_pdf_download_button( $url_here, $id ) {
	$general_settings_data             = get_option( 'pgfw_general_settings_save', array() );
	$pgfw_pdf_generate_mode            = array_key_exists( 'pgfw_general_pdf_generate_mode', $general_settings_data ) ? $general_settings_data['pgfw_general_pdf_generate_mode'] : '';
	$mode                              = ( 'open_window' === $pgfw_pdf_generate_mode ) ? 'target=_blank' : '';
	$pgfw_display_settings             = get_option( 'pgfw_save_admin_display_settings', array() );
	$pgfw_pdf_icon_alignment           = array_key_exists( 'pgfw_display_pdf_icon_alignment', $pgfw_display_settings ) ? $pgfw_display_settings['pgfw_display_pdf_icon_alignment'] : '';
	$sub_pgfw_pdf_single_download_icon = array_key_exists( 'sub_pgfw_pdf_single_download_icon', $pgfw_display_settings ) ? $pgfw_display_settings['sub_pgfw_pdf_single_download_icon'] : '';
	$pgfw_single_pdf_download_icon_src = ( '' !== $sub_pgfw_pdf_single_download_icon ) ? $sub_pgfw_pdf_single_download_icon : PDF_GENERATOR_FOR_WP_DIR_URL . 'admin/src/images/PDF_Tray.svg';
	$pgfw_pdf_icon_width               = array_key_exists( 'pgfw_pdf_icon_width', $pgfw_display_settings ) ? $pgfw_display_settings['pgfw_pdf_icon_width'] : '';
	$pgfw_pdf_icon_height              = array_key_exists( 'pgfw_pdf_icon_height', $pgfw_display_settings ) ? $pgfw_display_settings['pgfw_pdf_icon_height'] : '';
	$pgfw_body_show_pdf_icon                 = array_key_exists( 'pgfw_body_show_pdf_icon', $pgfw_display_settings ) ? $pgfw_display_settings['pgfw_body_show_pdf_icon'] : '';
	$pgfw_show_post_type_icons_for_user_role = array_key_exists( 'pgfw_show_post_type_icons_for_user_role', $pgfw_display_settings ) ? $pgfw_display_settings['pgfw_show_post_type_icons_for_user_role'] : array();
	$user = wp_get_current_user();

	if ( 'yes' == $pgfw_body_show_pdf_icon ) {

		if ( isset( $pgfw_show_post_type_icons_for_user_role ) && ! empty( $pgfw_show_post_type_icons_for_user_role ) && array_intersect( $user->roles, $pgfw_show_post_type_icons_for_user_role ) ) {
			$html  = '<div style="text-align:' . esc_html( $pgfw_pdf_icon_alignment ) . '" class="wps-pgfw-pdf-generate-icon__wrapper-frontend">
			<a href="' . esc_html( $url_here ) . '" class="pgfw-single-pdf-download-button" ' . esc_html( $mode ) . '>Ficha Técnica</a>';
			$html  = apply_filters( 'wps_pgfw_bulk_download_button_filter_hook', $html, $id );
			$html .= '</div>';
			return $html;
		}
	} else {
		$html  = '<div style="text-align:' . esc_html( $pgfw_pdf_icon_alignment ) . '" class="wps-pgfw-pdf-generate-icon__wrapper-frontend">
		<a href="' . esc_html( $url_here ) . '" class="pgfw-single-pdf-download-button" ' . esc_html( $mode ) . '>Ficha Técnica<svg class="" xml:space="preserve" style="enable-background:new 0 0 512 512;margin-left: 0.5rem;" viewBox="0 0 515.283 515.283" y="0" x="0" height="16" width="16" xmlns:svgjs="http://svgjs.com/svgjs" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg"><g><path class="" data-original="#000000" fill="#d56027" d="M400.775 515.283H114.507c-30.584 0-59.339-11.911-80.968-33.54C11.911 460.117 0 431.361 0 400.775v-28.628c0-15.811 12.816-28.628 28.627-28.628s28.627 12.817 28.627 28.628v28.628c0 15.293 5.956 29.67 16.768 40.483 10.815 10.814 25.192 16.771 40.485 16.771h286.268c15.292 0 29.669-5.957 40.483-16.771 10.814-10.815 16.771-25.192 16.771-40.483v-28.628c0-15.811 12.816-28.628 28.626-28.628s28.628 12.817 28.628 28.628v28.628c0 30.584-11.911 59.338-33.54 80.968-21.629 21.629-50.384 33.54-80.968 33.54zM257.641 400.774a28.538 28.538 0 0 1-19.998-8.142l-.002-.002-.057-.056-.016-.016c-.016-.014-.03-.029-.045-.044l-.029-.029a.892.892 0 0 0-.032-.031l-.062-.062-114.508-114.509c-11.179-11.179-11.179-29.305 0-40.485 11.179-11.179 29.306-11.18 40.485 0l65.638 65.638V28.627C229.014 12.816 241.83 0 257.641 0s28.628 12.816 28.628 28.627v274.408l65.637-65.637c11.178-11.179 29.307-11.179 40.485 0 11.179 11.179 11.179 29.306 0 40.485L277.883 392.39l-.062.062-.032.031-.029.029c-.014.016-.03.03-.044.044l-.017.016a1.479 1.479 0 0 1-.056.056l-.002.002c-.315.307-.634.605-.96.895a28.441 28.441 0 0 1-7.89 4.995l-.028.012c-.011.004-.02.01-.031.013a28.5 28.5 0 0 1-11.091 2.229z"></path></g></svg></a>';
		$html  = apply_filters( 'wps_pgfw_bulk_download_button_filter_hook', $html, $id );
		$html .= '</div>';
		return $html;
	}

}
