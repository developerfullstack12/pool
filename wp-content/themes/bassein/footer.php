<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

						// Widgets area inside page content
						bassein_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					bassein_create_widgets_area('widgets_below_page');

					$bassein_body_style = bassein_get_theme_option('body_style');
					if ($bassein_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$bassein_footer_type = bassein_get_theme_option("footer_type");
			if ($bassein_footer_type == 'custom' && !bassein_is_layouts_available())
				$bassein_footer_type = 'default';
			get_template_part( "templates/footer-{$bassein_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (bassein_is_on(bassein_get_theme_option('debug_mode')) && bassein_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(bassein_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>