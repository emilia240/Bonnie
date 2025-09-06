<?php
function wb_load_resources() {
    wp_enqueue_style( 'style', get_template_directory_uri() . "/assets/css/style.css" );
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, true );
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/fjs8eoq.css' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true );
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );



// Change comment form text
function custom_comment_form_defaults( $defaults ) {
    $defaults['title_reply'] = 'Leave a comment';  
    $defaults['label_submit'] = 'Comment'; 
    return $defaults;
}
add_filter( 'comment_form_defaults', 'custom_comment_form_defaults' );



