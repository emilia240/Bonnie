<?php
/**
 * Hub connect section template for Smush bulk optimization page.
 *
 * @package WP_Smush
 * @since   3.22.0
 *
 * @var int    $images_count        Number of images found for optimization.
 * @var string $connect_url         URL for connecting to WPMU DEV.
 */

?>
<div class="smush-hub-connect">
	<div class="smush-hub-connect-box sui-box-body">
		<div class="smush-connect-message sui-block-content-center sui-message sui-margin-top sui-spacing-top--40">
			<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/hub-connect.png' ); ?>"
				srcset="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/hub-connect@2x.png' ); ?> 2x"
				alt="<?php esc_attr_e( 'Graphic CDN', 'wp-smushit' ); ?>">

			<div class="smush-connect-content sui-message-content">
				<?php if ( ! is_network_admin() && $images_count > 0 ) : ?>
				<p class="smush-images-found-text sui-no-margin">
					<?php
					printf(
					/* translators: %s: number of images found */
						esc_html__( 'Smush found %s images waiting to be compressed', 'wp-smushit' ),
						'<strong>' . esc_html( $images_count ) . '</strong>'
					);
					?>
				</p>
				<?php endif; ?>
				<h2 class="smush-connect-title">
					<?php esc_html_e( 'Connect Now to Unlock Bulk Smush', 'wp-smushit' ); ?>
				</h2>

				<p class="smush-connect-description sui-no-margin">
					<?php
					printf(
					/* translators: %1$s: opening strong tag, %2$s: closing strong tag */
						esc_html__( 'To start smushing your images, you\'ll just need to connect your site to WPMU DEV. It\'s %1$stotally free%2$s. It\'ll take just a %1$sfew seconds%2$s and there\'s %1$sno credit card%2$s needed or fiddly API key copy-pasting involved.', 'wp-smushit' ),
						'<strong>',
						'</strong>',
					);
					?>
				</p>

				<a href="<?php echo esc_url( $connect_url ); ?>"
					class="smush-connect-button sui-button sui-button-blue sui-margin-top smush-button-dark-blue"
                >
					<?php esc_html_e( 'CONNECT MY SITE', 'wp-smushit' ); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="smush-hub-connect-benefits">
		<div class="smush-benefits-container sui-box-body">
			<h2 class="smush-benefits-title sui-box-body sui-spacing-bottom--50">
				<?php esc_html_e( 'When you connect, you\'ll get', 'wp-smushit' ); ?>
			</h2>

			<div class="smush-benefits-grid benefits-grid sui-margin-bottom">
				<div class="smush-benefit-item benefit-item">
					<div class="smush-benefit-icon benefit-icon">
						<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/api-connect-icon.svg' ); ?>" alt="<?php esc_attr_e( 'Bulk Smush API Access Icon', 'wp-smushit' ); ?>">
					</div>
					<div class="smush-benefit-content benefit-content">
						<h3 class="smush-benefit-title">
							<?php esc_html_e( 'Instant access to Bulk Smush API', 'wp-smushit' ); ?>
						</h3>
						<p class="smush-benefit-description">
							<?php esc_html_e( 'Optimize everything in your Media Library to make your site as light as a feather.', 'wp-smushit' ); ?>
						</p>
					</div>
				</div>

				<div class="smush-benefit-item benefit-item">
					<div class="smush-benefit-icon benefit-icon">
						<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/unlimited-smush-icon.svg' ); ?>" alt="<?php esc_attr_e( 'Unlimited Smushing Icon', 'wp-smushit' ); ?>">
					</div>
					<div class="smush-benefit-content benefit-content">
						<h3 class="smush-benefit-title">
							<?php esc_html_e( 'Unlimited Bulk Smushing', 'wp-smushit' ); ?>
						</h3>
						<p class="smush-benefit-description">
							<?php esc_html_e( 'Compress ALL your images - no limits or additional credits required.', 'wp-smushit' ); ?>
						</p>
					</div>
				</div>

				<div class="smush-benefit-item benefit-item">
					<div class="smush-benefit-icon benefit-icon">
						<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/directory-smush-icon.svg' ); ?>" alt="<?php esc_attr_e( 'PNG to JPEG Conversion Icon', 'wp-smushit' ); ?>">
					</div>
					<div class="smush-benefit-content benefit-content">
						<h3 class="smush-benefit-title">
							<?php esc_html_e( 'Directory Smush', 'wp-smushit' ); ?>
						</h3>
						<p class="smush-benefit-description">
							<?php esc_html_e( 'Automatically bulk Smush images in a directory outside the Media Library.', 'wp-smushit' ); ?>
						</p>
					</div>
				</div>

				<div class="smush-benefit-item benefit-item">
					<div class="smush-benefit-icon benefit-icon">
						<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/bulk-smush/auto-smush-icon.svg' ); ?>"
							alt="<?php esc_attr_e( 'Auto-Smushing Icon', 'wp-smushit' ); ?>">
					</div>
					<div class="smush-benefit-content benefit-content">
						<h3 class="smush-benefit-title">
							<?php esc_html_e( 'Auto-Smushing on Upload', 'wp-smushit' ); ?>
						</h3>
						<p class="smush-benefit-description">
							<?php esc_html_e( 'Optimize all new images as soon as they\'re uploaded, keeping your site fast effortlessly.', 'wp-smushit' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
