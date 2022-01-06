<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.06
 */

$bassein_header_css = $bassein_header_image = '';
$bassein_header_video = bassein_get_header_video();
if (true || empty($bassein_header_video)) {
	$bassein_header_image = get_header_image();
	if (bassein_trx_addons_featured_image_override()) $bassein_header_image = bassein_get_current_mode_image($bassein_header_image);
}

$bassein_header_id = str_replace('header-custom-', '', bassein_get_theme_option("header_style"));
if ((int) $bassein_header_id == 0) {
	$bassein_header_id = bassein_get_post_id(array(
												'name' => $bassein_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$bassein_header_id = apply_filters('bassein_filter_get_translated_layout', $bassein_header_id);
}
$bassein_header_meta = get_post_meta($bassein_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($bassein_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($bassein_header_id)));
				echo !empty($bassein_header_image) || !empty($bassein_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($bassein_header_video!='') 
					echo ' with_bg_video';
				if ($bassein_header_image!='') 
					echo ' '.esc_attr(bassein_add_inline_css_class('background-image: url('.esc_url($bassein_header_image).');'));
				if (!empty($bassein_header_meta['margin']) != '') 
					echo ' '.esc_attr(bassein_add_inline_css_class('margin-bottom: '.esc_attr(bassein_prepare_css_value($bassein_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (bassein_is_on(bassein_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight bassein-full-height';
				?> scheme_<?php echo esc_attr(bassein_is_inherit(bassein_get_theme_option('header_scheme')) 
												? bassein_get_theme_option('color_scheme') 
												: bassein_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($bassein_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('bassein_action_show_layout', $bassein_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>