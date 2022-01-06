<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */

// Footer menu
$bassein_menu_footer = bassein_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($bassein_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php bassein_show_layout($bassein_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>