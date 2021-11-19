<?php
/**
 * Template part for displaying page content in page.php.
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

if(is_home()){
    $post_id = get_option( 'page_for_posts' );
}else{
    $post_id = get_the_ID();
}

$leadinjection_onpage_sidebar = get_post_meta( $post_id, 'li-onpage-sidebar', true );

if(!empty($leadinjection_onpage_sidebar)){
    switch($leadinjection_onpage_sidebar){

        case 'sidebar-left':    $col_class = "sidebar-left";
                                break;

        case 'no-sidebar':      $col_class = "no-sidebar";
                                break;

        default:                $col_class = "sidebar-right";
    }
}else{
    $col_class = 'no-sidebar';
}
?>


<?php if('no-sidebar' != $col_class) : ?> 
<div class="container page-content-area <?php echo esc_attr( $col_class ); ?>">
    <div class="page-main-content">
<?php endif; ?> 

<?php the_content(); ?> 

<?php if (comments_open() || get_comments_number()) : ?>
    <div class="container">
    <?php comments_template(); ?>
    </div>
<?php endif; ?>

<?php if('no-sidebar' != $col_class) :?>
    </div>
<div class="page-sidebar-content">
<?php if (is_active_sidebar('page-sidebar-1')) {
    if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Sidebar')) : ?>
    <?php endif;
} ?>
</div>
<?php endif; ?>


<?php if('no-sidebar' != $col_class) : ?> 
</div>
<?php endif; ?> 
