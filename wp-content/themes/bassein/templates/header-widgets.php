<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

// Header sidebar
$bassein_header_name = bassein_get_theme_option('header_widgets');
$bassein_header_present = !bassein_is_off($bassein_header_name) && is_active_sidebar($bassein_header_name);
if ($bassein_header_present) { 
	bassein_storage_set('current_sidebar', 'header');
	$bassein_header_wide = bassein_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($bassein_header_name) ) {
		dynamic_sidebar($bassein_header_name);
	}
	$bassein_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($bassein_widgets_output)) {
		$bassein_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $bassein_widgets_output);
		$bassein_need_columns = strpos($bassein_widgets_output, 'columns_wrap')===false;
		if ($bassein_need_columns) {
			$bassein_columns = max(0, (int) bassein_get_theme_option('header_columns'));
			if ($bassein_columns == 0) $bassein_columns = min(6, max(1, substr_count($bassein_widgets_output, '<aside ')));
			if ($bassein_columns > 1)
				$bassein_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($bassein_columns).' widget', $bassein_widgets_output);
			else
				$bassein_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($bassein_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$bassein_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($bassein_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'bassein_action_before_sidebar' );
				bassein_show_layout($bassein_widgets_output);
				do_action( 'bassein_action_after_sidebar' );
				if ($bassein_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$bassein_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>