<?php

require 'class-SplClassLoader.php';
use SplClassLoader as ClassLoader;

$classLoader = new ClassLoader('WP_JSON_LD', dirname(__FILE__), false);
// var_dump($classLoader->getIncludePath());
$classLoader->filterFinalPath('WP_JSON_LD'.DIRECTORY_SEPARATOR, '');
$classLoader->register();
function wp_json_ld($prop = false)
{
    $instance = new stdClass();
    try {
        $instance = new WP_JSON_LD\Application(__FILE__);
        $instance->boot();
        // var_dump('New Boot');
    } catch (Intraxia\Jaxion\Core\ApplicationAlreadyBootedException $e) {
        // var_dump('Old boot.');
        $instance = WP_JSON_LD\Application::instance();
    }
    if (!$prop) {
        return $instance;
    } else {
        return $instance[$prop];
    }
}
pressforward();
