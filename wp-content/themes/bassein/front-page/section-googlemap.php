<div class="front_page_section front_page_section_googlemap<?php
			$bassein_scheme = bassein_get_theme_option('front_page_googlemap_scheme');
			if (!bassein_is_inherit($bassein_scheme)) echo ' scheme_'.esc_attr($bassein_scheme);
			echo ' front_page_section_paddings_'.esc_attr(bassein_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$bassein_css = '';
		$bassein_bg_image = bassein_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($bassein_bg_image)) 
			$bassein_css .= 'background-image: url('.esc_url(bassein_get_attachment_url($bassein_bg_image)).');';
		if (!empty($bassein_css))
			echo ' style="' . esc_attr($bassein_css) . '"';
?>><?php
	// Add anchor
	$bassein_anchor_icon = bassein_get_theme_option('front_page_googlemap_anchor_icon');	
	$bassein_anchor_text = bassein_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($bassein_anchor_icon) || !empty($bassein_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($bassein_anchor_icon) ? ' icon="'.esc_attr($bassein_anchor_icon).'"' : '')
										. (!empty($bassein_anchor_text) ? ' title="'.esc_attr($bassein_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (bassein_get_theme_option('front_page_googlemap_fullheight'))
				echo ' bassein-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$bassein_css = '';
			$bassein_bg_mask = bassein_get_theme_option('front_page_googlemap_bg_mask');
			$bassein_bg_color = bassein_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($bassein_bg_color) && $bassein_bg_mask > 0)
				$bassein_css .= 'background-color: '.esc_attr($bassein_bg_mask==1
																	? $bassein_bg_color
																	: bassein_hex2rgba($bassein_bg_color, $bassein_bg_mask)
																).';';
			if (!empty($bassein_css))
				echo ' style="' . esc_attr($bassein_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$bassein_layout = bassein_get_theme_option('front_page_googlemap_layout');
			if ($bassein_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$bassein_caption = bassein_get_theme_option('front_page_googlemap_caption');
			$bassein_description = bassein_get_theme_option('front_page_googlemap_description');
			if (!empty($bassein_caption) || !empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($bassein_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($bassein_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($bassein_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($bassein_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($bassein_description) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post(wpautop($bassein_description));
						?></div><?php
					}
				if ($bassein_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$bassein_content = bassein_get_theme_option('front_page_googlemap_content');
			if (!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($bassein_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($bassein_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($bassein_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($bassein_content);
				?></div><?php
	
				if ($bassein_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($bassein_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!bassein_exists_trx_addons())
						bassein_customizer_need_trx_addons_message();
					else
						bassein_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($bassein_layout == 'columns' && (!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>