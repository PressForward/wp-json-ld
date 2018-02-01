<?php
/*
Plugin Name: WP JSON LD
Plugin URI: http://pressforward.org/
Description: A Tool to Provide Complient JSON LD metadata for Schema.org, usable by PressForward
GitHub Plugin URI: https://github.com/PressForward/wp-json-ld
Author: Aram Zucker-Scharff
Author URI: http://pressforward.org/about/team/
License: GPL2
*/

// var_dump('2<pre>');
// Set up some constants
define('JSON_LD_ROOT', dirname(__FILE__));
define('JSON_LD_FILE_PATH', PF_ROOT.'/'.basename(__FILE__));
define('JSON_LD_URL', plugins_url('/', __FILE__));
define('JSON_LD_VERSION', '0.1');

// Protect File.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('WPUpdatePHP')) {
    require 'Libraries/WPUpdatePHP.php';
}

$PHPCheck = new WPUpdatePHP('5.5.0');
$PHPCheck->set_plugin_name('PressForward');

if ((PHP_VERSION < 5.5) || (!$PHPCheck->does_it_meet_required_php_version(PHP_VERSION))) {
    wp_die('WP JSON LD requires at least PHP 5.5.');

    return;
} else {
    require 'init.php';
}

// call_user_func(array(new Application(__FILE__), 'boot'));
