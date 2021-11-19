<?php
/**
 * The template for displaying all modal posts. 
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

get_header();

$post_id = get_the_ID();

$style = leadinjection_create_modal_styles($post_id);

$entrance_animation = get_post_meta($post_id, 'li-modal-entrances', true);
$exit_animation = get_post_meta($post_id, 'li-modal-exits', true);

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" >



        <div class="container">
            <div class="row">
                <!--start main content-->
                <div class="col-md-12">

                    <?php if(!empty($style)) : ?>
                    <?php echo sprintf("<style scoped>%s</style>", $style) ?>
                    <?php endif; ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php if('li_modals' == get_post_type()) : ?>
                        <script type="text/javascript">
                            jQuery(window).load(function(){

                                // Show Entrance and Exit Style
                                function modalAnimationStyle(style) {
                                    jQuery('#liModal-<?php echo esc_js($post_id) ?> .modal-dialog').attr('class', 'modal-dialog  ' + style + '  animated');
                                }

                                jQuery("#liModal-<?php echo esc_js($post_id) ?>").on('show.bs.modal', function (e) {
                                    modalAnimationStyle('<?php echo esc_js($entrance_animation); ?>');
                                });
                                jQuery("#liModal-<?php echo esc_js($post_id) ?>").on('hide.bs.modal', function (e) {
                                    modalAnimationStyle('<?php echo esc_js($exit_animation) ?>');
                                });

                                jQuery('#liModal-<?php echo esc_js($post_id); ?>').modal('show');

                            });
                        </script>
                        <?php endif; ?>

                        <div class="modal fade li-modal" id="liModal-<?php echo esc_attr($post_id); ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div class="modal-body">
                                        <?php echo the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br><br><br><br><br><br>
                        <!-- Button trigger modal -->
                        <div class="row">
                            <div class="col-md-12 text-center" >
                                <button type="button" class="btn btn-green btn-lg" data-toggle="modal" data-target="#liModal-<?php echo esc_attr($post_id) ?>">
                                    Launch demo modal
                                </button>
                            </div>
                        </div>

                        <br><br><br><br><br><br><br><br><br>
                        <br><br><br><br><br><br><br><br><br>

                    <?php endwhile; // End of the loop. ?>
                </div>
                <!--end main content-->


            </div>
        </div>


    </main>
</div>

<?php get_footer(); ?>
