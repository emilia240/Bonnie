<?php
/**
 * Compress directory class.
 *
 * @package Smush\App
 */

namespace Smush\Core\Directory;

use Smush\Core\Controller;
use Smush\Core\Core;
use Smush\Core\Settings;
use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Directory_UI_Controller
 */
class Directory_UI_Controller extends Controller {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Register the modals.
		$this->register_filter( 'wp_smush_modals', array( $this, 'register_modals' ) );
		// Add the directory smush description into Bulk Smush settings.
		$this->register_action( 'smush_setting_column_right_outside', array( $this, 'directory_smush_description' ), 25 );
		$this->register_action( 'wp_smush_after_page_header', array( $this, 'show_directory_smush_move_notice' ) );
		$this->register_filter( 'wp_smush_settings', array( $this, 'add_directory_smush_field' ) );
	}

	/**
	 * Check if the directory smush module should run.
	 *
	 * @return bool
	 */
	public function should_run() {
		return Settings::get_instance()->is_directory_smush_active();
	}

	/**
	 * Register Choose Directory modal and progres dialog.
	 */
	public function register_modals( $modals ) {
		$modals['directory-list']  = array();
		$modals['progress-dialog'] = array();

		return $modals;
	}

	/**
	 * Add Directory Smush field to Bulk Smush settings.
	 *
	 * @param array $settings Bulk Smush settings.
	 * @return array
	 */
	public function add_directory_smush_field( $settings ) {
		$settings['directory_smush'] = array(
			'label'       => esc_html__( 'Directory Smush', 'wp-smushit' ),
			'short_label' => esc_html__( 'Directory Smush', 'wp-smushit' ),
			'desc'        => esc_html__( 'Select a directory outside your Media Library to automatically Bulk Smush its images.', 'wp-smushit' ),
		);

		return $settings;
	}

	/**
	 * Add Directory Smush description.
	 *
	 * @param mixed $setting_key Setting key.
	 * @return void
	 */
	public function directory_smush_description( $setting_key ) {
		if ( 'directory_smush' !== $setting_key ) {
			return;
		}

		// Reset the bulk limit transient.
		if ( ! WP_Smush::is_pro() ) {
			Core::check_bulk_limit( true, 'dir_sent_count' );
		}
		?>
		<div class="wp-smush-scan-result">
			<div class="sui-message-content" style="margin-bottom:10px">
				<button class="sui-button sui-button-ghost wp-smush-browse">
					<span class="sui-icon-folder" aria-hidden="true"></span><?php esc_html_e( 'Choose directory to smush', 'wp-smushit' ); ?>
				</button>
			</div>
			<!-- Notices -->
			<?php $this->show_header_notice(); ?>
			<?php
			$scan = filter_input( INPUT_GET, 'smush__directory-scan', FILTER_SANITIZE_SPECIAL_CHARS );
			$should_render_result = 'done' === $scan;
			if ( $should_render_result ) {
				$this->render_scan_result();
			}

			// Load nonce for the bulk smush.
			wp_nonce_field( 'wp_smush_all', 'wp-smush-all' );
		?>
		</div>
		<?php
	}

	/**
	 * Render the scan result.
	 *
	 * @param int $limit Limit count.
	 * @return void
	 */
	public function render_scan_result( $limit = 50 ) {
		$core   = WP_Smush::get_instance()->core();
		$images = $core->mod->dir->get_image_errors( $limit );
		$errors = $core->mod->dir->get_image_errors_count();
		?>
		<?php if ( ! empty( $images ) ) : ?>
			<div class="sui-notice sui-notice-warning" style="margin-bottom: -15px;">
				<div class="sui-notice-content">
					<div class="sui-notice-message">
						<span class="sui-notice-icon sui-icon-warning-alert sui-md" aria-hidden="true"></span>
						<p>
							<?php
							printf( /* translators: %d - number of failed images */
								esc_html__( "%d images failed to be optimized. This is usually because they no longer exist, or we can't optimize the file format.", 'wp-smushit' ),
								(int) $errors
							);
							?>
						</p>
					</div>
				</div>
			</div>
			<div class="smush-final-log">
				<div class="smush-bulk-error-header">
					<div class="smush-bulk-error-row">
						<div class="smush-bulk-image-data">
							<div class="smush-bulk-image-title">
								<?php esc_html_e( 'File Name', 'wp-smushit' ); ?>
							</div>
							<span class="smush-image-error"><?php esc_html_e( 'Status', 'wp-smushit' ); ?></span>
						</div>
					</div>
				</div>
				<div class="smush-bulk-errors">
					<?php foreach ( $images as $id => $image ) :
						$tooltip_position = $id > 0 ? 'top' : 'bottom';
						?>
						<div class="smush-bulk-error-row">
							<div class="smush-bulk-image-data">
								<div class="smush-bulk-image-title">
									<i class="sui-icon-photo-picture" aria-hidden="true"></i>
									<span class="smush-image-name sui-tooltip sui-tooltip-<?php echo esc_attr( $tooltip_position ); ?>-left" data-tooltip="<?php echo esc_html( $image['path'] ); ?>"><?php echo esc_html( basename( $image['path'] ) ); ?></span>
								</div>
								<div class="smush-image-error"><?php echo esc_html( $image['error'] ); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( $errors > 50 ) : ?>
					<p class="sui-description" style="margin-top: 10px;">
						<?php
						printf( /* translators: %d: number of images with errors */
							esc_html__( 'Showing 50 of %d failed optimizations. Fix or remove these images and run another Directory Smush.', 'wp-smushit' ),
							absint( $errors )
						);
						?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif;
	}

	/**
	 * Show directory smush result notice.
	 *
	 * If we are redirected from a directory smush finish page,
	 * show the result notice if success/fail count is available.
	 *
	 * @since 2.9.0
	 */
	public function show_header_notice() {
		// Get the counts from transient.
		$items          = (int) get_transient( 'wp-smush-show-dir-scan-notice' );
		$failed_items   = (int) get_transient( 'wp-smush-dir-scan-failed-items' );
		$skipped_items  = (int) get_transient( 'wp-smush-dir-scan-skipped-items' ); // Skipped because already optimized.
		$notice_message = esc_html__( 'Image compression complete.', 'wp-smushit' ) . ' ';
		$notice_class   = 'error';

		$total = $items + $failed_items + $skipped_items;

		/**
		 * 1 image was successfully optimized / 10 images were successfully optimized
		 * 1 image was skipped because it was already optimized / 5/10 images were skipped because they were already optimized
		 * 1 image resulted in an error / 5/10 images resulted in an error, check the logs for more information
		 *
		 * 2/10 images were skipped because they were already optimized and 4/10 resulted in an error
		 */

		if ( 0 === $failed_items && 0 === $skipped_items ) {
			$notice_message .= sprintf(
			/* translators: %d - number of images */
				_n(
					'%d image was successfully optimized',
					'%d images were successfully optimized',
					$items,
					'wp-smushit'
				),
				$items
			);
			$notice_class = 'success';
		} elseif ( 0 <= $skipped_items && 0 === $failed_items ) {
			$notice_message .= sprintf(
			/* translators: %1$d - number of skipped images, %2$d - total number of images */
				_n(
					'%1$d/%2$d image was skipped because it was already optimized',
					'%1$d/%2$d images were skipped because they were already optimized',
					$skipped_items,
					'wp-smushit'
				),
				$skipped_items,
				$total
			);
			$notice_class = 'success';
		} elseif ( 0 === $skipped_items && 0 <= $failed_items ) {
			$notice_message .= sprintf(
			/* translators: %1$d - number of failed images, %2$d - total number of images */
				_n(
					'%1$d/%2$d image resulted in an error',
					'%1$d/%2$d images resulted in an error, check the logs for more information',
					$failed_items,
					'wp-smushit'
				),
				$failed_items,
				$total
			);
		} elseif ( 0 <= $skipped_items && 0 <= $failed_items ) {
			$notice_message .= sprintf(
			/* translators: %1$d - number of skipped images, %2$d - total number of images, %3$d - number of failed images */
				esc_html__( '%1$d/%2$d images were skipped because they were already optimized and %3$d/%2$d images resulted in an error', 'wp-smushit' ),
				$skipped_items,
				$total,
				$failed_items
			);
			$notice_class = 'warning';
		}

		// If we have counts, show the notice.
		if ( 0 < $total ) {
			// Delete the transients.
			delete_transient( 'wp-smush-show-dir-scan-notice' );
			delete_transient( 'wp-smush-dir-scan-failed-items' );
			delete_transient( 'wp-smush-dir-scan-skipped-items' );
			?>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					window.SUI.openNotice(
						'wp-smush-ajax-notice',
						'<p><?php echo wp_kses_post( $notice_message ); ?></p>',
						{
							type: '<?php echo esc_attr( $notice_class ); ?>',
							icon: 'info',
							dismiss: {
								show: true,
								label: '<?php esc_html_e( 'Dismiss', 'wp-smushit' ); ?>',
								tooltip: '<?php esc_html_e( 'Dismiss', 'wp-smushit' ); ?>',
							},
						}
					);
				});
			</script>
			<?php
		}
	}

	public function show_directory_smush_move_notice() {
		$smush_admin   = WP_Smush::get_instance()->admin();
		$notice_hidden = $smush_admin->is_notice_dismissed( 'directory-smush-move' );

		if ( $notice_hidden ) {
			return;
		}
		?>
		<div class="is-dismissible smush-dismissible-notice" data-key="directory-smush-move" style="margin-bottom: 30px">
			<div class="sui-notice sui-notice-blue">
				<div class="sui-notice-content">
					<div class="sui-notice-message">
						<span class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></span>
						<p>
							<?php printf(
								/* translators: 1: Open strong tag, 2: Closing strong tag */
								esc_html__( '%1$sDirectory Smush%2$s has moved to the Bulk Smush page. We\'ve also organized advanced options into a new Advanced Settings section for an easier experience.', 'wp-smushit' ),
								'<strong>',
								'</strong>'
							); ?>
						</p>
					</div>
					<div class="sui-notice-actions">
						<button class="sui-button-icon smush-dismiss-notice-button" type="button">
							<span class="sui-icon-check" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Dismiss this notice', 'wp-smushit' ); ?></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
