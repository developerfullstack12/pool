<?php
/**
 * Theme Options and meta-boxes support
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.29
 */


// -----------------------------------------------------------------
// -- Meta-boxes
// -----------------------------------------------------------------

if ( !function_exists('bassein_init_meta_box') ) {
	add_action( 'after_setup_theme', 'bassein_init_meta_box' );
	function bassein_init_meta_box() {
		if ( is_admin() ) {
			add_action('admin_enqueue_scripts',	'bassein_add_meta_box_scripts');
			add_action('save_post',				'bassein_save_meta_box');
			add_action('add_meta_boxes',		'bassein_add_meta_box');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'bassein_add_meta_box_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'bassein_add_meta_box_scripts');
	function bassein_add_meta_box_scripts() {
		// If current screen is 'Edit Page' - load font icons
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && bassein_allow_meta_box(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
			wp_enqueue_style( 'bassein-icons',  bassein_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'bassein-options', bassein_get_file_url('theme-options/theme.options.js'), array('jquery'), null, true );
			wp_localize_script( 'bassein-options', 'bassein_dependencies', bassein_get_theme_dependencies() );
		}
	}
}


// Check if meta box is allow
if (!function_exists('bassein_allow_meta_box')) {
	function bassein_allow_meta_box($post_type) {
		return apply_filters('bassein_filter_allow_meta_box', in_array($post_type, array('page', 'post')), $post_type);
	}
}

// Add meta box
if (!function_exists('bassein_add_meta_box')) {
	//Handler of the add_action('add_meta_boxes', 'bassein_add_meta_box');
	function bassein_add_meta_box() {
		global $post_type;
		if (bassein_allow_meta_box($post_type)) {
			add_meta_box(sprintf('bassein_meta_box_%s', $post_type), 
						esc_html__('Theme Options', 'bassein'),
						'bassein_show_meta_box',
						$post_type,
						$post_type=='post' ? 'side' : 'advanced',
						'default');
		}
	}
}

// Callback function to show fields in meta box
if (!function_exists('bassein_show_meta_box')) {
	function bassein_show_meta_box() {
		global $post, $post_type;
		if (bassein_allow_meta_box($post_type)) {
			// Load saved options 
			$meta = get_post_meta($post->ID, 'bassein_options', true);
			$tabs_titles = $tabs_content = array();
			global $BASSEIN_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $BASSEIN_STORAGE
			foreach ($BASSEIN_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (!empty($v['linked'])) {
					$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
					if (!empty($v['val']) && !bassein_is_inherit($v['val']))
						bassein_refresh_linked_data($v['val'], $v['linked']);
				}
			}
			// Show fields
			foreach ($BASSEIN_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (empty($v['override']['section']))
					$v['override']['section'] = esc_html__('General', 'bassein');
				if (!isset($tabs_titles[$v['override']['section']])) {
					$tabs_titles[$v['override']['section']] = $v['override']['section'];
					$tabs_content[$v['override']['section']] = '';
				}
				$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
				$tabs_content[$v['override']['section']] .= bassein_options_show_field($k, $v, $post_type);
			}
			if (count($tabs_titles) > 0) {
				?>
				<div class="bassein_options bassein_meta_box">
					<input type="hidden" name="meta_box_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
					<input type="hidden" name="meta_box_post_type" value="<?php echo esc_attr($post_type); ?>" />
					<div id="bassein_options_tabs" class="bassein_tabs">
						<ul><?php
							$cnt = 0;
							foreach ($tabs_titles as $k=>$v) {
								$cnt++;
								?><li><a href="#bassein_options_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
							}
						?></ul>
						<?php
							$cnt = 0;
							foreach ($tabs_content as $k=>$v) {
								$cnt++;
								?>
								<div id="bassein_options_<?php echo esc_attr($cnt); ?>" class="bassein_tabs_section bassein_options_section">
									<?php bassein_show_layout($v); ?>
								</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php		
			}
		}
	}
}


// Save data from meta box
if (!function_exists('bassein_save_meta_box')) {
	//Handler of the add_action('save_post', 'bassein_save_meta_box');
	function bassein_save_meta_box($post_id) {

		// verify nonce
		if ( !wp_verify_nonce( bassein_get_value_gp('meta_box_post_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_type = wp_kses_data(wp_unslash(isset($_POST['meta_box_post_type']) ? $_POST['meta_box_post_type'] : $_POST['post_type']));

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type), 'objects' );
		if (!empty($post_types) && is_array($post_types)) {
			foreach ($post_types  as $type) {
				$capability = $type->capability_type;
				break;
			}
		}
		if (!current_user_can('edit_'.($capability), $post_id)) {
			return $post_id;
		}

		// Save meta
		$meta = array();
		$options = bassein_storage_get('options');
		foreach ($options as $k=>$v) {
			// Skip not overriden options
			if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
			// Skip inherited options
			if (!empty($_POST['bassein_options_inherit_' . $k])) continue;
			// Get option value from POST
			$meta[$k] = isset($_POST['bassein_options_field_' . $k])
							? bassein_get_value_gp('bassein_options_field_' . $k)
							: ($v['type']=='checkbox' ? 0 : '');
		}
		update_post_meta($post_id, 'bassein_options', $meta);
		
		// Save separate meta options to search template pages
		if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
			update_post_meta($post_id, 'bassein_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
			update_post_meta($post_id, 'bassein_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
		}
	}
}
?>