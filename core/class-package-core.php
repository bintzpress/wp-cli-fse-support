<?php

namespace bintzpress\CLI\FSESupport\Core;

use WP_CLI;
use function WP_CLI\Utils\wp_version_compare;

class PackageCore {
    const WP_VERSION = '5.9RC1';

    /**
	 * Compares the current installed version against script requirements.
	 *
	 * @throws WP_CLI\ExitException
	 */
	public function wp_version_check() {
		if ( ! wp_version_compare( self::WP_VERSION, '>=' ) ) {
			WP_CLI::error( sprintf( 'This script requires v%s or later of WordPress.', self::WP_VERSION ) );
			return false;
		} else {
			return true;
		}
	}

	public function list($post_type) {
		global $wpdb;
		$rows = $wpdb->get_results("select ID, post_name as name, post_title as title, post_modified as modified, post_status as status from wp_posts where post_type = '$post_type' and (post_status = 'publish' or post_status = 'draft') order by name, modified");
		WP_CLI\Utils\format_items('table', $rows, array('ID', 'name', 'title', 'modified', 'status'));   
	}

	public function id_check($id) {
		if (filter_var( $id, FILTER_VALIDATE_INT, array( 'options' => array( 'min_range'=>0)))) {
            return true;
        } else {
            return false;
        }
	}

	public function export($post_type, $id) {
		if ($this->id_check($id)) {
			global $wpdb;
            $rows = $wpdb->get_results("select post_name, post_content from wp_posts where ID = $id and (post_status = 'publish' or post_status = 'draft') and post_type = '$post_type'");
            if (count($rows) == 0) {
                WP_CLI::error("Unable to find ID for draft or published template or template part");
            } else {
                if (count($rows) == 0) {
                    WP_CLI::error("No matches found for draft or published template or template part");
                } else if (count($rows) > 1) {
                    WP_CLI::error("Duplicate ID found. Only support one matching ID.");
                } else {
                    $filename = $rows[0]->post_name.".html";
					file_put_contents($filename, $rows[0]->post_content);
					WP_CLI::success("Successful export to $filename");
                }
            }
		} else {
			WP_CLI::error("Invalid ID.");
		}
	}
}
