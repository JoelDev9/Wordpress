<?php
/**
 * Template for Header Style 2
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

// leadinjection OnPage options
$leadinjection_onpage_header_nav = get_post_meta( leadinjection_post_id(), 'li-onpage-header-nav', true );
$leadinjection_onpage_nav_logo = get_post_meta( leadinjection_post_id(), 'li-onpage-nav-logo', true );

?>

<!-- start header nav -->
<?php if(empty($leadinjection_onpage_header_nav) || 'hidden' !== $leadinjection_onpage_header_nav) : ?>

    <div class="li-header header-style-1 <?php leadinjection_header_classes($leadinjection_global_option, $leadinjection_onpage_header_nav) ?>">


        <?php if( !empty($leadinjection_global_option['li-global-topbar']) ) : ?>
            <div class="li-topbar <?php if( 'fixed' == $leadinjection_onpage_header_nav ) : ?>navbar-widgets-fade<?php endif; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if( !empty($leadinjection_global_option['li-global-topbar-social-icons']) ) : ?>
                                <div class="social-icons">
                                    <?php leadinjection_global_social_icons(); ?>
                                </div>
                            <?php endif; ?>


                            <?php if( !empty($leadinjection_global_option['li-global-topbar-address']) ||
                                !empty($leadinjection_global_option['li-global-topbar-phone']) ||
                                !empty($leadinjection_global_option['li-global-topbar-email']) ) : ?>
                                <div class="contact-info">
                                    <?php if(!empty($leadinjection_global_option['li-global-topbar-address'])) : ?>
                                        <?php $topbar_address = ( !empty($leadinjection_global_option['li-global-topbar-address']) ) ? $leadinjection_global_option['li-global-topbar-address-content'] : ''; ?>
                                        <a class="address" href="https://www.google.com/maps/dir/Current+Location/<?php echo urlencode($topbar_address); ?>">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html($topbar_address); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if(!empty($leadinjection_global_option['li-global-topbar-phone'])) : ?>
                                        <?php $topbar_phone = ( !empty($leadinjection_global_option['li-global-topbar-phone']) ) ? $leadinjection_global_option['li-global-topbar-phone-content'] : ''; ?>
                                        <a class="phone" href="<?php printf("tel://%s", str_replace(' ', '', $topbar_phone)); ?>">
                                            <i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo esc_html($topbar_phone); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if(!empty($leadinjection_global_option['li-global-topbar-email'])) : ?>
                                        <?php $topbar_email = ( !empty($leadinjection_global_option['li-global-topbar-email']) ) ? $leadinjection_global_option['li-global-topbar-email-content'] : ''; ?>
                                        <a class="email" href="<?php printf("mailto:%s", str_replace(' ', '', $topbar_email)); ?>">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo esc_html($topbar_email); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <nav class="navbar">
            <?php if(class_exists('mega_main_init') && has_nav_menu( 'primary' )) : ?>

                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'primary-menu',
                ));
                ?>

            <?php else: ?>
                <div class="container fluid-on-sm navbar-default">
                    <div class="row">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                            <div class="navbar-brand-container">
                                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                                    <?php if (!empty($leadinjection_global_option['li-global-nav-logo']['url']) && empty($leadinjection_onpage_nav_logo['url'])) : ?>
                                        <img src="<?php echo esc_url( $leadinjection_global_option['li-global-nav-logo']['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
                                    <?php elseif(!empty($leadinjection_onpage_nav_logo['url'])) : ?>
                                        <img src="<?php echo esc_url ( $leadinjection_onpage_nav_logo['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
                                    <?php else : ?>
                                        <?php bloginfo('name'); ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>

                        <?php
                            wp_nav_menu(array(
                                    'menu' => 'primary',
                                    'theme_location' => 'primary',
                                    'depth' => 2,
                                    'container' => 'div',
                                    'container_class' => 'collapse navbar-collapse',
                                    'container_id' => 'bs-example-navbar-collapse-1',
                                    'menu_class' => 'nav navbar-nav navbar-right',
                                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                    'walker' => new wp_bootstrap_navwalker())
                            );
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </nav>

    </div>

<?php endif; ?>
<!-- end header nav -->