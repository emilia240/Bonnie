<?php

namespace Smush\Core\Membership;

use Smush\Core\Api\Smush_API;
use Smush\Core\Hub_Connector;
use WPMUDEV\Hub\Connector\Data;

class Membership {
	/**
	 * Static instance
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Static instance getter
	 */
	public static function get_instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @var boolean
	 */
	private $is_pro;

	public function get_apikey() {
		// If API key defined manually, get that.
		if ( defined( 'WPMUDEV_APIKEY' ) && WPMUDEV_APIKEY ) {
			return WPMUDEV_APIKEY;
		}

		// If dashboard plugin is active, get API key from db.
		if ( class_exists( 'WPMUDEV_Dashboard' ) ) {
			return get_site_option( 'wpmudev_apikey' );
		}

		return false;
	}

	/**
	 * Validate the installation.
	 *
	 * @param bool $force Force revalidation.
	 * @return void
	 */
	public function validate_install( $force = false ) {
		if ( $this->is_pro && ! $force ) {
			return;
		}

		$api_key = $this->get_apikey();
		if ( empty( $api_key ) ) {
			return;
		}

		// Flag to check if we need to revalidate the key.
		$revalidate = false;

		$api_auth = get_site_option( 'wp_smush_api_auth' );

		// Check if we need to revalidate.
		if ( empty( $api_auth[ $api_key ] ) ) {
			$api_auth   = array();
			$revalidate = true;
		} else {
			$last_checked = $api_auth[ $api_key ]['timestamp'];
			$valid        = $api_auth[ $api_key ]['validity'];

			// Difference in hours.
			$diff = ( time() - $last_checked ) / HOUR_IN_SECONDS;
			if ( 24 < $diff ) {
				$revalidate = true;
			}
		}

		// If we are supposed to validate API, update the results in options table.
		if ( $revalidate || $force ) {
			if ( empty( $api_auth[ $api_key ] ) ) {
				// For api key resets.
				$api_auth[ $api_key ] = array();

				// Storing it as valid, unless we really get to know from API call.
				$valid                            = 'valid';
				$api_auth[ $api_key ]['validity'] = 'valid';
			}

			// This is the first check.
			if ( ! isset( $api_auth[ $api_key ]['timestamp'] ) ) {
				$api_auth[ $api_key ]['timestamp'] = time();
			}

			$api     = new Smush_API( $api_key );
			$request = $api->check( $force );

			if ( ! is_wp_error( $request ) && 200 === wp_remote_retrieve_response_code( $request ) ) {
				// Update the timestamp only on successful attempts.
				$api_auth[ $api_key ]['timestamp'] = time();
				update_site_option( 'wp_smush_api_auth', $api_auth );

				$result = json_decode( wp_remote_retrieve_body( $request ) );
				if ( ! empty( $result->success ) ) {
					$valid = 'valid';
					update_site_option( 'wp-smush-cdn_status', $result->data );
				} else {
					$valid = 'invalid';
				}
			} elseif ( ! isset( $valid ) || 'valid' !== $valid ) {
				// Invalidate only in case when it was not valid before.
				$valid = 'invalid';
			}

			$api_auth[ $api_key ]['validity'] = $valid;

			// Update API validity.
			update_site_option( 'wp_smush_api_auth', $api_auth );
		}

		$this->is_pro = isset( $valid ) && 'valid' === $valid;
	}

	/**
	 * Check if the membership is pro.
	 *
	 * @return bool
	 */
	public function is_pro() {
		return $this->is_pro;
	}

	/**
	 * Check if the user has access to the hub.
	 *
	 * Warning: This method do not support old free users.
	 *
	 * @return bool
	 */
	public function has_access_to_hub() {
		if ( $this->is_pro() ) {
			return true;
		}

		if ( class_exists( 'WPMUDEV_Dashboard' ) && method_exists( 'WPMUDEV_Dashboard_Api', 'get_membership_status' ) ) {
			// Possible values: full, single, free, expired, paused, unit.
			$plan = \WPMUDEV_Dashboard::$api->get_membership_status();
		} elseif ( Hub_Connector::has_access() && class_exists( '\WPMUDEV\Hub\Connector\Data' ) ) {
			$plan = Data::get()->membership_type();
		} else {
			return false;
		}

		return in_array( $plan, array( 'full', 'single', 'free', 'unit' ), true );
	}

	/**
	 * Check if access to the Hub access is required to use the API.
	 *
	 * @return bool
	 */
	public function is_api_hub_access_required() {
		$is_pre_3_22_site = get_site_option( 'wp_smush_pre_3_22_site' );
		if ( $is_pre_3_22_site ) {
			return false;
		}

		return ! $this->has_access_to_hub();
	}
}
