<?php
/**
 * Class SampleTest
 *
 * @package Scheduled_Contents_Shortcode
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {


	/**
	 * @test
	 */
	public function test_start_past_datetime() {
		$actual = do_shortcode( '[schedule start="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}


	/**
	 * @test
	 */
	public function test_start_future_datetime() {
		$datetime = date( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule start="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_end_past_datetime() {
		date( 'Y-m-d', strtotime( '+1 hour' ) );
		$actual = do_shortcode( '[schedule end="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}


	/**
	 * @test
	 */
	public function test_end_future_datetime() {
		$datetime = date( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule end="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_start_past_datetime_and_end_future_datetime() {
		$start = date( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );
		$end = date( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );

		$actual   = do_shortcode( '[schedule start="' . $start . '" end="' . $end . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_start_past_datetime_and_end_past_datetime() {
		$start = date( 'Y-m-d\TH:i:s', strtotime( '-2 hour' ) );
		$end = date( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );

		$actual   = do_shortcode( '[schedule start="' . $start . '" end="' . $end . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_start_future_datetime_and_end_future_datetime() {
		$start = date( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$end = date( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );

		$actual   = do_shortcode( '[schedule start="' . $start . '" end="' . $end . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 * error case.
	 */
	public function test_start_future_datetime_and_end_past_datetime() {
		$start = date( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$end = date( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );

		$actual   = do_shortcode( '[schedule start="' . $start . '" end="' . $end . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 */
	public function test_no_start_no_end() {
		$actual = do_shortcode( '[schedule]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

}
