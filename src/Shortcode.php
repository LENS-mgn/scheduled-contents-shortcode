<?php
/**
 * Created by PhpStorm.
 * User: torounit
 * Date: 2017/08/05
 * Time: 8:37
 */

namespace Scheduled_Contents_Shortcode;


class Shortcode {

	public function __construct() {
		add_shortcode( 'schedule', [ $this, 'shortcode' ] );
	}

	/**
	 * Shortcode
	 *
	 * @param array   $attributes
	 * @param string  $content
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
