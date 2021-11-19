<?php
/**
 * Plugin Name:     Leadinjection Redux Extensions
 * Plugin URI:      http://leadinjection.io
 * Description:     Adds Redux extensions like  to the theme
 * Author:          Themeinjection
 * Author URI:      http://themeinjection.com
 * Version:         1.1.7
 * Text Domain:     leadinjection
 * License:         GPL3+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load Redux Extensions
require_once plugin_dir_path( __FILE__ ) . 'extensions-init.php';

