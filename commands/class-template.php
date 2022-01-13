<?php

namespace bintzpress\CLI\FSESupport\Command;

use bintzpress\CLI\FSESupport\Core\PackageCore;

use WP_CLI;

/**
 * Lists or exports templates from database.
 */
class Template {
    /**
     * Prints a list of templates
     *
     * @param [type] $args
     * @param [type] $assoc_args
     * @return void
     */
    public function list($args, $assoc_args) {
        $core = new PackageCore();
        if ($core->wp_version_check()) {
            $core->list('wp_template');
        }
    }

    /**
     * Exports a template to a file in the current directory named after the template.
     * 
     * ## Options
     * 
     * <id>
     * : The id of the template to export.
     * ---
     * optional: false
     * 
     * @param [type] $args
     * @param [type] $assoc_args
     * @return void
     */
    public function export($args, $assoc_args) {
        $core = new PackageCore();
        if ($core->wp_version_check()) {
            $core->export('wp_template', $args[0]);
        }
    }
}