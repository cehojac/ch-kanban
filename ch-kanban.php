<?php
namespace NXHBQU;
/*
Plugin Name: CH Kanban
Plugin URI:
Description: CH Kanban is a visual task management tool in Kanban style integrated into the WordPress dashboard. Ideal for teams or individuals who want to organize tickets or workflows directly from their admin panel.
Version: 1.0
Requires at least: 4.7
Tested up to: 6.6 < 6.8
Author: Carlos Herrera
Author URI:
Framework: Antonella Framework for WP
Framework URI: http://antonellaframework.com
License: GPL2+
Text Domain: ch-kanban
Domain Path: /languages
*/

defined('ABSPATH') or exit;

/*
 * Class Caller.
 * cuando una clase es llamada hace un include
 * al archivo con su mismo nombre
 * se respeta mayusculas y minusculas
 *
 * @return null
 */
$loader = require __DIR__ . '/vendor/autoload.php';
$antonella = new Start;


?>