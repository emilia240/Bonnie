<?php
/**
 * Hub_Connector class.
 *
 * @package Smush
 */

namespace Smush\Core;

use Smush\Core\Membership\Membership;
use WPMUDEV\Hub\Connector\API;
use WPMUDEV_Dashboard;
use WPMUDEV\Hub\Connector;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Hub_Connector
 *
 * Handles Hub connection functionality for the Smush plugin.
 */
class Hub_Connector extends Controller {

	/**
	 * The identifier for the Smush plugin in the Hub.
	 *
	 * @const string
	 */
	public const PLUGIN_IDENTIFIER = 'smush';

	/**
	 * The action name used for the Hub connection.
	 *
	 * @const string
	 */
	public const CONNECTION_ACTION = 'hub_connection';

	/**
	 * Valid screens for the Hub Connector.
	 *
	 * @var array
	 */
	private static array $valid_screens = array(
		'smush_page_smush-bulk',
		'smush-pro_page_smush-bulk',
		'smush_page_smush-bulk-network',
		'smush-pro_page_smush-bulk-network',
	);

	/**
	 * Array utilities instance.
	 *
	 * @var Array_Utils
	 */
	private $array_utils;

	/**
	 * Hub_Connector constructor.
	 *
	 * Private constructor to enforce singleton pattern.
	 */
	public function __construct() {
		$this->initialize();
		$this->array_utils = new Array_Utils();

		$this->register_action( 'wpmudev_hub_connector_first_sync_completed', array( $this, 'sync_after_connect' ) );
		$this->register_filter( 'wp_smush_modals', array( $this, 'register_hub_connection_success_modal' ) );
		$this->register_filter( 'pre_site_option_wp-smush-networkwide', array( $this, 'disable_subsite_controls_for_unconnected_free_users' ) );
		$this->register_action( 'wp_smush_render_general_setting_rows', array( $this, 'render_hub_connector_actions' ), 30 );
		$this->register_filter( 'wp_smush_localize_script_messages', array( $this, 'add_site_disconnected_success_message' ) );
		$this->register_action( 'wp_ajax_wp_smush_disconnect_site', array( $this, 'ajax_disconnect_site' ) );

		if ( ! self::is_connection_flow() ) {
			return;
		}

		$this->register_action( 'admin_body_class', array( $this, 'admin_body_class' ), 11 );
		$this->register_action( 'wpmudev_hub_connector_localize_text_vars', array( $this, 'customize_text_vars' ), 10, 2 );
		$this->register_filter( 'wpmudev_hub_connector_localize_vars', array( $this, 'add_hub_connector_data' ), 10, 2 );
	}

	/**
	 * Initialize the Hub Connector module and set its options.
	 *
	 * @return void
	 */
	private function initialize(): void {
		$this->load_hub_connector_library();
		$this->configure_hub_connector();
	}

	/**
	 * Add Hub Connector specific classes to admin body.
	 *
	 * @param string $classes Existing CSS classes.
	 * @return string Modified CSS classes.
	 */
	public function admin_body_class( string $classes ): string {
		if ( ! self::is_valid_screen() || self::is_logged_in() ) {
			return $classes;
		}

		$sui_version = $this->get_sui_version();
		if ( ! empty( $sui_version ) ) {
			$classes .= ' ' . esc_attr( $sui_version );
		}

		return $classes;
	}

	/**
	 * Load the Hub Connector library.
	 *
	 * @return void
	 * @throws \RuntimeException If library file doesn't exist.
	 */
	private function load_hub_connector_library(): void {
		$hub_connector_lib = WP_SMUSH_DIR . 'core/external/hub-connector/connector.php';

		if ( ! file_exists( $hub_connector_lib ) ) {
			wp_die(
				esc_html__( 'Required library is missing. Please reinstall the plugin.', 'wp-smushit' ),
				esc_html__( 'Library Error', 'wp-smushit' ),
				array(
					'response'  => 500,
					'back_link' => true,
				)
			);
		}

		require_once $hub_connector_lib;
	}

	/**
	 * Configure Hub Connector options.
	 *
	 * @return void
	 */
	private function configure_hub_connector(): void {
		if ( ! class_exists( '\WPMUDEV\Hub\Connector' ) ) {
			return;
		}

		$options = array(
			'screens' => self::$valid_screens,
		);

		Connector::get()->set_options( self::PLUGIN_IDENTIFIER, $options );
	}

