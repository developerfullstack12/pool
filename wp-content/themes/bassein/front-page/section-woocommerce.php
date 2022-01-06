<div class="front_page_section front_page_section_woocommerce<?php
			$bassein_scheme = bassein_get_theme_option('front_page_woocommerce_scheme');
			if (!bassein_is_inherit($bassein_scheme)) echo ' scheme_'.esc_attr($bassein_scheme);
			echo ' front_page_section_paddings_'.esc_attr(bassein_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$bassein_css = '';
		$bassein_bg_image = bassein_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($bassein_bg_image)) 
			$bassein_css .= 'background-image: url('.esc_url(bassein_get_attachment_url($bassein_bg_image)).');';
		if (!empty($bassein_css))
			echo ' style="' . esc_attr($bassein_css) . '"';
?>><?php
	// Add anchor
	$bassein_anchor_icon = bassein_get_theme_option('front_page_woocommerce_anchor_icon');	
	$bassein_anchor_text = bassein_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($bassein_anchor_icon) || !empty($bassein_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($bassein_anchor_icon) ? ' icon="'.esc_attr($bassein_anchor_icon).'"' : '')
										. (!empty($bassein_anchor_text) ? ' title="'.esc_attr($bassein_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (bassein_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' bassein-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$bassein_css = '';
			$bassein_bg_mask = bassein_get_theme_option('front_page_woocommerce_bg_mask');
			$bassein_bg_color = bassein_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($bassein_bg_color) && $bassein_bg_mask > 0)
				$bassein_css .= 'background-color: '.esc_attr($bassein_bg_mask==1
																	? $bassein_bg_color
																	: bassein_hex2rgba($bassein_bg_color, $bassein_bg_mask)
																).';';
			if (!empty($bassein_css))
				echo ' style="' . esc_attr($bassein_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$bassein_caption = bassein_get_theme_option('front_page_woocommerce_caption');
			$bassein_description = bassein_get_theme_option('front_page_woocommerce_description');
			if (!empty($bassein_caption) || !empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($bassein_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($bassein_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($bassein_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($bassein_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($bassein_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($bassein_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$bassein_woocommerce_sc = bassein_get_theme_option('front_page_woocommerce_products');
				if ($bassein_woocommerce_sc == 'products') {
					$bassein_woocommerce_sc_ids = bassein_get_theme_option('front_page_woocommerce_products_per_page');
					$bassein_woocommerce_sc_per_page = count(explode(',', $bassein_woocommerce_sc_ids));
				} else {
					$bassein_woocommerce_sc_per_page = max(1, (int) bassein_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$bassein_woocommerce_sc_columns = max(1, min($bassein_woocommerce_sc_per_page, (int) bassein_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$bassein_woocommerce_sc}"
									. ($bassein_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($bassein_woocommerce_sc_ids).'"' 
											: '')
									. ($bassein_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(bassein_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($bassein_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(bassein_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(bassein_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($bassein_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($bassein_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>