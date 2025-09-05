<?php
function wb_load_resources() {
    wp_enqueue_style( 'style', get_template_directory_uri() . "/assets/css/style.css" );
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, true );
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/fjs8eoq.css' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true );
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );

/* function enqueue_main_js() {
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_main_js' ); */



/* function create_blog_post_type() {
    $labels = array(
        'name' => 'Blog',
        'singular_name' => 'Blog Post',
        'menu_name' => 'Blog',
        'all_items' => 'All Blog Posts',
        'add_new_item' => 'Add New Blog Post',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'menu_position' => 5,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'blog'),
        'taxonomies' => array('category', 'post_tag'),
    );

    register_post_type('blog', $args);
}
add_action('init', 'create_blog_post_type'); */



// Change comment form text
function custom_comment_form_defaults( $defaults ) {
    $defaults['title_reply'] = 'Leave a comment';  
    $defaults['label_submit'] = 'Comment'; 
    return $defaults;
}
add_filter( 'comment_form_defaults', 'custom_comment_form_defaults' );



