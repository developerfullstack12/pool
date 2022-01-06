<?php
/**
 * Admin utilities
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.1
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('bassein_admin_theme_setup') ) {
	add_action( 'after_setup_theme', 'bassein_admin_theme_setup' );
	function bassein_admin_theme_setup() {
		// Add theme icons
		add_action('admin_footer',	 						'bassein_admin_footer');

		// Enqueue scripts and styles for admin
		add_action("admin_enqueue_scripts",					'bassein_admin_scripts');
		add_action("admin_footer",							'bassein_admin_localize_scripts');
		
		// Show admin notice
		add_action('admin_notices',							'bassein_admin_notice', 2);
		add_action('wp_ajax_bassein_hide_admin_notice',		'bassein_callback_hide_admin_notice');

		// TGM Activation plugin
		add_action('tgmpa_register',						'bassein_register_plugins');
	
		// Init internal admin messages
		bassein_init_admin_messages();
	}
}


//-------------------------------------------------------
//-- Admin notice and internal messages
//-------------------------------------------------------

// Show admin notice
if ( !function_exists( 'bassein_admin_notice' ) ) {
	//Handler of the add_action('admin_notices', 'bassein_admin_notice', 2);
	function bassein_admin_notice() {
		if (in_array(bassein_get_value_gp('action'), array('vc_load_template_preview'))) return;
		if (bassein_get_value_gp('page') == 'bassein_about') return;
		if (!current_user_can('edit_theme_options')) return;
		$opt_name = 'bassein_admin_notice';
		$show = get_option('bassein_admin_notice');
		if ($show !== false && (int) $show == 0) return;
		get_template_part('templates/admin-notice');
	}
}

// Hide admin notice
if ( !function_exists( 'bassein_callback_hide_admin_notice' ) ) {
	//Handler of the add_action('wp_ajax_bassein_hide_admin_notice', 'bassein_callback_hide_admin_notice');
	function bassein_callback_hide_admin_notice() {
		update_option('bassein_admin_notice', '0');
		exit;
	}
}

// Init internal admin messages
if ( !function_exists( 'bassein_init_admin_messages' ) ) {
	function bassein_init_admin_messages() {
		$msg = get_option('bassein_admin_messages');
		if (is_array($msg))
			update_option('bassein_admin_messages', '');
		else
			$msg = array();
		bassein_storage_set('admin_messages', $msg);
	}
}

// Add internal admin message
if ( !function_exists( 'bassein_add_admin_message' ) ) {
	function bassein_add_admin_message($text, $type='success', $cur_session=false) {
		if (!empty($text)) {
			$new_msg = array('message' => $text, 'type' => $type);
			if ($cur_session) {
				bassein_storage_push_array('admin_messages', '', $new_msg);
			} else {
				$msg = get_option('bassein_admin_messages');
				if (!is_array($msg)) $msg = array();
				$msg[] = $new_msg;
				update_option('bassein_admin_messages', $msg);
			}
		}
	}
}

// Show internal admin messages
if ( !function_exists( 'bassein_show_admin_messages' ) ) {
	function bassein_show_admin_messages() {
		$msg = bassein_storage_get('admin_messages');
		if (!is_array($msg) || count($msg) == 0) return;
		?><div class="bassein_admin_messages"><?php
			foreach ($msg as $m) {
				?><div class="bassein_admin_message_item <?php echo esc_attr(str_replace('success', 'updated', $m['type'])); ?>">
					<p><?php echo wp_kses_data($m['message']); ?></p>
				</div><?php
			}
		?></div><?php
	}
}


//-------------------------------------------------------
//-- Styles and scripts
//-------------------------------------------------------
	
// Load inline styles
if ( !function_exists( 'bassein_admin_footer' ) ) {
	//Handler of the add_action('admin_footer', 'bassein_admin_footer');
	function bassein_admin_footer() {
		// Get current screen
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id=='nav-menus') {
			bassein_show_layout(bassein_show_custom_field('bassein_icons_popup',
													array(
														'type'	=> 'icons',
														'style'	=> bassein_get_theme_setting('icons_type'),
														'button'=> false,
														'icons'	=> true
													),
													null)
								);
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'bassein_admin_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'bassein_admin_scripts');
	function bassein_admin_scripts() {

		// Add theme styles
		wp_enqueue_style(  'bassein-admin',  bassein_get_file_url('css/admin.css'), array(), null );

		// Links to selected fonts
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen)) {
			if (bassein_allow_meta_box(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load font icons
				// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
				// and can't be used instead this style!
				wp_enqueue_style(  'bassein-icons', bassein_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
				wp_enqueue_style(  'bassein-icons-animation', bassein_get_file_url('css/font-icons/css/animation.css'), array(), null );
				// Load theme fonts
				$links = bassein_theme_fonts_links();
				if (count($links) > 0) {
					foreach ($links as $slug => $link) {
						wp_enqueue_style( sprintf('bassein-font-%s', $slug), $link, array(), null );
					}
				}
			} else if (apply_filters('bassein_filter_allow_theme_icons', is_customize_preview() || $screen->id=='nav-menus', !empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load font icons
				// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
				// and can't be used instead this style!
				wp_enqueue_style(  'bassein-icons', bassein_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			}
		}

		// Add theme scripts
		wp_enqueue_script( 'bassein-utils', bassein_get_file_url('js/_utils.js'), array('jquery'), null, true );
		wp_enqueue_script( 'bassein-admin', bassein_get_file_url('js/_admin.js'), array('jquery'), null, true );
	}
}
	
// Add variables in the admin mode
if ( !function_exists( 'bassein_admin_localize_scripts' ) ) {
	//Handler of the add_action("admin_footer", 'bassein_admin_localize_scripts');
	function bassein_admin_localize_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		wp_localize_script( 'bassein-admin', 'BASSEIN_STORAGE', apply_filters( 'bassein_filter_localize_script_admin', array(
			'admin_mode' => true,
			'screen_id' => is_object($screen) ? esc_attr($screen->id) : '',
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			'ajax_error_msg' => esc_html__('Server response error', 'bassein'),
			'icon_selector_msg' => esc_html__('Select the icon for this menu item', 'bassein'),
			'user_logged_in' => true
			))
		);
	}
}



//-------------------------------------------------------
//-- Third party plugins
//-------------------------------------------------------

// Register optional plugins
if ( !function_exists( 'bassein_register_plugins' ) ) {
	//Handler of the add_action('tgmpa_register', 'bassein_register_plugins');
	function bassein_register_plugins() {
		tgmpa(	apply_filters('bassein_filter_tgmpa_required_plugins', array(
				// Plugins to include in the autoinstall queue.
				)),
				array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => false,                   // Automatically activate plugins after installation or not.
					'message'      => ''                       // Message to output right before the plugins table.
				)
			);
	}
}
?>