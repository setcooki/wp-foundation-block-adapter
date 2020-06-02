<?php

namespace Setcooki\Wp\Foundation\Block\Adapter\Admin;

/**
 * Class Settings
 * @package Setcooki\Wp\Foundation\Block\Adapter\Admin
 */
class Settings
{
    /**
     * @var \stdClass|null
     */
    public $menu = null;


    /**
     * Settings constructor.
     */
    public function __construct()
    {
        $this->init();
    }


    /**
     *
     */
    protected function init()
    {
        $this->menu = new \stdClass();
        add_action('admin_menu', function()
        {
            add_options_page
            (
                __('Foundation Block Adapter', FOUNDATION_BLOCK_ADAPTER_DOMAIN),
                __('Foundation Block Adapter', FOUNDATION_BLOCK_ADAPTER_DOMAIN),
                'manage_options',
                'foundation-block-adapter',
                array($this, 'menu')
            );
        });
    }


    /**
     *
     */
    public function menu()
    {
        if(strtolower($_SERVER['REQUEST_METHOD']) === 'post')
        {
            if(isset($_POST['wpfba_general_form']) && (int)$_POST['wpfba_general_form'] === 1)
            {
                $settings = new \stdClass();
                $settings->colors = (isset($_POST['wpfba_general_colors'])) ? trim($_POST['wpfba_general_colors']) : '';
                update_option('wpfba_settings', json_encode($settings));
            }
        }

        $settings = json_decode(get_option('wpfba_settings', new \stdClass()));
        $this->menu->settings = new \stdClass();
        $this->menu->settings->colors = (isset($settings->colors)) ? stripslashes($settings->colors) : '';

        ob_start();
        require_once FOUNDATION_BLOCK_ADAPTER_DIR . '/templates/admin/settings.php';
        echo ob_get_clean();
    }
}
