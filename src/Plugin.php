<?php

namespace Setcooki\Wp\Foundation\Block\Adapter;

use Setcooki\Wp\Foundation\Block\Adapter\Admin\Settings;
use Setcooki\Wp\Foundation\Block\Adapter\Filter\RenderBlock;
use Setcooki\Wp\Foundation\Block\Adapter\Traits\Singleton;

/**
 * Class Plugin
 * @package Setcooki\Wp\Foundation\Block\Adapter
 */
class Plugin
{
    use Singleton;


    /**
     * Plugin constructor.
     */
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'setup'], 9999);
    }


    /**
     *
     */
    public function init()
    {
        $this->initFront();
        $this->initAdmin();
    }


    /**
     *
     */
    protected function initFront()
    {
        if(!is_admin() && !in_array($GLOBALS['pagenow'], []) && !isset($_GET['no-fs']))
        {
            add_action('wp_enqueue_scripts', function()
            {
                $dev = preg_match('=\.test$=i', $_SERVER['HTTP_HOST']);
                $deps = (array)apply_filters('wpfba/styles/dependencies', []);
                $vers = wpfba_version('full');
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wp-block-library-theme');
                wp_enqueue_style('wpfba', FOUNDATION_BLOCK_ADAPTER_URL . 'static/css/plugin'.(!$dev ? '.min' : '').'.css', $deps, $vers);
            }, 9999);
        }

        add_filter('render_block', [new RenderBlock(), 'execute'], 9999, 2);
    }


    /**
     *
     */
    protected function initAdmin()
    {
        if(is_admin())
        {
            add_action('enqueue_block_editor_assets', function()
            {
                wp_enqueue_style('wpfba', FOUNDATION_BLOCK_ADAPTER_URL . 'static/css/editor.min.css');
            }, 9999);

            (new Settings());
        }
    }


    /**
     *
     */
    public function setup()
    {
        $settings = json_decode((string)get_option('wpfba_settings', ''));

        add_theme_support('align-wide');
        if(isset($settings->colors) && ($colors = json_decode(stripslashes($settings->colors), true)) !== null)
        {
            add_theme_support('editor-color-palette', $colors);
        }else{
            add_theme_support('editor-color-palette', []);
        }
    }


    /**
     * @throws \Exception
     */
    public function activate()
    {
    }


    /**
     *
     */
    public function deactivate()
    {
    }


    /**
     *
     */
    public static function uninstall()
    {
        delete_option('wpfba_settings');
    }
}
