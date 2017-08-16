<?php
/**
 * Adds shortcode [schedule]. Simple way to show and hide content by datetime.
 *
 * @package Scheduled_Contents_Shortcode
 * @version 1.0.2
 */

/**
 * Plugin Name:     Scheduled Contents Shortcode
 * Plugin URI:      https://github.com/LENS-mgn/scheduled-contents-shortcode
 * Description:     show or hidden contents for datetime.
 * Author:          megane9988, Toro_Unit
 * Author URI:      https://www.m-g-n.me/
 * Text Domain:     scheduled-contents-shortcode
 * Domain Path:     /languages
 * Version:         1.0.2
 */

namespace Scheduled_Contents_Shortcode;

const PLUGIN_PATH = __FILE__;

require dirname( PLUGIN_PATH ) . '/src/Shortcode.php';
require dirname( PLUGIN_PATH ) . '/src/Scheduler.php';
require dirname( PLUGIN_PATH ) . '/src/Shortcake_Datetime_Field.php';



add_action( 'init', function () {
	new Shortcake_Datetime_Field();
	new Shortcode();
});


