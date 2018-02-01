<?php

namespace WP_JSON_LD;

// var_dump('2<pre>');
// var_dump(__NAMESPACE__); //die();
$obj = new Loader();
// $obj->test();
use Intraxia\Jaxion\Core\Application as JaxionCore;

// use Intraxia\Jaxion\Contract\Core\Application as ApplicationContract;
class Application extends JaxionCore
{
    public $ver = JSON_LD_VERSION;
    /**
     * ServiceProviders to register with the Application.
     *
     * @var string[]
     */
    protected $providers = array(
    'WP_JSON_LD\Core\Providers\Object',
    );

    /**
     * {@inheritdoc}
     */
    public function activate()
    {
        global $wp_rewrite;
        define('VERSION', $ver);
        $current_version = VERSION; // define this constant in the loader file
        $saved_version = get_option('wp_json_ld_version');

        // This is a new installation
        if (!$saved_version) {
            // Do whatever you need to do during first installation
            $wp_rewrite->flush_rules(false);

            // This is an upgrade
        } elseif (version_compare($saved_version, $current_version, '<')) {
            // Do whatever you need to do on an upgrade
            $wp_rewrite->flush_rules(false);
            // Version is up to date - do nothing
        } else {
            return;
        }

        // Update the version number stored in the db (so this does not run again)
        update_option('wp_json_ld_version', JSON_LD_VERSION);
    }
}
