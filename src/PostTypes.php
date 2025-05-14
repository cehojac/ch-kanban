<?php

namespace NXHBQU;
defined('ABSPATH') or die(exit());

use NXHBQU\Config;

class PostTypes
{
    public static function index()
    {
        $config = new Config();
        $post_type = new PostTypes();
        $post_type_array = $config->post_types;
        $taxonomy_array = $config->taxonomies;
        if (is_array($post_type_array)) {
            foreach ($post_type_array as $pt) {
                if ($pt['singular']) {
                    $post_type->register_post_type($pt);
                }
            }
        }
        if (is_array($taxonomy_array)) {
            foreach ($taxonomy_array as $tx) {
                if ($tx['singular']) {
                    $post_type->add_taxonomy($tx);
                }
            }
        }
    }
    /**
     * Easy add new post_type and taxonomies
     * Add variables for create a new Post-Type
     * @version 3
     * @param array $pt From Config  $config->post_types
     * @return void
     */
    public function register_post_type($pt)
    {
        $config = new Config();
        $img = explode('.', $pt['image']);
        $image = (isset($img[1]) && strlen($img[1]) <= 4) ? plugins_url('assets/img/' . $pt['image'], dirname(__FILE__)) : $pt['image'];

        $singular = $pt['singular'];
        $plural = $pt['plural'];
        $slug = $pt['slug'];
        $taxonomy = $pt['taxonomy'];

        // Definición de variables de traducción
        $pt_label = $pt['labels']['name'] ?? $plural;
        $pt_singular_name = $pt['labels']['singular_name'] ?? $singular;
        // Comentario para ayudar a los traductores a entender el propósito del marcador de posición %s
        /* translators: %s es el nombre plural del tipo de contenido personalizado */
        $name = sprintf(__('%1$s', 'ch-kanban'), $pt_singular_name);
        $singular_name = sprintf(__('%s', Config::TEXT_DOMAIN), $pt_singular_name);
        $menu_name = __($pt['labels']['menu_name'] ?? $singular, Config::TEXT_DOMAIN);
        $all_items = __($pt['labels']['all_items'] ?? $plural, Config::TEXT_DOMAIN);
        $view_item = sprintf(esc_html__('See %s', Config::TEXT_DOMAIN), $singular);
        $add_new_item = sprintf(esc_html__('Add %s', Config::TEXT_DOMAIN), $singular);
        $add_new = sprintf(esc_html__('Add %s', Config::TEXT_DOMAIN), $singular);
        $edit_item = sprintf(esc_html__('Edit %s', Config::TEXT_DOMAIN), $singular);
        $update_item = sprintf(esc_html__('Update %s', Config::TEXT_DOMAIN), $singular);
        $search_items = sprintf(esc_html__('Search %s', Config::TEXT_DOMAIN), $singular);
        $not_found = sprintf(esc_html__('%s not found', Config::TEXT_DOMAIN), $singular);
        $not_found_in_trash = sprintf(esc_html__('%s not found in trash', Config::TEXT_DOMAIN), $singular);

        $labels = [
            'name' => $name,
            'singular_name' => $singular_name,
            'menu_name' => $menu_name,
            'all_items' => $all_items,
            'view_item' => $view_item,
            'add_new_item' => $add_new_item,
            'add_new' => $add_new,
            'edit_item' => $edit_item,
            'update_item' => $update_item,
            'search_items' => $search_items,
            'not_found' => $not_found,
            'not_found_in_trash' => $not_found_in_trash,
        ];

        $rewrite = [
            'slug' => $slug,
            'with_front' => $pt['rewrite']['with_front'] ?? true,
            'pages' => $pt['rewrite']['pages'] ?? true,
            'feeds' => $pt['rewrite']['feeds'] ?? false,
        ];

        $description = sprintf(esc_html__('Info about %s', Config::TEXT_DOMAIN), $singular);

        $args = [
            'label' => __($pt['args']['label'] ?? $plural, Config::TEXT_DOMAIN),
            'labels' => $labels,
            'description' => $description,
            'supports' => $pt['args']['supports'] ?? ['title', 'editor', 'comments', 'thumbnail'],
            'public' => $pt['args']['public'] ?? true,
            'publicly_queryable' => $pt['args']['publicly_queryable'] ?? true,
            'show_ui' => $pt['args']['show_ui'] ?? true,
            'delete_with_user' => $pt['args']['delete_with_user'] ?? null,
            'show_in_rest' => $pt['args']['show_in_rest'] ?? ($pt['gutemberg'] == false ? false : true),
            'rest_base' => $pt['args']['rest_base'] ?? $slug,
            'rest_controller_class' => $pt['args']['rest_controller_class'] ?? 'WP_REST_Posts_Controller',
            'has_archive' => $pt['args']['has_archive'] ?? $slug,
            'show_in_menu' => $pt['args']['show_in_menu'] ?? true,
            'show_in_nav_menus' => $pt['args']['show_in_nav_menus'] ?? true,
            'exclude_from_search' => $pt['args']['exclude_from_search'] ?? false,
            'capability_type' => $pt['args']['capability_type'] ?? 'post',
            'map_meta_cap' => $pt['args']['map_meta_cap'] ?? true,
            'hierarchical' => $pt['args']['hierarchical'] ?? false,
            'rewrite' => $pt['args']['rewrite'] ?? ['slug' => $slug, 'with_front' => true],
            'query_var' => $pt['args']['query_var'] ?? true,
            'menu_position' => $pt['args']['position'] ?? ($pt['position'] ?? 4),
            'menu_icon' => $image,
        ];

        register_post_type($slug, $args);

        // Registrar taxonomías
        if (is_array($taxonomy) && count($taxonomy) > 0) {
            foreach ($taxonomy as $tx) {
                register_taxonomy(
                    $tx,
                    [$slug],
                    [
                        'label' => __($tx, Config::TEXT_DOMAIN),
                        'show_in_rest' => true,
                        'show_ui' => true,
                        'show_admin_column' => true,
                        'query_var' => true
                    ]
                );
            }
        }
    }


