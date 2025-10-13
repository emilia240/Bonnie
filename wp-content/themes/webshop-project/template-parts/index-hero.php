<section class="w-full h-[500px] !py-12 relative overflow-hidden flex items-center" role="banner" aria-label="Hero section">
    <?php
        $heading     = get_field('hero_heading');
        $subheading  = get_field('hero_subheading');
        $text        = get_field('hero_text');

        // Preparing slides array
        $slides = array();
        if (have_rows('hero_slides')) {
            while (have_rows('hero_slides')) {
                the_row();
                $image = get_sub_field('slide_image');
                if ($image) {
                    $slides[] = $image;
                }
            }
        }
    ?>

    <!-- Slider container -->
     <div id="hero-slider" class="absolute inset-0 w-full h-full" aria-live="polite">
        <?php foreach ($slides as $i => $image): ?>
            <img src="<?php echo esc_url($image['url']); ?>"
         alt="<?php echo esc_attr($image['alt']); ?>"
         class="slider-img absolute inset-0 w-full h-full object-cover transition-opacity duration-700 <?php echo $i === 0 ? 'opacity-100' : 'opacity-0'; ?>" />
         <?php endforeach; ?>
        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-l from-black/90 via-black/40 to-transparent" aria-hidden="true"></div>

    </div>

    <!-- About us content -->
    <div class="relative z-10 flex justify-end w-full h-full items-center">
       <div class="w-full md:w-2/5 !px-6 !py-12 text-left">
            <h1 id="hero-heading" class="text-responsive-xl text-[#F4F4F4] !mb-4 drop-shadow-lg" style="font-family: 'Aquavit', san-serif; font-weight: 600;">
                <?php echo esc_html($heading); ?>
            </h1>
            <h2 class="text-responsive-lg text-[#F4F4F4] !mb-4 drop-shadow-lg" style="font-family: Bodoni MT, serif; font-weight: 500;">
                <?php echo esc_html($subheading); ?>
            </h2>
            <p class="text-responsive-md text-[#F4F4F4] drop-shadow-lg" style="font-family: var(--font-body);">
                <?php echo esc_html($text); ?>
            </p>
        </div>
    </div>

</section>

