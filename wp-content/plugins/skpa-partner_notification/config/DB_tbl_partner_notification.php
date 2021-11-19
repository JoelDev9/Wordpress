<?php
function create_plugin_database_table() {
 global $wpdb;
 $table_name = $wpdb->prefix . 'sandbox';
 $sql = "CREATE TABLE $table_name (
 id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
 title varchar(50) NOT NULL,
 structure longtext NOT NULL,
 author longtext NOT NULL,
 PRIMARY KEY  (id)
 );";

 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_plugin_database_table' );

?>