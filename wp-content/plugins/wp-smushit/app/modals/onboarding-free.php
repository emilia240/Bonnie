<?php
/**
 * Onboarding modal.
 *
 * @since 3.1
 * @package WP_Smush
 *
 * @var $cta_url    string CTA URL.
 */

use Smush\Core\Helper;
use Smush\Core\Array_Utils;
use Smush\Core\Hub_Connector;
use Smush\Core\Media\Media_Item_Query;
use Smush\Core\Membership\Membership;
use Smush\Core\Settings;

if ( ! defined( 'WPINC' ) ) {
	die;
}

$array_utils = new Array_Utils();
$setup_steps = array(
	'tracking'    => array(
		'heading'     => __( 'Ready To Speed Up Your Site?', 'wp-smushit' ),
		'description' => __( 'Let’s scan your Media Library to find the hefty images slowing things down, so Smush can work its optimizing magic.', 'wp-smushit' ),
		'fields'      => array(
			'usage' => array(
				'label'   => __( 'Help us make Smush better for everyone', 'wp-smushit' ),
				'default' => false,
				'tooltip' => __( 'Enable anonymous tracking to boost plugin performance. No personal data collected.', 'wp-smushit' ),
			),
		),
	),
	'scan_completed'     => array(
		'heading'     => __( 'Yup, Your Site Could Definitely Be Faster', 'wp-smushit' ),
		'description' => __( 'Based on the scan results, we can potentially reduce file sizes and improve the site speed.', 'wp-smushit' ),
		'fields'      => array(),
	),
	'configure' => array(
		'heading'     => __( 'First, Let’s Check Your Settings', 'wp-smushit' ),
		'description' => __( 'We recommend enabling these features for best performance.', 'wp-smushit' ),
		'fields'      => array(
			'lossy'                => array(
				'label'         => __( 'Super Smush', 'wp-smushit' ),
				'default'       => true,
				'tooltip'       => __( 'Compress images up to 2x more than regular smush with multi-pass lossy compression.', 'wp-smushit' ),
			),
			'auto'                 => array(
				'label'         => __( 'Automatic Compression', 'wp-smushit' ),
				'default'       => true,
				'tooltip'       => __( 'Automatically optimize and compress images you upload to your site.', 'wp-smushit' ),
			),
			'lazy_load'            => array(
				'label'         => __( 'Lazy Load', 'wp-smushit' ),
				'default'       => true,
				'tooltip'       => __( 'Delay loading off-screen images until visitors scroll to them. Make your page load faster, use less bandwidth, and fix "Defer offscreen images" Google PSI audit.', 'wp-smushit' ),
			),
			'compress_backup'  => array(
				'label'         => __( 'Compress & Backup my Original Images', 'wp-smushit' ),
				'default'       => true,
				'tooltip'       => __( 'Smush compresses your original images — helpful if your theme serves full-size images.', 'wp-smushit' ),
			),
			'ultra'                => array(
				'label'         => __( '5x Compression with Ultra', 'wp-smushit' ),
				'is_pro_feature' => true,
				'tooltip'       => __( '5x image compression for faster-loading pages.', 'wp-smushit' ),
			),
			'nextgen_cdn'          => array(
				'label'         => __( 'Next-Gen Conversion & Global Edge CDN', 'wp-smushit' ),
				'is_pro_feature' => true,
				'tooltip'       => __( 'One-click WebP and AVIF conversion for superior performance, plus a global CDN with 119 locations for instant worldwide delivery.', 'wp-smushit' ),
			),
		),
	),
	'finish'   => array(
		'heading'     => __( 'You’re Almost There!', 'wp-smushit' ),
		'description' => __( 'To start smushing your images, create a free WPMU DEV account — quick and easy, no credit card required & no fiddly API key copy-pasting involved.', 'wp-smushit' ),
		'fields'      => array(),
	),
);

