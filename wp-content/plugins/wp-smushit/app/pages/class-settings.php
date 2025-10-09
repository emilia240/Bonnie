<?php
/**
 * Settings page.
 *
 * @package Smush\App\Pages
 */

namespace Smush\App\Pages;

use Smush\App\Abstract_Page;
use Smush\App\Interface_Page;
use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Settings
 */
class Settings extends Abstract_Page implements Interface_Page {
	/**
	 * Function triggered when the page is loaded before render any content.
	 */
	public function on_load() {
		// Init the tabs.
		$this->tabs = apply_filters(
			'smush_setting_tabs',
			array(
				'general'       => __( 'General', 'wp-smushit' ),
				'configs'        => __( 'Configs', 'wp-smushit' ),
				'permissions'   => __( 'Permissions', 'wp-smushit' ),
				'data'          => __( 'Data & Settings', 'wp-smushit' ),
				'accessibility' => __( 'Accessibility', 'wp-smushit' ),
			)
		);

		// Disabled on all subsites.
		if ( ! is_multisite() || ! is_network_admin() ) {
			unset( $this->tabs['permissions'] );
		}

		add_action( 'smush_setting_column_right_inside', array( $this, 'usage_settings' ), 25, 2 );
		add_action( 'wp_smush_render_general_setting_rows', array( $this, 'render_tracking_settings' ), 40 );
		add_action( 'wp_smush_render_general_setting_rows', array( $this, 'render_image_resize_detection_settings' ), 10 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'detection_settings' ), 25, 2 );
		add_action( 'wp_smush_render_general_setting_rows', array( $this, 'render_translations_settings' ), 20 );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 3.9.0
	 *
	 * @param string $hook Hook from where the call is made.
	 */
	public function enqueue_scripts( $hook ) {
		// Scripts for Configs.
		$this->enqueue_configs_scripts();
	}

	/**
	 * Register meta boxes.
	 */
	public function register_meta_boxes() {
		$this->add_meta_box(
			'settings/general',
			__( 'General', 'wp-smushit' ),
			array( $this, 'general_meta_box' ),
			null,
			array( $this, 'common_meta_box_footer' ),
			'general'
		);

		if ( is_multisite() && is_network_admin() ) {
			$this->add_meta_box(
				'settings/permissions',
				__( 'Permissions', 'wp-smushit' ),
				array( $this, 'permissions_meta_box' ),
				null,
				array( $this, 'common_meta_box_footer' ),
				'permissions'
			);
		}

		$this->add_meta_box(
			'settings/data',
			__( 'Data & Settings', 'wp-smushit' ),
			array( $this, 'data_meta_box' ),
			null,
			array( $this, 'common_meta_box_footer' ),
			'data'
		);

		$this->add_meta_box(
			'settings/accessibility',
			__( 'Accessibility', 'wp-smushit' ),
			array( $this, 'accessibility_meta_box' ),
			null,
			array( $this, 'common_meta_box_footer' ),
			'accessibility'
		);

		if ( 'data' === $this->get_current_tab() ) {
			$this->modals['reset-settings'] = array();
		}
	}

	/**
	 * Display a description in Settings - Usage Tracking.
	 *
	 * @since 3.1.0
	 *
	 * @param string $name  Setting name.
	 */
	public function usage_settings( $name ) {
		// Add only to full size settings.
		if ( 'usage' !== $name ) {
			return;
		}
		?>

		<span class="sui-description sui-toggle-description">
			<?php
			esc_html_e( 'Note: Usage tracking is completely anonymous. We are only tracking what features you are/aren’t using to make our feature decisions more informed.', 'wp-smushit' );
			?>
		</span>
		<?php
	}

	/**
	 * Display a description in Settings - Image Resize Detection.
	 *
	 * @since 3.2.1
	 *
	 * @param string $name  Setting name.
	 */
	public function detection_settings( $name ) {
		// Add only to full size settings.
		if ( 'detection' !== $name ) {
			return;
		}

		$detection_enabled      = $this->settings->get( 'detection' );
		$is_lazyload_enabled    = $this->settings->is_lazyload_active();
		$is_auto_resize_enabled = $this->settings->is_auto_resizing_active();
		$notice_css_class       = '';

		if ( $is_lazyload_enabled && $is_auto_resize_enabled ) {
			$notice_message = esc_html(
				$this->whitelabel->whitelabel_string(
					__( 'Images served via the Automatic Resizing feature will be skipped.', 'wp-smushit' )
				)
			);
		} else {
			$notice_css_class = 'sui-notice-info';
			$notice_message   = sprintf(
			/* translators: %1$s: opening anchor tag, %2$s: closing anchor tag */
				esc_html__(
					'Incorrect image size highlighting is active. %1$sView the frontend%2$s of your website to see if any images aren\'t the correct size for their containers.',
					'wp-smushit'
				),
				'<a href="' . esc_url( home_url() ) . '" target="_blank" rel="noopener">',
				'</a>'
			);
		}

		?>

		<span class="sui-description sui-toggle-description">
			<?php esc_html_e( 'Note: The highlighting will only be visible to administrators – visitors won\'t see the highlighting.', 'wp-smushit' ); ?>

			<div class="sui-notice <?php echo esc_attr( $notice_css_class ); ?> smush-highlighting-notice" <?php echo $detection_enabled ? '' : 'style="display: none;"'; ?>>
				<div class="sui-notice-content">
					<div class="sui-notice-message">
						<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
						<p>
							<?php echo wp_kses_post( $notice_message ); ?>
						</p>
					</div>
				</div>
			</div>

			<?php // Warning notice (shown when detection is checked but not saved). ?>
			<div class="sui-notice sui-notice-warning smush-highlighting-warning" style="display: none;">
				<div class="sui-notice-content">
				<div class="sui-notice-message">
					<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
					<p><?php esc_html_e( 'Almost there! To finish activating this feature you must save your settings.', 'wp-smushit' ); ?></p>
				</div>
				</div>
			</div>
		</span>
		<?php
	}

