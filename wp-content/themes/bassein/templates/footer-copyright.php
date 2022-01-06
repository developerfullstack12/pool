<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0.10
 */

// Copyright area
$bassein_footer_scheme =  bassein_is_inherit(bassein_get_theme_option('footer_scheme')) ? bassein_get_theme_option('color_scheme') : bassein_get_theme_option('footer_scheme');
$bassein_copyright_scheme = bassein_is_inherit(bassein_get_theme_option('copyright_scheme')) ? $bassein_footer_scheme : bassein_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($bassein_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$bassein_copyright = bassein_prepare_macros(bassein_get_theme_option('copyright'));
				if (!empty($bassein_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $bassein_copyright, $bassein_matches)) {
						$bassein_copyright = str_replace($bassein_matches[1], date_i18n(str_replace(array('{', '}'), '', $bassein_matches[1])), $bassein_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($bassein_copyright));
				}
			?></div>
		</div>
	</div>
</div>
