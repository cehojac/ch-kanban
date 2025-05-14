<?php

/**
 * No modify this file !!!
 */

namespace NXHBQU;
defined('ABSPATH') or die(exit());

use NXHBQU\Config;

class Request
{
    public $post_data = array();
    public $get_data = array();
    /**
     * Index function
     * Create the process data
     * @return void
     */
    public function __construct()
    {
        $config = new Config();
        $this->sanitizeRequest();
        $this->process($config->post);
        $this->process($config->get);
    }
    private function sanitizeRequest()
    {
        foreach ($_REQUEST as $key => $value) {
            // Sanitiza cada valor según si es un array o un valor simple
            if (is_array($value)) {
                $_REQUEST[$key] = filter_var_array($value, FILTER_SANITIZE_STRING);
            } else {
                $_REQUEST[$key] = \sanitize_text_field($value);
            }
        }
    }

    /**
     * process function
     * process the request input (POST and GET)
     * @param [type] $datas the config array (post and get)
     * @return void
     */
    public function process($datas)
    {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        foreach ($datas as $key => $data) {
            if (isset($_REQUEST[$key])) {
                call_user_func_array($data, ($_REQUEST));
            } else {
                continue;
            }
        }
    }
}

