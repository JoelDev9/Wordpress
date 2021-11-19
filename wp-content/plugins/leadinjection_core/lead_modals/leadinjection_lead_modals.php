<?php
/**
 * Plugin Name:     Leadinjection - Lead Modals
 * Plugin URI:      http://leadinjection.io
 * Description:     Adds custom post type leadModals to the theme.
 * Author:          Themeinjection
 * Author URI:      http://themeinjection.com
 * Version:         1.1.7
 * Text Domain:     leadinjection
 * License:         GPL3+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Register Modal Post Type
 */
add_action('init', 'leadinjection_li_modals_post_type');
function leadinjection_li_modals_post_type()
{
    register_post_type('li_modals',
        array(
            'labels' => array(
                'name' => __('Lead Modals', 'leadinjection'),
                'singular_name' => __('Lead Modal', 'leadinjection')
            ),
            'menu_icon' => 'dashicons-share-alt2',
            'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
            'publicly_queryable' => true,  // you should be able to query it
            'show_ui' => true,  // you should be able to edit it in wp-admin
            'exclude_from_search' => true,  // you should exclude it from search results
            'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
            'has_archive' => false,  // it shouldn't have archive page
            'rewrite' => false,  // it shouldn't have rewrite rules
        )
    );
}

/**
 * Enqueue scripts and styles backend.
 */
function li_leadmanager_enqueue_scripts_backend(){
    if('li_modals' == leadinjection_get_current_post_type()){
        wp_enqueue_script('li_modals-admin-js', plugin_dir_url( __FILE__ ) . '/custom.js', array('jquery'), false, true);
    }
}
add_action('admin_enqueue_scripts', 'li_leadmanager_enqueue_scripts_backend');

/**
 * Yoast VC JS Conflict Fix
 */
add_action( 'vc_backend_editor_render', 'leadinjection_vc_yoast_fix_conflict', 9999 );
function leadinjection_vc_yoast_fix_conflict() {
    wp_dequeue_script( 'vc_vendor_yoast_js' );
    if ( wp_script_is( 'yoast-seo-post-scraper' ) ) {
        wp_enqueue_script( 'vc_vendor_yoast_js', vc_asset_url( 'js/vendors/yoast.js' ), array( 'yoast-seo-post-scraper' ), WPB_VC_VERSION, true );
    }
}

/**
 * Create Modal Output Style
 */
