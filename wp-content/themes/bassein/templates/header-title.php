<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

// Page (category, tag, archive, author) title

if ( bassein_need_page_title() ) {
	bassein_sc_layouts_showed('title', true);
	bassein_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal scheme_dark">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_left">
						<?php

						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$bassein_blog_title = bassein_get_blog_title();
							$bassein_blog_title_text = $bassein_blog_title_class = $bassein_blog_title_link = $bassein_blog_title_link_text = '';
							if (is_array($bassein_blog_title)) {
								$bassein_blog_title_text = $bassein_blog_title['text'];
								$bassein_blog_title_class = !empty($bassein_blog_title['class']) ? ' '.$bassein_blog_title['class'] : '';
								$bassein_blog_title_link = !empty($bassein_blog_title['link']) ? $bassein_blog_title['link'] : '';
								$bassein_blog_title_link_text = !empty($bassein_blog_title['link_text']) ? $bassein_blog_title['link_text'] : '';
							} else
								$bassein_blog_title_text = $bassein_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($bassein_blog_title_class); ?>"><?php
								$bassein_top_icon = bassein_get_category_icon();
								if (!empty($bassein_top_icon)) {
									$bassein_attr = bassein_getimagesize($bassein_top_icon);
									?><img src="<?php echo esc_url($bassein_top_icon); ?>" alt="" <?php if (!empty($bassein_attr[3])) bassein_show_layout($bassein_attr[3]);?>><?php
								}
								echo wp_kses_data($bassein_blog_title_text);
							?></h1>
							<?php
							if (!empty($bassein_blog_title_link) && !empty($bassein_blog_title_link_text)) {
								?><a href="<?php echo esc_url($bassein_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($bassein_blog_title_link_text); ?></a><?php
							}

							// Post meta on the single post
							if ( is_single() )  {
								?><div class="sc_layouts_title_meta"><?php
								bassein_show_post_meta(apply_filters('bassein_filter_post_meta_args', array(
										'components' => 'categories,date,counters,edit',
										'counters' => 'views,comments,likes',
										'seo' => true
									), 'header', 1)
								);
								?></div><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'bassein_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>