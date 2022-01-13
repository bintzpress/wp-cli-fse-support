<?php
/**
 * Plugin Name: FSE Support
 * Plugin URI: https://github.com/bintzpress/wp-cli-fse-support
 * Description: Using wp-cli, export templates and template parts from database
 * Version: 0.1.0
 * Author: Brian Bintz
 * Author URI: https://bintzpress.com
 * License: GPL v2.0
 */

namespace bintzpress\CLI\FSESupport\Command;

use WP_CLI;

if ( ! ( defined('WP_CLI') && WP_CLI )) {
    return;
}

require_once 'commands/class-template.php';
require_once 'commands/class-template-part.php';

WP_CLI::add_command( 'template', __NAMESPACE__.'\\Template');
WP_CLI::add_command( 'template-part', __NAMESPACE__.'\\TemplatePart');
