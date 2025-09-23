<section class="w-full !py-12">



<?php if( have_rows('keys') ): ?>
  <section class="keys">
    <?php 
    // Get all rows as an array
    $rows = get_field('keys'); 

    if( $rows ) :
      $i = 0;
      foreach( $rows as $row ): 
      $i++;
      ?>
        <div class="key px-10">
          <div class="key_text">
            <header class="key_header">
              <div class="key_icon_box">
                <?php if( $row['key_icon_box'] ): ?>
                  <img src="<?php echo esc_url($row['key_icon_box']['url']); ?>" alt="<?php echo esc_attr($row['key_icon_box']['alt']); ?>">
                <?php endif; ?>
              </div>
              <h2 class="key_title text-responsive-lg">
                <a name="i<?php echo $i; ?>"><?php echo esc_html($row['key_title']); ?></a>
                </h2>
              </header>
            <div class="key_content text-responsive-base">
              <p><?php echo wpautop( wp_kses_post( $row['key_content'] ) ); ?></p>
            </div>
          </div>
          <div class="key_images">
            <?php if( $row['key_gallery'] ): 
              foreach( $row['key_gallery'] as $image ): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endforeach; endif; ?>
            
            <?php if( $row['key_video'] ): ?>
              <div class="key_video">
                <iframe src="<?php echo esc_url($row['key_video']); ?>" frameborder="0"></iframe>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
<?php endif; ?>


</section>