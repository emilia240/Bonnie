<!--Article Card -->

<div class="flex flex-col md:flex-col md:flex-wrap justify-center h-auto w-full rounded-lg shadow-md bg-white overflow-hidden transition-transform duration-300 lg:hover:scale-105">
    <?php
    $url = get_the_permalink();
    $categories = get_the_category();
    $tags = get_the_tags();
    $title = get_the_title();
    $description = get_the_excerpt();
    $image_id = get_post_thumbnail_id();
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
    $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : ''; // Get alt text of the image


    $cat_id = isset($_GET['cat']) && $_GET['cat'] !== '' ? intval($_GET['cat']) : '';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 15,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    );
    if ($cat_id) {
        $args['cat'] = $cat_id;
    }
    $query = new WP_Query($args);
    ?>
    
    <!-- Image -->
    <?php if ($image_url): ?>
    <div class="w-full h-48 flex items-center justify-center bg-gray-100">
        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="object-cover w-full h-full rounded-t-lg" />
    </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="flex flex-col flex-grow !py-2 !px-6 text-[#1D1D1D]">

        <!-- Category & Tag -->
        <div class="flex justify-between !gap-4 !py-2" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;">
            <div class="category flex flex-wrap uppercase !gap-2 lg:hover:underline lg:hover:text-[#1C3361] transition-colors duration-200">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <p><?php echo esc_html($category->name); ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- Tags -->
            <div class="tags flex justify-end flex-wrap !gap-2">
                <?php if (!empty($tags)): ?>
                    <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="lg:hover:underline lg:hover:text-[#1C3361] transition-colors duration-200 badge rounded-pill text-bg-primary">
                            <p><?php echo esc_html($tag->name); ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>



        <!-- Title -->
        <h3 class="!mb-2 text-responsive-md" style="font-family: 'Aquavit', san-serif; font-weight: 500;"><?php echo esc_html($title); ?></h3>
        
        <!-- Description -->
        <p class="!mb-4 text-responsive-xs line-clamp-3 sm:line-clamp-4 lg:line-clamp-5" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;"><?php echo esc_html($description); ?></p>

        <!-- Button -->
        <a href="<?php echo esc_url($url); ?>" class="inline-flex items-center !gap-2 bg-[#1C3361] text-[#F4F4F4] !px-4 !py-2 rounded-full !mt-auto w-fit lg:hover:bg-white lg:hover:text-[#1C3361] 
        lg:hover:border lg:hover:border-[#1C3361] transition-colors duration-200" style="font-family:'Skolar Sans', sans-serif; font weight: 400;">

            <p class="text-responsive-sm"><?php echo esc_html(pll_e('Read article')); ?></p>

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 items-center no-wrap" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
                <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
        </a>
    </div>
</div>