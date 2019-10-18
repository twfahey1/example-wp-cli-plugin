<?php
/**
 * @package auditor
 * @version 1.0.0
 */
/*
Plugin Name: Auditor Plugin
Plugin URI:  https://github.com/twfahey1/example-wp-cli-plugin
Description: Provides various tools to audit your website.
Version:     1.0.0
Author:      Tyler Fahey
Author URI:  http://twf.dev
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Returns info about a table in the db.
 *
 * Returns an error if the option didn't exist.
 *
 * ## OPTIONS
 *
 * <key>
 * : Key for the option.
 *
 * ## EXAMPLES
 *
 *     $ wp auditor audit posts
 *     Success: Show `wp_posts` table info. (wp_ is whatever the prefix is set to for site.)
 */

 /**
  * The auditor class
  *
  * Provides the functionality for auditing. Can be called by wp_cli, other plugins, etc.
  */
class auditor {
  public function audit_table($key) {
    echo "Auditing data...\n";
    global $wpdb;
    $result = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . $key);
    if (isset($result)) {
      return [
        'number_of_rows' => count($result),
      ];
    }
    else {
      return NULL;
    }

  }
}

// Add the wp_cli functionality.
$audit_option_cmd = function( $args ) {
  list( $key ) = $args;
  $auditor = new auditor();
  $results = $auditor->audit_table($key);
  if (isset($results)) {
    echo $results['number_of_rows'] . " rows in posts table. \n";
    WP_CLI::success( "Audit successful" );
  } 
  else {
    WP_CLI::error( "Could not audit '$key' table. Does it exist?" );
  }
};
if ( class_exists( 'WP_CLI' ) ) {
  WP_CLI::add_command( 'auditor audit', $audit_option_cmd );
}