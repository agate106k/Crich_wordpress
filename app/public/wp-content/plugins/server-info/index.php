<?php
/**
  * Plugin Name: Server Info
  * Description: This plugin will show you useful information about the hosting server you are using e.g. PHP version, MySQL version, Server OS, Server Protocol, Server IP and other useful information. You can use the information displayed by this plugin to update any settings which is crucial for your website performance and other aspects.
  * Plugin URI: https://github.com/usmanaliqureshi/server-info
  * Version: 2.5.3
  * Author: Usman Ali Qureshi
  * Author URI: https://profiles.wordpress.org/usmanaliqureshi
  * License: GPLv2 or later
  * Text Domain: si
  * Domain Path: /languages/
  */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'PLUGIN_DIR', dirname( __FILE__ ) . '/' );

include_once PLUGIN_DIR . 'functions.php';
