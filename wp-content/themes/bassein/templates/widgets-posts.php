<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_post_id    = get_the_ID();
$bassein_post_date  = bassein_get_date();
$bassein_post_title = get_the_title();
$bassein_post_link  = get_permalink();
$bassein_post_author_id   = get_the_author_meta('ID');
$bassein_post_author_name = get_the_author_meta('display_name');
$bassein_post_author_url  = get_author_posts_url($bassein_post_author_id, '');

$bassein_args = get_query_var('bassein_args_widgets_posts');
$bassein_show_date = isset($bassein_args['show_date']) ? (int) $bassein_args['show_date'] : 1;
$bassein_show_image = isset($bassein_args['show_image']) ? (int) $bassein_args['show_image'] : 1;
$bassein_show_author = isset($bassein_args['show_author']) ? (int) $bassein_args['show_author'] : 1;
$bassein_show_counters = isset($bassein_args['show_counters']) ? (int) $bassein_args['show_counters'] : 1;
$bassein_show_categories = isset($bassein_args['show_categories']) ? (int) $bassein_args['show_categories'] : 1;

$bassein_output = bassein_storage_get('bassein_output_widgets_posts');

$bassein_post_counters_output = '';
if ( $bassein_show_counters ) {
	$bassein_post_counters_output = '<span class="post_info_item post_info_counters">'
								. bassein_get_post_counters('comments')
							. '</span>';
}


$bassein_output .= '<article class="post_item with_thumb">';

if ($bassein_show_image) {
	$bassein_post_thumb = get_the_post_thumbnail($bassein_post_id, bassein_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($bassein_post_thumb) $bassein_output .= '<div class="post_thumb">' . ($bassein_post_link ? '<a href="' . esc_url($bassein_post_link) . '">' : '') . ($bassein_post_thumb) . ($bassein_post_link ? '</a>' : '') . '</div>';
}

$bassein_output .= '<div class="post_content">'
			. ($bassein_show_categories 
					? '<div class="post_categories">'
						. bassein_get_post_categories()
						. $bassein_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($bassein_post_link ? '<a href="' . esc_url($bassein_post_link) . '">' : '') . ($bassein_post_title) . ($bassein_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('bassein_filter_get_post_info', 
								'<div class="post_info">'
									. ($bassein_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($bassein_post_link ? '<a href="' . esc_url($bassein_post_link) . '" class="post_info_date">' : '') 
											. esc_html($bassein_post_date) 
											. ($bassein_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($bassein_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'bassein') . ' ' 
											. ($bassein_post_link ? '<a href="' . esc_url($bassein_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($bassein_post_author_name) 
											. ($bassein_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$bassein_show_categories && $bassein_post_counters_output
										? $bassein_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
bassein_storage_set('bassein_output_widgets_posts', $bassein_output);
?>