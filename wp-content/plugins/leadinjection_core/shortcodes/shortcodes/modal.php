<?php

/**
 *   Modal Shortcode
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_modal', 'leadinjection_modal_shortcode');

function leadinjection_modal_shortcode($atts, $content)
{
    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'modal_id' => null,
        'exit_show' => null,
        'time_show' => null,
        'time_show_value' => null,
        'scroll_show' => null,
        'scroll_show_value' => null,
        'xclass' => '',
    ), $atts);

    extract($defaults);

    $modal = leadinjection_get_modal($modal_id);

    $modal_id = $modal['modal_id'];
    if($modal['success']){
        $modal_data = $modal['result']->post_content;
    }else{
        $modal_data = "<br><div style='background: red; color: #fff; margin: 50px; text-align: center; padding: 30px;'>Lead Modal not found!</div><br>";
    }

    leadinjection_enqueue_animation();

    $entrance_animation = get_post_meta($modal_id, 'li-modal-entrances', true);
    if(empty($entrance_animation)){
        $entrance_animation = 'fadeInDown';
    }

    $exit_animation = get_post_meta($modal_id, 'li-modal-exits', true);
    if(empty($exit_animation)){
        $exit_animation = 'fadeOutUp';
    }

    $backdrop = get_post_meta($modal_id, 'li-modal-backdrop', true);
    $backdrop_close = get_post_meta($modal_id, 'li-modal-backdrop-close', true);


    $style = leadinjection_create_modal_styles($modal_id);
    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>

    <?php if(!empty($content)) :?>
        <a href="#" data-toggle="modal" data-target="#liModal-<?php echo $modal_id ?>"><?php echo $content; ?></a>
    <?php endif; ?>

    <script type="text/javascript">
        jQuery(window).load(function () {

            // Show Entrance and Exit Style
            function modalAnimationStyle(style) {
                jQuery('#liModal-<?php echo $modal_id ?> .modal-dialog').attr('class', 'modal-dialog  ' + style + '  animated');
            }
            jQuery("#liModal-<?php echo $modal_id ?>").on('show.bs.modal', function (e) {
                jQuery("body").addClass('liModal-<?php echo $modal_id ?>-open');
                modalAnimationStyle('<?php echo $entrance_animation; ?>');
                <?php if(!empty($backdrop)) :?>
                    jQuery("#liModal-<?php echo $modal_id ?>").data('bs.modal').options.backdrop = false;
                <?php elseif(!empty($backdrop_close)) :?>
                    jQuery("#liModal-<?php echo $modal_id ?>").data('bs.modal').options.backdrop = 'static';
                <?php endif; ?>

            });
            jQuery("#liModal-<?php echo $modal_id ?>").on('hide.bs.modal', function (e) {
                jQuery("body").removeClass('liModal-<?php echo $modal_id ?>-open');
                modalAnimationStyle('<?php echo $exit_animation ?>');
            });

            jQuery("#liModal-<?php echo $modal_id ?>").on('show.bs.modal', function (e) {
                var that=jQuery(this);
                var id=that.attr('id')+'-backdrop'; //get the id of button which got clicked
                setTimeout(function(){
                    jQuery('.modal-backdrop').attr('id',id);
                });
            });

            <?php if (!is_null($exit_show) || !is_null($time_show) || !is_null($scroll_show)) : ?>
                var exitpopped = 0;
                var showpop = 0;
                var delay = 3000;

                <?php if(!is_null($exit_show)) :?>
                // Exit Popup
                setTimeout(function () {
                    showpop = 1;
                }, delay);
                jQuery(document).mousemove(function (e) {
                    if (e.clientY <= 5 && exitpopped == 0 && showpop == 1) {
                        exitpopped = 1;
                        jQuery("#liModal-<?php echo $modal_id ?>").modal({show: true, backdrop: "static"});
                    }
                });
                <?php endif; ?>
            
                <?php if(!is_null($time_show)) :?>
                // Show after time
                setTimeout(function () {
                    jQuery("#liModal-<?php echo $modal_id ?>").modal({show: true, backdrop: "static"});
                    exitpopped = 1;
                }, <?php echo (int)$time_show_value * 1000 ?>);
                <?php endif; ?>
            
                <?php if(!is_null($scroll_show)) :?>
                // Show after scroll xx %
                jQuery(window).scroll(function () {
                    if (jQuery(window).scrollTop() >= (jQuery(document).height() - jQuery(window).height()) *<?php echo $scroll_show_value / 100; ?> && exitpopped == 0) {
                        exitpopped = 1;
                        jQuery("#liModal-<?php echo $modal_id ?>").modal({show: true, backdrop: "static"});
                    }
                });
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>



    <div class="modal fade li-modal <?php echo esc_attr($xclass); ?>" id="liModal-<?php echo esc_attr($modal_id) ?>"
         tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <?php echo do_shortcode($modal_data); ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    // End Output
    //////////////////////////////////////////////////////////////////////////////////////////

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}


/**
 * Visual Composer Registration
 */

add_action('vc_before_init', 'leadinjection_modal_vc');

function leadinjection_modal_vc()
{
    vc_map(array(
            "name" => __("Modal", "leadinjection"),
            "base" => "leadinjection_modal",
            "class" => "",
            "icon" => 'li-icon li-modal',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Title and Sub Title for a Section', 'leadinjection'),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Available modals', 'leadinjection'),
                    'value' => leadinjection_get_modals(),
                    'admin_label' => true,
                    'param_name' => 'modal_id',
                    'description' => __('Select icon library', 'leadinjection'),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'exit_show',
                    'value' => array(__('Display modal if the user exit', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'time_show',
                    'value' => array(__('Set a Modal timer', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Show modal after time', 'leadinjection'),
                    'description' => __('Enter a time in sec. ( e.g. 30 / modal appears after 30 sec.)', 'leadinjection'),
                    'param_name' => 'time_show_value',
                    //'value' => '10',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'time_show',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'scroll_show',
                    'value' => array(__('Set scroll position', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Show modal at scroll position', 'leadinjection'),
                    'description' => __('Enter scroll level in percent. ( e.g. 50 / modal appears after 50%)', 'leadinjection'),
                    'param_name' => 'scroll_show_value',
                    //'value' => '50',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'scroll_show',
                        'value' => 'yes',
                    ),
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}