	/**
	 * Get SUI version constant.
	 *
	 * @return string
	 */
	private function get_sui_version(): string {
		return defined( 'WPMUDEV_HUB_CONNECTOR_SUI_VERSION' ) ? WPMUDEV_HUB_CONNECTOR_SUI_VERSION : '';
	}

	/**
	 * Check if current screen is valid for Hub Connector.
	 *
	 * @return bool
	 */
	private static function is_valid_screen(): bool {
		$current_screen = get_current_screen();

		if ( ! $current_screen || ! isset( $current_screen->id ) ) {
			return false;
		}

		return in_array( $current_screen->id, self::$valid_screens, true );
	}

	/**
	 * Render the Hub Connector page.
	 *
	 * @return void
	 */
	public static function render(): void {
		do_action( 'wpmudev_hub_connector_ui', self::PLUGIN_IDENTIFIER );
	}

	/**
	 * Checks if the current request is a Hub Connection flow.
	 *
	 * @return bool
	 */
	public static function is_connection_flow(): bool {
		$action = self::get_sanitized_input( 'page_action' );

		return ! empty( $action ) && self::CONNECTION_ACTION === $action;
	}

	/**
	 * Checks if Hub Connector grants access to the page.
	 *
	 * @return bool
	 */
	public static function has_access(): bool {
		return self::is_hub_connector_available() && self::is_logged_in();
	}

	/**
	 * Checks if Hub Connector is available.
	 *
	 * @return bool
	 */
	private static function is_hub_connector_available(): bool {
		return class_exists( '\WPMUDEV\Hub\Connector' );
	}

	/**
	 * Checks if Hub Connector is logged in.
	 *
	 * @return bool
	 */
	public static function is_logged_in(): bool {
		if ( ! class_exists( '\WPMUDEV\Hub\Connector\API' ) ) {
			return false;
		}

		$api = API::get();

		return $api && method_exists( $api, 'is_logged_in' ) && $api->is_logged_in();
	}

	/**
	 * Disconnect site from Hub.
	 *
	 * @return bool
	 */
	public static function disconnect(): bool {
		if ( ! class_exists( '\WPMUDEV\Hub\Connector\API' ) ) {
			return false;
		}

		$api = API::get();

		return $api && method_exists( $api, 'logout' ) && $api->logout();
	}

	/**
	 * Get connection URL for Hub.
	 *
	 * @param string $target_page   The target page to connect to.
	 * @param string $utm_campaign  The UTM campaign to append to the URL.
	 *
	 * @return string The connection URL.
	 */
	public static function get_connect_site_url( string $target_page = 'smush-bulk', string $utm_campaign = '' ): string {
		$args = array();

		if ( self::should_redirect_to_dashboard() ) {
			$args['page'] = 'wpmudev';
		} else {
			$args = self::get_connection_args( $target_page );
		}

		if ( ! empty( $utm_campaign ) ) {
			$args['utm_campaign'] = sanitize_text_field( $utm_campaign );
		}

		$admin_url = self::get_admin_url();

		return add_query_arg( $args, $admin_url );
	}

	/**
	 * Check if should redirect to WPMUDEV Dashboard.
	 *
	 * @return bool
	 */
	private static function should_redirect_to_dashboard(): bool {
		return ! self::is_wpmudev_dashboard_connected() && class_exists( 'WPMUDEV_Dashboard' );
	}

	/**
	 * Get connection arguments for URL.
	 *
	 * @param string $target_page The target page.
	 * @return array
	 */
	private static function get_connection_args( string $target_page ): array {
		return array(
			'page'        => sanitize_text_field( $target_page ),
			'_wpnonce'    => wp_create_nonce( self::CONNECTION_ACTION ),
			'page_action' => self::CONNECTION_ACTION,
		);
	}

	/**
	 * Get appropriate admin URL.
	 *
	 * @return string
	 */
	private static function get_admin_url(): string {
		return is_network_admin() ? network_admin_url( 'admin.php' ) : admin_url( 'admin.php' );
	}

	/**
	 * Check if WPMUDEV Dashboard is connected.
	 *
	 * @return bool
	 */
	public static function is_wpmudev_dashboard_connected(): bool {
		if ( ! class_exists( 'WPMUDEV_Dashboard' ) ) {
			return false;
		}

		$dashboard_api = WPMUDEV_Dashboard::$api ?? null;

		return is_object( $dashboard_api ) &&
				method_exists( $dashboard_api, 'get_membership_status' ) &&
				method_exists( $dashboard_api, 'has_key' ) &&
				$dashboard_api->has_key();
	}

