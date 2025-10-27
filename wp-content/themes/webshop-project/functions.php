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
    pll_register_string('search_header', 'Search', 'Header');
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
    pll_register_string('prev_page', 'Prev', 'Pagination');
    pll_register_string('next_page', 'Next', 'Pagination');
    pll_register_string('fb_group_question', 'Would you be interested in a private Facebook group for our community?', 'Forms');
    pll_register_string('fb_usage_question', 'If yes, how often do you use Facebook?', 'Forms');
    pll_register_string('fb_expectations', 'What kind of content would you like to see in our group?', 'Forms');
    pll_register_string('fb_expectations_placeholder', 'e.g. care tips, contact with breeders, pet help...', 'Forms');
    pll_register_string('survey_submit', 'Submit', 'Forms');
    pll_register_string('social_media', 'Social Media', 'Footer');
    pll_register_string('facebook', 'Facebook', 'Social Media');
    pll_register_string('instagram', 'Instagram', 'Social Media');
    pll_register_string('tiktok', 'TikTok', 'Social Media');
    pll_register_string('whatsapp', 'WhatsApp', 'Social Media');
    pll_register_string('customer_reviews', 'Customer Reviews', 'Reviews');
    pll_register_string('skip_to_main', 'Skip to main content', 'Accessibility');
    pll_register_string('toggle_mobile_menu', 'Toggle mobile menu', 'Accessibility');
    pll_register_string('search_button', 'Search', 'Accessibility');
    pll_register_string('close_menu', 'Close menu', 'Accessibility');
    pll_register_string('site_search', 'Site search', 'Accessibility');
    pll_register_string('top_navigation', 'Top navigation', 'Accessibility');
    pll_register_string('language_picker', 'Language picker', 'Accessibility');
    pll_register_string('user_account_basket', 'User account and shopping basket', 'Accessibility');
    pll_register_string('mobile_menu', 'Mobile menu', 'Accessibility');
    pll_register_string('main_navigation', 'Main navigation', 'Accessibility');
    pll_register_string('menu', 'Menu', 'Accessibility');
    pll_register_string('footer_navigation', 'Footer navigation', 'Accessibility');
    pll_register_string('store_address', 'Store address', 'Accessibility');
    pll_register_string('store_opening_hours', 'Store opening hours', 'Accessibility');
    pll_register_string('social_media_links', 'Social media links', 'Accessibility');
    pll_register_string('back_to_top', 'Back to top', 'Accessibility');
    pll_register_string('facebook', 'Facebook', 'Accessibility');
    pll_register_string('instagram', 'Instagram', 'Accessibility');
    pll_register_string('tiktok', 'TikTok', 'Accessibility');
    pll_register_string('whatsapp', 'WhatsApp', 'Accessibility');
    pll_register_string('no_results', 'No results found.', 'Search');
    pll_register_string('search_results_for', 'Search results for : ', 'Search');
    pll_register_string('no_tag_posts', 'No posts found with this tag', 'Tags');
    pll_register_string('tag', 'Tag:', 'Tags');
    pll_register_string('no_category_posts', 'No posts found in this category', 'Categories');
    pll_register_string('category', 'Category:', 'Categories');
    pll_register_string('submit_review', 'Submit Your Review', 'Forms');
    pll_register_string('must_login', 'You must be logged in to submit a review.', 'Forms');
    pll_register_string('register_here', 'Register here', 'Forms');
    pll_register_string('login', 'Login', 'Forms');
    pll_register_string('your_name', 'Your Name', 'Forms');
    pll_register_string('your_photo', 'Your Photo', 'Forms');
    pll_register_string('optional', '(Optional)', 'Forms');
    pll_register_string('rating', 'Rating', 'Forms');
    pll_register_string('your_review', 'Your Review', 'Forms');
    pll_register_string('submit_review_btn', 'Submit Review', 'Forms');
    pll_register_string('sale_badge', 'Sale!', 'Homepage');
    pll_register_string('view_product', 'View Product', 'Homepage');
    pll_register_string('no_image', 'No Image', 'Homepage');
    pll_register_string('pets_category', 'Pets', 'Homepage');
    pll_register_string('our_top_sellers', 'Our top sellers', 'Homepage');
    pll_register_string('pets_customers_love', 'Pets that our customers love the most!', 'Homepage');
    pll_register_string('explore_all', 'Explore all', 'Homepage');
    pll_register_string('no_products_found', 'No products found.', 'Homepage');
    pll_register_string('currency_kr', 'kr.', 'Homepage');
}

