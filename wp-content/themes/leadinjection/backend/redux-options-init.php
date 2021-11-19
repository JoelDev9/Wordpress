<?php
/**
 * Redux Framework Options.
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

if (!class_exists('Redux')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "rdx_option";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'opt_name' => $opt_name,
    'display_name' => 'Leadinjection',
    'display_version' => '2.3.14',
    'page_slug' => 'leadinjection-options',
    'page_title' => 'leadinjection Options',
    'update_notice' => TRUE,
    'admin_bar' => TRUE,
    'menu_type' => 'menu',
    'menu_title' => 'Leadinjection',
    'admin_bar_icon' => 'dashicons-admin-generic',
    'menu_icon' => get_template_directory_uri() . '/img/wp-nav-icon.png',
    'allow_sub_menu' => TRUE,
    'page_parent_post_type' => 'your_post_type',
    'customizer' => TRUE,
    'default_mark' => '*',
    'hints' => array(
        'icon_position' => 'right',
        'icon_size' => 'normal',
        'icon'              => 'el el-info-circle',
        'tip_style' => array(
            'color' => 'light',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'duration' => '500',
                'event' => 'mouseleave unfocus',
            ),
        ),
    ),
    'output' => TRUE,
    'output_tag' => TRUE,
    'settings_api' => TRUE,
    'cdn_check_time' => '1440',
    'compiler' => TRUE,
    'page_permissions' => 'manage_options',
    'save_defaults' => TRUE,
    'show_import_export' => TRUE,
    'database' => 'options',
    'transient_time' => '3600',
    'network_sites' => TRUE,
    'dev_mode' => FALSE,
);

Redux::setArgs($opt_name, $args);


Redux::setSection($opt_name, array(
    'title' => __('Default Options', 'leadinjection'),
    'id' => 'global-options',
    'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
    'icon' => 'el el-home',
    'fields' => array(
        array(
            'id' => 'li-global-heading-typography',
            'type' => 'typography',
            'title' => __('Heading Typography', 'leadinjection'),
            'google' => true,
            'font-backup' => true,
            'output' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
            'units' => 'px',
            'all_styles' => true,
            'line-height' => 'false',
            'font-size' => 'false',
            'text-align' => 'false',
            'color' => 'false',
            'subtitle' => __('Typography option with each property can be called individually.', 'leadinjection'),
            'default' => array(
                'color' => '#575756',
                'font-style' => '400',
                'font-family' => 'Lato',
                'google' => true,
            ),
        ),
        array(
            'id' => 'li-global-typography',
            'type' => 'typography',
            'title' => __('Typography', 'leadinjection'),
            'google' => true,
            'font-backup' => true,
            'output' => array('body'),
            'units' => 'px',
            'all_styles' => true,
            'subtitle' => __('Typography option with each property can be called individually.', 'leadinjection'),
            'default' => array(
                'color' => '#575756',
                'font-style' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '16px',
                'line-height' => '28px'
            ),
        ),
        array(
            'id' => 'li-global-color',
            'type'     => 'color',
            'title'    => __('Default Page color', 'leadinjection'),
            'subtitle' => __('Select a default page color.', 'leadinjection'),
            'validate' => 'color',
            'output' => require get_template_directory() . '/backend/redux-default-color.php',
        ),
        array(
            'id'       => 'li-global-link-color',
            'type'     => 'link_color',
            'title'    => __('Default Link color', 'leadinjection'),
            'subtitle' => __('Select a default link color.', 'leadinjection'),
            'visited'   => true,
            'focus'   => true,
            'output' => array('a', '.feature-icon-text-title a'),
        ),
        array(
            'id' => 'li-global-page-background',
            'type' => 'background',
            'url' => true,
            'title' => __('Page Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the page.', 'leadinjection'),
            'output' => array('body', '.js div#preloader'),
            'default'  => array(
                'background-color' => '#eeeeee',
            ),

        ),
        array(
            'id' => 'li-global-content-background',
            'type' => 'background',
            'url' => true,
            'title' => __('Content Wrapper Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the content wrapper.', 'leadinjection'),
            'output' => array('.page-container'),
            'default'  => array(
                'background-color' => '#ffffff',
            ),

        ),
        array(
            'id'       => 'li-global-content-row-width',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Row Width', 'leadinjection'),
            'subtitle' => __('Change the default max row width.', 'leadinjection'),
            'desc'     => __('Max content width is 1170px but rows can be wider.', 'leadinjection'),
            'height'   => false,
            'mode'     => array( 'width' => 'max-width', 'height' => false ),
            'default'  => array(
                'Width'   => '1170'
            ),
            'output'  => array('.row_default', 'row_stretched'),
        ),
        array(
            'id' => 'li-global-nav-logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'leadinjection'),
            'subtitle' => __('Set a default page logo. Note: The logo for the navigation is set in the Mega Main Menu section.', 'leadinjection'),
            'default' => array(
                'url' => get_template_directory_uri() . '/img/nav-logo.png'
            ),
        ),
        array(
            'id' => 'li-global-favicon',
            'type' => 'media',
            'url' => true,
            'title' => __('Favicon Upload', 'leadinjection'),
            'subtitle' => __('Upload a 32px x 32px Png/Gif/Ico image that will represent your website favicon.', 'leadinjection'),
            'default' => array(
                'url' => get_template_directory_uri() . '/img/favicon.png'
            ),
        ),
        array(
            'id' => 'li-global-preloader',
            'type' => 'switch',
            'title' => __('Use Page Pre-Loader?', 'leadinjection'),
            'subtitle' => __('Display a loading animation until the page loads completely.', 'leadinjection'),
            'default' => true,
        ),
        array(
            'id' => 'li-global-nice-mouse-scroll',
            'type' => 'switch',
            'title' => __('Enable Nice Page Scroll', 'leadinjection'),
            'subtitle' => __('Make the page scroll smoother with the mousewheel.', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-scroll-top',
            'type' => 'switch',
            'title' => __('Display a scroll to top button?', 'leadinjection'),
            'subtitle' => __('Display a scroll to top button at the corner bottom right.', 'leadinjection'),
            'default' => true,
        ),
        array(
            'id' => 'li-global-raw-js-footer',
            'type' => 'textarea',
            'title' => __('Raw JS Footer', 'leadinjection'),
            'subtitle' => __('Output raw JavaScript in to your page footer.', 'leadinjection'),
        )
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Header Options', 'leadinjection'),
    'id' => 'global-header-options',
    'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
    'icon' => 'el el-minus',
    'fields' => array(
        array(
            'id'       => 'li-global-menu-style',
            'type'     => 'image_select',
            'title' => __('Header Styles', 'leadinjection'),
            'subtitle' => __('Select the Style you want to use.', 'leadinjection'),
            'options'  => array(
                'header-style-1'      => array(
                    'alt'   => 'Header Style 1',
                    'img'   => get_template_directory_uri().'/img/header-style-1.png'
                ),
                'header-style-2'      => array(
                    'alt'   => 'Header Style 2',
                    'img'   => get_template_directory_uri().'/img/header-style-2.png'
                ),
            ),
            'default' => 'header-style-1'
        ),
        array(
            'id' => 'li-global-header-background',
            'type' => 'background',
            'title' => __('Header Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the header.', 'leadinjection'),
            'output' => array('.li-header.header-style-2 .header-top'),
            'required' => array('li-global-menu-style', '=', 'header-style-2'),
        ),
        array(
            'id' => 'li-global-header-shadow',
            'type' => 'switch',
            'title' => __('Disable Header Shadow', 'leadinjection'),
            'subtitle' => __('Disable the shadow at the header bottom.', 'leadinjection'),
            'hint' =>  array( 'content' => __('Useful on hero screen with a navigation at the top.', 'leadinjection') ),
            'default' => false,
        ),
        array(
            'id' => 'li-global-menu-background',
            'type' => 'background',
            'title' => __('Menu Background', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the header.', 'leadinjection'),
            'output' => array('.li-header'),
        ),
        array(
            'id' => 'li-global-menu-transparent-to-color',
            'type' => 'switch',
            'title' => __('Enable Menu Background (after scroll)', 'leadinjection'),
            'subtitle' => __('Change the Menu Background color after scroll.', 'leadinjection'),
            'hint' =>  array( 'content' => __('Useful on hero screen with a navigation at the top. Work only with menu option - Fixed at Top Global Navigation', 'leadinjection') ),
            'default' => false,
        ),
        array(
            'id' => 'li-global-menu-transparent-to-color-bg',
            'type' => 'background',
            'title' => __('Menu Background (after scroll)', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the header.', 'leadinjection'),
            'output' => array('.li-header.transparent-to-color', '.li-header.show'),
            'required' => array('li-global-menu-transparent-to-color', '=', true),
        ),
        array(
            'id'       => 'li-global-menue-border',
            'type'     => 'border',
            'title'    => __('Header Border Option', 'leadinjection'),
            'subtitle' => __('Select Header Border and Color.', 'leadinjection'),
            'output'   => array('.li-header'),
            'all'      => false,
            'left'     => true,
            'right'    => true,
            'top'      => true,
            'bottom'   => true,
        ),
        array(
            'id'       => 'li-global-menue-dropdown-border',
            'type'     => 'border',
            'title'    => __('Menu Dropdown Border Option', 'leadinjection'),
            'subtitle' => __('Select Menu Dropdown Border and Color.', 'leadinjection'),
            'output'   => array('.mega_main_menu .menu_holder .menu_inner > ul > li > .mega_dropdown'),
            'all'      => false,
            'left'     => true,
            'right'    => true,
            'top'      => true,
            'bottom'   => true,
        ),
        array(
            'id' => 'li-global-menue-transparent',
            'type' => 'switch',
            'title' => __('Enable Header Transparent', 'leadinjection'),
            'subtitle' => __('Header Transparent after scrolling down', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-topbar',
            'type' => 'switch',
            'title' => __('Enable Top Bar', 'leadinjection'),
            'subtitle' => __('Display a Top Bar above the Navigation', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-topbar-background',
            'type' => 'background',
            'url' => true,
            'title' => __('Top Bar Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the page.', 'leadinjection'),
            'output' => array('.li-topbar'),
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-icons',
            'type' => 'color',
            'url' => true,
            'title' => __('Top Bar Icon Color', 'leadinjection'),
            'subtitle' => __('Select the icon color.', 'leadinjection'),
            'output' => array('.li-topbar a i '),
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-icons-divider',
            'type' => 'border',
            'url' => true,
            'title' => __('Top Bar Icon Divider Color', 'leadinjection'),
            'subtitle' => __('Select the icon divider color.', 'leadinjection'),
            'output' => array('.li-topbar .social-icons a, .li-topbar .social-icons a:last-of-type'),
            'all'      => false,
            'left'     => true,
            'right'    => true,
            'top'      => true,
            'bottom'   => true,
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-content',
            'type' => 'color',
            'url' => true,
            'title' => __('Top Bar Content Color', 'leadinjection'),
            'subtitle' => __('Select the content color.', 'leadinjection'),
            'output' => array('.li-topbar .contact-info a '),
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-social-icons',
            'type' => 'switch',
            'title' => __('Show Social icons', 'leadinjection'),
            'subtitle' => __('Display your Social icons in the Top Bar if they set in Socail Networks Tab.', 'leadinjection'),
            'default' => false,
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-address',
            'type' => 'switch',
            'title' => __('Show Address', 'leadinjection'),
            'subtitle' => __('Display your Address in the Top Bar', 'leadinjection'),
            'default' => false,
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-address-content',
            'type' => 'text',
            'title' => __('Top Bar Address', 'leadinjection'),
            'subtitle' => __('Enter an Address for the Top Bar', 'leadinjection'),
            'required' => array('li-global-topbar-address', '=', true)
        ),
        array(
            'id' => 'li-global-topbar-phone',
            'type' => 'switch',
            'title' => __('Show Phone Number', 'leadinjection'),
            'subtitle' => __('Display your Phone Number in the Top Bar', 'leadinjection'),
            'default' => false,
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-phone-content',
            'type' => 'text',
            'title' => __('Top Bar Phone Numner', 'leadinjection'),
            'subtitle' => __('Enter an Phone Number for the Topbar', 'leadinjection'),
            'required' => array('li-global-topbar-phone', '=', true)
        ),
        array(
            'id' => 'li-global-topbar-email',
            'type' => 'switch',
            'title' => __('Show Email', 'leadinjection'),
            'subtitle' => __('Display your Email Address in the Top Bar', 'leadinjection'),
            'default' => false,
            'required' => array('li-global-topbar', '=', true),
        ),
        array(
            'id' => 'li-global-topbar-email-content',
            'type' => 'text',
            'title' => __('Top Bar Email', 'leadinjection'),
            'subtitle' => __('Enter an Email-Address for the Top Bar', 'leadinjection'),
            'required' => array('li-global-topbar-email', '=', true)
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Blog Options', 'leadinjection'),
    'id' => 'global-blog-options',
    'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
    'icon' => 'el el-adjust-alt',
    'fields' => array(
        array(
            'id' => 'li-global-blog-layout',
            'type' => 'text',
            'title' => __('Select Blog Page layout', 'leadinjection'),
            'desc' => __('Leave blank to use the translation string.', 'leadinjection'),
            'subtitle' => __('Default page title for blog, category and tag.', 'leadinjection'),
        ),
        array(
            'id'       => 'li-global-blog-layout',
            'type'     => 'image_select',
            'title' => __('Select Blog Page layout', 'leadinjection'),
            'subtitle' => __('Default Sidebar Layout for the blog.', 'leadinjection'),
            'options'  => array(
                'sidebar-right'      => array(
                    'alt'   => '1 Column',
                    'img'   => get_template_directory_uri().'/img/sidebar-right.png'
                ),
                'no-sidebar'      => array(
                    'alt'   => '2 Column Left',
                    'img'   => get_template_directory_uri().'/img/no-sidebar.png'
                ),
                'sidebar-left'      => array(
                    'alt'   => '2 Column Right',
                    'img'  => get_template_directory_uri().'/img/sidebar-left.png'
                )
            ),
            'default' => 'sidebar-right'
        ),
        array(
            'id' => 'li-global-blog-title',
            'type' => 'text',
            'title' => __('Blog / Category / Tag page Title', 'leadinjection'),
            'desc' => __('Leave blank to use the translation string.', 'leadinjection'),
            'subtitle' => __('Default page title for blog, category and tag.', 'leadinjection'),
        ),
        array(
            'id' => 'li-global-blog-title-enabled',
            'type' => 'switch',
            'title' => __('Default Page Title', 'leadinjection'),
            'desc' => __('Enable Page Title for all Posts by default', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-blog-excerpt',
            'type' => 'switch',
            'title' => __('Blog Listing (Post Excerpt)', 'leadinjection'),
            'desc' => __('Display only the excerpt on the post listing.', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-blog-excerpt-length',
            'type' => 'text',
            'title' => __('Excerpt Length', 'leadinjection'),
            'subtitle' => __('The number of words you want to show in the excerpt.', 'leadinjection'),
            'default' => '55',
            'required' => array('li-global-blog-excerpt', '=', true),
        ),
        array(
            'id' => 'li-global-blog-excerpt-text',
            'type' => 'text',
            'title' => __('Excerpt Link Text', 'leadinjection'),
            'subtitle' => __('Enter a excerpt link text.', 'leadinjection'),
            'desc' => __('Leave blank to use the translation string.', 'leadinjection'),
            'default' => ' [...]',
            'required' => array('li-global-blog-excerpt', '=', true),
        ),
        array(
            'id' => 'li-global-blog-bg-color',
            'type' => 'background',
            'title' => __('Blog Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select a background color or an image for the blog.', 'leadinjection'),
            'output' => array('.blog .page-container'),
        ),
        array(
            'id' => 'li-global-blog-header-bg-color',
            'type' => 'background',
            'title' => __('Blog Header Color/Image', 'leadinjection'),
            'subtitle' => __('Select a background color or an image for the blog header.', 'leadinjection'),
            'output' => array('.page-title'),
        ),
        array(
            'id' => 'li-global-blog-header-text-color',
            'type'     => 'color',
            'title'    => __('Blog Header Text Color', 'leadinjection'),
            'subtitle' => __('Select a text color for the blog header.', 'leadinjection'),
            'default'  => '#ffffff',
            'validate' => 'color',
            'output' => array('.page-title h1', '.page-title .breadcrumbs', '.page-title .breadcrumbs li a'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Footer Options', 'leadinjection'),
    'id' => 'global-footer-options',
    'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
    'icon' => 'el el-adjust-alt',
    'fields' => array(
        array(
            'id'       => 'li-global-footer-style',
            'type'     => 'image_select',
            'title' => __('Footer Styles', 'leadinjection'),
            'subtitle' => __('Select the Style you want to use.', 'leadinjection'),
            'options'  => array(
                'footer-style-1'      => array(
                    'alt'   => 'Footer Style 1',
                    'img'   => get_template_directory_uri().'/img/footer-style-1.png'
                ),
                'footer-style-2'      => array(
                    'alt'   => 'Footer Style 2',
                    'img'   => get_template_directory_uri().'/img/footer-style-2.png'
                ),
                'footer-style-3'      => array(
                    'alt'   => 'Footer Style 3',
                    'img'   => get_template_directory_uri().'/img/footer-style-3.png'
                ),
            ),
            'default' => 'footer-style-1'
        ),
        array(
            'id' => 'li-global-footer-widget-bar-color',
            'type' => 'background',
            'title' => __('Widget Bar Background Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the footer widget bar.', 'leadinjection'),
            'output' => array('.li-footer .footer-widget-bar'),
        ),
        array(
            'id' => 'li-global-footer-widget-bar-content-color',
            'type' => 'color',
            'title' => __('Widget Bar Content Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
            'output' => array('.li-footer .footer-widget-bar'),
        ),
        array(
            'id'       => 'li-global-footer-widget-bar-link-color',
            'type'     => 'link_color',
            'title'    => __('Default Footer Widget Bar Link color', 'leadinjection'),
            'subtitle' => __('Select a default footer widget bar link color.', 'leadinjection'),
            'visited'   => true,
            'output' => array('.footer-widget-bar a, footer .widget ul li a'),
        ),
        array(
            'id' => 'li-global-footer-copyright',
            'type' => 'textarea',
            'title' => __('Footer Copyright', 'leadinjection'),
            'subtitle' => __('Copyright to display in footer.', 'leadinjection'),
            'desc' => __("Enter a copyright information or anything you'd like.", 'leadinjection'),
            'default' => __('Copyright &copy; 2018 <a href="http://www.leadinjection.io">Leadinjection</a>. Powered by <a href="http://www.wordpress.org/">WordPress</a>.', 'leadinjection'),
        ),
        array(
            'id' => 'li-global-footer-copyright-color',
            'type' => 'background',
            'title' => __('Copyright Bar Color/Image', 'leadinjection'),
            'subtitle' => __('Select the background color or an image for the footer widget bar..', 'leadinjection'),
            'output' => array('.li-footer .footer-copyright'),
        ),
        array(
            'id' => 'li-global-footer-copyright-bar-content-color',
            'type' => 'color',
            'title' => __('Copyright Bar Content Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the copyright bar.', 'leadinjection'),
            'output' => array('.li-footer .footer-copyright'),
        ),
        array(
            'id'       => 'li-global-footer-copyright-link-color',
            'type'     => 'link_color',
            'title'    => __('Default Footer Copyright Link color', 'leadinjection'),
            'subtitle' => __('Select a default footer copyright link color.', 'leadinjection'),
            'visited'   => true,
            'output' => array('.footer-copyright a'),
        ),
        array(
            'id' => 'li-global-footer-social-icons',
            'type' => 'switch',
            'title' => __('Show Social icons', 'leadinjection'),
            'subtitle' => __('Display your Social icons in the footer if they set in Socail Networks Tab.', 'leadinjection'),
            'default' => true,
        )
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Custom Button Colors', 'leadinjection'),
    'id' => 'global-button-colors',
    'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
    'icon' => 'el el-tint',
    'fields' => array(

        // Custom Button 1
        array(
            'id' => 'li-global-custom-button-1',
            'type' => 'switch',
            'title' => __('Enable Custom Button Style 1', 'leadinjection'),
            'subtitle' => __('Create a Custom Button Style ( Class: btn-custom1 )', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-custom-button-1-text',
            'type' => 'color',
            'title' => __('Custom Button 1 Text Color', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text.', 'leadinjection'),
            'output' => array('color' => '.btn-custom1, .btn-custom1.btn-outline'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-text-hover',
            'type' => 'color',
            'title' => __('Custom Button 1 Text Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text (hover).', 'leadinjection'),
            'output' => array('color' => '.btn-custom1:hover'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-background-nom',
            'type' => 'color',
            'title' => __('Custom Button 1 Background Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom1'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-background-hover',
            'type' => 'color',
            'title' => __('Custom Button 1 Background Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom1:hover, .btn-custom1.btn-outline:hover, .btn-custom1:focus'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-border-nom',
            'type' => 'color',
            'title' => __('Custom Button 1 Border Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom1, .btn-custom1.btn-outline'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-border-hover',
            'type' => 'color',
            'title' => __('Custom Button 1 Border Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom1:hover, .btn-custom1.btn-outline:hover'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-1-shadow',
            'type' => 'color',
            'title' => __('Custom Button 1 3D Shadow Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
            'output' => array('border-bottom-color' => '.btn-custom1.btn-3d'),
            'required' => array('li-global-custom-button-1', '=', true)
        ),

        // Custom Button 2
        array(
            'id' => 'li-global-custom-button-2',
            'type' => 'switch',
            'title' => __('Enable Custom Button Style 2', 'leadinjection'),
            'subtitle' => __('Create a Custom Button Style ( Class: btn-custom2 )', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-custom-button-2-text',
            'type' => 'color',
            'title' => __('Custom Button 2 Text Color', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text.', 'leadinjection'),
            'output' => array('color' => '.btn-custom2, .btn-custom2.btn-outline'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-text-hover',
            'type' => 'color',
            'title' => __('Custom Button 2 Text Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text (hover).', 'leadinjection'),
            'output' => array('color' => '.btn-custom2:hover', '.btn-custom2.btn-outline:hover'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-background-nom',
            'type' => 'color',
            'title' => __('Custom Button 2 Background Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom2'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-background-hover',
            'type' => 'color',
            'title' => __('Custom Button 2 Background Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom2:hover, .btn-custom2.btn-outline:hover, .btn-custom2:focus'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-border-nom',
            'type' => 'color',
            'title' => __('Custom Button 2 Border Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom2, .btn-custom2.btn-outline'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-border-hover',
            'type' => 'color',
            'title' => __('Custom Button 2 Border Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom2:hover, .btn-custom2.btn-outline:hover'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-2-shadow',
            'type' => 'color',
            'title' => __('Custom Button 2 3D Shadow Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
            'output' => array('border-bottom-color' => '.btn-custom2.btn-3d'),
            'required' => array('li-global-custom-button-2', '=', true)
        ),

        // Custom Button 3
        array(
            'id' => 'li-global-custom-button-3',
            'type' => 'switch',
            'title' => __('Enable Custom Button Style 3', 'leadinjection'),
            'subtitle' => __('Create a Custom Button Style ( Class: btn-custom3 )', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-custom-button-3-text',
            'type' => 'color',
            'title' => __('Custom Button 3 Text Color', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text.', 'leadinjection'),
            'output' => array('color' => '.btn-custom3, .btn-custom3.btn-outline'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-text-hover',
            'type' => 'color',
            'title' => __('Custom Button 3 Text Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text (hover).', 'leadinjection'),
            'output' => array('color' => '.btn-custom3:hover'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-background-nom',
            'type' => 'color',
            'title' => __('Custom Button 3 Background Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom3'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-background-hover',
            'type' => 'color',
            'title' => __('Custom Button 3 Background Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom3:hover, .btn-custom3.btn-outline:hover, .btn-custom3:focus'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-border-nom',
            'type' => 'color',
            'title' => __('Custom Button 3 Border Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom3, .btn-custom3.btn-outline'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-border-hover',
            'type' => 'color',
            'title' => __('Custom Button 3 Border Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom3:hover, .btn-custom3.btn-outline:hover'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-3-shadow',
            'type' => 'color',
            'title' => __('Custom Button 3 3D Shadow Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
            'output' => array('border-bottom-color' => '.btn-custom3.btn-3d'),
            'required' => array('li-global-custom-button-3', '=', true)
        ),

        // Custom Button 4
        array(
            'id' => 'li-global-custom-button-4',
            'type' => 'switch',
            'title' => __('Enable Custom Button Style 4', 'leadinjection'),
            'subtitle' => __('Create a Custom Button Style ( Class: btn-custom4 )', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id' => 'li-global-custom-button-4-text',
            'type' => 'color',
            'title' => __('Custom Button 4 Text Color', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text.', 'leadinjection'),
            'output' => array('color' => '.btn-custom4, .btn-custom4.btn-outline'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-text-hover',
            'type' => 'color',
            'title' => __('Custom Button 4 Text Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select color for the Button Text (hover).', 'leadinjection'),
            'output' => array('color' => '.btn-custom4:hover'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-background-nom',
            'type' => 'color',
            'title' => __('Custom Button 4 Background Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom4'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-background-hover',
            'type' => 'color',
            'title' => __('Custom Button 4 Background Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('background-color' => '.btn-custom4:hover, .btn-custom4.btn-outline:hover, .btn-custom1:focus'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-border-nom',
            'type' => 'color',
            'title' => __('Custom Button 4 Border Color', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom4, .btn-custom4.btn-outline'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-border-hover',
            'type' => 'color',
            'title' => __('Custom Button 4 Border Color (Hover)', 'leadinjection'),
            'subtitle' => __('Select a Button Background Color (hover)', 'leadinjection'),
            'output' => array('border-color' => '.btn-custom4:hover, .btn-custom4.btn-outline:hover'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
        array(
            'id' => 'li-global-custom-button-4-shadow',
            'type' => 'color',
            'title' => __('Custom Button 4 3D Shadow Color', 'leadinjection'),
            'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
            'output' => array('border-bottom-color' => '.btn-custom4.btn-3d'),
            'required' => array('li-global-custom-button-4', '=', true)
        ),
    )
));



Redux::setSection($opt_name, array(
    'title' => __('API Keys', 'leadinjection'),
    'id' => 'li-global-api-keys',
    'icon' => 'el el-key',
    'fields' => array(
        array(
            'id'        => 'li-global-api-key-gmaps',
            'type'      => 'text',
            'title'     => __('Google Maps API Key', 'leadinjection'),
            'subtitle'  => __('Please enter your Google Maps API Key', 'leadinjection'),
            'desc'      => __('You can create a new Google Api Key here: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a>', 'leadinjection'),
            'default'   => '',
        )
    )
));



Redux::setSection($opt_name, array(
    'title' => __('Mobile Options', 'leadinjection'),
    'id' => 'li-global-mobile-option',
    'icon' => 'el el-phone-alt',
    'fields' => array(
        array(
            'id' => 'li-global-click-to-call-button',
            'type' => 'switch',
            'title' => __('Enable Click to Call Button', 'leadinjection'),
            'subtitle' => __('Display a click to call button on mobile devices', 'leadinjection'),
            'default' => false,
        ),
        array(
            'id'        => 'li-global-click-to-call-text',
            'type'      => 'text',
            'title'     => __('Button Text', 'leadinjection'),
            'subtitle'  => __('Enter a button text', 'leadinjection'),
            'default'   => 'Call Us: 0 (877) 123-4567',
        ),
        array(
            'id'        => 'li-global-click-to-call-phone',
            'type'      => 'text',
            'title'     => __('Phone Number', 'leadinjection'),
            'subtitle'  => __('Enter a phone number', 'leadinjection'),
            'default'   => '+08771234567 ',
        ),
        array(
            'id' => 'li-global-click-to-call-button-color',
            'type' => 'color',
            'title' => __('Select a Button Color', 'leadinjection'),
            'subtitle' => __('Select a button Background color', 'leadinjection'),
            'output' => array('background-color' => '.li-mobile-contact-bar .li-mobile-contact-bar-button'),
        ),
        array(
            'id' => 'li-global-click-to-call-text-color',
            'type' => 'color',
            'title' => __('Select a Text Color', 'leadinjection'),
            'subtitle' => __('Select a button text color', 'leadinjection'),
            'output' => array('color' => '.li-mobile-contact-bar .li-mobile-contact-bar-button a'),
        ),
        array(
            'id'       => 'li-global-click-to-call-devices',
            'type'     => 'select',
            'title'    => __('Select the Devices', 'leadinjection'),
            'subtitle' => __('Select the devices where the button should be shown', 'leadinjection'),
            'options'  => array(
                'hidden-sm hidden-md hidden-lg' => 'Only on Phones',
                'hidden-md hidden-lg' => 'Phones and Tablets'
            ),
            'default'  => 'hidden-sm hidden-md hidden-lg'
        )
    )
));



Redux::setSection($opt_name, array(
    'title' => __('Social Networks', 'leadinjection'),
    'id' => 'social_networks',
    'icon' => 'el el-network',
    'fields' => array(
        array(
            'id'        => 'sn_facebook_url',
            'type'      => 'text',
            'title'     => __('Facebook URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Facebook URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_twitter_url',
            'type'      => 'text',
            'title'     => __('Twitter URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Twitter URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_googleplus_url',
            'type'      => 'text',
            'title'     => __('Google+ URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Google+ URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_youtube_url',
            'type'      => 'text',
            'title'     => __('Youtube URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Youtube URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_vimeo_url',
            'type'      => 'text',
            'title'     => __('Vimeo URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Vimeo URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_linkedin_url',
            'type'      => 'text',
            'title'     => __('Linkedin URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Linkedin URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_tumblr_url',
            'type'      => 'text',
            'title'     => __('Tumblr URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Tumblr URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_pinterest_url',
            'type'      => 'text',
            'title'     => __('Pinterest URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Pinterest URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_skype_url',
            'type'      => 'text',
            'title'     => __('Skype ID', 'leadinjection'),
            'subtitle'  => __('Enter your skype ID.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_dribbble_url',
            'type'      => 'text',
            'title'     => __('Dribbble URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Dribbble URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_behance_url',
            'type'      => 'text',
            'title'     => __('Behance URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Behance URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_flickr_url',
            'type'      => 'text',
            'title'     => __('Flickr URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Flickr URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_instagram_url',
            'type'      => 'text',
            'title'     => __('Instagram URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Instagram URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_deviantart_url',
            'type'      => 'text',
            'title'     => __('Deviant Art URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Deviant Art URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_digg_url',
            'type'      => 'text',
            'title'     => __('Digg URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Digg URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        ),
        array(
            'id'        => 'sn_reddit_url',
            'type'      => 'text',
            'title'     => __('Reddit URL', 'leadinjection'),
            'subtitle'  => __('Please enter in your Reddit URL.', 'leadinjection'),

            'validate'  => 'url',
            'default'   => '',

        )
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Custom CSS', 'leadinjection'),
    'id' => 'global-css-code',
    'icon' => 'el el-css',
    'fields' => array(
        array(
            'id' => 'li-global-css-code',
            'type' => 'ace_editor',
            'title' => __('Custom CSS Code', 'leadinjection'),
            'subtitle' => __('Enter Custom CSS Code', 'leadinjection'),
            'options' => array('minLines'=> 30, 'showPrintMargin' => false),
            'mode'     => 'css',
            'theme'    => 'chrome',
            'desc' => __("Enter custom CSS (Note: it will be outputted on each page).", 'leadinjection'),
        ),

    )
));


/**
 * Disable Redux Framework Demo Mode.
 */
function leadinjection_remove_redux_demo() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'leadinjection_remove_redux_demo');
