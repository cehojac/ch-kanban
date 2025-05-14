<?php

namespace NXHBQU;
defined('ABSPATH') or die(exit());

use NXHBQU\Config;

class Install
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
        $install = new Install();
        $install->plugin_options($config->plugin_options);
    }
    /*
     * Table Updates
     * @ver 1.0
     * se genera una nueva columna en las tablas de WP
     *
     * @return void
     */
    public function table_updates($tablename, $params)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $table = $wpdb->prefix . $tablename;
        foreach ($params as $param) {
            $wpdb->prepare("ALTER TABLE %s ADD  %s %s;", [$table, $param['name'], $param['attr']]);
        }
    }

    /*
     * Table Create
     * @ver 1.0
     * @return null
     */
    public function table_create($options)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        foreach ($options as $sql) {
            if ($wp->prepare("SHOW TABLES LIKE  %s ", $sql['table']) != $sql['table']) {
                $wpdb->prepare("CREATE TABLE IF NOT EXISTS %s ( %s ) ENGINE=InnoDB DEFAULT NXHBQUARSET=latin1 AUTO_INCREMENT=1 ;", [$sql['table'], $sql['query']]);
            }
        }
    }

    /*
     * Plugin's Options on first install
     * @ver 1.0
     * @description: no modify
     * @return void
     */
    public function plugin_options($options)
    {
        foreach ($options as $key => $option) {
            add_option($key, $option);
        }
    }
}
