<?php

namespace Smush\Core\Membership;

use Smush\Core\Controller;
use Smush\Core\Helper;

class Membership_Controller extends Controller {
	/**
	 * @var Membership
	 */
	private $membership;

	public function __construct() {
		$this->membership = Membership::get_instance();

		$this->register_action( 'wp_ajax_recheck_api_status', array( $this, 'recheck_api_status' ) );
	}

	public function recheck_api_status() {
		// Check for permission.
		if ( ! Helper::is_user_allowed() ) {
			wp_die( esc_html__( 'Unauthorized', 'wp-smushit' ), 403 );
		}
		$this->membership->validate_install( true );

		wp_send_json_success();
	}
}
