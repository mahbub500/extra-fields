<?php
/**
 * Perform when the plugin is being uninstalled
 */

// If uninstall is not called, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$deletable_options = [ 'extra-fields_version', 'extra-fields_install_time', 'extra-fields_docs_json', 'codexpert-blog-json' ];
foreach ( $deletable_options as $option ) {
    delete_option( $option );
}