if ( Membership::get_instance()->has_access_to_hub() ) {
	unset( $setup_steps['finish'] );
}

/**
 * Body content for tracking slide.
 *
 * @param Array_Utils $array_utils.
 * @param mixed       $setup_steps Array of setup_steps.
 * @return void
 */
function smush_onboarding_tracking_body( $array_utils, $setup_steps ) {
	$should_show_tracking_confirmation = ! is_multisite();
	?>
	<?php if ( $should_show_tracking_confirmation ) : ?>
		<div class="smush-onboarding-tracking-box">
			<label for="usage" class="sui-toggle" style="display:inline-block;width:auto;">
				<input type="checkbox" id="usage" aria-labelledby="usage-label"	<# if ( data.fields.usage ) { #>checked<# } #>/>
				<span class="sui-toggle-slider" aria-hidden="true"> </span>
				<strong id="usage-label" class="sui-toggle-label" style="text-align: left;">
					<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'tracking', 'fields', 'usage', 'label' ) ) ); ?>
				</strong>
			</label>
			<span style="position:relative;top:3px;" class="sui-tooltip sui-tooltip-top-right sui-tooltip-constrained" data-tooltip="<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'tracking', 'fields', 'usage', 'tooltip' ) ) ); ?>">
				<span class="sui-icon-info" aria-hidden="true"></span>
			</span>
		</div>
	<?php endif; ?>
	<a class="sui-button sui-button-blue sui-button-icon-right next" onclick="WP_Smush.onboarding.next(this);" >
		<?php esc_html_e( 'Start Scan', 'wp-smushit' ); ?>
		<i class="sui-icon-chevron-right" aria-hidden="true"> </i>
	</a>
	<?php
}

/**
 * Body content for scan slide.
 */
function smush_onboarding_scan_completed_body() {
	$media_item_query = new Media_Item_Query();
	$attachment_count = (int) $media_item_query->get_image_attachment_count();
	$smushed_count    = (int) $media_item_query->get_smushed_count();
	$remaining_count  = $attachment_count - $smushed_count;
	?>
	<div class="smush-onboarding-scan" style="max-width:360px;margin:-15px auto 0;">
		<div class="smush-onboarding-scan-content">
			<div class="progress-bar-wrapper">
				<div class="sui-progress">
					<span class="sui-progress-icon" aria-hidden="true">
					<span class="sui-icon-loader sui-loading"></span>
				</span>
				<span class="sui-progress-text" aria-live="polite">0%</span>
					<div class="sui-progress-bar" aria-hidden="true">
						<span style="width:0%"></span>
					</div>
				</div>
			</div>
			<div class="scan-stats sui-hidden">
				<div class="sui-description">
					<?php
					if ( $remaining_count ) {
						/* translators: %s - seconds remaining */
						printf( esc_html__( 'Smush found %s image attachments that can be optimized to reduce file size and improve site speed.', 'wp-smushit' ), (int) $remaining_count );
					} else {
						esc_html_e( 'Smush found 0 image attachments that can be optimized.', 'wp-smushit' );
					}
					?>
				</div>
				<ul>
					<li><span class="sui-icon-check" aria-hidden="true"></span><?php esc_html_e( 'Save up to 30% in file size with zero quality loss.', 'wp-smushit' ); ?></li>
					<li><span class="sui-icon-check" aria-hidden="true"></span><?php esc_html_e( 'Boost Core Web Vitals (LCP & CLS).', 'wp-smushit' ); ?></li>
				</ul>
			</div>
		</div>
		<a class="sui-button sui-button-blue next" onclick="WP_Smush.onboarding.next(this)" >
			<?php esc_html_e( 'Configure Smush', 'wp-smushit' ); ?>
		</a>
	</div>
	<?php
}


/**
 * Body content for configure slide.
 *
 * @param Array_Utils $array_utils.
 * @param mixed       $setup_steps Array of setup_steps.
 * @return void
 */