add_action('init', 'wb_register_strings');


//survey form submission for Facebook

function wb_save_survey_response_handler() {

    //Verify nonce for security
    if (!wp_verify_nonce($_POST['survey_nonce'], 'save_survey_response')) {
        wp_die(__('Security check failed.'), __('Security Error'), array('response' => 403));
    }


	//fetch the input fields
	$fb_group_interest = sanitize_text_filed($_REQUEST["fb_group_interest"]);
	$fb_usage = sanitize_text_filed($_REQUEST["fb_usage"]); 
	$fb_expectations = sanitize_textarea_filed($_REQUEST["fb_expectations"]);

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


// Change comment form fields order
add_filter('comment_form_fields', function($fields) {
    if (isset($fields['comment'])) {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        // Add comment field at the end
        $fields['comment'] = $comment_field;
    }
    return $fields;
});


// review form submission
add_action('admin_post_submit_review', 'handle_review_submission');
add_action('admin_post_nopriv_submit_review', 'handle_review_submission_guest');

function handle_review_submission() {
    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_die(__('You must be logged in to submit a review.'), __('Access Denied'), array('response' => 403));
    }

    // Verify nonce for security
    if (!wp_verify_nonce($_POST['review_nonce'], 'submit_review')) {
        wp_die(__('Security check failed.'), __('Security Error'), array('response' => 403));
    }

    // Sanitize input data
    $reviewer_name = sanitize_text_field($_POST['reviewer_name']);
    $review_text = sanitize_textarea_field($_POST['review_text']);
    $stars = intval($_POST['stars']);

    // Validate required fields
    if (empty($reviewer_name) || empty($review_text) || $stars < 1 || $stars > 5) {
        wp_die(__('Please fill in all required fields correctly.'), __('Validation Error'), array('response' => 400));
    }

    // Create the review post
    $post_data = array(
        'post_title' => 'Review by ' . $reviewer_name,
        'post_type' => 'review',
        'post_status' => 'pending', // Needs admin approval
        'post_author' => get_current_user_id()
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        // Save custom fields
        update_field('reviewer_name', $reviewer_name, $post_id);
        update_field('review_text', $review_text, $post_id);
        update_field('stars', $stars, $post_id);

        // Handle image upload
        if (!empty($_FILES['reviewer_image']['name'])) {
            $uploaded = media_handle_upload('reviewer_image', $post_id);
            if (!is_wp_error($uploaded)) {
                update_field('reviewer_image', $uploaded, $post_id);
            }
        }

        // Redirect with success message
        wp_redirect(add_query_arg('review_submitted', '1', wp_get_referer()));
        exit;
    } else {
        wp_die(__('Failed to submit review. Please try again.'), __('Submission Error'), array('response' => 500));
    }
}

// Handle guest user attempts
function handle_review_submission_guest() {
    wp_die(__('You must be logged in to submit a review.'), __('Access Denied'), array('response' => 403));
}

function enable_woo_commerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'enable_woo_commerce_support' );

function yourtheme_woocommerce_setup() {
    // These lines enable the core WooCommerce gallery features
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'yourtheme_woocommerce_setup' );



function show_category_on_product() {
   global $product;
    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    echo $terms[0]->name;
}

add_action( 'woocommerce_after_shop_loop_item_title', 'show_category_on_product', 5 );