<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

bassein_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	bassein_show_layout(get_query_var('blog_archive_start'));

	$bassein_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$bassein_sticky_out = bassein_get_theme_option('sticky_style')=='columns' 
							&& is_array($bassein_stickies) && count($bassein_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($bassein_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$bassein_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($bassein_sticky_out && !is_sticky()) {
			$bassein_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $bassein_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	bassein_show_pagination();

	bassein_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>