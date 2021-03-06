<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.1
 */
 
$bassein_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="bassein_admin_notice">
	<h3 class="bassein_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(__('Welcome to %1$s v.%2$s', 'bassein'),
				$bassein_theme_obj->name . (BASSEIN_THEME_FREE ? ' ' . __('Free', 'bassein') : ''),
				$bassein_theme_obj->version
				));
	?></h3>
	<?php
	if (!bassein_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'bassein')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=bassein_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(__('About %s', 'bassein'), $bassein_theme_obj->name));
		?></a>
		<?php
		if (bassein_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'bassein'); ?></a>
			<?php
		}
		if (function_exists('bassein_exists_trx_addons') && bassein_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'bassein'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'bassein'); ?></a>
		<span> <?php esc_html_e('or', 'bassein'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'bassein'); ?></a>
        <a href="#" class="button bassein_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'bassein'); ?></a>
	</p>
</div>