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
		$this->shortcode_ui();
	}

	/**
	 * Register shortcode_ui.
	 */
	public function shortcode_ui() {
		if ( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
			shortcode_ui_register_for_shortcode( 'schedule',
				array(
					'label'         => 'Schedule',
					'listItemImage' => 'dashicons-calendar-alt',
					'attrs'         => array(
						array(
							'label' => 'From',
							'attr'  => 'from',
							'type'  => 'datetime-local',
						),
						array(
							'label' => 'To',
							'attr'  => 'to',
							'type'  => 'datetime-local',
						),
					),
					'inner_content' => array(
						'label'        => esc_html__( 'Contents', 'scheduled-contents-shortcode' ),
						'value'        => '',
					),
				)
			);
		}
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
