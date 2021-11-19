<?php
/**
 * Mega Main Menu default configurations.
 *
 * -------------------------------------------------------------------
 *
 * @package    Leadinjection WordPress Theme
 * @author     Themeinjection <info@themeinjection.com>
 * @copyright  2016 Themeinjection
 * @link       http://leadinjection.io/
 *
 * -------------------------------------------------------------------
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(class_exists('mega_main_init')) {

    add_filter('mmm_skin_extend', 'leadinjection_extend_mmm_css');
    function leadinjection_extend_mmm_css()
    {
        $my_css_rules = '.mega_main_menu > .menu_holder > .menu_inner > ul > li.nav_search_box .mega_main_menu_searchform {  border: none; margin-top: -14px;}';
        $my_css_rules .= '.mega_main_menu .menu_holder .menu_inner > ul > li { padding-bottom: 20px; }';
        $my_css_rules .= '.mega_main_menu.responsive-enable.mobile_minimized-enable > .menu_holder > .menu_inner > .nav_logo .mobile_toggle .mobile_button * { vertical-align: sub;}';
        $my_css_rules .= '.mega_main_menu .menu_holder .menu_inner > .nav_logo .mobile_toggle .mobile_button .symbol_menu{ font-size: 36px; }';
        return $my_css_rules;
    }

    add_filter('mmm_set_configuration', 'my_function_to_set_mmm_configuration');
    function my_function_to_set_mmm_configuration($default_configuration)
    {

        // Get configuration of the plugin that is stored in the DataBase.
        $saved_configuration = get_option('mega_main_menu_options', array());

        if (($saved_configuration === false) || empty($saved_configuration)) {

            // If you do not have a saved configuration in the database - do your code.

            $theme_custom_configuration = array(
                'mega_menu_locations' => array('is_checkbox', 'primary'),
                'primary_included_components' => array('is_checkbox', 'company_logo'),
                'primary_first_level_item_height' => '40',
                'primary_primary_style' => 'flat',
                'primary_first_level_button_height' => '30',
                'primary_first_level_item_align' => 'right',
                'primary_first_level_icons_position' => 'left',
                'primary_first_level_separator' => 'none',
                'primary_corners_rounding' => '',
                'primary_dropdowns_trigger' => 'hover',
                'primary_dropdowns_animation' => 'anim_2',
                'primary_mobile_minimized' => array('is_checkbox', 'true'),
                'primary_mobile_label' => 'MENU',
                'primary_direction' => 'horizontal',
                'primary_fullwidth_container' => array('is_checkbox', 'true'),
                'primary_first_level_item_height_sticky' => '40',
                'primary_sticky_status' => array('is_checkbox'),
                'primary_sticky_offset' => '',
                'primary_pushing_content' => array('is_checkbox'),
                'logo_src' => get_template_directory_uri() . '/img/nav-logo.png',
                'logo_height' => '100',
                'primary_menu_bg_gradient' => array(
                    'color1' => '',
                    'start' => '100',
                    'color2' => '',
                    'end' => '100',
                    'orientation' => 'top'
                ),
                'primary_menu_bg_image' => array(
                    'background_image' => '',
                    'background_repeat' => 'repeat',
                    'background_attachment' => 'scroll',
                    'background_position' => 'center',
                    'background_size' => 'auto',
                ),
                'primary_menu_first_level_link_font' => array(
                    'font_family' => 'Inherit',
                    'font_size' => '16',
                    'font_weight' => '400',
                ),
                'primary_menu_first_level_link_color' => '#575756',
                'primary_menu_first_level_icon_font' => '20',
                'primary_menu_first_level_link_bg' => array(
                    'color1' => '#ffffff',
                    'start' => '0',
                    'color2' => '#ffffff',
                    'end' => '100',
                    'orientation' => 'top',
                ),
                'primary_menu_first_level_link_color_hover' => '#06A1F2',
                'primary_menu_first_level_link_bg_hover' => array(
                    'color1' => '#ffffff',
                    'start' => '0',
                    'color2' => '#ffffff',
                    'end' => '100',
                    'orientation' => 'top',
                ),
                'primary_menu_search_bg' => '#ffffff',
                'primary_menu_search_color' => '#575756',
                'primary_menu_dropdown_wrapper_gradient' => array(
                    'color1' => '#ffffff',
                    'start' => '0',
                    'color2' => '#ffffff',
                    'end' => '100',
                    'orientation' => 'top',
                ),
                'primary_menu_dropdown_link_font' =>
                    array(
                        'font_family' => 'Inherit',
                        'font_size' => '14',
                        'font_weight' => '400',
                    ),
                'primary_menu_dropdown_link_color' => '#575756',
                'primary_menu_dropdown_icon_font' => '16',
                'primary_menu_dropdown_link_bg' => array(
                    'color1' => '#ffffff',
                    'start' => '0',
                    'color2' => '#ffffff',
                    'end' => '100',
                    'orientation' => 'top',
                ),
                'primary_menu_dropdown_link_border_color' => '#ECF0F1',
                'primary_menu_dropdown_link_color_hover' => '#ffffff',
                'primary_menu_dropdown_link_bg_hover' => array(
                    'color1' => '#06A1F2',
                    'start' => '0',
                    'color2' => '#06A1F2',
                    'end' => '100',
                    'orientation' => 'top',
                ),
                'primary_menu_dropdown_plain_text_color' => '#333333',

                'additional_styles_presets' =>
                    array(
                        array(
                            'style_name' => 'Button',
                            'font' =>
                                array(
                                    'font_family' => 'Inherit',
                                    'font_size' => '16',
                                    'font_weight' => '600',
                                ),
                            'icon' =>
                                array(
                                    'font_size' => '18',
                                ),
                            'text_color' => '#f8f8f8',
                            'bg_gradient' =>
                                array(
                                    'color1' => '#40AFFB',
                                    'start' => '100',
                                    'color2' => '#40AFFB',
                                    'end' => '0',
                                    'orientation' => 'top',
                                ),
                            'text_color_hover' => '#f8f8f8',
                            'bg_gradient_hover' =>
                                array(
                                    'color1' => '#A1C627',
                                    'start' => '0',
                                    'color2' => '#A1C627',
                                    'end' => '100',
                                    'orientation' => 'top',
                                ),
                        ),
                        array(
                            'style_name' => 'Menu Heading',
                            'font' =>
                                array(
                                    'font_family' => 'Inherit',
                                    'font_size' => '16',
                                    'font_weight' => '400',
                                ),
                            'icon' =>
                                array(
                                    'font_size' => '12',
                                ),
                            'text_color' => '#33495F',
                            'bg_gradient' =>
                                array(
                                    'color1' => '',
                                    'start' => '0',
                                    'color2' => '',
                                    'end' => '100',
                                    'orientation' => 'top',
                                ),
                            'text_color_hover' => '#33495F',
                            'bg_gradient_hover' =>
                                array(
                                    'color1' => '',
                                    'start' => '0',
                                    'color2' => '',
                                    'end' => '100',
                                    'orientation' => 'top',
                                ),
                        ),
                    ),

                'custom_css' => '',
                'responsive_styles' => array('is_checkbox', 'true'),
                'responsive_resolution' => '1024',
                'icon_sets' => array('is_checkbox', 'icomoon'),
                'coercive_styles' => array('is_checkbox'),
                'indefinite_location_mode' => array('is_checkbox'),
                'number_of_widgets' => '1',
                'language_direction' => 'ltr',
                'item_descr' => array('is_checkbox'),
                'item_style' => array('is_checkbox'),
                'item_visibility' => array('is_checkbox'),
                'item_icon' => array('is_checkbox'),
                'disable_text' => array('is_checkbox'),
                'disable_link' => array('is_checkbox'),
                'pull_to_other_side' => array('is_checkbox'),
                'submenu_type' => array('is_checkbox'),
                'submenu_drops_side' => array('is_checkbox'),
                'submenu_columns' => array('is_checkbox'),
                'submenu_enable_full_width' => array('is_checkbox'),
                'submenu_bg_image' => array('is_checkbox'),
            );

            add_option('mega_main_menu_options', $theme_custom_configuration);
        } else {
            // If you have configuration stored in the DataBase - do nothing.
            //  print_r( $default_configuration );
            return false;
        }

    }


    /**
     * Remove MMM Meta Box on Post, Page, Modal
     */
    add_action('do_meta_boxes', 'leadinjection_remove_mmm_meta_boxes');
    function leadinjection_remove_mmm_meta_boxes()
    {
        remove_meta_box('mm_general', 'post', 'normal');
        remove_meta_box('mm_general', 'page', 'normal');
        remove_meta_box('mm_general', 'li_modals', 'normal');
        remove_meta_box('mm_general', 'lilm_leads', 'normal');
        remove_meta_box('mm_general', 'li_forms', 'normal');
        remove_meta_box('mm_general', 'product', 'normal');
    }


    /**
     * Image Link Setup (needed for Mega Main Menu media selection)
     */
    add_action('admin_init', 'leadinjection_imagelink_setup', 10);
    function leadinjection_imagelink_setup() {
        $image_set = get_option( 'image_default_link_type' );

        if ($image_set !== 'file') {
            update_option('image_default_link_type', 'file');
        }
    }

    /**
     *  Remove MMM VC Element
     */
    add_action('vc_after_init', 'leadinjection_remove_mmm_element');
    function leadinjection_remove_mmm_element()
    {
        vc_remove_element("mega_main_menu");
    }

} // end plugin is active
