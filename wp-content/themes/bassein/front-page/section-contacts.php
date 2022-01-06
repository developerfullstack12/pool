<div class="front_page_section front_page_section_contacts<?php
			$bassein_scheme = bassein_get_theme_option('front_page_contacts_scheme');
			if (!bassein_is_inherit($bassein_scheme)) echo ' scheme_'.esc_attr($bassein_scheme);
			echo ' front_page_section_paddings_'.esc_attr(bassein_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$bassein_css = '';
		$bassein_bg_image = bassein_get_theme_option('front_page_contacts_bg_image');
		if (!empty($bassein_bg_image)) 
			$bassein_css .= 'background-image: url('.esc_url(bassein_get_attachment_url($bassein_bg_image)).');';
		if (!empty($bassein_css))
			echo ' style="' . esc_attr($bassein_css) . '"';
?>><?php
	// Add anchor
	$bassein_anchor_icon = bassein_get_theme_option('front_page_contacts_anchor_icon');	
	$bassein_anchor_text = bassein_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($bassein_anchor_icon) || !empty($bassein_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($bassein_anchor_icon) ? ' icon="'.esc_attr($bassein_anchor_icon).'"' : '')
										. (!empty($bassein_anchor_text) ? ' title="'.esc_attr($bassein_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (bassein_get_theme_option('front_page_contacts_fullheight'))
				echo ' bassein-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$bassein_css = '';
			$bassein_bg_mask = bassein_get_theme_option('front_page_contacts_bg_mask');
			$bassein_bg_color = bassein_get_theme_option('front_page_contacts_bg_color');
			if (!empty($bassein_bg_color) && $bassein_bg_mask > 0)
				$bassein_css .= 'background-color: '.esc_attr($bassein_bg_mask==1
																	? $bassein_bg_color
																	: bassein_hex2rgba($bassein_bg_color, $bassein_bg_mask)
																).';';
			if (!empty($bassein_css))
				echo ' style="' . esc_attr($bassein_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$bassein_caption = bassein_get_theme_option('front_page_contacts_caption');
			$bassein_description = bassein_get_theme_option('front_page_contacts_description');
			if (!empty($bassein_caption) || !empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($bassein_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($bassein_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($bassein_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($bassein_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($bassein_description));
					?></div><?php
				}
			}

			// Content (text)
			$bassein_content = bassein_get_theme_option('front_page_contacts_content');
			$bassein_layout = bassein_get_theme_option('front_page_contacts_layout');
			if ($bassein_layout == 'columns' && (!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($bassein_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($bassein_content);
				?></div><?php
			}

			if ($bassein_layout == 'columns' && (!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$bassein_sc = bassein_get_theme_option('front_page_contacts_shortcode');
			if (!empty($bassein_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($bassein_sc) ? 'filled' : 'empty'; ?>"><?php
					bassein_show_layout(do_shortcode($bassein_sc));
				?></div><?php
			}

			if ($bassein_layout == 'columns' && (!empty($bassein_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>