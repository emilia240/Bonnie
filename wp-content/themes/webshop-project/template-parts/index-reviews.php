<?php if (function_exists('pll_current_language')) : ?>
    <section class="reviews">
        <?php
        $current_lang = pll_current_language();

        $reviews_query = new WP_Query(array(
            'post_type' => 'review',
            'posts_per_page' => 4, 
            'post_status' => 'publish',
            'lang' => $current_lang,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($reviews_query->have_posts()) : ?>
            <div class="flex items-center w-full !mb-10">
                <hr class="flex-grow border-t border-[var(--color-dark)]">
                <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', sans-serif; font-weight: 500;">
                    <?php echo esc_html(pll_e('Customer Reviews')); ?>
                </h2>
                <hr class="flex-grow border-t border-[var(--color-dark)]">
            </div>

            <div class="reviews-wrapper">
                <?php while ($reviews_query->have_posts()) : $reviews_query->the_post();
                    $image = get_field('reviewer_image');
                    $name = get_field('reviewer_name');
                    $text = get_field('review_text');
                    $stars = get_field('stars');
                ?>
                    <div class="review-card">
                        <div class="review-header">
                            <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" 
                                     alt="<?php echo esc_attr($image['alt']); ?>" 
                                     class="review-img" />
                            <?php endif; ?>
                            <h3 class="text-responsive-md"><?php echo esc_html($name); ?></h3>
                        </div>
                        <p class="text-responsive-sm"><?php echo esc_html($text); ?></p>
                        <div class="stars">
                            <?php for ($i = 0; $i < $stars; $i++) : ?>
                                ⭐
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>