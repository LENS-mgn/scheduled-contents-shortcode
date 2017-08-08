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
			'from'    => '1970-01-01T00:00',
			'to' => '',
		], $attributes, 'schedule' );

		$scheduler = new Scheduler( current_time( 'timestamp' ) );

		$from = date_i18n( 'U', strtotime( $attributes['from'] ) );
		$scheduler->set_published_from( $from );

		if ( $attributes['to'] ) {
			$to = date_i18n( 'U', strtotime( $attributes['to'] ) );
			$scheduler->set_published_to( $to );
		}

		if ( $scheduler->is_published() ) {
			return $content;
		}

		return '';
	}

}
