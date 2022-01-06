<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

$bassein_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$bassein_post_format = get_post_format();
$bassein_post_format = empty($bassein_post_format) ? 'standard' : str_replace('post-format-', '', $bassein_post_format);
$bassein_animation = bassein_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($bassein_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($bassein_post_format) ); ?>
	<?php echo (!bassein_is_off($bassein_animation) ? ' data-animation="'.esc_attr(bassein_get_animation_classes($bassein_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	bassein_show_post_featured(array(
		'thumb_size' => bassein_get_thumb_size($bassein_columns==1 ? 'big' : ($bassein_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($bassein_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(), 'sticky', $bassein_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>