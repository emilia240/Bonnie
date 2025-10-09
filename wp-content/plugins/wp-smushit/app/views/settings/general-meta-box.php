<?php
/**
 * General settings meta box.
 *
 * @since 3.0
 * @package WP_Smush
 *
 * @var bool   $detection         Detection settings.
 * @var string $site_language     Site language.
 * @var bool   $tracking          Tracking status.
 * @var string $translation_link  Link to plugin translation page.
 * @var $image_dimensions
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div class="sui-box-settings-row">
	<p>
		<?php esc_html_e( 'Configure general settings for this plugin.', 'wp-smushit' ); ?>
	</p>
</div>

<?php do_action( 'wp_smush_render_general_setting_rows' ); ?>