<?php
/**
 * Adds shortcode [schedule]. Simple way to show and hide content by datetime.
 *
 * @package Scheduled_Contents_Shortcode
 * @version 1.0.0
 */

/**
 * Plugin Name:     Scheduled Contents Shortcode
 * Plugin URI:      https://github.com/LENS-mgn/scheduled-contents-shortcode
 * Description:     show or hidden contents for datetime.
 * Author:          megane9988, Toro_Unit
 * Author URI:      https://www.m-g-n.me/
 * Text Domain:     scheduled-contents-shortcode
 * Domain Path:     /languages
 * Version:         1.0.0
 */

require dirname( __FILE__ ) . '/src/Shortcode.php';
require dirname( __FILE__ ) . '/src/Scheduler.php';
require dirname( __FILE__ ) . '/src/Shortcake_Datetime_Field.php';

use Scheduled_Contents_Shortcode\Shortcake_Datetime_Field;
use Scheduled_Contents_Shortcode\Shortcode;

add_action( 'init', function () {
	new Shortcake_Datetime_Field();
	new Shortcode();
});


