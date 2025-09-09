<?php
    $goalHeadline = get_field('goal_headline');
    $goalImage = get_field('goal_image');
    $goalCardText = get_field('goal_card_text');
    $goalIntro = get_field('goal_intro');
    $goalSubText = get_field('goal_sub_text');
    $goalOutro = get_field('goal_outro');
    
    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-16">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($goalHeadline): ?>
            <?php echo esc_html($goalHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

<section class="mx-auto max-w-6xl px-4 py-16 sm:py-12 ">
  <div class="mb-12 text-left">
    <p class="mx-auto max-w-4xl text-lg">
      <?php echo esc_html($goalIntro); ?>
    </p>
  </div>

  <!-- Content Flex Container -->
  <div class="flex gap-8 items-start">
    <!-- SDG Card -->
    <div class="flex-shrink-0 w-1/4 rounded-lg border bg-white">
      <div class="text-center">
        <div class="h-full w-full bg-gray-200 flex items-center justify-center">
          <img src="<?php echo esc_url($goalImage['url']); ?>" alt="">
        </div>
        <p class="text-xl p-4"><?php echo esc_html($goalCardText); ?></p>
      </div>
    </div>

    <div class="flex-1 space-y-6 text-lg">
      <p>
       <?php echo esc_html($goalSubText); ?>
      </p>
    </div>
  </div>


  <div class="mt-12 text-left">
    <p class="mx-auto max-w-4xl text-lg">
     <?php echo esc_html($goalOutro); ?>
    </p>
  </div>
</section>


