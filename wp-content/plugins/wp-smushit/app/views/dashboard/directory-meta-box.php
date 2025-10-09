<?php
/**
 * Directory compress meta box.
 *
 * @since 3.8.6
 * @package WP_Smush
 *
 * @var array $images  Array of images with errors.
 * @var int   $errors  Number of errors.
 *
 * @var Smush\App\Abstract_Page $this  Dashboard page.
 */

use Smush\Core\Directory\Directory_UI_Controller;

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<p>
	<?php esc_html_e( 'In addition to smushing your media uploads, you may want to smush non WordPress images that are outside of your uploads directory. Get started by adding files and folders you wish to optimize.', 'wp-smushit' ); ?>
</p>

<?php if ( ! empty( $images ) ) : ?>
	<?php
	$directory_smush_ui_controller = new Directory_UI_Controller();
	$directory_smush_ui_controller->render_scan_result( 20 );
	?>
	<a href="<?php echo esc_url( $this->get_url( 'smush-bulk' ) ); ?>&smush__directory-scan=done#directory_smush-settings-row" class="sui-button sui-button-ghost" style="margin-top: 30px;">
		<span class="sui-icon-eye" aria-hidden="true"></span>
		<?php esc_html_e( 'View All', 'wp-smushit' ); ?>
	</a>
<?php else : ?>
	<a href="<?php echo esc_url( $this->get_url( 'smush-bulk' ) ); ?>&smush__directory-start#directory_smush-settings-row" class="sui-button sui-button-blue">
		<?php esc_html_e( 'Choose Directory', 'wp-smushit' ); ?>
	</a>
<?php endif; ?>
