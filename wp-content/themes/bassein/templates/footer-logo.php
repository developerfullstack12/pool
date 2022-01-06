<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */

// Logo
if (bassein_is_on(bassein_get_theme_option('logo_in_footer'))) {
	$bassein_logo_image = '';
	if (bassein_is_on(bassein_get_theme_option('logo_retina_enabled')) && bassein_get_retina_multiplier(2) > 1)
		$bassein_logo_image = bassein_get_theme_option( 'logo_footer_retina' );
	if (empty($bassein_logo_image)) 
		$bassein_logo_image = bassein_get_theme_option( 'logo_footer' );
	$bassein_logo_text   = get_bloginfo( 'name' );
	if (!empty($bassein_logo_image) || !empty($bassein_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($bassein_logo_image)) {
					$bassein_attr = bassein_getimagesize($bassein_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($bassein_logo_image).'" class="logo_footer_image" alt=""'.(!empty($bassein_attr[3]) ? ' ' . wp_kses_data($bassein_attr[3]) : '').'></a>' ;
				} else if (!empty($bassein_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($bassein_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>