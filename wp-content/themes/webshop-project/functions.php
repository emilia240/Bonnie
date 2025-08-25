<?php
function wb_load_resources() {
    wp_enqueue_style( 'style', get_template_directory_uri() . "/style.css" );
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );