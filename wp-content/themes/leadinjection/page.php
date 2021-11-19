<?php
/**
 * The template for displaying all pages.
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

// Check if Blog Home page
if(is_home()){
    $post_id = get_option( 'page_for_posts' );
}else{
    $post_id = get_the_ID();
}
$leadinjection_onpage_title = get_post_meta( $post_id, 'li-onpage-title', true );

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php get_template_part('template-parts/title', 'page'); ?>

        <?php while (have_posts()) : the_post(); ?>
            <div class="site-main-content">
            <?php get_template_part('template-parts/content', 'page'); ?>
            </div>
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>