function smush_onboarding_configure_body( $array_utils, $setup_steps ) {
	$fields      = $array_utils->get_array_value( $setup_steps, array( 'configure', 'fields' ), array() );
	$upsell_url = Helper::get_utm_link(
		array(
			'utm_campaign' => 'smush_wizard',
			'utm_content'  => 'view_plans_wizard',
		)
	);
	?>
	<div class="smush-onboarding-configure">
		<div class="sui-field-list">
			<div class="sui-field-list-body">
				<?php
				foreach ( $fields as $name => $field ) :
					$is_checked     = ! empty( $field['default'] );
					$is_pro_feature = ! empty( $field['is_pro_feature'] );
					?>
				<div class="sui-field-list-item">
					<label
						class="sui-field-list-item-label"
						for="<?php echo esc_attr( $name ); ?>"
					>
						<?php echo esc_html( $field['label'] ); ?>
						<button class="sui-button-icon sui-tooltip sui-tooltip-top-center sui-tooltip-constrained" data-tooltip="<?php echo esc_html( $field['tooltip'] ); ?>">
							<span class="sui-icon-info" aria-hidden="true"></span>
						</button>
					</label>
					<?php if ( $is_pro_feature ) : ?>
						<span class="sui-tag sui-tag-pro" data-pro-feature="<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Pro', 'wp-smushit' ); ?></span>
					<?php else : ?>
					<label class="sui-toggle">
						<input type="checkbox" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" <# if ( data.fields.<?php echo esc_attr( $name ); ?> ) { #>checked<# } #> />
						<span class="sui-toggle-slider"></span>
					</label>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="smush-onboarding-buttons">
			<div>
			<?php if ( Membership::get_instance()->has_access_to_hub() ) : ?>
				<?php if ( Settings::get_instance()->has_bulk_smush_page() ) : ?>
					<button type="submit" class="sui-button sui-button-blue next" style="width:100%">
						<?php $cta_label = is_network_admin() ? __( 'Go To Bulk Smush', 'wp-smushit' ) : __( 'Bulk Smush Now', 'wp-smushit' ); ?>
						<span class="sui-button-text-default">
							<?php echo esc_html( $cta_label ); ?>
						</span>

						<span class="sui-button-text-onload">
							<span
								class="sui-icon-loader sui-loading"
								aria-hidden="true"
							></span>
							<?php echo esc_html( $cta_label ); ?>
						</span>
					</button>
				<?php endif; ?>
			<?php else : ?>
					<a class="sui-button sui-button-blue next" style="width:100%;" onclick="WP_Smush.onboarding.next(this)" >
						<?php esc_html_e( 'SET UP MY FREE ACCOUNT', 'wp-smushit' ); ?>
					</a>
			<?php endif; ?>
			</div>
			<?php if ( ! Membership::get_instance()->is_pro() ) : ?>
			<a class="smush-upsell-link smush-btn-pro-upsell" style="font-size:11px" target="_blank" href="<?php echo esc_url( $upsell_url ); ?>">
				<?php
				/* translators: %s: plugin discount */
				esc_html_e( 'What can I get with Smush Pro?', 'wp-smushit' );
				?>
			</a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Body content for finish slide.
 */
function smush_onboarding_finish_body() {
	?>
	<div class="smush-onboarding-finish" style="max-width:400px;margin:0 auto;">
		<div class="smush-onboarding-finish-content">
			<h3><?php esc_html_e( 'When you connect, you’ll get:', 'wp-smushit' ); ?></h3>
			<ul>
				<li><span class="sui-icon-check-tick" aria-hidden="true"></span><?php esc_html_e( 'Instant access to Bulk Smush API.', 'wp-smushit' ); ?></li>
				<li><span class="sui-icon-check-tick" aria-hidden="true"></span><?php esc_html_e( 'Unlimited bulk smushing.', 'wp-smushit' ); ?></li>
				<li><span class="sui-icon-check-tick" aria-hidden="true"></span><?php esc_html_e( 'Directory Smush.', 'wp-smushit' ); ?></li>
				<li><span class="sui-icon-check-tick" aria-hidden="true"></span><?php esc_html_e( 'Auto smushing on upload.', 'wp-smushit' ); ?></li>
			</ul>
		</div>
		<button class="sui-button sui-button-blue smush-button-dark-blue next" type="submit" >
			<span class="sui-button-text-default">
				<?php esc_html_e( 'CONNECT MY SITE', 'wp-smushit' ); ?>
			</span>

			<span class="sui-button-text-onload">
				<span
					class="sui-icon-loader sui-loading"
					aria-hidden="true"
				></span>
				<?php esc_html_e( 'CONNECT MY SITE', 'wp-smushit' ); ?>
			</span>
		</button>
	</div>
	<?php
}

$onboarding_slide_keys  = array_keys( $setup_steps );
$onboarding_slide_fields = array_reduce(
	$setup_steps,
	function ( $fields, $step ) {
		if ( isset( $step['fields'] ) && is_array( $step['fields'] ) ) {
			foreach ( $step['fields'] as $key => $field ) {
				if ( ! empty( $field['is_pro_feature'] ) ) {
					continue;
				}
				$fields[ $key ] = ! empty( $field['default'] );
			}
		}
		return $fields;
	},
	array()
);
?>
<script>
	var onBoardingData = {
		slideKeys: <?php echo wp_json_encode( $onboarding_slide_keys ); ?>,
		slideFields: <?php echo wp_json_encode( $onboarding_slide_fields ); ?>,
		connectSiteUrl: <?php echo wp_json_encode( Hub_Connector::get_connect_site_url( 'smush-bulk', 'smush_wizard_connect' ) ); ?>,
		startBulkSmushURL: <?php echo wp_json_encode( $this->get_url( 'smush-bulk&smush-action=start-bulk-smush' ) ); ?>,
		isSiteConnected: <?php echo Membership::get_instance()->has_access_to_hub() ? 'true' : 'false'; ?>
	};
</script>

<script type="text/template" id="smush-onboarding-free" data-cta-url="<?php echo esc_js( $cta_url ); ?>">
	<div class="sui-box-header sui-flatten sui-content-center sui-spacing-sides--90">
		<?php if ( ! apply_filters( 'wpmudev_branding_hide_branding', false ) ) : ?>
		<figure class="sui-box-banner" aria-hidden="true">
			<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/onboarding-free/graphic-onboarding-' ); ?>{{{ data.slide }}}.png"
				srcset="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/onboarding-free/graphic-onboarding-' ); ?>{{{ data.slide }}}.png 1x, <?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/onboarding-free/graphic-onboarding-' ); ?>{{{ data.slide }}}@2x.png 2x"
				alt="<?php esc_attr_e( 'Smush Onboarding Modal', 'wp-smushit' ); ?>" class="sui-image sui-image-center"
			>
		</figure>
		<?php endif; ?>
		<!-- Heading -->
		<h3 class="sui-box-title sui-lg" id="smush-title-onboarding-dialog" style="white-space: normal;">
			<# if ( 'tracking' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'tracking', 'heading' ) ) ); ?>
			<# } else if ( 'scan_completed' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'scan_completed', 'heading' ) ) ); ?>
			<# } else if ( 'configure' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'configure', 'heading' ) ) ); ?>
			<# } else if ( 'finish' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'finish', 'heading' ) ) ); ?>
			<# } #>
		</h3>
		<!-- End Heading -->
		<!-- Description -->
		<p class="sui-description" id="smush-description-onboarding-dialog">
			<# if ( 'tracking' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'tracking', 'description' ) ) ); ?>
			<# } else if ( 'scan_completed' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'scan_completed', 'description' ) ) ); ?>
			<# } else if ( 'configure' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'configure', 'description' ) ) ); ?>
			<# } else if ( 'finish' === data.slide ) { #>
			<?php echo esc_html( $array_utils->get_array_value( $setup_steps, array( 'finish', 'description' ) ) ); ?>
			<# } #>
		</p>
		<!-- End Description -->
	</div>

	<!-- Main body -->
	<div class="sui-box-body sui-content-center sui-spacing-sides--0">
		<# if ( 'tracking' === data.slide ) { #>
			<?php smush_onboarding_tracking_body( $array_utils, $setup_steps ); ?>
		<# } else if( 'scan_completed' === data.slide ) { #>
			<?php smush_onboarding_scan_completed_body(); ?>
		<# } else if( 'configure' === data.slide ) { #>
			<?php smush_onboarding_configure_body( $array_utils, $setup_steps ); ?>
		<# } else if( 'finish' === data.slide ) { #>
			<?php smush_onboarding_finish_body( $array_utils, $setup_steps ); ?>
		<# } #>

		<div class="smush-onboarding-arrows">
			<a href="#" class="previous <# if ( data.first ) { #>sui-hidden<# } #>" onclick="WP_Smush.onboarding.next(this)">
				<i class="sui-icon-chevron-left" aria-hidden="true"> </i>
			</a>
			<a href="#" class="next <# if ( data.last ) { #>sui-hidden<# } #>" onclick="WP_Smush.onboarding.next(this)">
				<i class="sui-icon-chevron-right" aria-hidden="true"> </i>
			</a>
		</div>
	</div>
	<!-- End Main body -->
	 
	<!-- Footer -->
	<div class="sui-box-footer sui-flatten sui-content-center">
		<div class="sui-box-steps sui-sm">
			<button onclick="WP_Smush.onboarding.goTo('tracking')" class="<# if ( 'tracking' === data.slide ) { #>sui-current<# } #>" <# if ( 'tracking' === data.slide ) { #>disabled<# } #>>
				<?php esc_html_e( 'First step', 'wp-smushit' ); ?>
			</button>
			<button onclick="WP_Smush.onboarding.goTo('scan_completed')" class="<# if ( 'scan_completed' === data.slide ) { #>sui-current<# } #>" <# if ( 'scan_completed' === data.slide ) { #>disabled<# } #>>
				<?php esc_html_e( 'Scan_completed', 'wp-smushit' ); ?>
			</button>
			<button onclick="WP_Smush.onboarding.goTo('configure')" class="<# if ( 'configure' === data.slide ) { #>sui-current<# } #>" <# if ( 'configure' === data.slide ) { #>disabled<# } #>>
				<?php esc_html_e( 'Configure', 'wp-smushit' ); ?>
			</button>
			<?php if ( isset( $setup_steps['finish'] ) ) : ?>
			<button onclick="WP_Smush.onboarding.goTo('finish')" class="<# if ( 'finish' === data.slide ) { #>sui-current<# } #>" <# if ( 'finish' === data.slide ) { #>disabled<# } #>>
				<?php esc_html_e( 'Finish', 'wp-smushit' ); ?>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<!-- End Footer -->
</script>

<div class="sui-modal sui-modal-md">
	<div
		role="dialog"
		id="smush-onboarding-dialog"
		class="sui-modal-content smush-onboarding-dialog"
		aria-modal="true"
		aria-labelledby="smush-title-onboarding-dialog"
		aria-describedby="smush-description-onboarding-dialog"
	>
		<div class="sui-box">
			<div id="smush-onboarding-content" aria-live="polite"></div>
			<input type="hidden" id="smush_quick_setup_nonce" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'smush_quick_setup' ) ); ?>">
		</div>
		<button class="sui-modal-skip smush-onboarding-skip-link">
			<?php esc_html_e( 'Skip this, I’ll set it up later', 'wp-smushit' ); ?>
		</button>
	</div>
</div>
