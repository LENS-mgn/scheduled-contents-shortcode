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

		$now   = current_time( 'timestamp' );
		$published_on    = 0;
		$published_until = INF;

		if ( $attributes['on'] ) {
			$published_on = date_i18n( 'U', strtotime( $attributes['on'] ) );
		}

		if ( $attributes['until'] ) {
			$published_until = date_i18n( 'U', strtotime( $attributes['until'] ) );
		}

		if( $published_on < $now && $now < $published_until ) {
			return $content;
		}

		return '';
	}

	/**
	 * @param $now
	 * @param $time
	 *
	 * @return bool
	 *
	 */
	public static function is_started( $now, $time ) {
		return $time <= $now;
	}

	/**
	 * @param $now
	 * @param $time
	 *
	 * @return bool
	 */
	public static function is_expired( $now, $time ) {
		return $time <= $now;
	}
}

new Scheduled_Contents_Shortcode();
