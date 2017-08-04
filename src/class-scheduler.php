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
	private $published_on = 0;

	/**
	 * @var int
	 */
	private $published_until = INF;

	/**
	 * Scheduler constructor.
	 *
	 * @param $now
	 */
	public function __construct( $now ) {
		$this->now = $now;
	}


	/**
	 * @param int $published_on
	 */
	public function set_published_on( int $published_on ) {
		$this->published_on = $published_on;
	}

	/**
	 * @param int $published_until
	 */
	public function set_published_until( int $published_until ) {
		$this->published_until = $published_until;
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
	 *
	 */
	public function is_started() {
		return $this->published_on < $this->now;
	}

	/**
	 *
	 * @return bool
	 */
	public function is_expired() {
		return $this->now < $this->published_until;
	}

}
