<?php

use Scheduled_Contents_Shortcode\Scheduler;

class SchedulerTest extends WP_UnitTestCase {


	public function test_no_set_value() {
		$scheduler = new Scheduler( current_time( 'timestamp' ) );
		$this->assertTrue( $scheduler->is_published() );
	}

	public function test_end_in_past_datetime() {
		$scheduler = new Scheduler( current_time( 'timestamp' ) );
		$scheduler->set_published_to( strtotime( '-1 Year' ) );
		$this->assertFalse( $scheduler->is_published() );
	}

	public function test_began_on_future_datetime() {
		$scheduler = new Scheduler( current_time( 'timestamp' ) );
		$scheduler->set_published_from( strtotime( '+1 Year' ) );
		$this->assertFalse( $scheduler->is_published() );
	}

}
