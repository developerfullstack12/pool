<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('bassein_mailchimp_get_css')) {
	add_filter('bassein_filter_get_css', 'bassein_mailchimp_get_css', 10, 4);
	function bassein_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
form.mc4wp-form .mc4wp-form-fields input[type="email"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
CSS;
		
			
			$rad = bassein_get_border_radius();
			$css['fonts'] .= <<<CSS

form.mc4wp-form .mc4wp-form-fields input[type="email"],
form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

form.mc4wp-form input[type="email"] {
	background-color: {$colors['input_bg_color']};
	border-color: {$colors['input_bg_color']};
	color: {$colors['extra_text']};
}
form.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.mc4wp-form-fields .mc4wp-span-button:before{
	color: {$colors['text_link']};
}
.mc4wp-form-fields .mc4wp-span-button:hover:before{
	color: {$colors['text_hover']};
}
CSS;
		}

		return $css;
	}
}
?>