	/**
	 * Checks if the Hub connector should render its UI.
	 *
	 * Verifies the nonce and login status to determine if the Hub connector should render its UI.
	 *
	 * @return bool True if should render, false otherwise.
	 */
	public static function should_render(): bool {
		if ( self::is_logged_in() || ! self::is_valid_screen() ) {
			return false;
		}

		return self::verify_connection_nonce();
	}

	/**
	 * Verify the connection nonce.
	 *
	 * @return bool
	 */
	private static function verify_connection_nonce(): bool {
		$nonce = self::get_sanitized_input( '_wpnonce' );

		if ( empty( $nonce ) ) {
			return false;
		}

		return wp_verify_nonce( $nonce, self::CONNECTION_ACTION ) !== false;
	}

	/**
	 * Get sanitized input from GET parameters.
	 *
	 * @param string $key The input key to retrieve.
	 * @param mixed  $default_value Default value if key doesn't exist.
	 * @return mixed Sanitized input value or default.
	 */
	private static function get_sanitized_input( string $key, $default_value = '' ) {
		$value = filter_input( INPUT_GET, $key, FILTER_UNSAFE_RAW );

		if ( null === $value ) {
			return $default_value;
		}

		return sanitize_text_field( $value );
	}

	/**
	 * Modify text string vars.
	 *
	 * @param array  $texts  Vars.
	 * @param string $plugin_id Plugin identifier.
	 *
	 * @return array
	 */
	public function customize_text_vars( $texts, $plugin_id ): array {
		if ( self::PLUGIN_IDENTIFIER === $plugin_id ) {
			$feature      = $this->get_feature_name();
			$feature_part = ucfirst( self::PLUGIN_IDENTIFIER ) . ' - ' . esc_html( $feature );

			$texts['create_account_desc'] = sprintf(
				/* translators: %1$s: Feature, %2$s: Opening italic tag, %3$s: Closing italic tag. */
				esc_html__( 'Create a free account to connect your site to WPMU DEV and activate %1$s. %2$s It`s fast, seamless, and free. %3$s', 'wp-smushit' ),
				'<strong>' . $feature_part . '</strong>',
				'<i>',
				'</i>'
			);
			$texts['login_desc'] = sprintf(
				/* translators: %s: Feature */
				esc_html__( 'Log in with your WPMU DEV account credentials to activate %s.', 'wp-smushit' ),
				$feature_part
			);
		}

		return $texts;
	}

	/**
	 * Get the feature name for the current screen.
	 *
	 * @return string
	 */
	private function get_feature_name(): string {
		$feature_name = __( 'Bulk Smush', 'wp-smushit' );

		$request_uri = ( new Server_Utils() )->get_request_uri();
		if ( str_contains( $request_uri, 'smush_settings_permissions_subsite_controls' ) ) {
			$feature_name = __( 'Subsite Controls', 'wp-smushit' );
		}

		return $feature_name;
	}

	/**
	 * Adds the Hub connector data to the Smush data.
	 *
	 * @param array  $extra_args The Smush data.
	 * @param string $plugin_id Plugin identifier.
	 *
	 * @return array The Smush data with the Hub connector data.
	 */
	public function add_hub_connector_data( $extra_args, $plugin_id ): array {
		if ( self::PLUGIN_IDENTIFIER === $plugin_id ) {
			$register_url = $this->array_utils->get_array_value( $extra_args, array( 'login', 'register_url' ) );
			if ( $register_url && is_string( $register_url ) ) {
				$extra_args['login']['register_url'] = $this->get_register_url_with_utm( $register_url );
			}

			if ( is_multisite() ) {
				$this->remove_filter( 'pre_site_option_wp-smush-networkwide' );

				$activated_subsite_modules = Settings::get_instance()->get_activated_subsite_modules_list();
				$network_can_access_bulk   = ! in_array( 'bulk', $activated_subsite_modules, true );
				$current_url               = $this->array_utils->get_array_value( $extra_args, array( 'login', 'current_url' ) );

				if ( $current_url && ! $network_can_access_bulk ) {
					$dashboard_url = Helper::get_page_url( 'smush' );
					// Update the redirect URL after the site is connected successfully.
					$extra_args['login']['current_url'] = $dashboard_url;
				}

				$this->restore_filter( 'pre_site_option_wp-smush-networkwide' );
			}
		}

		return $extra_args;
	}

