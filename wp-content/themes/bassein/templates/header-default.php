<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */


$bassein_header_css = $bassein_header_image = '';
$bassein_header_video = bassein_get_header_video();
if (true || empty($bassein_header_video)) {
	$bassein_header_image = get_header_image();
	if (bassein_trx_addons_featured_image_override()) $bassein_header_image = bassein_get_current_mode_image($bassein_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($bassein_header_image) || !empty($bassein_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($bassein_header_video!='') echo ' with_bg_video';
					if ($bassein_header_image!='') echo ' '.esc_attr(bassein_add_inline_css_class('background-image: url('.esc_url($bassein_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (bassein_is_on(bassein_get_theme_option('header_fullheight'))) echo ' header_fullheight bassein-full-height';
					?> scheme_<?php echo esc_attr(bassein_is_inherit(bassein_get_theme_option('header_scheme')) 
													? bassein_get_theme_option('color_scheme') 
													: bassein_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($bassein_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (bassein_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );



?></header>