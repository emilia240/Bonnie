<div class="keys-border"></div>

<?php
$keys = get_field('keys');
if ($keys) {
    // Sort by key_title ascending
    usort($keys, function($a, $b) {
        return strcmp($a['key_title'], $b['key_title']);
    });

    foreach ($keys as $row) : ?>
        <div class="wrapper">
          <!-- images column -->
          <div>
            <?php 
            if( $row['key_gallery'] ): 
                foreach( $row['key_gallery'] as $keyGallery ): ?>
               <img src="<?php echo esc_url($keyGallery['url']); ?>" alt="<?php echo esc_attr($keyGallery['alt']); ?>">
                <?php endforeach; 
            endif; ?>
          </div>

          <!-- text + icon column -->
          <div>
            <div class="icon-box">
              <?php 
              $iconBox = $row['key_icon_box'];
              if( $iconBox ): ?>
                <img src="<?php echo esc_url($iconBox['url']); ?>" alt="<?php echo esc_attr($iconBox['alt']); ?>">
              <?php endif; ?>
            </div>

            <h2><?php echo esc_html($row['key_title']); ?></h2>
            <p><?php echo esc_html($row['key_content']); ?></p>
          </div>
        </div>
    <?php endforeach;
}
