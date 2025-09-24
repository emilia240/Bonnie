<?php if ( function_exists('pll_current_language') ) : ?>
    <?php if ( have_rows('reviews') ) : ?>
        <section class="reviews">
            <?php
            $reviews_title = get_field('reviews_title');
            $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : ''; // Get alt text of the image
            ?>
            <div class="flex items-center w-full !mb-10">
                <hr class="flex-grow border-t border-[var(--color-dark)]">
                <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', sans-serif; font-weight: 500;">
                    <?php echo esc_html($reviews_title); ?>
                </h2>
                <hr class="flex-grow border-t border-[var(--color-dark)]">
            </div>

            <div class="reviews-wrapper">
                <?php while ( have_rows('reviews') ) : the_row(); 
                    $image = get_sub_field('reviewer_image');
                    $name  = get_sub_field('reviewer_name');
                    $text  = get_sub_field('review_text');
                    $stars = get_sub_field('stars');

                    $current_lang = pll_current_language();
                    $market = get_sub_field('market');

                    if ( $market && $market !== $current_lang ) {
                    continue;
                    }

                ?>
                    <div class="review-card">
                        <div class="review-header">
                           <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="review-img" />
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
        </section>
    <?php endif; ?>
<?php endif; ?>
