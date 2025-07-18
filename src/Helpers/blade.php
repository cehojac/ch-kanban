<?php

if (class_exists('Jenssegers\Blade\Blade') && !function_exists('NXHBQU_view')) {
    function kanban_view($BladePage, $Attributes)
    {
        $blade = new Jenssegers\Blade\Blade(plugin_dir_path(dirname(dirname(__FILE__))) . 'resources/views', plugin_dir_path(dirname(dirname(__FILE__))) . 'storage/cache');

        $result = $blade->render($BladePage, $Attributes);

        return wp_kses_post($result);
    }
}
