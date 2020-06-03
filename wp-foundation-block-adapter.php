<?php
/*
Plugin Name: Wordpress Foundation Block Adapter
Plugin URI: https://set.cooki.me
Description: Wordpress Foundation Block Adapter
Author: Frank Mueller <set@cooki.me>
Author URI: https://github.com/setcooki/
Text Domain: wpfba
Version: 0.0.3
*/

if(!defined('FOUNDATION_BLOCK_ADAPTER_DOMAIN'))
{
    define('FOUNDATION_BLOCK_ADAPTER_DOMAIN', 'wp-foundation-block-adapter');
}
define('FOUNDATION_BLOCK_ADAPTER_DIR', dirname(__FILE__));
define('FOUNDATION_BLOCK_ADAPTER_NAME', basename(__FILE__, '.php'));
define('FOUNDATION_BLOCK_ADAPTER_FILE', __FILE__);
define('FOUNDATION_BLOCK_ADAPTER_URL', plugin_dir_url(FOUNDATION_BLOCK_ADAPTER_FILE));

if(!function_exists('wpfba'))
{
    function wpfba()
    {
        try
        {
            require dirname(__FILE__) . '/lib/functions.php';
            require dirname(__FILE__) . '/lib/vendor/autoload.php';
            $plugin = \Setcooki\Wp\Foundation\Block\Adapter\Plugin::getInstance();
            register_activation_hook(__FILE__, array($plugin, 'activate'));
            register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));
            register_uninstall_hook(__FILE__, array(get_class($plugin), 'uninstall'));
            add_action('init', function() use ($plugin)
            {
                $plugin->init();
            });
        }
        catch(Exception $e)
        {
            @file_put_contents(ABSPATH . 'wp-content/logs/error.log', $e->getMessage() . "\n", FILE_APPEND);
        }
    }
}

wpfba();
