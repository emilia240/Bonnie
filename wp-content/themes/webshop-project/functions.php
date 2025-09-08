<?php
function wb_load_resources() {
    wp_enqueue_style( 'style', get_template_directory_uri() . "/assets/css/style.css" );
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, true );
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/fjs8eoq.css' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true );
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );



// Change comment form text
function wb_custom_comment_form_defaults( $defaults ) {
    $defaults['title_reply'] = 'Leave a comment';  
    $defaults['label_submit'] = 'Comment'; 
    return $defaults;
}
add_filter( 'comment_form_defaults', 'wb_custom_comment_form_defaults' );


//hardcode header anf footer translation
function wb_register_strings() {
    pll_register_string('logo', 'TERRAQUA', 'Header');
    pll_register_string('reorder', 'Reorder', 'Header');
    pll_register_string('favorites', 'Favorites', 'Header');
    pll_register_string('sustainability', 'Sustainability', 'Header');
    pll_register_string('contact us', 'Contact us', 'Header');
    pll_register_string('login', 'Login', 'Header');
    pll_register_string('basket', 'Basket', 'Header');
    pll_register_string('search', 'Search', 'Header');
    pll_register_string('pets', 'Pets', 'Header');
    pll_register_string('food_supplies', 'Food & supplies', 'Header');
    pll_register_string('terrariums', 'Terrariums', 'Header');
    pll_register_string('offers', 'Offers', 'Header');
    pll_register_string('blog', 'Blog', 'Header');
    pll_register_string('frontpage', 'Frontpage', 'Footer');
    pll_register_string('blog', 'Blog', 'Footer');
    pll_register_string('contact_us', 'Contact us', 'Footer');
    pll_register_string('privacy_policy', 'Privacy and Policy', 'Footer');
    pll_register_string('shipping_methods', 'Shipping methods', 'Footer');
    pll_register_string('faq', 'FAQ', 'Footer');
}
add_action('init', 'wb_register_strings');