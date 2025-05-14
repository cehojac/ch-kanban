<?php
namespace NXHBQU;
defined('ABSPATH') or die(exit());

class kanbanController
{

    public function __construct()
    {

    }
    public static function index()
    {
        global $post;
        $nonce = \wp_create_nonce('ch-kanban');
        $view = isset($_REQUEST['_wpnonce']) ? (\wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])), 'ch-kanban') ? sanitize_text_field($_REQUEST['view']) : '') : '';
        if ($view == 'list') {

            $terms = [];
            $cards = get_posts(array(
                'post_type' => 'ticket',
                'post_status' => 'publish'
            ));
        } else {
            $terms = get_terms(array(
                'taxonomy' => 'estado',
                'orderby' => 'id',
                'hide_empty' => false,
                'fields' => 'all',
                'hierarchical' => false,
                'parent' => 0,
            ));
            $cards = [];

            foreach ($terms as $term) {
                $cards[$term->slug] = get_posts(array(
                    'post_type' => 'ticket',
                    'estado' => $term->name,
                    'post_status' => 'publish'
                ));
            }
        }

        echo NXHBQU_view('backend.tickets.index', compact('terms', 'cards', 'view', 'nonce'));



    }
    public static function DefineTaxValues()
    {
        $defaults_estado = [__('To do', 'ch-kanban'), __('Developing', 'ch-kanban'), __('Waiting for customer response', 'ch-kanban'), __('Done', 'ch-kanban')];
        PostTypes::registrer_term_tax($defaults_estado, 'estado');

        $defaults_prioridad = [__('low', 'ch-kanban'), __('normal', 'ch-kanban'), __('high', 'ch-kanban')];
        PostTypes::registrer_term_tax($defaults_prioridad, 'prioridad');
    }

    public static function UpdateTicket()
    {
        if (!wp_verify_nonce(\sanitize_text_field(\wp_unslash($_POST['nonce'])), 'ch-kanban-ajax')) {
            die('Busted!');
        }
        $id_post = str_replace('card-', '', \sanitize_text_field($_REQUEST['id_post']));
        $taxonomia = \sanitize_text_field($_REQUEST['taxonomy']);
        $previo = \sanitize_text_field($_REQUEST['previous']);
        wp_remove_object_terms($id_post, $previo, 'estado');
        wp_set_object_terms($id_post, $taxonomia, 'estado', true);
    }
}
//Make whit Antonella Framework