<?php

/**
 * Antonella Helpers
 * Dont Touch this file
 * for more info
 * https://antonellaframework.com/documentacion
 */
defined( 'ABSPATH' ) or die( exit() );

foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
    require   $filename;
}
