<?php
/**
 * Site connected modal.
 *
 * @since 3.22.0
 * @package Smush
 */

use Smush\Core\Membership\Membership;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$feature_list = array(
	__( 'Instant access to Bulk Smush API.', 'wp-smushit' ),
);

if ( Membership::get_instance()->is_pro() ) {
	$feature_list = array_merge(
		$feature_list,
		array(
			__( 'Directory Smush.', 'wp-smushit' ),
			__( 'Next-Gen Conversion.', 'wp-smushit' ),
			__( 'Multisite & CDN Integration.', 'wp-smushit' ),
		)
	);
} else {
	$feature_list = array_merge(
		$feature_list,
		array(
			__( 'Unlimited bulk smushing.', 'wp-smushit' ),
			__( 'Directory Smush.', 'wp-smushit' ),
			__( 'Auto smushing on upload.', 'wp-smushit' ),
		)
	);
}
?>

<div class="sui-modal sui-modal-sm">
	<div
			role="dialog"
			id="smush-hub-connection-success-modal"
			class="sui-modal-content smush-hub-connection-success-modal"
			aria-modal="true"
			aria-labelledby="smush-hub-connection-success-modal-title"
	>
		<div class="sui-box">
			<div class="sui-box-header sui-flatten sui-content-center sui-spacing-top--60">
				<button class="sui-button-icon sui-button-float--right" id="dialog-close-div" data-modal-close="">
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wp-smushit' ); ?></span>
				</button>
				<span class="sui-icon-check-tick sui-success sui-xl" aria-hidden="true"></span>

				<h3 id="smush-hub-connection-success-modal-title" class="sui-box-title sui-lg" style="white-space: inherit">
					<?php esc_html_e( 'Site connected successfully!', 'wp-smushit' ); ?>
				</h3>
			</div>

			<div class="sui-box-body sui-spacing-bottom--30">
				<p style="text-align: center">
					<?php
						echo '<strong>' . esc_html__( 'Congratulations!', 'wp-smushit' ) . ' </strong> ';
						esc_html_e( 'Your site is now successfully connected, unlocking powerful tools to keep your site running smoothly.', 'wp-smushit' );
					?>
				</p>
				<ul>
					<?php foreach ( $feature_list as $feature ) : ?>
					<li>
						<span class="sui-icon-check" aria-hidden="true"></span>
						<?php
							echo esc_html( $feature );
						?>
					</li>
					<?php endforeach; ?>
					</li>
				</ul>
			</div>
			<?php
			$button_text = __( 'Bulk Smush Now', 'wp-smushit' );
			$button_link = $this->get_url( 'smush-bulk&smush-action=start-bulk-smush' );
			if ( is_network_admin() ) {
				$button_text = __( 'Go to Subsite Controls', 'wp-smushit' );
				$button_link = $this->get_url( 'smush-settings&view=permissions' );
			}
			?>
			<div class="sui-box-footer sui-flatten sui-content-center sui-spacing-bottom--50">
				<a href="<?php echo esc_url( $button_link ); ?>" class="sui-button sui-button-blue wp-smush-modal-link-close">
					<span class="sui-button-text-default">
						<?php echo esc_html( $button_text ); ?>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>

<script>
	window.addEventListener("load", function(){
		const modalId = 'smush-hub-connection-success-modal';
		const options = {
			focusAfterClosed: 'wpbody-content',
			focusWhenOpen: undefined,
			hasOverlayMask: true,
			isCloseOnEsc: true,
			isAnimated: true,
		};

		window.SUI.openModal(
			modalId,
			options.focusAfterClosed,
			options.focusWhenOpen,
			options.hasOverlayMask,
			options.isCloseOnEsc,
			options.isAnimated
		);
	});
</script>