<?php
/**
 * Custom 
 *
 * -------------------------------------------------------------------
 *
 * @package    Leadinjection WordPress Theme
 * @author     Marcel Maedche <info@themeinjection.com>
 * @copyright  2016 Themeinjection
 * @license    GNU GPL, Version 3
 * @link       http://themeforest.net/user/themeinjection
 *
 * -------------------------------------------------------------------
 *
*/

/************************************************************************
 * Extended Example:
 * Way to set menu, import revolution slider, and set home page.
 *************************************************************************/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !function_exists( 'wbc_leadinjection_data' ) ) {
    function wbc_leadinjection_data( $demo_active_import , $demo_directory_path ) {
        reset( $demo_active_import );
        $current_key = key( $demo_active_import );
        /************************************************************************
         * Import slider(s) for the current demo being imported
         *************************************************************************/
        if ( class_exists( 'RevSlider' ) ) {
            $wbc_sliders_array = array(
                'Application'       => 'application-slider.zip', //Set slider zip name
                'Online-Course'     => 'online-course-slider.zip',
                'Medical-Services'  => 'medical-slider.zip',
                'Ebook'             => 'ebook-slider.zip',
                'SEO-Service'       => 'seo-service-slider.zip',
                'Insurance'         => 'insurance-slider.zip',
                'Move'              => 'move-slider.zip',
                'Cryptocurrency'    => 'cryptocurrency-slider.zip',
                'Landscape'         => 'landscape-slider.zip',
                'Business-Coach'    => 'business-coach-slider.zip',
                'Diet'              => 'diet_slider.zip',
            );
            if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
                if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
                }
            }
        }
        /************************************************************************
         * Setting Menus
         *************************************************************************/
        $wbc_menu_array = array(
            'Application'       => 'Main Menu Top',
            'Conference'        => 'Conference Main Menu Top',
            'Medical-Services'  => 'Medical Navigation Top',
            'Ebook'             => 'Ebook Top Navigation',
            'SEO-Service'       => 'SEO Top Navigation',
            'Insurance'         => 'Main Menu',
            'Move'              => 'Move Main Menu',
            'Cryptocurrency'    => 'Cryptocurrency Main Menu',
            'Landscape'         => 'Landscape Main Menu',
            'Business-Coach'    => 'Main Menu',
            'Diet'              => 'Main Menu',
        );

        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
            $top_menu = get_term_by( 'name', $wbc_menu_array[$demo_active_import[$current_key]['directory']], 'nav_menu' );

            $footer_widget_menu = get_term_by( 'name', 'Footer Widget Menu', 'nav_menu' );
            if ( isset( $top_menu->term_id ) ) {
                // Set Primary Nav
                set_theme_mod( 'nav_menu_locations', array(
                        'primary' => $top_menu->term_id
                    )
                );
            }
        }
        /************************************************************************
         * Set HomePage
         *************************************************************************/
        $wbc_home_pages = array(
            'Application'       => 'Application Landing Page',
            'Online-Course'     => 'Online Courses Landing Page',
            'Conference'        => 'Conference Landing Page',
            'Medical-Services'  => 'Medical Landing Page',
            'Ebook'             => 'Ebook Landing Page',
            'SEO-Service'       => 'SEO Service Landing Page',
            'Insurance'         => 'Insurance Landing Page',
            'Move'              => 'Move Landing Page',
            'Cryptocurrency'    => 'Cryptocurrency Landing Page',
            'Landscape'         => 'Landscape Landing Page',
            'Business-Coach'    => 'Business Coach Landing Page',
            'Diet'              => 'Diet Landing Page',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }
        /************************************************************************
         * Mega Main Menu Options
         *************************************************************************/
        $wbc_mmm_array = array(
            'Application'       => 'mega-main-menu.txt',
            'Online-Course'     => 'mega-main-menu.txt',
            'Conference'        => 'mega-main-menu.txt',
            'Medical-Services'  => 'mega-main-menu.txt',
            'Ebook'             => 'mega-main-menu.txt',
            'SEO-Service'       => 'mega-main-menu.txt',
            'Insurance'         => 'mega-main-menu.txt',
            'Move'              => 'mega-main-menu.txt',
            'Cryptocurrency'    => 'mega-main-menu.txt',
            'Landscape'         => 'mega-main-menu.txt',
            'Business-Coach'    => 'mega-main-menu.txt',
            'Diet'    => 'mega-main-menu.txt',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_mmm_array ) ) {

            $wbc_mmm_options_import = $wbc_mmm_array[$demo_active_import[$current_key]['directory']];

            if ( file_exists( $demo_directory_path.$wbc_mmm_options_import ) ) {
                $options_string = file_get_contents($demo_directory_path.$wbc_mmm_options_import);
                $mmm_options = json_decode($options_string, true);
                update_option( 'mega_main_menu_options', $mmm_options );
                clear_mega_main_menu_cache();
            }
        }
        /************************************************************************
         * Set BlogPage
         *************************************************************************/
        $wbc_home_pages = array(
            'Application'       => 'Blog',
            'Insurance'         => 'Insurance Blog',
            'Move'              => 'Blog',
            'Cryptocurrency'    => 'Blog',
            'Landscape'         => 'Blog',
            'Business-Coach'    => 'Blog',
            'Diet'    => 'Blog',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_for_posts', $page->ID );
            }
        }
    }

    add_action( 'wbc_importer_after_content_import', 'wbc_leadinjection_data', 10, 2 );


    /**
     * Clean Wordpress for Demo Content
     */
    add_action( 'import_start', 'leadinjection_clean_wp_before_import' );
    function leadinjection_clean_wp_before_import(){

        global $wpdb;

        $removed = array();
        if($wpdb->query("TRUNCATE TABLE $wpdb->posts")) $removed[] = 'Posts removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->postmeta")) $removed[] = 'Postmeta removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->comments")) $removed[] = 'Comments removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->commentmeta")) $removed[] = 'Commentmeta removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->links")) $removed[] = 'Links removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->terms")) $removed[] = 'Terms removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->term_relationships")) $removed[] = 'Term relationships removed';
        if($wpdb->query("TRUNCATE TABLE $wpdb->term_taxonomy")) $removed[] = 'Term Taxonomy removed';
        if($wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('_transient_%')")) $removed[] = 'Transients removed';
        if($wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('wbc_imported_demos')")) $removed[] = 'WBC Imported Demos Removed';
        if($wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('sidebars_widgets')")) $removed[] = 'Sidebar Widgets Removed';

        $wpdb->query("OPTIMIZE TABLE $wpdb->options");
    }

    /**
     * Add Backup Notice to the Demo Importer
     */
    add_filter( 'wbc_importer_description', 'lp_wbc_importer_description', 10, 3 );
    function lp_wbc_importer_description(){
        $importer_desc      = '<p class="importer-notice"><strong>Important:</strong> Each landing page ships with individual configuration and options. Importing data is recommended on fresh installs only. If you import or re-import a demo it will be overwrite your current posts, pages, configurations, options, images etc. All Images are for demo purpose only. ';
        $importer_desc .= 'Before importing demo content, please <a href="https://codex.wordpress.org/WordPress_Backups">back up your database and files</a>.</p>';
        return $importer_desc;
    }

    /**
     * Clear Mega Main Menu cached skin files
     */
    function clear_mega_main_menu_cache(){
        $mmm_plugin_dir = ABSPATH . "wp-content/plugins/mega_main_menu/src/css/";
        $cache_files = scandir($mmm_plugin_dir);
        foreach ($cache_files as $file){
            if (substr($file, 0, 5) === 'cache') {
                if (file_exists($mmm_plugin_dir.$file)) {
                       unlink($mmm_plugin_dir.$file);
                }
            }
        }
    }


}
