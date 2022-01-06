<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($bassein_columns).' post_format_'.esc_attr($bassein_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$bassein_image_hover = bassein_get_theme_option('image_hover');
	// Featured image
	bassein_show_post_featured(array(
		'thumb_size' => bassein_get_thumb_size(strpos(bassein_get_theme_option('body_style'), 'full')!==false || $bassein_columns < 4 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $bassein_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $bassein_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>