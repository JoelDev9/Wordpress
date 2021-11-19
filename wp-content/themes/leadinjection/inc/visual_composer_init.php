<?php


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Force Visual Composer to initialize as "built into the theme".
 * This will hide certain tabs under the Settings->Visual Composer page
 */
add_action('vc_before_init', 'leadinjection_vcSetAsTheme');
function leadinjection_vcSetAsTheme()
{
    vc_set_as_theme();
}

/**
 * Deregister Visual Composer Styles
 */
// function leadinjection_derigister_vc_styles()
// {
//     wp_deregister_style('font-awesome');
// }
//add_action('wp_enqueue_scripts', 'leadinjection_derigister_vc_styles');


/**
 * Disable VC Frontend Editor for Modal Post Type
 */
add_action('the_post', 'leadinjection_disable_modal_vc');
function leadinjection_disable_modal_vc()
{
    global $post;
    if (!is_null($post)) {
        if ('li_modals' == $post->post_type) {
            vc_disable_frontend();
        }
    }
}

/**
 *  Deprecated Rebuild VC Elements
 */
add_action('vc_after_init', 'leadinjection_deprecated_elements');
function leadinjection_deprecated_elements()
{
    $settings = array(
        //'name' => __( 'new name', 'my-text-domain' ),
        'deprecated' => 'leadinjection V0.1 (Replaced with leadinjection Version)'
    );
    vc_map_update('vc_btn', $settings);
    vc_map_update('vc_column_text', $settings);
    vc_map_update('vc_icon', $settings);
    vc_map_update('vc_tta_accordion', $settings);
    vc_map_update('vc_single_image', $settings);
    vc_map_update('vc_video', $settings);
    vc_map_update('rev_slider', $settings);
    vc_map_update('vc_tta_tabs', $settings);
}

/**
 *  Remove Rebuild VC Elements
 */
add_action('vc_after_init', 'leadinjection_remove_elements');
function leadinjection_remove_elements()
{
    vc_remove_element("vc_wp_meta");
    vc_remove_element("vc_wp_archives");
    vc_remove_element("vc_wp_calendar");
    vc_remove_element("vc_wp_categories");
    vc_remove_element("vc_wp_links");
    vc_remove_element("vc_wp_meta");
    vc_remove_element("vc_wp_pages");
    vc_remove_element("vc_wp_posts");
    vc_remove_element("vc_wp_recentcomments");
    vc_remove_element("vc_wp_rss");
    vc_remove_element("vc_wp_search");
    vc_remove_element("vc_wp_tagcloud");
    vc_remove_element("vc_wp_text");
}

/**
 *  Set VC editor available by default
 */
add_action('vc_after_init', 'leadinjection_default_vc_editor');
function leadinjection_default_vc_editor()
{
    $list = array(
        'page',
        'post',
        'li_modals'
    );
    vc_set_default_editor_post_types($list);
}

/**
 * Disable VisualComposer activation massage
 */
setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');

