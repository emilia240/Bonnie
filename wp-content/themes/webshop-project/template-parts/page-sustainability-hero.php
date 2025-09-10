<section class="w-full h-[500px] !py-12 relative overflow-hidden flex items-center">
    <?php

        $text = get_field('hero_text');

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
     <div id="hero-slider" class="absolute inset-0 w-full h-full">>
        <?php foreach ($slides as $i => $image): ?>
            <img src="<?php echo esc_url($image['url']); ?>"
                 class="slider-img absolute inset-0 w-full h-full object-cover transition-opacity duration-700 <?php echo $i === 0 ? 'opacity-100' : 'opacity-0'; ?>" />
        <?php endforeach; ?>
        <!-- Dark overlay -->
       <div class="absolute inset-0 bg-black/30"></div>

    </div>

    <!-- About us content -->
      <div class="absolute inset-0 flex items-center justify-center z-10 px-6 sm:px-10 md:px-20">
    <div class="text-white text-center max-w-full">
      <h1 class="text-3xl sm:text-5xl font-bold mb-4 sm:mb-6">
        <?php echo esc_html($text); ?>
      </h1>
    </div>
  </div>

</section>