function leadinjection_create_modal_styles($modal_id){

    $modal_meta = get_post_meta($modal_id);
    $modal_id_str = '#liModal-'.$modal_id;

    $style  = '';

    // Admin
    $style .= (is_admin_bar_showing()) ? '.li-modal .modal-dialog { margin: 32px auto 0 auto; }' : null;

    // Page Scrolling
    if(!empty($modal_meta['li-modal-scrolling'][0])) {
        $style .=  '.liModal-'.$modal_id.'-open { overflow: visible; padding-right: 0px !important; }';
    }

    // Modal Backdrop
    if(!empty($modal_meta['li-modal-backdrop'][0])) {
        $style .= $modal_id_str.'{ pointer-events: none; }';
        $style .= $modal_id_str.' .modal-dialog .modal-content{ pointer-events: auto; }';
    }

    // Modal width
    if(!empty($modal_meta['li-modal-width'][0])) {
        $modal_width = unserialize($modal_meta['li-modal-width'][0]);
        // Width
        if(!empty($modal_width['width']) && 'px' != $modal_width['width'] && '%' != $modal_width['width']) {
            $style .= $modal_id_str . ' .modal-dialog { max-width: ' . $modal_width['width'] . '; }';
            $style .= $modal_id_str . ' .modal-dialog .modal-content .vc_row{ max-width: ' . $modal_width['width'] . '; }';
            $style .= ('100%' == $modal_width['width']) ? $modal_id_str . ' .modal-dialog { width: ' . $modal_width['width'] . ' !important; }' : null;
        }
    }

    // Modal height
    if(!empty($modal_meta['li-modal-height'][0])) {
        $modal_height = unserialize($modal_meta['li-modal-height'][0]);
        // Height
        if(!empty($modal_height['height']) && 'px' != $modal_height['height'] && '%' != $modal_height['height']){
            $style .= $modal_id_str.' .modal-dialog { height: ' . $modal_height['height'] . ' ; }';
            $style .= $modal_id_str.' .modal-dialog .modal-content{ height: '.$modal_height['height'].' ; overflow: auto; }';
        }
    }

    // Modal Position
    if(!empty($modal_meta['li-modal-position'][0])){
        $modal_position = $modal_meta['li-modal-position'][0];
        $style .= ('top_left' == $modal_position) ? $modal_id_str.' .modal-dialog { position: absolute; top: 0; left: 0 }' : null;
        $style .= ('top_right' == $modal_position) ? $modal_id_str.' .modal-dialog { position: absolute; top: 0; right: 0 }' : null;
        $style .= ('bottom_left' == $modal_position) ? $modal_id_str.' .modal-dialog { position: absolute; bottom: 0; left: 0 }' : null;
        $style .= ('bottom_right' == $modal_position) ? $modal_id_str.' .modal-dialog { position: absolute; bottom: 0; right: 0 }' : null;
    }

    // Modal Spacing
    if(!empty($modal_meta['li-modal-spacing'][0])){
        $modal_spacing = unserialize($modal_meta['li-modal-spacing'][0]);
        $style .= (!empty($modal_spacing['margin-top'])) ? $modal_id_str.' .modal-dialog { margin-top: ' . $modal_spacing['margin-top'] . '; }' : null;
        $style .= (!empty($modal_spacing['margin-right'])) ? $modal_id_str.' .modal-dialog { margin-right: ' . $modal_spacing['margin-right'] . '; }' : null;
        $style .= (!empty($modal_spacing['margin-bottom'])) ? $modal_id_str.' .modal-dialog { margin-bottom: ' . $modal_spacing['margin-bottom'] . '; }' : null;
        $style .= (!empty($modal_spacing['margin-left'])) ? $modal_id_str.' .modal-dialog { margin-left: ' . $modal_spacing['margin-left'] . '; }' : null;
    }

    // Modal Background
    if(!empty($modal_meta['li-modal-background'][0])){
        $modal_background = $modal_meta['li-modal-background'][0];
        $style .= (!empty($modal_background)) ? $modal_id_str.' .modal-dialog .modal-content{ background-color: '.$modal_background.' !important; overflow: auto; }' : null;
    }

    // Modal Border
    if(!empty($modal_meta['li-modal-border'][0])){
        $modal_border = unserialize($modal_meta['li-modal-border'][0]);
        $border_style_color = $modal_border['border-style']. ' ' .$modal_border['border-color'];
        $style .= (!empty($modal_border['border-top'])) ? $modal_id_str.' .modal-dialog .modal-content { border-top: ' . $modal_border['border-top'] . ' ' .$border_style_color. ' !important; }' : null;
        $style .= (!empty($modal_border['border-right'])) ? $modal_id_str.' .modal-dialog .modal-content { border-right: ' . $modal_border['border-right'] . ' ' .$border_style_color. ' !important; }' : null;
        $style .= (!empty($modal_border['border-bottom'])) ? $modal_id_str.' .modal-dialog .modal-content { border-bottom: ' . $modal_border['border-bottom'] . ' ' .$border_style_color. ' !important; }' : null;
        $style .= (!empty($modal_border['border-left'])) ? $modal_id_str.' .modal-dialog .modal-content { border-left: ' . $modal_border['border-left'] . ' ' .$border_style_color. ' !important; }' : null;
    }

    // Modal Shadow
    if(!empty($modal_meta['li-modal-shadow'][0])){
        $modal_shadow = $modal_meta['li-modal-shadow'][0];
        $style .= (!empty($modal_shadow)) ? $modal_id_str.' .modal-dialog .modal-content{ box-shadow: none; }' : null;
    }

    // Backdrop color
    if(!empty($modal_meta['li-modal-backdrop-color'][0])){
        $modal_backdrop_color = $modal_meta['li-modal-backdrop-color'][0];
        $style .= (!empty($modal_meta['li-modal-backdrop-color'][0])) ? $modal_id_str.'-backdrop{ background-color: '.$modal_backdrop_color.'; }' : null;
    }

    // Close Button Color
    if(!empty($modal_meta['li-modal-close-button-color'][0])){
        $modal_close_button_color = unserialize($modal_meta['li-modal-close-button-color'][0]);
        $style .= (!empty($modal_close_button_color['regular'])) ? $modal_id_str.' .modal-dialog .modal-content .close{ color: '.$modal_close_button_color['regular'].'; opacity:1; }' : null;
        $style .= (!empty($modal_close_button_color['hover'])) ? $modal_id_str.' .modal-dialog .modal-content .close:hover{ color: '.$modal_close_button_color['hover'].'; opacity:1; }' : null;
    }

    // Visual Composer Styles
    if(!empty($modal_meta['_wpb_shortcodes_custom_css'][0])){
        $style .= $modal_meta['_wpb_shortcodes_custom_css'][0];
    }

    return $style;
}

