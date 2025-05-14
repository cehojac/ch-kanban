<?php

namespace NXHBQU;
defined('ABSPATH') or die(exit());

class Config
{
    /*
     * Plugins option
     * storage in database the option value
     * Array ('option_name'=>'default value')
     * @example ["example_data" => 'foo',]
     * @return void
     */
    public $plugin_options = [];
    /**
     * Language Option
     * define a unique word for translate call
     */
    public $language_name = 'ch-kanban';
    public const TEXT_DOMAIN = 'ch-kanban';
    /**
     * Plugin text prefix
     * define a unique word for this plugin
     */
    public $plugin_prefix = 'ch_nella';
    /**
     * POST data process
     * get the post data and execute the function
     * @example ['post_data'=>'NXHBQU::function']
     */
    public $post = [
    ];
    /**
     * GET data process
     * get the get data and execute the function
     * @example ['get_data'=>'NXHBQU::function']
     */
    public $get = [
    ];
    /**
     * add_filter data functions
     * @input array
     * @example ['body_class','NXHBQU::function',10,2]
     * @example ['body_class',[__NAMESPACE__.'\ExampleController,'function'],10,2]
     */
    public $add_filter = [
    ];
    /**
     * add_action data functions
     * @input array
     * @example ['body_class','NXHBQU::function',10,2]
     * @example ['body_class',[__NAMESPACE__.'\ExampleController','function'],10,2]
     */
    public $add_action = [
        ['cmb2_admin_init', [__NAMESPACE__ . "\CMB2Controller", "index"], 99, 2],
        ['init', [__NAMESPACE__ . "\kanbanController", "DefineTaxValues"], 10, 2],
        ['wp_ajax_update_taxonomy', __NAMESPACE__ . '\kanbanController::UpdateTicket'],
        ['wp_ajax_nopriv_update_taxonomy', __NAMESPACE__ . '\kanbanController::UpdateTicket'],
        ['admin_enqueue_scripts', [__NAMESPACE__ . '\AdminController', 'jsAdmin'], 10, 1]
    ];
    /**
     * add custom shortcodes
     * @input array
     * @example [['example','__NAMESPACE__.\ExampleController::example_shortcode']]
     */
    public $shortcodes = [
        // ['example',__NAMESPACE__'.\ExampleController::example_shortcode']
    ];

    /**
     * add APIs Endpoints
     * @param array
     * @example [['name','GET',__NAMESPACE__.'\apiController::index']]
     * @example route: /wp-json/my-plugin-endpoint/v1/name
     */
    public $api_endpoint_name = 'ch-kanban-endpoint';
    public $api_endpoint_version = 1;
    public $api_endpoints_functions = [
        //    ['name','GET',__NAMESPACE__.'\ExampleController::example_api']
    ];

    /**
     * add Gutenberg's blocks
     */
    public $gutenberg_blocks = [
    ];
    /**
    * Dashboard

    * @reference: https://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget
    */
    public $dashboard = [
        [
            'slug' => '',
            'name' => '',
            'function' => '', // example: __NAMESPACE__.'\Admin\PageAdmin::DashboardExample',
            'callback' => '',
            'args' => '',
        ]

    ];
    /**
     * Files for use in Dashboard
     */
    public $files_dashboard = [];

    /*
     * Plugin menu
     * set your menu option here
     */
    public $plugin_menu = [
        [
            "path" => ["page"],
            "name" => "CH Kanban",
            "function" => __NAMESPACE__ . "\kanbanController::index",
            "icon" => "dashicons-excerpt-view",
            "slug" => "ch-kanban",
            "capability" => 'manage_options',
            "position" => 61,
            "subpages" => [
                [
                    "name" => "Add new card",
                    "slug" => "post-new.php?post_type=ticket",
                    "function" => "",
                ],
            ]
        ]
        /*
            [
                "path"      => ["page"],
                "name"      => "My Custom Page",
                "function"  => __NAMESPACE__."\Admin\PageAdmin::index",
                "icon"      => "antonella-icon.png",
                "slug"      => "my-custom-page",
            ]

                [
                    "path"      => ["page"],
                    "name"      => "My Custom Page",
                    "function"  => __NAMESPACE__."\Admin::option_page",
                   // "icon"      => "antonella-icon.png",
                    "slug"      => "my-custom-page",
                    "subpages"  =>
                    [
                        [
                            "name"      => "My Custom sub Page",
                            "slug"      => "my-top-sub-level-slug",
                            "function"  => __NAMESPACE__."\Admin::option_page",
                        ],
                        [
                            "name"      => "My  Sencond Custom sub Page",
                            "slug"      => "my-second-sub-level-slug",
                            "function"  => __NAMESPACE__."\Admin::option_page",
                        ],
                    ]
                ],
                [
                    "path"      => ["page"],
                    "name"      => "My SECOND Custom Page",
                    "function"  => __NAMESPACE__."\Admin::option_page",
                    "icon"      => "antonella-icon.png",
                    "slug"      => "my-SECOND-custom-page",
                    "subpages"  =>
                    [
                        [
                            "name"      => "My Custom sub Page",
                            "slug"      => "my-top-sub-level-slug-2",
                            "function"  => __NAMESPACE__."\Admin::option_page",
                        ],
                        [
                            "name"      => "My  Sencond Custom sub Page",
                            "slug"      => "my-second-sub-level-slug-2",
                            "function"  => __NAMESPACE__."\Admin::option_page",
                        ],
                    ]
                ],
                [
                    "path"      => ["subpage","tools.php"],
                    "name"      => "sub page in tools",
                    "slug"      => "sub-tools",
                    "function"  => __NAMESPACE__."\Admin::option_page",
                ],
                [
                    "path"      => ["option"],
                    "name"      => "sub page in option",
                    "slug"      => "sub-option",
                    "function"  => __NAMESPACE__."\Admin::option_page",
                ]
            */
    ];

    /**
     * Custom Post Type
     * for make simple Custom PostType
     * for simple add fill the 7 frist elements
     * for avanced fill
     * https://codex.wordpress.org/Function_Reference/register_post_type
     */

    public $post_types = [
        [
            "singular" => "Card",
            "plural" => "Cards",
            "slug" => "ticket",
            "position" => 12,
            "taxonomy" => ['estado', 'prioridad'], //['category','category2','category3'],
            "image" => "dashicons-schedule",
            "gutemberg" => false,
            "args" => [
                "show_in_menu" => false,
                "show_in_nav_menus" => false,
                "supports" => ['title', 'thumbnail']
            ]
            //advanced
            /*
            'labels'        => [],
            'args'          => [],
            'rewrite'       => []
            */
        ]
    ];

    /**
     * Taxonomies
     * for make taxonomies
     * for easy add only fill the 5 first elements
     * for avanced methods
     * https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    public $taxonomies = [
        [
            'post_type' => '',
            'singular' => '',
            'plural' => '',
            'slug' => '',
            'gutemberg' => true,
            //advanced
            /*
            "labels"        =>[],
            "args"          =>[],
            "rewrite"       =>[],
            "capabilities"  =>[]
            */
        ]
    ];

    /**
     * Widget
     * For register a Widget please:
     * Console: php antonella Widget "NAME_OF_WIDGET"
     * @input array
     * @example public $widget = [__NAMESPACE__.'\YouClassWidget']  //only the class
     */
    public $widgets = [];
}
