<section class="w-full !py-12">
  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mb-6">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
      Our most popular articles
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

  <!-- Subtitle and button row -->
  <div class="flex items-center justify-between !mb-8 !px-4">
    <div class="text-lg font-body max-w-lg" style="font-family: var(--font-body);">
      Educational articles to learn about pet care, terrariums, and more!
    </div>
    <button class="bg-[#1C3361] text-[#F4F4F4] !px-6 !py-2 rounded-lg flex items-center !gap-2" style="font-family: 'Bodoni MT', serif; font-weight: 500;">
      Our blogs
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
            <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </button>
  </div>

  <!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-8 sm:px-10 ">
<!--grid !gap-8 w-full grid-cols-1 md:grid-cols-3 !px-4 -->
        <?php
        $args = array(
        'post_type' => 'article-card',
        'posts_per_page' => 3,
        );
        $loop = new WP_Query($args);

        if ($loop->have_posts()):
        while ($loop->have_posts()): $loop->the_post();
            $category = get_field('category');
            $tag_one = get_field('tag-one');
            $tag_two = get_field('tag-two');
            $tag_three = get_field('tag-three');
            $title = get_field('title');
            $description = get_field('description');
            $image = get_field('image');
            $button = get_field('button');
        ?>
            <!--Article Card -->
        <div class="flex flex-col rounded-lg shadow bg-white overflow-hidden">
            
            <!-- Image -->
            <?php if ($image): ?>
            <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="object-cover w-full h-full rounded-t-lg" />
            </div>
            <?php endif; ?>
           
            <!-- Content -->
            <div class="flex flex-col flex-grow !py-2 !px-6">
           
                <!-- Category & Tag -->
                <div class="!px-2 !py-2  text-[#1D1D1D] flex justify-between !gap-2 " style="font-family: 'Bodoni MT', serif">
                    <div class="category text-sm flex flex-wrap">
                        <?php if (!empty($category)): ?>
                            <span> <?php echo esc_html($category) ?></span>
                        <?php endif; ?>
                    </div>
                    <!-- Tags -->
                    <div class="tags text-xs flex flex-wrap !gap-2 underline text-[#1d1d1d]">
                        <?php if (!empty($tag_one)): ?>
                            <span ><?php echo esc_html($tag_one); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($tag_two)): ?>
                            <span><?php echo esc_html($tag_two); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($tag_three)): ?>
                            <span><?php echo esc_html($tag_three); ?></span>
                        <?php endif; ?>
                    </div>
                </div>



                <!-- Title -->
                <h3 class="!mb-2 text-xl uppercase" style="font-family: 'Aquavit', san-serif; font-weight: 500;"><?php echo esc_html($title); ?></h3>
                
                <!-- Description -->
                <p class="!mb-4 text-xs line-clamp-3 sm:line-clamp-4 lg:line-clamp-5" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;"><?php echo esc_html($description); ?></p>
                
                <!-- Button -->
                <a href="<?php echo get_permalink(); ?>" class="inline-flex items-center !gap-2 bg-[#1C3361] text-[#F4F4F4] !px-4 !py-2 rounded-full !mt-auto uppercase" style="font-family:'Skolar Sans', sans-serif; font weight: 400;">
                Read article
                        <!--LATER link it to blog post -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
</section>