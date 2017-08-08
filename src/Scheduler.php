<?php

namespace Scheduled_Contents_Shortcode;

class Scheduler {

	/**
	 * @var int
	 */
	private $now;

	/**
	 * @var int
	 */
	private $published_from = 0;

	/**
	 * @var int
	 */
	private $published_to = INF;

	/**
	 * Scheduler constructor.
	 *
	 * @param $now
	 */
	public function __construct( $now ) {
		$this->now = $now;
	}

	/**
	 * @param int $published_from
	 */
	public function set_published_from( int $published_from ) {
		$this->published_from = $published_from;
	}

	/**
	 * @param int $published_to
	 */
	public function set_published_to( int $published_to ) {
		$this->published_to = $published_to;
	}

	/**
	 * @return bool
	 */
	public function is_published() {
		return $this->is_started() && $this->is_expired();
	}

	/**
	 *
	 * @return bool
	 */
	public function is_started() {
		return $this->published_from < $this->now;
	}

	/**
	 *
	 * @return bool
	 */
	public function is_expired() {
		return $this->now < $this->published_to;
	}

}
