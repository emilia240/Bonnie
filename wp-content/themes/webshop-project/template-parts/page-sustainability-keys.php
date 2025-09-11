<div class="keys-border"></div>


<?php if( have_rows('keys') ): ?>
  <div class="keys">
    <?php 
    // Get all rows as an array
    $rows = get_field('keys'); 

    if( $rows ) :
      foreach( array_reverse($rows) as $row ): ?>
        <div class="key">
          <div class="key_text">
            <div class="key_header">
              <div class="key_icon_box">
                <?php if( $row['key_icon_box'] ): ?>
                  <img src="<?php echo esc_url($row['key_icon_box']['url']); ?>" alt="<?php echo esc_attr($row['key_icon_box']['alt']); ?>">
                <?php endif; ?>
              </div>
              <div class="key_title">
                <?php echo esc_html($row['key_title']); ?>
              </div>
            </div>
            <div class="key_content">
              <?php echo wpautop( wp_kses_post( $row['key_content'] ) ); ?>
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
  </div>
<?php endif; ?>


