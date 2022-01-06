<?php
/**
 * The template for homepage posts with "Portfolio" style
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
	
	// Show filters
	$bassein_cat = bassein_get_theme_option('parent_cat');
	$bassein_post_type = bassein_get_theme_option('post_type');
	$bassein_taxonomy = bassein_get_post_type_taxonomy($bassein_post_type);
	$bassein_show_filters = bassein_get_theme_option('show_filters');
	$bassein_tabs = array();
	if (!bassein_is_off($bassein_show_filters)) {
		$bassein_args = array(
			'type'			=> $bassein_post_type,
			'child_of'		=> $bassein_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $bassein_taxonomy,
			'pad_counts'	=> false
		);
		$bassein_portfolio_list = get_terms($bassein_args);
		if (is_array($bassein_portfolio_list) && count($bassein_portfolio_list) > 0) {
			$bassein_tabs[$bassein_cat] = esc_html__('All', 'bassein');
			foreach ($bassein_portfolio_list as $bassein_term) {
				if (isset($bassein_term->term_id)) $bassein_tabs[$bassein_term->term_id] = $bassein_term->name;
			}
		}
	}
	if (count($bassein_tabs) > 0) {
		$bassein_portfolio_filters_ajax = true;
		$bassein_portfolio_filters_active = $bassein_cat;
		$bassein_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters bassein_tabs bassein_tabs_ajax">
			<ul class="portfolio_titles bassein_tabs_titles">
				<?php
				foreach ($bassein_tabs as $bassein_id=>$bassein_title) {
					?><li><a href="<?php echo esc_url(bassein_get_hash_link(sprintf('#%s_%s_content', $bassein_portfolio_filters_id, $bassein_id))); ?>" data-tab="<?php echo esc_attr($bassein_id); ?>"><?php echo esc_html($bassein_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$bassein_ppp = bassein_get_theme_option('posts_per_page');
			if (bassein_is_inherit($bassein_ppp)) $bassein_ppp = '';
			foreach ($bassein_tabs as $bassein_id=>$bassein_title) {
				$bassein_portfolio_need_content = $bassein_id==$bassein_portfolio_filters_active || !$bassein_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $bassein_portfolio_filters_id, $bassein_id)); ?>"
					class="portfolio_content bassein_tabs_content"
					data-blog-template="<?php echo esc_attr(bassein_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(bassein_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($bassein_ppp); ?>"
					data-post-type="<?php echo esc_attr($bassein_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($bassein_taxonomy); ?>"
					data-cat="<?php echo esc_attr($bassein_id); ?>"
					data-parent-cat="<?php echo esc_attr($bassein_cat); ?>"
					data-need-content="<?php echo (false===$bassein_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($bassein_portfolio_need_content) 
						bassein_show_portfolio_posts(array(
							'cat' => $bassein_id,
							'parent_cat' => $bassein_cat,
							'taxonomy' => $bassein_taxonomy,
							'post_type' => $bassein_post_type,
							'page' => 1,
							'sticky' => $bassein_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		bassein_show_portfolio_posts(array(
			'cat' => $bassein_cat,
			'parent_cat' => $bassein_cat,
			'taxonomy' => $bassein_taxonomy,
			'post_type' => $bassein_post_type,
			'page' => 1,
			'sticky' => $bassein_sticky_out
			)
		);
	}

	bassein_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>