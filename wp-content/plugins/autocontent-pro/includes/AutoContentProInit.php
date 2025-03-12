<?php

namespace AutoContentPro;

class AutoContentProInit
{
    public function __construct()
    {
        // Подключение дополнительных файлов
        $this->load_dependencies();
    }

    private function load_dependencies()
    {

    }

    public function run()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu()
    {
        add_menu_page(
            'AutoContent Pro',
            'AutoContent Pro',
            'manage_options',
            'autocontent-pro',
            array($this, 'display_admin_page')
        );
    }

    public function display_admin_page()
    {
        echo '<div class="wrap"><h1>AutoContent Pro</h1><p>Welcome to AutoContent Pro settings page!</p></div>';
    }
}
