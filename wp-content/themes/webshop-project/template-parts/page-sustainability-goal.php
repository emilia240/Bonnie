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
  <div class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($goalHeadline): ?>
            <?php echo esc_html($goalHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

<div class="mx-auto max-w-6xl px-10 py-8 ">
  <!-- Intro Text -->
  <div class="mb-12 text-left">
    <p class="mx-auto max-w-6xl text-responsive-base" style="font-family: var(--font-body);">
      <?php echo wp_kses_post($goalIntro); ?>
    </p>
  </div>

 <!-- Content Flex Container -->
<div class="flex flex-col md:flex-row gap-8 items-start">
  <!-- Intro Text -->
  <div class="flex-1 space-y-6 text-responsive-base order-1 md:order-none" style="font-family: var(--font-body);">
    <p><?php echo wp_kses_post($goalSubText); ?></p>
  </div>

  <!-- SDG Card -->
  <div class="flex-shrink-0 w-[212px] mx-auto md:w-1/5 rounded-lg border order-2 md:order-none">
    <div class="text-center">
      <img src="<?php echo esc_url($goalImage['url']); ?>" alt="" class="h-[212px] w-[212px] bg-gray-200 flex items-center justify-center">
      <p class="text-responsive-sm p-4" style="font-family: var(--font-headers);">
        <?php echo esc_html($goalCardText); ?>
      </p>
    </div>
  </div>
 </div>

  <p class="mx-auto max-w-6xl mt-12 text-left text-responsive-base" style="font-family: var(--font-body);">
  <?php echo wp_kses_post($goalOutro); ?>
  </p>
</div>
 </section>