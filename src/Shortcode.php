<?php
/**
 * Shortcode Class
 *
 * @package Scheduled_Contents_Shortcode
 */

namespace Scheduled_Contents_Shortcode;

/**
 * Class Shortcode
 */
class Shortcode {

	/**
	 * Shortcode constructor.
	 */
	public function __construct() {
		add_shortcode( 'schedule', [ $this, 'shortcode' ] );
	}

	/**
	 * Register shortcode
	 *
	 * @param array  $attributes attributes for shortcode.
	 * @param string $content html contents.
	 *
	 * @return string
	 */
	public function shortcode( $attributes, $content ) {
		$attributes = shortcode_atts( [
			'from' => '1970-01-01T00:00',
			'to'   => '',
		], $attributes, 'schedule' );

		$scheduler = new Scheduler( current_time( 'timestamp' ) );

		$from = date_i18n( 'U', strtotime( $attributes['from'] ) );
		$scheduler->set_published_from( $from );

		if ( $attributes['to'] ) {
			$to = date_i18n( 'U', strtotime( $attributes['to'] ) );
			$scheduler->set_published_to( $to );
		}

		if ( $scheduler->is_published() ) {
			return do_shortcode( $content );
		}

		return '';
	}

}
