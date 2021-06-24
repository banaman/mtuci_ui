<?php

defined('MOODLE_INTERNAL') || die();
class theme_mtuci_ui_core_renderer extends core_renderer {

    public function navbar_plugin_time() {
        $output = '';
        date_default_timezone_set('Europe/Moscow');
        $time = date('H:i', time());
        $output .= $time;

        return $output;
    }
}