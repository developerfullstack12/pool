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
$bassein_columns = empty($bassein_blog_style[1]) ? 1 : max(1, $bassein_blog_style[1]);
$bassein_expanded = !bassein_sidebar_present() && bassein_is_on(bassein_get_theme_option('expand_content'));
$bassein_post_format = get_post_format();
$bassein_post_format = empty($bassein_post_format) ? 'standard' : str_replace('post-format-', '', $bassein_post_format);
$bassein_animation = bassein_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($bassein_columns).' post_format_'.esc_attr($bassein_post_format) ); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($bassein_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	bassein_show_post_featured( array(
											'class' => $bassein_columns == 1 ? 'bassein-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => bassein_get_thumb_size(
																	strpos(bassein_get_theme_option('body_style'), 'full')!==false
																		? ( $bassein_columns > 1 ? 'huge' : 'original' )
																		: (	$bassein_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('bassein_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('bassein_action_before_post_meta'); 

			// Post meta
			$bassein_components = bassein_is_inherit(bassein_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($bassein_columns < 3 ? ',counters' : '').($bassein_columns == 1 ? ',edit' : '')
										: bassein_array_get_keys_by_value(bassein_get_theme_option('meta_parts'));
			$bassein_counters = bassein_is_inherit(bassein_get_theme_option_from_meta('counters')) 
										? 'comments'
										: bassein_array_get_keys_by_value(bassein_get_theme_option('counters'));
			$bassein_post_meta = empty($bassein_components) 
										? '' 
										: bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
												'components' => $bassein_components,
												'counters' => $bassein_counters,
												'seo' => false,
												'echo' => false
												), $bassein_blog_style[0], $bassein_columns)
											);
			bassein_show_layout($bassein_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$bassein_show_learn_more = !in_array($bassein_post_format, array('link', 'aside', 'status', 'quote'));
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
				bassein_show_layout($bassein_post_meta);
			}
			// More button
			if ( $bassein_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'bassein'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>