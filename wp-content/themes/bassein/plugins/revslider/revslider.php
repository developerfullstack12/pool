<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('bassein_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'bassein_revslider_theme_setup9', 9 );
	function bassein_revslider_theme_setup9() {
		if (bassein_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'bassein_revslider_frontend_scripts', 1100 );
			add_filter( 'bassein_filter_merge_styles',			'bassein_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'bassein_filter_tgmpa_required_plugins','bassein_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bassein_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('bassein_filter_tgmpa_required_plugins',	'bassein_revslider_tgmpa_required_plugins');
	function bassein_revslider_tgmpa_required_plugins($list=array()) {
		if (bassein_storage_isset('required_plugins', 'revslider')) {
			$path = bassein_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || bassein_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> bassein_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'bassein_exists_revslider' ) ) {
	function bassein_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'bassein_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'bassein_revslider_frontend_scripts', 1100 );
	function bassein_revslider_frontend_scripts() {
		if (bassein_is_on(bassein_get_theme_option('debug_mode')) && bassein_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'bassein-revslider',  bassein_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'bassein_revslider_merge_styles' ) ) {
	//Handler of the add_filter('bassein_filter_merge_styles', 'bassein_revslider_merge_styles');
	function bassein_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>