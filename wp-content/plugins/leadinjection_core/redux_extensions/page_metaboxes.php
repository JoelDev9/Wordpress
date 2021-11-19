<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

return array(

    /**
     * Page Settings
     */
    array(
        'title' => __('Page Settings', 'leadinjection'),
        'icon' => 'el el-website', // Only used with metabox position normal or advanced
        'fields' => array(
            array(
                'id'       => 'li-onpage-sidebar',
                'type'     => 'image_select',
                'title' => __('Select Page Sidebar Layout', 'leadinjection'),
                'subtitle' => __('Default Sidebar Layout for the page.', 'leadinjection'),
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
                'default' => 'no-sidebar'
            ),

            array(
                'id' => 'li-onpage-display-mode',
                'type' => 'select',
                'title' => __('Page Width', 'leadinjection'),
                'subtitle' => __('Display Page in Box or Full Width mode', 'leadinjection'),
                'options' => array(
                    'fluid' => __('Display Page Full Width', 'leadinjection'),
                    'box' => __('Display Page Boxed', 'leadinjection'),
                ),
                'default' => 'fluid',
            ),

            array(
                'id' => 'li-onpage-title',
                'type' => 'switch',
                'title' => __('Page Title', 'leadinjection'),
                'subtitle' => __('Show Page Title', 'leadinjection'),
                'default' => false,
            ),

            array(
                'id' => 'li-onpage-title-bg-color',
                'type' => 'background',
                'title' => __('Blog Header Color/Image', 'leadinjection'),
                'subtitle' => __('Select a background color or an image for the blog header.', 'leadinjection'),
                'output' => array('.page-title'),
                'required' => array('li-onpage-title','equals',true),
            ),

            array(
                'id' => 'li-onpage-title-text-color',
                'type'     => 'color',
                'title'    => __('Blog Header Text Color', 'leadinjection'),
                'subtitle' => __('Select a text color for the blog header.', 'leadinjection'),
                'validate' => 'color',
                'output' => array('.page-title h1', '.page-title .breadcrumbs', '.page-title .breadcrumbs li a'),
                'required' => array('li-onpage-title','equals',true)
            ),

            array(
                'id' => 'li-onpage-header-nav',
                'type' => 'select',
                'title' => __('Global Navigation', 'leadinjection'),
                'subtitle' => __('Hide or Show Global Navigation', 'leadinjection'),
                'options' => array(
                    'show' => __('Show Global Navigation', 'leadinjection'),
                    'fixed' => __('Fixed at Top Global Navigation', 'leadinjection'),
                    'fade-in' => __('Fade In Global Navigation after scrolling', 'leadinjection'),
                    'hidden' => __('Hide Global Navigation', 'leadinjection'),
                ),
                'default' => 'show',
            ),

            array(
                'id' => 'li-onpage-footer',
                'type' => 'select',
                'title' => __('Global Footer', 'leadinjection'),
                'subtitle' => __('Hide or Show Global Footer', 'leadinjection'),
                'options' => array(
                    'show' => __('Show Global Footer', 'leadinjection'),
                    'hidden' => __('Hide Global Footer', 'leadinjection'),
                ),
                'default' => 'show',
            ),

            array(
                'id' => 'li-onpage-raw-js-head',
                'type' => 'textarea',
                'title' => __('Raw JS Head', 'leadinjection'),
                'subtitle' => __('Output raw JavaScript in to your page head.', 'leadinjection'),
            ),
        ),
    ),


    /**
     * Default Options
     */
    array(
        'title' => __('Default Options', 'leadinjection'),
        'id' => 'onpage-options',
        'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
        'icon' => 'el el-home',
        'fields' => array(
            array(
                'id' => 'li-onpage-typography',
                'type' => 'typography',
                'title' => __('Typography', 'leadinjection'),
                'google' => true,
                'font-backup' => true,
                'output' => array('body'),
                'units' => 'px',
                'all_styles' => true,
                'subtitle' => __('Typography option with each property can be called individually.', 'leadinjection'),
            ),
            array(
                'id' => 'li-onpage-color',
                'type' => 'color',
                'title' => __('Default Page color', 'leadinjection'),
                'subtitle' => __('Select a default page color.', 'leadinjection'),
                'validate' => 'color',
                'output' => require get_template_directory() . '/backend/redux-default-color.php',
            ),
            array(
                'id' => 'li-onpage-link-color',
                'type' => 'link_color',
                'title' => __('Default Link color', 'leadinjection'),
                'subtitle' => __('Select a default link color.', 'leadinjection'),
                'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
                'visited' => true,
                'output' => array('a'),
            ),
            array(
                'id' => 'li-onpage-page-background',
                'type' => 'background',
                'url' => true,
                'title' => __('Page Background Color/Image', 'leadinjection'),
                'subtitle' => __('Select the background color or an image for the page.', 'leadinjection'),
                'output' => array('body', '.js div#preloader'),

            ),
            array(
                'id' => 'li-onpage-content-background',
                'type' => 'background',
                'url' => true,
                'title' => __('Content Wrapper Background Color/Image', 'leadinjection'),
                'subtitle' => __('Select the background color or an image for the content wrapper.', 'leadinjection'),
                'output' => array('.page-container'),
            ),
            array(
                'id' => 'li-onpage-nav-logo',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', 'leadinjection'),
                'subtitle' => __('Upload your logo.', 'leadinjection'),
            ),
            array(
                'id' => 'li-onpage-favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Favicon Upload', 'leadinjection'),
                'subtitle' => __('Upload a 32px x 32px Png/Gif/Ico image that will represent your website favicon.', 'leadinjection'),
            ),
            array(
                'id' => 'li-onpage-preloader',
                'type' => 'switch',
                'title' => __('Use Page Pre-Loader?', 'leadinjection'),
                'subtitle' => __('Display a loading animation until the page loads completely.', 'leadinjection'),
            ),
            array(
                'id' => 'li-onpage-scroll-top',
                'type' => 'switch',
                'title' => __('Display a scroll to top button?', 'leadinjection'),
                'subtitle' => __('Display a scroll to top button at the corner bottom right.', 'leadinjection'),
                'required'  => array('li-global-scroll-top', '!=', true),
            ),
            array(
                'id' => 'li-onpage-raw-js-footer',
                'type' => 'textarea',
                'title' => __('Raw JS Footer', 'leadinjection'),
                'subtitle' => __('Output raw JavaScript in to your page footer.', 'leadinjection'),
            )
        )
    ),


    /**
     * Footer Options
     */
    array(
        'title' => __('Footer Options', 'leadinjection'),
        'id' => 'onpage-footer-options',
        'desc' => __('Default Theme Options for leadinjection', 'leadinjection'),
        'icon' => 'el el-adjust-alt',
        'fields' => array(
            array(
                'id' => 'li-onpage-footer-widget-bar-color',
                'type' => 'background',
                'title' => __('Widget Bar Background Color/Image', 'leadinjection'),
                'subtitle' => __('Select the background color or an image for the footer widget bar..', 'leadinjection'),
                'output' => array('.site-footer .footer-widget-bar'),
            ),
            array(
                'id' => 'li-onpage-footer-widget-bar-content-color',
                'type' => 'color',
                'title' => __('Widget Bar Content Color', 'leadinjection'),
                'subtitle' => __('Select the content color for the footer widget bar.', 'leadinjection'),
                'output' => array('.site-footer .footer-widget-bar'),
            ),
            array(
                'id' => 'li-onpage-footer-widget-bar-link-color',
                'type' => 'link_color',
                'title' => __('Default Footer Widget Bar Link color', 'leadinjection'),
                'subtitle' => __('Select a default footer widget bar link color.', 'leadinjection'),
                'visited' => true,
                'output' => array('.footer-widget-bar a, .widget ul li a'),
            ),
            array(
                'id' => 'li-onpage-footer-copyright',
                'type' => 'textarea',
                'title' => __('Footer Copyright', 'leadinjection'),
                'subtitle' => __('Copyright to display in footer.', 'leadinjection'),
                'desc' => __("Enter a copyright information or anything you'd like.", 'leadinjection'),
            ),
            array(
                'id' => 'li-onpage-footer-copyright-color',
                'type' => 'background',
                'title' => __('Copyright Bar Color/Image', 'leadinjection'),
                'subtitle' => __('Select the background color or an image for the footer widget bar..', 'leadinjection'),
                'output' => array('.site-footer .footer-copyright'),
            ),
            array(
                'id' => 'li-onpage-footer-social-icons',
                'type' => 'switch',
                'title' => __('Show Social icons', 'leadinjection'),
                'subtitle' => __('Display your Social icons in the footer if they set in <a href="/wp-admin/admin.php?page=leadinjection-options&tab=3">Socail Networks Tab.</a>', 'leadinjection'),
                'default' => false,
            )
        )
    ),

);