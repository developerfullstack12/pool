<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */


// Socials
if ( bassein_is_on(bassein_get_theme_option('socials_in_footer')) && ($bassein_output = bassein_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php bassein_show_layout($bassein_output); ?>
		</div>
	</div>
	<?php
}
?>