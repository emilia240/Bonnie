<?php
/**
 * Bulk Smush Hub connection notice.
 *
 * @since 3.22.0
 * @package WP_Smush
 *
 * @var string $hub_connect_url Hub Connect URL.
 */

?>
<div class="sui-notice sui-notice-blue" style="margin-top: 10px">
	<div class="sui-notice-content smush-content-dark-blue">
		<div class="sui-notice-message">
			<i class="sui-notice-icon sui-icon-info sui-md smush-icon-dark-blue" aria-hidden="true"></i>
			<p>
				<?php
				esc_html_e( 'A free WPMU DEV connection is required to use Bulk Smush. Takes seconds to set up — no credit card needed.', 'wp-smushit' );
				?>
			</p>
			<p>
				<a class="sui-button sui-button-blue smush-button-dark-blue" href="<?php echo esc_url( $hub_connect_url ); ?>"><?php esc_html_e( 'Connect For free', 'wp-smushit' ); ?></a>
			</p>
		</div>
	</div>
</div>
