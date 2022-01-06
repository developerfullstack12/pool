<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_args = get_query_var('bassein_logo_args');

// Site logo
$bassein_logo_type   = isset($bassein_args['type']) ? $bassein_args['type'] : '';
$bassein_logo_image  = bassein_get_logo_image($bassein_logo_type);
$bassein_logo_text   = bassein_is_on(bassein_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$bassein_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($bassein_logo_image) || !empty($bassein_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($bassein_logo_image)) {
			if (empty($bassein_logo_type) && function_exists('the_custom_logo') && (int) $bassein_logo_image > 0) {
				the_custom_logo();
			} else {
				$bassein_attr = bassein_getimagesize($bassein_logo_image);
				echo '<img src="'.esc_url($bassein_logo_image).'" alt=""'.(!empty($bassein_attr[3]) ? ' '.wp_kses_data($bassein_attr[3]) : '').'>';
			}
		} else {
			bassein_show_layout(bassein_prepare_macros($bassein_logo_text), '<span class="logo_text">', '</span>');
			bassein_show_layout(bassein_prepare_macros($bassein_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>