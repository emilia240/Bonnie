<section class="w-full !py-12 relative flex items-center justify-center">

    <?php
    $image = get_field('terrarium_image');
    $headline = get_field('terrarium_headline');
    $button_text = get_field('terrarium_button_text');

    $button_url = home_url('/terrariums'); // Link to the terrariums page
    ?>

    <div class="relative flex flex-col items-center justify-center w-full max-w-7xl mx-auto h-96 rounded-lg overflow-hidden shadow-lg">

        <!-- Image cover -->
        <?php if ($image): ?>
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-transparent"></div>
        </div>
        <?php endif; ?>

        <!-- Content on top of image -->
        <div class="relative z-10 flex flex-col items-center justify-center w-full h-full py-16">
            <?php if ($headline): ?>
            <h2 class="text-responsive-lg font-bold text-white mb-6" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
                <?php echo esc_html($headline); ?>
            </h2>
            <?php endif; ?>
            <?php if ($button_text): ?>
            <a href="<?php echo esc_url($button_url); ?>" class="bg-[#1C3361] text-[#F4F4F4] px-6 py-2 rounded-full inline-flex items-center gap-2 no-wrap hover:bg-white hover:text-[#1C3361] hover:border hover:border-[#1C3361] transition-colors duration-200" style="font-family: 'Bodoni MT', serif; font-weight: 500;">
                <p class="text-responsive-base"><?php echo esc_html($button_text); ?></p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
                    <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </a>
            <?php endif; ?>
        </div>
        
    </div>

</section>