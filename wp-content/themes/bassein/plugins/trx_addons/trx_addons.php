<?php
/* ThemeREX Addons support functions
------------------------------------------------------------------------------- */

// Add theme-specific functions
require_once BASSEIN_THEME_DIR . 'theme-specific/trx_addons.setup.php';

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('bassein_trx_addons_theme_setup1')) {
	add_action( 'after_setup_theme', 'bassein_trx_addons_theme_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'bassein_trx_addons_theme_setup1', 8 );
	function bassein_trx_addons_theme_setup1() {
		if (bassein_exists_trx_addons()) {
			add_filter( 'bassein_filter_list_posts_types',			'bassein_trx_addons_list_post_types');
			add_filter( 'bassein_filter_list_header_footer_types',	'bassein_trx_addons_list_header_footer_types');
			add_filter( 'bassein_filter_list_header_styles',		'bassein_trx_addons_list_header_styles');
			add_filter( 'bassein_filter_list_footer_styles',		'bassein_trx_addons_list_footer_styles');
			add_action( 'bassein_action_load_options',				'bassein_trx_addons_add_link_edit_layout');
			add_filter( 'trx_addons_filter_default_layouts',		'bassein_trx_addons_default_layouts');
			add_filter( 'trx_addons_filter_load_options',			'bassein_trx_addons_default_components');
			add_filter( 'trx_addons_cpt_list_options',				'bassein_trx_addons_cpt_list_options', 10, 2);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('bassein_trx_addons_theme_setup9')) {
	add_action( 'after_setup_theme', 'bassein_trx_addons_theme_setup9', 9 );
	function bassein_trx_addons_theme_setup9() {
		if (bassein_exists_trx_addons()) {
			add_filter( 'trx_addons_filter_add_thumb_sizes',			'bassein_trx_addons_add_thumb_sizes');
			add_filter( 'trx_addons_filter_get_thumb_size',				'bassein_trx_addons_get_thumb_size');
			add_filter( 'trx_addons_filter_featured_image',				'bassein_trx_addons_featured_image', 10, 2);
			add_filter( 'trx_addons_filter_no_image',					'bassein_trx_addons_no_image' );
			add_filter( 'trx_addons_filter_get_list_icons',				'bassein_trx_addons_get_list_icons', 10, 2 );
			add_action( 'wp_enqueue_scripts', 							'bassein_trx_addons_frontend_scripts', 1100 );
			add_filter( 'bassein_filter_query_sort_order',	 			'bassein_trx_addons_query_sort_order', 10, 3);
			add_filter( 'bassein_filter_merge_scripts',					'bassein_trx_addons_merge_scripts');
			add_filter( 'bassein_filter_prepare_css',					'bassein_trx_addons_prepare_css', 10, 2);
			add_filter( 'bassein_filter_prepare_js',					'bassein_trx_addons_prepare_js', 10, 2);
			add_filter( 'bassein_filter_localize_script',				'bassein_trx_addons_localize_script');
			add_filter( 'bassein_filter_get_post_categories',		 	'bassein_trx_addons_get_post_categories');
			add_filter( 'bassein_filter_get_post_date',		 			'bassein_trx_addons_get_post_date');
			add_filter( 'trx_addons_filter_get_post_date',		 		'bassein_trx_addons_get_post_date_wrap');
			add_filter( 'bassein_filter_post_type_taxonomy',			'bassein_trx_addons_post_type_taxonomy', 10, 2 );
			if (is_admin()) {
				add_filter( 'bassein_filter_allow_meta_box', 			'bassein_trx_addons_allow_meta_box', 10, 2);
				add_filter( 'bassein_filter_allow_theme_icons', 		'bassein_trx_addons_allow_theme_icons', 10, 2);
				add_filter( 'trx_addons_filter_export_options',			'bassein_trx_addons_export_options');
			} else {
				add_filter( 'trx_addons_filter_theme_logo',				'bassein_trx_addons_theme_logo');
				add_filter( 'trx_addons_filter_post_meta',				'bassein_trx_addons_post_meta', 10, 2);
				add_filter( 'trx_addons_filter_inc_views',		 		'bassein_trx_addons_inc_views');
				add_filter( 'bassein_filter_post_meta_args',			'bassein_trx_addons_post_meta_args', 10, 3);
				add_filter( 'trx_addons_filter_args_related',			'bassein_trx_addons_args_related');
				add_filter( 'trx_addons_filter_seo_snippets',			'bassein_trx_addons_seo_snippets');
				add_action( 'trx_addons_action_before_article',			'bassein_trx_addons_before_article', 10, 1);
				add_filter( 'bassein_filter_get_mobile_menu',			'bassein_trx_addons_get_mobile_menu');
				add_filter( 'bassein_filter_detect_blog_mode',			'bassein_trx_addons_detect_blog_mode' );
				add_filter( 'bassein_filter_get_blog_title', 			'bassein_trx_addons_get_blog_title');
				add_action( 'bassein_action_login',						'bassein_trx_addons_action_login');
				add_action( 'bassein_action_breadcrumbs',				'bassein_trx_addons_action_breadcrumbs');
				add_action( 'bassein_action_show_layout',				'bassein_trx_addons_action_show_layout', 10, 1);
				add_filter( 'bassein_filter_get_translated_layout',		'bassein_trx_addons_filter_get_translated_layout', 10, 1);
				add_action( 'bassein_action_user_meta',					'bassein_trx_addons_action_user_meta');
				add_action( 'bassein_action_before_post_meta',			'bassein_trx_addons_action_before_post_meta'); 
				add_filter( 'trx_addons_filter_featured_image_override','bassein_trx_addons_featured_image_override');
				add_filter( 'trx_addons_filter_get_current_mode_image',	'bassein_trx_addons_get_current_mode_image');
			}
		}
		
		// Add this filter any time: if plugin exists - load plugin's styles, if not exists - load layouts.css instead plugin's styles
		add_filter( 'bassein_filter_merge_styles',						'bassein_trx_addons_merge_styles');
		
		if (is_admin()) {
			add_filter( 'bassein_filter_tgmpa_required_plugins',		'bassein_trx_addons_tgmpa_required_plugins' );
			add_action( 'admin_enqueue_scripts', 						'bassein_trx_addons_editor_load_scripts_admin');
		} else {
			add_action( 'bassein_action_search',						'bassein_trx_addons_action_search', 10, 3);
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'bassein_trx_addons_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('bassein_filter_tgmpa_required_plugins', 'bassein_trx_addons_tgmpa_required_plugins');
	function bassein_trx_addons_tgmpa_required_plugins($list=array()) {
		if (bassein_storage_isset('required_plugins', 'trx_addons')) {
			$path = bassein_get_file_dir('plugins/trx_addons/trx_addons.zip');
			if (!empty($path) || bassein_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> bassein_storage_get_array('required_plugins', 'trx_addons'),
					'slug' 		=> 'trx_addons',
					'version'	=> '1.6.38',
					'source'	=> !empty($path) ? $path : 'upload://trx_addons.zip',
					'required' 	=> true
				);
			}
		}
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

if (!function_exists('bassein_trx_addons_cpt_list_options')) {
	// Handler of the add_filter( 'trx_addons_cpt_list_options', 'bassein_trx_addons_cpt_list_options', 10, 2);
	function bassein_trx_addons_cpt_list_options($options, $cpt) {
		if (is_array($options)) {
			foreach ($options as $k=>$v) {
				// Store this option in the external (not theme's) storage
				$options[$k]['options_storage'] = 'trx_addons_options';
				// Hide this option from plugin's options (only for overriden options)
				$options[$k]['hidden'] = in_array($cpt, array('cars', 'cars_agents', 'certificates', 'courses', 'dishes', 'portfolio', 'properties', 'agents', 'resume', 'services', 'sport', 'team', 'testimonials'));
			}
		}
		return $options;
	}
}

// Return plugin's specific options for CPT
if (!function_exists('bassein_trx_addons_get_list_cpt_options')) {
	function bassein_trx_addons_get_list_cpt_options($cpt) {
		$options = array();
		if ($cpt == 'cars')
			$options = array_merge(
						trx_addons_cpt_cars_get_list_options(),
						trx_addons_cpt_cars_agents_get_list_options()
						);
		else if ($cpt == 'certificates')
			$options = trx_addons_cpt_certificates_get_list_options();
		else if ($cpt == 'courses')
			$options = trx_addons_cpt_courses_get_list_options();
		else if ($cpt == 'dishes')
			$options = trx_addons_cpt_dishes_get_list_options();
		else if ($cpt == 'portfolio')
			$options = trx_addons_cpt_portfolio_get_list_options();
		else if ($cpt == 'resume')
			$options = trx_addons_cpt_resume_get_list_options();
		else if ($cpt == 'services')
			$options = trx_addons_cpt_services_get_list_options();
		else if ($cpt == 'properties')
			$options = array_merge(
						trx_addons_cpt_properties_get_list_options(),
						trx_addons_cpt_agents_get_list_options()
						);
		else if ($cpt == 'sport')
			$options = trx_addons_cpt_sport_get_list_options();
		else if ($cpt == 'team')
			$options = trx_addons_cpt_team_get_list_options();
		else if ($cpt == 'testimonials')
			$options = trx_addons_cpt_testimonials_get_list_options();

		// Remove parameter 'hidden'
		foreach ($options as $k=>$v) {
			if (!empty($v['hidden']))
				unset($options[$k]['hidden']);
		}
		return $options;
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('bassein_trx_addons_setup3')) {
	add_action( 'after_setup_theme', 'bassein_trx_addons_setup3', 3 );
	function bassein_trx_addons_setup3() {
		
		// Section 'Cars' - settings to show 'Cars' blog archive and single posts
		if (bassein_exists_cars()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'cars' => array(
						"title" => esc_html__('Cars', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the cars pages.', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('cars'),
				bassein_options_get_list_cpt_options('cars'),
				array(
					"single_info_cars" => array(
						"title" => esc_html__('Single car', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_cars' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related cars' on the single car page", 'bassein') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_cars' => array(
						"title" => esc_html__('Related cars', 'bassein'),
						"desc" => wp_kses_data( __('How many related cars should be displayed on the single car page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_cars' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_cars' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related cars on the single car page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_cars' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Certificates'
		if (bassein_exists_certificates()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'certificates' => array(
						"title" => esc_html__('Certificates', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display "Certificates"', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('certificates')
			));
		}
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (bassein_exists_courses()) {
		
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'courses' => array(
						"title" => esc_html__('Courses', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('courses'),
				bassein_options_get_list_cpt_options('courses'),
				array(
					"single_info_courses" => array(
						"title" => esc_html__('Single course', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_courses' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related courses' on the single course page", 'bassein') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_courses' => array(
						"title" => esc_html__('Related courses', 'bassein'),
						"desc" => wp_kses_data( __('How many related courses should be displayed on the single course page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_courses' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_courses' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related courses on the single course page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_courses' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Dishes' - settings to show 'Dishes' blog archive and single posts
		if (bassein_exists_dishes()) {

			bassein_storage_merge_array('options', '', array_merge(
				array(
					'dishes' => array(
						"title" => esc_html__('Dishes', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the dishes pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('dishes'),
				bassein_options_get_list_cpt_options('dishes'),
				array(
					"single_info_dishes" => array(
						"title" => esc_html__('Single dish', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_dishes' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related dishes' on the single dish page", 'bassein') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_dishes' => array(
						"title" => esc_html__('Related dishes', 'bassein'),
						"desc" => wp_kses_data( __('How many related dishes should be displayed on the single dish page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_dishes' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_dishes' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related dishes on the single dish page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_dishes' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
					)
				)
			);
		}
		
		// Section 'Portfolio' - settings to show 'Portfolio' blog archive and single posts
		if (bassein_exists_portfolio()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'portfolio' => array(
						"title" => esc_html__('Portfolio', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the portfolio pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('portfolio'),
				bassein_options_get_list_cpt_options('portfolio'),
				array(
					"single_info_portfolio" => array(
						"title" => esc_html__('Single portfolio item', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_portfolio' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related portfolio items' on the single portfolio page", 'bassein') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_portfolio' => array(
						"title" => esc_html__('Related portfolio items', 'bassein'),
						"desc" => wp_kses_data( __('How many related portfolio items should be displayed on the single portfolio page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_portfolio' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_portfolio' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related portfolio on the single portfolio page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_portfolio' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Properties' - settings to show 'Properties' blog archive and single posts
		if (bassein_exists_properties()) {
		
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'properties' => array(
						"title" => esc_html__('Properties', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the properties pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('properties'),
				bassein_options_get_list_cpt_options('properties'),
				array(
					"single_info_properties" => array(
						"title" => esc_html__('Single property', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_properties' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related properties' on the single property page", 'bassein') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_properties' => array(
						"title" => esc_html__('Related properties', 'bassein'),
						"desc" => wp_kses_data( __('How many related properties should be displayed on the single property page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_properties' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_properties' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related properties on the single property page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_properties' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
					)
				)
			);
		}
		
		// Section 'Resume'
		if (bassein_exists_resume()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'resume' => array(
						"title" => esc_html__('Resume', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display "Resume"', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('resume')
			));
		}
		
		// Section 'Services' - settings to show 'Services' blog archive and single posts
		if (bassein_exists_services()) {
		
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'services' => array(
						"title" => esc_html__('Services', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the services pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('services'),
				bassein_options_get_list_cpt_options('services'),
				array(
					"single_info_services" => array(
						"title" => esc_html__('Single service item', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					'show_related_posts_services' => array(
						"title" => esc_html__('Show related posts', 'bassein'),
						"desc" => wp_kses_data( __("Show section 'Related services' on the single service page", 'bassein') ),
						"std" => 0,
						"type" => "checkbox"
						),
					'related_posts_services' => array(
						"title" => esc_html__('Related services', 'bassein'),
						"desc" => wp_kses_data( __('How many related services should be displayed on the single service page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_services' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,9),
						"type" => "select"
						),
					'related_columns_services' => array(
						"title" => esc_html__('Related columns', 'bassein'),
						"desc" => wp_kses_data( __('How many columns should be used to output related services on the single service page?', 'bassein') ),
						"dependency" => array(
							'show_related_posts_services' => array(1)
						),
						"std" => 3,
						"options" => bassein_get_list_range(1,4),
						"type" => "select"
						)
				)
			));
		}
		
		// Section 'Sport' - settings to show 'Sport' blog archive and single posts
		if (bassein_exists_sport()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'sport' => array(
						"title" => esc_html__('Sport', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the sport pages', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('sport'),
				bassein_options_get_list_cpt_options('sport')
			));
		}
		
		// Section 'Team' - settings to show 'Team' blog archive and single posts
		if (bassein_exists_team()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'team' => array(
						"title" => esc_html__('Team', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display the team members pages.', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('team'),
				bassein_options_get_list_cpt_options('team')
			));
		}
		
		// Section 'Testimonials'
		if (bassein_exists_resume()) {
			bassein_storage_merge_array('options', '', array_merge(
				array(
					'testimonials' => array(
						"title" => esc_html__('Testimonials', 'bassein'),
						"desc" => wp_kses_data( __('Select parameters to display "Testimonials"', 'bassein') )
									. '<br>'
									. wp_kses_data( __('Attention! Some options will be applied only after you click "Save"!', 'bassein') ),
						"type" => "section"
						)
				),
				bassein_trx_addons_get_list_cpt_options('testimonials')
			));
		}
	}
}

// Add 'layout edit' link to the 'description' in the 'header_style' and 'footer_style' parameters
if ( !function_exists('bassein_trx_addons_add_link_edit_layout') ) {
	//Handler of the add_action( 'bassein_action_load_options', 'bassein_trx_addons_add_link_edit_layout');
	function bassein_trx_addons_add_link_edit_layout() {
		static $added = false;
		if ($added) return;
		$added = true;
		$options = bassein_storage_get('options');
		foreach($options as $k=>$v) {
			if (!isset($v['std'])) continue;
			$k1 = substr($k, 0, 12);
			if ($k1=='header_style' || $k1=='footer_style') {
				$layout = bassein_get_theme_option($k);
				if (!empty($layout)) {
					$layout = explode('-', $layout);
					$layout = $layout[count($layout)-1];
					if ($layout > 0) {
						bassein_storage_set_array2('options', $k, 'desc', $v['desc']
												. '<br>'
												. sprintf('<a href="%1$s" class="bassein_post_editor" target="_blank">%2$s</a>',
															admin_url( sprintf( "post.php?post=%d&amp;action=edit", $layout ) ),
															__("Open selected layout in a new tab to edit", 'bassein')
														)
												);
					}
				}
			}
		}
	}
}


// Setup internal plugin's parameters
if (!function_exists('bassein_trx_addons_init_settings')) {
	add_filter( 'trx_addons_init_settings', 'bassein_trx_addons_init_settings');
	function bassein_trx_addons_init_settings($settings) {
		$settings['socials_type']	= bassein_get_theme_setting('socials_type');
		$settings['icons_type']		= bassein_get_theme_setting('icons_type');
		$settings['icons_selector']	= bassein_get_theme_setting('icons_selector');
		return $settings;
	}
}



/* Plugin's support utilities
------------------------------------------------------------------------------- */

// Check if plugin installed and activated
if ( !function_exists( 'bassein_exists_trx_addons' ) ) {
	function bassein_exists_trx_addons() {
		return defined('TRX_ADDONS_VERSION');
	}
}

// Return true if cars is supported
if ( !function_exists( 'bassein_exists_cars' ) ) {
	function bassein_exists_cars() {
		return defined('TRX_ADDONS_CPT_CARS_PT');
	}
}

// Return true if certificates is supported
if ( !function_exists( 'bassein_exists_certificates' ) ) {
	function bassein_exists_certificates() {
		return defined('TRX_ADDONS_CPT_CERTIFICATES_PT');
	}
}

// Return true if courses is supported
if ( !function_exists( 'bassein_exists_courses' ) ) {
	function bassein_exists_courses() {
		return defined('TRX_ADDONS_CPT_COURSES_PT');
	}
}

// Return true if dishes is supported
if ( !function_exists( 'bassein_exists_dishes' ) ) {
	function bassein_exists_dishes() {
		return defined('TRX_ADDONS_CPT_DISHES_PT');
	}
}

// Return true if layouts is supported
if ( !function_exists( 'bassein_exists_layouts' ) ) {
	function bassein_exists_layouts() {
		return defined('TRX_ADDONS_CPT_LAYOUTS_PT');
	}
}

// Return true if portfolio is supported
if ( !function_exists( 'bassein_exists_portfolio' ) ) {
	function bassein_exists_portfolio() {
		return defined('TRX_ADDONS_CPT_PORTFOLIO_PT');
	}
}

// Return true if properties is supported
if ( !function_exists( 'bassein_exists_properties' ) ) {
	function bassein_exists_properties() {
		return defined('TRX_ADDONS_CPT_PROPERTIES_PT');
	}
}

// Return true if resume is supported
if ( !function_exists( 'bassein_exists_resume' ) ) {
	function bassein_exists_resume() {
		return defined('TRX_ADDONS_CPT_RESUME_PT');
	}
}

// Return true if services is supported
if ( !function_exists( 'bassein_exists_services' ) ) {
	function bassein_exists_services() {
		return defined('TRX_ADDONS_CPT_SERVICES_PT');
	}
}

// Return true if sport is supported
if ( !function_exists( 'bassein_exists_sport' ) ) {
	function bassein_exists_sport() {
		return defined('TRX_ADDONS_CPT_COMPETITIONS_PT');
	}
}

// Return true if team is supported
if ( !function_exists( 'bassein_exists_team' ) ) {
	function bassein_exists_team() {
		return defined('TRX_ADDONS_CPT_TEAM_PT');
	}
}

// Return true if testimonials is supported
if ( !function_exists( 'bassein_exists_testimonials' ) ) {
	function bassein_exists_testimonials() {
		return defined('TRX_ADDONS_CPT_TESTIMONIALS_PT');
	}
}


// Return true if it's cars page
if ( !function_exists( 'bassein_is_cars_page' ) ) {
	function bassein_is_cars_page() {
		return function_exists('trx_addons_is_cars_page') && trx_addons_is_cars_page();
	}
}

// Return true if it's courses page
if ( !function_exists( 'bassein_is_courses_page' ) ) {
	function bassein_is_courses_page() {
		return function_exists('trx_addons_is_courses_page') && trx_addons_is_courses_page();
	}
}

// Return true if it's dishes page
if ( !function_exists( 'bassein_is_dishes_page' ) ) {
	function bassein_is_dishes_page() {
		return function_exists('trx_addons_is_dishes_page') && trx_addons_is_dishes_page();
	}
}

// Return true if it's properties page
if ( !function_exists( 'bassein_is_properties_page' ) ) {
	function bassein_is_properties_page() {
		return function_exists('trx_addons_is_properties_page') && trx_addons_is_properties_page();
	}
}

// Return true if it's portfolio page
if ( !function_exists( 'bassein_is_portfolio_page' ) ) {
	function bassein_is_portfolio_page() {
		return function_exists('trx_addons_is_portfolio_page') && trx_addons_is_portfolio_page();
	}
}

// Return true if it's services page
if ( !function_exists( 'bassein_is_services_page' ) ) {
	function bassein_is_services_page() {
		return function_exists('trx_addons_is_services_page') && trx_addons_is_services_page();
	}
}

// Return true if it's team page
if ( !function_exists( 'bassein_is_team_page' ) ) {
	function bassein_is_team_page() {
		return function_exists('trx_addons_is_team_page') && trx_addons_is_team_page();
	}
}

// Return true if it's sport page
if ( !function_exists( 'bassein_is_sport_page' ) ) {
	function bassein_is_sport_page() {
		return function_exists('trx_addons_is_sport_page') && trx_addons_is_sport_page();
	}
}

// Return true if custom layouts are available
if ( !function_exists( 'bassein_is_layouts_available' ) ) {
	function bassein_is_layouts_available() {
		return bassein_exists_trx_addons() 
										&& (
											function_exists('bassein_exists_sop') && bassein_exists_sop()
											||
											function_exists('bassein_exists_visual_composer') && bassein_exists_visual_composer()
											);
	}
}

// Detect current blog mode
if ( !function_exists( 'bassein_trx_addons_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'bassein_filter_detect_blog_mode', 'bassein_trx_addons_detect_blog_mode' );
	function bassein_trx_addons_detect_blog_mode($mode='') {
		if ( bassein_is_cars_page() )
			$mode = 'cars';
		else if ( bassein_is_courses_page() )
			$mode = 'courses';
		else if ( bassein_is_dishes_page() )
			$mode = 'dishes';
		else if ( bassein_is_properties_page() )
			$mode = 'properties';
		else if ( bassein_is_portfolio_page() )
			$mode = 'portfolio';
		else if ( bassein_is_services_page() )
			$mode = 'services';
		else if ( bassein_is_sport_page() )
			$mode = 'sport';
		else if ( bassein_is_team_page() )
			$mode = 'team';
		return $mode;
	}
}

// Disallow increment views counter on the blog archive
if ( !function_exists( 'bassein_trx_addons_inc_views' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_inc_views', 'bassein_trx_addons_inc_views');
	function bassein_trx_addons_inc_views($allow=false) {
		return $allow && is_page() && bassein_storage_isset('blog_archive') ? false : $allow;
	}
}

// Add team, courses, etc. to the supported posts list
if ( !function_exists( 'bassein_trx_addons_list_post_types' ) ) {
	//Handler of the add_filter( 'bassein_filter_list_posts_types', 'bassein_trx_addons_list_post_types');
	function bassein_trx_addons_list_post_types($list=array()) {
		if (function_exists('trx_addons_get_cpt_list')) {
			$cpt_list = trx_addons_get_cpt_list();
			foreach ($cpt_list as $cpt => $title) {
				if (   
					   (defined('TRX_ADDONS_CPT_CARS_PT') && $cpt == TRX_ADDONS_CPT_CARS_PT)
					|| (defined('TRX_ADDONS_CPT_COURSES_PT') && $cpt == TRX_ADDONS_CPT_COURSES_PT)
					|| (defined('TRX_ADDONS_CPT_DISHES_PT') && $cpt == TRX_ADDONS_CPT_DISHES_PT)
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $cpt == TRX_ADDONS_CPT_PORTFOLIO_PT)
					|| (defined('TRX_ADDONS_CPT_PROPERTIES_PT') && $cpt == TRX_ADDONS_CPT_PROPERTIES_PT)
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $cpt == TRX_ADDONS_CPT_SERVICES_PT)
					|| (defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && $cpt == TRX_ADDONS_CPT_COMPETITIONS_PT)
					|| (defined('TRX_ADDONS_CPT_TEAM_PT') && $cpt == TRX_ADDONS_CPT_TEAM_PT)
					)
					$list[$cpt] = $title;
			}
		}
		return $list;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'bassein_trx_addons_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'bassein_filter_post_type_taxonomy',	'bassein_trx_addons_post_type_taxonomy', 10, 2 );
	function bassein_trx_addons_post_type_taxonomy($tax='', $post_type='') {
		if ( defined('TRX_ADDONS_CPT_CARS_PT') && $post_type == TRX_ADDONS_CPT_CARS_PT )
			$tax = TRX_ADDONS_CPT_CARS_TAXONOMY_MAKER;
		else if ( defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type == TRX_ADDONS_CPT_COURSES_PT )
			$tax = TRX_ADDONS_CPT_COURSES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_DISHES_PT') && $post_type == TRX_ADDONS_CPT_DISHES_PT )
			$tax = TRX_ADDONS_CPT_DISHES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type == TRX_ADDONS_CPT_PORTFOLIO_PT )
			$tax = TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_PROPERTIES_PT') && $post_type == TRX_ADDONS_CPT_PROPERTIES_PT )
			$tax = TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE;
		else if ( defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type == TRX_ADDONS_CPT_SERVICES_PT )
			$tax = TRX_ADDONS_CPT_SERVICES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && $post_type == TRX_ADDONS_CPT_COMPETITIONS_PT )
			$tax = TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type == TRX_ADDONS_CPT_TEAM_PT )
			$tax = TRX_ADDONS_CPT_TEAM_TAXONOMY;
		return $tax;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'bassein_trx_addons_get_post_categories' ) ) {
	//Handler of the add_filter( 'bassein_filter_get_post_categories', 		'bassein_trx_addons_get_post_categories');
	function bassein_trx_addons_get_post_categories($cats='') {

		if ( defined('TRX_ADDONS_CPT_CARS_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_CARS_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_CARS_TAXONOMY_TYPE);
			}
		}
		if ( defined('TRX_ADDONS_CPT_COURSES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_COURSES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_DISHES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_DISHES_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_DISHES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_PORTFOLIO_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_PROPERTIES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_PROPERTIES_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE);
			}
		}
		if ( defined('TRX_ADDONS_CPT_SERVICES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_SERVICES_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COMPETITIONS_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_TEAM_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_TEAM_PT) {
				$cats = bassein_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_TEAM_TAXONOMY);
			}
		}
		return $cats;
	}
}

// Show post's date with the theme-specific format
if ( !function_exists( 'bassein_trx_addons_get_post_date_wrap' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_post_date', 'bassein_trx_addons_get_post_date_wrap');
	function bassein_trx_addons_get_post_date_wrap($dt='') {
		return apply_filters('bassein_filter_get_post_date', $dt);
	}
}

// Show date of the courses
if ( !function_exists( 'bassein_trx_addons_get_post_date' ) ) {
	//Handler of the add_filter( 'bassein_filter_get_post_date', 'bassein_trx_addons_get_post_date');
	function bassein_trx_addons_get_post_date($dt='') {

		if ( defined('TRX_ADDONS_CPT_COURSES_PT') && get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
			$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			$dt = $meta['date'];
			// Translators: Add formatted date to the output
			$dt = sprintf($dt < date('Y-m-d') ? esc_html__('Started on %s', 'bassein') : esc_html__('Starting %s', 'bassein'), 
					date_i18n(get_option('date_format'), strtotime($dt)));

		} else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && in_array(get_post_type(), array(TRX_ADDONS_CPT_COMPETITIONS_PT, TRX_ADDONS_CPT_ROUNDS_PT, TRX_ADDONS_CPT_MATCHES_PT))) {
			$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			$dt = $meta['date_start'];
			// Translators: Add formatted date to the output
			$dt = sprintf($dt < date('Y-m-d').(!empty($meta['time_start']) ? ' H:i' : '') ? esc_html__('Started on %s', 'bassein') : esc_html__('Starting %s', 'bassein'), 
					date_i18n(get_option('date_format') . (!empty($meta['time_start']) ? ' '.get_option('time_format') : ''), strtotime($dt.(!empty($meta['time_start']) ? ' '.trim($meta['time_start']) : ''))));

		} else if ( defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && get_post_type() == TRX_ADDONS_CPT_PLAYERS_PT) {
			// Uncomment (remove) next line if you want to show player's birthday in the page title block
			if (false) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				// Translators: Add formatted date to the output
				$dt = !empty($meta['birthday']) ? sprintf(esc_html__('Birthday: %s', 'bassein'), date_i18n(get_option('date_format'), strtotime($meta['birthday']))) : '';
			} else
				$dt = '';
		}
		return $dt;
	}
}

// Check if meta box is allowed
if (!function_exists('bassein_trx_addons_allow_meta_box')) {
	//Handler of the add_filter( 'bassein_filter_allow_meta_box', 'bassein_trx_addons_allow_meta_box', 10, 2);
	function bassein_trx_addons_allow_meta_box($allow, $post_type) {
		return $allow
					|| (defined('TRX_ADDONS_CPT_CARS_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_CARS_PT,
																				TRX_ADDONS_CPT_CARS_AGENTS_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type==TRX_ADDONS_CPT_COURSES_PT)
					|| (defined('TRX_ADDONS_CPT_DISHES_PT') && $post_type==TRX_ADDONS_CPT_DISHES_PT)
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type==TRX_ADDONS_CPT_PORTFOLIO_PT) 
					|| (defined('TRX_ADDONS_CPT_PROPERTIES_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_PROPERTIES_PT,
																				TRX_ADDONS_CPT_AGENTS_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_RESUME_PT') && $post_type==TRX_ADDONS_CPT_RESUME_PT) 
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type==TRX_ADDONS_CPT_SERVICES_PT) 
					|| (defined('TRX_ADDONS_CPT_COMPETITIONS_PT') && in_array($post_type, array(
																				TRX_ADDONS_CPT_COMPETITIONS_PT,
																				TRX_ADDONS_CPT_ROUNDS_PT,
																				TRX_ADDONS_CPT_MATCHES_PT
																				)))
					|| (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT);
	}
}

// Check if theme icons is allowed
if (!function_exists('bassein_trx_addons_allow_theme_icons')) {
	//Handler of the add_filter( 'bassein_filter_allow_theme_icons', 'bassein_trx_addons_allow_theme_icons', 10, 2);
	function bassein_trx_addons_allow_theme_icons($allow, $post_type) {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		return $allow
					|| (defined('TRX_ADDONS_CPT_LAYOUTS_PT') && $post_type==TRX_ADDONS_CPT_LAYOUTS_PT)
					|| (!empty($screen->id) && in_array($screen->id, array(
																		'appearance_page_trx_addons_options',
																		'profile'
																	)
														)
						);
	}
}

// Disable theme-specific fields in the exported options
if (!function_exists('bassein_trx_addons_export_options')) {
	//Handler of the add_filter( 'trx_addons_filter_export_options', 'bassein_trx_addons_export_options');
	function bassein_trx_addons_export_options($options) {
		// ThemeREX Addons
		if (!empty($options['trx_addons_options'])) {
			$options['trx_addons_options']['debug_mode'] = 0;
			$options['trx_addons_options']['api_google'] = '';
			$options['trx_addons_options']['api_google_analitics'] = '';
			$options['trx_addons_options']['api_google_remarketing'] = '';
			$options['trx_addons_options']['demo_enable'] = 0;
			$options['trx_addons_options']['demo_referer'] = '';
			$options['trx_addons_options']['demo_default_url'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			$options['trx_addons_options']['demo_post_type'] = '';
			$options['trx_addons_options']['demo_taxonomy'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			$options['trx_addons_options']['demo_logo'] = '';
			unset($options['trx_addons_options']['themes_market_referals']);
		}
		// ThemeREX Donations
		if (!empty($options['trx_donations_options'])) {
			$options['trx_donations_options']['pp_account'] = '';
		}
		// WooCommerce
		if (!empty($options['woocommerce_paypal_settings'])) {
			$options['woocommerce_paypal_settings']['email'] = '';
			$options['woocommerce_paypal_settings']['receiver_email'] = '';
			$options['woocommerce_paypal_settings']['identity_token'] = '';
		}
		return $options;		
	}
}

// Set related posts and columns for the plugin's output
if (!function_exists('bassein_trx_addons_args_related')) {
	//Handler of the add_filter( 'trx_addons_filter_args_related', 'bassein_trx_addons_args_related');
	function bassein_trx_addons_args_related($args) {
		if (!empty($args['template_args_name']) 
			&& in_array($args['template_args_name'], 
				array('trx_addons_args_sc_cars', 
					  'trx_addons_args_sc_courses',
					  'trx_addons_args_sc_dishes',
					  'trx_addons_args_sc_portfolio',
					  'trx_addons_args_sc_properties',
  					  'trx_addons_args_sc_services'))) {
			$args['posts_per_page'] = (int) bassein_get_theme_option('show_related_posts')
												? bassein_get_theme_option('related_posts')
												: 0;
			$args['columns'] = bassein_get_theme_option('related_columns');
		}
		return $args;
	}
}
// Add 'custom' to the headers types list
if ( !function_exists( 'bassein_trx_addons_list_header_footer_types' ) ) {
	//Handler of the add_filter( 'bassein_filter_list_header_footer_types', 'bassein_trx_addons_list_header_footer_types');
	function bassein_trx_addons_list_header_footer_types($list=array()) {
		if (bassein_exists_layouts()) {
			$list['custom'] = esc_html__('Custom', 'bassein');
		}
		return $list;
	}
}

// Add layouts to the headers list
if ( !function_exists( 'bassein_trx_addons_list_header_styles' ) ) {
	//Handler of the add_filter( 'bassein_filter_list_header_styles', 'bassein_trx_addons_list_header_styles');
	function bassein_trx_addons_list_header_styles($list=array()) {
		if (bassein_exists_layouts()) {
			$layouts = bassein_get_list_posts(false, array(
							'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
							'meta_key' => 'trx_addons_layout_type',
							'meta_value' => 'header',
							'orderby' => 'ID',
							'order' => 'asc',
							'not_selected' => false
							)
						);
			$new_list = array();
			foreach ($layouts as $id=>$title) {
				if ($id != 'none') $new_list['header-custom-'.intval($id)] = $title;
			}
			$list = bassein_array_merge($new_list, $list);
		}
		return $list;
	}
}

// Add layouts to the footers list
if ( !function_exists( 'bassein_trx_addons_list_footer_styles' ) ) {
	//Handler of the add_filter( 'bassein_filter_list_footer_styles', 'bassein_trx_addons_list_footer_styles');
	function bassein_trx_addons_list_footer_styles($list=array()) {
		if (bassein_exists_layouts()) {
			$layouts = bassein_get_list_posts(false, array(
							'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
							'meta_key' => 'trx_addons_layout_type',
							'meta_value' => 'footer',
							'orderby' => 'ID',
							'order' => 'asc',
							'not_selected' => false
							)
						);
			$new_list = array();
			foreach ($layouts as $id=>$title) {
				if ($id != 'none') $new_list['footer-custom-'.intval($id)] = $title;
			}
			$list = bassein_array_merge($new_list, $list);
		}
		return $list;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('bassein_trx_addons_default_layouts')) {
	//Handler of the add_filter( 'trx_addons_filter_default_layouts',	'bassein_trx_addons_default_layouts');
	function bassein_trx_addons_default_layouts($default_layouts=array()) {
		if (bassein_storage_isset('trx_addons_default_layouts')) {
			$layouts = bassein_storage_get('trx_addons_default_layouts');
		} else {
			require_once BASSEIN_THEME_DIR . 'theme-specific/trx_addons.layouts.php';
			if (!isset($layouts) || !is_array($layouts))
				$layouts = array();
			bassein_storage_set('trx_addons_default_layouts', $layouts);
		}
		if (count($layouts) > 0)
			$default_layouts = array_merge($default_layouts, $layouts);
		return $default_layouts;
	}
}


// Add theme-specific components to the plugin's options
if (!function_exists('bassein_trx_addons_default_components')) {
	//Handler of the add_filter( 'trx_addons_filter_load_options',	'bassein_trx_addons_default_components');
	function bassein_trx_addons_default_components($options=array()) {
		if (empty($options['components_present'])) {
			if (bassein_storage_isset('trx_addons_default_components')) {
				$components = bassein_storage_get('trx_addons_default_components');
			} else {
				require_once BASSEIN_THEME_DIR . 'theme-specific/trx_addons.components.php';
				if (!isset($components) || !is_array($components))
					$components = array();
				bassein_storage_set('trx_addons_default_components', $components);
			}
			$options = is_array($options) && count($components) > 0
									? array_merge($options, $components)
									: $components;
		}
		// Turn on API of the theme required plugins
		$plugins = bassein_storage_get('required_plugins');
		foreach ($plugins as $p=>$v) {			
			if (isset($options["components_api_{$p}"]))
				$options["components_api_{$p}"] = 1;
		}
		return $options;
	}
}


// Enqueue custom styles
if ( !function_exists( 'bassein_trx_addons_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'bassein_trx_addons_frontend_scripts', 1100 );
	function bassein_trx_addons_frontend_scripts() {
		if (bassein_exists_trx_addons()) {
			if (bassein_is_on(bassein_get_theme_option('debug_mode')) && bassein_get_file_dir('plugins/trx_addons/trx_addons.css')!='') {
				wp_enqueue_style( 'bassein-trx_addons',  bassein_get_file_url('plugins/trx_addons/trx_addons.css'), array(), null );
				wp_enqueue_style( 'bassein-trx_addons_editor',  bassein_get_file_url('plugins/trx_addons/trx_addons.editor.css'), array(), null );
			}
			if (bassein_is_on(bassein_get_theme_option('debug_mode')) && bassein_get_file_dir('plugins/trx_addons/trx_addons.js')!='')
				wp_enqueue_script( 'bassein-trx_addons', bassein_get_file_url('plugins/trx_addons/trx_addons.js'), array('jquery'), null, true );
		}
		// Load custom layouts from the theme if plugin not exists
		if (bassein_get_theme_option("header_type")=='default' || bassein_get_theme_option("header_style")=='header-default' || !bassein_is_layouts_available()) {
			if ( bassein_is_on(bassein_get_theme_option('debug_mode')) ) {
				wp_enqueue_style( 'bassein-layouts', bassein_get_file_url('plugins/trx_addons/layouts/layouts.css'), array(), null );
				wp_enqueue_style( 'bassein-layouts-logo', bassein_get_file_url('plugins/trx_addons/layouts/logo.css'), array(), null );
				wp_enqueue_style( 'bassein-layouts-menu', bassein_get_file_url('plugins/trx_addons/layouts/menu.css'), array(), null );
				wp_enqueue_style( 'bassein-layouts-search', bassein_get_file_url('plugins/trx_addons/layouts/search.css'), array(), null );
				wp_enqueue_style( 'bassein-layouts-title', bassein_get_file_url('plugins/trx_addons/layouts/title.css'), array(), null );
				wp_enqueue_style( 'bassein-layouts-featured', bassein_get_file_url('plugins/trx_addons/layouts/featured.css'), array(), null );
			}
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'bassein_trx_addons_merge_styles' ) ) {
	//Handler of the add_filter( 'bassein_filter_merge_styles', 'bassein_trx_addons_merge_styles');
	function bassein_trx_addons_merge_styles($list) {
		// ALWAYS merge custom layouts from the theme
		$list[] = 'plugins/trx_addons/layouts/layouts.css';
		$list[] = 'plugins/trx_addons/layouts/logo.css';
		$list[] = 'plugins/trx_addons/layouts/menu.css';
		$list[] = 'plugins/trx_addons/layouts/search.css';
		$list[] = 'plugins/trx_addons/layouts/title.css';
		$list[] = 'plugins/trx_addons/layouts/featured.css';
		if (bassein_exists_trx_addons()) {
			$list[] = 'plugins/trx_addons/trx_addons.css';
			$list[] = 'plugins/trx_addons/trx_addons.editor.css';
		}
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'bassein_trx_addons_merge_scripts' ) ) {
	//Handler of the add_filter('bassein_filter_merge_scripts', 'bassein_trx_addons_merge_scripts');
	function bassein_trx_addons_merge_scripts($list) {
		$list[] = 'plugins/trx_addons/trx_addons.js';
		return $list;
	}
}



// WP Editor addons
//------------------------------------------------------------------------

// Load required styles and scripts for admin mode
if ( !function_exists( 'bassein_trx_addons_editor_load_scripts_admin' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'bassein_trx_addons_editor_load_scripts_admin');
	function bassein_trx_addons_editor_load_scripts_admin() {
		// Add styles in the WP text editor
		add_editor_style( array(
							bassein_get_file_url('plugins/trx_addons/trx_addons.editor.css')
							)
						 );	
	}
}



// Plugin API - theme-specific wrappers for plugin functions
//------------------------------------------------------------------------

// Debug functions wrappers
if (!function_exists('ddo')) { function ddo($obj, $level=-1) { return var_dump($obj); } }
if (!function_exists('dco')) { function dco($obj, $level=-1) { print_r($obj); } }
if (!function_exists('dcl')) { function dcl($msg, $level=-1) { echo '<br><pre>' . esc_html($msg) . '</pre><br>'; } }
if (!function_exists('dfo')) { function dfo($obj, $level=-1) {} }
if (!function_exists('dfl')) { function dfl($msg, $level=-1) {} }

// Check if URL contain specified string
if (!function_exists('bassein_check_url')) {
	function bassein_check_url($val='', $defa=false) {
		return function_exists('trx_addons_check_url') 
					? trx_addons_check_url($val) 
					: $defa;
	}
}

// Check if layouts components are showed or set new state
if (!function_exists('bassein_sc_layouts_showed')) {
	function bassein_sc_layouts_showed($name, $val=null) {
		if (function_exists('trx_addons_sc_layouts_showed')) {
			if ($val!==null)
				trx_addons_sc_layouts_showed($name, $val);
			else
				return trx_addons_sc_layouts_showed($name);
		} else {
			if ($val!==null)
				return bassein_storage_set_array('sc_layouts_components', $name, $val);
			else
				return bassein_storage_get_array('sc_layouts_components', $name);
		}
	}
}

// Return image size multiplier
if (!function_exists('bassein_get_retina_multiplier')) {
	function bassein_get_retina_multiplier($force_retina=0) {
		static $mult = 0;
		if ($mult == 0) $mult = function_exists('trx_addons_get_retina_multiplier') ? trx_addons_get_retina_multiplier($force_retina) : 1;
		return max(1, $mult);
	}
}

// Return slider layout
if (!function_exists('bassein_get_slider_layout')) {
	function bassein_get_slider_layout($args) {
		return function_exists('trx_addons_get_slider_layout') 
					? trx_addons_get_slider_layout($args) 
					: '';
	}
}

// Return video player layout
if (!function_exists('bassein_get_video_layout')) {
	function bassein_get_video_layout($args) {
		return function_exists('trx_addons_get_video_layout') 
					? trx_addons_get_video_layout($args) 
					: '';
	}
}

// Return theme specific layout of the featured image block
if ( !function_exists( 'bassein_trx_addons_featured_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_featured_image', 'bassein_trx_addons_featured_image', 10, 2);
	function bassein_trx_addons_featured_image($processed=false, $args=array()) {
		$args['show_no_image'] = true;
		$args['singular'] = false;
		$args['hover'] = isset($args['hover']) && $args['hover']=='' ? '' : bassein_get_theme_option('image_hover');
		bassein_show_post_featured($args);
		return true;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'bassein_trx_addons_add_thumb_sizes' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_add_thumb_sizes', 'bassein_trx_addons_add_thumb_sizes');
	function bassein_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			$thumb_sizes = bassein_storage_get('theme_thumbs');
			foreach ($thumb_sizes as $v) {
				if (!empty($v['subst']) && isset($list[$v['subst']]))
					unset($list[$v['subst']]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'bassein_trx_addons_get_thumb_size' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_thumb_size', 'bassein_trx_addons_get_thumb_size');
	function bassein_trx_addons_get_thumb_size($thumb_size='') {
		$thumb_sizes = bassein_storage_get('theme_thumbs');
		foreach ($thumb_sizes as $k => $v) {
			if (strpos($thumb_size, $v['subst']) !== false) {
				$thumb_size = str_replace($thumb_size, $v['subst'], $k);
				break;
			}
		}
		return $thumb_size;
	}
}

// Return theme specific 'no-image' picture
if ( !function_exists( 'bassein_trx_addons_no_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_no_image', 'bassein_trx_addons_no_image');
	function bassein_trx_addons_no_image($no_image='') {
		return bassein_get_no_image($no_image);
	}
}

// Return theme-specific icons
if ( !function_exists( 'bassein_trx_addons_get_list_icons' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_list_icons', 'bassein_trx_addons_get_list_icons', 10, 2 );
	function bassein_trx_addons_get_list_icons($list, $prepend_inherit) {
		return bassein_get_list_icons($prepend_inherit);
	}
}

// Return links to the social profiles
if (!function_exists('bassein_get_socials_links')) {
	function bassein_get_socials_links($style='icons') {
		return function_exists('trx_addons_get_socials_links') 
					? trx_addons_get_socials_links($style)
					: '';
	}
}

// Return links to share post
if (!function_exists('bassein_get_share_links')) {
	function bassein_get_share_links($args=array()) {
		return function_exists('trx_addons_get_share_links') 
					? trx_addons_get_share_links($args)
					: '';
	}
}

// Display links to share post
if (!function_exists('bassein_show_share_links')) {
	function bassein_show_share_links($args=array()) {
		if (function_exists('trx_addons_get_share_links')) {
			$args['echo'] = true;
			trx_addons_get_share_links($args);
		}
	}
}

// Show reactions in the single posts
if (!function_exists('bassein_trx_addons_action_before_post_meta')) {
	//Handler of the add_action( 'bassein_action_before_post_meta', 'bassein_trx_addons_action_before_post_meta'); 
	function bassein_trx_addons_action_before_post_meta() {
		if (trx_addons_is_on(trx_addons_get_option('emotions_allowed')) && is_single() && !is_attachment())
			trx_addons_get_post_reactions(true);
	}
}


// Return image from the category
if (!function_exists('bassein_get_category_image')) {
	function bassein_get_category_image($term_id=0) {
		return function_exists('trx_addons_get_category_image') 
					? trx_addons_get_category_image($term_id)
					: '';
	}
}

// Return small image (icon) from the category
if (!function_exists('bassein_get_category_icon')) {
	function bassein_get_category_icon($term_id=0) {
		return function_exists('trx_addons_get_category_icon') 
					? trx_addons_get_category_icon($term_id)
					: '';
	}
}

// Return string with counters items
if (!function_exists('bassein_get_post_counters')) {
	function bassein_get_post_counters($counters='views') {
		return function_exists('trx_addons_get_post_counters')
					? str_replace('post_counters_item', 'post_meta_item post_counters_item', trx_addons_get_post_counters($counters))
					: '';
	}
}

// Return list with animation effects
if (!function_exists('bassein_get_list_animations_in')) {
	function bassein_get_list_animations_in() {
		return function_exists('trx_addons_get_list_animations_in') 
					? trx_addons_get_list_animations_in()
					: array();
	}
}

// Return classes list for the specified animation
if (!function_exists('bassein_get_animation_classes')) {
	function bassein_get_animation_classes($animation, $speed='normal', $loop='none') {
		return function_exists('trx_addons_get_animation_classes') 
					? trx_addons_get_animation_classes($animation, $speed, $loop)
					: '';
	}
}

// Return string with the likes counter for the specified comment
if (!function_exists('bassein_get_comment_counters')) {
	function bassein_get_comment_counters($counters = 'likes') {
		return function_exists('trx_addons_get_comment_counters') 
					? trx_addons_get_comment_counters($counters)
					: '';
	}
}

// Display likes counter for the specified comment
if (!function_exists('bassein_show_comment_counters')) {
	function bassein_show_comment_counters($counters = 'likes') {
		if (function_exists('trx_addons_get_comment_counters'))
			trx_addons_get_comment_counters($counters, true);
	}
}

// Add query params to sort posts by views or likes
if (!function_exists('bassein_trx_addons_query_sort_order')) {
	//Handler of the add_filter('bassein_filter_query_sort_order', 'bassein_trx_addons_query_sort_order', 10, 3);
	function bassein_trx_addons_query_sort_order($q=array(), $orderby='date', $order='desc') {
		if ($orderby == 'views') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_views_count';
		} else if ($orderby == 'likes') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_likes_count';
		}
		return $q;
	}
}

// Return theme-specific logo to the plugin
if ( !function_exists( 'bassein_trx_addons_theme_logo' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_theme_logo', 'bassein_trx_addons_theme_logo');
	function bassein_trx_addons_theme_logo($logo) {
		return bassein_get_logo_image();
	}
}

// Return theme-specific post meta to the plugin
if ( !function_exists( 'bassein_trx_addons_post_meta' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_post_meta',	'bassein_trx_addons_post_meta', 10, 2);
	function bassein_trx_addons_post_meta($meta, $args=array()) {
		return bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', $args, 'trx_addons', 1));
	}
}

// Return theme-specific post meta args
if ( !function_exists( 'bassein_trx_addons_post_meta_args' ) ) {
	//Handler of the add_filter( 'bassein_filter_post_meta_args',	'bassein_trx_addons_post_meta_args', 10, 3);
	function bassein_trx_addons_post_meta_args($args=array(), $from='', $columns=1) {
		if (is_single() && $from=='trx_addons') {
			$args['components'] = bassein_array_get_keys_by_value(bassein_get_theme_option('meta_parts'));
			$args['counters'] = bassein_array_get_keys_by_value(bassein_get_theme_option('counters'));
			$args['seo'] = bassein_is_on(bassein_get_theme_option('seo_snippets'));
		}
		return $args;
	}
}

// Check if featured image override is allowed
if ( !function_exists( 'bassein_trx_addons_featured_image_override' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_featured_image_override','bassein_trx_addons_featured_image_override');
	function bassein_trx_addons_featured_image_override($flag=false) {
		if ($flag)
			$flag = bassein_is_on(bassein_get_theme_option('header_image_override')) 
					&& apply_filters('bassein_filter_allow_override_header_image', true);
		return $flag;
	}
}

// Return featured image for current mode (post/page/category/blog template ...)
if ( !function_exists( 'bassein_trx_addons_get_current_mode_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_current_mode_image','bassein_trx_addons_get_current_mode_image');
	function bassein_trx_addons_get_current_mode_image($img='') {
		return bassein_get_current_mode_image($img);
	}
}
	
// Redirect action 'get_mobile_menu' to the plugin
// Return stored items as mobile menu
if ( !function_exists( 'bassein_trx_addons_get_mobile_menu' ) ) {
	//Handler of the add_filter("bassein_filter_get_mobile_menu", 'bassein_trx_addons_get_mobile_menu');
	function bassein_trx_addons_get_mobile_menu($menu) {
		return apply_filters('trx_addons_filter_get_mobile_menu', $menu);
	}
}

// Redirect action 'login' to the plugin
if (!function_exists('bassein_trx_addons_action_login')) {
	//Handler of the add_action( 'bassein_action_login', 'bassein_trx_addons_action_login');
	function bassein_trx_addons_action_login($args=array()) {
		do_action( 'trx_addons_action_login', $args );
	}
}

// Redirect action 'search' to the plugin
if (!function_exists('bassein_trx_addons_action_search')) {
	//Handler of the add_action( 'bassein_action_search', 'bassein_trx_addons_action_search', 10, 3);
	function bassein_trx_addons_action_search($style, $class, $ajax) {
		if (bassein_exists_trx_addons())
			do_action( 'trx_addons_action_search', $style, $class, $ajax );
		else
			get_template_part('templates/search-form');
	}
}

// Redirect action 'breadcrumbs' to the plugin
if (!function_exists('bassein_trx_addons_action_breadcrumbs')) {
	//Handler of the add_action( 'bassein_action_breadcrumbs',	'bassein_trx_addons_action_breadcrumbs');
	function bassein_trx_addons_action_breadcrumbs() {
		do_action( 'trx_addons_action_breadcrumbs' );
	}
}

// Redirect action 'show_layout' to the plugin
if (!function_exists('bassein_trx_addons_action_show_layout')) {
	//Handler of the add_action( 'bassein_action_show_layout', 'bassein_trx_addons_action_show_layout', 10, 1);
	function bassein_trx_addons_action_show_layout($layout_id='') {
		do_action( 'trx_addons_action_show_layout', $layout_id );
	}
}

// Redirect filter 'get_translated_layout' to the plugin
if (!function_exists('bassein_trx_addons_filter_get_translated_layout')) {
	//Handler of the add_filter( 'bassein_filter_get_translated_layout', 'bassein_trx_addons_filter_get_translated_layout', 10, 1);
	function bassein_trx_addons_filter_get_translated_layout($layout_id='') {
		return apply_filters( 'trx_addons_filter_get_translated_layout', $layout_id );
	}
}

// Show user meta (socials)
if (!function_exists('bassein_trx_addons_action_user_meta')) {
	//Handler of the add_action( 'bassein_action_user_meta', 'bassein_trx_addons_action_user_meta');
	function bassein_trx_addons_action_user_meta() {
		do_action( 'trx_addons_action_user_meta' );
	}
}

// Redirect filter 'get_blog_title' to the plugin
if ( !function_exists( 'bassein_trx_addons_get_blog_title' ) ) {
	//Handler of the add_filter( 'bassein_filter_get_blog_title', 'bassein_trx_addons_get_blog_title');
	function bassein_trx_addons_get_blog_title($title='') {
		return apply_filters('trx_addons_filter_get_blog_title', $title);
	}
}

// Return true, if theme need a SEO snippets
if (!function_exists('bassein_trx_addons_seo_snippets')) {
	//Handler of the add_filter( 'trx_addons_filter_seo_snippets', 'bassein_trx_addons_seo_snippets');
	function bassein_trx_addons_seo_snippets($enable=false) {
		return bassein_is_on(bassein_get_theme_option('seo_snippets'));
	}
}

// Show user meta (socials)
if (!function_exists('bassein_trx_addons_before_article')) {
	//Handler of the add_action( 'trx_addons_action_before_article', 'bassein_trx_addons_before_article', 10, 1);
	function bassein_trx_addons_before_article($page='') {
		if (bassein_is_on(bassein_get_theme_option('seo_snippets')))
			get_template_part('templates/seo');
	}
}

// Redirect filter 'prepare_css' to the plugin
if (!function_exists('bassein_trx_addons_prepare_css')) {
	//Handler of the add_filter( 'bassein_filter_prepare_css',	'bassein_trx_addons_prepare_css', 10, 2);
	function bassein_trx_addons_prepare_css($css='', $remove_spaces=true) {
		return apply_filters( 'trx_addons_filter_prepare_css', $css, $remove_spaces );
	}
}

// Redirect filter 'prepare_js' to the plugin
if (!function_exists('bassein_trx_addons_prepare_js')) {
	//Handler of the add_filter( 'bassein_filter_prepare_js',	'bassein_trx_addons_prepare_js', 10, 2);
	function bassein_trx_addons_prepare_js($js='', $remove_spaces=true) {
		return apply_filters( 'trx_addons_filter_prepare_js', $js, $remove_spaces );
	}
}

// Add plugin's specific variables to the scripts
if (!function_exists('bassein_trx_addons_localize_script')) {
	//Handler of the add_filter( 'bassein_filter_localize_script',	'bassein_trx_addons_localize_script');
	function bassein_trx_addons_localize_script($arr) {
		$arr['trx_addons_exists'] = bassein_exists_trx_addons();
		return $arr;
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if (bassein_exists_trx_addons()) { require_once BASSEIN_THEME_DIR . 'plugins/trx_addons/trx_addons.styles.php'; }
?>