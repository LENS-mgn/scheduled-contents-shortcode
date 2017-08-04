<?php
/**
 * Class SampleTest
 *
 * @package Scheduled_Contents_Shortcode
 */

/**
 * Sample test case.
 */
class ShortcodeTest extends WP_UnitTestCase {


	/**
	 * @test
	 */
	public function test_on_past_datetime() {
		$actual = do_shortcode( '[schedule on="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}


	/**
	 * @test
	 */
	public function test_on_future_datetime() {
		$datetime = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule on="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_until_past_datetime() {
		$actual = do_shortcode( '[schedule until="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}


	/**
	 * @test
	 */
	public function test_until_future_datetime() {
		$datetime = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule until="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_on_past_datetime_and_until_future_datetime() {
		$on = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );
		$until = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule on="' . $on . '" until="' . $until . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_on_past_datetime_and_until_past_datetime() {
		$on = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-2 hour' ) );
		$until = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );
		$actual   = do_shortcode( '[schedule on="' . $on . '" until="' . $until . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_on_future_datetime_and_until_future_datetime() {
		$on = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$until = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );
		$actual   = do_shortcode( '[schedule on="' . $on . '" until="' . $until . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 * error case.
	 */
	public function test_on_future_datetime_and_until_past_datetime() {
		$on = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$until = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );
		$actual   = do_shortcode( '[schedule on="' . $on . '" until="' . $until . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 */
	public function test_no_on_no_until() {
		$actual = do_shortcode( '[schedule]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

}
