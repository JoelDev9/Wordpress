<?php
/**
* Plugin Name:     Leadinjection Core
* Plugin URI:      http://leadinjection.io
* Description:     Adds theme core functionality and shortcodes.
* Author:          Themeinjection
* Author URI:      http://themeinjection.com
* Version:         2.3.14
* Text Domain:     leadinjection
* License:         GPL3+
* License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(plugin_dir_path(__FILE__) . '/shortcodes/leadinjection_shortcodes.php');
require_once(plugin_dir_path(__FILE__) . '/redux_extensions/leadinjection_redux_extensions.php');
require_once(plugin_dir_path(__FILE__) . '/lead_modals/leadinjection_lead_modals.php');

/**
 * Gets the current post type in the WordPress Admin
 */
function leadinjection_get_current_post_type() {
    global $post, $typenow, $current_screen;

    if ( $post && $post->post_type ) {
        return $post->post_type;
    }
    elseif ( $typenow ) {
        return $typenow;
    }
    elseif ( $current_screen && $current_screen->post_type ) {
        return $current_screen->post_type;
    }
    elseif ( isset( $_REQUEST['post_type'] ) ) {
        return sanitize_key( $_REQUEST['post_type'] );
    }
    elseif ( isset( $_REQUEST['post'] ) ) {
        return get_post_type( $_REQUEST['post'] );
    }
    return null;
}

// Check the current post for the existence of a short code
function leadinjection_has_shortcode($shortcode = '') {

    $post_to_check = get_post(get_the_ID());
    $found = false;

    if (!$shortcode) {
        return $found;
    }

    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
        $found = true;
    }

    return $found;
}
