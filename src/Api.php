<?php

namespace NXHBQU;
defined('ABSPATH') or exit;

use NXHBQU\Config;

class Api
{
    /*
     * Construct
     * @return void
     */
    public function __construct()
    {
    }
    /*
     * initial function. you can call your functions here
     * @return void
     */
    public static function index()
    {
        $config = new Config();
        $apis = $config->api_endpoints_functions;
        if (count($apis) > 0) {
            foreach ($apis as $api) {
                if (isset($api[0]) && isset($api[1]) && isset($api[2])) {
                    \register_rest_route(
                        $config->api_endpoint_name . '/v' . $config->api_endpoint_version,
                        '/' . $api[0] . '/(?P<id>\d+)',
                        array(
                            'methods' => $api[1],
                            'callback' => $api[2],
                            'permission_callback' => '__return_true'
                        )
                    );
                }
            }
        }
    }
}
