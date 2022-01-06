<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */

// Footer sidebar
$bassein_footer_name = bassein_get_theme_option('footer_widgets');
$bassein_footer_present = !bassein_is_off($bassein_footer_name) && is_active_sidebar($bassein_footer_name);
if ($bassein_footer_present) { 
	bassein_storage_set('current_sidebar', 'footer');
	$bassein_footer_wide = bassein_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($bassein_footer_name) ) {
		dynamic_sidebar($bassein_footer_name);
	}
	$bassein_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($bassein_out)) {
		$bassein_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $bassein_out);
		$bassein_need_columns = true;	//or check: strpos($bassein_out, 'columns_wrap')===false;
		if ($bassein_need_columns) {
			$bassein_columns = max(0, (int) bassein_get_theme_option('footer_columns'));
			if ($bassein_columns == 0) $bassein_columns = min(4, max(1, substr_count($bassein_out, '<aside ')));
			if ($bassein_columns > 1)
				$bassein_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($bassein_columns).' widget', $bassein_out);
			else
				$bassein_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($bassein_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$bassein_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($bassein_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'bassein_action_before_sidebar' );
				bassein_show_layout($bassein_out);
				do_action( 'bassein_action_after_sidebar' );
				if ($bassein_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$bassein_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>