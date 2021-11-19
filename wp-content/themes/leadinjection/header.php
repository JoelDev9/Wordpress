<?php
/**
 * The header for our theme.
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

// leadinjection Global options
$leadinjection_global_option = get_option( 'rdx_option' );

$li_global_menu_style = isset($leadinjection_global_option['li-global-menu-style']) ? $leadinjection_global_option['li-global-menu-style'] : 'default';

// leadinjection OnPage options
$leadinjection_onpage_favicon = get_post_meta( leadinjection_post_id(), 'li-onpage-favicon', true );
$leadinjection_onpage_raw_js_head = get_post_meta( leadinjection_post_id(), 'li-onpage-raw-js-head', true );
$leadinjection_onpage_preloader = get_post_meta( leadinjection_post_id(), 'li-onpage-preloader', true );
$leadinjection_onpage_header_nav = get_post_meta( leadinjection_post_id(), 'li-onpage-header-nav', true );
$leadinjection_onpage_display_mode = get_post_meta( leadinjection_post_id(), 'li-onpage-display-mode', true );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="js">
<head>
    <?php if(!empty( $leadinjection_onpage_raw_js_head )){
        echo str_replace(array("\r","\n"),"", $leadinjection_onpage_raw_js_head);
    } ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>

    <?php

    // Outputs leadinjection favicon code only if the user has not set a WP site icon
    // or if they are on versions of WordPress older than 4.3

    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) : ?>

        <?php if (!empty($leadinjection_global_option['li-global-favicon']['url']) && empty($leadinjection_onpage_favicon['url'])) : ?>
            <link rel="shortcut icon" href="<?php echo esc_url($leadinjection_global_option['li-global-favicon']['url']); ?>"/>
        <?php elseif (!empty($leadinjection_onpage_favicon['url'])) : ?>
            <link rel="shortcut icon" href="<?php echo esc_url($leadinjection_onpage_favicon['url']); ?>"/>
        <?php endif; ?>

    <?php endif; ?>

    <!--[if lt IE 9]><?php do_action('leadinjection_ie8_support'); echo apply_filters('leadinjection_ie9_support', '<!-- html5shiv -->'); ?><![endif]-->

    <?php
    if (!empty($leadinjection_global_option['li-global-css-code'])) { 
        echo sprintf("<style>%s</style>", $leadinjection_global_option['li-global-css-code']);
    }
    ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if(!empty($leadinjection_global_option['li-global-preloader']) && empty($leadinjection_onpage_preloader) || !empty($leadinjection_onpage_preloader) ) : ?>
    <div id="preloader">
        <div class="loader">Loading...</div>
    </div>
<?php endif; ?>


<div id="li-page-top" class="page-container <?php if(!empty($leadinjection_onpage_display_mode)){ echo esc_attr($leadinjection_onpage_display_mode); }else{ echo 'fluid'; } ?>">

    <?php switch ($li_global_menu_style){
        case 'header-style-2' : get_template_part('template-parts/header', 'style-2');
                                $page_class = ( 'fixed' == $leadinjection_onpage_header_nav ) ? ' header-fixed-style-2' : null;
                                break;

        default:                get_template_part('template-parts/header', 'style-1');
                                $page_class  = ( 'fixed' == $leadinjection_onpage_header_nav ) ? ' header-fixed-style-1' : null;
                                $page_class .= ( !empty($leadinjection_global_option['li-global-topbar'])  ) ? '-topbar' : null;
    } ?>



    <div id="page" class="hfeed site <?php echo esc_attr( $page_class ); ?>">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'leadinjection'); ?></a>



        <div id="content" class="site-content">
