<?php
/**
 * Plugin Name:     Scheduled Contents Shortcode
 * Plugin URI:      https://github.com/LENS-mgn/scheduled-contents-shortcode
 * Description:     hhow or hidden contents for datetime.
 * Author:          megane9988, Toro_Unit
 * Author URI:      https://www.m-g-n.me/
 * Text Domain:     scheduled-contents-shortcode
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Scheduled_Contents_Shortcode
 */

require dirname( __FILE__ ) . '/src/class-scheduler.php';

use Scheduled_Contents_Shortcode\Scheduler;

class Scheduled_Contents_Shortcode {

	public function __construct() {
		add_shortcode( 'schedule', [ $this, 'shortcode' ] );
	}

	/**
	 * Shortcode
	 *
	 * @param array $attributes
	 * @param string $content
	 *
	 * @return string
	 */
	public function shortcode( $attributes, $content ) {
		$attributes = shortcode_atts( [
			'on'    => '1970-01-01T00:00',
			'until' => '',
		], $attributes, 'schedule' );

		$scheduler = new Scheduler( current_time( 'timestamp' ) );

		$on = date_i18n( 'U', strtotime( $attributes['on'] ) );
		$scheduler->set_published_on( $on );

		if ( $attributes['until'] ) {
			$until = date_i18n( 'U', strtotime( $attributes['until'] ) );
			$scheduler->set_published_until( $until );
		}

		if ( $scheduler->is_published() ) {
			return $content;
		}

		return '';
	}

}

new Scheduled_Contents_Shortcode();
