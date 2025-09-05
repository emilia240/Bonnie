<section class="w-full h-[500px] !py-12 relative overflow-hidden flex items-center">
    <!-- Slider container -->
     <div id="hero-slider" class="relative w-full h-full">
        <?php if( have_rows('hero_slides') ): ?>
            <?php $i = 0; while( have_rows('hero_slides') ): the_row(); ?>
                <?php $image = get_sub_field('slide_image');?>
                <img src="<?php echo esc_url($image['url']); ?>"
                     class="slider-img absolute inset-0 w-full h-full object-cover transition-opacity duration-700 
                     <?php echo $i === 0 
                     ? 'opacity-100' 
                     : 'opacity-0'; 
                     ?>" 
                />
            <?php $i++; endwhile; ?>
        <?php endif; ?>

            <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-l from-black/90 via-black/40 to-transparent"></div>

    </div>

    <!-- About us content -->
    <div class="relative z-10 flex justify-end w-full h-full items-center">
       <div class="w-full md:w-2/5 !px-6 !py-12 text-left">
            <h1 class="text-4xl md:text-5xl text-[#F4F4F4] !mb-4 drop-shadow-lg" style="font-family: 'Aquavit', san-serif; font-weight: 700;">
                <?php the_field('hero_heading'); ?>
            </h1>
            <h2 class="text-2xl md:text-3xl text-[#F4F4F4] !mb-4 drop-shadow-lg" style="font-family: Bodoni MT, serif; font-weight: 500;">
                <?php the_field('hero_subheading'); ?>
            </h2>
            <div class="text-lg md:text-xl text-[#F4F4F4] drop-shadow-lg" style="font-family: var(--font-body);">
                <?php the_field('hero_text'); ?>
            </div>
        </div> 
    </div>

</section>

