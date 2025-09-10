<?php
    $initiativesHeadline = get_field('initiatives_headline');

    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-5">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($initiativesHeadline): ?>
            <?php echo esc_html($initiativesHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

<?php if( have_rows('initiatives_list') ): ?>
  <div class="cards">
    <?php while( have_rows('initiatives_list') ): the_row(); ?>
      <div class="card">
        <div class="icon">
          <?php 
            $icon = get_sub_field('icon'); 
            if( $icon ) : 
              echo wp_get_attachment_image($icon, 'full'); 
            endif; 
          ?>
        </div>
        <h3><?php the_sub_field('initiative_header'); ?></h3>
        <p><?php the_sub_field('initative_description'); ?></p>
       <?php if( get_sub_field('initiative_link_button') ): ?>
       <a href="<?php the_sub_field('initiative_link_button'); ?>" class="learn-more-btn">
       <?php echo get_sub_field('button_text') ? get_sub_field('button_text') : 'Learn More'; ?>
        </a>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
