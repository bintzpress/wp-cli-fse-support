<?php

namespace bintzpress\CLI\FSESupport\Command;

use bintzpress\CLI\FSESupport\Core\PackageCore;

/**
 * Lists or exports template-parts from database
 */
class TemplatePart {
    /**
     * Lists the template-parts
     *
     * @param [type] $args
     * @param [type] $assoc_args
     * @return void
     */
    public function list($args, $assoc_args) {
        $core = new PackageCore();
        if ($core->wp_version_check()) {
            $core->list('wp_template_part');
        }
    }

    /**
     * Exports a template-part
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
            $core->export('wp_template_part', $args[0]);
        }
    }
}
