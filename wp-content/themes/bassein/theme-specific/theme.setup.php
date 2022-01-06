<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.22
 */

if (!defined("BASSEIN_THEME_FREE")) define("BASSEIN_THEME_FREE", false);
if (!defined("BASSEIN_THEME_FREE_WP")) define("BASSEIN_THEME_FREE_WP", false);

// Theme storage
$BASSEIN_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'bassein'),

			
			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'contact-form-7'				=> esc_html__('Contact Form 7', 'bassein'),
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'bassein')
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		BASSEIN_THEME_FREE ? array() : array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'essential-grid'			=> esc_html__('Essential Grid', 'bassein'),
					'revslider'					=> esc_html__('Revolution Slider', 'bassein'),
					'js_composer'				=> esc_html__('Visual Composer', 'bassein'),
				)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'	=> 'http://bassein.themerex.net',
	'theme_doc_url'		=> 'http://bassein.themerex.net/doc',

	'theme_support_url'	=> 'http://themerex.ticksy.com',

	'theme_video_url' => 'https://www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',
	'theme_download_url' => 'https://themeforest.net/user/themerex/portfolio'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('bassein_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'bassein_customizer_theme_setup1', 1 );
	function bassein_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		bassein_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false		// Allow upload not pre-packaged plugins via TGMPA
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		bassein_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Merriweather Sans',
				'family' => 'sans-serif',
				'styles' => '300,400,700,800'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Fjalla One',
				'family' => 'sans-serif',
				'styles' => '400'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'   => 'Butler',
				'family' => 'serif'
			)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		bassein_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		bassein_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'bassein'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'bassein'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '2.15em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.35em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'bassein'),
				'font-family'		=> '"Butler",serif',
				'font-size' 		=> '4.67em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '0.965em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'bassein'),
				'font-family'		=> '"Butler",serif',
				'font-size' 		=> '3.67em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.32em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.39em',
				'margin-bottom'		=> '0.955em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'bassein'),
				'font-family'		=> '"Butler",serif',
				'font-size' 		=> '2.8em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.32em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.4em',
				'margin-bottom'		=> '0.88em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'bassein'),
				'font-family'		=> '"Butler",serif',
				'font-size' 		=> '2.4em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.31em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.68em',
				'margin-bottom'		=> '0.56em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '1.47em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.32em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2.2px',
				'margin-top'		=> '2.05em',
				'margin-bottom'		=> '2em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '1.07em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.97px',
				'margin-top'		=> '2.85em',
				'margin-bottom'		=> '1.55em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'bassein'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'bassein'),
				'font-family'		=> '"Butler",serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.4px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'bassein'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'bassein'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',	// Attention! Firefox don't allow line-height less then 1.5em in the select
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'bassein'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'bassein'),
				'description'		=> esc_html__('Font settings of the main menu items', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'bassein'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'bassein'),
				'font-family'		=> '"Fjalla One",sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.18em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		bassein_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'bassein'),
							'description'	=> __('Colors of the main content area', 'bassein')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'bassein'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'bassein')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'bassein'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'bassein')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'bassein'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'bassein')
							),
			'input'	=> array(
							'title'			=> __('Input', 'bassein'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'bassein')
							),
			)
		);
		bassein_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'bassein'),
							'description'	=> __('Background color of this block in the normal state', 'bassein')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'bassein'),
							'description'	=> __('Background color of this block in the hovered state', 'bassein')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'bassein'),
							'description'	=> __('Border color of this block in the normal state', 'bassein')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'bassein'),
							'description'	=> __('Border color of this block in the hovered state', 'bassein')
							),
			'text'		=> array(
							'title'			=> __('Text', 'bassein'),
							'description'	=> __('Color of the plain text inside this block', 'bassein')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'bassein'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'bassein')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'bassein'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'bassein')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'bassein'),
							'description'	=> __('Color of the links inside this block', 'bassein')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'bassein'),
							'description'	=> __('Color of the hovered state of links inside this block', 'bassein')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'bassein'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'bassein')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'bassein'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'bassein')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'bassein'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'bassein')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'bassein'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'bassein')
							)
			)
		);
		bassein_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'bassein'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',//+
					'bd_color'			=> '#efefef',//+
		
					// Text and links colors
					'text'				=> '#2a2d32',//+
					'text_light'		=> '#cacaca',//+
					'text_dark'			=> '#000000',//+
					'text_link'			=> '#bfc943',//+
					'text_hover'		=> '#25b4cf',//+
					'text_link2'		=> '#25b4cf',//+
					'text_hover2'		=> '#bfc943',//+
					'text_link3'		=> '#1a1e23',//+
					'text_hover3'		=> '#25b4cf',//+
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#191d22',//+
					'alter_bg_hover'	=> '#eeeeee',//+
					'alter_bd_color'	=> '#e6e6e6',//+
					'alter_bd_hover'	=> '#f7f7f7',//+
					'alter_text'		=> '#2a2d32',//+
					'alter_light'		=> '#cacaca',//+
					'alter_dark'		=> '#000000',//+
					'alter_link'		=> '#25b4cf',//+
					'alter_hover'		=> '#bfc943',//+
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',//+
					'extra_bg_hover'	=> '#ffffff',//+
					'extra_bd_color'	=> '#343434',//+
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#898989',//+
					'extra_light'		=> '#afafaf',//+
					'extra_dark'		=> '#ffffff',//+
					'extra_link'		=> '#bfc943',//+
					'extra_hover'		=> '#706f73',//+
					'extra_link2'		=> '#bdbdbd',//+
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#e6e6e6',//+
					'input_bg_hover'	=> '#ffffff',//+
					'input_bd_color'	=> '#e6e6e6',//+
					'input_bd_hover'	=> '#e6e6e6',//+
					'input_text'		=> '#2a2d32',//+
					'input_light'		=> '#a7a7a7',
					'input_dark'		=> '#000000',//+
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',//+
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#1d1d1d',//+
					'inverse_link'		=> '#ffffff',//+
					'inverse_hover'		=> '#ffffff' //+
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'bassein'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0b0c0e',//+
					'bd_color'			=> '#2e2d32',//+
		
					// Text and links colors
					'text'				=> '#c0bfc1',//+
					'text_light'		=> '#717074',//+
					'text_dark'			=> '#ffffff',//+
					'text_link'			=> '#bfc943',//+
					'text_hover'		=> '#25b4cf',//+
					'text_link2'		=> '#25b4cf',//+
					'text_hover2'		=> '#bfc943',//+
					'text_link3'		=> '#1a1e23',//+
					'text_hover3'		=> '#25b4cf',//+

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#191d22',//+
					'alter_bg_hover'	=> '#1d2228',//+
					'alter_bd_color'	=> '#2d2c31',//+
					'alter_bd_hover'	=> '#4a4a4a',
					'alter_text'		=> '#c0bfc1',//+
					'alter_light'		=> '#908f94',//+
					'alter_dark'		=> '#ffffff',//+
					'alter_link'		=> '#bec846',//+
					'alter_hover'		=> '#25b3ce',//+
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#ffffff',//+
					'extra_bg_hover'	=> '#1a1e23',//+
					'extra_bd_color'	=> '#efefef',//+
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#333333',//+
					'extra_light'		=> '#b7b7b7',//+
					'extra_dark'		=> '#2e2d32',//+
					'extra_link'		=> '#25b3ce',//+
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#939393',//+
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff',//+
					'input_bg_hover'	=> '#ffffff',//+
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#bfc943',//+
					'input_text'		=> '#c0bfc1',//+
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#000000',//+
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',//+
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#1d1d1d',//+
					'inverse_link'		=> '#ffffff',//+
					'inverse_hover'		=> '#ffffff' //+
				)
			)
		
		));
		
		// Simple schemes substitution
		bassein_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		bassein_storage_set('scheme_colors_add', array(
			'bg_color_0'		=> array('color' => 'bg_color',			'alpha' => 0),
			'bg_color_02'		=> array('color' => 'bg_color',			'alpha' => 0.2),
			'bg_color_07'		=> array('color' => 'bg_color',			'alpha' => 0.7),
			'bg_color_08'		=> array('color' => 'bg_color',			'alpha' => 0.8),
			'bg_color_09'		=> array('color' => 'bg_color',			'alpha' =>  0.9),
			'alter_bg_color_07'	=> array('color' => 'alter_bg_color',	'alpha' => 0.7),
			'alter_bg_color_04'	=> array('color' => 'alter_bg_color',	'alpha' => 0.4),
			'alter_bg_color_02'	=> array('color' => 'alter_bg_color',	'alpha' => 0.2),
			'alter_bd_color_02'	=> array('color' => 'alter_bd_color',	'alpha' => 0.2),
			'extra_bg_color_07'	=> array('color' => 'extra_bg_color',	'alpha' => 0.7),
			'extra_bd_color_09'	=> array('color' => 'extra_bd_color',	'alpha' => 0.9),
			'text_dark_07'		=> array('color' => 'text_dark',		'alpha' => 0.7),
			'text_dark_03'		=> array('color' => 'text_dark',		'alpha' => 0.3),
			'inverse_link_05'		=> array('color' => 'inverse_link',		'alpha' => 0.5),
			'text_link_02'		=> array('color' => 'text_link',		'alpha' => 0.2),
			'text_link_07'		=> array('color' => 'text_link',		'alpha' => 0.7),
			'text_link_blend'	=> array('color' => 'text_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5),
			'alter_link_blend'	=> array('color' => 'alter_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		bassein_storage_set('theme_thumbs', apply_filters('bassein_filter_add_thumb_sizes', array(
			'bassein-thumb-huge'		=> array(
												'size'	=> array(1170, 653, true),
												'title' => esc_html__( 'Huge image', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-huge'
												),
			'bassein-thumb-big' 		=> array(
												'size'	=> array( 760, 428, true),
												'title' => esc_html__( 'Large image', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-big'
												),
			'bassein-thumb-big-avatar' 		=> array(
												'size'	=> array( 760, 760, true),
												'title' => esc_html__( 'Large avatar image', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-big-avatar'
			),

			'bassein-thumb-med' 		=> array(
												'size'	=> array( 370, 208, true),
												'title' => esc_html__( 'Medium image', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-medium'
												),

			'bassein-thumb-tiny' 		=> array(
												'size'	=> array(  90,  90, true),
												'title' => esc_html__( 'Small square avatar', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-tiny'
												),

			'bassein-thumb-masonry-big' => array(
												'size'	=> array( 760,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry Large (scaled)', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-masonry-big'
												),

			'bassein-thumb-masonry'		=> array(
												'size'	=> array( 370,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry (scaled)', 'bassein' ),
												'subst'	=> 'trx_addons-thumb-masonry'
												)
			))
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'bassein_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'bassein_importer_set_options', 9 );
	function bassein_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(bassein_get_protocol() . '://demofiles.themerex.net/bassein/');
			// Required plugins
			$options['required_plugins'] = array_keys(bassein_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('BASSEIN Demo', 'bassein');
			$options['files']['default']['domain_dev'] = esc_url(bassein_get_protocol().'://bassein.themerex.net.dnw');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(bassein_get_protocol().'://bassein.themerex.net');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'bassein');
			// Banners
			$options['banners'] = array(
				array(
					'image' => bassein_get_file_url('theme-specific/theme.about/images/frontpage.png'),
					'title' => esc_html__('Front page Builder', 'bassein'),
					'content' => wp_kses_post(__('Create your Frontpage right in WordPress Customizer! To do this, you will not need neither the Visual Composer nor any other Builder. Just turn on/off sections, and fill them with content and decorate to your liking', 'bassein')),
					'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
					'link_caption' => esc_html__('More about Frontpage Builder', 'bassein'),
					'duration' => 20
					),
				array(
					'image' => bassein_get_file_url('theme-specific/theme.about/images/layouts.png'),
					'title' => esc_html__('Custom layouts', 'bassein'),
					'content' => wp_kses_post(__('Forget about problems with customization of header or footer! You can edit any of layout without any changes in CSS or HTML, directly in Visual Builder. Moreover - you can easily create your own headers and footers and use them along with built-in', 'bassein')),
					'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
					'link_caption' => esc_html__('More about Custom Layouts', 'bassein'),
					'duration' => 20
					),
				array(
					'image' => bassein_get_file_url('theme-specific/theme.about/images/documentation.png'),
					'title' => esc_html__('Read full documentation', 'bassein'),
					'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use BASSEIN', 'bassein')),
					'link_url' => esc_url(bassein_storage_get('theme_doc_url')),
					'link_caption' => esc_html__('Online documentation', 'bassein'),
					'duration' => 15
					),
				array(
					'image' => bassein_get_file_url('theme-specific/theme.about/images/video-tutorials.png'),
					'title' => esc_html__('Video tutorials', 'bassein'),
					'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize BASSEIN in detail.', 'bassein')),
					'link_url' => esc_url(bassein_storage_get('theme_video_url')),
					'link_caption' => esc_html__('Video tutorials', 'bassein'),
					'duration' => 15
					),
				array(
					'image' => bassein_get_file_url('theme-specific/theme.about/images/studio.png'),
					'title' => esc_html__('Mockingbird Website Custom studio', 'bassein'),
					'content' => wp_kses_post(__('We can make a website based on this theme for a very fair price.
We can implement any extra functional: translate your website, WPML implementation and many other customization according to your request.', 'bassein')),
					'link_url' => esc_url('//mockingbird.ticksy.com/'),
					'link_caption' => esc_html__('Contact us', 'bassein'),
					'duration' => 25
					)
				);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('bassein_create_theme_options')) {

	function bassein_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'bassein');

		bassein_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'bassein'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'bassein'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'bassein'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'bassein') ),
				"class" => "bassein_column-1_2 bassein_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'bassein'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'bassein') ),
				"class" => "bassein_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_max_height' => array(
				"title" => esc_html__('Logo max. height', 'bassein'),
				"desc" => wp_kses_data( __("Max. height of the logo image (in pixels). Maximum size of logo depends on the actual size of the picture", 'bassein') ),
				"std" => 80,
				"min" => 20,
				"max" => 160,
				"step" => 1,
				"refresh" => false,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'bassein') ),
				"class" => "bassein_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'bassein') ),
				"class" => "bassein_column-1_2 bassein_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'bassein') ),
				"class" => "bassein_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'bassein') ),
				"class" => "bassein_column-1_2 bassein_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'bassein') ),
				"class" => "bassein_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'bassein'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'bassein'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'bassein'),
				"desc" => wp_kses_data( __('Select width of the body content', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'bassein')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => bassein_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'bassein') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'bassein')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'bassein'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'bassein')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'bassein'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'bassein'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'bassein'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'bassein'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'bassein') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'bassein'),
				"desc" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'bassein'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'bassein'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'bassein'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'bassein'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'bassein')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
				),



			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'bassein'),
				"desc" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'bassein'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'bassein') ),
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'bassein'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'bassein'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'bassein'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => 'default',
				"options" => bassein_get_list_header_footer_types(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'bassein'),
				"desc" => wp_kses_post( __("Select custom header from Layouts Builder", 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => BASSEIN_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'bassein'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => 'default',
				"options" => array(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'bassein'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'bassein'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'bassein') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'bassein'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'bassein'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'bassein') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'bassein'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'bassein') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'bassein'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => bassein_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'bassein'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'bassein') ),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'bassein'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'bassein')
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'bassein'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'bassein'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'bassein')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'bassein'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'bassein') ),
				"std" => 1,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'bassein'),
				"desc" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'bassein'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'bassein') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'bassein'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'bassein') ),
				"priority" => 500,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'bassein'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'bassein') ),
				"std" => 0,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'bassein'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'bassein') ),
				"std" => '',
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'bassein'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'bassein'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'bassein'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'bassein'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'bassein'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'bassein'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'bassein'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'bassein')
				),
				"std" => 'default',
				"options" => bassein_get_list_header_footer_types(),
				"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'bassein'),
				"desc" => wp_kses_post( __("Select custom footer from Layouts Builder", 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'bassein')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => BASSEIN_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'bassein'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'bassein')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'bassein'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'bassein')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => bassein_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'bassein'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'bassein') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'bassein')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'bassein'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'bassein') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'bassein') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'bassein') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'bassein'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'bassein') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'bassein'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'bassein') ),
				"std" => esc_html__('Copyright &copy; {Y} by ThemeRex. All rights reserved.', 'bassein'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'bassein'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'bassein') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'bassein'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'bassein') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'bassein'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'bassein'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'bassein'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'bassein'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'bassein') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'bassein'),
						'fullpost'	=> esc_html__('Full post',	'bassein')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'bassein'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'bassein') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'bassein'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'bassein') ),
					"std" => 2,
					"options" => bassein_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'bassein'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'bassein'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'bassein'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'bassein'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"std" => "pages",
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'bassein'),
						'links'	=> esc_html__("Older/Newest", 'bassein'),
						'more'	=> esc_html__("Load more", 'bassein'),
						'infinite' => esc_html__("Infinite scroll", 'bassein')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'bassein'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'bassein'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'bassein'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'bassein') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'bassein'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'bassein') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'bassein'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'bassein') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'bassein'),
					"desc" => '',
					"type" => BASSEIN_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'bassein'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'bassein') ),
					"std" => 'hide',
					"options" => array(),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'bassein'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'bassein') ),
					"std" => 'hide',
					"options" => array(),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'bassein'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'bassein') ),
					"std" => 'hide',
					"options" => array(),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'bassein'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'bassein') ),
					"std" => 'hide',
					"options" => array(),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'bassein'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'bassein'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'bassein') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'bassein'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'bassein') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'bassein'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'bassein') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'bassein'),
						'columns' => esc_html__('Mini-cards',	'bassein')
					),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'bassein'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'bassein'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'bassein') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=0|author=1|counters=1|date=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'bassein'),
						'date'		 => esc_html__('Post date', 'bassein'),
						'author'	 => esc_html__('Post author', 'bassein'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'bassein'),
						'share'		 => esc_html__('Share links', 'bassein'),
						'edit'		 => esc_html__('Edit link', 'bassein')
					),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'bassein'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'bassein') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'bassein')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'bassein'),
						'likes' => esc_html__('Likes', 'bassein'),
						'comments' => esc_html__('Comments', 'bassein')
					),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'bassein'),
					"desc" => wp_kses_data( __('Settings of the single post', 'bassein') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'bassein'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'bassein') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'bassein')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'bassein'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'bassein') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'bassein'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'bassein') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'bassein'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'bassein') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'bassein'),
						'date'		 => esc_html__('Post date', 'bassein'),
						'author'	 => esc_html__('Post author', 'bassein'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'bassein'),
						'share'		 => esc_html__('Share links', 'bassein'),
						'edit'		 => esc_html__('Edit link', 'bassein')
					),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'bassein'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'bassein') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'bassein'),
						'likes' => esc_html__('Likes', 'bassein'),
						'comments' => esc_html__('Comments', 'bassein')
					),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'bassein'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'bassein') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'bassein'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'bassein') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'bassein'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'bassein'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'bassein') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'bassein')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'bassein'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'bassein') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => bassein_get_list_range(1,9),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'bassein'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'bassein') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => bassein_get_list_range(1,4),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'bassein'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'bassein') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => bassein_get_list_styles(1,2),
					"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'bassein'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'bassein'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'bassein') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'bassein'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'bassein')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'bassein'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'bassein')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'bassein'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'bassein')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'bassein'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'bassein')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'bassein'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'bassein')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'bassein'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'bassein') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'bassein'),
				"desc" => '',
				"std" => '$bassein_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'bassein'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'bassein') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'bassein')
				),
				"hidden" => true,
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'bassein'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'bassein') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'bassein')
				),
				"hidden" => true,
				"std" => '',
				"type" => BASSEIN_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'bassein'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'bassein'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'bassein') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'bassein') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'bassein'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'bassein') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'bassein') ),
				"class" => "bassein_column-1_3 bassein_new_row",
				"refresh" => false,
				"std" => '$bassein_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=bassein_get_theme_setting('max_load_fonts'); $i++) {
			if (bassein_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'bassein'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'bassein'),
				"desc" => '',
				"class" => "bassein_column-1_3 bassein_new_row",
				"refresh" => false,
				"std" => '$bassein_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'bassein'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'bassein') )
							: '',
				"class" => "bassein_column-1_3",
				"refresh" => false,
				"std" => '$bassein_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'bassein'),
					'serif' => esc_html__('serif', 'bassein'),
					'sans-serif' => esc_html__('sans-serif', 'bassein'),
					'monospace' => esc_html__('monospace', 'bassein'),
					'cursive' => esc_html__('cursive', 'bassein'),
					'fantasy' => esc_html__('fantasy', 'bassein')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'bassein'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'bassein') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'bassein') )
							: '',
				"class" => "bassein_column-1_3",
				"refresh" => false,
				"std" => '$bassein_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = bassein_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'bassein'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'bassein'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'bassein'),
						'100' => esc_html__('100 (Light)', 'bassein'), 
						'200' => esc_html__('200 (Light)', 'bassein'), 
						'300' => esc_html__('300 (Thin)',  'bassein'),
						'400' => esc_html__('400 (Normal)', 'bassein'),
						'500' => esc_html__('500 (Semibold)', 'bassein'),
						'600' => esc_html__('600 (Semibold)', 'bassein'),
						'700' => esc_html__('700 (Bold)', 'bassein'),
						'800' => esc_html__('800 (Black)', 'bassein'),
						'900' => esc_html__('900 (Black)', 'bassein')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'bassein'),
						'normal' => esc_html__('Normal', 'bassein'), 
						'italic' => esc_html__('Italic', 'bassein')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'bassein'),
						'none' => esc_html__('None', 'bassein'), 
						'underline' => esc_html__('Underline', 'bassein'),
						'overline' => esc_html__('Overline', 'bassein'),
						'line-through' => esc_html__('Line-through', 'bassein')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'bassein'),
						'none' => esc_html__('None', 'bassein'), 
						'uppercase' => esc_html__('Uppercase', 'bassein'),
						'lowercase' => esc_html__('Lowercase', 'bassein'),
						'capitalize' => esc_html__('Capitalize', 'bassein')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "bassein_column-1_5",
					"refresh" => false,
					"std" => '$bassein_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		bassein_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			bassein_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'bassein'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'bassein') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'bassein')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			bassein_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'bassein'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'bassein') ),
				"class" => "bassein_column-1_2 bassein_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('bassein_options_get_list_cpt_options')) {
	function bassein_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'bassein'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'bassein') ),
						"std" => 'inherit',
						"options" => bassein_get_list_header_footer_types(true),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'bassein'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'bassein'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'bassein'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'bassein'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'bassein'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'bassein') ),
						"std" => 0,
						"type" => BASSEIN_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'bassein'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'bassein'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'bassein'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'bassein'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'bassein'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'bassein'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'bassein'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'bassein') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'bassein'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'bassein'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'bassein') ),
						"std" => 'inherit',
						"options" => bassein_get_list_header_footer_types(true),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'bassein'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'bassein') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'bassein'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'bassein') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'bassein'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'bassein') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => bassein_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'bassein'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'bassein') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'bassein'),
						"desc" => '',
						"type" => BASSEIN_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'bassein'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'bassein') ),
						"std" => 'hide',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'bassein'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'bassein') ),
						"std" => 'hide',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'bassein'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'bassein') ),
						"std" => 'hide',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'bassein'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'bassein') ),
						"std" => 'hide',
						"options" => array(),
						"type" => BASSEIN_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('bassein_options_get_list_choises')) {
	add_filter('bassein_filter_options_get_list_choises', 'bassein_options_get_list_choises', 10, 2);
	function bassein_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = bassein_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = bassein_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = bassein_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = bassein_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = bassein_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = bassein_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = bassein_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = bassein_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = bassein_array_merge(array(0 => esc_html__('- Select category -', 'bassein')), bassein_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = bassein_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = bassein_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = bassein_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>