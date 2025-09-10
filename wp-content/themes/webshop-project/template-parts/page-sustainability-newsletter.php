<?php
    $tipHeadline = get_field('tip_headline');
    $tipNewsletterHeader = get_field('tip_newsletter_header');
    $tipNewsletterDescription = get_field('tip_newsletter_description');
    $newsletterButton = get_field('newsletter_button');

    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($tipHeadline): ?>
            <?php echo esc_html($tipHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>
  
  <div class="flex flex-col items-center justify-center text-xl !mb-16">
  <!-- Wrapper to align headline + green box -->
  <div class="w-full max-w-4xl">
   
    <h3 class="mb-6 text-left text-xl">
            <?php echo esc_html($tipNewsletterHeader); ?>
        </h3>

    <div class="h-[200px] rounded-xl bg-[#74B24B] p-14">
      <form class="flex flex-col gap-4">
        <div class="flex flex-col items-center gap-4 md:flex-row">
          <input 
            type="email" 
            placeholder="write your email here....." 
            class="flex-1 rounded-lg bg-white px-4 py-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-700" 
          />
          <button 
            type="submit" 
            class="rounded-md bg-[#1C3361] px-6 w-[130px] py-3 font-semibold text-lg text-white transition hover:bg-blue-800"
          >
            <?php echo esc_html($newsletterButton); ?></h3>
          </button>
        </div>

        
        <p class="text-sm text-white">
            <?php echo esc_html($tipNewsletterDescription); ?>
        </p>
      </form>
    </div>
  </div>
</div>
