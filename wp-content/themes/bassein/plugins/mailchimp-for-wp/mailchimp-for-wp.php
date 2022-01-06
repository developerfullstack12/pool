<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('bassein_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'bassein_mailchimp_theme_setup9', 9 );
	function bassein_mailchimp_theme_setup9() {
		if (bassein_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'bassein_mailchimp_frontend_scripts', 1100 );
			add_filter( 'bassein_filter_merge_styles',					'bassein_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'bassein_filter_tgmpa_required_plugins',		'bassein_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bassein_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('bassein_filter_tgmpa_required_plugins',	'bassein_mailchimp_tgmpa_required_plugins');
	function bassein_mailchimp_tgmpa_required_plugins($list=array()) {
		if (bassein_storage_isset('required_plugins', 'mailchimp-for-wp')) {
			$list[] = array(
				'name' 		=> bassein_storage_get_array('required_plugins', 'mailchimp-for-wp'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'bassein_exists_mailchimp' ) ) {
	function bassein_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'bassein_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'bassein_mailchimp_frontend_scripts', 1100 );
	function bassein_mailchimp_frontend_scripts() {
		if (bassein_exists_mailchimp()) {
			if (bassein_is_on(bassein_get_theme_option('debug_mode')) && bassein_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'bassein-mailchimp-for-wp',  bassein_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'bassein_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'bassein_filter_merge_styles', 'bassein_mailchimp_merge_styles');
	function bassein_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (bassein_exists_mailchimp()) { require_once BASSEIN_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>