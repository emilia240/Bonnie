<?php
/**
 * Disconnect site modal.
 *
 * @since 3.22.0
 * @package Smush
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="sui-modal sui-modal-sm">
	<div
			role="dialog"
			id="smush-disconnect-site-modal"
			class="sui-modal-content smush-disconnect-site-modal"
			aria-modal="true"
			aria-labelledby="smush-disconnect-site-modal-title"
	>
		<div class="sui-box">
			<div class="sui-box-header sui-flatten sui-content-center sui-spacing-top--60">
				<button class="sui-button-icon sui-button-float--right" id="dialog-close-div" data-modal-close="">
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wp-smushit' ); ?></span>
				</button>
				<h3 id="smush-disconnect-site-modal-title" class="sui-box-title sui-lg" style="white-space: inherit">
					<?php esc_html_e( 'Disconnect Site?', 'wp-smushit' ); ?>
				</h3>
				<p class="sui-description"><?php esc_html_e( 'Do you want to disconnect your site from WPMU DEV?', 'wp-smushit' ); ?></p>
			</div>

			<div class="sui-box-body sui-spacing-top--20">
				<div class="sui-notice sui-notice-yellow">
					<div class="sui-notice-content">
						<div class="sui-notice-message">
							<span class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></span>
							<p class="sui-description" style="color:#888888">
								<?php
								printf(
									/* translators: 1: Open strong tag, 2: Close strong tag */
									esc_html__( 'Note that disconnecting your site from %1$sWPMU DEV%2$s will disable other services that rely on this connection.', 'wp-smushit' ),
									'<strong style="color:#888888">',
									'</strong>'
								);
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="sui-box-footer sui-flatten sui-content-center sui-spacing-bottom--40">
				<button type="button" class="sui-button sui-button-ghost" data-modal-close=""><?php esc_html_e( 'Cancel', 'wp-smushit' ); ?></button>

				<button type="button" class="sui-button sui-button-gray" onclick="WP_Smush.adminAjax.disconnectSite(this);">
					<span class="sui-button-text-default">
						<span class="sui-icon-plug-disconnected" aria-hidden="true"></span>
						<?php esc_html_e( 'Disconnect site', 'wp-smushit' ); ?>
				</span>
					<span class="sui-button-text-onload">
						<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
						<?php esc_html_e( 'Disconnect site', 'wp-smushit' ); ?>
					</span>
				</button>
			</div>
		</div>
	</div>
</div>
