<?php
function wb_load_resources() {
    // Optimization technique called conditional CSS loading
    if(is_single()) {
        wp_enqueue_style( 'single', get_template_directory_uri() . "/assets/css/single.css" );
    }
    if(is_single() || is_page() && (comments_open() || get_comments_number())) {
        wp_enqueue_style( 'comments', get_template_directory_uri() . "/assets/css/comments.css" );
    }
    if(is_page(array('sustainability', 'sustainability-deutsch'))) {
        wp_enqueue_style( 'initiatives', get_template_directory_uri() . "/assets/css/initiatives.css" );
        wp_enqueue_style( 'keys', get_template_directory_uri() . "/assets/css/keys.css" );
    }
    wp_enqueue_style( 'style', get_template_directory_uri() . "/assets/css/style.css" );
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, true );
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/fjs8eoq.css' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true );
}

add_action( 'wp_enqueue_scripts', 'wb_load_resources' );



// Change comment form text with Polylang
function wb_custom_comment_form_defaults( $defaults ) {
    $defaults['title_reply']  = pll__( 'Leave a comment' );  
    $defaults['label_submit'] = pll__( 'Comment' ); 
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
    pll_register_string('address', 'Address', 'Footer');
    pll_register_string('opening_hours', 'Opening Hours', 'Footer');
    pll_register_string('our_blogs', 'Our blogs', 'Articles');
    pll_register_string('read_article', 'Read article', 'Articles');
    pll_register_string('comments_closed', 'Comments are closed', 'Comments');
    pll_register_string('comments', 'Comments', 'Comments');
    pll_register_string('see_all_comments', 'See all comments', 'Comments');
    pll_register_string('related_posts', 'Related Posts', 'Single Post');
    pll_register_string('leave_a_comment', 'Leave a comment', 'Comments');
    pll_register_string('comment_submit', 'Comment', 'Comments');
    pll_register_string('contact_form', 'Contact Form', 'Forms');
    pll_register_string('payments', 'Payment', 'Footer');

}

add_action('init', 'wb_register_strings');


//survey form submission for Facebook

function wb_save_survey_response_handler() {
	//fetch the input fields
	$fb_group_interest = $_REQUEST["fb_group_interest"];
	$fb_usage = $_REQUEST["fb_usage"]; 
	$fb_expectations = $_REQUEST["fb_expectations"];

    // Creating a unique title with date and time
    $title = "Survey Response - " . date('Y-m-d H:i:s');

	// Create the survey response post
	$response = wp_insert_post(array(
		"post_type" => "survey-response",
		"post_status" => "publish",
		"post_title" => $title
	));

	// Store the values in SCF fields
	update_field("fb_group_interest", $fb_group_interest, $response);
	update_field("fb_usage", $fb_usage, $response);
	update_field("fb_expectations", $fb_expectations, $response);

	// Redirect to thank you page
	wp_redirect(add_query_arg('survey_submitted', '1', $_SERVER["HTTP_REFERER"]));
    //add a query parameter to indicate submission; this will be used to show the alert message
	exit;
}

add_action("admin_post_save_survey_response", "wb_save_survey_response_handler");
add_action("admin_post_nopriv_save_survey_response", "wb_save_survey_response_handler");



// Custom pagination function for SEO purposes
function wb_pagination_seo() {
    if (is_home() || is_category() || is_tag() || is_archive()) {
        global $wp_query;
        $current = max(1, get_query_var('paged'));
        $total = $wp_query->max_num_pages;
        
        if ($total > 1) {
            // Canonical URL
            echo '<link rel="canonical" href="' . get_pagenum_link($current) . '">' . "\n";
            
            // Previous page
            if ($current > 1) {
                echo '<link rel="prev" href="' . get_pagenum_link($current - 1) . '">' . "\n";
            }
            
            // Next page
            if ($current < $total) {
                echo '<link rel="next" href="' . get_pagenum_link($current + 1) . '">' . "\n";
            }
        }
    }
}
add_action('wp_head', 'wb_pagination_seo');
