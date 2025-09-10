<div class="keys-border"></div>

<?php

$keys = get_field('keys');
if ($keys) {
    // Sort by key_title ascending
    usort($keys, function($a, $b) {
        return strcmp($a['key_title'], $b['key_title']);
    });

    foreach ($keys as $index => $row) : 
        // Maintainability: Consider moving gallery and content containers to separate template parts if reused elsewhere
        $icon_box_class = ($index === 1) ? 'icon-box-light' : '';
        ?>
        <div class="wrapper" data-section="<?php echo esc_attr($index + 1); ?>">
          <!-- images column -->
          <div class="gallery-container">
            <?php 
            if( !empty($row['key_gallery']) ):
                foreach( $row['key_gallery'] as $keyGallery ):
                    // Security: Ensure alt and url are properly escaped
                    ?>
               <div class="gallery-item">
                   <img src="<?php echo esc_url($keyGallery['url']); ?>" alt="<?php echo esc_attr($keyGallery['alt']); ?>">
               </div>
                <?php endforeach; 
            endif; ?>
          </div>

          <!-- text + icon column -->
          <div class="content-container">
            <div class="title-with-icon">
              <div class="icon-box <?php echo esc_attr($icon_box_class); ?>">
                <?php 
                $iconBox = $row['key_icon_box'];
                if( $iconBox ):
                  // Security: Ensure alt and url are properly escaped
                  ?>
                  <img src="<?php echo esc_url($iconBox['url']); ?>" alt="<?php echo esc_attr($iconBox['alt']); ?>">
                <?php endif; ?>
              </div>
              <h3><?php echo esc_html($row['key_title']); ?></h3>
            </div>
            <p><?php echo wpautop(wp_kses_post($row['key_content'])); ?></p>
          </div>
        </div>
    <?php endforeach;
}
?>
