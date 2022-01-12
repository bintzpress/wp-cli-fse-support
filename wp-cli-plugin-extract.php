<?php
/**
 * Plugin Name: WP CLI Extract
 * Plugin URI: https://github.com/bintzpress/wp-cli-extract
 * Description: Using wp-cli, extract templates and template parts from database
 * Version: 0.1.0
 * Author: Brian Bintz
 * Author URI: https://bintzpress.com
 * License: GPL v2.0
 */

 if ( ! ( defined('WP_CLI') && WP_CLI )) {
     return;
 }

 /**
  * Extract templates and template parts from database
  */
function bp_wpcli_extract( $args, $assoc_args ) {
    WP_CLI::success('Extracted template or template part');
}
WP_CLI::add_command( 'plugin extract', 'bp_wpcli_extract');
