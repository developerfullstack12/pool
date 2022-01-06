<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */

$bassein_footer_scheme =  bassein_is_inherit(bassein_get_theme_option('footer_scheme')) ? bassein_get_theme_option('color_scheme') : bassein_get_theme_option('footer_scheme');
$bassein_footer_id = str_replace('footer-custom-', '', bassein_get_theme_option("footer_style"));
if ((int) $bassein_footer_id == 0) {
	$bassein_footer_id = bassein_get_post_id(array(
												'name' => $bassein_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$bassein_footer_id = apply_filters('bassein_filter_get_translated_layout', $bassein_footer_id);
}
$bassein_footer_meta = get_post_meta($bassein_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($bassein_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($bassein_footer_id))); 
						if (!empty($bassein_footer_meta['margin']) != '') 
							echo ' '.esc_attr(bassein_add_inline_css_class('margin-top: '.bassein_prepare_css_value($bassein_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($bassein_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('bassein_action_show_layout', $bassein_footer_id);
	?>
</footer><!-- /.footer_wrap -->
