<?php
function wb_load_resources() {
    wp_enqueue_style( 'style', get_template_directory_uri() . "/style.css" );
<<<<<<< HEAD
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, true );
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/fjs8eoq.css' );
=======
>>>>>>> 68bac7a (fixws)
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );

function create_blog_post_type() {
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
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 5,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'blog'),
        'taxonomies' => array('category', 'post_tag'),
    );

    register_post_type('blog', $args);
}
add_action('init', 'create_blog_post_type');