	/**
	 * Get register URL with UTM parameters.
	 *
	 * @param string $register_url The base register URL.
	 * @return string The register URL with UTM parameters.
	 */
	private function get_register_url_with_utm( string $register_url ): string {
		$utm_campaign = filter_input( INPUT_GET, 'utm_campaign', FILTER_UNSAFE_RAW );
		return add_query_arg(
			array(
				'utm_medium'   => 'plugin',
				'utm_source'   => self::PLUGIN_IDENTIFIER,
				'utm_campaign' => empty( $utm_campaign ) ? 'smush_bulk_smush_connect' : esc_attr( $utm_campaign ),
				'utm_content'  => 'hub-connector',
			),
			$register_url
		);
	}

	/**
	 * Sync data after successful connection.
	 *
	 * @return void
	 */
	public function sync_after_connect() {
		add_site_option( 'wp_smush_show_connected_modal', true );
	}

	/**
	 * Register the hub connection success modal.
	 *
	 * @param array $modals Registered modals.
	 * @return array
	 */
	public function register_hub_connection_success_modal( $modals ) {
		if ( get_site_option( 'wp_smush_show_connected_modal' ) ) {
			delete_site_option( 'wp_smush_show_connected_modal' );
			$modals['hub-connection-success'] = array();
		}

		if ( self::is_logged_in() ) {
			$modals['disconnect-site'] = array();
		}

		return $modals;
	}

	/**
	 * Disable Subsite Controls for Unconnected Free Users.
	 *
	 * @param mixed $pre_value Pre option value.
	 * @return mixed
	 */
	public function disable_subsite_controls_for_unconnected_free_users( $pre_value ) {
		if ( Membership::get_instance()->is_api_hub_access_required() ) {
			// 0: None, 1: All, Array list modules: Custom.
			return 0;
		}

		return $pre_value;
	}

	/**
	 * Renders the Hub Connector actions. dddddd
	 */
	public function render_hub_connector_actions() {
		$is_site_connected          = self::is_logged_in();
		$is_required_api_hub_access = Membership::get_instance()->is_api_hub_access_required();
		if ( ! $is_site_connected && ! $is_required_api_hub_access ) {
			return;
		}
		?>
		<div class="sui-box-settings-row" id="general-hub-connector-row">
			<div class="sui-box-settings-col-1">
				<span class="sui-settings-label "><?php esc_html_e( 'Hub Connector', 'wp-smushit' ); ?></span>
				<span class="sui-description">
					<?php esc_html_e( "Connects your site to the WPMU DEV Free Plan, unlocking the plugin's Free plan features.", 'wp-smushit' ); ?>
				</span>
			</div>
			<div class="sui-box-settings-col-2">
				<?php if ( $is_site_connected ) : ?>
					<button class="sui-button sui-button-ghost" data-esc-close="false" data-modal-open="smush-disconnect-site-modal" data-modal-open-focus="dialog-close-div" data-modal-mask="true">
						<span class="sui-button-text-default">
							<span class="sui-icon-plug-disconnected" aria-hidden="true"></span>
							<?php esc_html_e( 'Disconnect site', 'wp-smushit' ); ?>
						</span>
					</button>
				<?php else : ?>
					<a href="<?php echo esc_url( self::get_connect_site_url( 'smush-bulk', 'smush_settings_general_connect' ) ); ?>" class="sui-button sui-button-blue smush-button-dark-blue">
						<span class="sui-icon-plug-connected" aria-hidden="true"></span>
						<?php esc_html_e( 'Connect site', 'wp-smushit' ); ?>
					</a>
				<?php endif; ?>
				<span class="sui-description"><?php esc_html_e( 'Note: disconnecting your site from WPMU DEV will disable other services that rely on this connection.', 'wp-smushit' ); ?></span>
			</div>
		</div>
		<?php
	}

	/**
	 * Disconnect the site from the hub.
	 *
	 * @return void
	 */
	public function ajax_disconnect_site() {
		check_ajax_referer( 'wp-smush-ajax' );

		// Check capability.
		if ( ! Helper::is_user_allowed( 'manage_options' ) ) {
			wp_die( esc_html__( 'Unauthorized', 'wp-smushit' ), 403 );
		}

		$this->disconnect();

		// No Need to send json response for other requests.
		wp_send_json_success();
	}

	/**
	 * Add site disconnected success message.
	 *
	 * @param mixed $messages Smush data messages.
	 * @return array
	 */
	public function add_site_disconnected_success_message( $messages ): array {
		$messages['site_disconnected_success'] = __( 'Site disconnected successfully.', 'wp-smushit' );

		return $messages;
	}
}
