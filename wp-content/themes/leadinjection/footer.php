<?php
/**
 * The template for displaying the footer.
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
$leadinjection_onpage_footer = get_post_meta( leadinjection_post_id(), 'li-onpage-footer', true );
$leadinjection_onpage_raw_js_footer = get_post_meta( leadinjection_post_id(), 'li-onpage-raw-js-footer', true );
$leadinjection_onpage_scroll_top = get_post_meta( leadinjection_post_id(), 'li-onpage-scroll-top', true );

$footer_style = ( isset($leadinjection_global_option['li-global-footer-style']) ) ? $leadinjection_global_option['li-global-footer-style'] : null;

?>

</div><!-- #content -->

<?php if (empty($leadinjection_onpage_footer) || 'hidden' !== $leadinjection_onpage_footer) : ?>

    <?php switch ($footer_style){
        case 'footer-style-2' : get_template_part('template-parts/footer', 'style-2');
            break;

        case 'footer-style-3' : get_template_part('template-parts/footer', 'style-3');
            break;

        default: get_template_part('template-parts/footer', 'style-1');
    } ?>

    <?php if ( !empty($leadinjection_global_option['li-global-click-to-call-button']) ) : ?>
        <div class="li-mobile-contact-bar <?php echo esc_attr($leadinjection_global_option['li-global-click-to-call-devices']); ?>">
            <div class="li-mobile-contact-bar-button">
                <a href="tel:<?php echo str_replace(' ', '', $leadinjection_global_option['li-global-click-to-call-phone']); ?>"><i class="fa fa-phone-square" aria-hidden="true"></i> <span><?php echo esc_html($leadinjection_global_option['li-global-click-to-call-text']); ?></span></a>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

</div><!-- #page -->

</div><!-- #page-container -->


<?php if(!empty($leadinjection_global_option['li-global-scroll-top']) && empty($leadinjection_onpage_scroll_top) || !empty($leadinjection_onpage_scroll_top) ) : ?>
<a href="#li-page-top" class="scroll-to scroll-up-btn hidden-xs"><i class="fa fa-angle-double-up"></i></a>
<?php endif; ?>


<?php wp_footer(); ?>

<?php
if (!empty($leadinjection_global_option['li-global-raw-js-footer']) && empty($leadinjection_onpage_raw_js_footer)) {
    echo str_replace(array("\r","\n"),"", $leadinjection_global_option['li-global-raw-js-footer']);
}elseif( !empty($leadinjection_onpage_raw_js_footer) ){
    echo str_replace(array("\r","\n"),"", $leadinjection_onpage_raw_js_footer);
}
?>


<!-- Leadinjection v2.3.14 -->

</body>
</html>
