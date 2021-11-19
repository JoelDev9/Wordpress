<?php

/**
 * Template for Footer Style 1
 *
 * -------------------------------------------------------------------
 *
 * @package    Leadinjection WordPress Theme
 * @author     Themeinjection <info@themeinjection.com>
 * @copyright  2018 Themeinjection
 * @link       http://leadinjection.io/
 *
 * -------------------------------------------------------------------
 *
 */

// leadinjection Global options
$leadinjection_global_option = get_option('rdx_option');

// leadinjection OnPage options
$leadinjection_onpage_footer_copyright = get_post_meta(leadinjection_post_id(), 'li-onpage-footer-copyright', true);
$leadinjection_onpage_footer_social_icons = get_post_meta(leadinjection_post_id(), 'li-onpage-footer-social-icons', true);
?>

<footer id="colophon" class="li-footer li-footer-style-1">

    <?php if (is_active_sidebar('footer-widget-bar-col1') || is_active_sidebar('footer-widget-bar-col2') || is_active_sidebar('footer-widget-bar-col3')) : ?>
        <div class="footer-widget-bar footer-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('footer-widget-bar-col1')) {
                                if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 1 column')) : ?>
                            <?php endif;
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('footer-widget-bar-col2')) {
                                if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 2 column')) : ?>
                            <?php endif;
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('footer-widget-bar-col3')) {
                                if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 3 column')) : ?>
                            <?php endif;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="footer-copyright footer-row">
        <div class="container">
            <div class="row">

                <?php if (!empty($leadinjection_global_option['li-global-footer-copyright']) && false == $leadinjection_onpage_footer_copyright) : ?>
                    <div class="col-sm-8">
                        <div class="site-info">
                            <?php echo wp_kses(
                                $leadinjection_global_option['li-global-footer-copyright'],
                                array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array(),
                                        'target' => array(),
                                    ),
                                    'br' => array(),
                                    'em' => array(),
                                    'strong' => array()
                                )
                            ); ?>
                        </div>
                        <!-- .site-info -->
                    </div>
                <?php elseif (!empty($leadinjection_onpage_footer_copyright)) : ?>
                    <div class="col-sm-8">
                        <div class="site-info">
                            <?php echo wp_kses(
                                $leadinjection_global_option['li-global-footer-copyright'],
                                array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array(),
                                        'target' => array(),
                                    ),
                                    'br' => array(),
                                    'em' => array(),
                                    'strong' => array()
                                )
                            ); ?>
                        </div>
                        <!-- .site-info -->
                    </div>
                <?php endif; ?>


                <?php if (!empty($leadinjection_onpage_footer_social_icons) && !empty($leadinjection_global_option['li-global-footer-social-icons'])) : ?>
                    <div class="col-sm-4">
                        <div class="footer-social-icons">
                            <?php esc_html(leadinjection_global_social_icons()); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</footer>