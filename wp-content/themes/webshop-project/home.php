<?php get_header(); ?>

<!-- categories filter here -->

<!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-8 sm:px-10 ">
        <?php
        $args = array(
            'post_type' => 'blog',
            'posts_per_page' => 15,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <?php
                    $url = get_the_permalink();
                    $categories = get_the_category();
                    $tags = get_the_tags();
                    $title = get_the_title();
                    $description = get_the_excerpt();
                    $image_id = get_post_thumbnail_id();
                    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';

                ?>
                    <!--Article Card -->
                <div class="flex flex-col md:flex-col md:flex-wrap justify-center h-auto w-full rounded-lg shadow bg-white overflow-hidden">
                    
                    <!-- Image -->
                    <?php if ($image_url): ?>
                    <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="object-cover w-full h-full rounded-t-lg" />
                    </div>
                    <?php endif; ?>
                
                    <!-- Content -->
                    <div class="flex flex-col flex-grow !py-2 !px-6 text-[#1D1D1D]">
                
                        <!-- Category & Tag -->
                        <div class="!px-2 !py-2 flex justify-between !gap-2 " style="font-family: 'Bodoni MT', serif">
                            <div class="category text-sm flex flex-wrap uppercase">
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Tags -->
                            <div class="tags text-xs flex flex-wrap !gap-2 underline">
                                <?php if (!empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge rounded-pill text-bg-primary">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>



                        <!-- Title -->
                        <h3 class="!mb-2 text-xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;"><?php echo esc_html($title); ?></h3>
                        
                        <!-- Description -->
                        <p class="!mb-4 text-xs line-clamp-3 sm:line-clamp-4 lg:line-clamp-5" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;"><?php echo esc_html($description); ?></p>
                        
                        <!-- Button -->
                        <a href="<?php echo esc_url($url); ?>" class="inline-flex items-center !gap-2 bg-[#1C3361] text-[#F4F4F4] !px-4 !py-2 rounded-full !mt-auto" style="font-family:'Skolar Sans', sans-serif; font weight: 400;">
                        Read article
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 items-center no-wrap" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
                            <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                        </a>
                    </div>
                </div>
            
            <?php endwhile;?>
            <?php wp_reset_postdata(); ?>

            <?php else : ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>


    <!-- Pagination -->
     <div class="mt-8 flex justify-center">
        <?php
        echo paginate_links(array(
            'total' => $query->max_num_pages,
            'current' => $paged,
        ));
        ?>
    </div>
<?php get_footer(); ?>