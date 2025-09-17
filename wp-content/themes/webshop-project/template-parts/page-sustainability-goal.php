<section class="w-full !py-12">



<?php
    $goalHeadline = get_field('goal_headline');
    $goalImage = get_field('goal_image');
    $goalCardText = get_field('goal_card_text');
    $goalIntro = get_field('goal_intro');
    $goalSubText = get_field('goal_sub_text');
    $goalOutro = get_field('goal_outro');
    
    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-5">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($goalHeadline): ?>
            <?php echo esc_html($goalHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

<div class="mx-auto max-w-6xl px-4 py-16 sm:py-12 ">
  <div class="mb-12 text-left">
    <p class="mx-auto max-w-6xl text-xl" style="font-family: var(--font-body);">
      <?php echo wp_kses_post($goalIntro); ?>
    </p>
  </div>

  <!-- Content Flex Container -->
  <div class="flex gap-8 items-start">
    <!-- SDG Card -->
    <div class="flex-shrink-0 w-1/5 rounded-lg border">
      <div class="text-center">
          <img src="<?php echo esc_url($goalImage['url']); ?>" alt="" class="h-full w-full bg-gray-200 flex items-center justify-center">
        <p class="text-lg p-4" style="font-family: var(--font-headers);"><?php echo esc_html($goalCardText); ?></p>
      </div>
    </div>

    <div class="flex-1 space-y-6 text-xl" style="font-family: var(--font-body);">
     <p> <?php echo wp_kses_post($goalSubText); ?></p> 
    </div>
   </div>

  
    <p class="mx-auto max-w-6xl mt-12 text-left text-xl" style="font-family: var(--font-body);">
     <?php echo wp_kses_post($goalOutro); ?>
    </p>

  </div>
 </section>