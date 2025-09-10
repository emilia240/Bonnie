<div class="keys-border"></div>

<?php if( have_rows('keys') ): ?>
  <?php while( have_rows('keys') ): the_row(); ?>
    <div class="wrapper">
      <!-- images column -->
      <div>
        <?php 
        $keyGallery = get_sub_field('key_gallery'); 
        if( $keyGallery ): 
            foreach( $keyGallery as $keyGallery ): ?>
           <img src="<?php echo esc_url($keyGallery['url']); ?>" alt="<?php echo esc_attr($keyGallery['alt']); ?>">
            <?php endforeach; 
        endif; ?>
      </div>

      <!-- text + icon column -->
      <div>
        <div class="icon-box">
          <?php 
          $iconBox = get_sub_field('key_icon_box'); 
          if( $iconBox ): ?>
            <img src="<?php echo esc_url($iconBox['url']); ?>" alt="<?php echo esc_attr($iconBox['alt']); ?>">
          <?php endif; ?>
        </div>

        <h2><?php the_sub_field('key_title'); ?></h2>
        <p><?php the_sub_field('key_content'); ?></p>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>
