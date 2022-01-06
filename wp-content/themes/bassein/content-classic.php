<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_blog_style = explode('_', bassein_get_theme_option('blog_style'));
$bassein_columns = empty($bassein_blog_style[1]) ? 2 : max(2, $bassein_blog_style[1]);
$bassein_expanded = !bassein_sidebar_present() && bassein_is_on(bassein_get_theme_option('expand_content'));
$bassein_post_format = get_post_format();
$bassein_post_format = empty($bassein_post_format) ? 'standard' : str_replace('post-format-', '', $bassein_post_format);
$bassein_animation = bassein_get_theme_option('blog_animation');
$bassein_components = bassein_is_inherit(bassein_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($bassein_columns < 3 ? ',edit' : '')
							: bassein_array_get_keys_by_value(bassein_get_theme_option('meta_parts'));
$bassein_counters = bassein_is_inherit(bassein_get_theme_option_from_meta('counters')) 
							? 'comments'
							: bassein_array_get_keys_by_value(bassein_get_theme_option('counters'));

?><div class="<?php echo $bassein_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($bassein_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($bassein_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($bassein_columns)
					. ' post_layout_'.esc_attr($bassein_blog_style[0]) 
					. ' post_layout_'.esc_attr($bassein_blog_style[0]).'_'.esc_attr($bassein_columns)
					); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	bassein_show_post_featured( array( 'thumb_size' => bassein_get_thumb_size($bassein_blog_style[0] == 'classic'
													? (strpos(bassein_get_theme_option('body_style'), 'full')!==false 
															? ( $bassein_columns < 4 ? 'big' : 'huge' )
															: (	$bassein_columns < 3
																? ($bassein_expanded ? 'med' : 'small')
																: ($bassein_expanded ? 'big' : 'med')
																)
														)
													: (strpos(bassein_get_theme_option('body_style'), 'full')!==false 
															? ( $bassein_columns > 2 ? 'masonry-big' : 'full' )
															: (	$bassein_columns <= 2 && $bassein_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($bassein_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('bassein_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('bassein_action_before_post_meta'); 

			// Post meta
			if (!empty($bassein_components))
				bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
					'components' => $bassein_components,
					'counters' => $bassein_counters,
					'seo' => false
					), $bassein_blog_style[0], $bassein_columns)
				);

			do_action('bassein_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$bassein_show_learn_more = false; //!in_array($bassein_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($bassein_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($bassein_post_format == 'quote') {
				if (($quote = bassein_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					bassein_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($bassein_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($bassein_components))
				bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
					'components' => $bassein_components,
					'counters' => $bassein_counters
					), $bassein_blog_style[0], $bassein_columns)
				);
		}
		// More button
		if ( $bassein_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'bassein'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>