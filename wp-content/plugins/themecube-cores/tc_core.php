<?php

/**
 * Plugin Name: ThemeCube Core 
 * Plugin URI: http://themecube.net
 * Description: Escape Wordpress Theme shortcodes
 * Version: 1.1
 * Author: themecube
 * Author URI: http://themeforest.net/user/themecube
 * Text Domain: escape
 * Domain Path: /languages/
 * License: GPL2
 */

$current_dir = plugin_dir_path(dirname(__FILE__));
$plugin_name = current(explode("/", plugin_basename( __FILE__ )));



//POST TYPE
require $current_dir . $plugin_name . '/post_type.php';

//GLOBAL
require $current_dir . $plugin_name . '/vc_global.php';

//SHORTCODES
require $current_dir . $plugin_name . '/tc_shortcode.php';