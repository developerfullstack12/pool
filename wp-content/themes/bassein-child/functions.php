<?php
/**
 * Child-Theme functions and definitions
 */
function bassein_child_scripts() {
    wp_enqueue_style( 'bassein-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'bassein_child_scripts' );


?>
