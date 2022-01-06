<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

if (bassein_sidebar_present()) {
	ob_start();
	$bassein_sidebar_name = bassein_get_theme_option('sidebar_widgets');
	bassein_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($bassein_sidebar_name) ) {
		dynamic_sidebar($bassein_sidebar_name);
	}
	$bassein_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($bassein_out)) {
		$bassein_sidebar_position = bassein_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($bassein_sidebar_position); ?> widget_area<?php if (!bassein_is_inherit(bassein_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(bassein_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'bassein_action_before_sidebar' );
				bassein_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $bassein_out));
				do_action( 'bassein_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>