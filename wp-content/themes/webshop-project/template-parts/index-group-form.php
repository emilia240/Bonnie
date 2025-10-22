<section class="w-full !py-12">
    
<?php 
       $formHeadline = get_field('form_headline');
       $formSubtitle = get_field('form_subtitle')


?>



<!-- Header with lines on the side -->
    <div class="flex items-center w-full !mt-10 !mb-14">
      <hr class="flex-grow border-t border-[var(--color-dark)]">
      <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
           <?php echo esc_html($formHeadline); ?> 
      </h2>
      <hr class="flex-grow border-t border-[var(--color-dark)]">
    </div>


  
    <p class="flex lg:flex-row sm:flex-row flex-col gap-2 items-center justify-between text-responsive-md !mb-8 px-10" style="font-family: var(--font-body);">
        <?php echo esc_html($formSubtitle); ?> 
      </p>


  <div class="flex justify-center mb-10 px-4">

    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" 
          class="w-full max-w-full sm:max-w-md md:max-w-2xl lg:max-w-5xl rounded-lg bg-gray-100 p-4 sm:p-6 md:p-8 shadow-sm text-gray-900">
          <?php wp_nonce_field('save_survey_response', 'survey_nonce'); ?>
      <input type="hidden" name="action" value="save_survey_response" style="font-family: var(--font-body);" />

    <!-- Interest Options -->
      <?php
        $interest_loop = new WP_Query(array(
            'post_type' => 'interest-option',
            'posts_per_page' => -1
        ));
      ?>

      <div class="mb-6">
        <label class="mb-3 block font-medium text-responsive-base" style="font-family: var(--font-body);">
        <?php echo esc_html(pll__('Would you be interested in a private Facebook group for our community?')) ?> 
        </label>
        <div class="flex flex-col gap-3">
           <?php if($interest_loop->have_posts()): ?>
              <?php while($interest_loop->have_posts()): $interest_loop->the_post(); ?>
                <?php 
                  $id = get_the_ID();
                  $name = get_the_title();
                ?>
                <label class="flex cursor-pointer items-center gap-2" for="interest_<?php echo esc_attr($id); ?>">
                  <input type="radio" name="fb_group_interest" id="interest_<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($id); ?>" />
                  <span class="text-responsive-sm" style="font-family: var(--font-body);"><?php echo esc_html($name); ?></span>
                </label>
              <?php endwhile; ?>
            <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>

      <!-- Usage Options -->
      <?php
        $usage_loop = new WP_Query(array(
            'post_type' => 'usage-option',
            'posts_per_page' => -1
        ));
      ?>

      <div class="!mb-6">
        <label class="mb-3 block text-responsive-base" style="font-family: var(--font-body);">
        <?php echo esc_html(pll__('If yes, how often do you use Facebook?') );?>
        </label>
        <div class="flex flex-col gap-3" style="font-family: var(--font-body);">
            <?php if($usage_loop->have_posts()): ?>
                <?php while($usage_loop->have_posts()): $usage_loop->the_post(); ?>
                  <?php 
                    $id = get_the_ID();
                    $name = get_the_title();
                  ?>
                  <label class="flex cursor-pointer items-center gap-2" for="usage_<?php echo esc_attr($id); ?>">
                    <input type="radio" name="fb_usage[]" id="usage_<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($id); ?>" />
                    <span class="text-responsive-sm"><?php echo esc_html($name); ?></span>
                  </label>
                <?php endwhile; ?>
              <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
      </div>

      <div class="mb-6">
        <label for="fb_expectations" class="mb-3 block text-responsive-base" style="font-family: var(--font-body);">
        <?php echo esc_html(pll__('What kind of content would you like to see in our group? '));?>
        </label>
          <textarea name="fb_expectations" id="fb_expectations" rows="3"
           placeholder="<?php echo esc_html(pll__('e.g. care tips, contact with breeders, pet help...')); ?>"
           class="text-responsive-sm w-full h-[180px] sm:h-[200px] md:h-[230px] rounded-md border border-gray-300 p-3 focus:border-blue-500"
           style="font-family: var(--font-body);"></textarea>
      </div>

      <div class="flex justify-end">
      <input type="submit" value="<?php echo esc_html(pll__('Submit')); ?>" style="font-family: var(--font-body);"
      class="w-full sm:w-[130px] cursor-pointer rounded-md bg-[#1C3361] px-6 py-3 text-[#F4F4F4] text-responsive-sm lg:hover:bg-white lg:hover:text-[#1C3361]
      lg:hover:border lg:hover:border-[#1C3361] transition-colors duration-200"/>
      </div>
      <!-- message alert -->
      <input type="hidden" name="survey_submitted" value="1"> 
    </form>
  </div>
</section>

