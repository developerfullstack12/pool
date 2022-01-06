<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$bassein_content = '';
$bassein_blog_archive_mask = '%%CONTENT%%';
$bassein_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $bassein_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($bassein_content = apply_filters('the_content', get_the_content())) != '') {
		if (($bassein_pos = strpos($bassein_content, $bassein_blog_archive_mask)) !== false) {
			$bassein_content = preg_replace('/(\<p\>\s*)?'.$bassein_blog_archive_mask.'(\s*\<\/p\>)/i', $bassein_blog_archive_subst, $bassein_content);
		} else
			$bassein_content .= $bassein_blog_archive_subst;
		$bassein_content = explode($bassein_blog_archive_mask, $bassein_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) bassein_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$bassein_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$bassein_args = bassein_query_add_posts_and_cats($bassein_args, '', bassein_get_theme_option('post_type'), bassein_get_theme_option('parent_cat'));
$bassein_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($bassein_page_number > 1) {
	$bassein_args['paged'] = $bassein_page_number;
	$bassein_args['ignore_sticky_posts'] = true;
}
$bassein_ppp = bassein_get_theme_option('posts_per_page');
if ((int) $bassein_ppp != 0)
	$bassein_args['posts_per_page'] = (int) $bassein_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($bassein_args);


// Add internal query vars in the new query!
if (is_array($bassein_content) && count($bassein_content) == 2) {
	set_query_var('blog_archive_start', $bassein_content[0]);
	set_query_var('blog_archive_end', $bassein_content[1]);
}

get_template_part('index');
?>