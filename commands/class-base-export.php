<?php

namespace bintzpress\CLI\TemplateExport\Command;

use WP_CLI;

class BaseExport extends BaseCommand {
        /**
     * The minimum WordPress version required
     */
    const WP_VERSION = '5.9RC1';

    /**
     * The WP-CLI Command Arguments
     * @var array
     */
    public $args, $assoc_args;
    public $post_id;
    public $post_type;

    public function __invoke( $args, $assoc_args ) {
        parent::__invoke( $args, $assoc_args );
        if ($this->validate_args()) {
            $this->run();
        }
    }

    protected function validate_args() {
        if (filter_var( $this->args[0], FILTER_VALIDATE_INT, array( 'options' => array( 'min_range'=>0)))) {
            $this->post_id = $this->args[0];
            return true;
        } else {
            WP_CLI::error("Invalid ID.");
            return false;
        }
    }

    protected function export($filename, $content) {
        print("Saving content to $filename\n");
        file_put_contents($filename, $content);
    }

    protected function run() {
        if (!isset($this->post_type)) {
            WP_CLI::error("Internal error: post type not set");
        } else { 
            global $wpdb;
            $rows = $wpdb->get_results("select post_name, post_content from wp_posts where ID = ".($this->post_id)." and (post_status = 'publish' or post_status = 'draft') and (post_type = '".($this->post_type).")");
            if (count($rows) == 0) {
                WP_CLI::error("Unable to find ID for draft or published template or template part");
            } else {
                if (count($rows) == 0) {
                    WP_CLI::error("No matches found for draft or published template or template part");
                } else if (count($rows) > 1) {
                    WP_CLI::error("Duplicate ID found. Only support one matching ID.");
                } else {
                    $filename = $rows[0]->post_name.".html";
                    $this->export($filename, $rows[0]->post_content);
                    WP_CLI::success("Finished successfully.");
                }
            }
        }
    }
}