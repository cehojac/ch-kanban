<?php
namespace NXHBQU;
defined('ABSPATH') or exit;

class AdminController
{

    public function __construct()
    {

    }
    public static function jsAdmin($hook)
    {
        if ('toplevel_page_ch-kanban' !== $hook) {
            return;
        }
        wp_enqueue_script('ch-kanban_script', plugin_dir_url(__DIR__) . 'assets/js/ch-kanban.js', array('jquery'), time(), true);
        wp_localize_script('ch-kanban_script', 'ajax_var', array(
            'nonce' => wp_create_nonce('ch-kanban-ajax')
        ));
        wp_enqueue_style('ch-kanban_css', plugin_dir_url(__DIR__) . 'assets/css/ch-kanban.css', array(), time(), 'all');
    }
}
//Make whit Antonella Framework