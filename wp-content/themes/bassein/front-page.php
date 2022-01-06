<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (bassein_is_on(bassein_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$bassein_sections = bassein_array_get_keys_by_value(bassein_get_theme_option('front_page_sections'), 1, false);
		if (is_array($bassein_sections)) {
			foreach ($bassein_sections as $bassein_section) {
				get_template_part("front-page/section", $bassein_section);
			}
		}
	
	// Else if this page is blog archive
	} else if (is_page_template('blog.php')) {
		get_template_part('blog');

	// Else - display native page content
	} else {
		get_template_part('page');
	}

// Else get index template to show posts
} else {
	get_template_part('index');
}

get_footer();
?>