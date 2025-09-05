<?php if ( have_rows('reviews') ) : ?>
    <section class="reviews">
        <h2><?php the_field('heading'); ?></h2>
        <div class="reviews-wrapper">
            <?php while ( have_rows('reviews') ) : the_row(); 
                $image = get_sub_field('reviewer_image');
                $name = get_sub_field('reviewer_name');
                $text = get_sub_field('review_text');
                $stars = get_sub_field('stars');
            ?>
                <div class="review-card">
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($name); ?>" class="review-img" />
                    <?php endif; ?>
                    <h3><?php echo esc_html($name); ?></h3>
                    <p><?php echo esc_html($text); ?></p>
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
