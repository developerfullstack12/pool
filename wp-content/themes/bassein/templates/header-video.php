<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.14
 */
$bassein_header_video = bassein_get_header_video();
$bassein_embed_video = '';
if (!empty($bassein_header_video) && !bassein_is_from_uploads($bassein_header_video)) {
	if (bassein_is_youtube_url($bassein_header_video) && preg_match('/[=\/]([^=\/]*)$/', $bassein_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$bassein_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($bassein_header_video) . '[/embed]' ));
			$bassein_embed_video = bassein_make_video_autoplay($bassein_embed_video);
		} else {
			$bassein_header_video = str_replace('/watch?v=', '/embed/', $bassein_header_video);
			$bassein_header_video = bassein_add_to_url($bassein_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$bassein_embed_video = '<iframe src="' . esc_url($bassein_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php bassein_show_layout($bassein_embed_video); ?></div><?php
	}
}
?>