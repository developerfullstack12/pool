<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_post_format = get_post_format();
$bassein_post_format = empty($bassein_post_format) ? 'standard' : str_replace('post-format-', '', $bassein_post_format);
$bassein_animation = bassein_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($bassein_post_format) ); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span>
		<div class="post_categories"><?php echo wp_kses_post(bassein_get_post_categories(" "))?></div>
		<?php
	}

	// Featured image
	bassein_show_post_featured(array( 'thumb_size' => bassein_get_thumb_size( strpos(bassein_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ),
		'post_info' => (has_post_thumbnail() && in_array($bassein_post_format, array('standard', 'image'))
			? '<div class="post_info_bottom">'
			. '<div class="post_categories">'.wp_kses_post(bassein_get_post_categories(' ')).'</div>'
			. '</div>'
			: '')
	));



	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('bassein_action_before_post_title');

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('bassein_action_before_post_meta');


			?>
		</div><!-- .post_header --><?php
	}

	// Post content
	?><div class="post_content entry-content "><?php
		if (bassein_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'bassein' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bassein' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$bassein_show_learn_more = !in_array($bassein_post_format, array('link', 'aside', 'status', 'quote'));



			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
		}

		do_action('bassein_action_before_post_meta');



		// Post meta
		$bassein_components = bassein_is_inherit(bassein_get_theme_option_from_meta('meta_parts'))
			? 'categories,date,counters,edit'
			: bassein_array_get_keys_by_value(bassein_get_theme_option('meta_parts'));
		$bassein_counters = bassein_is_inherit(bassein_get_theme_option_from_meta('counters'))
			? 'comments,likes'
			: bassein_array_get_keys_by_value(bassein_get_theme_option('counters'));

		if (!empty($bassein_components)) { ?>
		<div class="components">
			<?php
			bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
					'components' => $bassein_components,
					'counters' => $bassein_counters,
					'seo' => false
				), 'excerpt', 1)
			);
			?>
			</div><?php
		}

		if (!empty($bassein_components) && !empty($bassein_counters))  { ?>
		<div class="counters">
			<?php
			bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
					'components' => $bassein_components,
					'counters' => $bassein_counters,
					'seo' => false
				), 'excerpt', 1)
			);
			?>
			</div><div class="clearfix"></div><?php
		}




	?></div><!-- .entry-content -->
</article>