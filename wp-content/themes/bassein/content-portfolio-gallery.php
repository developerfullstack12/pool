<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_blog_style = explode('_', bassein_get_theme_option('blog_style'));
$bassein_columns = empty($bassein_blog_style[1]) ? 2 : max(2, $bassein_blog_style[1]);
$bassein_post_format = get_post_format();
$bassein_post_format = empty($bassein_post_format) ? 'standard' : str_replace('post-format-', '', $bassein_post_format);
$bassein_animation = bassein_get_theme_option('blog_animation');
$bassein_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($bassein_columns).' post_format_'.esc_attr($bassein_post_format) ); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($bassein_image[1]) && !empty($bassein_image[2])) echo intval($bassein_image[1]) .'x' . intval($bassein_image[2]); ?>"
	data-src="<?php if (!empty($bassein_image[0])) echo esc_url($bassein_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$bassein_image_hover = 'icon';	//bassein_get_theme_option('image_hover');
	if (in_array($bassein_image_hover, array('icons', 'zoom'))) $bassein_image_hover = 'dots';
	$bassein_components = bassein_is_inherit(bassein_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: bassein_array_get_keys_by_value(bassein_get_theme_option('meta_parts'));
	$bassein_counters = bassein_is_inherit(bassein_get_theme_option_from_meta('counters')) 
								? 'comments'
								: bassein_array_get_keys_by_value(bassein_get_theme_option('counters'));
	bassein_show_post_featured(array(
		'hover' => $bassein_image_hover,
		'thumb_size' => bassein_get_thumb_size( strpos(bassein_get_theme_option('body_style'), 'full')!==false || $bassein_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($bassein_components)
										? bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
											'components' => $bassein_components,
											'counters' => $bassein_counters,
											'seo' => false,
											'echo' => false
											), $bassein_blog_style[0], $bassein_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'bassein') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>