    /**
     * Add taxonomies
     * Add variables for create a new Taxonomy
     * @version 1.0
     * @param array $tx From Config  $config->post_types
     * @return void
     */

    public function add_taxonomy($tx)
    {
        $config = new Config();
        $labels = [];
        $args = [];
        $capabilities = [];
        $rewrite = [];
        $post_type = $tx['post_type'];
        $singular = $tx['singular'];
        $plural = $tx['plural'];
        $slug = $tx['slug'];


        // Definición de variables de traducción
        $name = _x($tx['labels']['name'] ?? $plural, 'Taxonomy general name', Config::TEXT_DOMAIN);
        $singular_name = _x($tx['labels']['singular_name'] ?? $singular, 'Taxonomy singular name', Config::TEXT_DOMAIN);
        $search_items = sprintf(esc_html__('Search %s', Config::TEXT_DOMAIN), $singular);
        $all_items = sprintf(esc_html__('All %s', Config::TEXT_DOMAIN), $singular);
        $parent_item = sprintf(esc_html__('Parent %s', Config::TEXT_DOMAIN), $singular);
        $parent_item_colon = sprintf(esc_html__('Parent %s:', Config::TEXT_DOMAIN), $singular);
        $edit_item = sprintf(esc_html__('Edit %s', Config::TEXT_DOMAIN), $singular);
        $view_item = sprintf(esc_html__('View %s', Config::TEXT_DOMAIN), $singular);
        $update_item = sprintf(esc_html__('Update %s', Config::TEXT_DOMAIN), $singular);
        $add_new_item = sprintf(esc_html__('Add new %s', Config::TEXT_DOMAIN), $singular);
        $new_item_name = sprintf(esc_html__('New %s', Config::TEXT_DOMAIN), $singular);
        $menu_name = _x($tx['labels']['menu_name'] ?? $plural, 'Taxonomy menu name', Config::TEXT_DOMAIN);
        $popular_items = _x('Popular ' . $plural, 'Taxonomy popular items', Config::TEXT_DOMAIN);
        $labels = [
            'name' => $name,
            'singular_name' => $singular_name,
            'search_items' => $search_items,
            'all_items' => $all_items,
            'parent_item' => $parent_item,
            'parent_item_colon' => $parent_item_colon,
            'edit_item' => $edit_item,
            'view_item' => $view_item,
            'update_item' => $update_item,
            'add_new_item' => $add_new_item,
            'new_item_name' => $new_item_name,
            'menu_name' => $menu_name,
            'popular_items' => $popular_items,
        ];

        $rewrite = [
            'slug' => $slug,
            'with_front' => $tx['args']['rewrite']['with_front'] ?? $tx['rewrite']['with_front'] ?? true,
            'hierarchical' => $tx['args']['rewrite']['hierarchical'] ?? $tx['rewrite']['hierarchical'] ?? false,
            'ep_mask' => $tx['args']['rewrite']['ep_mask'] ?? $tx['rewrite']['ep_mask'] ?? EP_NONE,
        ];
        $args = [
            'hierarchical' => $tx['args']['hierarchical'] ?? true,
            'labels' => $labels,
            'show_ui' => $tx['args']['show_ui'] ?? true,
            'public' => $tx['args']['public'] ?? true,
            'publicly_queryable' => $tx['args']['publicly_queryable'] ?? true,
            'show_admin_column' => $tx['args']['show_admin_column'] ?? true,
            'show_in_menu' => $tx['args']['show_in_menu'] ?? true,
            'show_in_rest' => $tx['args']['show_in_rest'] ?? ($tx['gutemberg'] == false ? false : true),
            'query_var' => $slug,
            'rest_base' => $tx['args']['rest_base'] ?? $plural,
            'rest_controller_class' => $tx['args']['rest_controller_class'] ?? 'WP_REST_Terms_Controller',
            'show_tagcloud' => $tx['args']['show_tagcloud'] ?? $tx['args']['show_ui'] ?? true,
            'show_in_quick_edit' => $tx['args']['show_in_quick_edit'] ?? $tx['args']['show_ui'] ?? true,
            'meta_box_cb' => $tx['args']['meta_box_cb'] ?? null,
            'show_in_nav_menus' => $tx['args']['show_in_nav_menus'] ?? true,
            'rewrite' => $rewrite,
            'capabilities' => $capabilities,
            'description' => $tx['args']['description'] ?? '',
        ];

        $capabilities = [
            'manage_terms' => $tx['args']['capabilities']['manage_terms'] ?? $tx['capabilities']['manage_terms'] ?? 'manage_' . $slug,
            'edit_terms' => $tx['args']['capabilities']['edit_terms'] ?? $tx['capabilities']['edit_terms'] ?? 'manage_' . $slug,
            'delete_terms' => $tx['args']['capabilities']['delete_terms'] ?? $tx['capabilities']['delete_terms'] ?? 'manage_' . $slug,
            'assign_terms' => $tx['args']['capabilities']['assign_terms'] ?? $tx['capabilities']['assign_terms'] ?? 'edit_' . $slug,
        ];

        register_taxonomy($plural, [$post_type], $args);
    }

    public static function registrer_term_tax($terms, $tax)
    {
        $config = new Config;
        $parent_term = term_exists($tax);
        $parent_term_id = isset($parent_term['term_id']) ? $parent_term['term_id'] : '';
        foreach ($terms as $term) {
            wp_insert_term(
                __($term, $config->language_name),   // the term 
                $tax, // the taxonomy
                array(
                    //  'description' => $description,
                    'slug' => strtolower($term),
                    'parent' => $parent_term_id,
                )
            );
        }
    }
}
