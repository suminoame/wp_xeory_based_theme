<?php
/* enqueue script for parent theme stylesheeet */
function childtheme_parent_styles() {
 
 // enqueue style
 wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}

add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles');

/* MUST remove 'bzb-functions.php' from parent's functions.php.  */
require_once( 'lib/functions/bzb-functions.php' );
