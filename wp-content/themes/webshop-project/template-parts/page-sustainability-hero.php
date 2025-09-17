<section class="w-full h-[500px] !py-12 relative overflow-hidden flex items-center">
    <?php

        $text = get_field('sus_hero_text');
        $image = get_field('sus_hero_image');
        
    ?>

    <!-- Slider container -->
     <div id="hero-slider" class="absolute inset-0 w-full h-full">>
            <img src="<?php echo esc_url($image['url']); ?>"
                 class="absolute inset-0 w-full h-full object-cover transition-opacity" />
        <!-- Dark overlay -->
       <div class="absolute inset-0 bg-black/30"></div>

    </div>

    <!-- About us content -->
      <div class="absolute inset-0 flex items-center justify-center z-10 px-6 sm:px-10 md:px-20">
      <h1 class="text-4xl sm:text-5xl text-[#F4F4F4] text-center max-w-full font-bold mb-4 sm:mb-6" style="font-family: var(--font-headers);">
        <?php echo esc_html($text); ?>
      </h1>
  </div>

</section>

