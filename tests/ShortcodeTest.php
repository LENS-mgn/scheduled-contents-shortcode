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
	public function test_collectP() {
		global $post;
		$post = $this->factory()->post->create_and_get( [
			'post_content' => '[schedule]<p>content</p>[/schedule]',
		] );
		setup_postdata( $post );
		$this->expectOutputRegex( '/<p>content<\/p>/' );
		the_content();
		wp_reset_postdata();
	}


	/**
	 * @test
	 */
	public function test_from_past_datetime() {
		$actual = do_shortcode( '[schedule from="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}


	/**
	 * @test
	 */
	public function test_from_future_datetime() {
		$datetime = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule from="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_to_past_datetime() {
		$actual = do_shortcode( '[schedule to="2004-02-12T15:19:21"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}


	/**
	 * @test
	 */
	public function test_to_future_datetime() {
		$datetime = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual   = do_shortcode( '[schedule to="' . $datetime . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_from_past_datetime_and_to_future_datetime() {
		$from   = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );
		$to     = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$actual = do_shortcode( '[schedule from="' . $from . '" to="' . $to . '"]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

	/**
	 * @test
	 */
	public function test_from_past_datetime_and_to_past_datetime() {
		$from   = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-2 hour' ) );
		$to     = date_i18n( 'Y-m-d\TH:i:s', strtotime( '-1 hour' ) );
		$actual = do_shortcode( '[schedule from="' . $from . '" to="' . $to . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 */
	public function test_from_future_datetime_and_to_future_datetime() {
		$from   = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$to     = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );
		$actual = do_shortcode( '[schedule from="' . $from . '" to="' . $to . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 * error case.
	 */
	public function test_from_future_datetime_and_to_past_datetime() {
		$from   = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+1 hour' ) );
		$to     = date_i18n( 'Y-m-d\TH:i:s', strtotime( '+2 hour' ) );
		$actual = do_shortcode( '[schedule from="' . $from . '" to="' . $to . '"]content[/schedule]' );
		$this->assertEquals( '', $actual );
	}

	/**
	 * @test
	 *
	 */
	public function test_no_from_no_to() {
		$actual = do_shortcode( '[schedule]content[/schedule]' );
		$this->assertEquals( 'content', $actual );
	}

}