	/**
	 * Common footer meta box.
	 *
	 * @since 3.2.0
	 */
	public function common_meta_box_footer() {
		$this->view( 'meta-box-footer', array(), 'common' );
	}

	/**
	 * General settings meta box.
	 */
	public function general_meta_box() {
		$this->view( 'settings/general-meta-box' );
	}

	/**
	 * Permissions meta box.
	 */
	public function permissions_meta_box() {
		$this->view(
			'settings/permissions-meta-box',
			array(
				'networkwide' => get_site_option( 'wp-smush-networkwide' ),
			)
		);
	}

	/**
	 * Data & Settings meta box.
	 */
	public function data_meta_box() {
		$this->view(
			'settings/data-meta-box',
			array(
				'keep_data' => (bool) $this->settings->get( 'keep_data' ),
			)
		);
	}

	/**
	 * Accessibility meta box.
	 */
	public function accessibility_meta_box() {
		$this->view(
			'settings/accessibility-meta-box',
			array(
				'accessible_colors' => (bool) $this->settings->get( 'accessible_colors' ),
			)
		);
	}

	/**
	 * Render image resize detection settings.
	 *
	 * @return void
	 */
	public function render_image_resize_detection_settings() {
		do_action( 'wp_smush_render_setting_row', 'detection', $this->settings->get( 'detection' ) );
	}

	/**
	 * Render translations settings.
	 *
	 * @return void
	 */
	public function render_translations_settings() {
		$translation_link = WP_Smush::is_pro() ? 'https://wpmudev.com/translate/projects/wp-smushit/' : 'https://translate.wordpress.org/projects/wp-plugins/wp-smushit';

		$site_locale = get_locale();

		if ( 'en' === $site_locale || 'en_US' === $site_locale ) {
			$site_language = 'English';
		} else {
			require_once ABSPATH . 'wp-admin/includes/translation-install.php';
			$translations  = wp_get_available_translations();
			$site_language = isset( $translations[ $site_locale ] ) ? $translations[ $site_locale ]['native_name'] : __( 'Error detecting language', 'wp-smushit' );
		}
		?>
		<div class="sui-box-settings-row" id="general-translations-settings-row">
			<div class="sui-box-settings-col-1">
				<span class="sui-settings-label "><?php esc_html_e( 'Translations', 'wp-smushit' ); ?></span>
				<span class="sui-description">
					<?php
					printf( /* translators: %1$s: opening a tag, %2$s: closing a tag */
						esc_html__( 'By default, Smush will use the language you’d set in your %1$sWordPress Admin Settings%2$s if a matching translation is available.', 'wp-smushit' ),
						'<a href="' . esc_html( admin_url( 'options-general.php' ) ) . '">',
						'</a>'
					);
					?>
				</span>
			</div>
			<div class="sui-box-settings-col-2">
				<div class="sui-form-field">
					<label for="language-input" class="sui-label">
						<?php esc_html_e( 'Active Translation', 'wp-smushit' ); ?>
					</label>
					<input type="text" id="language-input" class="sui-form-control" disabled="disabled" placeholder="<?php echo esc_attr( $site_language ); ?>">
					<span class="sui-description">
						<?php
						if ( ! apply_filters( 'wpmudev_branding_hide_doc_link', false ) ) {
							printf(
							/* translators: %1$s: opening a tag, %2$s: closing a tag */
								esc_html__( 'Not using your language, or have improvements? Help us improve translations by providing your own improvements %1$shere%2$s.', 'wp-smushit' ),
								'<a href="' . esc_html( $translation_link ) . '" target="_blank">',
								'</a>'
							);
						}
						?>
					</span>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render tracking settings.
	 *
	 * @return void
	 */
	public function render_tracking_settings() {
		do_action( 'wp_smush_render_setting_row', 'usage', $this->settings->get( 'usage' ) );
	}
}
