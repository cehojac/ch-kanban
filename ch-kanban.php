<?php
namespace NXHBQU;
/*
Plugin Name: CH Kanban
Plugin URI:
Description: Create a simple kanban in youtr wordpress for your tasks
Version: 1.0
Author: Carlos Herrera
Author URI:
Framework: Antonella Framework for WP
Framework URI: http://antonellaframework.com
License: GPL2+
Text Domain: ch-kanban
Domain Path: /languages
*/

defined('ABSPATH') or die(exit());

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