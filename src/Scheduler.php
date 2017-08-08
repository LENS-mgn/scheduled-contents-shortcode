<?php
/**
 * Scheduler Class
 *
 * @package Scheduled_Contents_Shortcode
 */

namespace Scheduled_Contents_Shortcode;

/**
 * Class Scheduler
 */
class Scheduler {

	/**
	 * Current timestamp.
	 *
	 * @var int
	 */
	private $now;

	/**
	 * From timestamp.
	 *
	 * @var int
	 */
	private $published_from = 0;

	/**
	 * On timestamp.
	 *
	 * @var int
	 */
	private $published_to = INF;

	/**
	 * Scheduler constructor.
	 *
	 * @param int $now timestamp.
	 */
	public function __construct( $now ) {
		$this->now = $now;
	}

	/**
	 * Setter published_from.
	 *
	 * @param int $published_from timestamp.
	 */
	public function set_published_from( $published_from ) {
		$this->published_from = $published_from;
	}

	/**
	 * Setter published_to.
	 *
	 * @param int $published_to timestamp.
	 */
	public function set_published_to( $published_to ) {
		$this->published_to = $published_to;
	}

	/**
	 * Is published contents.
	 *
	 * @return bool
	 */
	public function is_published() {
		return $this->is_started() && $this->is_expired();
	}

	/**
	 * Is started publish.
	 *
	 * @return bool
	 */
	public function is_started() {
		return $this->published_from < $this->now;
	}

	/**
	 * Is expired publish.
	 *
	 * @return bool
	 */
	public function is_expired() {
		return $this->now < $this->published_to;
	}

}
